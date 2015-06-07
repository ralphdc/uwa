<?php

/**
 *--------------------------------------
 * flink
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-05
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FlinkCtrlr extends IndexCtrlr {
	public function list_flink() {
		$_o = get_extensionOption('flink');
		if(!$_o['switch']) {
			$this->error(L('FLINK_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@flink/list_flink');

		$where = array();
		$where['__FLINK__.f_status'] = array('EQ', 1);
		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('Flink')->where($where)->count();
		$p = new APage($rowsNum, $_o['page_size'], Url::U('flink/list_flink?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* flink list */
		$_FL = M('Flink')->get_flinkList($where, '__FLINK__.`flink_category_id` ASC, `f_display_order` ASC', $limit);
		$this->assign('_L', $_FL);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('FLINK'), 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/list_flink');
		}
		else {
			$this->display('home/list_flink');
		}
	}

	public function apply_flink() {
		$_o = get_extensionOption('flink');
		if(!$_o['switch']) {
			$this->error(L('FLINK_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@flink/apply_flink');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('APPLY_FLINK'), 'url' => ''))
		);

		$this->display('home/apply_flink');
	}

	public function apply_flink_do() {
		$_o = get_extensionOption('flink');
		if(!$_o['switch']) {
			$this->error(L('FLINK_IS_OFF'), __APP__);
		}

		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction('feedback');

		$data = array();
		$data['f_site_name'] = AFilter::plain_text(ARequest::get('f_site_name'), 32);
		$data['f_site_url'] = AFilter::text(ARequest::get('f_site_url'), 255);
		$data['f_site_logo'] = AFilter::text(ARequest::get('f_site_logo'), 255);
		$data['f_webmaster_email'] = AFilter::text(ARequest::get('f_webmaster_email'), 255);
		$data['f_site_description'] = AFilter::text(ARequest::get('f_site_description'), 500);
		$data['f_status'] = 0;
		$data['flink_category_id'] = 0;

		$result = M('Flink')->add_flink($data);

		if(!empty($result['error'])) {
			$this->error($result['error'], Url::U('flink/list_flink'));
		}
		$this->success(L('APPLY_SUCCESS'), Url::U('flink/list_flink'));
	}
}

?>