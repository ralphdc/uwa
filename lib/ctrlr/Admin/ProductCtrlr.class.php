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

class ProductCtrlr extends ManageCtrlr {
	public function list_product() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Product')->count();
		$p = new APage($rowsNum, 20, Url::U('product/list_product?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_SPL = M('Product')->get_productPageList('', '`product_display_order` ASC', $limit);
		$this->assign('_SPL', $_SPL);
		
		$parent_category = M('Pcategory')->field(array('pcategory_id','pcategory_title'))->select();
		$child_category = M('Ccategory')->field(array('ccategory_id','ccategory_title'))->select();
		
		$ps=array();
		$cs=array();
		foreach($parent_category as $parent){
		    $ps[$parent['pcategory_id']] = $parent['pcategory_title'];
		}
		foreach($child_category as $child){
		    $cs[$child['ccategory_id']] = $child['ccategory_title'];
		}
		$this->assign('parent_category',$ps);
		$this->assign('child_category', $cs);
		$this->display();
	}

	public function add_product() {
	    $pcategory= M('Pcategory')->select();
	    
	    $this->assign('ps', $pcategory);
		$this->display();
	}
	public function add_product_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['product_edit_time'] = time();

		$result = M('Product')->add_product($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_PRODUCT') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('product/list_product'));
		}
		/* build now */
		$data['product_id'] = $result['data'];
		//忽略以下代码；
		/*
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			$this->build_html_do();
		}
		*/
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_PRODUCT') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('product/list_product'));
	}

	public function edit_product() {
		$productId = ARequest::get('product_id');
		$_SPI = M('Product')->get_productInfo($productId);
		if(empty($_SPI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('product/list_product'));
		}
		$this->assign('_SPI', $_SPI);

		$this->display();
	}
	public function edit_product_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		//$data['product_edit_time'] = time();

		$result = M('Product')->edit_product($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PRODUCT') . ': ID[' . $data['product_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('product/list_product'));
		}
		/* build now */
		/* if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('SinglePage')->build_url($data['single_page_id']);
			ARequest::set('single_page_id', $data['single_page_id']);
			ARequest::set('show_progress', 'no');
			$this->build_html_do();
		} */
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PRODUCT') . ': ID[' . $data['product_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('product/list_product'));
	}

	/* update single page */
	public function update_product_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$productId = ARequest::get('product_id');
		$_L_ID = is_array($productId) ? implode(', ', $productId) : $productId;

		if(empty($productId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PRODUCT') . ': ' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('product/list_product'));
		}

		$spDisplayOrder = ARequest::get('product_display_order');
		$data = array();
		foreach($productId as $k => $id) {
			$data['product_id'] = $id;
			$data['product_display_order'] = $spDisplayOrder[$k];
			$result = M('Product')->edit_product($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PRODUCT') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('product/list_product'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_PRODUCT') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('product/list_product'));
	}

	public function delete_product_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$productId = ARequest::get('product_id');
		$productId = is_array($productId) ? $productId : explode(',', $productId);
		$_L_ID = implode(', ', $productId);

		foreach($productId as $productId) {
			$result = M('Product')->delete_product($productId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PRODUCT') . ': ID[' . $productId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('product/list_product'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_PRODUCT') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('product/list_product'));
	}
    
	public function checkcategory(){
	    $pid =  ARequest::get('pid');
	    if(empty($pid)){
	        echo  json_encode(array('result'=>1,'message'=>'传入参数错误！'));
	        exit;
	    }
	    
	    $child = M('Ccategory')->where(array('ccategory_parent'=>$pid))->select();
	    if($child){
	        echo  json_encode(array('result'=>0,'message'=>$child));
	        exit;
	    }else{
	         echo  json_encode(array('result'=>1,'message'=>'未找到结果'));
	         exit;
	    }
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