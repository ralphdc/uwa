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

class ContentCtrlr extends IndexCtrlr {
	public function show_content() {
		$singlePageId = intval(ARequest::get('content_id'));
		$_SPI = M('Content')->get_contentInfo($singlePageId);
		if(empty($_SPI)) {
			halt('', true, true);
		}
		$this->assign('_V', $_SPI);

		
		$this->display('home/' . $_SPI['sp_tpl']);
	}
}

?>