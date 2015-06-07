<?php

/**
 *--------------------------------------
 * Framework Function Library
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');

/* Instantiate Ctrlr */
function A($name = '') {
	static $_ctrlr = array();
	if(empty($name)) {
		return new Ctrlr;
	}
	if(isset($_ctrlr[$name])) {
		return $_ctrlr[$name];
	}
	$OriClassName = $name;
	if(strpos($name, C('APP.GROUP_DEPR'))) {
		$array = explode(C('APP.GROUP_DEPR'), $name);
		$name = array_pop($array);
		$className = $name . 'Ctrlr';
		import(implode(C('APP.GROUP_DEPR'), $array) . '.' . $className, LIB_CTRLR_PATH);
	}
	else {
		$className = $name . 'Ctrlr';
		import($className, LIB_CTRLR_PATH);
	}
	if(class_exists($className, false)) {
		$ctrlr = new $className();
		$_ctrlr[$OriClassName] = $ctrlr;
		return $ctrlr;
	}
	else {
		return false;
	}
}

/* Instantiate Modl */
function M($name = '') {
	static $_modl = array();
	if(empty($name)) {
		return new Modl;
	}
	if(isset($_modl[$name])) {
		return $_modl[$name];
	}
	$OriClassName = $name;
	$className = $name . 'Modl';
	if(class_exists($className)) {
		$modl = new $className();
	}
	else {
		$modl = new Modl($name);
	}
	$_modl[$OriClassName] = $modl;
	return $modl;
}

/* Simple data (string, array) get and set */
function F($name, $value = '', $path = DATA_PATH) {
	static $_cache = array();
	$path = rtrim($path, "/\\") . D_S;
	$filename = $path . $name . '.php';
	if('' !== $value) {
		if(is_null($value)) {
			if(is_file($filename)) {
				@unlink($filename); // delete cache
			}
			return;
		}
		else {
			$dir = dirname($filename);
			/* build cache */
			if(!is_dir($dir)) {
				mk_dir($dir);
			}
			$_cache[$name] = $value;
			return file_put_contents($filename, "<?php\r\nreturn " . var_export($value, true) . ";\r\n?>");
		}
	}
	if(isset($_cache[$name])) {
		return $_cache[$name];
	}
	if(is_file($filename)) {
		$value = include $filename;
		$_cache[$name] = $value;
		return $value;
	}
	return false;
}

/* The global cache get and set */
function S($name, $value = '', $expire = null, $options = null) {
	$type = isset($options['cacheType']) ? $options['cacheType'] : '';
	static $_cache = array();
	$cache = Cache::connect($options);
	if('' !== $value) {
		/* delete cache */
		if(is_null($value)) {
			$result = $cache->del($name);
			if($result) {
				unset($_cache[$type . '_' . $name]);
			}
			return $result;
		}
		/* set cache */
		else {
			$cache->set($name, $value, $expire);
			$_cache[$type . '_' . $name] = $value;
		}
		return;
	}
	if(isset($_cache[$type . '_' . $name])) {
		return $_cache[$type . '_' . $name];
	}
	/* get cache */
	$value = $cache->get($name);
	$_cache[$type . '_' . $name] = $value;
	return $value;
}

/* get and set count */
function N($key, $step = 0) {
	static $_num = array();
	if(!isset($_num[$key])) {
		$_num[$key] = 0;
	}
	if(empty($step)) {
		return $_num[$key];
	}
	else {
		$_num[$key] = $_num[$key] + (int)$step;
	}
}

/* get and set config */
function C($name = null, $value = null) {
	return _SG($name, $value, 'config');
}

/* get and set language */
function L($name = null, $value = null, $data = null) {
	$return = _SG($name, $value, 'language');
	if(is_array($data)) {
		foreach($data as $k => $v) {
			$return = str_replace("{\${$k}}", $v, $return);
		}
	}
	return $return;
}

/* get and set */
function _SG($key = null, $value = null, $name = 'default') {
	static $_temp = array();
	if(!isset($_temp[$name])) {
		$_temp[$name] = array();
	}
	/* get all */
	if(empty($key)) {
		return $_temp[$name];
	}
	if(is_string($key)) {
		if(!strpos($key, '.')) {
			if(is_null($value)) {
				return isset($_temp[$name][$key]) ? $_temp[$name][$key] : $key;
			}
			$_temp[$name][$key] = $value;
			return;
		}
		/* 2 dimensional array */
		$key = explode('.', $key);
		if(is_null($value)) {
			return isset($_temp[$name][$key[0]][$key[1]]) ? $_temp[$name][$key[0]][$key[1]] : $key[0] . '.' . $key[1];
		}
		$_temp[$name][$key[0]][$key[1]] = $value;
		return;
	}
	/* Batch definitions */
	if(is_array($key)) {
		foreach($key as $k => $v) {
			if(is_array($v)) {
				if(isset($_temp[$name][$k])) {
					$_temp[$name][$k] = array_merge($_temp[$name][$k], $v);
				}
				else {
					$_temp[$name][$k] = $v;
				}
			}
			else {
				$_temp[$name][$k] = $v;
			}
		}
	}
	return;
}

