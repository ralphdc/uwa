<?php

/**
 *--------------------------------------
 * archive search
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-13
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class SearchModl extends Modl {
	protected $sphinx;
	protected $_o_p = array();

	public function __construct() {
		parent::__construct();

		$this->_o_p = M('Option')->get_option('performance');
		if($this->_o_p['sphinx_switch']) {
			vendor('SphinxClient#class');
			$this->sphinx = get_instance('SphinxClient');
			$this->sphinx->SetServer($this->_o_p['sphinx_host'], $this->_o_p['sphinx_port']);
			$this->sphinx->SetConnectTimeout(3);
			$this->sphinx->SetMaxQueryTime(2000);
			$this->sphinx->SetArrayResult(true);
			$this->sphinx->SetRankingMode(SPH_RANK_PROXIMITY_BM25);
		}
	}

	public function analysis_keywords($keyword) {
		$keywords = '';
		$keywords = explode(' ', $keyword, 3);

		return $keywords;
	}

	public function count_archive($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array()) {
		if(!$this->_o_p['sphinx_switch']) {
			return $this->_count_archive($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime);
		}
		else {
			return $this->_count_archive_sphinx($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime);
		}
	}

	protected function _count_archive($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array()) {
		$where = $this->__get_where($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime);
		return $rowsNum = M('Archive')->where($where)->count();
	}

	protected function _count_archive_sphinx($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array()) {
		$this->sphinx->SetFilter('a_status', array(1));

		$keywords = implode(' ', $keywords);

		$matchmode = ('OR' == $keywordType) ? SPH_MATCH_ANY : SPH_MATCH_ALL;
		$this->sphinx->SetMatchMode($matchmode);

		if(!empty($archiveChannelId)) {
			$this->sphinx->SetFilter('archive_channel_id', $archiveChannelId); 
		}

		if(!empty($aEditTime)) {
			$this->sphinx->SetFilterRange('a_edit_time', $aEditTime[0], $aEditTime[1], false);
		}

		$result['total'] = 0;
		$result = $this->sphinx->Query($keywords, 'main,delta');
		return  $result['total'];

	}

	public function search($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array(), $limit = '0,20', $orderby = 'archive_id asc') {
		if(!$this->_o_p['sphinx_switch']) {
			return $this->_search($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime, $limit, $orderby);
		}
		else {
			return $this->_search_sphinx($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime, $limit, $orderby);
		}
	}

	protected function _search($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array(), $limit = '0,20', $orderby = 'archive_id asc') {
		$where = $this->__get_where($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime);
		return M('Archive')->get_archiveList($where, $orderby, $limit);
	}

	/*
	 * string $keyword: sql like'%$keyword%'
	 * array $archiveChannelId: sql IN('$archiveChannelId')
	 * array $aEditTime: sql between start AND end. format:array('start','end')
	 * int $offset,$limit: sql limit $offset, $limit
	 * string $orderby: sql order by $orderby {sphinx index: archive_id,a_edit_time,a_view_count}
	 */
	protected function _search_sphinx($keywords = array(), $keywordType = 'OR', $searchType = 'title', $archiveChannelId = array(), $aEditTime = array(), $limit = '0,20', $orderby = 'archive_id asc') {
		$this->sphinx->SetFilter('a_status', array(1));

		$keywords = implode(' ', $keywords);

		$matchmode = ('OR' == $keywordType) ? SPH_MATCH_ANY : SPH_MATCH_ALL;
		$this->sphinx->SetMatchMode($matchmode);

		if(!empty($archiveChannelId)) {
			$this->sphinx->SetFilter('archive_channel_id', $archiveChannelId); 
		}

		if(!empty($aEditTime)) {
			$this->sphinx->SetFilterRange('a_edit_time', $aEditTime[0], $aEditTime[1], false);
		}

		$limit = explode(',', $limit, 2);
		$this->sphinx->SetLimits($limit[0], $limit[1], ($limit[1] > 1000 ? $limit[1] : 1000));

		$this->sphinx->SetSortMode(SPH_SORT_EXTENDED, $orderby);

		$archiveId = array();
		$result = $this->sphinx->Query($keywords, 'main,delta');
		foreach($result['matches'] as $_v) {
			$archiveId[] = $_v['id'];
		}

		$archiveId = implode(',', $archiveId);
		$where = array(
			'__ARCHIVE__.archive_id' => array('IN', $archiveId),
		);

		return M('Archive')->get_archiveList($where, $orderby, implode(',', $limit));
	}

	private function __get_where($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime) {
		$where = array();
		$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		/* keywords */
		$likeStr = '';
		foreach($keywords as $k => $v) {
			if(0 == $k) {
				$likeStr .= 'LIKE \'%' . $v . '%\'';
			}
			else {
				if('content' == $searchType) {
					$likeStr .= ' ' . $keywordType . ' __ARCHIVE__.a_description LIKE \'%' . $v . '%\'';
				}
				else {
					$likeStr .= ' ' . $keywordType . ' __ARCHIVE__.a_title LIKE \'%' . $v . '%\'';
				}
			}
		}
		if('content' == $searchType) {
			$where['__ARCHIVE__.a_description'] = array('EXP', $likeStr);
		}
		else {
			$where['__ARCHIVE__.a_title'] = array('EXP', $likeStr);
		}
		/* archive channel id */
		if(!empty($archiveChannelId)) {
			$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $archiveChannelId));
		}
		/* archive edit time */
		if(!empty($aEditTime)) {
			$where['__ARCHIVE__.a_add_time'] = array('GT', $aEditTime[0]);
		}
		return $where;
	}

}

?>