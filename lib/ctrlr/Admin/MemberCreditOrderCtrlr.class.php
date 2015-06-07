<?php

/**
 *--------------------------------------
 * member credit order
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-16
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCreditOrderCtrlr extends ManageCtrlr {
	public function list_credit_order() {
		$where = array();

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['member_id'] = array('EQ', $memberId);
		}

		/* filter seller member */
		$mcoSellerMemberId = ARequest::get('mco_seller_member_id') ? ARequest::get('mco_seller_member_id') : 0;
		if($mcoSellerMemberId > 0) {
			$where['mco_seller_member_id'] = array('EQ', $mcoSellerMemberId);
		}

		/* filter type */
		$mcoProductType = ARequest::get('mco_product_type') ? ARequest::get('mco_product_type') : '';
		if(!empty($mcoProductType)) {
			$where['mco_product_type'] = array('EQ', $mcoProductType);
		}

		/* filter status */
		$mcoStatus = ARequest::get('mco_status') ? ARequest::get('mco_status') : '';
		if('n' == $mcoStatus) {
			$where['mco_status'] = array('EQ', 0);
		}
		elseif('p' == $mcoStatus) {
			$where['mco_status'] = array('EQ', 1);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'member_credit_order_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('MemberCreditOrder')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('member_credit_order/list_credit_order?member_id=' . $memberId . '&mco_seller_member_id=' . $mcoSellerMemberId . '&mco_product_type=' . $mcoProductType . '&mco_status=' . $mcoStatus . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* member order list */
		$_MOL = M('MemberCreditOrder')->get_creditOrderList($where, $order, $limit);
		$this->assign('_MOL', $_MOL);

		$this->display();
	}

	public function delete_credit_order_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberCreditOrderId = ARequest::get('member_credit_order_id');
		$memberCreditOrderId = is_array($memberCreditOrderId) ? $memberCreditOrderId : explode(',', $memberCreditOrderId);
		$_L_ID = implode(', ', $memberCreditOrderId);

		foreach($memberCreditOrderId as $memberCreditOrderId) {
			$result = M('MemberCreditOrder')->delete_creditOrder($memberCreditOrderId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_CREDIT_ORDER') . ': ID[' . $memberCreditOrderId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_credit_order/list_credit_order'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_CREDIT_ORDER') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_credit_order/list_credit_order'));
	}

	public function pay_credit_order_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberCreditOrderId = ARequest::get('member_credit_order_id');
		$memberCreditOrderId = is_array($memberCreditOrderId) ? $memberCreditOrderId : explode(',', $memberCreditOrderId);
		$_L_ID = implode(', ', $memberCreditOrderId);

		foreach($memberCreditOrderId as $memberCreditOrderId) {
			$result = M('MemberCreditOrder')->pay_creditOrder($memberCreditOrderId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PAY_MEMBER_CREDIT_ORDER') . ': ID[' . $memberCreditOrderId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_credit_order/list_credit_order'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PAY_MEMBER_CREDIT_ORDER') . ': ID[' . $_L_ID . ']');
		$this->success(L('PAY_SUCCESS'), Url::U('member_credit_order/list_credit_order'));
	}
}

?>