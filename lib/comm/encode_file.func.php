<?php

/**
 *--------------------------------------
 * encode file function library
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-01-26
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

/* get encode content from file list */
function get_fileListEncode($fileList = '') {
	$files = array();
	if(empty($fileList)) {
		return $files;
	}
	$fileList = trim_array(explode("\n", $fileList));
	foreach($fileList as $filename) {
		if(empty($filename)) {
			continue;
		}
		$filename = rtrim(str_replace('{uwa_path}', APP_PATH, $filename), "/\\");
		if(is_dir($filename)) {
			$_fileList = get_fileList($filename);
			foreach($_fileList as $_filename) {
				$files = array_merge($files, get_fileListEncode($_filename));
			}
		}
		elseif(is_file($filename)) {
			$content = get_fileEncode($filename);
			$files[] = array(
				'filename' => str_replace(APP_PATH, '{uwa_path}', $filename),
				'content' => $content,
				);
		}
	}
	return $files;
}

/* get encode content from file */
function get_fileEncode($filename, $delete = false) {
	if(!file_exists($filename) or !is_file($filename)) {
		return '';
	}
	$code = file_get_contents($filename);
	if(!empty($code)) {
		if($delete) {
			@unlink($filename);
		}
		return base64_encode($code);
	}
	return '';
}

/* output uwa package */
function output_uwaPackage($filename, $content = '', $compressed = true) {
	header('Content-Encoding: none');
	header('Pragma: no-cache');
	header('Expires: 0');
	if($compressed) {
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename=' . $filename);
		echo gzencode($content);
	}
	else {
		header('Content-Type: application/octet-stream');
		header('Accept-Ranges: bytes');
		//header('Accept-Length: '.filesize($file_dir . $file_name));
		header('Content-Disposition: attachment; filename=' . $filename);
		echo $content;
	}
	exit;
}

/* define gzdecode function */
if(!function_exists('gzdecode')) {
	function gzdecode($data) {
		$flags = ord(substr($data, 3, 1));
		$headerlen = 10;
		$extralen = 0;
		$filenamelen = 0;
		if($flags & 4) {
			$extralen = unpack('v', substr($data, 10, 2));
			$extralen = $extralen[1];
			$headerlen += 2 + $extralen;
		}
		if($flags & 8) { // Filename
			$headerlen = strpos($data, chr(0), $headerlen) + 1;
		}
		if($flags & 16) { // Comment
			$headerlen = strpos($data, chr(0), $headerlen) + 1;
		}
		if($flags & 2) { // CRC at end of file
			$headerlen += 2;
		}
		$unpacked = @gzinflate(substr($data, $headerlen));
		if($unpacked === false) {
			$unpacked = $data;
		}
		return $unpacked;
	}
}

?>