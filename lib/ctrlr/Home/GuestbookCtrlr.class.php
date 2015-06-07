<?php

/**
 *--------------------------------------
 * guestbook
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-26
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class GuestbookCtrlr extends IndexCtrlr {
	public function list_guestbook() {
		$_o = get_extensionOption('guestbook');
		if(!$_o['switch']) {
			$this->error(L('GUESTBOOK_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@guestbook/list_guestbook');

		$where = array();
		/* filter status */
		$where['__GUESTBOOK__.g_status'] = array('GT', 0);

		/* sort list */
		$order = "`g_add_time` DESC";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('Guestbook')->where($where)->count();
		$p = new APage($rowsNum, $_o['page_size'], Url::U('guestbook/list_guestbook?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* guestbook list */
		$_GL = M('Guestbook')->get_guestbookList($where, $order, $limit);
		$this->assign('_L', $_GL);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('GUESTBOOK'), 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/list_guestbook');
		}
		else {
			$this->display('home/list_guestbook');
		}
	}

	public function add_guestbook() {
		$_o = get_extensionOption('guestbook');
		if(!$_o['switch']) {
			$this->error(L('GUESTBOOK_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@guestbook/add_guestbook');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('GUESTBOOK'), 'url' => ''))
		);

		$this->display('home/add_guestbook');
	}

	public function add_guestbook_do() {
		$_o = get_extensionOption('guestbook');
		if(!$_o['switch']) {
			$this->error(L('GUESTBOOK_IS_OFF'), __APP__);
		}

		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction('feedback');

		$data = array();
		$data['g_author'] = AFilter::text(ARequest::get('g_author'), 96);
		$data['g_content'] = str_replace(array("\r\n", "\n"), "<br />", AFilter::text(ARequest::get('g_content'), 500));
		$data['g_add_time'] = time();
		$data['g_add_ip'] = AServer::get_ip();
		$data['member_id'] = ASession::get('member_id');

		/* content need filter or archive need audit */
		$report = false;
		$_o_i = M('Option')->get_option('interaction');
		if($_o_i['auto_report'] > 0 and !M('Report')->report_check(array($data['g_author'], $data['g_content']))) {
			if(2 == $_o_i['auto_report']) {
				$data['g_status'] = 2;
			}
			else {
				$data['g_status'] = 0;
			}
			$report = true;
		}
		elseif($_o_i['feedback_check']) {
			$data['g_status'] = 0;
		}
		else {
			$data['g_status'] = 1;
		}

		$result = M('Guestbook')->add_guestbook($data);

		/* need report */
		if($report) {
			$_t_data['r_item_type'] = 'guestbook';
			$_t_data['r_item_id'] = M('Guestbook')->get_lastInsID();
			$_t_data['r_info'] = 'filter';
			$_t_data['r_add_time'] = time();
			$_t_data['r_add_ip'] = AServer::get_ip();
			$_t_data['r_status'] = 0;
			M('Report')->insert($_t_data);
		}

		if(!empty($result['error'])) {
			$this->error($result['error'], AServer::get_preUrl());
		}
		$this->success(L('ADD_SUCCESS'), AServer::get_preUrl());
	}

}

?>