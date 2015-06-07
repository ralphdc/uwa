<?php

/**
 *--------------------------------------
 * template
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-21
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TemplateModl extends Modl {
	public function get_templateList() {
		$_TL = array();

		$dh = dir(TPL_PATH);
		while(false !== ($fs = $dh->read())) {
			if('.' == $fs or '..' == $fs or '.svn' == $fs or '_names.php' == $fs or 'index.html' == $fs) {
				continue;
			}

			if(is_dir(TPL_PATH . D_S . $fs)) {
				$_d = $this->get_description($fs);
				if(isset($_d['info'])) {
					$_d['info']['alias'] = $fs;
					$_TL[] = $_d['info'];
				}
			}
		}
		return $_TL;
	}

	/* get template file list */
	public function get_templateFileList($template, $currentDir, $baseDir = '') {
		$_FL['base_dir'] = $baseDir;

		$baseDir = TPL_PATH . D_S . $template . (!empty($baseDir) ? D_S . $baseDir : '');
		$currentPath = $baseDir . $currentDir;

		$_FL['template'] = $template;
		$_FL['parent_dir'] = str_replace(array(D_S, '.'), array('*', '@'), dirname($currentDir));
		$_FL['current_dir'] = str_replace(array(D_S, '.'), array('*', '@'), $currentDir);

		$_FL['is_locked'] = $this->check_lock($template, $_FL['current_dir']);

		if(is_dir($currentPath)) {
			$dh = dir($currentPath);
			while(false !== ($fs = $dh->read())) {
				if('.' == $fs or '..' == $fs or '.svn' == $fs or '_names.php' == $fs or '_descriptions.php' == $fs or 'index.html' == $fs) {
					continue;
				}

				if(is_dir($currentPath . D_S . $fs)) {
					$dir['name'] = str_replace(array(D_S, '.'), array('*', '@'), $fs);
					$dir['description'] = $this->get_templateDescription($template, (!empty($_FL['base_dir']) ? '*' . $_FL['base_dir'] : '') . $_FL['current_dir'] . '*' . $dir['name']);
					$_FL['list']['dir'][] = $dir;
				}
				else {
					$fileNameInfo = explode('.', $fs);
					$file['name'] = $fs;
					$file['type'] = $fileNameInfo[count($fileNameInfo) - 1];
					$file['description'] = $this->get_templateDescription($template, (!empty($_FL['base_dir']) ? '*' . $_FL['base_dir'] : '') . $_FL['current_dir'] . '*' . $file['name']);
					$file['size'] = byte_format(filesize($currentPath . D_S . $fs));
					$file['edit_time'] = date(C('APP.TIME_FORMAT'), filemtime($currentPath . D_S . $fs));
					$_FL['list']['file'][] = $file;
				}
			}
		}
		return $_FL;
	}

	/* get file description */
	public function get_templateDescription($template, $filename) {
		$_D = $this->get_description($template);

		$dir = 'template' . $filename;
		$_filename = explode('*', $dir);
		$filename = $_filename[count($_filename) - 1];
		$dir = substr($dir, 0, -strlen($filename) - 1);

		return isset($_D['file_description'][$dir][$filename]) ? $_D['file_description'][$dir][$filename] : '';
	}

	/* add template directory */
	public function add_templateDir($template, $dir, $dirname, $dirDescription) {
		$result = array('data' => '', 'error' => '');

		$templateDirname = TPL_PATH . D_S . $template . str_replace(array('*', '@'), array(D_S, '.'), $dir) . D_S . $dirname;
		if(is_dir($templateDirname)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $dirname . ']' . L('EXIST');
			return $result;
		}

		if(!mk_dir($templateDirname)) {
			$result['error'] = L('DIR_MAKE_FAILED', null, array('dirname' => $template . $dir . '*' . $dirname));
			return $result;
		}
		if(!$this->edit_templateDescription($template, $dir, $dirname, $dirDescription)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* delete template directory */
	public function delete_templateDir($template, $dir, $dirname) {
		$result = array('data' => '', 'error' => '');

		$templateDir = TPL_PATH . D_S . $template . str_replace(array('*', '@'), array(D_S, '.'), $dir) . D_S . $dirname;

		if(!is_dir($templateDir)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $dirname . ']' . L('INEXISTENCE');
			return $result;
		}
		if(!clear_dir($templateDir, true, array(), true)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $dirname . ']' . L('DELETE_FAILED');
			return $result;
		}
		if(!$this->delete_templateDescription($template, $dir, $dirname, true)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* add template file */
	public function add_templateFile($template, $dir, $file, $content, $fileDescription) {
		$result = array('data' => '', 'error' => '');

		$templateFilename = TPL_PATH . D_S . $template . str_replace(array('*', '@'), array(D_S, '.'), $dir) . D_S . $file;
		if(is_file($templateFilename)) {
			$result['error'] = L('FILE[' . $template . $dir . '*' . $file . ']' . L('EXIST'));
			return $result;
		}

		if(MAGIC_QUOTES_GPC) {
			$content = stripslashes($content);
		}

		if(!file_put_contents($templateFilename, $content)) {
			$result['error'] = L('FILE_WRITE_FAILED', null, array('filename' => $file));
			return $result;
		}
		if(!$this->edit_templateDescription($template, $dir, $file, $fileDescription)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* edit template file */
	public function edit_templateFile($template, $dir, $file, $content, $fileDescription) {
		$result = array('data' => '', 'error' => '');

		$templateFilename = TPL_PATH . D_S . $template . str_replace(array('*', '@'), array(D_S, '.'), $dir) . D_S . $file;
		if(!is_file($templateFilename)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $file . ']' . L('INEXISTENCE');
			return $result;
		}

		if(MAGIC_QUOTES_GPC) {
			$content = stripslashes($content);
		}

		if(!file_put_contents($templateFilename, $content)) {
			$result['error'] = L('FILE_WRITE_FAILED', null, array('filename' => $file));
			return $result;
		}
		if(!$this->edit_templateDescription($template, $dir, $file, $fileDescription)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* delete template file */
	public function delete_templateFile($template, $dir, $file) {
		$result = array('data' => '', 'error' => '');

		$templateFile = TPL_PATH . D_S . $template . str_replace(array('*', '@'), array(D_S, '.'), $dir) . D_S . $file;

		if(!is_file($templateFile)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $file . ']' . L('INEXISTENCE');
			return $result;
		}
		if(!@unlink($templateFile)) {
			$result['error'] = 'FILE[' . $template . $dir . '*' . $file . ']' . L('DELETE_FAILED');
			return $result;
		}
		if(!$this->delete_templateDescription($template, $dir, $file)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* delete template description */
	public function delete_templateDescription($template, $dir, $file, $isDir = false) {
		$_D = $this->get_description($template);

		unset($_D['file_description']['template' . $dir][$file]);
		if($isDir) {
			unset($_D['file_description']['template' . $dir . '*' . $file]);
		}

		return $this->save_descriptionFile($template, $_D);
	}

	/* edit template description of a file */
	public function edit_templateDescription($template, $dir, $file, $fileDescription) {
		$_D = $this->get_description($template);

		$_D['file_description']['template' . $dir][$file] = $fileDescription;

		return $this->save_descriptionFile($template, $_D);
	}

	/* batch update template description */
	public function update_templateDescription($template, $file, $fileDescription) {
		$result = array('data' => '', 'error' => '');

		$_D = $this->get_description($template);

		$description = array();
		foreach($file as $k => $filename) {
			$dir = 'template' . $filename;
			$_filename = explode('*', $dir);
			$filename = $_filename[count($_filename) - 1];
			$dir = substr($dir, 0, -strlen($filename) - 1);
			$description[$dir][$filename] = $fileDescription[$k];
		}
		foreach($description as $k => $d) {
			$_D['file_description'][$k] = $d;
		}

		if(!$this->save_descriptionFile($template, $_D)) {
			$result['error'] = L('SAVE_DESCRIPTION_FILE_FAILED');
			return $result;
		}

		return $result;
	}

	/* check lock, default admin template is locked. $currentDir: *admin*some.php */
	public function check_lock($template, $currentDir) {
		$_group = explode('*', ltrim($currentDir, '*'), 2);
		return ('default' == $template and 'admin' == $_group[0]) ? true : false;
	}

	/* get description, create default description file when it is not exsit */
	private function get_description($template) {
		$_df = TPL_PATH . D_S . $template . D_S . '_descriptions.php';
		if(!is_file($_df)) {
			$_D = array('info' => array(
					'name' => $template,
					'author' => L('UNKNOWN'),
					'author_site' => L('UNKNOWN'),
					'version' => L('UNKNOWN'),
					), 'file_description' => array('template' => array(
						'home' => L('TPL_HOME'),
						'member' => L('TPL_MEMBER'),
						), ));
			$this->save_descriptionFile($template, $_D);
		}

		$_D = include ($_df);
		return $_D;
	}

	/* save description file */
	private function save_descriptionFile($template, $_D) {
		$_df = TPL_PATH . D_S . $template . D_S . '_descriptions.php';
		$content = var_export($_D, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";
		if(!@file_put_contents($_df, $content)) {
			return false;
		}
		return true;
	}

	/* check the dir string in template */
	public static function check_dirStr($dir) {
		if(false !== strpos($dir, '.') or false !== strpos($dir, '/') or '' != strstr($dir, '@@*')) {
			return false;
		}
		return true;
	}

	/* check the filename in template */
	public static function check_tplFilename($filename) {
		if(false !== strpos($filename, '/') or false !== strpos($dir, '*')) {
			return false;
		}
		return true;
	}

}

?>