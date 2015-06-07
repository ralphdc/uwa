<?php

/**
 *--------------------------------------
 * member credit order
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCreditOrderCtrlr extends MemberCtrlr {
	public function list_credit_order() {
		$this->assign('_GCAP', 'member@member_credit_order/list_credit_order');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('CREDIT_ORDER'), 'url' => ''))
		);

		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));
		/* filter status */
		$mcoStatus = in_array(ARequest::get('mco_status'), array('u', 'p')) ? ARequest::get('mco_status') : '';
		if('u' == $mcoStatus) {
			$where['mco_status'] = array('EQ', 0);
		}
		elseif('p' == $mcoStatus) {
			$where['mco_status'] = array('EQ', 1);
		}

		/* sort list */
		$order = "`mco_add_time` DESC";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('MemberCreditOrder')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('member_credit_order/list_credit_order?mco_status=' . $mcoStatus . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* credit order list */
		$_MCOL = M('MemberCreditOrder')->get_creditOrderList($where, $order, $limit);
		$this->assign('_MCOL', $_MCOL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/member_credit_order/list_credit_order');
		}
		else {
			$this->display();
		}
	}

	public function pay_credit_order_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_o_i = M('Option')->get_option('interaction');
		if(!I('pay', $_o_i['feedback_interval'])) {
			$this->error(L('_TRY_LATER_'), AServer::get_preUrl());
		}

		$memberCreditOrderId = intval(ARequest::get('member_credit_order_id'));

		$_MCOI = M('MemberCreditOrder')->where(array('member_credit_order_id' => array('EQ', $memberCreditOrderId)))->find();
		if(empty($_MCOI)) {
			$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
		}
		if(1 == $_MCOI['mco_status']) {
			$this->error(L('PAIED'), AServer::get_preUrl());
		}

		/* deal with points */
		$_mp = M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->get_field('m_points');
		if($_mp < $_MCOI['mco_points']) {
			$this->error(L('POINTS_NOT_ENOUGH'), AServer::get_preUrl());
		}

		if(false === M('MemberCreditOrder')->where(array('member_credit_order_id' => array('EQ', $memberCreditOrderId)))->set_field('mco_status', 1)) {
			$this->error(L('PAY_FAILED'), AServer::get_preUrl());
		}
		M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_dec('m_points', '', $_MCOI['mco_points']);
		M('Member')->where(array('member_id' => array('EQ', $_MCOI['mco_seller_member_id'])))->field_inc('m_points', '', $_MCOI['mco_points']);

		I('pay');
		$this->success(L('PAY_SUCCESS'), AServer::get_preUrl());
	}

	public function buy_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_o_i = M('Option')->get_option('interaction');
		if(!I('buy', $_o_i['feedback_interval'])) {
			$this->error(L('_TRY_LATER_'), AServer::get_preUrl());
		}

		$archiveId = intval(ARequest::get('archive_id'));
		$_AI = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field('a_title,a_cost_points,a_url_o,member_id')->find();
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
		}

		/* add to favorite */
		$_MFI = M('MemberFavorite')->where(array('member_id' => array('EQ', ASession::get('member_id')), 'archive_id' => array('EQ', $archiveId)))->find();
		if(empty($_MFI)) {
			$data = array();
			$data['member_id'] = ASession::get('member_id');
			$data['archive_id'] = $archiveId;
			$data['mf_title'] = $_AI['a_title'];
			$data['mf_url'] = $_AI['a_url_o'];
			$data['mf_add_time'] = time();
			M('MemberFavorite')->insert($data);
		}

		$_MCOI = M('MemberCreditOrder')->where(array('member_id' => array('EQ', ASession::get('member_id')), 'mco_product_type' => array('EQ', 'archive'), 'mco_product_name' => array('EQ', 'ARCHIVE' . $archiveId)))->find();
		if(!empty($_MCOI)) {
			$this->error(L('PAIED'), AServer::get_preUrl());
		}

		$data = array();
		$data['member_id'] = ASession::get('member_id');
		$data['mco_seller_member_id'] =  $_AI['member_id'];
		$data['mco_product_type'] = 'archive';
		$data['mco_product_name'] = 'ARCHIVE' . $archiveId;
		$data['mco_points'] = $_AI['a_cost_points'];
		$data['mco_status'] = 0;
		$data['mco_add_time'] = time();
		$data['mco_add_ip'] = AServer::get_ip();

		$_mp = M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->get_field('m_points');
		if($_mp >= $_AI['a_cost_points']) {
			$data['mco_status'] = 1;
			M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_dec('m_points', '', $_AI['a_cost_points']);
			M('Member')->where(array('member_id' => array('EQ', $_AI['member_id'])))->field_inc('m_points', '', $_AI['a_cost_points']);
		}

		if(false === M('MemberCreditOrder')->insert($data)) {
			$this->error(L('BUY_FAILED'), AServer::get_preUrl());
		}

		I('buy');
		if(1 == $data['mco_status']) {
			$this->success(L('BUY_SUCCESS'), AServer::get_preUrl());
		}
		else {
			$this->success(L('ADD_ORDER_SUCCESS'), Url::U('member_credit_order/list_credit_order'));
		}
	}

}

?>