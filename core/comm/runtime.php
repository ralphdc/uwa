<?php

/**
 *--------------------------------------
 * frameword deployment
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');

/* check app dir */
if(!is_dir(RUNTIME_PATH)) {
	build_appDir();
}
else {
	check_runtimeDir();
}

/* build app dir */
function build_appDir() {
	if(!is_dir(APP_PATH)) {
		mk_dir(APP_PATH, 0777);
	}
	if(!is_writeable(APP_PATH)) {
		halt(L('_DIR_READONLY_', null, array('dir' => APP_PATH)));
	}
	$dirs = array(
		CFG_PATH,
		LIB_PATH,
		LIB_CTRLR_PATH,
		LIB_MODL_PATH,
		LIB_COMM_PATH,
		LANG_PATH,
		TPL_PATH,
		TPL_PATH . D_S . C('TE.TPL_THEME'),
		RUNTIME_PATH,
		CACHE_PATH,
		DATA_PATH,
		TEMP_PATH,
		LOG_PATH);
	mkdirs($dirs);

	/* directory index */
	if(C('DIR_INDEX.SWITCH')) {
		$content = C('DIR_INDEX.CONTENT');
		foreach($dirs as $dir) {
			file_put_contents($dir . C('DIR_INDEX.FILENAME'), $content);
		}
	}

	/* create default constant define file */
	if(!is_file(CFG_PATH . '/define.php')) {
		copy(PFA_PATH . '/tpl/cfg/define.php', CFG_PATH . '/define.php');
	}
	/* create default common config file */
	if(!is_file(CFG_PATH . '/comm.php')) {
		copy(PFA_PATH . '/tpl/cfg/comm.php', CFG_PATH . '/comm.php');
	}
	/* create default route file */
	if(!is_file(CFG_PATH . '/route.php')) {
		copy(PFA_PATH . '/tpl/cfg/route.php', CFG_PATH . '/route.php');
	}
	/* create default controller */
	if(!is_file(LIB_CTRLR_PATH . D_S . C('APP.CTRLR') . '.class.php')) {
		$defaultCtrlr = ucwords(strtolower(C('APP.CTRLR'))) . "Ctrlr";
		$content = file_get_contents(PFA_PATH . '/tpl/IndexCtrlr.class.php');
		$_t_from = array(
			'IndexCtrlr',
			'index',
			'created-time');
		$_t_to = array(
			$defaultCtrlr,
			C('APP.ACTN'),
			date('Y-m-d'));
		$content = str_replace($_t_from, $_t_to, $content);
		file_put_contents(LIB_CTRLR_PATH . D_S . $defaultCtrlr . '.class.php', $content);

		$content = file_get_contents(PFA_PATH . '/tpl/index.tpl.php');
		file_put_contents(TPL_PATH . D_S . C('TE.TPL_THEME') . '/' . C('APP.ACTN') . C('TE.TPL_SUFFIX'), $content);
	}
}

/* check runtime dir */
function check_runtimeDir() {
	if(!is_writeable(RUNTIME_PATH)) {
		halt(L('_DIR_READONLY_', null, array('dir' => RUNTIME_PATH)));
	}
	if(!is_dir(CACHE_PATH)) {
		mk_dir(CACHE_PATH);
	}
	if(!is_dir(DATA_PATH)) {
		mk_dir(DATA_PATH);
	}
	if(!is_dir(TEMP_PATH)) {
		mk_dir(TEMP_PATH);
	}
	if(!is_dir(LOG_PATH)) {
		mk_dir(LOG_PATH);
	}
}

/* build compile file */
function build_runtimeCache($append = '') {
	/* load framework core file list */
	$list = include PFA_PATH . '/comm/core.php';
	/* load framework function library */
	$list[] = PFA_PATH . '/comm/function.php';
	/* build compile file */
	$defs = get_defined_constants(true);
	$content = array_define($defs['user']);
	foreach($list as $file) {
		$content .= compile($file);
	}
	$content .= $append . "\r\nC(" . var_export(C(), true) . ');';
	$runtime = '~runtime.php';
	file_put_contents(RUNTIME_PATH . D_S . $runtime, strip_whitespace('<?php ' . $content));
}

?>