<?php

/**
 *--------------------------------------
 * common
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-29
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CommonCtrlr extends Ctrlr {
	public function __construct() {
		parent::__construct();

		/* check entry */
		session_start();
		if(!isset($_SESSION['admin_enter']) or 1 != $_SESSION['admin_enter']) {
			redirect(Url::U('home@index/index'));
			exit();
		}
	}

	public function captcha_img() {
		$name = in_array(ARequest::get('name'), array('vcode', 'test')) ? ARequest::get('name', 'get') : 'vcode';

		$fonts = array(
			'spacing' => 2,
			'size' => 16,
			'font' => PUBLIC_PATH . D_S . 'font/font.ttf');
		$ac = new ACaptcha(90, 30, 5, $fonts);
		ASession::set($name, strtolower($ac->text));
		$ac->create_image();
	}

}

?>