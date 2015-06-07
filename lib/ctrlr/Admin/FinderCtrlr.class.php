<?php

/**
 *--------------------------------------
 * finder
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-01-13
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FinderCtrlr extends ManageCtrlr {
	public function browse() {
		$langName = C('LANG.NAME');
		$_t_l = '';
		$langset = require PFA_PATH . '/comm/langset.php';
		if('' != ACookie::get('lang')) {
			$_t_l = strtolower(ACookie::get('lang'));
		}
		else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
			$_t_l = strtolower($matches[1]);
		}
		if(!empty($langName) and array_key_exists($_t_l, $langset)) {
			$langName = $_t_l;
		}
		ARequest::set('lang', $langName);

		$type = AFilter::is_word(ARequest::get('type')) ? ARequest::get('type') : 'archive';

		$o_upload = M('Option')->get_option('upload');
		$_typeset = in_array(ARequest::get('typeset'), array(
			'image',
			'file',
			'all')) ? ARequest::get('typeset') : 'image';
		$typeset = '';
		if('all' == $_typeset) {
			$typeset = implode(' ', array_unique(array_merge(explode(',', $o_upload['imgtype']), explode(',', $o_upload['filetype']))));
		}
		elseif('image' == $_typeset) {
			$typeset = implode(' ', array_unique(explode(',', $o_upload['imgtype'])));
		}

		if(!isset($_SESSION)) {
			session_start();
		}
		$_SESSION['FINDER']['browse_url'] = Url::U('finder/browse?typeset=' . $_typeset) . '&';
		$_SESSION['FINDER']['disabled'] = false;
		$_SESSION['FINDER']['uploadURL'] = __APP__;
		$_SESSION['FINDER']['uploadDir'] = '';
		$_SESSION['FINDER']['maxFileSize'] = $o_upload['maxsize'] * 1024;
		$_SESSION['FINDER']['types'] = array(trim($o_upload['dir'], '/\\') => $typeset);
		$_SESSION['FINDER']['check4htaccess'] = false;
		$_SESSION['FINDER']['thumbsDir'] = trim($o_upload['dir'], '/\\') . "/.thumbs";
		$_SESSION['FINDER']['access'] = array(
			'files' => array(
				'upload' => false,
				'delete' => false,
				'copy' => false,
				'move' => false,
				'rename' => false),
			'dirs' => array(
				'create' => false,
				'delete' => false,
				'rename' => false));

		define('__FINDER__', __PUBLIC__ . 'js/finder/');

		$o_image = M('Option')->get_option('image');
		$_SESSION['FINDER']['thumbWidth'] = $o_image['thumb_width'] < 180 ? $o_image['thumb_width'] : 180;
		$_SESSION['FINDER']['thumbHeight'] = $o_image['thumb_width'] < 180 ? $o_image['thumb_height'] : ($o_image['thumb_height'] / $o_image['thumb_width'] * 180);

		require PUBLIC_PATH . "/js/finder/core/autoload.php";
		C('APP.AUTOLOAD_PATH', FINDER_PATH . D_S . "core," . FINDER_PATH . D_S . "core/types," . FINDER_PATH . D_S . "lib");

		if('browser' == $_GET['act'] or empty($_GET['act'])) {
			$_GET['dir'] = $o_upload['dir'] . '/' . $type;
		}
		$browser = new browser();
		$browser->action();
	}

	public function browse_server() {
		$langName = C('LANG.NAME');
		$_t_l = '';
		$langset = require PFA_PATH . '/comm/langset.php';
		if('' != ACookie::get('lang')) {
			$_t_l = strtolower(ACookie::get('lang'));
		}
		else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
			$_t_l = strtolower($matches[1]);
		}
		if(!empty($langName) and array_key_exists($_t_l, $langset)) {
			$langName = $_t_l;
		}
		ARequest::set('lang', $langName);

		$o_upload = M('Option')->get_option('upload');
		$typeset = implode(' ', array_unique(array_merge(explode(',', $o_upload['imgtype']), explode(',', $o_upload['filetype']))));

		if(!isset($_SESSION)) {
			session_start();
		}
		$_SESSION['FINDER']['browse_url'] = Url::U('finder/browse_server') . '&';
		$_SESSION['FINDER']['disabled'] = false;
		$_SESSION['FINDER']['uploadURL'] = __APP__;
		$_SESSION['FINDER']['uploadDir'] = '';
		$_SESSION['FINDER']['maxFileSize'] = $o_upload['maxsize'] * 1024;
		$_SESSION['FINDER']['types'] = array(trim($o_upload['dir'], '/\\') => $typeset);
		$_SESSION['FINDER']['check4htaccess'] = false;
		$_SESSION['FINDER']['thumbsDir'] = trim($o_upload['dir'], '/\\') . "/.thumbs";
		$_SESSION['FINDER']['access'] = array(
			'files' => array(
				'upload' => true,
				'delete' => true,
				'copy' => true,
				'move' => true,
				'rename' => true),
			'dirs' => array(
				'create' => true,
				'delete' => true,
				'rename' => true));

		define('__FINDER__', __PUBLIC__ . 'js/finder/');

		$o_image = M('Option')->get_option('image');
		$_SESSION['FINDER']['thumbWidth'] = $o_image['thumb_width'] < 180 ? $o_image['thumb_width'] : 180;
		$_SESSION['FINDER']['thumbHeight'] = $o_image['thumb_width'] < 180 ? $o_image['thumb_height'] : ($o_image['thumb_height'] / $o_image['thumb_width'] * 180);

		require PUBLIC_PATH . "/js/finder/core/autoload.php";
		C('APP.AUTOLOAD_PATH', FINDER_PATH . D_S . "core," . FINDER_PATH . D_S . "core/types," . FINDER_PATH . D_S . "lib");

		$browser = new browser();
		$browser->action();
	}
}

?>