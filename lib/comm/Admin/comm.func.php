<?php

/**
 *--------------------------------------
 * admin common function library
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-2
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

/* get archive flag */
function get_archiveFlag($afAlias, $falgLen = 0) {
	$afList = M('ArchiveFlag')->get_flagList();
	$result = '';
	foreach($afList as $v) {
		$aFlag = $v['af_name'];
		if($falgLen > 0) {
			$aFlag = AString::msubstr($aFlag, 0, $falgLen);
		}
		$result .= (preg_match("#" . $v['af_alias'] . "#", $afAlias) ? ' <span class="fc_b p_0_2 fs_11 br_b br_3">' . $aFlag . '</span>' : '');
	}
	$result = trim($result);
	return $result;
}

/* get controller list from path */
function get_ctrlrList($ctrlrPath) {
	$names = require_cache($ctrlrPath . '/_names.php');
	$ctrlrList = array();
	$dirRes = opendir($ctrlrPath);
	while($dir = readdir($dirRes)) {
		if(!in_array($dir, array(
			'.',
			'..',
			'index.html',
			'_names.php',
			'.svn'))) {
			$ctrlr = basename($dir, 'Ctrlr.class.php');
			$name = isset($names[$ctrlr]) ? $names[$ctrlr] : $ctrlr;
			$ctrlrList[] = array('ctrlr' => $ctrlr, 'name' => $name);
		}
	}
	return $ctrlrList;
}

/* get action list from controller */
function get_actnList($ctrlr) {
	$ctrlrClass = $ctrlr . 'Ctrlr';
	$baseCtrlr = get_class_methods('Ctrlr');
	$advCtrlr = get_class_methods($ctrlrClass);
	$actnList = array_diff($advCtrlr, $baseCtrlr);
	return $actnList;
}

/* get action list from file */
function get_fileActnList($file) {
	$arr = file($file);
	foreach($arr as $line) {
		if(preg_match('/function ([_A-Za-z0-9]+)/i', $line, $regs)) {
			$arr_methods[] = $regs[1];
		}
	}
	return $arr_methods;
}

/* get child directory list, $exclude: exclude dir */
function list_dir($dir, $exclude = array()) {
	$items = array();

	if(empty($dir)) {
		return $items;
	}

	$files = glob(rtrim($dir, '/\\') . D_S . '*');
	if(is_array($files)) {
		$names = require_cache($dir . '/_names.php');
		foreach($files as $v) {
			if(is_file($v) or in_array(basename($v), $exclude)) {
				continue;
			}
			$v = basename($v);
			$n = isset($names[$v]) ? $names[$v] : $v;
			$items[] = array('dir' => $v, 'name' => $n);
		}
	}
	return $items;
}

/* get child file list, $exclude: exclude file */
function list_file($dir, $exclude = array('_names.php')) {
	$items = array();

	if(empty($dir)) {
		return $items;
	}

	$files = glob(rtrim($dir, '/\\') . D_S . '*');
	if(is_array($files)) {
		$names = require_cache($dir . '/_names.php');
		foreach($files as $v) {
			if(!is_file($v) or in_array(basename($v), $exclude)) {
				continue;
			}
			$v = basename($v);
			$n = isset($names[$v]) ? $names[$v] : $v;
			$items[] = array('file' => $v, 'name' => $n);
		}
	}
	return $items;
}

/* save extension option $extensionAlias */
function edit_extensionOption($extensionAlias, $option) {
	if(MAGIC_QUOTES_GPC) {
		$option = stripslashes_array($option);
	}

	$cfgFile = CFG_PATH . D_S . 'Extension' . D_S . parse_name($extensionAlias, 1) . '.php';

	$_O = include ($cfgFile);
	$_O = empty($_O) ? $option : array_merge($_O, $option);

	$content = var_export($_O, true);
	$content = "<?php\r\nreturn {$content};\r\n?>";

	return @file_put_contents($cfgFile, $content);
}

?>