<?php

/**
 *--------------------------------------
 * database
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-25
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class DatabaseModl extends Modl {
	public function get_tableList() {
		$tablelist = array('core' => array(), 'other' => array());
		$tables = $this->db->get_tables();
		if(empty($tables)) {
			return null;
		}
		foreach($tables as $table) {
			$tableInfo = $this->query('SHOW TABLE STATUS WHERE NAME = \'' . $table . '\';');
			$tableInfo[0]['Data_length'] = byte_format($tableInfo[0]['Data_length']);
			$tableInfo[0]['Index_length'] = byte_format($tableInfo[0]['Index_length']);
			$tableInfo[0]['Data_free'] = byte_format($tableInfo[0]['Data_free']);
			if(preg_match('/^' . C('DB.PREFIX') . '/', $tableInfo[0]['Name'])) {
				$tablelist['core'][] = $tableInfo[0];
			}
			else {
				$tablelist['other'][] = $tableInfo[0];
			}
		}
		return $tablelist;
	}

	public function backup_tableStructure($table) {
		$timestamp = date('Ymd') . '_' . substr(md5(date('YmdHis')), 0, 8);
		$structure = '';
		foreach($table as $table) {
			$structure .= $this->get_tableStructureSQL($table);
		}
		if(empty($structure)) {
			return false;
		}
		$structureFilename = RUNTIME_PATH . D_S . 'backup' . D_S . 'table_structure_' . $timestamp . '.sql';
		return file_put_contents($structureFilename, trim($structure));
	}

	public function backup_tableData($table, $volumeSize = 2097152) {
		$timestamp = date('Ymd') . '_' . substr(md5(date('YmdHis')), 0, 8);
		$data = M()->query('SELECT * FROM `' . $table . '`;');
		if(!empty($data)) {
			$content = "TRUNCATE TABLE `" . $table . "`;\r\n";
			$start = 0;
			foreach($data as $k => $data) {
				$content .= M('Database')->get_tableDataSQL($table, $data);
				if($volumeSize <= strlen($content)) {
					$dataFilename = RUNTIME_PATH . D_S . 'backup' . D_S . $table . '_' . $start . '_' . $timestamp . '.sql';
					if(!file_put_contents($dataFilename, $content)) {
						return false;
					}
					$content = '';
					$start = $k + 1;
				}
			}
			$dataFilename = RUNTIME_PATH . D_S . 'backup' . D_S . $table . '_' . $start . '_' . $timestamp . '.sql';
			if(!empty($content) and !file_put_contents($dataFilename, $content)) {
				return false;
			}
		}
		return true;
	}

	public function optimize_table($table) {
		if(!empty($table)) {
			$sql = "OPTIMIZE TABLE `{$table}`";
			if(false !== $this->query($sql)) {
				return true;
			}
		}
		return false;
	}

	public function repair_table($table) {
		if(!empty($table)) {
			$sql = "REPAIR TABLE `{$table}`";
			if(false !== $this->query($sql)) {
				return true;
			}
		}
		return false;
	}

	/* get table data INSERT SQL */
	public function get_tableDataSQL($table, $data) {
		$insertSql = 'INSERT INTO `' . $table . '` VALUES(';
		foreach($data as $key => $val) {
			if(is_int($key)) {
				continue;
			}
			$insertSql .= '\'' . mysql_escape_string($val) . '\',';
		}
		$insertSql = rtrim($insertSql, ',');
		$insertSql .= ");\r\n";
		return $insertSql;
	}

	/* get table structure SQL(database) */
	public function get_tableStructureSQL($table) {
		/* table structure */
		$tableStructure = "DROP TABLE IF EXISTS `" . $table . "`;\r\n";
		$_t_sct = $this->query('SHOW CREATE TABLE `' . $table . '`');
		$tableStructure .= $_t_sct[0]['Create Table'] . ";\r\n\r\n";
		return $tableStructure;
	}

	public function get_backupFileList() {
		$_BFL = array(
			'structure' => '',
			'data_core' => array(),
			'data_other' => array(),
			);
		$fileList = array();
		$dh = dir(RUNTIME_PATH . D_S . 'backup');
		while(false !== ($filename = $dh->read())) {
			$fileList[] = $filename;
		}
		$dh->close();
		natsort($fileList);
		foreach($fileList as $filename) {
			$file = array(
				'filename' => $filename,
				'filesize' => byte_format(filesize(RUNTIME_PATH . D_S . 'backup' . D_S . $filename)),
				'backup_time' => date(C('APP.TIME_FORMAT'), filemtime(RUNTIME_PATH . D_S . 'backup' . D_S . $filename)),
				);
			if(preg_match("/^table_structure\_/", $filename)) {
				$_BFL['structure'] = $file;
			}
			elseif(preg_match('/^' . C('DB.PREFIX') . '/', $filename)) {
				$_BFL['data_core'][] = $file;
			}
			elseif(preg_match('/\.sql$/', $filename)) {
				$_BFL['data_other'][] = $file;
			}
		}
		return $_BFL;
	}

	public function restore_data($dataFile) {
		$sql = file_get_contents(RUNTIME_PATH . D_S . 'backup' . D_S . $dataFile);
		$sql = str_replace(";\n", ";\r\n", $sql);
		$sql = trim_array(explode(";\r\n", $sql));
		if(!empty($sql)) {
			foreach($sql as $sql) {
				if(!empty($sql) and false === $this->execute($sql)) {
					return false;
				}
			}
		}
		return true;
	}

	/* show progress $barLength: % */
	public function show_progress($msg, $barLength = '50') {
		echo '<script>show_progress("' . $msg . '", "' . $barLength . '%");</script>';
		@ob_flush();
		@flush();
	}

	/* show direction */
	public function show_direction($nextUrl, $show = false) {
		if($show) {
			echo '<script>show_direction("' . $nextUrl . '")</script>';
		}
		echo '<script>location.href = "' . $nextUrl . '";</script>';
		@ob_flush();
		@flush();
	}

}

?>