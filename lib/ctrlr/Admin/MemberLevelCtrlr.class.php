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

class MemberLevelCtrlr extends ManageCtrlr {
	public function list_level() {
		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);
		$this->display();
	}

	public function add_level() {
		$_MPL = M('MemberPermission')->get_permissionList(true);
		$this->assign('_MPL', $_MPL);

		$_o_u = M('Option')->get_option('upload');
		$_o_u['imgtype'] = explode(',', $_o_u['imgtype']);
		$_o_u['filetype'] = explode(',', $_o_u['filetype']);
		$this->assign('_o_u', $_o_u);

		$this->display();
	}
	public function add_level_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('MemberLevel')->add_level($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_LEVEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_level/list_level'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_LEVEL') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_level/list_level'));
	}

	public function update_level_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberLevelId = ARequest::get('member_level_id');
		$mlName = ARequest::get('ml_name');
		$mlRank = ARequest::get('ml_rank');
		$mlMinExperience = ARequest::get('ml_min_experience');
		$mlType = ARequest::get('ml_type');
		$_L_ID = is_array($memberLevelId) ? implode(', ', $memberLevelId) : $memberLevelId;

		if(!is_array($memberLevelId) or empty($memberLevelId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_level/list_level'));
		}

		$data = array();
		$error = false;
		foreach($memberLevelId as $k => $id) {
			$data['member_level_id'] = $id;
			$data['ml_name'] = $mlName[$k];
			$data['ml_rank'] = $mlRank[$k];
			$data['ml_min_experience'] = $mlMinExperience[$k];
			$data['ml_type'] = $mlType[$k];
			$result = M('MemberLevel')->edit_level($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_LEVEL') . ': ID[' . $data['member_level_id'] . ']', 0);
				$this->error(L('EDIT_FAILED'), Url::U('member_level/list_level'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_LEVEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_level/list_level'));
	}

	public function edit_level() {
		$memberLevelId = ARequest::get('member_level_id');
		$_MLI = M('MemberLevel')->get_levelInfo($memberLevelId);
		if(empty($_MLI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_level/list_level'));
		}
		$this->assign('_MLI', $_MLI);

		$_o_u = M('Option')->get_option('upload');
		$_o_u['imgtype'] = explode(',', $_o_u['imgtype']);
		$_o_u['filetype'] = explode(',', $_o_u['filetype']);
		$this->assign('_o_u', $_o_u);

		$_MPL = M('MemberPermission')->get_permissionList(true);
		$this->assign('_MPL', $_MPL);

		$this->display();
	}
	public function edit_level_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('MemberLevel')->edit_level($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_LEVEL') . ': ID[' . $data['member_level_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_level/list_level'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_LEVEL') . ': ID[' . $data['member_level_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_level/list_level'));
	}

	public function delete_level_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberLevelId = ARequest::get('member_level_id');
		$memberLevelId = is_array($memberLevelId) ? $memberLevelId : explode(',', $memberLevelId);
		$_L_ID = implode(', ', $memberLevelId);

		foreach($memberLevelId as $memberLevelId) {
			$result = M('MemberLevel')->delete_level($memberLevelId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_LEVEL') . ': ID[' . $memberLevelId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_level/list_level'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_LEVEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_level/list_level'));
	}
}

?>