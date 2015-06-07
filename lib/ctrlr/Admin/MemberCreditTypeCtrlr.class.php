<?php

/**
 *--------------------------------------
 * member credit type
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-8
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCreditTypeCtrlr extends ManageCtrlr {
	public function list_credit_type() {
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);
		$this->display();
	}

	public function add_credit_type_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('MemberCreditType')->add_creditType($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_CREDIT_TYPE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_credit_type/list_credit_type'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_CREDIT_TYPE') . ': ID[' . M('MemberCreditType')->db->lastInsID . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_credit_type/list_credit_type'));
	}

	public function update_credit_type_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberCreditTypeId = ARequest::get('member_credit_type_id');
		$mctName = ARequest::get('mct_name');
		$mctUnit = ARequest::get('mct_unit');
		$mctDefault = ARequest::get('mct_default');
		$mctExchange = ARequest::get('mct_exchange');
		$mctRatio = ARequest::get('mct_ratio');
		$_L_ID = is_array($memberCreditTypeId) ? implode(', ', $memberCreditTypeId) : $memberCreditTypeId;

		if(!is_array($memberCreditTypeId) or empty($memberCreditTypeId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_CREDIT_TYPE') . ': ID[' . $memberCreditTypeId . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_credit_type/list_credit_type'));
		}

		$data = array();
		$error = false;
		foreach($memberCreditTypeId as $k => $id) {
			$data['member_credit_type_id'] = $id;
			$data['mct_name'] = $mctName[$k];
			$data['mct_unit'] = $mctUnit[$k];
			$data['mct_default'] = $mctDefault[$k];
			$data['mct_exchange'] = $mctExchange[$k];
			$data['mct_ratio'] = $mctRatio[$k];
			if(false === M('MemberCreditType')->update($data)) {
				$error = true;
			}
		}
		if($error) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_CREDIT_TYPE') . ': ID[' . $memberCreditTypeId . ']', 0);
			$this->error(L('EDIT_FAILED'), Url::U('member_credit_type/list_credit_type'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_CREDIT_TYPE') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_credit_type/list_credit_type'));
	}

	public function delete_credit_type_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberCreditTypeId = ARequest::get('member_credit_type_id');
		$memberCreditTypeId = is_array($memberCreditTypeId) ? $memberCreditTypeId : explode(',', $memberCreditTypeId);
		$_L_ID = implode(', ', $memberCreditTypeId);

		foreach($memberCreditTypeId as $memberCreditTypeId) {
			$result = M('MemberCreditType')->delete_creditType($memberCreditTypeId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_CREDIT_TYPE') . ': ID[' . $memberCreditTypeId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_credit_type/list_credit_type'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_CREDIT_TYPE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_credit_type/list_credit_type'));
	}
}

?>