<?php

/**
 *--------------------------------------
 * log
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Log extends Pfa {
	public static $log = array();
	public static $format = '[c]';

	/* record log */
	public static function record($message) {
		$now = date(self::$format);
		self::$log[] = "{$now} | URI:" . $_SERVER['REQUEST_URI'] . " | {$message}\r\n";
	}

	/* save log, reference error_log() */
	public static function save($type = 3, $destination = '', $extra = '') {
		if(empty($destination)) {
			$destination = LOG_PATH . D_S . date('y_m_d') . '.log';
		}
		if(3 == $type) {
			/* backup log when exceeding the configured size */
			if(is_file($destination) && floor(C('LOG.FILE_SIZE')) <= filesize($destination)) {
				rename($destination, dirname($destination) . D_S . time() . '-' . basename($destination));
			}
		}
		if(!empty(self::$log)) {
			error_log(implode('', self::$log), $type, $destination , $extra);
			self::$log = array();
			clearstatcache(); // clear log after save
		}
	}

	/* write log, reference error_log() */
	public static function write($message, $type = 3, $destination = '', $extra = '') {
		$now = date(self::$format);
		if(empty($destination)) {
			$destination = LOG_PATH . D_S . date('y_m_d') . '.log';
		}
		if(3 == $type) {
			/* backup log when exceeding the configured size */
			if(is_file($destination) && floor(C('LOG.FILE_SIZE')) <= filesize($destination)) {
				rename($destination, dirname($destination) . D_S . time() . '-' . basename($destination));
			}
		}
		error_log("{$now} | URI:" . $_SERVER['REQUEST_URI'] . " | {$message}\r\n", $type, $destination, $extra);
		clearstatcache(); // clear log after save
	}

	/* constructors privatization */
	private function __construct() {}
}

?>