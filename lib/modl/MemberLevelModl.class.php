<?php

/**
 *--------------------------------------
 * member level
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-8
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberLevelModl extends Modl {
	public function get_levelList() {
		$_MLL = F('~mll');
		if(empty($_MLL)) {
			$_MLL = $this->order('`ml_type` DESC, `ml_rank` ASC')->select();
			F('~mll', $_MLL);
		}

		return $_MLL;
	}

	public function get_levelId($experience) {
		$memberLevelId = 0;
		$mlRank = 0;
		foreach($this->get_levelList() as $ml) {
			if(1 == $ml['ml_type'] and $experience >= $ml['ml_min_experience'] and $mlRank <= $ml['ml_rank']) {
				$memberLevelId = $ml['member_level_id'];
				$mlRank = $ml['ml_rank'];
			}
		}
		return $memberLevelId;
	}

	public function get_levelInfo($memberLevelId) {
		$_MLI = $this->where(array('member_level_id' => array('EQ', $memberLevelId)))->find();
		if(!empty($_MLI)) {
			/* get permission list id */
			$_MPL = M('MemberPermission')->get_permissionList();
			if(empty($_MPL)) {
				return $_MLI;
			}

			$permission = explode(',', $_MLI['ml_permission']);
			foreach($_MPL as $mp) {
				$_t_p = explode(',', $mp['mp_content']);
				foreach($_t_p as $p) {
					if(!in_array($p, $permission)) {
						continue 2;
					}
				}
				$_MLI['member_permission_id'][] = $mp['member_permission_id'];
			}

			$_MLI['ml_upload_option'] = unserialize($_MLI['ml_upload_option']);
			if(MAGIC_QUOTES_GPC) {
				$_MLI['ml_upload_option'] = stripslashes_array($_MLI['ml_upload_option']);
			}
			$_MLI['ml_upload_option']['imgtype'] = explode(',', $_MLI['ml_upload_option']['imgtype']);
			$_MLI['ml_upload_option']['filetype'] = explode(',', $_MLI['ml_upload_option']['filetype']);
		}

		return $_MLI;
	}

	public function add_level($data) {
		$result = array('data' => '', 'error' => '');

		/* analysis permission data */
		if('_all' != $data['ml_permission']) {
			foreach($data['member_permission_id'] as $memberPermissionId) {
				foreach($memberPermissionId as $memberPermissionId) {
					$_t = M('MemberPermission')->get_permissionInfo($memberPermissionId);
					$data['ml_permission'] .= $_t['mp_content'] . ',';
				}
			}
			$data['ml_permission'] = explode(',', rtrim($data['ml_permission'], ','));
			$data['ml_permission'] = array_unique($data['ml_permission']);
			sort($data['ml_permission']);
			$data['ml_permission'] = implode(',', $data['ml_permission']);
		}

		$data['ml_upload_option']['imgtype'] = implode(',', $data['ml_upload_option']['imgtype']);
		$data['ml_upload_option']['filetype'] = implode(',', $data['ml_upload_option']['filetype']);
		$data['ml_upload_option'] = serialize($data['ml_upload_option']);
		if(MAGIC_QUOTES_GPC) {
			$data['ml_upload_option'] = addslashes($data['ml_upload_option']);
		}

		unset($data['member_level_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~mll', null);

		return $result;
	}

	public function edit_level($data) {
		$result = array('data' => '', 'error' => '');

		/* analysis permission data */
		if('_all' != $data['ml_permission'] and isset($data['member_permission_id'])) {
			foreach($data['member_permission_id'] as $memberPermissionId) {
				foreach($memberPermissionId as $memberPermissionId) {
					$_t = M('MemberPermission')->get_permissionInfo($memberPermissionId);
					$data['ml_permission'] .= $_t['mp_content'] . ',';
				}
			}
			$data['ml_permission'] = explode(',', rtrim($data['ml_permission'], ','));
			$data['ml_permission'] = array_unique($data['ml_permission']);
			sort($data['ml_permission']);
			$data['ml_permission'] = implode(',', $data['ml_permission']);
		}

		if(isset($data['ml_upload_option'])) {
			$data['ml_upload_option']['imgtype'] = implode(',', $data['ml_upload_option']['imgtype']);
			$data['ml_upload_option']['filetype'] = implode(',', $data['ml_upload_option']['filetype']);
			$data['ml_upload_option'] = serialize($data['ml_upload_option']);
			if(MAGIC_QUOTES_GPC) {
				$data['ml_upload_option'] = addslashes($data['ml_upload_option']);
			}
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~mll', null);

		return $result;
	}

	public function delete_level($memberLevelId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($memberLevelId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		F('~mll', null);

		return $result;
	}
}

?>