/* record and check time interval. record: I($name), check: I($name, $inerval) */
function I($name = 'interaction', $interval = '') {
	/* record */
	$name = 'I_' . $name;
	if(empty($interval)) {
		return ASession::set($name, time());
	}

	/* check */
	if(!ASession::get($name)) {
		ASession::set($name, time());
	}
	elseif((ASession::get($name) > time()) or ((time() - ASession::get($name)) < $interval)) {
		return false;
	}
	return true;
}

/* format print for debug */
function P() {
	/* get parameters */
	$args = func_get_args();
	if(count($args) < 1) {
		echo "<font color='red'>P() must have at least one arg!</font>";
		return;
	}
	echo "<div><pre>\r\n";
	foreach($args as $arg) {
		if(is_array($arg)) {
			print_r($arg);
		}
		elseif(is_string($arg)) {
			echo $arg . "<br />\r\n";
		}
		else {
			var_dump($arg);
		}
	}
	echo "</pre></div>\r\n";
}

/* get object instance */
function get_instance($class, $classArgs = array(), $method = '', $methodArgs = array()) {
	static $_instance = array();
	$identify = empty($classArgs) ? $class : $class . get_guid_string($classArgs);
	if(!isset($_instance[$identify])) {
		if(class_exists($class)) {
			$o = new $class($classArgs);
			if(method_exists($o, $method)) {
				if(!empty($args)) {
					$_instance[$identify] = call_user_func_array(array(&$o, $method), $methodArgs);
				}
				else {
					$_instance[$identify] = $o->$method();
				}
			}
			else {
				if('' == $method) {
					$_instance[$identify] = $o;
				}
				else {
					halt(L('_METHOD_NOT_EXIST_') . ' : ' . $method, true, true);
				}
			}
		}
		else {
			halt(L('_CLASS_NOT_EXIST_') . ' : ' . $class, true, true);
		}
	}
	return $_instance[$identify];
}

/* autoload class */
function __autoload($className) {
	/* load app's Ctrlr and Modl class */
	if('Modl' == substr($className, -4)) {
		$classfile = LIB_MODL_PATH . D_S . $className . '.class.php';
		require_cache($classfile);
	}
	elseif('Ctrlr' == substr($className, -5)) {
		if(defined('GROUP_NAME')) {
			$classfile = LIB_CTRLR_PATH . D_S . GROUP_NAME . D_S . $className . '.class.php';
			require_cache($classfile);
		}
		if(!file_exists($classfile)) {
			$classfile = LIB_CTRLR_PATH . D_S . $className . '.class.php';
			require_cache($classfile);
		}
	}
	else {
		$include_path = get_include_path();
		$include_path .= P_S . PFA_EXT_PATH; // PFA extension librar
		/* search autoload path */
		if(C('APP.AUTOLOAD_PATH')) {
			$paths = str_replace(',', P_S, C('APP.AUTOLOAD_PATH'));
			$include_path .= P_S . $paths;
		}
		set_include_path($include_path);
		import($className);
	}
	return;
}

/* import function library(filename replace ['/', '.'] by ['.', '#']) */
function load($name, $baseUrl = '', $ext = '.php') {
	$name = str_replace(array('.', '#'), array('/', '.'), $name);
	if(empty($baseUrl)) {
		$baseUrl = LIB_COMM_PATH; // default library path
	}
	$baseUrl = rtrim($baseUrl, '/\\') . D_S;
	return require_cache($baseUrl . $name . $ext);
}

