<?php

/**
 *--------------------------------------
 * frame default option
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');

return array(
	/* App */
	'APP' => array(
		'AUTOLOAD_PATH' => '', // autoload path, separated by ','
		'CFG_LIST' => 'route', // app extra config file list, separated by ','
		'GROUP_DEPR' => '.', // separater between group and controller
		'GROUP_LIST' => '', // app group list, separated by ',', such as: 'Home,Member,Admin'
		'TIMEZONE' => 'PRC', // default timezone
		'TIME_FORMAT' => 'Y-m-d H:i:s', // default time format
		'CHARSET' => 'utf-8', // default output charset

		'GROUP' => 'Home', // default group name
		'CTRLR' => 'Index', // default controller name
		'ACTN' => 'index', // default action name
		),

	/* language */
	'LANG' => array(
		'DETECT' => true, // detect switch: if open to detect browser language
		'NAME' => 'zh-cn', // language name
		),

	/* URL */
	'URL' => array(
		'TYPE' => 1, // 1:normal mode 2:PATHINFO mode 3:REWRITE mode 4:compatible mode
		'PARSE_NAME' => true, // true: controller name in url will be parsed, "group_name@ctrlr_name/actn_name"; false: only can use "GroupName@CtrlrName/actn_name"
		'ROUTE_RULES' => array(), // default route rules
		'PATHINFO_FETCH' => 'PATH_INFO,ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', //  used to determine the variable PATH_INFO by SERVER parameters
		'PATHINFO_DEPR' => '/', // separator of params in PATHINFO mode
		'HOST_PREFIX' => true, // whether the url assembled by Url::U() contain __HOST__
		),

	/* HTML */
	'HTML' => array(
		'DIR' => 'html', // html file dir based on app_path
		'FILE_SUFFIX' => '.html', // HTML file suffix
		),

	/* COOKIE */
	'COOKIE' => array(
		'PREFIX' => 'pfa_', // COOKIE prefix
		'KEY' => 'pfa', // COOKIE key
		'CLIENT_CHECK' => false, // whether check client
		'EXPIRE' => 3600, // Cookie expire
		'PATH' => '/', // Cookie path
		'DOMAIN' => '', // Cookie domain
		),

	/* SESSION */
	'SESSION' => array(
		'PREFIX' => 'pfa_', // SESSION prefix
		'CLIENT_CHECK' => false, // whether check client
		),

	/* system variable name */
	'VAR' => array(
		'GROUP' => 'g', // gruop
		'CTRLR' => 'c', // controller
		'ACTN' => 'a', // action
		'PAGE' => 'p', // page
		'TPL' => 't', // template
		'LANG' => 'l', // language
		'PATHINFO' => 's', // cpmpactible mode var, such as: ?s=/ctrlr/actn/id/1
		'USER_AGENT' => 'ua', // user agent
		'AJAX' => 'ajax', // AJAX submit
		),

	/* template */
	'TPL' => array(
		'ERR' => PFA_PATH . '/tpl/err.php', // error default
		'ERR_DEBUG' => PFA_PATH . '/tpl/err_debug.php', // error debug
		'PAGE_TRACE' => PFA_PATH . '/tpl/page_trace.php', // page trace
		'DISP_JUMP' => PFA_PATH . '/tpl/disp_jump.php', // default page jump
		),

	/* the default directory index file */
	'DIR_INDEX' => array(
		'SWITCH' => true, // directory index switch
		'FILENAME' => '/index.html', // directory index filename
		'CONTENT' => ' ', // directory index file content
		),

	/* template engine */
	'TE' => array(
		'TYPE' => 'Pfa', // template engine type
		'MARK_L' => '{-', // start mark, improve the recognition efficiency
		'MARK_R' => '-}', // end mark
		'TAG_NAMESPACE' => '', // tag namespace
		'TAG_MARK_L' => '<', // tag start mark
		'TAG_MARK_R' => '>', // tag end mark
		'TPL_DETECT' => false, // template detect
		'TPL_PATH' => TPL_PATH, // default template path
		'TPL_THEME_DEFAULT' => 'default', // default theme
		'TPL_THEME' => 'default', // current theme
		'TPL_DETECT_USER_AGENT' => false, // template detect user agent
		'TPL_USER_AGENT_BRANCH' => array(0 => 'pc', 1 => 'pad', 2 => 'mobile', 3 => 'wml'), // template branch. 0:pc, 1:pad, 2:touch, 4:wml
		'TPL_SUFFIX' => '.php', // template file suffix
		'TPL_CONTENT_TYPE' => 'text/html', // default output content type
		'TPL_PROTECTION' => false, // template protection switch
		'TPL_PROTECTION_MARK' => 'PROTECTED.TEMPLATE.FILE', // template protection mark
		'TPL_DENY_FUNC' => '', // template disable function, separated by ','
		'STRIP_SPACE' => 0, // Whether remove the html spaces and line breaks inside the template file; 0:no; 1:yes, remain a blank; 2:all
		'CACHE_EXPIRE' => 0, // cache expire 0:permanent
		'CACHE_PATH' => CACHE_PATH, // cache file path
		'CACHE_SUFFIX' => '.php', // default cache file suffix
		'GZIP' => false, // gzip switch
		),

	/* database */
	'DB' => array(
		'TYPE' => 'mysql', // database type
		'USER' => 'root', // username
		'PWD' => '',// password
		'HOST' => 'localhost', // server host
		'PORT' => '3306', // port
		'NAME' => '',// database name
		'PARAMS' => '', // database params
		'CHARSET' => 'utf8', // database charset
		'PREFIX' => 'pfa_', // database table name prefix
		'SUFFIX' => '', // database table name suffix
		'LIKE_FIELDS' => '', // fuzzy matching string type field
		'DEPLOY_TYPE' => 0,// database deploy type:0 centralized (single server), 1 distributed (master and slave servers)
		'RW_SEPARATE' => false, // whether master-slave database is separate read and write
		'FIELDTYPE_CHECK' => true, // whether check field type
		'FIELDS_CACHE' => true, // fields cache switch
		),

	/* cache */
	'CACHE' => array(
		'TYPE' => 'File', // data cache type, support: File|Memcache|Db
		'EXPIRE' => 3600,// cache expire 0:permanent
		'COMPRESS' => false,// whether compress cache
		'CHECK' => false, // whether verify cache
		'PATH' => TEMP_PATH, // File cache: path
		'SUBDIR' => true, // File cache: whether create subdirectory based on the hash value of cache identified
		'PATH_LEVEL' => 1,// File cache: subdirectory level

		'MEMCACHE_HOST' => 'localhost', // memcache host
		'MEMCACHE_PORT' => 11211,// memcache port
		'MEMCACHE_TIMEOUT' => 1, // memcache connect timeout

		'TABLE' => 'pfa_cache', // Db type cache table
		),

	/* debug */
	'DEBUG' => array(
		'SWITCH' => false,// debug switch
		'STAT' => true, // stat info show switch
		'PAGE_TRACE' => true, // page trace show switch
		'RUN_TIME' => true, // run time show switch
		'ADV_TIME' => true, // run time detail show switch
		'DB_TIMES' => true, // database query and write times
		'CACHE_TIMES' => true, // cache opration times
		'USE_MEM' => true, // memory use
		),

	/* log */
	'LOG' => array(
		'SWITCH' => false, // log switch
		'FILE_SIZE' => 2097152, // log file size, create new file when exceed
		),

	);

?>