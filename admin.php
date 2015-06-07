<?php

/**
 *--------------------------------------
 * manage entry
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-27
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

session_start();
$_SESSION['admin_enter'] = 1;
header('location:index.php?g=admin');
?>