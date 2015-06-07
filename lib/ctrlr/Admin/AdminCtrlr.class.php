<?php

/**
 *--------------------------------------
 * admin
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-9
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminCtrlr extends ManageCtrlr {
	public function list_admin() {
		$adminRoleId = (ARequest::get('admin_role_id') > 0 ? ARequest::get('admin_role_id') : 0);
		$_AL = M('Admin')->get_adminList($adminRoleId);
		$this->assign('_AL', $_AL);

		$this->display();
	}

	public function add_admin() {
		/* member model list */
		$_MML = M('MemberModel')->get_modelList(false);
		if(empty($_MML)) {
			$this->error(L('ADD_MODEL_FIRST'), Url::U('member_model/add_model'));
		}
		$this->assign('_MML', $_MML);

		/* member level list */
		$_MLL = M('MemberLevel')->get_LevelList();
		if(empty($_MLL)) {
			$this->error(L('ADD_LEVEL_FIRST'), Url::U('member_level/add_level'));
		}
		$this->assign('_MLL', $_MLL);

		/* admin role list */
		$_ARL = M('AdminRole')->get_roleList();
		if(empty($_ARL)) {
			$this->error(L('ADD_ROLE_FIRST'), Url::U('admin_role/add_role'));
		}
		$this->assign('_ARL', $_ARL);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}
	public function add_admin_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		if(in_array('_all', $data['a_ac_id'])) {
			$data['a_ac_id'] = '_all';
		}
		else {
			if(empty($data['a_ac_id'])) {
				$data['a_ac_id'] = '';
			}
			else {
				$data['a_ac_id'] = implode(',', $data['a_ac_id']);
			}
		}

		$data['m_password'] = md5($data['m_userid'] . md5($data['m_password']));
		$_MLI = M('MemberLevel')->get_levelInfo($data['member_level_id']);
		$data['m_experience'] = !empty($data['m_experience']) ? $data['m_experience'] : $_MLI['ml_min_experience'];
		$data['m_points'] = !empty($data['m_points']) ? $data['m_points'] : 0;
		$data['m_reg_time'] = !empty($data['m_reg_time']) ? strtotime($data['m_reg_time']) : time();
		$data['m_reg_ip'] = !empty($data['m_reg_ip']) ? $data['m_reg_ip'] : AServer::get_ip();
		$data['m_login_time'] = !empty($data['m_login_time']) ? strtotime($data['m_login_time']) : time();
		$data['m_login_ip'] = !empty($data['m_login_ip']) ? $data['m_login_ip'] : AServer::get_ip();
		$data['a_login_time'] = $data['m_login_time'];
		$data['a_login_ip'] = $data['m_login_ip'];

		$result = M('Member')->add_member($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin/list_admin'));
		}
		$data['member_id'] = $result['data'];

		$result = M('Admin')->add_admin($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin/list_admin'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ADMIN') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('admin/list_admin'));
	}

	public function edit_admin() {
		$adminId = ARequest::get('admin_id');
		$_AI = M('Admin')->get_adminInfo($adminId);
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('admin/list_admin'));
		}
		$this->assign('_AI', $_AI);

		/* admin role list */
		$_ARL = M('AdminRole')->get_roleList();
		if(empty($_ARL)) {
			$this->error(L('ADD_ROLE_FIRST'), Url::U('admin_role/add_role'));
		}
		$this->assign('_ARL', $_ARL);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n", implode(',', $_AI['a_ac_id']), "<option value='\$archive_channel_id' selected='selected'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}
	public function edit_admin_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		if(empty($data['m_password'])) {
			unset($data['m_password']);
		}
		else {
			$data['m_password'] = md5($data['m_userid'] . md5($data['m_password']));
		}

		$data = ARequest::get();
		if(in_array('_all', $data['a_ac_id'])) {
			$data['a_ac_id'] = '_all';
		}
		else {
			if(empty($data['a_ac_id'])) {
				$data['a_ac_id'] = '';
			}
			else {
				$data['a_ac_id'] = implode(',', $data['a_ac_id']);
			}
		}

		$result = M('Member')->update($data);
		if(false === $result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN') . ': ID[' . $data['admin_id'] . ']', 0);
			$this->error(L('EDIT_FAILED'), Url::U('admin/list_admin'));
		}

		$result = M('Admin')->edit_admin($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN') . ': ID[' . $data['admin_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin/list_admin'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ADMIN') . ': ID[' . $data['admin_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('admin/list_admin'));

	}

	public function delete_admin_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adminId = ARequest::get('admin_id');
		$_L_ID = is_array($adminId) ? implode(', ', $adminId) : $adminId;

		$result = M('Admin')->delete_admin($adminId);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN') . ': ID[' . $adminId . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin/list_admin'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ADMIN') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('admin/list_admin'));
	}

	public function assign_admin() {
		$memberId = ARequest::get('member_id');
		$_MI = M('Member')->get_memberInfo($memberId);
		if(empty($_MI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('admin/list_admin'));
		}
		$this->assign('_MI', $_MI);

		/* admin role list */
		$_ARL = M('AdminRole')->get_roleList();
		if(empty($_ARL)) {
			$this->error(L('ADD_ROLE_FIRST'), Url::U('admin_role/add_role'));
		}
		$this->assign('_ARL', $_ARL);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$_t = M('Admin')->where(array('member_id' => array('EQ', $memberId)))->find();
		if(!empty($_t)) {
			$_AI = M('Admin')->get_adminInfo($_t['admin_id']);
			$this->assign('_AI', $_AI);
			$this->display('admin/admin/edit_admin');
		}
		else {
			$this->display();
		}
	}
	public function assign_admin_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		if(in_array('_all', $data['a_ac_id'])) {
			$data['a_ac_id'] = '_all';
		}
		else {
			$data['a_ac_id'] = implode(',', $data['a_ac_id']);
		}

		$result = M('Admin')->assign_admin($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ASSIGN_ADMIN') . ': ID[' . $data['member_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('admin/list_admin'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ASSIGN_ADMIN') . ': ID[' . $data['member_id'] . ']', 0);
		$this->success(L('ADD_SUCCESS'), Url::U('admin/list_admin'));
	}

}

?>