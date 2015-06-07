<?php

/**
 *--------------------------------------
 * report
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-6
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ReportCtrlr extends IndexCtrlr {
	public function add_report() {
		$_o = M('Option')->get_option('interaction/report_switch');
		if(!$_o) {
			$this->error(L('REPORT_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@report/add_report');

		$_V['r_item_type'] = AFilter::is_word(ARequest::get('r_item_type')) ? ARequest::get('r_item_type') : 'archive';
		$_V['r_item_id'] = intval(ARequest::get('r_item_id'));
		switch($_V['r_item_type']) {
			case 'archive':
				$_ai = M('Archive')->where(array('archive_id' => array('EQ', $_V['r_item_id'])))->field('a_title')->find();
				if(empty($_ai)) {
					halt('', true, true);
				}
				$_V['item_title'] = $_ai['a_title'];
				$_V['item_url'] = Url::U('archive/show_archive?archive_id=' . $_V['r_item_id']);
				break;
			default:
				break;
		}

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('REPORT'), 'url' => ''))
		);

		$this->assign('_V', $_V);

		$this->display('home/add_report');
	}

	public function add_report_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction('feedback');

		$data = array();
		$data['r_item_type'] = AFilter::is_word(ARequest::get('r_item_type')) ? ARequest::get('r_item_type') : 'archive';
		$data['r_item_id'] = intval(ARequest::get('r_item_id'));
		$data['r_info'] = AFilter::text(ARequest::get('r_info'), 500);
		$data['r_add_time'] = time();
		$data['r_add_ip'] = AServer::get_ip();
		$data['r_status'] = 0;

		$result = M('Report')->add_report($data);

		if(!empty($result['error'])) {
			$this->error($result['error'], __APP__);
		}
		$this->success(L('ADD_SUCCESS'), __APP__);
	}
}

?>