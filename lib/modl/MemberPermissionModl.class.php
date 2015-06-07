<?php

/**
 *--------------------------------------
 * member permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-10
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberPermissionModl extends Modl {
	/* $gorupSort: whether is group sort */
	public function get_permissionList($groupSort = false) {
		$_MPL = $this->order('`member_permission_id` ASC')->select();
		if(!empty($_MPL) && $groupSort) {
			$_t = array();
			foreach($_MPL as $mp) {
				$_t[$mp['mp_group']][] = $mp;
			}
			$_MPL = $_t;
		}
		return $_MPL;
	}

	/* get all member permission */
	public function get_allPermission() {
		$allPermission = '';
		$_t = $this->select();
		if(!empty($_t)) {
			foreach($_t as $mp) {
				$allPermission .= $mp['mp_content'] . ',';
			}
		}
		$allPermission = rtrim($allPermission, ',');
		return $allPermission;
	}

	public function get_permissionInfo($MemberPermissionId) {
		$_MPI = $this->where(array('member_permission_id' => array('EQ', $MemberPermissionId)))->find();
		return $_MPI;
	}

	public function add_permission($data) {
		$result = array('data' => '', 'error' => '');

		$data['permission'] = array_unique($data['permission']);
		sort($data['permission']);
		$data['mp_content'] = implode(',', $data['permission']);

		unset($data['member_permission_id']);
		unset($data['permission']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_permission($data) {
		$result = array('data' => '', 'error' => '');

		$data['permission'] = array_unique($data['permission']);
		sort($data['permission']);
		$data['mp_content'] = implode(',', $data['permission']);
		unset($data['permission']);
		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_permission($MemberPermissionId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($MemberPermissionId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>