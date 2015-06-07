<?php

/**
 *--------------------------------------
 * admin role
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-9
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminRoleCtrlr extends ManageCtrlr {
	public function list_role() {
		$_ARL = M('AdminRole')->get_roleList();
		$this->assign('_ARL', $_ARL);
		$this->display();
	}

	public function add_role() {
		$_APL = M('AdminPermission')->get_permissionList(true);
		$this->assign('_APL', $_APL);

		$this->display();

	}
	public function add_role_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		if(empty($data['admin_permission_id']) && empty($data['ar_permission'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN_ROLE') . ': ' . L('PERMISSION_NO_EMPTY'), 0);
			$this->error(L('PERMISSION_NO_EMPTY'), Url::U('admin_role/list_role'));
		}

		$result = M('AdminRole')->add_role($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN_ROLE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin_role/list_role'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN_ROLE') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('admin_role/list_role'));
	}

	public function edit_role() {
		$adminRoleId = ARequest::get('admin_role_id');
		$_ARI = M('AdminRole')->get_roleInfo($adminRoleId);
		if(empty($_ARI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('admin_role/list_role'));
		}
		$this->assign('_ARI', $_ARI);
		if(0 == $_ARI['ar_type']) {
			if(-1 == $_ARI['ar_rank']) {
				$this->error(L('SUPER_ADMIN_IS_LOCKED'), Url::U('admin_role/list_role'));
			}
			$this->error(L('SYSTEM_ROLE_IS_LOCKED'), Url::U('admin_role/list_role'));
		}

		$_APL = M('AdminPermission')->get_permissionList(true);
		$this->assign('_APL', $_APL);

		$this->display();
	}
	public function edit_role_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		if(empty($data['admin_permission_id']) && empty($data['ar_permission'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN_ROLE') . ': ' . L('PERMISSION_NO_EMPTY'), 0);
			$this->error(L('PERMISSION_NO_EMPTY'), Url::U('admin_role/list_role'));
		}

		$result = M('AdminRole')->edit_role($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN_ROLE') . ': ID[' . $data['admin_role_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin_role/list_role'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN_ROLE') . ': ID[' . $data['admin_role_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('admin_role/list_role'));
	}

	public function delete_role_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adminRoleId = ARequest::get('admin_role_id');
		$adminRoleId = is_array($adminRoleId) ? $adminRoleId : explode(',', $adminRoleId);
		$_L_ID = implode(', ', $adminRoleId);

		foreach($adminRoleId as $adminRoleId) {
			$result = M('AdminRole')->delete_role($adminRoleId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN_ROLE') . ': ID[' . $adminRoleId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('admin_role/list_role'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN_ROLE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('admin_role/list_role'));
	}
}

?>