<?php

/* @desc Browser calling script */

/*
session_start();
$_SESSION['FINDER']['browse_url'] = 'browse.php?';
$_SESSION['FINDER']['disabled'] = false;
$_SESSION['FINDER']['uploadURL'] = 'http://www.asthis.net/a';
$_SESSION['FINDER']['uploadDir'] = '';
$_SESSION['FINDER']['maxFileSize'] = 200000;
$_SESSION['FINDER']['types'] = array(
		'archive' => ''
	);

define('__FINDER__', 'http://' . $_SERVER['HTTP_HOST'] . '/' . dirname($_SERVER['SCRIPT_NAME']) . '/');
*/

require "core/autoload.php";
$browser = new browser();
$browser->action();

?>