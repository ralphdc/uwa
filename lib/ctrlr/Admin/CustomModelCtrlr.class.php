<?php

/**
 *--------------------------------------
 * custom model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-02
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomModelCtrlr extends ManageCtrlr {
	public function list_model() {
		$_CML = M('CustomModel')->get_modelList(false);
		$this->assign('_CML', $_CML);

		$this->display();
	}

	public function update_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customModelId = ARequest::get('custom_model_id');
		$_L_ID = is_array($customModelId) ? implode(', ', $customModelId) : $customModelId;

		if(empty($customModelId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_model'));
		}

		$cmDisplayOrder = ARequest::get('cm_display_order');
		$cmName = ARequest::get('cm_name');
		$data = array();
		foreach($customModelId as $k => $id) {
			$data['custom_model_id'] = $id;
			$data['cm_display_order'] = $cmDisplayOrder[$k];
			$data['cm_name'] = $cmName[$k];
			$result = M('CustomModel')->edit_model($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('custom_model/list_model'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('custom_model/list_model'));
	}

	public function add_model() {
		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		$this->display();
	}
	public function add_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('CustomModel')->add_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('custom_model/edit_model?custom_model_id=' . $result['data']));
	}

	public function edit_model() {
		$customModelId = ARequest::get('custom_model_id');
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_model'));
		}

		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		$this->assign('_CMI', $_CMI);
		$this->display();
	}
	public function edit_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('CustomModel')->edit_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL') . ': ID[' . $data['custom_model_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL') . ': ID[' . $data['custom_model_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('custom_model/list_model'));
	}

	public function delete_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customModelId = ARequest::get('custom_model_id');
		$customModelId = is_array($customModelId) ? $customModelId : explode(',', $customModelId);
		$_L_ID = implode(', ', $customModelId);

		foreach($customModelId as $customModelId) {
			$result = M('CustomModel')->delete_model($customModelId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL') . ': ID[' . $customModelId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('custom_model/list_model'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('custom_model/list_model'));
	}

	public function toggle_model_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['custom_model_id'] = ARequest::get('custom_model_id');
		$data['cm_status'] = ARequest::get('cm_status');
		if(false === M('CustomModel')->edit_model($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL') . ': ID[' . $data['custom_model_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('custom_model/list_model'));
		}
		F('~ami/~am_' . $data['custom_model_id'], null);
		F('~aml', null);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL') . ': ID[' . $data['custom_model_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('custom_model/list_model'));
	}

	public function add_model_field() {
		$customModelId = ARequest::get('custom_model_id');
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$this->assign('_CMI', $_CMI);

		$this->display();
	}
	public function add_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customModelId = ARequest::get('custom_model_id');

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('CustomModel')->add_modelField($customModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
	}

	public function edit_model_field() {
		$customModelId = ARequest::get('custom_model_id');
		$fName = ARequest::get('f_name');

		$_CMFI = M('CustomModel')->get_formFieldInfo($customModelId, $fName);
		if(empty($_CMFI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$_CMFI['custom_model_id'] = $customModelId;
		$_CMFI['f_name'] = $fName;
		$this->assign('_CMFI', $_CMFI);

		$this->display();
	}
	public function edit_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customModelId = ARequest::get('custom_model_id');

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('CustomModel')->edit_modelField($customModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '] , FIELD[' . ARequest::get('f_name') . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
	}

	public function delete_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$customModelId = ARequest::get('custom_model_id');
		$fName = ARequest::get('f_name');
		$result = M('CustomModel')->delete_modelField($customModelId, $fName);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL_FIELD') . ': ID[' . $customModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('custom_model/edit_model?custom_model_id=' . $customModelId));
	}

	public function list_content() {
		$customModelId = ARequest::get('custom_model_id');
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_model'));
		}
		$this->assign('_CMI', $_CMI);

		$where = array();
		/* filter status */
		$status = ARequest::get('status') ? ARequest::get('status') : '';
		if('n' == $status) {
			$where['status'] = array('EQ', 0);
		}
		elseif('p' == $status) {
			$where['status'] = array('EQ', 1);
		}
		elseif('r' == $status) {
			$where['status'] = array('EQ', 2);
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['member_id'] = array('EQ', $memberId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M(parse_name($_CMI['cm_table'], 1))->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('custom_model/list_content?custom_model_id=' . $customModelId . '&status=' . $status . '&member_id=' . $memberId . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_CMCL = M('CustomModel')->list_content($_CMI, $where, $order, $limit);

		$this->assign('_CMCL', $_CMCL);

		$this->display('admin/' . $_CMI['cm_tpl_list_admin']);
	}

	public function add_content() {
		$customModelId = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('custom_model/list_model'));
		}
		$this->assign('_CMI', $_CMI);

		$_FI = '';
		load('field#func');
		foreach($_CMI['cm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		$this->display('admin/' . $_CMI['cm_tpl_add_admin']);
	}
	public function add_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['member_id'] = ASession::get('member_id');

		/* deal with remote source */
		if(isset($data['save_remote_source']) and !empty($data['save_remote_source'])) {
			foreach($data['save_remote_source'] as $field) {
				$waterMark = false;
				if(isset($data['watermark_remote_img']) and in_array($field, $data['watermark_remote_img'])) {
					$waterMark = true;
				}
				$data[$field] = M('Upload')->deal_reomote_file($data[$field], $waterMark, $data['cm_alias']);
			}
		}

		/* delete external links */
		if(isset($data['delete_external_links']) and !empty($data['delete_external_links'])) {
			foreach($data['delete_external_links'] as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}

		/* insert into model table */
		$result = M('CustomModel')->add_content($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL_CONTENT') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($result['data']);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_MODEL_CONTENT') . ': ID[' . $data['cm_alias'] . '|' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
	}

	public function edit_content() {
		$customModelId = ARequest::get('custom_model_id');
		$id = ARequest::get('id');
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_model'));
		}
		$this->assign('_CMI', $_CMI);

		$_CMCI = M('CustomModel')->get_contentInfo($customModelId, $id);
		if(empty($_CMCI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_content?custom_model_id=' . $customModelId));
		}
		$this->assign('_CMCI', $_CMCI);

		$_FI = '';
		load('field#func');
		foreach($_CMI['cm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_CMCI));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		$this->display('admin/' . $_CMI['cm_tpl_edit_admin']);
	}
	public function edit_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		/* deal with remote source */
		if(isset($data['save_remote_source']) and !empty($data['save_remote_source'])) {
			foreach($data['save_remote_source'] as $field) {
				$waterMark = false;
				if(isset($data['watermark_remote_img']) and in_array($field, $data['watermark_remote_img'])) {
					$waterMark = true;
				}
				$data[$field] = M('Upload')->deal_reomote_file($data[$field], $waterMark, $data['cm_alias']);
			}
		}

		/* delete external links */
		if(isset($data['delete_external_links']) and !empty($data['delete_external_links'])) {
			foreach($data['delete_external_links'] as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}

		$result = M('CustomModel')->edit_content($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL_CONTENT') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['id']);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_MODEL_CONTENT') . ': ID[' . $data['cm_alias'] . '|' . $data['id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
	}

	public function pass_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$id = ARequest::get('id');
		$id = is_array($id) ? $id : explode(',', $id);
		$_L_ID = implode(', ', $id);

		foreach($id as $id) {
			$data = array();
			$data['id'] = $id;
			$data['custom_model_id'] = ARequest::get('custom_model_id');
			$data['status'] = 1;

			$result = M('CustomModel')->edit_content($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_CUSTOM_MODEL_CONTENT') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_CUSTOM_MODEL_CONTENT') . ': ID[' . $_L_ID . ']');
		$this->success(L('PASS_SUCCESS'), AServer::get_preUrl());
	}

	public function refund_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$id = ARequest::get('id');
		$id = is_array($id) ? $id : explode(',', $id);
		$_L_ID = implode(', ', $id);

		foreach($id as $id) {
			$data = array();
			$data['id'] = $id;
			$data['custom_model_id'] = ARequest::get('custom_model_id');
			$data['status'] = 2;

			$result = M('CustomModel')->edit_content($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('REFUND_CUSTOM_MODEL_CONTENT') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('REFUND_CUSTOM_MODEL_CONTENT') . ': ID[' . $_L_ID . ']');
		$this->success(L('REFUND_SUCCESS'), AServer::get_preUrl());
	}

	public function delete_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$id = ARequest::get('id');
		$id = is_array($id) ? $id : explode(',', $id);
		$_L_ID = implode(', ', $id);

		foreach($id as $id) {
			$result = M('CustomModel')->delete_content(ARequest::get('custom_model_id'), $id);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL_CONTENT') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_MODEL_CONTENT') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), AServer::get_preUrl());
	}
}

?>