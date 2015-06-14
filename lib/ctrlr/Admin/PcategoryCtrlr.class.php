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

class PcategoryCtrlr extends ManageCtrlr {
	public function list_pcategory() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Pcategory')->count();
		$p = new APage($rowsNum, 20, Url::U('pcategory/list_pcategory?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_SPL = M('Pcategory')->get_pcategoryPageList('', '`pcategory_display_order` ASC', $limit);
		$this->assign('_SPL', $_SPL);
		$this->display();
	}

	public function add_pcategory() {
		$this->display();
	}
	public function add_pcategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['pcategory_edit_time'] = time();

		$result = M('Pcategory')->add_pcategory($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_PCATEGORY') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('pcategory/list_pcategory'));
		}
		/* build now */
		$data['pcategory_id'] = $result['data'];
		//忽略以下代码；
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			$this->build_html_do();
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_PCATEGORY') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('pcategory/list_pcategory'));
	}

	public function edit_pcategory() {
		$pcategoryId = ARequest::get('pcategory_id');
		$_SPI = M('Pcategory')->get_pcategoryInfo($pcategoryId);
		if(empty($_SPI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('pcategory/list_pcategory'));
		}
		$this->assign('_SPI', $_SPI);

		$this->display();
	}
	public function edit_pcategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['pcategory_edit_time'] = time();

		$result = M('Pcategory')->edit_pcategory($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PCATEGORY') . ': ID[' . $data['pcategory_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('pcategory/list_pcategory'));
		}
		/* build now */
		/* if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			ARequest::set('show_progress', 'no');
			$this->build_html_do();
		} */
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PCATEGORY') . ': ID[' . $data['pcategory_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('pcategory/list_pcategory'));
	}

	/* update single page */
	public function update_pcategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$pcategoryId = ARequest::get('pcategory_id');
		$_L_ID = is_array($pcategoryId) ? implode(', ', $pcategoryId) : $pcategoryId;

		if(empty($pcategoryId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PCATEGORY') . ': ' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('pcategory/list_pcategory'));
		}

		$spDisplayOrder = ARequest::get('pcategory_display_order');
		$data = array();
		foreach($pcategoryId as $k => $id) {
			$data['pcategory_id'] = $id;
			$data['pcategory_display_order'] = $spDisplayOrder[$k];
			$result = M('Pcategory')->edit_pcategory($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PCATEGORY') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('pcategory/list_pcategory'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PCATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('pcategory/list_pcategory'));
	}

	public function delete_pcategory_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$pcategoryId = ARequest::get('pcategory_id');
		$pcategoryId = is_array($pcategoryId) ? $pcategoryId : explode(',', $pcategoryId);
		$_L_ID = implode(', ', $pcategoryId);

		foreach($pcategoryId as $pcategoryId) {
			$result = M('Pcategory')->delete_pcategory($pcategoryId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PCATEGORY') . ': ID[' . $pcategoryId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('pcategory/list_pcategory'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_PCATEGORY') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('pcategory/list_pcategory'));
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