<?php

/**
 *--------------------------------------
 * extension
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-19
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ExtensionModl extends Modl {
	public function get_extensionMenu($eType = '') {
		$_EML = array();
		$where = array();
		if(!empty($eType)) {
			$where['e_type'] = array('EQ', $eType);
		}

		$_EL = $this->where($where)->field('e_manage_menu')->select();
		if(empty($_EL)) {
			return $_EML;
		}
		foreach($_EL as $e) {
			if(empty($e['e_manage_menu'])) {
				continue;
			}
			$pattern = '/\[(\S+)\|(\S+)\|(\S+)\]/isU';
			if(preg_match_all($pattern, $e['e_manage_menu'], $result)) {
				unset($result[0]);
				foreach($result[1] as $k => $v) {
					$_EML[] = array(
						'm_name' => $v,
						'm_alias' => $result[2][$k],
						'm_url' => $result[3][$k],
						);
				}
			}
		}
		return $_EML;
	}

	public function get_extensionList($extensionType = '') {
		$_EL = array();
		$dh = dir(RUNTIME_PATH . D_S . 'extension');
		while(false !== ($filename = $dh->read())) {
			if(preg_match("/\.extension.php$/", $filename)) {
				$_t_ei = $this->get_extensionInfo(str_replace('.extension.php', '', $filename));
				if('' != $extensionType && $extensionType != $_t_ei['e_type']) {
					continue;
				}
				if('' != $_t_ei['e_hashcode']) {
					unset($_t_ei['e_instruction']);
					unset($_t_ei['e_install']);
					unset($_t_ei['e_uninstall']);
					unset($_t_ei['file_list']);
					$_EL[$_t_ei['e_hashcode']] = $_t_ei;
				}
			}
		}
		$dh->close();
		return $_EL;
	}

	public function get_extensionInfo($hashcode) {
		$_EI = '';
		$filename = RUNTIME_PATH . D_S . 'extension' . D_S . $hashcode . '.extension.php';
		$installLockFilename = RUNTIME_PATH . D_S . 'extension' . D_S . $hashcode . '.install.lock.php';
		if(is_file($filename)) {
			$_EI = require_cache($filename);
			$_EI['e_instruction'] = base64_decode($_EI['e_instruction']);
			$_EI['e_install'] = base64_decode($_EI['e_install']);
			$_EI['e_uninstall'] = base64_decode($_EI['e_uninstall']);
			$_EI['e_lang'] = base64_decode($_EI['e_lang']);
			$_EI['e_route'] = base64_decode($_EI['e_route']);
			$_EI['e_status'] = 0;
			if(is_file($installLockFilename)) {
				$_EI['e_status'] = 1;
				$_EI['e_install_datetime'] = filemtime($installLockFilename);
			}
		}
		return $_EI;
	}

	public function install_extension($_EI) {
		$result = array('data' => '', 'error' => '');

		$installLockFilename = RUNTIME_PATH . D_S . 'extension' . D_S . $_EI['e_hashcode'] . '.install.lock.php';
		$_t_ei = $this->where(array('e_hashcode' => array('EQ', $_EI['e_hashcode'])))->find();
		if(is_file($installLockFilename) or !empty($_t_ei)) {
			$result['error'] = L('EXTENSION_EXIST');
			return $result;
		}

		$data = array(
			'e_hashcode' => $_EI['e_hashcode'],
			'e_name' => $_EI['e_name'],
			'e_alias' => $_EI['e_alias'],
			'e_type' => $_EI['e_type'],
			'e_manage_menu' => $_EI['e_manage_menu'],
			);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('INSTALL_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		/* execute install SQL */
		$_t_sql = trim_array(explode(';', str_replace(array(
			'{uwa_url}',
			'{-time-}',
			'{-ip-}'), array(
			__APP__,
			time(),
			AServer::get_ip()), $_EI['e_install'])));
		if(!empty($_t_sql)) {
			foreach($_t_sql as $sql) {
				M()->execute($sql, true);
			}
		}

		/* check language */
		if(!empty($_EI['e_lang'])) {
			$_t_lang = array();
			$_lang_set = trim_array(explode("\n", $_EI['e_lang']));
			foreach($_lang_set as $ls) {
				$_t_ls = trim_array(explode("=", $ls));
				if(isset($_t_ls[1]) and !empty($_t_ls[1])) {
					$_t_lang[$_t_ls[0]] = $_t_ls[1];
				}
			}
			if(!empty($_t_lang)) {
				load('encode_file#func');
				$filename = APP_PATH . '/lang/' . C('LANG.NAME') . '/comm.lang.php';
				$content = base64_encode("<?php\r\nreturn " . var_export(array_merge(include ($filename), $_t_lang), true) . ";\r\n?>");
				$_EI['file_list'][] = array(
					'filename' => str_replace(APP_PATH, '{uwa_path}', $filename),
					'content' => $content,
					'overwrite' => 1,
					);
			}
		}

		/* check route */
		if(!empty($_EI['e_route'])) {
			$_t_route = array();
			$_route_set = trim_array(explode("\n", $_EI['e_route']));
			foreach($_route_set as $rs) {
				$_t_rs = trim_array(explode("=", $rs));
				if(isset($_t_rs[1]) and !empty($_t_rs[1])) {
					$_t_route[$_t_rs[0]] = $_t_rs[1];
				}
			}
			if(!empty($_t_route)) {
				load('encode_file#func');
				$filename = APP_PATH . '/cfg/route.php';
				$content = base64_encode("<?php\r\nreturn " . var_export(array_merge(include ($filename), $_t_route), true) . ";\r\n?>");
				$_EI['file_list'][] = array(
					'filename' => str_replace(APP_PATH, '{uwa_path}', $filename),
					'content' => $content,
					'overwrite' => 1,
					);
			}
		}

		/* backup file */
		if(!empty($_EI['file_list'])) {
			$fileListBackup = $this->backup_file($_EI['file_list']);
		}

		/* lock install */
		if(0 == $this->lock_install($_EI, $fileListBackup)) {
			$result['error'] .= L('FILE_WRITE_FAILED', null, array('filename' => $installLockFilename));
		}

		return $result;
	}

	public function uninstall_extension($_EI) {
		$result = array('data' => '', 'error' => '');

		$installLockFilename = RUNTIME_PATH . D_S . 'extension' . D_S . $_EI['e_hashcode'] . '.install.lock.php';
		if(!is_file($installLockFilename)) {
			$result['error'] = L('EXTENSION_INEXISTENCE');
			return $result;
		}

		if(false === $this->where(array('e_hashcode' => array('EQ', $_EI['e_hashcode'])))->delete()) {
			$result['error'] = L('UNINSTALL_FAILED');
			return $result;
		}

		/* execute uninstall SQL */
		$_t_sql = trim_array(explode(';', str_replace('{uwa_url}', __APP__, $_EI['e_uninstall'])));
		if(!empty($_t_sql)) {
			foreach($_t_sql as $sql) {
				M()->execute($sql, true);
			}
		}

		/* restore file */
		$this->restore_file($_EI['file_list'], require_cache($installLockFilename), filemtime($installLockFilename));

		/* delete lock file */
		@unlink($installLockFilename);

		return $result;
	}

	private function backup_file($fileList) {
		$fileListBackup = array();
		load('encode_file#func');
		foreach($fileList as $file) {
			$filename = str_replace('{uwa_path}', APP_PATH, $file['filename']);
			if(is_file($filename) and (isset($file['overwrite']) and 1 == $file['overwrite'])) {
				$fileListBackup[] = array(
					'filename' => $file['filename'],
					'content' => get_fileEncode($filename),
					'modify_time' => filemtime($filename),
					'access_time' => fileatime($filename));
			}
			if(!is_file($filename) or (isset($file['overwrite']) and 1 == $file['overwrite'])) {
				if(false == dir_writable(dirname($filename))) {
					$fileListBackup['failed'][] = $file['filename'];
					continue;
				}
				if(0 == file_put_contents($filename, base64_decode($file['content']))) {
					$fileListBackup['failed'][] = $file['filename'];
					continue;
				}
			}
		}
		return $fileListBackup;
	}

	private function restore_file($fileList, $fileListBackup, $installDatetime) {
		/* delete file */
		foreach($fileList as $file) {
			$filename = str_replace('{uwa_path}', APP_PATH, $file['filename']);
			if(filemtime($filename) <= $installDatetime) { /* whether the file has changed */
				@unlink($filename);
			}
		}
		/* restore file */
		foreach($fileListBackup as $file) {
			$filename = str_replace('{uwa_path}', APP_PATH, $file['filename']);
			if(filemtime($filename) <= $installDatetime) { /* whether the file has changed */
				file_put_contents($filename, base64_decode($file['content']));
				touch($filename, $file['modify_time'], $file['access_time']);
			}
		}
	}

	private function lock_install($_EI, $fileListBackup) {
		$installLockFilename = RUNTIME_PATH . D_S . 'extension' . D_S . $_EI['e_hashcode'] . '.install.lock.php';
		$content = "<?php\r\n";
		$content .= "//install information\r\n";
		$content .= "//----------------------------------------\r\n";
		$content .= "//extension name: " . $_EI['e_name'] . "\r\n";
		$content .= "//hashcode: " . $_EI['e_hashcode'] . "\r\n";
		$content .= "//time: " . date('Y-m-d H:i:s T', time()) . "\r\n";
		$content .= "//file list backup:\r\n";
		$content .= "return " . var_export($fileListBackup, true) . ";\r\n";
		$content .= "?>";
		return file_put_contents($installLockFilename, $content);
	}

}

?>