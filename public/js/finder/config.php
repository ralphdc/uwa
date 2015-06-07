<?php

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions

$_CONFIG = array(
'disabled' => true,
'denyZipDownload' => false,
'denyUpdateCheck' => true,
'denyExtensionRename' => false,

'browse_url' => 'browse.php?',

'theme' => "asthis",

'uploadURL' => "upload",
'uploadDir' => "",

'dirPerms' => 0755,
'filePerms' => 0644,

'access' => array(
	'files' => array(
		'upload' => true,
		'delete' => true,
		'copy' => true,
		'move' => true,
		'rename' => true
	),

	'dirs' => array(
		'create' => true,
		'delete' => true,
		'rename' => true
	)
),

'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",

'types' => array(
	// CKEditor & FCKEditor types
	'files' => "",
	'flash' => "swf",
	'images' => "*img",

	// TinyMCE types
	'file' => "",
	'media' => "swf flv avi mpg mpeg qt mov wmv asf rm",
	'image' => "*img",
),

'maxFileSize' => 200000,

'filenameChangeChars' => array(/*
	' ' => "_",
	':' => "."
*/),

'dirnameChangeChars' => array(/*
	' ' => "_",
	':' => "."
*/),

'mime_magic' => "",

'maxImageWidth' => 0,
'maxImageHeight' => 0,

'thumbWidth' => 100,
'thumbHeight' => 100,

'thumbsDir' => ".thumbs",

'jpegQuality' => 90,

'cookieDomain' => "",
'cookiePath' => "",
'cookiePrefix' => 'FINDER_',

'check4htaccess' => true, //the upload dir php_value engine off

// THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
//'_tinyMCEPath' => "/tiny_mce",

'_sessionVar' => &$_SESSION['FINDER'],
//'_sessionLifetime' => 30,
//'_sessionDir' => "/full/directory/path",

//'_sessionDomain' => ".mysite.com",
//'_sessionPath' => "/my/path",
);

?>