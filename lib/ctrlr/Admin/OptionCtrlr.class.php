<?php

/**
 *--------------------------------------
 * option
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-15
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class OptionCtrlr extends ManageCtrlr {
	public function edit_option_site() {
		$_TZL = array(
			'-12' => 'GMT -12:00',
			'-11' => 'GMT -11:00',
			'-10' => 'GMT -10:00',
			'-9' => 'GMT -09:00',
			'-8' => 'GMT -08:00',
			'-7' => 'GMT -07:00',
			'-6' => 'GMT -06:00',
			'-5' => 'GMT -05:00',
			'-4' => 'GMT -04:00',
			'-3.5' => 'GMT -03:30',
			'-3' => 'GMT -03:00',
			'-2' => 'GMT -02:00',
			'-1' => 'GMT -01:00',
			'0' => 'GMT',
			'1' => 'GMT +01:00',
			'2' => 'GMT +02:00',
			'3' => 'GMT +03:00',
			'3.5' => 'GMT +03:30',
			'4' => 'GMT +04:00',
			'4.5' => 'GMT +04:30',
			'5' => 'GMT +05:00',
			'5.5' => 'GMT +05:30',
			'5.75' => 'GMT +05:45',
			'6' => 'GMT +06:00',
			'6.5' => 'GMT +06:30',
			'7' => 'GMT +07:00',
			'8' => 'GMT +08:00',
			'9' => 'GMT +09:00',
			'9.5' => 'GMT +09:30',
			'10' => 'GMT +10:00',
			'11' => 'GMT +11:00',
			'12' => 'GMT +12:00',
			'13' => 'GMT +13:00',
		);
		$this->assign('_TZL', $_TZL);

		$_LANGSET = get_langset();
		$this->assign('_LANGSET', $_LANGSET);

		$_TPL = M('Template')->get_templateList();
		$this->assign('_TPL', $_TPL);

		$_O = M('Option')->get_option(array('site'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_site_do () {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$cfgFile = CFG_PATH . D_S . 'comm.php';

		$_C = include ($cfgFile);
		$_C['APP']['TIMEZONE'] = 'Etc/GMT' . ($data['site']['timezone'] > 0 ? '-' : '+') . abs($data['site']['timezone']);
		$_C['APP']['TIME_FORMAT'] = $data['site']['time_format'];
		/* language */
		$_C['LANG']['NAME'] = $data['site']['language'];
		$_C['LANG']['DETECT'] = $data['site']['lang_detect'] ? true : false;
		/* template */
		$_C['TE']['TPL_DETECT_USER_AGENT'] = $data['site']['mobile_version'] ? true : false;
		$_C['TE']['TPL_THEME'] = $data['site']['theme'];
		$_C['TE']['TPL_PROTECTION'] = $data['site']['tpl_protection'] ? true : false;
		$_C['TE']['GZIP'] = $data['core']['gzip_switch'] ? true : false;

		$content = var_export($_C, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";
		if(!@file_put_contents($cfgFile, $content)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_SITE') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('option/edit_option'));
		}

		if(file_exists(RUNTIME_PATH . D_S . '~runtime.php')) {
			@unlink(realpath(RUNTIME_PATH . D_S . '~runtime.php'));
		}

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_SITE'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_site'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_SITE'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_site'));
	}

	public function edit_option_core() {
		$_O = M('Option')->get_option(array('core'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_core_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$cfgFile = CFG_PATH . D_S . 'comm.php';

		$_C = include ($cfgFile);
		/* template */
		$_C['TE']['GZIP'] = $data['core']['gzip_switch'] ? true : false;
		/* cache */
		$_C['CACHE']['EXPIRE'] = intval($data['core']['cache_expire']);
		/* HTML */
		$_C['HTML']['DIR'] = $data['core']['html_path'];
		/* cookie, session */
		$_C['COOKIE']['PREFIX'] = $data['core']['cookie_prefix'];
		$_C['COOKIE']['EXPIRE'] = intval($data['core']['cookie_expire']);
		$_C['COOKIE']['KEY'] = $data['core']['cookie_key'];
		$_C['SESSION']['PREFIX'] = $data['core']['cookie_prefix'];
		/* debug switch */
		$_C['DEBUG']['SWITCH'] = $data['core']['debug_switch'] ? true : false;
		$_C['DEBUG']['STAT'] = $data['core']['debug_stat'] ? true : false;
		$_C['DEBUG']['PAGE_TRACE'] = $data['core']['debug_page_trace'] ? true : false;
		/* url host prefix */
		$_C['URL']['HOST_PREFIX'] = $data['core']['host_prefix_switch'] ? true : false;
		/* rewrite */
		if(1 == $data['core']['rewrite_switch']) {
			$_C['URL']['TYPE'] = 3;
		}
		else {
			$_C['URL']['TYPE'] = 1;
		}

		$content = var_export($_C, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";
		if(!@file_put_contents($cfgFile, $content)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_CORE') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('option/edit_option_core'));
		}

		if(file_exists(RUNTIME_PATH . D_S . '~runtime.php')) {
			@unlink(realpath(RUNTIME_PATH . D_S . '~runtime.php'));
		}

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_CORE'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_core'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_CORE'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_core'));
	}

	public function edit_option_index() {
		$_O = M('Option')->get_option(array('index'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_index_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_INDEX'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_index'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_INDEX'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_index'));
	}

	public function edit_option_performance() {
		$_O = M('Option')->get_option(array('performance'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_performance_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$cfgFile = CFG_PATH . D_S . 'comm.php';

		$_C = include ($cfgFile);

		/* cache */
		$_C['CACHE']['TYPE'] = $data['performance']['cache_type'];
		$_C['CACHE']['MEMCACHE_HOST'] = $data['performance']['memcache_host'];
		$_C['CACHE']['MEMCACHE_PORT'] = intval($data['performance']['memcache_port']);

		$content = var_export($_C, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";
		if(!@file_put_contents($cfgFile, $content)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_PERFORMANCE') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('option/edit_option_performance'));
		}

		if(file_exists(RUNTIME_PATH . D_S . '~runtime.php')) {
			@unlink(realpath(RUNTIME_PATH . D_S . '~runtime.php'));
		}

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_PERFORMANCE'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_performance'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_PERFORMANCE'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_performance'));
	}

	public function edit_option_upload() {
		$_O = M('Option')->get_option(array('upload'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_upload_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_UPLOAD'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_upload'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_UPLOAD'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_upload'));
	}

	public function edit_option_image() {
		$_O = M('Option')->get_option(array('image'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_image_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_IMAGE'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_image'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_IMAGE'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_image'));
	}

	public function edit_option_member() {
		$_O = M('Option')->get_option(array('member'));
		$this->assign('_O', $_O);

		/* member credit type */
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);

		$this->display();
	}
	public function edit_option_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_MEMBER'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_member'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_MEMBER'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_member'));
	}

	public function edit_option_interaction() {
		$_O = M('Option')->get_option(array('interaction'));
		$this->assign('_O', $_O);

		$this->display();
	}
	public function edit_option_interaction_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_INTERACTION'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_option_interaction'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_OPTION_INTERACTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_option_interaction'));
	}

	public function edit_custom_option() {
		/* custom option */
		$_CO = M('Option')->where(array('o_type' => array('EQ', 1)))->select();
		$this->assign('_CO', $_CO);

		$this->display();
	}
	public function edit_custom_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('Option')->save_option($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_OPTION'), 0);
			$this->error(L('EDIT_FAILED'), Url::U('option/edit_custom_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CUSTOM_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('option/edit_custom_option'));
	}

	public function add_custom_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$_t_co = M('Option')->where(array('o_key' => array('EQ', $data['o_key'])))->find();
		if(!empty($_t_co)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_OPTION') . ': OPTION_TITLE[' . $data['o_title'] . ']' . L('EXIST'), 0);
			$this->error(L('ADD_FAILED') . ': ' . L('CUSTOM_OPTION_EXIST'), Url::U('option/edit_custom_option'));
		}

		if('bool' == $data['o_value_type']) {
			$data['o_value'] = strtoupper($data['o_value']);
			if('Y' != $data['o_value'] && 'N' != $data['o_value']) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_OPTION') . ': OPTION_TITLE[' . $data['o_title'] . ']', 0);
				$this->error(L('ADD_FAILED') . ': ' . L('PARAMS_ERROR'), Url::U('option/edit_custom_option'));
			}
		}

		$data['o_type'] = 1;
		$result = M('Option')->insert($data);

		if(false === $result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_OPTION') . ': ' . $result['error'], 0);
			$this->error(L('ADD_FAILED'), Url::U('option/edit_custom_option'));
		}

		F('~_O', null);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CUSTOM_OPTION') . ': OPTION_TITLE[' . $data['o_title'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('option/edit_custom_option'));
	}

	public function delete_custom_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$oKey = ARequest::get('o_key');
		$_t_o = M('Option')->where(array('o_type' => array('EQ', 1), 'o_key' => array('EQ', $oKey)))->find();
		if(empty($_t_o)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_OPTION') . ': KEY[' . $oKey . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('option/edit_custom_option'));
		}

		$result = M('Option')->where(array('o_type' => array('EQ', 1), 'o_key' => array('EQ', $oKey)))->delete();

		if(false === $result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_OPTION') . ': KEY[' . $oKey . ']', 0);
			$this->error(L('DELETE_FAILED'), Url::U('option/edit_custom_option'));
		}

		F('~_O', null);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CUSTOM_OPTION') . ': KEY[' . $oKey . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('option/edit_custom_option'));
	}

}

?>