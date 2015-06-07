<?php

/**
 *--------------------------------------
 * manage index
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-28
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class IndexCtrlr extends ManageCtrlr {
	public function index() {
		$_M = M('Index')->get_manageMenu();
		$this->assign('_M', $_M);

		$_SL = array();
		$_t_file = CFG_PATH . D_S . 'shortcut' . D_S . ASession::get('admin_id') . '.php';
		if(is_file($_t_file)) {
			$_SL = require_cache($_t_file);
		}
		$this->assign('_SL', $_SL);
		$this->display('admin/index');
	}

	public function show_system_info() {
		/* Site Safe Tips */
		$_SST = array();
		if(file_exists(APP_PATH . D_S . 'admin.php')) {
			$_SST[] = L('MANAGEMENT_FILE_RENAMING_TIP');
		}
		if(file_exists(APP_PATH . D_S . 'install')) {
			$_SST[] = L('INSTALL_DIR_EXIST_TIP');
		}
		if(file_exists(APP_PATH . D_S . 'upgrade')) {
			$_SST[] = L('UPGRADE_DIR_EXIST_TIP');
		}
		$this->assign('_SST', $_SST);

		$_SL = array();
		$_t_file = CFG_PATH . D_S . 'shortcut' . D_S . ASession::get('admin_id') . '.php';
		if(is_file($_t_file)) {
			$_SL = require_cache($_t_file);
		}
		$this->assign('_SL', $_SL);
		$_SS = '';
		if(!empty($_SL)) {
			foreach($_SL as $s) {
				$_SS .= '[' . $s['shortcut_title'] . '|' . $s['shortcut_icon'] . '|' . $s['shortcut_url'] . "]\r\n\r\n";
			}
		}
		$this->assign('_SS', $_SS);

		/* Content Stat */
		$_CS['member']['all'] = M('Member')->count();
		$_CS['member']['not_passed'] = M('Member')->where(array('m_status' => array('EQ', 0)))->count();
		$_CS['archive']['all'] = M('Archive')->count();
		$_CS['archive']['not_passed'] = M('Archive')->where(array('a_status' => array('EQ', 0)))->count();
		$_CS['archive_review']['all'] = M('ArchiveReview')->count();
		$_CS['archive_review']['not_passed'] = M('ArchiveReview')->where(array('ar_status' => array('EQ', 0)))->count();
		$_CS['report']['all'] = M('Report')->count();
		$_CS['report']['not_deal'] = M('Report')->where(array('r_status' => array('EQ', 0)))->count();
		$_CS['flink']['all'] = M('Flink')->count();
		$_CS['flink']['not_passed'] = M('Flink')->where(array('f_status' => array('EQ', 0)))->count();
		$_CS['guestbook']['all'] = M('Guestbook')->count();
		$_CS['guestbook']['not_passed'] = M('Guestbook')->where(array('g_status' => array('EQ', 0)))->count();
		$_CS['single_page']['all'] = M('SinglePage')->count();
		$this->assign('_CS', $_CS);

		/* System Environment*/
		$_SE['os'] = PHP_OS;
		$_SE['server_software'] = AServer::get_env('SERVER_SOFTWARE');
		$mysqlInfo = M()->query('SELECT VERSION() AS version;');
		$_SE['mysql_version'] = $mysqlInfo[0]['version'];
		$_SE['php_version'] = @phpversion();
		$gdInfo = function_exists('gd_info') ? gd_info() : array('GD Version' => L('NONSUPPORT'));
		$_SE['gd_version'] = $gdInfo['GD Version'];
		$_SE['safe_mode'] = get_cfg_var('safe_mode') ? L('ON') : L('OFF');
		$_SE['register_globals'] = get_cfg_var('safe_register_globals') ? L('ON') : L('OFF');
		$_SE['magic_quoter_gpc'] = get_cfg_var('magic_quotes_gpc') ? L('ON') : L('OFF');
		$_SE['allow_url_fopen'] = get_cfg_var('allow_url_fopen') ? L('SUPPORT') : L('NONSUPPORT');
		$_SE['upload_max_size'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : L('UNKOWN');
		$this->assign('_SE', $_SE);

		/* Latest Archive */
		$_LAL = M('Archive')->get_archiveList('', '`a_edit_time` DESC', 9);
		$this->assign('_LAL', $_LAL);

		/* Latest Admin Log */
		$_LMLL = M('AdminLog')->get_logList('', '`al_time` DESC', 3);
		$this->assign('_LMLL', $_LMLL);

		$this->display('admin/show_system_info');
	}

	public function add_shortcut_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_SL = array();
		$_t_file = CFG_PATH . D_S . 'shortcut' . D_S . ASession::get('admin_id') . '.php';
		if(is_file($_t_file)) {
			$_SL = require_cache($_t_file);
		}
		$data = ARequest::get();
		if(empty($data['shortcut_icon'])) {
			$data['shortcut_icon'] = 'default';
		}
		$_SL[] = $data;
		$result = file_put_contents($_t_file, "<?php\r\nreturn " . var_export($_SL, true) . ";\r\n?>");
		if(!$result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_SHORTCUT') . ': TITLE[' . $data['shortcut_title'] . ']', 0);
			$this->error(L('ADD_FAILED'), Url::U('index/show_system_info'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_SHORTCUT') . ': TITLE[' . $data['shortcut_title'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('index/show_system_info'));
	}

	public function manage_shortcut_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_SL = array();
		$_t_file = CFG_PATH . D_S . 'shortcut' . D_S . ASession::get('admin_id') . '.php';
		$data = ARequest::get();
		$data = $data['shortcut_set'];
		if(MAGIC_QUOTES_GPC) {
			$data = stripslashes($data);
		}
		$pattern = '/\[(\S+)\|(\S+)\|(\S+)\]/isU';
		$titles = '';
		if(preg_match_all($pattern, $data, $result)) {
			unset($result[0]);
			foreach($result[1] as $k => $v) {
				$_SL[$k] = array(
					'shortcut_title' => $v,
					'shortcut_icon' => $result[2][$k],
					'shortcut_url' => $result[3][$k],
					);
				$titles .= $v . ', ';
			}
			$titles = trim($titles, ', ');
		}

		$result = file_put_contents($_t_file, "<?php\r\nreturn " . var_export($_SL, true) . ";\r\n?>");
		if(!$result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_SHORTCUT') . ': TITLE[' . $titles . ']', 0);
			$this->error(L('EDIT_FAILED'), Url::U('index/show_system_info'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_SHORTCUT') . ': TITLE[' . $titles . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('index/show_system_info'));
	}

	/* check new version */
	public function check_new_version() {
		vendor('Snoopy#class');
		$s = get_instance('Snoopy');
		$s->agent = $_SERVER['HTTP_USER_AGENT'];
		$s->rawheaders['X_FORWARDED_FOR'] = AServer::get_ip();
		$s->expandlinks = true;
		$s->read_timeout = 18;

		$type = ARequest::get('type') ? ARequest::get('type') : 'manual';

		$latestCheckTime = F('~latest_version_check_time', '', RUNTIME_PATH);
		if('system' == $type) {
			if((time() > $latestCheckTime + 86400 * 7) or time() < $latestCheckTime) {
				$_l = get_licence();
				if(is_array($_l)) {
					//define(SOFT_AUTHORIZATION_VALIDATE_URL, 'http://ac.as' . 'this.net/api/validate.php');
					define(SOFT_AUTHORIZATION_VALIDATE_URL, '');
					$_l['soft'] = SOFT_NAME;
					$_l['soft_codename'] = SOFT_CODENAME;
					$s->submit(SOFT_AUTHORIZATION_VALIDATE_URL, $_l);
					if(200 == $s->status and 'invalid' == $s->results) {
						@unlink(CFG_PATH . D_S . substr(md5(AServer::get_env('SERVER_NAME')), 0, 16) . '.cer');
					}
				}
				F('~latest_version_check_time', time(), RUNTIME_PATH);
			}
		}

		$data = 0;
		$info = '';
		if('manual' == $type or ('system' == $type and ((time() > $latestCheckTime + 86400 * 7) or time() < $latestCheckTime))) {
			$s->fetch(SOFT_UPGRADE_URL);
			if(200 == $s->status) {
				$pattern = '|(\d+\.\d+\.\d+).\d+|';
				if(preg_match($pattern, $s->results, $result)) {
					$latestVersion = $result[0];
					if(1 == strcmp($latestVersion, SOFT_VERSION)) {
						$data = 1;
						$info = $latestVersion;
					}
				}
			}
		}

		$this->ajax_return(array('data' => $data, 'info' => $info));
	}
}

?>