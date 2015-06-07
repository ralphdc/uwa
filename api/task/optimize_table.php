<?php

/**
 *--------------------------------------
 * optimize table
 *--------------------------------------
 * @project		: uwa task
 * @author		: cblee
 * @created		: 2014-06-12
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */

defined('IS_UWA_TASK') or exit(); 

/* task result*/
$_TR = array('data' => false, 'info' => 'task run failed');

/* optimize table */
$sql = 'OPTIMIZE TABLE ' . '__' . strtoupper($_TP['table']) . '__';
if(false !== $this->query($sql, true)) {
	$_TR = array('data' => true, 'info' => 'task run success');
}

?>