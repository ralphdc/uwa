<?php

/**
 *--------------------------------------
 * admin permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-9
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminPermissionCtrlr extends ManageCtrlr {
	public function list_permission() {
		/* filter group */
		$apGroup = ARequest::get('ap_group');
		if(!empty($apGroup)) {
			$where['__ADMIN_PERMISSION__.ap_group'] = array('EQ', $apGroup);
		}

		/* filtername */
		$apName = ARequest::get('ap_name');
		if(!empty($apName)) {
			$where['__ADMIN_PERMISSION__.ap_name'] = array('LIKE', '%' . $apName . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'admin_permission_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 10);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('AdminPermission')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('admin_permission/list_permission?ap_group=' . $apGroup . '&ap_name=' . $apName . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* permission list */
		$_APL = M('AdminPermission')->where($where)->order($order)->limit($limit)->select();
		$this->assign('_APL', $_APL);

		$this->display();
	}

	public function add_permission() {
		$_CL = get_ctrlrList(dirname(__FILE__));
		$this->assign('_CL', $_CL);

		$this->display();
	}
	public function add_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('AdminPermission')->add_permission($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN_PERMISSION'), 0);
			$this->error($result['error'], Url::U('admin_permission/list_permission'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN_PERMISSION') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('admin_permission/list_permission'));
	}

	public function edit_permission() {
		$adminPermissionId = ARequest::get('admin_permission_id');

		$_API = M('AdminPermission')->get_permissionInfo($adminPermissionId);
		if(empty($_API)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('admin_permission/list_permission'));
		}
		$_API['ap_content'] = explode(',', $_API['ap_content']);
		$this->assign('_API', $_API);

		$_CL = get_ctrlrList(dirname(__FILE__));
		$this->assign('_CL', $_CL);

		$this->display();
	}
	public function edit_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('AdminPermission')->edit_permission($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN_PERMISSION') . ': ID[' . $data['admin_permission_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin_permission/list_permission'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN_PERMISSION') . ': ID[' . $data['admin_permission_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('admin_permission/list_permission'));
	}

	public function delete_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adminPermissionId = ARequest::get('admin_permission_id');
		$adminPermissionId = is_array($adminPermissionId) ? $adminPermissionId : explode(',', $adminPermissionId);
		$_L_ID = implode(', ', $adminPermissionId);

		foreach($adminPermissionId as $adminPermissionId) {
			$result = M('AdminPermission')->delete_permission($adminPermissionId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN_PERMISSION') . ': ID[' . $adminPermissionId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('admin_permission/list_permission'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN_PERMISSION') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('admin_permission/list_permission'));
	}

	/* get action list of controller */
	public function get_actnList() {
		$ctrlr = ARequest::get('ctrlr');
		$actnList = get_actnList($ctrlr);
		$this->ajax_return(array('data' => $actnList));
	}
}

?>