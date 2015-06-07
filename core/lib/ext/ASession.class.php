<?php

/**
 *--------------------------------------
 * session
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

$session_id = ARequest::get(session_name());
if(!empty($session_id)) {
	session_id($session_id);
}
if(!isset($_SESSION)) {
	session_start();
}

class ASession {
	public static function set($name, $value = '') {
		$prefix = C('SESSION.PREFIX');

		if(C('SESSION.CLIENT_CHECK')) {
			$_SESSION[$prefix . 'cliend_id'] = AServer::get_clientId();
		}

		$_SESSION[$prefix . $name] = $value;
	}

	public static function get($name = null) {
		$prefix = C('SESSION.PREFIX');

		$is_checked = 1;
		if(C('SESSION.CLIENT_CHECK')) {
			$is_checked = self::check_clientId();
		}

		if(1 == $is_checked) {
			if(is_null($name)) {
				$_s = array();
				foreach($_SESSION as $k => $v) {
					$_t_name = substr($k, strlen($prefix));
					if((substr($k, 0, strlen($prefix)) == $prefix) and 'client_id' != $_t_name) {
						$_s[$_t_name] = $v;
					}
				}
				return $_s;
			}
			return isset($_SESSION[$prefix . $name]) ? $_SESSION[$prefix . $name] : '';
		}
		elseif(0 == $is_checked) {
			self::del($prefix . 'cliend_id');
		}
		return '';
	}

	public static function del($name) {
		$prefix = C('SESSION.PREFIX');
		unset($_SESSION[$prefix . $name]);
	}

	/* clear session */
	public static function clear() {
		return session_destroy();
	}

	/* session client verify */
	private static function check_clientId() {
		$prefix = C('SESSION.PREFIX');
		$key = C('SESSION.KEY');
		if(isset($_SESSION[self::$prefix . 'cliend_id'])) {
			if(AServer::get_clientId() == $_SESSION[$prefix . 'client_id']) {
				return 1;
			}
			return 0;
		}
		return - 1;
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>