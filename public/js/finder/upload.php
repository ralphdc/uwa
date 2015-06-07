<?php

/* This file is part of KCFinder project */

/* 路径 */
if(!defined('FINDER_PATH')) {
	define('FINDER_PATH', dirname(__FILE__));
}
if(!defined('D_S')) {
	define('D_S', DIRECTORY_SEPARATOR);
}

require FINDER_PATH . D_S . 'core/autoload.php';
$uploader = new uploader();
$uploader->upload();

?>