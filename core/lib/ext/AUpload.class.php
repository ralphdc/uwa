<?php

/**
 *--------------------------------------
 * upload
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AUpload {
	public $uploadDir;
	public $maxSize = 2000000;
	public $typeset = array(
		'gif',
		'jpg',
		'jpeg',
		'png');
	public $typeGetMethod = 1; // 1: extension, 2: file header info
	public $fileNaming = 1; // 0:original, 1:md5($name.time()), other:custom
	public $uploadError;

	public function __construct($config = array()) {
		$classVar = get_class_vars(get_class($this));
		foreach($config as $k => $v) {
			if(array_key_exists($k, $classVar)) {
				$this->$k = $v;
			}
		}
		$this->set_uploadDir($this->uploadDir);
	}

	public function set_uploadDir($uploadDir) {
		$uploadDir = rtrim($uploadDir, "\\/") . D_S;
		if(!dir_writable($uploadDir)) {
			$this->uploadError['code'][] = "-1";
			$this->uploadError['msg'][] = L('_DIR_READONLY_', null, array('dir' => $uploadDir));
			return false;
		}
		$this->uploadDir = $uploadDir;
		return true;
	}

	/* upload */
	public function do_upload($field, $uploadDir = '') {
		$this->uploadError = array();
		if(!empty($uploadDir)) {
			$this->set_uploadDir($uploadDir);
		}
		if(isset($_FILES[$field])) {
			$name = $_FILES[$field]['name'];
			$tmpName = $_FILES[$field]['tmp_name'];
			$error = $_FILES[$field]['error'];
			$size = $_FILES[$field]['size'];
			if('1' == $this->typeGetMethod) {
				$type = $this->get_fileType($name);
			}
			else {
				$type = $this->get_fileRealType($tmpName);
			}

			$this->check_error($error);
			$this->check_size($size);
			$this->check_fileType($type, $this->typeset);

			if(empty($this->uploadError)) {
				$newName = $this->get_newName($name, $type, $this->fileNaming);
				$this->save_file($tmpName, $newName);
			}
			if(empty($this->uploadError)) {
				$uploadFile['name'] = $newName;
				$uploadFile['original_name'] = $name;
				$uploadFile['type'] = $type;
				$uploadFile['size'] = $size;
				return $uploadFile;
			}
		}
		return '';
	}

	/* save remote file */
	public function save_remoteFile($url) {
		$this->uploadError = array();
		$reExt = '(' . implode('|', $this->typeset) . ')';
		/* base64 encode image */
		if(substr($url, 0, 10) == 'data:image') {
			if(!preg_match('/^data:image\/' . $reExt . '/i', $url, $sExt)) {
				$this->uploadError['code'][] = "-3";
				$this->uploadError['msg'][] = L('_FILE_TYPE_NOT_ALLOWED_', null, array('type' => $type));
				return '';
			}
			$sExt = $sExt[1];
			$fileContent = base64_decode(substr($url, strpos($url, 'base64,') + 7));
		}
		else {
			$sExt = $this->get_fileType($url);
			if(!in_array($sExt, $this->typeset)) {
				$this->uploadError['code'][] = "-3";
				$this->uploadError['msg'][] = L('_FILE_TYPE_NOT_ALLOWED_', null, array('type' => $type));
				return '';
			}
			$fileContent = $this->get_url($url);
		}

		if($this->maxSize < strlen($fileContent)) {
			$this->uploadError['code'][] = "-2";
			$this->uploadError['msg'][] = L('_FILE_SIZE_EXCEEDS_DEFINE_', null, array('define_type' => 'CLASS', 'maxsize' => '[' . byte_format($this->maxSize) . ']'));
			return '';
		}
		$newName = $this->get_newName($url, $sExt, 1);
		$localFile = $this->uploadDir . $newName;
		file_put_contents($localFile, $fileContent);
		$uploadFile['name'] = $newName;
		$uploadFile['original_name'] = $url;
		$uploadFile['type'] = $sExt;
		$uploadFile['size'] = strlen($fileContent);
		return $uploadFile;
	}
	/* grab URL data */
	private function get_url($url, $jumpNums = 0) {
		$arrUrl = parse_url(trim($url));
		if(!$arrUrl) {
			return '';
		}
		$host = $arrUrl['host'];
		$port = isset($arrUrl['port']) ? $arrUrl['port'] : 80;
		$path = $arrUrl['path'] . (isset($arrUrl['query']) ? "?" . $arrUrl['query'] : '');
		$fp = @fsockopen($host, $port, $errno, $errstr, 10);
		if(!$fp) {
			return '';
		}
		$output = "GET $path HTTP/1.0\r\nHost: $host\r\nReferer: $url\r\nConnection: close\r\n\r\n";
		stream_set_timeout($fp, 60);
		@fputs($fp, $output);
		$content = '';
		while(!feof($fp)) {
			$buffer = fgets($fp, 4096);
			$info = stream_get_meta_data($fp);
			if($info['timed_out']) {
				return '';
			}
			$content .= $buffer;
		}
		@fclose($fp);
		if(preg_match("/^HTTP\/\d.\d (301|302)/is", $content) && $jumpNums < 5) {
			if(preg_match("/Location:(.*?)\r\n/is", $content, $murl)) {
				return $this->get_url($murl[1], $jumpNums + 1);
			}
		}
		if(!preg_match("/^HTTP\/\d.\d 200/is", $content)) {
			return '';
		}
		$content = explode("\r\n\r\n", $content, 2);
		$content = $content[1];
		if($content) {
			return $content;
		}
		return '';
	}

	private function check_error($error) {
		if(is_array($error)) {
			foreach($error as $e) {
				$this->check_error($e);
			}
		}
		elseif($error > 0) {
			switch($error) {
				case 1:
					$this->uploadError['code'][] = "1";
					$this->uploadError['msg'][] = L('_FILE_SIZE_EXCEEDS_DEFINE_', null, array('define_type' => 'php.ini', 'maxsize' => ''));
					break;
				case 2:
					$this->uploadError['code'][] = "2";
					$this->uploadError['msg'][] = L('_FILE_SIZE_EXCEEDS_DEFINE_', null, array('define_type' => 'HTML form', 'maxsize' => ''));
					break;
				case 3:
					$this->uploadError['code'][] = "3";
					$this->uploadError['msg'][] = L('_PARTIALLY_UPLOADED_');
					break;
				case 4:
					$this->uploadError['code'][] = "4";
					$this->uploadError['msg'][] = L('_NO_FILE_UPLOADED_');
					break;
				case 6:
					$this->uploadError['code'][] = "6";
					$this->uploadError['msg'][] = L('_MISSING_TEMP_DIR_');
					break;
				case 7:
					$this->uploadError['code'][] = "7";
					$this->uploadError['msg'][] = L('_FILE_WRITE_FAILED_');
					break;
				default:
					$this->uploadError['code'][] = "8";
					$this->uploadError['msg'][] = L('_ERROR_UNKNOWN_');
			}
		}
	}

	private function check_size($size) {
		if(is_array($size)) {
			foreach($size as $s) {
				$this->check_size($s);
			}
		}
		elseif($this->maxSize < $size) {
			$this->uploadError['code'][] = "-2";
			$this->uploadError['msg'][] = L('_FILE_SIZE_EXCEEDS_DEFINE_', null, array('define_type' => 'CLASS', 'maxsize' => '[' . byte_format($this->maxSize) . ']'));
		}
	}

	private function check_fileType($type, $typeset) {
		if(is_array($type)) {
			foreach($type as $t) {
				$this->check_fileType($t, $typeset);
			}
		}
		else {
			if(!in_array($type, $typeset)) {
				$this->uploadError['code'][] = "-3";
				$this->uploadError['msg'][] = L('_FILE_TYPE_NOT_ALLOWED_', null, array('type' => $type));
			}
		}
	}

	private function get_newName($name, $type, $fileNaming) {
		if('0' == $fileNaming) {
			$newName = $name;
		}
		elseif('1' == $fileNaming) {
			if(is_array($name)) {
				foreach($name as $k => $name) {
					$newName[$k] = substr(md5($name . time()), 0, 16) . '.' . $type[$k];
				}
			}
			else {
				$newName = substr(md5($name . time()), 0, 16) . '.' . $type;
			}
		}
		else {
			if(is_array($name)) {
				foreach($name as $k => $name) {
					$newName[$k] = date($fileNaming);
				}
			}
			else {
				$newName = date($fileNaming);
			}
		}
		return $newName;
	}

	private function save_file($tmpName, $newName) {
		if(is_array($tmpName)) {
			foreach($tmpName as $k => $tn) {
				if(!move_uploaded_file($tn, $this->uploadDir . $newName[$k])) {
					$this->uploadError['code'][] = "-4";
					$this->uploadError['msg'][] = L('_UPLOAD_FAILED_');
				}
			}
		}
		elseif(is_uploaded_file($tmpName)) {
			if(!move_uploaded_file($tmpName, $this->uploadDir . $newName)) {
				$this->uploadError['code'][] = "-4";
				$this->uploadError['msg'][] = L('_UPLOAD_FAILED_');
			}
		}
		else {
			$this->uploadError['code'][] = "-5";
			$this->uploadError['msg'][] = L('_TMPFILE_NOT_UPLOAD_FILE_');
		}
	}

	private function get_fileType($fileName) {
		if(!empty($fileName) && !is_dir($fileName)) {
			$fileName = explode('.', $fileName);
			return $fileType = strtolower($fileName[count($fileName) - 1]);
		}
		return '';
	}

	private function get_fileRealType($fileName) {
		if(file_exists($fileName)) {
			$file = fopen($fileName, "rb");
			$bin = fread($file, 2);
			fclose($file);
			$strInfo = @unpack("c2chars", $bin);
			$typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
			$fileType = '';
			switch($typeCode) {
				case 7790:
					$fileType = 'exe';
					break;
				case 7784:
					$fileType = 'midi';
					break;
				case 8297:
					$fileType = 'rar';
					break;
				case 255216:
					$fileType = 'jpg';
					break;
				case - 1:
					$fileType = 'jpg';
					break;
				case 7173:
					$fileType = 'gif';
					break;
				case 6677:
					$fileType = 'bmp';
					break;
				case 8075:
					$fileType = 'zip';
					break;
				case 13780:
					$fileType = 'png';
					break;
				case - 11980:
					$fileType = 'png';
					break;
				default:
					$fileType = L('_UNKNOWN_');
			}
			return $fileType;
		}
		return '';
	}
}
/**
 * Usage:
 * ----------------------------------------
 * $field = 'upload_file';
 * $field1 = 'upload_file_1';
 * $uploadDir = './upload/';
 * $uploadDir1 = './upload1/';

 * $_upload = new AUpload(array(
 * 'uploadDir' => $uploadDir,
 * 'maxSize' => '1000000',
 * 'typeset' => array('gif', 'jpg', 'png'))
 * );
 * print_r($upload = $_upload->do_upload($field));
 * print_r($upload = $_upload->do_upload($field1, $uploadDir1));
 * print_r($remote = $_upload->save_remoteImg('http://rzpackage.com/logo.png'));
 * ----------------------------------------
 * <form action="" method="post" enctype="multipart/form-data">
 * <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
 * <input name="upload_file[]" type="file" accept="up_field" size="20" />
 * <input name="upload_file[]" type="file" accept="up_field" size="20" />
 * <input name="upload_file_1" type="file" accept="up_field" size="20" />
 * <input type="submit" />
 * </form>
 */

?>