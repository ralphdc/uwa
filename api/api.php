<?php

/**
 *--------------------------------------
 * api demo
 *--------------------------------------
 * @project		: api
 * @author		: cblee
 * @created		: 2014-05-14
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */

//defined('IN_UWA') or exit(); 

define('APP_NAME', 'api');
define('APP_PATH', dirname(dirname(__FILE__)));
define('PFA_PATH', dirname(dirname(__FILE__)) . '/core');

require(PFA_PATH . '/pfa.php');

/* App */
new App();


$app = A();
/* site info */
$_SITE = M('Option')->get_option('site');
unset($_SITE['theme']);
$app->assign('_SITE', $_SITE);
/* common setting */
$_G = M('Option')->get_option();
unset($_G['site']); unset($_G['core']); unset($_G['index']); unset($_G['image']);
$app->assign('_G', $_G);

?>