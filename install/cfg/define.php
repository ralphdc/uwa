<?php
defined('PFA_PATH') or exit('Access Denied');

/* soft version info */
define('SOFT_NAME', 'UWA');
define('SOFT_CHARSET', 'utf-8');
define('SOFT_DB_CHARSET', 'UTF8');
define('SOFT_CODENAME', '2.X');
define('SOFT_VERSION', '2.2.4');
define('SOFT_COPYRIGHT_YEAR', '2015');
define('SOFT_AUTHOR', 'asthis.net');
// define('SOFT_AUTHOR_URL', 'http://uwa2x.asthis.net/');
// define('SOFT_OFFICIAL_FORUM_URL', 'http://bbs.asthis.net/');
// define('SOFT_ONLINE_MANUAL_URL', 'http://help.asthis.net/');
// define('SOFT_UPGRADE_URL', 'http://upgrade.asthis.net/uwa2x/upgrade-info.js');
// define('SOFT_AUTHORIZATION_URL', 'http://ac.asthis.net/');
// define('SOFT_AUTHORIZATION_URL', 'http://ac.asthis.net/');

define('SOFT_AUTHOR_URL', '');
define('SOFT_OFFICIAL_FORUM_URL', '');
define('SOFT_ONLINE_MANUAL_URL', '');
define('SOFT_UPGRADE_URL', '');
define('SOFT_AUTHORIZATION_URL', '');
define('SOFT_AUTHORIZATION_URL', '');
/* files */
define('LOCK_FILE', dirname(APP_PATH) . D_S . CFG_DIR . D_S . 'install.lock.php');
define('SQL_FILE', CFG_PATH . D_S . 'data.sql');
define('DEFINE_FILE', dirname(APP_PATH) . D_S . CFG_DIR . D_S . 'define.php');
define('CONFIG_FILE', dirname(APP_PATH) . D_S . CFG_DIR . D_S . 'comm.php');
/* site manage path */
define('SITE_URL', trim('http://' . AServer::get_env('HTTP_HOST') . dirname(APP_ROOT), '/\\').'/');
define('SITE_MANAGE_URL', SITE_URL . 'admin.php');
?>