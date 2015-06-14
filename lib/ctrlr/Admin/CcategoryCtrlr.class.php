<?php

/**
 *--------------------------------------
 * single page
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-19
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CcategoryCtrlr extends ManageCtrlr {
	public function list_ccategory() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Ccategory')->count();
		$p = new APage($rowsNum, 20, Url::U('ccategory/list_ccategory?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_SPL = M('Ccategory')->get_ccategoryPageList('', '`ccategory_display_order` ASC', $limit);
		$this->assign('_SPL', $_SPL);
		$this->display();
	}

	public function add_ccategory() {
	    $pcategory= M('Pcategory')->select();
	    
	    $this->assign('ps', $pcategory);
		$this->display();
	}
	public function add_ccategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['ccategory_edit_time'] = time();

		$result = M('Ccategory')->add_ccategory($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CCATEGORY') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('ccategory/list_ccategory'));
		}
		/* build now */
		$data['ccategory_id'] = $result['data'];
		//忽略以下代码；
		/*
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			$this->build_html_do();
		}
		*/
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CCATEGORY') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('ccategory/list_ccategory'));
	}

	public function edit_ccategory() {
		$ccategoryId = ARequest::get('ccategory_id');
		$_SPI = M('Ccategory')->get_ccategoryInfo($ccategoryId);
		if(empty($_SPI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ccategory/list_ccategory'));
		}
		$this->assign('_SPI', $_SPI);

		$this->display();
	}
	public function edit_ccategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['ccategory_edit_time'] = time();

		$result = M('Ccategory')->edit_ccategory($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CCATEGORY') . ': ID[' . $data['ccategory_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('ccategory/list_ccategory'));
		}
		/* build now */
		/* if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			ARequest::set('show_progress', 'no');
			$this->build_html_do();
		} */
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CCATEGORY') . ': ID[' . $data['ccategory_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('ccategory/list_ccategory'));
	}

	/* update single page */
	public function update_ccategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$ccategoryId = ARequest::get('ccategory_id');
		$_L_ID = is_array($ccategoryId) ? implode(', ', $ccategoryId) : $ccategoryId;

		if(empty($ccategoryId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CCATEGORY') . ': ' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ccategory/list_ccategory'));
		}

		$spDisplayOrder = ARequest::get('ccategory_display_order');
		$data = array();
		foreach($ccategoryId as $k => $id) {
			$data['ccategory_id'] = $id;
			$data['ccategory_display_order'] = $spDisplayOrder[$k];
			$result = M('Ccategory')->edit_ccategory($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CCATEGORY') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('ccategory/list_ccategory'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CCATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('ccategory/list_ccategory'));
	}

	public function delete_ccategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$ccategoryId = ARequest::get('ccategory_id');
		$ccategoryId = is_array($ccategoryId) ? $ccategoryId : explode(',', $ccategoryId);
		$_L_ID = implode(', ', $ccategoryId);

		foreach($ccategoryId as $ccategoryId) {
			$result = M('Ccategory')->delete_ccategory($ccategoryId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('CCATEGORY') . ': ID[' . $ccategoryId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('ccategory/list_ccategory'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CCATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('ccategory/list_ccategory'));
	}

	public function build_url_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$singlePageId = ARequest::get('single_page_id');
		$singlePageId = is_array($singlePageId) ? $singlePageId : explode(',', $singlePageId);
		$_L_ID = implode(', ', $singlePageId);

		foreach($singlePageId as $singlePageId) {
			$result = M('SinglePage')->build_url($singlePageId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_SINGLE_PAGE_URL') . ': ID[' . $singlePageId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('single_page/list_single_page'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_SINGLE_PAGE_URL') . ': ID[' . $_L_ID . ']');
		$this->success(L('BUILD_SUCCESS'), Url::U('single_page/list_single_page'));
	}

	/* build single page html */
	public function build_html_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
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

		set_time_limit(99999999);
		if('no' != ARequest::get('show_progress')) {
			$this->display('admin/build/progress');
		}

		$singlePageId = ARequest::get('single_page_id');

		$_L_ID = is_array($singlePageId) ? implode(', ', $singlePageId) : $singlePageId;
		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_SINGLE_PAGE_HTML') . ': ID[' . $_L_ID . ']');

		if(!is_array($singlePageId)) {
			$singlePageId = explode(',', $singlePageId);
		}
		sort($singlePageId);
		$rowNum = count($singlePageId);
		vendor('Pinyin#class');
		$pyc = get_instance('Pinyin');
		foreach($singlePageId as $key => $singlePageId) {
			$progress = round(($key + 1) / $rowNum * 100, 1);

			$_V = M('SinglePage')->get_singlePageInfo($singlePageId);
			if(empty($_V) or !$_V['sp_is_html'] or empty($_V['sp_html_naming'])) {
				if('no' != ARequest::get('show_progress')) {
					M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . L('SKIP'), $progress);
				}
				continue;
			}
			$this->assign('_V', $_V);

			/* current group */
			$this->assign('GROUP', $_V['sp_group']);

			$this->assign('_CP', array(
				array('name' => L('HOME'), 'url' => __APP__),
				array('name' => $_V['sp_title'], 'url' => ''))
			);

			$file = '/' . trim(str_replace(array('{uwa_path}', '{sp_py}'), array('', $pyc->get_pinyin($_V['sp_title'], 'utf-8')), $_V['sp_html_naming']), '/');

			$_C = require (CFG_PATH . D_S . 'comm.php');
			$this->te->tplTheme = $_C['TE']['TPL_THEME'];
			$this->build_html($file . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/' . $_V['sp_tpl']);
			$this->te->tplTheme = 'default';

			if('no' != ARequest::get('show_progress')) {
				M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . $_V['sp_title'] . ' ' . L('BUILD_COMPLETE'), $progress);
			}
		}

		set_time_limit(30);
		if('no' != ARequest::get('show_progress')) {
			M('Build')->show_direction(Url::U('single_page/list_single_page'));
		}
	}
}

?>