<?php

/**
 *--------------------------------------
 * controller base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Ctrlr extends Pfa {
	protected $te = null;

	public function __construct() {
		/* get template engine instance */
		$this->te = get_instance('Te', '', 'get_te');
	}

	/* template variable assignment */
	public function assign($var, $value) {
		$this->te->assign($var, $value);
	}

	/* display content */
	public function display($file = '', $charset = '', $contentType = '') {
		/* webpage charset */
		if(empty($charset)) {
			$charset = C('APP.CHARSET');
		}
		if(empty($contentType)) {
			$contentType = C('TE.TPL_CONTENT_TYPE');
		}
		header('Content-Type:' . $contentType . '; charset=' . $charset);
		header('Cache-control: private'); // support page go back

		$this->te->display($file);
	}

	/* build HTML. $htmlfile: 生成的静态文件名称, $htmlpath: 生成的静态文件路径 $templateFile 指定要调用的模板文件 */
	protected function build_html($htmlfile = '', $htmlpath = '', $templateFile = '') {
		return $this->te->build_html($htmlfile, $htmlpath, $templateFile);
	}

	/* operation error jump */
	public function error($message = '', $jumpUrl = '') {
		$this->disp_jump($message, $jumpUrl, 0);
	}

	/* operation success jump */
	public function success($message = '', $jumpUrl = '') {
		$this->disp_jump($message, $jumpUrl, 1);
	}

	/* disp jump $status 1:success, 0:error */
	private function disp_jump($message, $jumpUrl = '', $status = 1) {
		if($status) {
			$this->assign('status', 'success');
		}
		else {
			$this->assign('status', 'error');
		}
		$this->assign('message', $message);
		$this->assign('jumpUrl', $jumpUrl);
		$this->display(C('TPL.DISP_JUMP'));
		exit();
	}

	/* Ajax return. $data: array('data'=>1, info=>"info"), $type:ajax type*/
	public function ajax_return($data, $type = 'JSON') {
		if(!IS_AJAX) {
			exit();
		}
		switch(strtoupper($type)) {
			case 'JSON': // return JSON data
				header("Content-Type:text/html; charset=utf-8");
				exit(json_encode($data));
			case 'XML': // return XML data
				header("Content-Type:text/xml; charset=utf-8");
				exit(xml_encode($data));
			case 'EVAL': // return executable js script
				header("Content-Type:text/html; charset=utf-8");
				exit($data);
			default:
				exit();
		}
	}

	public function __call($method, $args) {
	}

	public static function __callStatic($method, $args) {
	}
}

?>