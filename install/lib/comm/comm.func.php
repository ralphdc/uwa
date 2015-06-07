<?php

/**
 *--------------------------------------
 * install function
 *--------------------------------------
 * @project		: install
 * @author		: cblee
 * @created		: 2013-12-27
 * @copyright	: (c)2013 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

function check_lock() {
	if(file_exists(LOCK_FILE)) {
		echo L('LOCKED_TIP');
		exit();
	}
}

function check_system(&$systemItems, &$checkNextStep) {
	if(isset($systemItems['OS'])) {
		$systemItems['OS']['c'] = PHP_OS;
	}
	if(isset($systemItems['PHP_VERSION'])) {
		$systemItems['PHP_VERSION']['c'] = PHP_VERSION;
	}
	if(isset($systemItems['UPLOAD_MAX_FILESIZE'])) {
		$systemItems['UPLOAD_MAX_FILESIZE']['c'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'UNKNOWN';
	}
	if(isset($systemItems['GD_VERSION'])) {
		$temp = function_exists('gd_info') ? gd_info() : array('GD Version' => 'NONSUPPORT');
		$systemItems['GD_VERSION']['c'] = empty($temp['GD Version']) ? 'INEXISTENCE' : rtrim(ltrim($temp['GD Version'], 'bundled ('),'compatible)');
		unset($temp);
	}
	if(isset($systemItems['DISK_SPACE'])) {
		if(function_exists('diskFreeSpace')) {
			$systemItems['DISK_SPACE']['c'] = floor(diskFreeSpace(dirname(APP_PATH)) / (1024*1024)) . 'M';
		}
		else {
			$systemItems['DISK_SPACE']['c'] = 'UNKNOWN';
		}
	}

	foreach($systemItems as $k => $v) {
		if(0 == (int)$systemItems[$k]['c']) {
			if('NO_LIMIT' == $v['r'] || $systemItems[$k]['c'] == $v['r']) {
				$systemItems[$k]['s'] = 1;
			}
			else {
				$systemItems[$k]['s'] = 0;
				if('UNKNOWN' != $systemItems[$k]['c']) {
					$checkNextStep = 0;
				}
			}
		}
		else {
			if('NO_LIMIT' == $v['r'] || ($systemItems[$k]['c'] - $v['r']) >= 0) {
				$systemItems[$k]['s'] = 1;
			}
			else {
				$systemItems[$k]['s'] = 0;
				if('UNKNOWN' != $systemItems[$k]['c']) {
					$checkNextStep = 0;
				}
			}
		}
	}

}

function check_dirfile(&$dirfileItems, &$checkNextStep) {
	foreach($dirfileItems as $k => $v) {
		$path = dirname(APP_PATH) . D_S . $v['path'];
		if('dir' == $v['type']) {
			if(!dir_writable($path)) {
				$dirfileItems[$k]['c'] = 'ERAD_ONLY';
				$dirfileItems[$k]['s'] = 0;
				$checkNextStep = 0;
			}
			else {
				$dirfileItems[$k]['c'] = 'WRITABLE';
				$dirfileItems[$k]['s'] = 1;
			}
		}
		else {
			if(file_exists($path)) {
				if(is_writable($path)) {
					$dirfileItems[$k]['c'] = 'WRITABLE';
					$dirfileItems[$k]['s'] = 1;
				}
				else {
					$dirfileItems[$k]['c'] = 'ERAD_ONLY';
					$dirfileItems[$k]['s'] = 0;
					$checkNextStep = 0;
				}
			}
			else {
				if(dir_writable(dirname($path))) {
					$dirfileItems[$k]['s'] = 1;
					$dirfileItems[$k]['c'] = 'WRITABLE';
				}
				else {
					$dirfileItems[$k]['s'] = 0;
					$checkNextStep = 0;
					$dirfileItems[$k]['c'] = 'INEXISTENCE';
				}
			}
		}
	}
}

function check_php_config(&$phpConfigItems, &$checkNextStep) {
	foreach($phpConfigItems as $k => $v) {
		$phpConfigItems[$k]['c'] = '1' === get_cfg_var($k) ? 'on' :
			('' === get_cfg_var($k) ? 'off' : get_cfg_var($k));
		if(strtolower($phpConfigItems[$k]['c']) == strtolower($v['r']) or ('safe_mode' == $k and PHP_VERSION >= 5.3)) {
			$phpConfigItems[$k]['s'] = 1;
		}
		else {
			$phpConfigItems[$k]['s'] = 0;
			$checkNextStep = 0;
		}
	}
}

function check_extension(&$extensionItems, &$checkNextStep) {
	foreach($extensionItems as $k => $v) {
		if(extension_loaded($v['name'])) {
			$extensionItems[$k]['s'] = 1;
		}
		else {
			$extensionItems[$k]['s'] = 0;
			$checkNextStep = 0;
		}
	}
}

function check_function(&$functionItems, &$checkNextStep) {
	foreach($functionItems as $k => $v) {
		if(function_exists($v['name'])) {
			$functionItems[$k]['s'] = 1;
		}
		else {
			$functionItems[$k]['s'] = 0;
			$checkNextStep = 0;
		}
	}
}

function check_post($p) {
	$errorMessage = '';
	foreach($p as $k => $v) {
		if(0 == strlen($v)) {
			$errorMessage .= "\r\n" . L($k) . L('NO_EMPTY') . '<br />';
		}
	}
	return $errorMessage;
}

function check_db($dbHost, $dbPort, $dbUser, $dbPassword, $dbDatabase, $dbPrefix, $dbConnection) {
	$errorMessage = '';
	$dbServer = empty($dbPort) ? $dbHost : $dbHost . ':' . $dbPort;
	if(!@mysql_connect($dbServer, $dbUser, $dbPassword)) {
		$errno = mysql_errno();
		if(1045 == $errno) {
			$errorMessage = L('DB_ERROR_NO_1045');
		}
		elseif(2003 == $errno) {
			$errorMessage = L('DB_ERROR_NO_2003');
		}
		else {
			$errorMessage = L('DB_CONNECT_FAILED');
		}
	}
	elseif(!@mysql_select_db($dbDatabase)) {
		@mysql_query("CREATE DATABASE `{$dbDatabase}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci") or $errorMessage = L('DB_DATABASE_INEXISTENCE');
	}
	elseif(!extension_loaded($dbConnection)) {
		$errorMessage = $dbConnection.L('EXTENSION_NOT_SUPPORT');
	}
	else {
		$query = mysql_query("SHOW TABLES FROM `{$dbDatabase}`");
		while($row = mysql_fetch_row($query)) {
			if(preg_match("/^{$dbPrefix}/", $row[0])) {
				$errorMessage = L('DB_PREFIX_EXIST');
			}
		}
	}
	return $errorMessage;
}

function random($length) {
	$hash = '';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function connect_db($dbHost, $dbUser, $dbPassword, $dbDatabase) {
	@mysql_connect($dbHost, $dbUser, $dbPassword);
	@mysql_select_db($dbDatabase);
	@mysql_query('SET NAMES ' . SOFT_DB_CHARSET);

}

function run_sql($sqlFile) {
	$sqlFile = file($sqlFile);
	$sql = '';
	foreach($sqlFile as $row) {
		if(substr($row, 0, 2) != '--' && substr($row, 0, 2) != '/*' && substr($row, 0, 1) != '#' && trim($row) != '') {
			$sql .= $row;
		}
	}
	$sql = str_replace('`prefix_', '`'.$_POST['dbPrefix'], $sql);
	/* \n 转换为 \r\n */
	$sql = str_replace(";\n", ";\r\n", $sql);
	$query = trim_array(explode(";\r\n", $sql));

	$c = 1;
	$t = count($query);
	$_err = '';
	foreach($query as $q) {
		$table = '';
		preg_match('/`\w*`/', $q, $table);
		if(!empty($q)) {
			$_t_r = mysql_query($q);
		}
		if(false === $_t_r) {
			$_err .= $q . ";\r\n";
		}
		$m = L('INSTALL_SUCCESS');
		if(!empty($_err)) {
			$m = L('INSTALL_FAILED');
		}
		if('DROP TABLE' == substr(strtoupper($q), 0, 10)) {
			$m = L('DROP_TABLE').$table[0];
		}
		if('CREATE TABLE' == substr(strtoupper($q), 0, 12)) {
			$m = L('CREATE_TABLE').$table[0];
		}
		if('INSERT INTO' == substr(strtoupper($q), 0, 11)) {
			$m = L('INSERT_DATA_INTO').$table[0];
		}
		if('SET SQL_MODE' == substr(strtoupper($q), 0, 12)) {
			$m = L('SET_SQL_MODE');
		}
		$b = round($c/$t*100, 0);
		show_progress($m, $b);
		$c++;
	}
	if(!empty($_err)) {
		$temp = function_exists('gd_info') ? gd_info() : array('GD Version' => 'NONSUPPORT');
		$_t = "//install information\r\n";
		$_t .= "//----------------------------------------\r\n";
		$_t .= "//soft: " . SOFT_NAME . " " . SOFT_CODENAME . " " . SOFT_CHARSET . " version" . SOFT_VERSION . "\r\n";
		$_t .= "//OS: " . PHP_OS . "\r\n";
		$_t .= "//PHP_VERSION: " . PHP_VERSION . "\r\n";
		$_t .= "//UPLOAD_MAX_FILESIZE: " . ini_get('upload_max_filesize') . "\r\n";
		$_t .= "//GD_VERSION: " . $temp['GD Version'] . "\r\n";
		$_t .= "//DISK_SPACE: " . floor(diskFreeSpace(dirname(APP_PATH)) / (1024*1024)) . 'M' . "\r\n";
		$_t .= "//----------------------------------------\r\n\r\n";
		$_err = $_t.$_err;
		file_put_contents(APP_PATH . D_S . 'install_err.txt', $_err);
	}
}

