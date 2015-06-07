<?php

/**
 *--------------------------------------
 * archive flag
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-7
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveFlagCtrlr extends ManageCtrlr {
	public function list_flag() {
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$this->display();
	}

	public function add_flag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['af_alias'] = strtolower($data['af_alias']);
		$result = M('ArchiveFlag')->add_flag($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_flag/list_flag'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': AF_ALIAS[' . $data['af_alias'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('archive_flag/list_flag'));
	}

	public function update_flag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$afAlias = ARequest::get('af_alias');
		$_L_ID = is_array($afAlias) ? implode(', ', $afAlias) : $afAlias;

		if(!is_array($afAlias) or empty($afAlias)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_FLAG') . ': AF_ALIAS[' . $afAlias . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_flag/list_flag'));
		}

		$afName = ARequest::get('af_name');
		$afDisplayOrder = ARequest::get('af_display_order');
		$data = array();
		$error = false;
		foreach($afAlias as $k => $afAlias) {
			$data['af_alias'] = $afAlias;
			$data['af_name'] = $afName[$k];
			$data['af_display_order'] = $afDisplayOrder[$k];

			$result = M('ArchiveFlag')->update_flag($data);
			if(!empty($result['error'])) {
				$error = true;
			}
		}
		if($error) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_FLAG') . ': AF_ALIAS[' . $afAlias . ']', 0);
			$this->error(L('EDIT_FAILED'), Url::U('archive_flag/list_flag'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_FLAG') . ': AF_ALIAS[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_flag/list_flag'));
	}

	public function delete_flag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$afAlias = ARequest::get('af_alias');
		$afAlias = is_array($afAlias) ? $afAlias : explode(',', $afAlias);
		$_L_ID = implode(', ', $afAlias);

		foreach($afAlias as $afAlias) {
			$result = M('ArchiveFlag')->delete_flag($afAlias);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': AF_ALIAS[' . $afAlias . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_flag/list_flag'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': AF_ALIAS[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_flag/list_flag'));
	}
}

?>