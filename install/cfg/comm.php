<?php

/**
 *--------------------------------------
 * install config
 *--------------------------------------
 * @project		: install
 * @author		: cblee
 * @created		: 2013-12-27
 * @copyright	: (c)2013 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

return array (
	'APP' => array(
		'CFG_LIST' => 'check_items',
	),
	'TE' => array (
		'GZIP' => false,
	),
	'DEBUG' => array (
		'SWITCH' => true,
		'STAT' => false,
		'PAGE_TRACE' => false,
	),
);
?>