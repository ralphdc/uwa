<?php

/**
 *--------------------------------------
 * login
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-3
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class LoginCtrlr extends Ctrlr {
	public function __construct() {
		parent::__construct();

		/* check entry */
		session_start();
		if(!isset($_SESSION['admin_enter']) or 1 != $_SESSION['admin_enter']) {
			redirect(Url::U('home@index/index'));
			exit();
		}

		$timeKey = time();
		$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));
		$this->assign('_TK', $_TK);
	}

	public function index() {
		if(ASession::get('admin_id') and 'on' != ASession::get('LOCK_SCREEN_SWITCH')) {
			redirect(Url::U('index/index'));
		}

		$_LANGSET = get_langset();
		$this->assign('_LANGSET', $_LANGSET);
		$hal = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5));
		$this->assign('hal', $hal);

		/* Manage Captcha Switch */
		$mcs = M('Option')->get_option('interaction/manage_captcha');
		$this->assign('mcs', $mcs);

		$this->display('admin/login');
	}

	public function login_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction('login', true);

		$maxTryTimes = 9; /* max try time */
		$lockIntervalTime = 600; /* login interval time */

		$lockTime = F('~lock_time/~' . AServer::get_ip());

		if(time() - ($lockTime + $lockIntervalTime) < 0) {
			$timeLeft = intval((F('~lock_time/~' . AServer::get_ip()) + $lockIntervalTime - time()) / 60) + 1;
			$info = L('LOCK_TIME_LEFT_TIPS', null, array('time_left' => $timeLeft));
			$this->error($info, AServer::get_preUrl());
		}

		if(!AFilter::is_userid(ARequest::get('m_userid'))) {
			M('AdminLog')->add_log(AFilter::plain_text(ARequest::get('m_userid')) . '', L('LOGIN'), 0);
			$this->error(L('VERIFY_FAILED'), AServer::get_preUrl());
		}

		$mUserid = strtolower(ARequest::get('m_userid'));
		$where['__MEMBER__.m_userid'] = array('EQ', $mUserid);
		$where['__MEMBER__.m_password'] = array('EQ', md5($mUserid . ARequest::get('password')));
		$_MI = M('Member')->join('__ADMIN__ AS a ON a.member_id = __MEMBER__.member_id')->join('__ADMIN_ROLE__ AS ar ON ar.admin_role_id = a.admin_role_id')->where($where)->find();
		if(empty($_MI['admin_role_id'])) {
			M('AdminLog')->add_log($mUserid, L('LOGIN'), 0);

			$timesLeft = $maxTryTimes - ASession::get('err_times');
			if(0 < $timesLeft) {
				ASession::set('err_times', ASession::get('err_times') + 1);
				$info = L('CHECK_SCREEN_LOCK_TIMES_LEFT_TIPS', null, array('times_left' => $timesLeft));
				$this->error($info, Url::U('login/index'));
			}
			F('~lock_time/~' . AServer::get_ip(), time());
			ASession::set('err_times', 0);
			$timeLeft = intval($lockIntervalTime / 60);
			$info = L('LOCK_TIME_LEFT_TIPS', null, array('time_left' => $timeLeft));
			$this->error($info, Url::U('login/index'));
		}

		/* update login information */
		$data['admin_id'] = $_MI['admin_id'];
		$data['a_login_time'] = time();
		$data['a_login_ip'] = AServer::get_ip();
		M('Admin')->update($data);

		ASession::set('admin_id', $_MI['admin_id']);
		ASession::set('member_id', $_MI['member_id']);
		ASession::set('m_userid', $_MI['m_userid']);
		ASession::set('m_username', $_MI['m_username']);
		ASession::set('m_status', $_MI['m_status']);
		ASession::set('member_level_id', $_MI['member_level_id']);
		ASession::set('ar_name', $_MI['ar_name']);
		ASession::set('admin_role_id', $_MI['admin_role_id']);

		$langset = require PFA_PATH . '/comm/langset.php';
		$lang = strtolower(ARequest::get(C('VAR.LANG')));
		if(!empty($lang) and array_key_exists($lang, $langset)) {
			ACookie::set('lang', $lang);
		}

		/* unlock screen, clear error time */
		ASession::set('LOCK_SCREEN_SWITCH', 'off');
		ASession::set('err_times', 0);
		F('~lock_time/~' . AServer::get_ip(), null);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('LOGIN'));

		$this->success(L('LOGIN_SUCCESS'), AServer::get_preUrl());
	}

	public function lock_screen() {
		ASession::set('LOCK_SCREEN_SWITCH', 'on');
	}
	public function check_screen_lock() {
		$data = 0;

		$maxTryTimes = 9; /* max try time */
		$lockIntervalTime = 600; /* login interval time */
		$lockTime = F('~lock_time/~' . AServer::get_ip());

		if(time() - ($lockTime + $lockIntervalTime) < 0) {
			$timeLeft = intval((F('~lock_time/~' . AServer::get_ip()) + 600 - time()) / 60) + 1;
			$info = L('LOCK_TIME_LEFT_TIPS', null, array('time_left' => $timeLeft));
			$this->ajax_return(array('data' => $data, 'info' => $info));
		}

		$lockPassword = ARequest::get('lock_password');
		$where['__MEMBER__.m_userid'] = array('EQ', ASession::get('m_userid'));
		$where['__MEMBER__.m_password'] = array('EQ', md5(ASession::get('m_userid') . md5($lockPassword)));
		$_MI = M('Member')->join('__ADMIN__ AS a ON a.member_id = __MEMBER__.member_id')->join('__ADMIN_ROLE__ AS ar ON ar.admin_role_id = a.admin_role_id')->where($where)->find();
		if(empty($_MI['admin_role_id'])) {
			$timesLeft = $maxTryTimes - ASession::get('err_times');
			if(0 < $timesLeft) {
				ASession::set('err_times', ASession::get('err_times') + 1);
				$info = L('CHECK_SCREEN_LOCK_TIMES_LEFT_TIPS', null, array('times_left' => $timesLeft));
				$this->ajax_return(array('data' => $data, 'info' => $info));
			}
			F('~lock_time/~' . AServer::get_ip(), time());
			ASession::set('err_times', 0);
			$timeLeft = intval($lockIntervalTime / 60);
			$info = L('LOCK_TIME_LEFT_TIPS', null, array('time_left' => $timeLeft));
			$this->ajax_return(array('data' => $data, 'info' => $info));
		}
		$data = 1;
		$info = L('LOGIN_SUCCESS');
		ASession::set('LOCK_SCREEN_SWITCH', 'off');
		ASession::set('err_times', 0);
		F('~lock_time/~' . AServer::get_ip(), null);
		$this->ajax_return(array('data' => $data, 'info' => $info));
	}

	public function logout_do() {
		ASession::clear();
		$this->success(L('LOGOUT_SUCCESS'), Url::U('login/index'));
	}
}

?>