/* import class(filename replace ['/', '.'] by ['.', '#']) ext autoload */
function import($class, $baseUrl = '', $ext = '.class.php') {
	static $_file = array();
	static $_class = array();
	$class = str_replace(array('.', '#'), array('/', '.'), $class);
	if(isset($_file[$class . $baseUrl])) {
		return true;
	}
	else {
		$_file[$class . $baseUrl] = true;
	}
	/* defaylt import file in set_include_path */
	if(empty($baseUrl)) {
		$include_path = get_include_path();
		$paths = explode(P_S, $include_path);
		foreach($paths as $path) {
			$classfile = $path . D_S . $class . $ext;
			/* check filename case */
			if(basename(realpath($classfile)) == basename($classfile)) {
				return require_cache($classfile);
			}
		}
	}
	if(substr($baseUrl, -1) != '/') {
		$baseUrl .= '/';
	}
	$classfile = $baseUrl . $class . $ext;
	if($ext == '.class.php' && is_file($classfile)) {
		/* class conflict detection */
		$class = basename($classfile, $ext);
		if(isset($_class[$class])) {
			halt(L('_CLASS_CONFLICT_') . ' : ' . $_class[$class] . ' ' . $classfile);
		}
		$_class[$class] = $classfile;
	}
	return require_cache($classfile);
}

/* import class in vendor dir, (filename replace ['/', '.'] by ['.', '#']) */
function vendor($class, $ext = '.php') {
	return import($class, PFA_VENDOR_PATH, $ext);
}

/* Generate a unique identification number from each type variable */
function get_guid_string($mix) {
	if(is_object($mix) && function_exists('spl_object_hash')) {
		return spl_object_hash($mix);
	}
	elseif(is_resource($mix)) {
		$mix = get_resource_type($mix) . strval($mix);
	}
	else {
		$mix = serialize($mix);
	}
	return md5($mix);
}

/* name style conversion 0:AaaBbb -> aaa_bbb, 1:aaa_bbb -> AaaBbb */
function parse_name($name, $type = 0) {
	if($type) {
		return ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));
	}
	else {
		$name = preg_replace("/[A-Z]/", "_\\0", $name);
		return strtolower(trim($name, "_"));
	}
}

/* optimization require_once */
function require_cache($filename) {
	static $_importFiles = array();
	$filename = realpath($filename);
	if(!isset($_importFiles[$filename]) && file_exists($filename)) {
		return $_importFiles[$filename] = require $filename;
	}
}

/* dir writable, attempt to create*/
function dir_writable($dir) {
	if(!is_dir($dir)) {
		mk_dir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink(realpath("$dir/test.txt"));
			return true;
		}
	}
	return false;
}

/* create dir(attempt to create parent dir) */
function mk_dir($path, $mode = 0777) {
	//$folder_path = array(strstr($path, '.') ? dirname($path) : $path);
	$folder_path = array($path);

	while(!@is_dir(dirname(end($folder_path))) && dirname(end($folder_path)) != '/' && dirname(end($folder_path)) != '.' && dirname(end($folder_path)) != '') {
		array_push($folder_path, dirname(end($folder_path)));
	}

	while($parent_folder_path = array_pop($folder_path)) {
		if(!@mkdir($parent_folder_path, $mode)) {
			return false;
		}
	}
	return true;
}

/* batch create dir */
function mkdirs($dirs, $mode = 0777) {
	foreach($dirs as $dir) {
		if(!is_dir($dir)) {
			mk_dir($dir, $mode);
		}
	}
}

/* clear file in dir. $sub:if clear sub dir, $exclude: exclude filename array, $self:if delete self */
function clear_dir($dir, $sub = false, $exclude = array(), $self = false) {
	if(false == ($handle = opendir($dir))) {
		return false;
	}

	while(($file = readdir($handle)) !== false) {
		if('.' == $file || '..' == $file || (!empty($exclude) and in_array($file, $exclude))) {
			continue;
		}

		if(is_dir("$dir/$file")) {
			if($sub and !clear_dir("$dir/$file", true, $exclude, $self)) {
				return false;
			}
		}
		else {
			if(!@unlink(realpath("$dir/$file"))) {
				return false;
			}
		}
	}
	if(readdir($handle) == false) {
		closedir($handle);
		if($self and empty($exclude)) {
			if(!@rmdir($dir)) {
				return false;
			}
		}
	}
	return true;
}

