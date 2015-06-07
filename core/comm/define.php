<?php

/**
 *--------------------------------------
 * constant define
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');

if(version_compare(PHP_VERSION, '5.4.0', '<')) {
	@set_magic_quotes_runtime(0);
	define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc() ? true : false);
}

define('IS_CGI', substr(PHP_SAPI, 0, 3) == 'cgi' ? 1 : 0);
define('IS_WIN', strstr(PHP_OS, 'WIN') ? 1 : 0);
define('IS_CLI', PHP_SAPI == 'cli' ? 1 : 0);
if(!IS_CLI) {
	/* current filename */
	if(!defined('_PHP_FILE_')) {
		/* CGI/FASTCGI */
		if(IS_CGI) {
			$_temp = explode('.php', $_SERVER["PHP_SELF"]);
			define('_PHP_FILE_', rtrim(str_replace($_SERVER["HTTP_HOST"], '', $_temp[0] . '.php'), '/'));
		}
		else {
			define('_PHP_FILE_', rtrim($_SERVER["SCRIPT_NAME"], '/'));
		}
	}

	/* for some sepcial server */
	if(isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"])) {
		$_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
	}

	/* app URL root */
	if(!defined('APP_ROOT')) {
		$_root = trim(str_replace('\\', '/', dirname(_PHP_FILE_)), '/');
		$_root = empty($_root) ? '/' : '/' . $_root . '/';
		define('APP_ROOT', $_root);
	}

	/* site URL root */
	if(!defined('ROOT')) {
		$_rel = trim(str_replace('\\', '/', substr(APP_PATH, strlen(dirname(PFA_PATH)))), '/');
		$_root = empty($_rel) ? APP_ROOT : substr(APP_ROOT, 0, 0 - strlen($_rel . '/'));
		define('ROOT', $_root);
	}
	define('URL_COMMON', 1); // normal mode
	define('URL_PATHINFO', 2); // pathinfo mode
	define('URL_REWRITE', 3); // rewrite mode
	define('URL_COMPAT', 4); // compatible mode
}

/* separator */
define('D_S', DIRECTORY_SEPARATOR);
define('P_S', PATH_SEPARATOR);

/* set dir */
define('PUBLIC_DIR', 'public'); // public file
define('CFG_DIR', 'cfg');
define('LIB_DIR', 'lib');
define('LIB_CTRLR_DIR', 'ctrlr');
define('LIB_MODL_DIR', 'modl');
define('LIB_COMM_DIR', 'comm');
define('LANG_DIR', 'lang');
define('TPL_DIR', 'tpl');
define('CACHE_DIR', 'cache'); // template cache
define('DATA_DIR', 'data'); // file cache F()
define('TEMP_DIR', 'temp'); // data cache by Cache class S()
define('LOG_DIR', 'log'); // log dir

/* set path */
define('PUBLIC_PATH', dirname(PFA_PATH) . D_S . PUBLIC_DIR);
define('CFG_PATH', APP_PATH . D_S . CFG_DIR);
define('LIB_PATH', APP_PATH . D_S . LIB_DIR);
define('LIB_CTRLR_PATH', LIB_PATH . D_S . LIB_CTRLR_DIR);
define('LIB_MODL_PATH', LIB_PATH . D_S . LIB_MODL_DIR);
define('LIB_COMM_PATH', LIB_PATH . D_S . LIB_COMM_DIR);
define('LANG_PATH', APP_PATH . D_S . LANG_DIR);
define('TPL_PATH', APP_PATH . D_S . TPL_DIR);
define('CACHE_PATH', RUNTIME_PATH . D_S . CACHE_DIR);
define('DATA_PATH', RUNTIME_PATH . D_S . DATA_DIR);
define('TEMP_PATH', RUNTIME_PATH . D_S . TEMP_DIR);
define('LOG_PATH', RUNTIME_PATH . D_S . LOG_DIR);

define('PFA_EXT_PATH', PFA_PATH . D_S . 'lib' . D_S . 'ext'); // PFA extension library
define('PFA_VENDOR_PATH', PFA_PATH . D_S . 'vendor'); // PFA third-part library

?>