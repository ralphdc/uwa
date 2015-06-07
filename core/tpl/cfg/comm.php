<?php

/**
 *--------------------------------------
 * config
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

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

	/* URL */
	'URL' => array(
		'TYPE' => 1, // 1:normal mode 2:PATHINFO mode 3:REWRITE mode 4:compatible mode
		'PARSE_NAME' => true, // true: controller name in url will be parsed, "group_name@ctrlr_name/actn_name"; false: only can use "GroupName@CtrlrName/actn_name"
		'ROUTE_RULES' => array(), // default route rules
		'PATHINFO_DEPR' => '/', // separator of params in PATHINFO mode
		'HOST_PREFIX' => true, // whether the url assembled by Url::U() contain __HOST__
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

	/* debug */
	'DEBUG' => array(
		'SWITCH' => false,// debug switch
		'STAT' => true, // stat info show switch
		'PAGE_TRACE' => true, // page trace show switch
		),
);

?>