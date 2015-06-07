<?php

/**
 *--------------------------------------
 * member
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-8
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCtrlr extends ManageCtrlr {
	public function list_member() {
		/* filter model list */
		$_MML = M('MemberModel')->get_modelList(false);
		$this->assign('_MML', $_MML);

		/* filter level */
		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		$where = array();
		/* filter model */
		$memberModelId = ARequest::get('member_model_id') ? ARequest::get('member_model_id') : 0;
		if($memberModelId > 0) {
			$where['__MEMBER__.member_model_id'] = array('EQ', $memberModelId);
		}

		/* filter level */
		$memberLevelId = ARequest::get('member_level_id') ? ARequest::get('member_level_id') : 0;
		if($memberLevelId > 0) {
			$where['__MEMBER__.member_level_id'] = array('EQ', $memberLevelId);
		}

		/* filter status */
		$mStatus = ARequest::get('m_status') ? ARequest::get('m_status') : '';
		if('n' == $mStatus) {
			$where['__MEMBER__.m_status'] = array('EQ', 0);
		}
		elseif('p' == $mStatus) {
			$where['__MEMBER__.m_status'] = array('EQ', 1);
		}
		elseif('d' == $mStatus) {
			$where['__MEMBER__.m_status'] = array('EQ', 2);
		}

		/* filter username */
		$mUsername = ARequest::get('m_username');
		if(!empty($mUsername)) {
			$where['__MEMBER__.m_username'] = array('LIKE', '%' . $mUsername . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'member_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Member')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('member/list_member?member_model_id=' . $memberModelId . '&member_level_id=' . $memberLevelId . '&m_status=' . $mStatus . '&m_username=' . $mUsername . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* member list */
		$_ML = M('Member')->get_memberList($where, $order, $limit, $memberModelId);
		$this->assign('_ML', $_ML);

		$this->display();
	}

	public function add_member() {
		$memberModelId = ARequest::get('member_model_id');
		$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
		if(empty($_MMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member/list_member'));
		}
		$this->assign('_MI', $_MMI);

		/* member level list */
		$_MLL = M('MemberLevel')->get_levelList();
		if(empty($_MLL)) {
			$this->error(L('ADD_LEVEL_FIRST'), Url::U('member_level/add_level'));
		}
		$this->assign('_MLL', $_MLL);

		/* addon table information */
		$_FI = '';
		load('field#func');
		foreach($_MMI['mm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* creidt type list */
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);

		$this->display('admin/' . $_MMI['mm_tpl_add']);
	}
	public function add_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['m_userid'] = strtolower($data['m_userid']); /* userid is lowercase */
		$data['m_email'] = strtolower($data['m_email']); /* email is lowercase */
		$data['m_password'] = md5($data['m_userid'] . md5($data['m_password']));

		$_MLI = M('MemberLevel')->get_levelInfo($data['member_level_id']);
		$data['m_experience'] = $_MLI['ml_min_experience'];

		$data['m_points'] = !empty($data['m_points']) ? $data['m_points'] : 0;
		$data['m_reg_time'] = !empty($data['m_reg_time']) ? strtotime($data['m_reg_time']) : time();
		$data['m_reg_ip'] = !empty($data['m_reg_ip']) ? $data['m_reg_ip'] : AServer::get_ip();
		$data['m_login_time'] = !empty($data['m_login_time']) ? strtotime($data['m_login_time']) : time();
		$data['m_login_ip'] = !empty($data['m_login_ip']) ? $data['m_login_ip'] : AServer::get_ip();

		$result = M('Member')->add_member($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member/list_member'));
		}

		/* update upload */
		M('Upload')->update_upload($result['data']);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member/list_member'));
	}

	public function edit_member() {
		$memberId = ARequest::get('member_id');
		$_MI = M('Member')->get_memberInfo($memberId);
		if(empty($_MI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member/list_member'));
		}
		$this->assign('_MI', $_MI);

		/* member level list */
		$_MLL = M('MemberLevel')->get_levelList();
		if(empty($_MLL)) {
			$this->error(L('ADD_LEVEL_FIRST'), Url::U('member_level/add_level'));
		}
		$this->assign('_MLL', $_MLL);

		/* addon table information */
		$_FI = '';
		load('field#func');
		foreach($_MI['mm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_MI));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* credit type list */
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);

		$this->display('admin/' . $_MI['mm_tpl_edit']);
	}
	public function edit_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['m_email'] = strtolower($data['m_email']); /* email is lowercase */
		if(empty($data['m_password'])) {
			unset($data['m_password']);
		}
		else {
			$data['m_password'] = md5($data['m_userid'] . md5($data['m_password']));
		}

		$result = M('Member')->edit_member($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER') . ': ID[' . $data['member_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('member/list_member'));
		}

		M('Upload')->update_upload($data['member_id']);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER') . ': ID[' . $data['member_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member/list_member'));
	}

	public function delete_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberId = ARequest::get('member_id');
		$memberId = is_array($memberId) ? $memberId : explode(',', $memberId);
		$_L_ID = implode(', ', $memberId);

		foreach($memberId as $memberId) {
			$result = M('Member')->delete_member($memberId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER') . ': ID[' . $memberId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member/list_member'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member/list_member'));
	}

	public function pass_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberId = ARequest::get('member_id');
		$memberId = is_array($memberId) ? $memberId : explode(',', $memberId);
		$_L_ID = implode(', ', $memberId);

		foreach($memberId as $memberId) {
			$result = M('Member')->pass_member($memberId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_MEMBER') . ': ID[' . $memberId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member/list_member'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_MEMBER') . ': ID[' . $_L_ID . ']');
		$this->success(L('PASS_SUCCESS'), Url::U('member/list_member'));
	}

	public function forbidden_member_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberId = ARequest::get('member_id');
		$memberId = is_array($memberId) ? $memberId : explode(',', $memberId);
		$_L_ID = implode(', ', $memberId);

		foreach($memberId as $memberId) {
			$result = M('Member')->forbidden_member($memberId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('FORBIDDEN_MEMBER') . ': ID[' . $memberId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member/list_member'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('FORBIDDEN_MEMBER') . ': ID[' . $_L_ID . ']');
		$this->success(L('FORBIDDEN_SUCCESS'), Url::U('member/list_member'));
	}

	public function send_verify_email() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberId = ARequest::get('member_id');
		$memberId = is_array($memberId) ? $memberId : explode(',', $memberId);
		$_L_ID = implode(', ', $memberId);

		foreach($memberId as $memberId) {
			$result = M('Member')->send_verify_email($memberId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('SEND_VERIFY_EMAIL') . ': ID[' . $memberId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member/list_member'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('SEND_VERIFY_EMAIL') . ': ID[' . $_L_ID . ']');
		$this->success(L('SEND_SUCCESS'), Url::U('member/list_member'));
	}

}

?>