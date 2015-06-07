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

class DatabaseCtrlr extends ManageCtrlr {
	public function list_table() {
		$_TL = M('Database')->get_tableList();
		$this->assign('_TL', $_TL);
		$this->display();
	}

	public function list_field() {
		$table = ARequest::get('table');
		if(empty($table)) {
			exit();
		}
		$_FL = M()->db->get_fields($table);
		$this->assign('_FL', $_FL);
		$this->display();
	}

	public function backup_do() {
		$volumeSize = ARequest::get('volume_size') ? intval(ARequest::get('volume_size')) * 1024 : 2048 * 1024;
		$_BFL = F('~backup_file_list');
		if(empty($_BFL)) {
			$_BFL = M('Database')->get_backupFileList();
		}

		$table = F('~data_table_list');
		if(empty($table)) {
			if(!check_token()) {
				$this->error(L('DATA_INVALID'), AServer::get_preUrl());
			}

			$backupStructure = ARequest::get('backup_structure') ? true : false;
			$table = $this->get_post_table();

			if(empty($table) and !$backupStructure) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE') . ': ' . L('NO_TABLE_SELECTED'), 0);
				$this->error(L('NO_TABLE_SELECTED'), Url::U('database/list_backup_file'));
			}
			if($backupStructure) {
				if(!M('Database')->backup_tableStructure($table)) {
					M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE_STRUCTURE_FAILED'), 0);
					$this->error(L('BACKUP_DATABASE_STRUCTURE_FAILED'), Url::U('database/list_table'));
				}
				/* delete old structure file */
				if(isset($_BFL['structure']) and !empty($_BFL['structure'])) {
					@unlink(RUNTIME_PATH . D_S . 'backup' . D_S . $_BFL['structure']['filename']);
				}
			}
			F('~data_table_list', $table);
		}

		$total = count($table);
		$current = ARequest::get('current') ? ARequest::get('current') : 1;

		if(!M('Database')->backup_tableData($table[$current - 1], $volumeSize)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE_DATA_FAILED') . ': TABLE[' . $table[$current - 1] . ']', 0);
			$this->error(L('BACKUP_DATABASE_DATA_FAILED') . ': TABLE[' . $table[$current - 1] . ']', Url::U('database/list_table'));
		}

		/* delete old data file */
		foreach($_BFL['data_core'] as $dc) {
			if(preg_match("/^" . $table[$current - 1] . "\_\d+\_/", $dc['filename'])) {
				@unlink(RUNTIME_PATH . D_S . 'backup' . D_S . $dc['filename']);
			}
		}
		/* delete old other data file */
		foreach($_BFL['data_other'] as $do) {
			if(preg_match("/^" . $table[$current - 1] . "\_\d+\_/", $do['filename'])) {
				@unlink(RUNTIME_PATH . D_S . 'backup' . D_S . $do['filename']);
			}
		}

		set_time_limit(99999999);
		$this->display('admin/database/progress');

