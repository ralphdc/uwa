<?php

/**
 *--------------------------------------
 * App Entry
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
error_reporting(0);
define('APP_NAME', 'uwa');
define('APP_PATH', dirname(__FILE__));
define('PFA_PATH', dirname(__FILE__) . '/core');

require(PFA_PATH . '/pfa.php');

$app = new App();
$app->run();

?>