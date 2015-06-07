<?php

/**
 *--------------------------------------
 * member notify
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberNotifyCtrlr extends MemberCtrlr {
	public function list_notify() {
		$this->assign('_GCAP', 'member@member_notify/list_notify');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('NOTIFY'), 'url' => ''))
		);

		$where = array();
		$where['mn_m_id'] = array('IN', '-1,' . ASession::get('member_id'));
		/* filter status */
		$mnStatus = in_array(ARequest::get('mn_status'), array('u', 'r')) ? ARequest::get('mn_status') : '';
		if('u' == $mnStatus) {
			$where['mn_status'] = array('EQ', 0);
		}
		elseif('r' == $mnStatus) {
			$where['mn_status'] = array('EQ', 1);
		}

		/* sort list */
		$order = "`member_notify_id` DESC";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('MemberNotify')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('member_notify/list_notify?mn_status=' . $mnStatus . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* notify list */
		$_MNL = M('MemberNotify')->get_notifyList($where, $order, $limit);
		$this->assign('_MNL', $_MNL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/member_notify/list_notify');
		}
		else {
			$this->display();
		}
	}

	public function read_notify() {
		if(!I('read_notify', 1)) {
			exit();
		}

		$where = array();
		$where['member_notify_id'] = array('EQ', intval(ARequest::get('member_notify_id')));
		$where['mn_m_id'] = array('EQ', ASession::get('member_id'));
		M('MemberNotify')->where($where)->set_field('mn_status', 1);
		exit();
	}

	public function delete_notify_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_o_i = M('Option')->get_option('interaction');
		if(!I('interaction', $_o_i['feedback_interval'])) {
			$this->error(L('_TRY_LATER_'), AServer::get_preUrl());
		}

		$where = array();
		$where['mn_m_id'] = array('EQ', ASession::get('member_id'));
		$where['member_notify_id'] = array('EQ', intval(ARequest::get('member_notify_id')));

		if(false === M('MemberNotify')->where($where)->delete()) {
			$this->error(L('DELETE_NOTIFY_FAILED'), AServer::get_preUrl());
		}

		I('interaction');
		$this->success(L('DELETE_NOTIFY_SUCCESS'), Url::U('member_notify/list_notify'));
	}

}

?>