		/* progress and next page */
		if($current < $total) {
			$progress = round($current / $total * 100, 1);
			$nextUrl = Url::U('database/backup_do?volume_size=' . $volumeSize . '&current=' . ($current + 1));
			M('Database')->show_progress($progress . '% [' . $current . '/' . $total . ']: ' . $table[$current - 1], $progress);
			M('Database')->show_direction($nextUrl);
		}
		else {
			M('Database')->show_progress('100% [' . $current . '/' . $total . ']: ' . L('BACKUP_COMPLETE'), 100);
			set_time_limit(30);
			F('~data_table_list', null);
			F('~backup_file_list', null);
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE_SUCCESS'));
			M('Database')->show_direction(Url::U('database/list_backup_file'), true);
		}
	}

	public function repair_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$table = $this->get_post_table();
		if(empty($table)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('REPAIR_DATABASE') . ': ' . L('NO_TABLE_SELECTED'), 0);
			$this->error(L('NO_TABLE_SELECTED'), Url::U('database/list_table'));
		}

		foreach($table as $table) {
			if(false == M('Database')->repair_table($table)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('REPAIR_DATABASE_FAILED'), 0);
				$this->error(L('REPAIR_DATABASE_FAILED'), Url::U('database/list_table'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('REPAIR_DATABASE_SUCCESS'));
		$this->success(L('REPAIR_DATABASE_SUCCESS'), Url::U('database/list_table'));
	}

	public function optimize_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$table = $this->get_post_table();
		if(empty($table)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('OPTIMIZE_DATABASE') . ': ' . L('NO_TABLE_SELECTED'), 0);
			$this->error(L('NO_TABLE_SELECTED'), Url::U('database/list_table'));
		}

		foreach($table as $table) {
			if(false == M('Database')->optimize_table($table)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('OPTIMIZE_DATABASE_FAILED'), 0);
				$this->error(L('OPTIMIZE_DATABASE_FAILED'), Url::U('database/list_table'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('OPTIMIZE_DATABASE_SUCCESS'));
		$this->success(L('OPTIMIZE_DATABASE_SUCCESS'), Url::U('database/list_table'));
	}

	public function list_backup_file() {
		$_BFL = M('Database')->get_backupFileList();
		$this->assign('_BFL', $_BFL);
		$this->display();
	}

	public function restore_do() {
		$dataFile = F('~data_file_list');
		if(empty($dataFile)) {
			if(!check_token()) {
				$this->error(L('DATA_INVALID'), AServer::get_preUrl());
			}

			$dataFile = ARequest::get('data_file') ? ARequest::get('data_file') : array();
			$restoreStructure = ARequest::get('restore_structure') ? true : false;

			if(empty($dataFile) and !$restoreStructure) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE') . ': ' . L('NO_TABLE_SELECTED'), 0);
				$this->error(L('NO_TABLE_SELECTED'), Url::U('database/list_backup_file'));
			}

			$_BFL = M('Database')->get_backupFileList();
			if($restoreStructure) {
				if(empty($_BFL['structure'])) {
					M('AdminLog')->add_log(ASession::get('m_userid'), L('BACKUP_DATABASE') . ': ' . L('STRUCTURE_FILE_INEXISTENCE'), 0);
					$this->error(L('STRUCTURE_FILE_INEXISTENCE'), Url::U('database/list_backup_file'));
				}
				array_unshift($dataFile, $_BFL['structure']['filename']);
			}
			F('~data_file_list', $dataFile);
		}

		$total = count($dataFile);
		$current = ARequest::get('current') ? ARequest::get('current') : 1;

		if(false == M('Database')->restore_data($dataFile[$current - 1])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('RESTORE_DATABASE_FAILED') . ': FILE[' . $dataFile[$current - 1] . ']', 0);
			$this->error(L('RESTORE_DATABASE_FAILED') . ': FILE[' . $dataFile[$current - 1] . ']', Url::U('database/list_backup_file'));
		}

		set_time_limit(99999999);
		$this->display('admin/database/progress');

		/* progress and next page */
		if($current < $total) {
			$progress = round($current / $total * 100, 1);
			$nextUrl = Url::U('database/restore_do?current=' . ($current + 1));
			M('Database')->show_progress($progress . '% [' . $current . '/' . $total . ']: ' . $dataFile[$current - 1], $progress);
			M('Database')->show_direction($nextUrl);
		}
		else {
			M('Database')->show_progress('100% [' . $current . '/' . $total . ']: ' . L('RESTORE_COMPLETE'), 100);
			set_time_limit(30);
			F('~data_file_list', null);
			M('AdminLog')->add_log(ASession::get('m_userid'), L('RESTORE_DATABASE_SUCCESS'));
			M('Database')->show_direction(Url::U('database/list_table'), true);
		}
	}

	private function get_post_table() {
		$table = ARequest::get('table');
		if(is_string($table)) {
			$table = array($table);
		}
		return $table;
	}
}

?>