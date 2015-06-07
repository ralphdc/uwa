<?php

/**
 *--------------------------------------
 * check items
 *--------------------------------------
 * @project		: install
 * @author		: cblee
 * @created		: 2013-12-27
 * @copyright	: (c)2013 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

return array (
	'SYSTEM' => array(
		'OS' => array('r' => 'NO_LIMIT', 'b' => 'unix'),
		'PHP_VERSION' => array('r' => '5.1', 'b' => '5.2'),
		'UPLOAD_MAX_FILESIZE' => array('r' => 'NO_LIMIT', 'b' => '2M'),
		'GD_VERSION' => array('r' => '2.0', 'b' => '2.0'),
		'DISK_SPACE' => array('r' => '20M', 'b' => 'NO_LIMIT')
	),
	'DIR_FILE' => array(
		'RUNTIME_DIR' => array('type' => 'DIR', 'path' => 'runtime'),
		'CONFIG_DIR' => array('type' => 'DIR', 'path' => 'cfg'),
		'TEMPLATE_DIR' => array('type' => 'DIR', 'path' => 'tpl'),
		'PUBLIC_DIR' => array('type' => 'DIR', 'path' => 'public'),
		'CONFIG_FILE' => array('type' => 'FILE', 'path' => 'cfg/comm.php'),
		'DEFINE_FILE' => array('type' => 'FILE', 'path' => 'cfg/define.php'),
	),
	'PHP_CONFIG' => array(
		'safe_mode' => array('r' => 'off'),
		//'safe_register_globals' => array('r' => 'off'),
		//'magic_quotes_gpc' => array('r' => 'on'),
		//'allow_url_fopen' => array('r' => 'on'),
	),
	'EXTENSION' => array(
		array('name' => 'mysql'),
		array('name' => 'gd'),
	),
	'FUNCTION' => array(
		array('name' => 'file_get_contents'),
		array('name' => 'gzencode'),
	),
);
?>