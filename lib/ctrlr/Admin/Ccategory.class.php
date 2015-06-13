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
	public function list_content() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Content')->count();
		$p = new APage($rowsNum, 20, Url::U('content/list_content?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_SPL = M('Content')->get_contentPageList('', '`content_display_order` ASC', $limit);
		$this->assign('_SPL', $_SPL);
        
		$this->display();
	}

	public function add_content() {
		$this->display();
	}
	public function add_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['content_edit_time'] = time();

		$result = M('Content')->add_content($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_SINGLE_PAGE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('content/list_content'));
		}
		/* build now */
		$data['content_id'] = $result['data'];
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			$this->build_html_do();
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_CONTENT') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('content/list_content'));
	}

	public function edit_content() {
		$contentId = ARequest::get('content_id');
		$_SPI = M('Content')->get_contentInfo($contentId);
		if(empty($_SPI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('content/list_content'));
		}
		$this->assign('_SPI', $_SPI);

		$this->display();
	}
	public function edit_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['content_edit_time'] = time();

		$result = M('Content')->edit_content($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CONTENT') . ': ID[' . $data['content_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('content/list_content'));
		}
		/* build now */
		/* if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			ARequest::set('show_progress', 'no');
			$this->build_html_do();
		} */
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CONTENT') . ': ID[' . $data['content_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('content/list_content'));
	}

	/* update single page */
	public function update_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$singlePageId = ARequest::get('content_id');
		$_L_ID = is_array($singlePageId) ? implode(', ', $singlePageId) : $singlePageId;

		if(empty($singlePageId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CONTENT') . ': ' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('content/list_content'));
		}

		$spDisplayOrder = ARequest::get('content_display_order');
		$data = array();
		foreach($singlePageId as $k => $id) {
			$data['content_id'] = $id;
			$data['content_display_order'] = $spDisplayOrder[$k];
			$result = M('Content')->edit_content($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CONTENT') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('content/list_content'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_CONTENT') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('content/list_content'));
	}

	public function delete_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$contentId = ARequest::get('content_id');
		$contentId = is_array($contentId) ? $contentId : explode(',', $contentId);
		$_L_ID = implode(', ', $contentId);

		foreach($contentId as $contentId) {
			$result = M('Content')->delete_content($contentId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('CONTENT') . ': ID[' . $contentId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('content/list_content'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_CONTENT') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('content/list_content'));
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