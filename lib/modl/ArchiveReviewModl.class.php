<?php

/**
 *--------------------------------------
 * archive review
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveReviewModl extends Modl {
	public function get_reviewInfo($archiveReviewId) {
		$_ARI = $this->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->find();
		if(empty($_ARI)) {
			return null;
		}

		return $_ARI;
	}

	public function get_reviewList($where = '', $order = '`ar_add_time` DESC', $limit = 5, $filter = true) {
		$_ARL = $this->field('__ARCHIVE_REVIEW__.*, a.a_title, a.a_url, a.a_url_o')->join('__ARCHIVE__ as a ON a.archive_id = __ARCHIVE_REVIEW__.archive_id')->where($where)->order($order)->limit($limit)->select();
		if(!empty($_ARL) and $filter) {
			foreach($_ARL as $k => $v) {
				if(2 == $v['ar_status']) {
					$_ARL[$k]['ar_content'] = M('Report')->filter_content($v['ar_content']);
				}
			}
		}
		return $_ARL;
	}

	public function pass_review($archiveReviewId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->set_field('ar_status', 1)) {
			$result['error'] = L('PASS_FAILED');
			return $result;
		}

		return $result;
	}

	public function add_review($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['archive_review_id']);
		if(false === $this->insert($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function edit_review($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_review($archiveReviewId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($archiveReviewId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_same_ip($archiveReviewId) {
		$result = array('data' => '', 'error' => '');

		$_ARI = $this->field('ar_add_ip')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->find();
		if(empty($_ARI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('ar_add_ip' => array('EQ', $_ARI['ar_add_ip'])))->delete()) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>