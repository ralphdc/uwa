<?php

/**
 *--------------------------------------
 * member model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-08
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberModelCtrlr extends ManageCtrlr {
	public function list_model() {
		$_MML = M('MemberModel')->get_modelList(false);
		$this->assign('_MML', $_MML);
		$this->display();
	}

	public function update_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberModelId = ARequest::get('member_model_id');
		$_L_ID = is_array($memberModelId) ? implode(', ', $memberModelId) : $memberModelId;

		if(empty($memberModelId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_model/list_model'));
		}

		$mmDisplayOrder = ARequest::get('mm_display_order');
		$mmName = ARequest::get('mm_name');
		$data = array();
		foreach($memberModelId as $k => $id) {
			$data['member_model_id'] = $id;
			$data['mm_display_order'] = $mmDisplayOrder[$k];
			$data['mm_name'] = $mmName[$k];
			$result = M('MemberModel')->edit_model($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_model/list_model'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_model/list_model'));
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
		$result = M('MemberModel')->add_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_MODEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_MODEL') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_model/edit_model?member_model_id=' . $result['data']));
	}

	public function edit_model() {
		$memberModelId = ARequest::get('member_model_id');
		$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
		if(empty($_MMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_model/list_model'));
		}

		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		$this->assign('_MMI', $_MMI);
		$this->display();
	}
	public function edit_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('MemberModel')->edit_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $data['member_model_id'] . ']', 0);
			$this->error($result['error'], Url::U('member_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $data['member_model_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_model/list_model'));
	}

	public function delete_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberModelId = ARequest::get('member_model_id');

		$_t_ml = M('Member')->field('member_id')->where(array('member_model_id' => array('EQ', $memberModelId)))->select();
		if(!empty($_t_ml)) {
			$this->error(L('MEMBER_EXIST'), Url::U('archive_model/list_model'));
		}

		$result = M('MemberModel')->delete_model($memberModelId);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_MODEL') . ': ID[' . $memberModelId . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_MODEL') . ': ID[' . $memberModelId . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_model/list_model'));
	}

	public function toggle_model_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['member_model_id'] = ARequest::get('member_model_id');
		$data['mm_status'] = ARequest::get('mm_status');

		if(false === M('MemberModel')->edit_model($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $data['member_model_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('member_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL') . ': ID[' . $data['member_model_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('member_model/list_model'));
	}

	public function add_model_field() {
		$memberModelId = ARequest::get('member_model_id');
		$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
		if(empty($_MMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$this->assign('_MMI', $_MMI);

		$this->display();
	}
	public function add_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberModelId = ARequest::get('member_model_id');

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('MemberModel')->add_modelField($memberModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
	}

	public function edit_model_field() {
		$memberModelId = ARequest::get('member_model_id');
		$fName = ARequest::get('f_name');

		$_MMFI = M('MemberModel')->get_modelFieldInfo($memberModelId, $fName);
		if(empty($_MMFI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$_MMFI['member_model_id'] = $memberModelId;
		$_MMFI['f_name'] = $fName;
		$this->assign('_MMFI', $_MMFI);

		$this->display();
	}
	public function edit_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberModelId = ARequest::get('member_model_id');
		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('MemberModel')->edit_modelField($memberModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
	}

	public function delete_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberModelId = ARequest::get('member_model_id');
		$fName = ARequest::get('f_name');
		$result = M('MemberModel')->delete_modelField($memberModelId, $fName);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_MODEL_FIELD') . ': ID[' . $memberModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_model/edit_model?member_model_id=' . $memberModelId));
	}

	public function export_model() {
		$memberModelId = ARequest::get('member_model_id');
		$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
		if(empty($_MMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_model/list_model'));
		}

		$this->assign('_MMI', $_MMI);
		$this->display();
	}
	public function export_model_do() {
		$data = ARequest::get();
		if(!check_token()) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EXPORT_MEMBER_MODEL') . ': MODEL_ALIAS[' . $data['mm_alias'] . '] ' . L('DATA_INVALID'), 0);
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EXPORT_MEMBER_MODEL') . ': MODEL_ALIAS[' . $data['mm_alias'] . ']');

		if(MAGIC_QUOTES_GPC) {
			$data = stripslashes_array($data);
		}
		unset($data['timeKey']);
		unset($data['token']);
		$data['up_lang'] = base64_encode($data['up_lang']);

		load('encode_file#func');
		$data['file_list'] = get_fileListEncode($data['file_list']);

		$filename = ARequest::get('mm_alias') . '-' . date('Ymd') . (ARequest::get('compressed') ? '.uwa_mm' : '.uwa_mm_src');
		if(ARequest::get('compressed')) {
			unset($data['compressed']);
		}
		output_uwaPackage($filename, serialize($data), ARequest::get('compressed'));
	}

	public function import_model() {
		$this->display();
	}
	public function import_model_guide() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		if(!is_uploaded_file($_FILES['uwa_package_file']['tmp_name'])) {
			$this->error(L('NOTHING_UPLOAD'), AServer::get_preUrl());
		}

		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		load('encode_file#func');
		$_MMI = ARequest::get('compressed') ? unserialize(gzdecode(file_get_contents($_FILES['uwa_package_file']['tmp_name']))) : unserialize(file_get_contents($_FILES['uwa_package_file']['tmp_name']));
		if(!is_array($_MMI) or !isset($_MMI['mm_alias']) or !isset($_MMI['mm_addon_table'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UPLOAD_ARCHIVE_MODEL') . ': ' . L('DATA_FORMAT_INVALID'), 0);
			$this->error(L('DATA_FORMAT_INVALID'), AServer::get_preUrl());
		}
		$_MMI['up_lang'] = base64_decode($_MMI['up_lang']);

		$this->assign('_MMI', $_MMI);
		$this->display();
	}
	public function import_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_MMI = ARequest::get();
		if(MAGIC_QUOTES_GPC) {
			$_MMI = stripslashes_array($_MMI);
		}
		unset($_MMI['timeKey']);
		unset($_MMI['token']);

		$result = M('MemberModel')->import_model($_MMI);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('IMPORT_MEMBER_MODEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('IMPORT_MEMBER_MODEL') . ': MODEL_ALIAS[' . $_MMI['mm_alias'] . ']');
		$this->success(L('IMPORT_SUCCESS'), Url::U('member_model/list_model'));
	}
}

?>