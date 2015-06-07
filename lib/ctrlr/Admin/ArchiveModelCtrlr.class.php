<?php

/**
 *--------------------------------------
 * archive model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-28
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveModelCtrlr extends ManageCtrlr {
	public function list_model() {
		$_AML = M('ArchiveModel')->get_modelList(false);
		$this->assign('_AML', $_AML);
		$this->display();
	}

	public function update_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveModelId = ARequest::get('archive_model_id');
		$_L_ID = is_array($archiveModelId) ? implode(', ', $archiveModelId) : $archiveModelId;

		if(empty($archiveModelId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_model/list_model'));
		}

		$amDisplayOrder = ARequest::get('am_display_order');
		$amName = ARequest::get('am_name');
		$data = array();
		foreach($archiveModelId as $k => $id) {
			$data['archive_model_id'] = $id;
			$data['am_display_order'] = $amDisplayOrder[$k];
			$data['am_name'] = $amName[$k];
			$result = M('ArchiveModel')->edit_model($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_model/list_model'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_model/list_model'));
	}

	public function add_model() {
		$this->display();
	}
	public function add_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('ArchiveModel')->add_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_MODEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_MODEL') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('archive_model/edit_model?archive_model_id=' . $result['data']));
	}

	public function edit_model() {
		$archiveModelId = ARequest::get('archive_model_id');
		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_model/list_model'));
		}

		$this->assign('_AMI', $_AMI);
		$this->display();
	}
	public function edit_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('ArchiveModel')->edit_model($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $data['archive_model_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $data['archive_model_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_model/list_model'));
	}

	public function delete_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveModelId = ARequest::get('archive_model_id');

		$_t_acl = M('ArchiveChannel')->field('archive_channel_id')->where(array('archive_model_id' => array('EQ', $archiveModelId)))->select();
		if(!empty($_t_acl)) {
			$this->error(L('SUB_CHANNEL_EXIST'), Url::U('archive_model/list_model'));
		}

		$result = M('ArchiveModel')->delete_model($archiveModelId);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_MODEL') . ': ID[' . $archiveModelId . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_MODEL') . ': ID[' . $archiveModelId . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_model/list_model'));
	}

	public function toggle_model_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['archive_model_id'] = ARequest::get('archive_model_id');
		$data['am_status'] = ARequest::get('am_status');

		if(false === M('ArchiveModel')->edit_model($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $data['archive_model_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('archive_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL') . ': ID[' . $data['archive_model_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('archive_model/list_model'));
	}

	public function add_model_field() {
		$archiveModelId = ARequest::get('archive_model_id');
		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$this->assign('_AMI', $_AMI);

		$this->display();
	}
	public function add_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveModelId = ARequest::get('archive_model_id');

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('ArchiveModel')->add_modelField($archiveModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
	}

	public function edit_model_field() {
		$archiveModelId = ARequest::get('archive_model_id');
		$fName = ARequest::get('f_name');

		$_AMFI = M('ArchiveModel')->get_modelFieldInfo($archiveModelId, $fName);
		if(empty($_AMFI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
		}

		$_FT = load('fieldtype#comm');
		$this->assign('_FT', $_FT);

		$_AMFI['archive_model_id'] = $archiveModelId;
		$_AMFI['f_name'] = $fName;
		$this->assign('_AMFI', $_AMFI);

		$this->display();
	}
	public function edit_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveModelId = ARequest::get('archive_model_id');

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		if(1 == $data['f_multi_upload'] && 255 >= $data['f_length']) {
			$data['f_length'] = 256;
		}
		$field[ARequest::get('f_name')] = $data;

		$result = M('ArchiveModel')->edit_modelField($archiveModelId, $field);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '] , FIELD[' . ARequest::get('f_name') . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
	}

	public function delete_model_field_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveModelId = ARequest::get('archive_model_id');
		$fName = ARequest::get('f_name');
		$result = M('ArchiveModel')->delete_modelField($archiveModelId, $fName);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '], FIELD[' . ARequest::get('f_name') . '] ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_MODEL_FIELD') . ': ID[' . $archiveModelId . '], FIELD[' . ARequest::get('f_name') . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_model/edit_model?archive_model_id=' . $archiveModelId));
	}

	public function export_model() {
		$archiveModelId = ARequest::get('archive_model_id');
		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_model/list_model'));
		}

		$this->assign('_AMI', $_AMI);
		$this->display();
	}
	public function export_model_do() {
		$data = ARequest::get();
		if(!check_token()) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EXPORT_ARCHIVE_MODEL') . ': MODEL_ALIAS[' . $data['am_alias'] . '] ' . L('DATA_INVALID'), 0);
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EXPORT_ARCHIVE_MODEL') . ': MODEL_ALIAS[' . $data['am_alias'] . ']');

		if(MAGIC_QUOTES_GPC) {
			$data = stripslashes_array($data);
		}
		unset($data['timeKey']);
		unset($data['token']);
		$data['up_lang'] = base64_encode($data['up_lang']);

		load('encode_file#func');
		$data['file_list'] = get_fileListEncode($data['file_list']);

		$filename = ARequest::get('am_alias') . '-' . date('Ymd') . (ARequest::get('compressed') ? '.uwa_am' : '.uwa_am_src');
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

		load('encode_file#func');
		$_AMI = ARequest::get('compressed') ? unserialize(gzdecode(file_get_contents($_FILES['uwa_package_file']['tmp_name']))) : unserialize(file_get_contents($_FILES['uwa_package_file']['tmp_name']));
		if(!is_array($_AMI) or !isset($_AMI['am_alias']) or !isset($_AMI['am_addon_table'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UPLOAD_ARCHIVE_MODEL') . ': ' . L('DATA_FORMAT_INVALID'), 0);
			$this->error(L('DATA_FORMAT_INVALID'), AServer::get_preUrl());
		}
		$_AMI['up_lang'] = base64_decode($_AMI['up_lang']);

		$this->assign('_AMI', $_AMI);
		$this->display();
	}
	public function import_model_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_AMI = ARequest::get();
		if(MAGIC_QUOTES_GPC) {
			$_AMI = stripslashes_array($_AMI);
		}
		unset($_AMI['timeKey']);
		unset($_AMI['token']);

		$result = M('ArchiveModel')->import_model($_AMI);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('IMPORT_ARCHIVE_MODEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_model/list_model'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('IMPORT_ARCHIVE_MODEL') . ': MODEL_ALIAS[' . $_AMI['am_alias'] . ']');
		$this->success(L('IMPORT_SUCCESS'), Url::U('archive_model/list_model'));
	}
}

?>