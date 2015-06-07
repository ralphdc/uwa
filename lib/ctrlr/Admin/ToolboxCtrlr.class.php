<?php

/**
 *--------------------------------------
 * toolbox
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-29
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ToolboxCtrlr extends ManageCtrlr {
	/* check duplicate archive */
	public function check_duplicate_archive() {
		/* archive model list */
		$_AML = M('ArchiveModel')->get_modelList(true, true);
		$this->assign('_AML', $_AML);

		$_DAL = array();
		if('check' == ARequest::get('action')) {
			if(!check_token()) {
				$this->error(L('DATA_INVALID'), AServer::get_preUrl());
			}
			M('AdminLog')->add_log(ASession::get('m_userid'), L('CHECK_DUPLICATE_ARCHIVE'));

			$archiveModelId = ARequest::get('archive_model_id');
			$_ACL = M('ArchiveChannel')->get_myChannelList($archiveModelId);
			if(!empty($_ACL)) {
				$act = new ATree($_ACL, array(
					'archive_channel_id',
					'ac_parent_id',
					'ac_sub_channel'));
				$_t_acid = implode(',', $act->get_leafid(0));
				$_DAL = M()->query("SELECT COUNT(`a_title`) AS `dac`, `a_title` FROM __ARCHIVE__ WHERE `archive_channel_id` IN(" . $_t_acid . ") GROUP BY `a_title` ORDER BY `dac` DESC LIMIT 0, " . ARequest::get('page_size'), true);
			}
		}
		$this->assign('_DAL', $_DAL);

		$this->display();
	}

	/* delete duplicate archive */
	public function delete_duplicate_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$aTitle = ARequest::get('a_title');
		$aTitle = array_map('urldecode', $aTitle);
		$retainType = ('oldest' == ARequest::get('retain')) ? 'oldest' : 'latest';

		$result = M('Toolbox')->delete_duplicate_archive($aTitle, $retainType);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_DUPLICATE_ARCHIVE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('toolbox/check_duplicate_archive'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_DUPLICATE_ARCHIVE'));
		$this->success(L('DELETE_SUCCESS'), Url::U('toolbox/check_duplicate_archive'));
	}

	/* edit garble string */
	public function edit_garble_string() {
		$_O = get_extensionOption('garble_string');
		$_O['tag'] = implode(',', $_O['tag']);
		$_O['string'] = implode("\r\n", $_O['string']);
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_garble_string_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['tag'] = explode(',', $data['tag']);
		$data['string'] = trim_array(explode("\n", $data['string']));
		unset($data['timeKey']);
		unset($data['token']);

		if(!edit_extensionOption('garble_string', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GARBLE_STRING') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('toolbox/edit_garble_string'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GARBLE_STRING'));
		$this->success(L('EDIT_SUCCESS'), Url::U('toolbox/edit_garble_string'));
	}

	/* [safety check]scan code */
	public function scan_code() {
		/* to scan dir*/
		$_TSD = array(
			'api' => L('API_DIR'),
			'cfg' => L('CONFIG_DIR'),
			'core' => L('CORE_DIR'),
			'lang' => L('LANGUAGE_DIR'),
			'lib' => L('LIBRARY_DIR'),
			'public' => L('PUBLIC_DIR'),
			'runtime' => L('RUNTIME_DIR'),
			'tpl' => L('TEMPLATE_DIR'),
			'u' => L('UPLOAD_DIR'),
			);
		$this->assign('_TSD', $_TSD);

		$_V['tsd'] = ARequest::get('tsd') ? ARequest::get('tsd') : array(
			'api',
			'cfg',
			'core',
			'lang',
			'lib',
			'public',
			'runtime',
			'tpl',
			'u');
		$_V['file_type'] = ARequest::get('file_type') ? ARequest::get('file_type') : 'php|js';
		$_V['function_name'] = ARequest::get('function_name') ? ARequest::get('function_name') : 'eval|cmd|system|exec';
		$_V['feature_code'] = ARequest::get('feature_code') ? ARequest::get('feature_code') : '';
		$_V['verify_file'] = ARequest::get('verify_file') ? ARequest::get('verify_file') : '';
		$_V['ignore_case'] = ARequest::get('ignore_case');
		$this->assign('_V', $_V);

		/* verify file list */
		$_VFL = list_file(RUNTIME_PATH . D_S . 'verify_file', array('index.html'));
		$this->assign('_VFL', $_VFL);

		$this->display();

		if('scan' == ARequest::get('action')) {
			if(!check_token()) {
				$this->error(L('DATA_INVALID'), AServer::get_preUrl());
			}

			set_time_limit(99999999);
			$tsd = ARequest::get('tsd');
			$fileType = ARequest::get('file_type');
			$functionName = ARequest::get('function_name');
			$featureCode = ARequest::get('feature_code');
			$verifyFile = ARequest::get('verify_file') ? ARequest::get('verify_file') : '';
			$ignoreCase = ARequest::get('ignore_case') ? true : false;

			if(empty($tsd) or empty($fileType) or (empty($functionName) and empty($featureCode))) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('SCAN_CODE') . ': ' . L('INPUT_NO_EMPTY'), 0);
				$this->error(L('INPUT_NO_EMPTY'), Url::U('toolbox/scan_code'));
			}
			M('AdminLog')->add_log(ASession::get('m_userid'), L('SCAN_CODE'));

			$_var_tsf = implode('--', $tsd);
			$fileList = S($_var_tsf);
			if(empty($fileList)) {
				$fileList = array();
				foreach($tsd as $dir) {
					$fileList = array_merge($fileList, get_fileList(APP_PATH . D_S . $dir));
				}
				S($_var_tsf, $fileList);
			}

			$fileType = explode('|', $fileType);
			$functionName = !empty($functionName) ? explode('|', $functionName) : '';

			$total = count($fileList);
			$pagesize = 20;
			$i = 0;

			$verifyCode = array();
			if(!empty($verifyFile) and file_exists(RUNTIME_PATH . D_S . 'verify_file' . D_S . $verifyFile)) {
				$verifyCode = include (RUNTIME_PATH . D_S . 'verify_file' . D_S . $verifyFile);
			}

			M('Toolbox')->show_progress(L('SCAN_START'), 0);
			echo '<script>show_suspicious_file();</script>';
			@ob_flush();
			@flush();
			foreach($fileList as $k => $file) {
				if(($pagesize - 1) == ($k % $pagesize)) {
					$progress = round($k / $total * 100, 1);
					M('Toolbox')->show_progress($progress . '% [' . $k . '/' . $total . ']: ' . str_replace(APP_PATH . D_S, '', $file), $progress);
				}
				$result = M('ToolBox')->scan_code($file, $fileType, $functionName, $featureCode, $ignoreCase, $verifyCode);
				if($result['match']) {
					$k = ++$i;
					$filename = str_replace(APP_PATH . D_S, '', $file);
					$editTime = date(C('APP.TIME_FORMAT'), filemtime($file));
					$type = $result['type'];
					$feature = $result['feature'];
					$count = $result['count'];
					$verified = $result['verified'];
					$verifyInfo = $result['verify_info'];
					echo '<script>add_suspicious_file("' . $k . '", "' . $filename . '", "' . $editTime . '", "' . $type . '", "' . $feature . '", "' . $count . '", ' . $verified . ', "' . $verifyInfo . '");</script>';
					@ob_flush();
					@flush();
				}
			}
			M('Toolbox')->show_progress(L('SCAN_FINISH_TIP'), 100);
			set_time_limit(30);
		}
	}

	/* [safety check]build verify file */
	public function build_verify_file() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}
		/* to verify directory */
		$_TVD = array(
			'api',
			'cfg',
			'core',
			'lang',
			'lib',
			'public',
			'tpl');

		$_var_tvf = implode('--', $_TVD);
		$fileList = S($_var_tvf);
		if(empty($fileList)) {
			$fileList = array();
			foreach($_TVD as $dir) {
				$fileList = array_merge($fileList, get_fileList(APP_PATH . D_S . $dir));
			}
			S($_var_tvf, $fileList);
		}
		$verifiedCode = array();
		foreach($fileList as $file) {
			$verifiedCode[str_replace(APP_PATH . D_S, '', $file)] = md5_file($file);
		}

		F('verify_file/' . date('Y-m-d-H-i-s') . '.md5', $verifiedCode, RUNTIME_PATH);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_VERIFY_FILE'));
		$this->success(L('BUILD_VERIFY_FILE'), Url::U('toolbox/scan_code'));
	}
}

?>