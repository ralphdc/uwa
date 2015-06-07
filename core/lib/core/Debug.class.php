<?php

/**
 *--------------------------------------
 * Debug
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Debug extends Pfa {
	private static $marker = array();
	public static $trace = array();

	/* mark debug position */
	public static function mark($name) {
		self::$marker['time'][$name] = microtime(true);
		if(DEBUG_MEMORY) {
			self::$marker['mem'][$name] = memory_get_usage();
			self::$marker['peak'][$name] = function_exists('memory_get_peak_usage') ? memory_get_peak_usage() : self::$marker['mem'][$name];
		}
	}

	/* get $start to $end time use */
	public static function get_time_use($start, $end, $decimals = 6) {
		if(!isset(self::$marker['time'][$start])) {
			return '';
		}
		if(!isset(self::$marker['time'][$end])) {
			self::$marker['time'][$end] = microtime(true);
		}
		return number_format(self::$marker['time'][$end] - self::$marker['time'][$start], $decimals);
	}

	/* get $start to $end memory use */
	public static function get_mem_use($start, $end) {
		if(!DEBUG_MEMORY) {
			return '';
		}
		if(!isset(self::$marker['mem'][$start])) {
			return '';
		}
		if(!isset(self::$marker['mem'][$end])) {
			self::$marker['mem'][$end] = memory_get_usage();
		}
		return byte_format((self::$marker['mem'][$end] - self::$marker['mem'][$start]));
	}

	/* get $start to $end memory peak */
	public static function get_mem_peak($start, $end) {
		if(!DEBUG_MEMORY) {
			return '';
		}
		if(!isset(self::$marker['peak'][$start])) {
			return '';
		}
		if(!isset(self::$marker['peak'][$end])) {
			self::$marker['peak'][$end] = function_exists('memory_get_peak_usage') ? memory_get_peak_usage() : memory_get_usage();
		}
		return byte_format(max(self::$marker['peak'][$start], self::$marker['peak'][$end]));
	}

	/* write page trace */
	public static function trace($title, $value = '') {
		if(is_array($title)) {
			self::$trace = array_merge(self::$trace, $title);
		}
		else {
			self::$trace[$title] = $value;
		}
	}

	/* show stat info: runtime, database operation, cache times, memory useage */
	public static function show_stat() {
		$showTime = '';
		if(C('DEBUG.STAT')) {
			$showTime = '<b>' . L('_TIME_USAGE_') . '</b>: ' . G('beginTime', 'endTime') . 's';
		}
		/* show run time detail */
		if(C('DEBUG.ADV_TIME')) {
			$showTime .= '(';
			$showTime .= L('_LOAD_TIME_') . ': ' . G('beginTime', 'loadTime') . 's, ';
			$showTime .= L('_INIT_TIME_') . ': ' . G('loadTime', 'initTime') . 's, ';
			$showTime .= L('_EXEC_TIME_') . ': ' . G('initTime', 'execTime') . 's';
			$showTime .= ')';
		}
		/* show database operation */
		if(C('DEBUG.DB_TIMES') && class_exists('Db', false)) {
			$showTime .= ' | <b>' . L('_DB_TIMES_') . '</b>: ' . N('db_query') . L('_DB_QUERY_') . ' ' . N('db_write') . L('_DB_WRITE_');
		}
		/* show cache times */
		if(C('DEBUG.CACHE_TIMES') && class_exists('Cache', false)) {
			$showTime .= ' | <b>' . L('_CACHE_TIMES_') . '</b>: ' . N('cache_read') . L('_CACHE_GET_') . ' ' . N('cache_write') . L('_CACHE_WRITE_');
		}
		/* show memory useage */
		if(MEMORY_ANALYSE && C('DEBUG.USE_MEM')) {
			$showTime .= ' | <b>' . L('_MEMORY_USAGE_') . '</b>: ' . byte_format((memory_get_usage() - $GLOBALS['_startUseMems']));
		}
		echo "\r\n" . '<div id="pfa_run_time" style="padding:10px; margin:10px; color:#666; background:#fff; border:1px solid #ddd; font-size:12px; line-height: 18px;">' . $showTime . '</div>';
	}

	/* show page trace information */
	public static function show_trace() {
		$_trace = array();
		/* default information */
		self::trace(L('_CURRENT_PAGE_'), $_SERVER['REQUEST_URI']);
		self::trace(L('_REQUEST_METHOD_'), $_SERVER['REQUEST_METHOD']);
		self::trace(L('_SERVER_PROTOCOL_'), $_SERVER['SERVER_PROTOCOL']);
		self::trace(L('_REQUEST_TIME_'), date(C('APP.TIME_FORMAT'), $_SERVER['REQUEST_TIME']));
		self::trace(L('_USER_AGENT_'), $_SERVER['HTTP_USER_AGENT']);
		self::trace(L('_SESSION_ID_'), session_id());
		$log = Log::$log;
		self::trace(L('_LOG_RECORD_'), count($log) ? count($log) . "<br />\r\n" . implode("<br />\r\n", $log) : L('_NONE_'));
		$files = get_included_files();
		self::trace(L('_INCLUDE_FILES_'), count($files) . str_replace(array("\r\n", "\n"), "<br />\r\n", substr(substr(print_r($files, true), 7), 0, -2)));
		$_trace = array_merge($_trace, self::$trace);
		include C('TPL.PAGE_TRACE');
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>