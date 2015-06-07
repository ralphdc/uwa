<?php /* @desc Join all JavaScript files in current directory */

/* PATH */
if(!defined('FINDER_PATH')) {
	define('FINDER_PATH', dirname(dirname(dirname(__FILE__))));
}
if(!defined('D_S')) {
	define('D_S', DIRECTORY_SEPARATOR);
}
if(!isset($_SESSION)) {
	session_start();
}

define('__FINDER__', 'http://'.$_SERVER['HTTP_HOST'].'/'.dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/');

require FINDER_PATH . D_S . "core/autoload.php";

require FINDER_PATH . D_S . "config.php";
$config = $_CONFIG;
if(isset($_CONFIG['_sessionVar']) && is_array($_CONFIG['_sessionVar'])) {
	foreach($_CONFIG['_sessionVar'] as $key => $val) {
		if((substr($key, 0, 1) != "_") && isset($_CONFIG[$key])) {
			$config[$key] = $val;
		}
	}
}

chdir(".."); // For compatibality
chdir("..");
require FINDER_PATH . D_S . 'lib/httpCache.class.php';
require FINDER_PATH . D_S . 'lib/dir.class.php';
$files = dir::content(FINDER_PATH . D_S . 'js/browser', array(
	'types' => 'file',
	'pattern' => '/^.*\.js$/'
));

foreach($files as $file) {
	$fmtime = filemtime($file);
	if(!isset($mtime) || ($fmtime > $mtime)) {
		$mtime = $fmtime;
	}
}

httpCache::checkMTime($mtime);
header("Content-Type: text/javascript");
echo "/* ".$config['uploadDir']." */";
foreach($files as $file) {
	require $file;
}

?>