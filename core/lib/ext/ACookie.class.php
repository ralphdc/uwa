<?php

/**
 *--------------------------------------
 * COOKIE
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ACookie {
	public static function set($name, $value = '', $key = null, $prefix = null, $expire = null, $path = null, $domain = null) {
		if(is_null($prefix)) {
			$prefix = C('COOKIE.PREFIX');
		}

		if(is_null($expire)) {
			$expire = time() + C('COOKIE.EXPIRE');
		}
		else {
			$expire = time() + $expire;
		}

		if(is_null($path)) {
			$path = C('COOKIE.PATH');
		}

		if(is_null($domain)) {
			$domain = C('COOKIE.DOMAIN');
			if(empty($domain)) {
				$domain = AServer::get_env('HTTP_HOST');
			}
		}
		if('localhost' == $domain) {
			$domain = false;
		}

		if(is_null($key)) {
			$key = C('COOKIE.KEY');
		}
		if(C('COOKIE.CLIENT_CHECK')) {
			/* save pfa cookie client id */
			$_PCCI = S('_PCCI_' . AServer::get_clientId());
			if(empty($_PCCI)) {
				S('_PCCI_' . AServer::get_clientId(), AServer::get_clientId(), $expire);
			}
			$key .= AServer::get_clientId();
		}

		$value = ACrypt::encrypt(serialize($value), $key);
		setCookie($prefix . $name, $value, $expire, $path, $domain);
	}

	public static function get($name = null, $key = null, $prefix = null) {
		if(is_null($key)) {
			$key = C('COOKIE.KEY');
		}
		if(C('COOKIE.CLIENT_CHECK')) {
			$key .= AServer::get_clientId();
		}

		if(is_null($prefix)) {
			$prefix = C('COOKIE.PREFIX');
		}

		$is_checked = 1;
		if(C('COOKIE.CLIENT_CHECK')) {
			$is_checked = self::check_clientId();
		}

		if(1 == $is_checked) {
			if(is_null($name)) {
				$_c = array();
				foreach($_COOKIE as $k => $v) {
					$_t_name = substr($k, strlen($prefix));
					if(substr($k, 0, strlen($prefix)) == $prefix) {
						$_c[$_t_name] = unserialize(ACrypt::decrypt($v, $key));
					}
				}
				return $_c;
			}
			return isset($_COOKIE[$prefix . $name]) ? unserialize(ACrypt::decrypt($_COOKIE[$prefix . $name], $key)) : '';
		}
		return '';
	}

	public static function del($name, $key = null, $prefix = null) {
		self::set($name, '', $key, $prefix, -1000);
	}

	/* clear all cookie */
	public static function clear($prefix = null) {
		if(is_null($prefix)) {
			$prefix = C('COOKIE.PREFIX');
		}
		$preLen = strlen($prefix);
		foreach($_COOKIE as $name => $val) {
			if(strpos($name, $prefix) === 0) {
				self::del(substr($name, $preLen), '', $prefix);
			}
		}
		S('_PCCI_' . AServer::get_clientId(), null);
	}

	/* check client ID */
	private static function check_clientId() {
		if(AServer::get_clientId() == S('_PCCI_' . AServer::get_clientId())) {
			return 1;
		}
		S('_PCCI_' . AServer::get_clientId(), null);
		return 0;
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>