<?php

/**
 *--------------------------------------
 * flink category
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FlinkCategoryCtrlr extends ManageCtrlr {
	public function list_category() {
		$_FCL = M('FlinkCategory')->get_categoryList();
		$this->assign('_FCL', $_FCL);
		$this->display();
	}

	public function add_category_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('FlinkCategory')->add_category($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_FLINK_CATEGORY') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('flink_category/list_category'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_FLINK_CATEGORY') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('flink_category/list_category'));
	}

	public function update_category_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$flinkCategoryId = ARequest::get('flink_category_id');
		$fcName = ARequest::get('fc_name');
		$fcDisplayOrder = ARequest::get('fc_display_order');
		$_L_ID = is_array($flinkCategoryId) ? implode(', ', $flinkCategoryId) : $flinkCategoryId;

		if(!is_array($flinkCategoryId) or empty($flinkCategoryId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK_CATEGORY') . ': ID[' . $flinkCategoryId . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('flink_category/list_category'));
		}

		$data = array();
		$error = false;
		foreach($flinkCategoryId as $k => $id) {
			$data['flink_category_id'] = $id;
			$data['fc_name'] = $fcName[$k];
			$data['fc_display_order'] = $fcDisplayOrder[$k];
			$result = M('FlinkCategory')->edit_category($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK_CATEGORY') . ': ID[' . $flinkCategoryId . ']', 0);
				$this->error(L('EDIT_FAILED'), Url::U('flink_category/list_category'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK_CATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('flink_category/list_category'));
	}

	public function delete_category_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$flinkCategoryId = ARequest::get('flink_category_id');
		$flinkCategoryId = is_array($flinkCategoryId) ? $flinkCategoryId : explode(',', $flinkCategoryId);
		$_L_ID = implode(', ', $flinkCategoryId);

		foreach($flinkCategoryId as $flinkCategoryId) {
			$result = M('FlinkCategory')->delete_category($flinkCategoryId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_FLINK_CATEGORY') . ': ID[' . $flinkCategoryId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('flink_category/list_category'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_FLINK_CATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('flink_category/list_category'));
	}
}

?>