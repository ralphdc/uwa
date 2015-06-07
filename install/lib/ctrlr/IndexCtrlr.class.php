<?php

/**
 *--------------------------------------
 * install
 *--------------------------------------
 * @project		: install
 * @author		: cblee
 * @created		: 2013-12-27
 * @copyright	: (c)2013 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class IndexCtrlr extends Ctrlr{
	public function index() {
		check_lock();

		if(!isset($_GET[C('VAR.LANG')])) {
			$this->step0();
		}
		else {
			$step = isset($_POST['step']) ? $_POST['step'] : 1;
			switch ($step) {
				case '1':
					$this->step1();
					break;
				case '2':
					$this->step2();
					break;
				case '3':
					$this->step3();
					break;
				case '4':
					$this->step4();
					break;
				case '5':
					$errorMessage = check_post(array($_POST['founderName'],$_POST['founderPassword']));
					$errorMessage .= check_db($_POST['dbHost'], $_POST['dbPort'], $_POST['dbUser'], $_POST['dbPassword'], $_POST['dbDatabase'], $_POST['dbPrefix'], $_POST['dbConnection']);
					if('' != $errorMessage) {
						$this->step4($errorMessage);
					}
					else {
						$this->step5();
					}
					break;
				case '6':
					$this->step6();
					break;
				default:
					$this->step1();
					break;
			}
		}
	}

	/* choose language */
	private function step0() {
		$_LANGSET = get_langset();
		$selectHight = count($_LANGSET) > 5 ? count($_LANGSET) : 5;
		$hal = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5));
		$this->assign('selectHight', $selectHight);
		$this->assign('hal', $hal);
		$this->assign('_LANGSET', $_LANGSET);
		$this->display('index');
	}

	/* show introduce */
	private function step1() {
		$this->display('step1');
	}

	/* show license */
	private function step2() {
		$this->display('step2');
	}

	/* check environment */
	private function step3() {
		$checkNextStep = true;

		/* check system */
		$systemItems = C('CHECK_ITEMS.SYSTEM');
		if(!empty($systemItems)) {
			check_system($systemItems, $checkNextStep);
			foreach($systemItems as $k => $v) {
				$systemItems[L($k)]['r'] = L($v['r']);
				$systemItems[L($k)]['b'] = L($v['b']);
				$systemItems[L($k)]['c'] = L($v['c']);
				if(1 == $v['s']) {
					$systemItems[L($k)]['c_c'] = 'class="y"';
				}
				else {
					$systemItems[L($k)]['c_c'] = 'class="n"';
				}
				unset($systemItems[$k]);
			}
		}

		/* check dir and file */
		$dirFileItems = C('CHECK_ITEMS.DIR_FILE');
		if(!empty($dirFileItems)) {
			check_dirfile($dirFileItems, $checkNextStep);
			foreach($dirFileItems as $k => $v) {
				$dirFileItems[L($k)]['type'] = L($v['type']);
				$dirFileItems[L($k)]['c'] = L($v['c']);
				$dirFileItems[L($k)]['path'] = $v['path'];
				if(1 == $v['s']) {
					$dirFileItems[L($k)]['c_c'] = 'class="y"';
				}
				else {
					$dirFileItems[L($k)]['c_c'] = 'class="n"';
				}
				unset($dirFileItems[$k]);
			}
		}

		/* check php config */
		$phpConfigItems = C('CHECK_ITEMS.PHP_CONFIG');
		if(!empty($phpConfigItems)) {
			check_php_config($phpConfigItems, $checkNextStep);
			foreach($phpConfigItems as $k => $v) {
				if(1 == $v['s']) {
					$phpConfigItems[$k]['c_c'] = 'class="y"';
				}
				else {
					$phpConfigItems[$k]['c_c'] = 'class="n"';
				}
			}
		}

		/* check extension */
		$extensionItems = C('CHECK_ITEMS.EXTENSION');
		if(!empty($extensionItems)) {
			check_extension($extensionItems, $checkNextStep);
			foreach($extensionItems as $k => $v) {
				if(1 == $v['s']) {
					$extensionItems[$k]['c_c'] = 'class="y"';
					$extensionItems[$k]['s'] = L('SUPPORT');
				}
				else {
					$extensionItems[$k]['c_c'] = 'class="n"';
					$extensionItems[$k]['s'] = L('NONSUPPORT');
				}
			}
		}

		/* check function */
		$functionItems = C('CHECK_ITEMS.FUNCTION');
		if(!empty($functionItems)) {
			check_function($functionItems, $checkNextStep);
			foreach($functionItems as $k => $v) {
				if(1 == $v['s']) {
					$functionItems[$k]['c_c'] = 'class="y"';
					$functionItems[$k]['s'] = L('SUPPORT');
				}
				else {
					$functionItems[$k]['c_c'] = 'class="n"';
					$functionItems[$k]['s'] = L('NONSUPPORT');
				}
			}
		}

		$this->assign('checkNextStep', $checkNextStep);
		$this->assign('systemItems', $systemItems);
		$this->assign('dirFileItems', $dirFileItems);
		$this->assign('phpConfigItems', $phpConfigItems);
		$this->assign('extensionItems', $extensionItems);
		$this->assign('functionItems', $functionItems);
		$this->display('step3');
	}

	/* setup installation */
	private function step4($errorMessage = '') {
		$formV['dbHost'] = isset($_POST['dbHost']) ? $_POST['dbHost'] : 'localhost';
		$formV['dbPort'] = isset($_POST['dbPort']) ? $_POST['dbPort'] : '3306';
		$formV['dbUser'] = isset($_POST['dbUser']) ? $_POST['dbUser'] : 'root';
		$formV['dbPassword'] = isset($_POST['dbPassword']) ? $_POST['dbPassword'] : '';
		$formV['dbDatabase'] = isset($_POST['dbDatabase']) ? $_POST['dbDatabase'] : strtolower(SOFT_NAME);
		$formV['dbPrefix'] = isset($_POST['dbPrefix']) ? $_POST['dbPrefix'] : strtolower(SOFT_NAME).str_replace('.', '', strtolower(SOFT_CODENAME)) . '_';
		$formV['dbConnection'] = isset($_POST['dbConnection']) ? $_POST['dbConnection'] : 'mysql';
		$formV['founderName'] = isset($_POST['founderName']) ? $_POST['founderName'] : 'admin';
		$formV['founderEmail'] = isset($_POST['founderEmail']) ? $_POST['founderEmail'] : 'admin@admin.com';
		$formV['founderPassword'] = isset($_POST['founderPassword']) ? $_POST['founderPassword'] : '';
		$formV['cookieKey'] = isset($_POST['cookieKey']) ? $_POST['cookieKey'] : random(16);
		$this->assign('formV', $formV);
		$this->assign('errorMessage', $errorMessage);
		$this->display('step4');
	}

	/* write data */
	private function step5() {
		/* replace admin info */
		$administrator = strtolower(ARequest::get('founderName'));
		$password = md5(strtolower(ARequest::get('founderName')).md5(ARequest::get('founderPassword')));
		$email = ARequest::get('founderEmail');
		$cookieKey = trim(ARequest::get('cookieKey'));
		$_sl = strlen($cookieKey);
		$sql = file_get_contents(SQL_FILE);
		$sql = str_replace(
			array(
				'{-time-}',
				'{-ip-}',
				'{-ausr-}',
				'{-apwd-}',
				'{-email-}',
				'{-site_url-}',
				's:8:"{-cookie_key-}";'
			),
			array(
				time(),
				AServer::get_ip(),
				$administrator,
				$password,
				$email,
				SITE_URL,
				's:' . $_sl . ':"' . $cookieKey . '";'
			),
			$sql);
		@file_put_contents(DATA_PATH . D_S . '~data.sql', $sql);

		$this->display('step5');

		connect_db($_POST['dbHost'] . ':' . $_POST['dbPort'], $_POST['dbUser'], $_POST['dbPassword'], $_POST['dbDatabase']);
		run_sql(DATA_PATH . D_S . '~data.sql');

		$siteSeed = random(16);
		$define = array(
			'SOFT_NAME' => SOFT_NAME,
			'SOFT_CODENAME' => SOFT_CODENAME,
			'SOFT_VERSION' => SOFT_VERSION,
			'SOFT_CHARSET' => SOFT_CHARSET,
			'SOFT_AUTHOR' => SOFT_AUTHOR,
			'SOFT_AUTHOR_URL' => SOFT_AUTHOR_URL,
			'SOFT_OFFICIAL_FORUM_URL' => SOFT_OFFICIAL_FORUM_URL,
			'SOFT_ONLINE_MANUAL_URL' => SOFT_ONLINE_MANUAL_URL,
			'SOFT_UPGRADE_URL' => SOFT_UPGRADE_URL,
			'SOFT_AUTHORIZATION_URL' => SOFT_AUTHORIZATION_URL,
			'SOFT_SEED' => $siteSeed
		);
		save_define_file(DEFINE_FILE, $define);

		$_C = include(CONFIG_FILE);
		$_C['DB']['TYPE'] = $_POST['dbConnection'];
		$_C['DB']['USER'] = $_POST['dbUser'];
		$_C['DB']['PWD'] = $_POST['dbPassword'];
		$_C['DB']['HOST'] = $_POST['dbHost'];
		$_C['DB']['PORT'] = $_POST['dbPort'];
		$_C['DB']['NAME'] = $_POST['dbDatabase'];
		$_C['DB']['CHARSET'] = SOFT_DB_CHARSET;
		$_C['DB']['PREFIX'] = $_POST['dbPrefix'];
		$_C['COOKIE']['KEY'] = $_POST['cookieKey'];
		save_config_file(CONFIG_FILE, $_C);
		/* delete temp files */
		@unlink(DATA_PATH . D_S . '~data.sql');
		$runtimeFile = dirname(APP_PATH) . D_S . 'runtime' . D_S . '~runtime.php';
		@unlink($runtimeFile);

		/* update extension install lock file datetime */
		$dh = dir(dirname(APP_PATH) . D_S . 'runtime' . D_S . 'extension');
		while(false !== ($filename = $dh->read())) {
			if(preg_match("/\.install\.lock\.php$/", $filename)) {
				touch(dirname(APP_PATH) . D_S . 'runtime' . D_S . 'extension' . D_S. $filename);
			}
		}
		$dh->close();
	}

	/* lock installation */
	private function step6() {
		lock();
		$this->display('step6');
	}

}
?>