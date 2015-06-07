<?php

/**
 *--------------------------------------
 * member credit
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCreditCtrlr extends MemberCtrlr {
	public function credit_exchange() {
		$this->assign('_GCAP', 'member@member_credit/credit_exchange');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('CREDIT_EXCHANGE'), 'url' => ''))
		);

		/* member information */
		$_MI = M('Member')->get_memberInfo(ASession::get('member_id'));
		$this->assign('_MI', $_MI);

		/* member credit type list */
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);

		$this->display();
	}

	public function credit_exchange_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$type = ARequest::get('type');
		if(!in_array($type, array('ctp', 'ptc')) or !AFilter::is_word(ARequest::get('mct_alias'))) {
			$this->error(L('ERROR_UNKNOWN'), AServer::get_preUrl());
		}
		$mtcAlias = ARequest::get('mct_alias');
		$amount = intval(ARequest::get('amount'));
		$_c_old = M('MemberCredit')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->get_field($mtcAlias);
		$_p_old = M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->get_field('m_points');
		$ratio = intval(M('MemberCreditType')->where(array('mct_alias' => array('EQ', $mtcAlias)))->get_field('mct_ratio'));
		if('ctp' == $type) {
			if($amount > $_c_old) {
				$this->error(L('CREDIT_NOT_ENOUGH'), AServer::get_preUrl());
			}
			$_c_change = $amount;
			$_p_change = $amount * $ratio;
			/* decreace credit */
			M('MemberCredit')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_dec($mtcAlias, '', $_c_change);
			/* increace point */
			M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_inc('m_points', '', $_p_change);
		}
		elseif('ptc' == $type) {
			if($amount > $_p_old) {
				$this->error(L('POINTS_NOT_ENOUGH'), AServer::get_preUrl());
			}
			$_c_change = floor($amount / $ratio);
			$_p_change = $amount - $amount % $ratio;
			/* decreace point */
			M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_dec('m_points', '', $_p_change);
			/* increace credit */
			M('MemberCredit')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->field_inc($mtcAlias, '', $_c_change);
		}

		$this->success(L('EXCHANGE_SUCCESS'), AServer::get_preUrl());
	}

}

?>