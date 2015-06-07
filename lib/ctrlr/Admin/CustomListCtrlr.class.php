<?php

/**
 *--------------------------------------
 * custom list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-01
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomListCtrlr extends ManageCtrlr {
	public function list_custom_list() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('CustomList')->count();
		$p = new APage($rowsNum, 20, Url::U('custom_list/list_custom_list?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_CLL = M('CustomList')->get_customListList('', '`custom_list_id` DESC', $limit);
		$this->assign('_CLL', $_CLL);

		$this->display();
	}

	public function add_custom_list() {
		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		/* archive flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$this->display();
	}
	public function add_custom_list_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['cl_update_time'] = time();

		$result = M('CustomList')->add_custom_list($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_LIST') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_list/list_custom_list'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_LIST') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('custom_list/list_custom_list'));
	}

	public function edit_custom_list() {
		$customListId = ARequest::get('custom_list_id');

		$_CLI = M('CustomList')->get_customListInfo($customListId);
		if(empty($_CLI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_list/list_custom_list'));
		}

		$this->assign('_CLI', $_CLI);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n", $_CLI['cl_config']['cid'], "<option value='\$archive_channel_id' selected='selected'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		/* archive flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$this->display();
	}
	public function edit_custom_list_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('CustomList')->edit_custom_list($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_LIST') . ': ID[' . $data['custom_list_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_list/list_custom_list'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_LIST') . ': ID[' . $data['custom_list_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('custom_list/list_custom_list'));
	}

	public function delete_custom_list_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customListId = ARequest::get('custom_list_id');
		$customListId = is_array($customListId) ? $customListId : explode(',', $customListId);
		$_L_ID = implode(', ', $customListId);

		foreach($customListId as $customListId) {
			$result = M('CustomList')->delete_custom_list($customListId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_LIST') . ': ID[' . $customListId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('custom_list/list_custom_list'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_LIST') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('custom_list/list_custom_list'));
	}

	public function build_custom_list_do() {
		$customListId = ARequest::get('custom_list_id');

		$_CLI = S('~custom_list/~cli_' . $customListId);
		if(empty($_CLI)) {
			$_CLI = M('CustomList')->get_customListInfo($customListId);
			if(empty($_CLI)) {
				$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_list/list_custom_list'));
			}
			if(!$_CLI['cl_is_build']) {
				return;
			}

			$where = array();
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
			/* cid */
			$cid = $_CLI['cl_config']['cid'];
			if(strpos($_CLI['cl_config']['cid'], ',')) {
				$where['__ARCHIVE__.archive_channel_id'] = array('IN', $cid);
			}
			else {
				if('all' == $cid or empty($cid)) {
					$cid = 0;
					$_CLI['cl_config']['cid'] = 0;
				}
				$_ACL = M('ArchiveChannel')->get_channelList(0, $cid);
				$act = new ATree($_ACL, array(
					'archive_channel_id',
					'ac_parent_id',
					'ac_sub_channel'), $cid);
				$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($cid)));
			}
			/* flag */
			if(!empty($_CLI['cl_config']['flag'])) {
				$where['__ARCHIVE__.af_alias'] = array('INSET', $_CLI['cl_config']['flag']);
			}
			/* days */
			if(!empty($_CLI['cl_config']['days'])) {
				$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400 * $_CLI['cl_config']['days']);
			}
			/* keywords */
			if(!empty($_CLI['cl_config']['keywords'])) {
				$where['__ARCHIVE__.a_keywords'] = array('LIKE', '%' . $_CLI['cl_config']['keywords'] . '%');
			}
			$_CLI['rows_num'] = M('Archive')->where($where)->count();
			$_CLI['total_page'] = ceil($_CLI['rows_num'] / $_CLI['cl_config']['row']);
			S('~custom_list/~cli_' . $customListId, $_CLI);
		}

		set_time_limit(99999999);
		$this->display('admin/build/progress');

		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => $_CLI['cl_title'], 'url' => ''))
		);

		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 20;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;
		$totalRows = ($_CLI['total_page'] > $_CLI['cl_config']['max_page']) ? $_CLI['cl_config']['max_page'] : $_CLI['total_page'];
		$totalPage = ceil($totalRows / $pageSize);

		/* build list */
		$_C = require (CFG_PATH . D_S . 'comm.php');
		$this->te->tplTheme = $_C['TE']['TPL_THEME'];
		for($i = ($currentPage - 1) * $pageSize + 1; ($i <= $currentPage * $pageSize and $i <= $totalRows); $i++) {
			$file = '/' . trim(str_replace(array('{uwa_path}', '{page}',), array('', '_page_',), $_CLI['cl_build_naming']), '/');

			ARequest::set(C('VAR.PAGE'), $i);
			$p = new APage($_CLI['rows_num'], $_CLI['cl_config']['row'], Url::U('home@custom_list/show_custom_list?custom_list_id=' . $customListId . '&' . C('VAR.PAGE') . '=_page_'));
			$this->assign('PAGING', $p->get_paging());
			$limit = explode(',', $p->get_limit());
			$_CLI['cl_config']['offset'] = $limit[0];

			$this->assign('_V', $_CLI);

			$this->build_html(str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file), APP_PATH, 'home/' . $_CLI['cl_tpl']);
		}
		$this->te->tplTheme = 'default';

		/* progress and next page */
		if($currentPage < $totalPage) {
			$progress = round($currentPage * $pageSize / $totalRows * 100, 1);
			$nextUrl = Url::U('custom_list/build_custom_list_do?page_size=' . $pageSize . '&custom_list_id=' . $customListId . '&current_page=' . ($currentPage + 1));
			F('~build/~next_url', $nextUrl);
			M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $totalRows . ']: ' . L('BUILD_CUSTOM_LIST_HTML'), $progress);
			M('Build')->show_direction($nextUrl);
		}
		else {
			M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . L('BUILD_COMPLETE'), 100);
			set_time_limit(30);
			F('~build/~next_url', null);
			M('CustomList')->update_update_time($customListId);
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CUSTOM_LIST_HTML'));
			M('Build')->show_direction(Url::U('custom_list/list_custom_list'), true, 1);
		}
	}

}

?>