/* halt print when error */
function halt($error = '', $parseTpl = false, $header404 = false) {
	if($header404) {
		header('HTTP/1.1 404 Not Found');
		header("status: 404 Not Found");
	}
	if(IS_CLI) {
		exit($error);
	}
	if(C('DEBUG.SWITCH')) {
		if(!is_array($error)) {
			$e = array();
			$traceInfo = '';
			$trace = debug_backtrace();
			$e['message'] = $error;
			$e['file'] = $trace[0]['file'];
			$e['class'] = isset($trace[0]['class']) ? $trace[0]['class'] : '';
			$e['function'] = isset($trace[0]['function']) ? $trace[0]['function'] : '';
			$e['line'] = $trace[0]['line'];
			$time = date('c');
			foreach($trace as $t) {
				$traceInfo .= '[' . $time . '] ' . $t['file'] . ' (' . $t['line'] . ') ';
				$traceInfo .= isset($t['class']) ? $t['class'] : '';
				$traceInfo .= isset($t['type']) ? $t['type'] : '';
				$traceInfo .= $t['function'] . '(' . array_to_string($t['args']);
				$traceInfo .= ")<br/>";
			}
			$e['trace'] = $traceInfo;
		}
		else {
			$e = $error;
		}

		if(ob_get_length()) {
			ob_clean();
		}
		include C('TPL.ERR_DEBUG');
		exit();
	}
	else {
		if($parseTpl) {
			A()->assign('_ERR', $error);
			A()->display(C('TPL.ERR'));
			exit;
		}

		if(file_exists(C('TPL.ERR'))) {
			if(ob_get_length()) {
				ob_clean();
			}
			include C('TPL.ERR');
			exit();
		}
		else {
			exit($error);
		}
	}
}

/* URL redirect */
function redirect($url, $time = 0, $msg = '') {
	/* deal with multi-line url */
	$url = str_replace(array("\n", "\r"), '', $url);

	if(!headers_sent()) {
		if(0 === $time) {
			header("Location: " . $url);
		}
		else {
			header("refresh: {$time}; url = {$url}");
			echo ($msg);
		}
		exit();
	}
	else {
		$str = "<meta http-equiv='Refresh' content='{$time}; url={$url}'>";
		if(0 != $time) {
			$str .= $msg;
		}
		exit($str);
	}
}

/* array to string $level: parse level */
function array_to_string($array, $glue = ', ', $level = 1) {
	if(!is_array($array) || empty($array)) {
		return '';
	}
	$string = '';
	foreach($array as $k => $v) {
		if(0 != $level) {
			if(is_array($v)) {
				$string .= 'array(';
				$string .= array_to_string($v, $glue, $level - 1) . $glue;
				$string = rtrim($string, $glue) . ')' . $glue;
			}
			else {
				$string .= $v . $glue;
			}
		}
	}
	$string = rtrim($string, $glue);
	return $string;
}

/* remove white space and comments in the code */
function strip_whitespace($content) {
	$stripStr = '';

	/* Analysis php code */
	$tokens = token_get_all($content);
	$last_space = false;
	for($i = 0, $j = count($tokens); $i < $j; $i++) {
		if(is_string($tokens[$i])) {
			$last_space = false;
			$stripStr .= $tokens[$i];
		}
		else {
			switch($tokens[$i][0]) {
					/* remove comment */
				case T_COMMENT:
				case T_DOC_COMMENT:
					break;
					/* remove surplus whitespace */
				case T_WHITESPACE:
					if(!$last_space) {
						$stripStr .= ' ';
						$last_space = true;
					}
					break;
				case T_START_HEREDOC:
					$stripStr .= "<<<PFA\r\n";
					break;
				case T_END_HEREDOC:
					$stripStr .= "PFA;\r\n";
					for($k = $i + 1; $k < $j; $k++) {
						if(is_string($tokens[$k]) && $tokens[$k] == ";") {
							$i = $k;
							break;
						}
						else {
							if($tokens[$k][0] == T_CLOSE_TAG) {
								break;
							}
						}
					}
					break;
				default:
					$last_space = false;
					$stripStr .= $tokens[$i][1];
			}
		}
	}
	return $stripStr;
}

/* format byte to B KB MB GB TB */
function byte_format($size, $dec = 2) {
	$a = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	$pos = 0;
	while($size >= 1024) {
		$size /= 1024;
		$pos++;
	}
	return round($size, $dec) . ' ' . $a[$pos];
}

/* humane time format */
function get_dateStr($dateline) {
	$timeDif = intval(time() - $dateline);
	$now = getdate();
	$todayPassTime = $now['seconds'] + $now['minutes'] * 60 + $now['hours'] * 60 * 60;

	if($timeDif < 0) {
		return L('_IN_THE_FUTURE_');
	}
	elseif($timeDif < 60) {
		$timeDif = $timeDif == 0 ? 1 : $timeDif;
		return $timeDif . L('_SECOND_AGO_');
	}
	elseif($timeDif < 3600) {
		$timeDif = intval($timeDif / 60);
		return $timeDif . L('_MINUTE_AGO_');
	}
	elseif($timeDif < $todayPassTime) {
		$timeDif = intval($timeDif / 3600);
		return $timeDif . L('_HOUR_AGO_');
	}
	elseif($timeDif < $todayPassTime + 3600 * 24) {
		return L('_YESTERDAY_') . date(' H:i:s', $dateline);
	}
	elseif($timeDif < 3600 * 24 * 7) {
		$timeDif = intval($timeDif / 3600 / 24);
		return $timeDif . L('_DAY_AGO_');
	}
	return date(C('APP.TIME_FORMAT'), $dateline);
}

