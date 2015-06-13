<?php

/**
 *--------------------------------------
 * install entry
 *--------------------------------------
 * @project		: install
 * @author		: cblee
 * @created		: 2012-9-25
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
error_reporting(0);
define('APP_NAME', 'install');
define('APP_PATH', dirname(__FILE__));
define('PFA_PATH', dirname(dirname(__FILE__)) . '/core');

require(PFA_PATH . '/pfa.php');

$app = new App();
$app->run();

?>