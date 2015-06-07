<?php

/**
 *--------------------------------------
 * extension
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-19
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ExtensionCtrlr extends ManageCtrlr {
	public function list_extension() {
		if(!dir_writable(RUNTIME_PATH . D_S . 'extension')) {
			$this->error(L('DIR_READONLY', null, array('dir' => '{uwa_path}/runtime/extension')), Url::U('index/show_system_info'));
		}

		$_EL = M('Extension')->get_extensionList(ARequest::get('e_type'));
		$this->assign('_EL', $_EL);
		$this->display();
	}

	public function show_extension() {
		$hashcode = ARequest::get('e_hashcode');
		$_EI = M('Extension')->get_extensionInfo($hashcode);
		if(empty($_EI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('extension/list_extension'));
		}
		$this->assign('_EI', $_EI);
		$this->display();
	}

	public function install_extension() {
		$hashcode = ARequest::get('e_hashcode');
		$_EI = M('Extension')->get_extensionInfo($hashcode);
		if(empty($_EI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('extension/list_extension'));
		}
		$this->assign('_EI', $_EI);
		$this->display();
	}
	public function install_extension_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_EI = M('Extension')->get_extensionInfo(ARequest::get('e_hashcode'));
		if(empty($_EI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('extension/list_extension'));
		}
		$_EI['file_list'] = ARequest::get('file_list');
		$_EI['e_manage_menu'] = ARequest::get('e_manage_menu');

		$result = M('Extension')->install_extension($_EI);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('INSTALL_EXTENSION') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('extension/list_extension'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('INSTALL_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']');
		$this->success(L('INSTALL_SUCCESS'), Url::U('extension/list_extension'));
	}

	public function uninstall_extension_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_EI = M('Extension')->get_extensionInfo(ARequest::get('e_hashcode'));
		if(empty($_EI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('extension/list_extension'));
		}

		$result = M('Extension')->uninstall_extension($_EI);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UNINSTALL_EXTENSION') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('extension/list_extension'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('UNINSTALL_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']');
		$this->success(L('UNINSTALL_SUCCESS'), Url::U('extension/list_extension'));
	}

	public function delete_extension_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_EI = M('Extension')->get_extensionInfo(ARequest::get('e_hashcode'));
		if(empty($_EI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('extension/list_extension'));
		}

		if(1 == $_EI['e_status']) {
			$this->error(L('EXTENSION_IS_USED'), Url::U('extension/list_extension'));
		}

		if(!@unlink(RUNTIME_PATH . D_S . 'extension' . D_S . $_EI['e_hashcode'] . '.extension.php')) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']', 0);
			$this->error(L('DELETE_FAILED'), Url::U('extension/list_extension'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('extension/list_extension'));
	}

	public function package_extension() {
		$this->display();
	}
	public function package_extension_do() {
		$data = ARequest::get();
		if(MAGIC_QUOTES_GPC) {
			$data = stripslashes_array($data);
		}

		if(!check_token()) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('PACKAGE_EXTENSION') . ': ' . $data['e_name'] . '[' . $data['e_alias'] . '] ' . L('DATA_INVALID'), 0);
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}
		unset($data['timeKey']);
		unset($data['token']);

		if(empty($data['e_hashcode']) or L('EMPTY') == $data['e_hashcode']) {
			$data['e_hashcode'] = md5($data['e_alias'] . '|' . $data['e_author'] . '|' . $data['e_author_email']);
		}
		$data['e_instruction'] = base64_encode($data['e_instruction']);
		if(is_uploaded_file($_FILES['e_install_upload']['tmp_name'])) {
			$data['e_install'] = file_get_contents($_FILES['e_install_upload']['tmp_name']);
		}
		$data['e_install'] = base64_encode($data['e_install']);
		if(is_uploaded_file($_FILES['e_uninstall_upload']['tmp_name'])) {
			$data['e_uninstall'] = file_get_contents($_FILES['e_uninstall_upload']['tmp_name']);
		}
		$data['e_uninstall'] = base64_encode($data['e_uninstall']);
		if(is_uploaded_file($_FILES['e_lang_upload']['tmp_name'])) {
			$data['e_lang'] = file_get_contents($_FILES['e_lang_upload']['tmp_name']);
		}
		$data['e_lang'] = base64_encode($data['e_lang']);
		if(is_uploaded_file($_FILES['e_route_upload']['tmp_name'])) {
			$data['e_route'] = file_get_contents($_FILES['e_route_upload']['tmp_name']);
		}
		$data['e_route'] = base64_encode($data['e_route']);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('PACKAGE_EXTENSION') . ': ' . $data['e_name'] . '[' . $data['e_alias'] . ']');

		load('encode_file#func');
		$data['file_list'] = get_fileListEncode($data['file_list']);

		$filename = $data['e_type'] . '-' . parse_name($data['e_alias'], 1) . '-v' . str_replace('.', '_', $data['e_version']) . '-' . str_replace('-', '', $data['e_publish_date']) . (ARequest::get('compressed') ? '.uwa_ext' : '.uwa_ext_src');
		if(ARequest::get('compressed')) {
			unset($data['compressed']);
		}
		output_uwaPackage($filename, serialize($data), ARequest::get('compressed'));
	}

	public function upload_extension() {
		$this->display();
	}
	public function upload_extension_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		if(!is_uploaded_file($_FILES['uwa_package_file']['tmp_name'])) {
			$this->error(L('NOTHING_UPLOAD'), AServer::get_preUrl());
		}

		load('encode_file#func');
		$_EI = ARequest::get('compressed') ? unserialize(gzdecode(file_get_contents($_FILES['uwa_package_file']['tmp_name']))) : unserialize(file_get_contents($_FILES['uwa_package_file']['tmp_name']));
		if(!is_array($_EI) or !isset($_EI['e_hashcode']) or ($_EI['e_hashcode'] != md5($_EI['e_alias'] . '|' . $_EI['e_author'] . '|' . $_EI['e_author_email']))) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UPLOAD_EXTENSION') . ': ' . L('DATA_FORMAT_INVALID'), 0);
			$this->error(L('DATA_FORMAT_INVALID'), AServer::get_preUrl());
		}
		$filename = RUNTIME_PATH . D_S . 'extension' . D_S . $_EI['e_hashcode'] . '.extension.php';
		if(is_file($filename) and 0 == ARequest::get('overwrite')) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UPLOAD_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']' . L('EXTENSION_EXIST'), 0);
			$this->error($_EI['e_name'] . '[' . $_EI['e_alias'] . ']' . L('EXTENSION_EXIST'), AServer::get_preUrl());
		}

		$content = "<?php\r\n";
		$content .= "return " . var_export($_EI, true) . ";\r\n";
		$content .= "?>";

		file_put_contents($filename, $content);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('UPLOAD_EXTENSION') . ': ' . $_EI['e_name'] . '[' . $_EI['e_alias'] . ']');
		$this->success(L('UPLOAD_SUCCESS'), Url::U('extension/list_extension'));
	}
}

?>