function show_progress($message, $barLength) {
	echo "<script type=\"text/javascript\">show_progress('{$message}', '{$barLength}%');</script>\r\n";
	@ob_flush();
	@flush();
}

function save_define_file($defineFile, $define) {
	$s = "<?php\r\n";
	foreach($define as $k => $v) {
		$s .= "define('" . $k . "', '" . $v . "');\r\n";
	}
	$s .= '?>';
	@file_put_contents($defineFile, $s);
}

function save_config_file($filename, $array = '') {
	$content = "<?php\r\nreturn '';\r\n?>";
	if(is_array($array)) {
		$content = "<?php\r\nreturn " . var_export($array, true) . ";\r\n?>";
	}
	@file_put_contents($filename, $content);
}

function lock() {
	date_default_timezone_set(C('APP.TIMEZONE'));
	$s = "<?php\r\n";
	$s .= "//install information\r\n";
	$s .= "//----------------------------------------\r\n";
	$s .= "//soft: " . SOFT_NAME . " " . SOFT_CODENAME . " " . SOFT_CHARSET . " version" . SOFT_VERSION . "\r\n";
	$s .= "//host: " . __HOST__ . "\r\n";
	$s .= "//time: " . date('Y-m-d H:i:s T', time()) . "\r\n";
	$s .= "header(\"location:" . dirname(__APP__) . "\");\r\n";
	$s .= "?>";
	@file_put_contents(LOCK_FILE, $s);
}

?>