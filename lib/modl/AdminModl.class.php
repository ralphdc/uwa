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

class AdminModl extends Modl {
	public function is_admin($memberId) {
		$result = $this->where(array('member_id' => array('EQ', $memberId)))->find();
		if(!empty($result)) {
			return true;
		}
		return false;
	}

	public function get_adminList($adminRoleId = 0) {
		if($adminRoleId > 0) {
			$where = 'ar.`admin_role_id` = \'' . $adminRoleId . '\'';
		}
		$_AL = $this->where($where)->join('__ADMIN_ROLE__ AS ar ON ar.admin_role_id = __ADMIN__.admin_role_id')->join('__MEMBER__ AS m ON m.member_id = __ADMIN__.member_id')->select();
		return $_AL;
	}

	public function get_adminInfo($adminId) {
		$_AI = $this->where(array('__ADMIN__.admin_id' => array('EQ', $adminId)))->join('__MEMBER__ AS m ON m.member_id = __ADMIN__.member_id')->find();
		if(!empty($_AI)) {
			$_AI['a_ac_id'] = explode(',', $_AI['a_ac_id']);
		}
		return $_AI;
	}

	public function add_admin($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['admin_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_admin($data) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->where(array('admin_id' => array('EQ', $data['admin_id'])))->find();
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if(1 == $_AI['admin_role_id'] && 1 != $data['admin_role_id']) {
			$SUPER_ADMIN = $this->where(array('admin_role_id' => array('EQ', 1)))->count();
			if(1 == $SUPER_ADMIN) {
				$result['error'] = L('AT_LEAST_ONE_SUPER_ADMIN');
				return $result;
			}
		}

		if(false === $this->update($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_admin($adminId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->where(array('admin_id' => array('EQ', $adminId)))->find();
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if(1 == $_AI['admin_role_id']) {
			$SUPER_ADMIN = $this->where(array('admin_role_id' => array('EQ', 1)))->count();
			if(1 == $SUPER_ADMIN) {
				$result['error'] = L('AT_LEAST_ONE_SUPER_ADMIN');
				return $result;
			}
		}

		if(false === $this->delete($adminId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function assign_admin($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['admin_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}
}

?>