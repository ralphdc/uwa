<?php

/**
 *--------------------------------------
 * single page
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-20
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class SinglePageCtrlr extends IndexCtrlr {
	public function show_single_page() {
		$singlePageId = intval(ARequest::get('single_page_id'));
		$_SPI = M('SinglePage')->get_singlePageInfo($singlePageId);
		if(empty($_SPI)) {
			halt('', true, true);
		}
		$this->assign('_V', $_SPI);

		/* html not support dynamic view */
		$_o = M('Option')->get_option('core');
		if($_o['html_switch'] and $_o['forced_html'] and 1 == $_SPI['sp_is_html'] and !is_mobile()) {
			$url = M('SinglePage')->build_url($singlePageId);
			redirect($url['sp_url']);
		}

		/* define current group */
		$this->assign('GROUP', $_SPI['sp_group']);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => $_SPI['sp_title'], 'url' => ''))
		);

		$_SPI['sp_tpl'] = $_SPI['sp_tpl'] ? $_SPI['sp_tpl'] : 'show_single_page';
		$this->display('home/' . $_SPI['sp_tpl']);
	}
}

?>