/* second format */
function second_format($second) {
	$years = floor($second / (3600*24*365));

	$second = $second % (3600*24*365);
	$months = floor($second / (3600*24*30));

	$second = $second % (3600*24*30);
	$weeks = floor($second / (3600*24*7));

	$second = $second % (3600*24*7);
	$days = floor($second / (3600*24));

	$second = $second % (3600*24);
	$hours = floor($second / 3600);

	$second = $second % 3600;
	$minutes = floor($second / 60);
	$seconds = ($second % 60);

	return ($years > 0 ? $years . L('_YEARS_') : '')
		. ($months > 0 ? $months . L('_MONTHS_') : '')
		. ($weeks > 0 ? $weeks . L('_WEEKS_') : '')
		. ($days > 0 ? $days . L('_DAYS_') : '')
		. ($hours > 0 ? $hours . L('_HOURS_') : '')
		. ($minutes > 0 ? $minutes . L('_MINUTES_') : '')
		. ($seconds > 0 ? $seconds . L('_SECONDS_') : '');
}

/* remove string from array */
function trim_array($a = array(), $charList = '') {
	if(0 == strlen($charList)) {
		foreach($a as $k => $v) {
			$a[$k] = trim($v);
		}
	}
	else {
		foreach($a as $k => $v) {
			$a[$k] = trim($v, $charList);
		}
	}
	return $a;
}

/* get app language set */
function get_langset($dir = '') {
	$items = array();

	$langset = require PFA_PATH . '/comm/langset.php';
	if(empty($dir)) {
		$dir = LANG_PATH;
	}

	$langDir = glob(rtrim($dir, '/\\') . D_S . '*');
	if(is_array($langDir)) {
		foreach($langDir as $v) {
			if(is_file($v) and '.lang.php' != substr($v, -9)) {
				continue;
			}
			$v = basename($v);
			if('.lang.php' == substr($v, -9)) {
				$v = substr($v, 0, -9);
			}
			$n = array_key_exists($v, $langset) ? $langset[$v] : $v;
			$items[] = array('alias' => $v, 'name' => $n);
		}
	}
	return $items;
}

/* strpos array */
function strpos_array($string, $array = array(), $return = false) {
	if(empty($string)) {
		return false;
	}
	foreach($array as $v) {
		if(strpos($string, $v) !== false) {
			return $return ? $v : true;
		}
	}
	return false;
}

/* detect user agent */
function detect_userAgent() {
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

	$padList = array('ipad');
	if(strpos_array($userAgent, $padList)) {
		return 1; //pad
	}

	$touchBrowserList = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini', 'ucweb',
		'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung', 'palmsource', 'xda', 'pieplus',
		'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser', 'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra',
		'coolpad', 'webos', 'techfaith', 'palmsource', 'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom',
		'bunjalloo', 'maui', 'smartphone', 'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser',
		'hiptop', 'benq', 'haier', '^lct', '320x320', '240x320', '176x220', 'windows phone');
	if(($v = strpos_array($userAgent, $touchBrowserList))) {
		return 2; //touch
	}

	$wmlBrowserList = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
		'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh', 'sed',
		'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
	if(($v = strpos_array($userAgent, $wmlBrowserList))) {
		return 3; //wml
	}

	$brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	if(strpos_array($userAgent, $brower)) {
		return 0; //pc
	}
}

//[RUNTIME]
/* compile file */
function compile($filename) {
	$content = file_get_contents($filename);
	/* replace pre-compile directive */
	$content = preg_replace('/\/\/\[RUNTIME\](.*?)\/\/\[\/RUNTIME\]/s', '', $content);
	$content = substr(trim($content), 5);
	if('?>' == substr($content, -2)) {
		$content = substr($content, 0, -2);
	}
	return $content;
}

/* define constant form array */
function array_define($array) {
	$content = '';
	foreach($array as $key => $val) {
		$key = strtoupper($key);
		$content .= 'if(!defined(\'' . $key . '\')) ';
		if(is_int($val) || is_float($val)) {
			$content .= "define('" . $key . "'," . $val . ");";
		}
		elseif(is_bool($val)) {
			$val = ($val) ? 'true' : 'false';
			$content .= "define('" . $key . "'," . $val . ");";
		}
		elseif(is_string($val)) {
			$content .= "define('" . $key . "','" . addslashes($val) . "');";
		}
	}
	return $content;
}
//[/RUNTIME]

?>