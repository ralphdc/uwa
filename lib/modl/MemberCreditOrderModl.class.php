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

class MemberCreditOrderModl extends Modl {
	public function get_creditOrderList($where, $order, $limit) {
		$_MCOL = $this->where($where)->order($order)->limit($limit)->select();
		return $_MCOL;
	}

	public function delete_creditOrder($memberCreditOrderId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($memberCreditOrderId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function pay_creditOrder($memberCreditOrderId) {
		$result = array('data' => '', 'error' => '');

		$_MCOI = $this->where(array('member_credit_order_id' => array('EQ', $memberCreditOrderId)))->find();
		if(empty($_MCOI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		M('Member')->where(array('member_id' => array('EQ', $_MCOI['mco_seller_member_id'])))->field_inc('m_points', '', $_MCOI['mco_points']);

		if(false === $this->where(array('member_credit_order_id' => array('EQ', $memberCreditOrderId)))->set_field('mco_status', 1)) {
			$result['error'] = L('PAY_FAILED');
			return $result;
		}

		return $result;

	}

}

?>