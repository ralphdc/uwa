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

class AdminRoleModl extends Modl {
	public function get_roleList() {
		$_ARL = $this->order('`ar_rank` asc')->select();
		return $_ARL;
	}

	public function get_roleInfo($adminRoleId) {
		$_ARI = $this->where(array('admin_role_id' => array('EQ', $adminRoleId)))->find();
		if(!empty($_ARI)) {
			/* get permission list id */
			$_APL = M('AdminPermission')->get_permissionList();
			if(empty($_APL)) {
				return $_ARI;
			}

			$permission = explode(',', $_ARI['ar_permission']);
			foreach($_APL as $ap) {
				$_t_p = explode(',', $ap['ap_content']);
				foreach($_t_p as $p) {
					if(!in_array($p, $permission)) {
						continue 2;
					}
				}
				$_ARI['admin_permission_id'][] = $ap['admin_permission_id'];
			}
		}

		return $_ARI;
	}

	public function add_role($data) {
		$result = array('data' => '', 'error' => '');

		/* analysis permission data */
		if('_all' != $data['ar_permission']) {
			foreach($data['admin_permission_id'] as $adminPermissionId) {
				foreach($adminPermissionId as $adminPermissionId) {
					$_t = M('AdminPermission')->get_permissionInfo($adminPermissionId);
					$data['ar_permission'] .= $_t['ap_content'] . ',';
				}
			}
			$data['ar_permission'] = explode(',', rtrim($data['ar_permission'], ','));
			$data['ar_permission'] = array_unique($data['ar_permission']);
			sort($data['ar_permission']);
			$data['ar_permission'] = implode(',', $data['ar_permission']);
		}

		/* other data */
		$data['ar_type'] = 1;

		unset($data['admin_role_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_role($data) {
		$result = array('data' => '', 'error' => '');

		/* check whether it is super admin */
		$_ARI = $this->get_roleInfo($data['admin_role_id']);
		if(empty($_ARI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if((0 == $_ARI['ar_type']) && (-1 == $_ARI['ar_rank'])) {
			$result['error'] = L('SUPER_ADMIN_IS_LOCKED');
			return $result;
		}

		/* analysis permission data */
		if('_all' != $data['ar_permission']) {
			foreach($data['admin_permission_id'] as $adminPermissionId) {
				foreach($adminPermissionId as $adminPermissionId) {
					$_t = M('AdminPermission')->get_permissionInfo($adminPermissionId);
					$data['ar_permission'] .= $_t['ap_content'] . ',';
				}
			}
			$data['ar_permission'] = explode(',', rtrim($data['ar_permission'], ','));
			$data['ar_permission'] = array_unique($data['ar_permission']);
			sort($data['ar_permission']);
			$data['ar_permission'] = implode(',', $data['ar_permission']);
		}

		/* other data */
		$data['ar_type'] = 1;

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_role($adminRoleId) {
		$result = array('data' => '', 'error' => '');

		/* check whether it is system role */
		$_ARI = $this->get_roleInfo($adminRoleId);
		if(empty($_ARI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if(0 == $_ARI['ar_type']) {
			if(-1 == $_ARI['ar_rank']) {
				$result['error'] = L('SUPER_ADMIN_IS_LOCKED');
				return $result;
			}
			$result['error'] = L('SYSTEM_ROLE_IS_LOCKED');
			return $result;
		}

		/* check whether have admin of this role */
		$_AI = M('Admin')->where(array('admin_role_id' => array('EQ', $adminRoleId)))->select();
		if(!empty($_AI)) {
			$result['error'] = L('ROLE_ADMIN_EXSIT');
			return $result;
		}

		if(false === $this->delete($adminRoleId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>