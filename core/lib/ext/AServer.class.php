<?php

/**
 *--------------------------------------
 * server information
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AServer {
	/* get client IP address */
	public static function get_ip() {
		$ip = '';
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			if($ip) {
				array_unshift($ips, $ip);
				$ip = '';
			}
			for($i = 0; $i < count($ips); $i++) {
				if(!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) {
					$ip = $ips[$i];
					break;
				}
			}
		}
		$ip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];
		$long = sprintf("%u", ip2long($ip));
		return $long ? $ip : '0.0.0.0';
	}

	/* get client browser previous url */
	public static function get_preUrl() {
		return $_SERVER['HTTP_REFERER'];
	}

	/* get client request timestamp */
	public static function get_time() {
		if(self::check_phpVersion('5.1.0')) {
			return self::get_env('REQUEST_TIME');
		}
		else {
			return time();
		}
	}

	/* build client ID */
	public static function get_clientId() {
		return md5(self::get_ip() . self::get_env('HTTP_USER_AGENT'));
	}

	/* get enviorment information */
	public static function get_env($varName) {
		if(isset($_SERVER[$varName])) {
			return $_SERVER[$varName];
		}
		elseif(isset($_ENV[$varName])) {
			return $_ENV[$varName];
		}
		elseif(getenv($varName)) {
			return getenv($varName);
		}
		elseif(function_exists('apache_getenv') && apache_getenv($varName, true)) {
			return apache_getenv($varName, true);
		}
		return '';
	}

	/* send http status */
	public static function send_http_status($code) {
		static $_status = array(
			200 => 'OK',
 			/** Success 2xx */
			/* Redirection 3xx */
			301 => 'Moved Permanently',
			302 => 'Moved Temporarily ',
 			/* 1.1 */
			/* Client Error 4xx */
			400 => 'Bad Request',
			403 => 'Forbidden',
			404 => 'Not Found',
			/* Server Error 5xx */
			500 => 'Internal Server Error',
			503 => 'Service Unavailable',
			);
		if(isset($_status[$code])) {
			header('HTTP/1.1 ' . $code . ' ' . $_status[$code]);
			header('Status:' . $code . ' ' . $_status[$code]); // Ensure normal under FastCGI mode
		}
	}

	/* check server php version */
	public static function check_phpVersion($version) {
		/* get current server php version */
		$locVersion = phpversion();

		$result = version_compare($locVersion, $version);
		return ($result >= 0) ? true : false;
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>