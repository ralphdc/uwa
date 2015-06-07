<?php

/**
 *--------------------------------------
 * Framework common file
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-22
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

define('IN_PFA', true);

/* record start time */
G('beginTime');

/* record the initial memory use */
define('MEMORY_ANALYSE', function_exists('memory_get_usage'));
if(MEMORY_ANALYSE) {
	$GLOBALS['_startUseMems'] = memory_get_usage();
}

/* version info */
define('PFA_VERSION', '2.3.5.246');
define('PFA_RELEASE', '20141223');

/* PHP version check */
if(version_compare(PHP_VERSION, '5.2.0', '<')) {
	die('require: PHP > 5.2!');
}

if(!defined('APP_NAME')) {
	define('APP_NAME', basename(dirname($_SERVER['SCRIPT_FILENAME'])));
}
if(!defined('APP_PATH')) {
	define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']));
}
if(!defined('PFA_PATH')) {
	define('PFA_PATH', dirname(__FILE__));
}
if(!defined('RUNTIME_PATH')) {
	define('RUNTIME_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'runtime');
}

$runtime = '~runtime.php';
if(is_file(RUNTIME_PATH . DIRECTORY_SEPARATOR . $runtime)) {
	require RUNTIME_PATH . DIRECTORY_SEPARATOR . $runtime;
	G('loadTime');
}
else {
	/* load constant define file */
	require PFA_PATH . '/comm/define.php';
	/* load framework function library */
	require PFA_PATH . '/comm/function.php';
	/* load default option */
	C(require PFA_PATH . '/comm/option.php');
	/* check deployment */
	require PFA_PATH . "/comm/runtime.php";
	/* read framework core file list */
	$list = include PFA_PATH . '/comm/core.php';
	/* load framework core file */
	foreach($list as $key => $file) {
		require_cache($file);
	}
	G('loadTime');
}

/* record and count time */
function G($start, $end = '', $dec = 6) {
	static $_info = array();
	if(!empty($end)) {
		if(!isset($_info[$end])) {
			$_info[$end] = microtime(true);
		}
		return number_format(($_info[$end] - $_info[$start]), $dec);
	}
	else {
		$_info[$start] = microtime(true);
	}
}

?>