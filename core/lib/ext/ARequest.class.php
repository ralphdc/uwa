<?php

/**
 *--------------------------------------
 * $_GET,$_POST data
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ARequest {
	public static function get($key = null, $type = null) {
		if(is_null($key)) {
			if(is_null($type)) {
				return array_merge($_POST, $_GET);
			}
			elseif('post' == $type) {
				return $_POST;
			}
			elseif('get' == $type) {
				return $_GET;
			}
		}
		if(is_null($type)) {
			if(isset($_GET[$key])) {
				return $_GET[$key];
			}
			elseif(isset($_POST[$key])) {
				return $_POST[$key];
			}
			return '';
		}
		elseif('get' == $type && isset($_GET[$key])) {
			return $_GET[$key];
		}
		elseif('post' == $type && isset($_POST[$key])) {
			return $_POST[$key];
		}
		return '';
	}

	public static function set($key, $value, $type = 'get') {
		if('get' == $type) {
			$_GET[$key] = $value;
		}
		elseif('post' == $type) {
			$_POST[$key] = $value;
		}
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>