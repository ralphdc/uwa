<?php

/**
 *--------------------------------------
 * linkage
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-07
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class LinkageCtrlr extends ManageCtrlr {
	public function list_linkage() {
		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Linkage')->count();
		$p = new APage($rowsNum, $pageSize, Url::U('linkage/list_linkage?page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* linkage list */
		$_LL = M('Linkage')->get_linkageList('', '`linkage_id` ASC', $limit);
		$this->assign('_LL', $_LL);

		$this->display();
	}

	public function choose_linkage() {
		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Linkage')->count();
		$p = new APage($rowsNum, $pageSize, Url::U('linkage/choose_linkage?page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* linkage list */
		$_LL = M('Linkage')->get_linkageList('', '`linkage_id` ASC', $limit);
		$this->assign('_LL', $_LL);

		$this->display();
	}

	public function add_linkage() {
		$this->display();
	}
	public function add_linkage_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('Linkage')->add_linkage($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_LINKAGE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('linkage/list_linkage'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_LINKAGE') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('linkage/list_linkage'));
	}

	public function edit_linkage() {
		$linkageId = ARequest::get('linkage_id');

		$_LI = M('Linkage')->get_linkageInfo($linkageId);
		if(empty($_LI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage/list_linkage'));
		}
		$this->assign('_LI', $_LI);

		$this->display();
	}
	public function edit_linkage_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('Linkage')->edit_linkage($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE') . ': ID[' . $data['linkage_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('linkage/list_linkage'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE') . ': ID[' . $data['linkage_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('linkage/list_linkage'));
	}

	public function delete_linkage_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$linkageId = ARequest::get('linkage_id');
		$linkageId = is_array($linkageId) ? $linkageId : explode(',', $linkageId);
		$_L_ID = implode(', ', $linkageId);

		foreach($linkageId as $linkageId) {
			$result = M('Linkage')->delete_linkage($linkageId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_LINKAGE') . ': ID[' . $linkageId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('linkage/list_linkage'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_LINKAGE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('linkage/list_linkage'));
	}

	public function update_cache_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$linkageId = ARequest::get('linkage_id');
		$linkageId = is_array($linkageId) ? $linkageId : explode(',', $linkageId);
		$_L_ID = implode(', ', $linkageId);

		$lAlias = ARequest::get('l_alias');
		$lAlias = is_array($lAlias) ? $lAlias : explode(',', $lAlias);

		foreach($linkageId as $k => $linkageId) {
			$result = M('Linkage')->update_cache($lAlias[$k]);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('UPDATE_LINKAGE_CACHE') . ': ALIAS[' . $lAlias[$k] . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('linkage/list_linkage'));
			}
		}

		foreach($linkageId as $linkageId) {
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('UPDATE_LINKAGE_CACHE') . ': ID[' . $_L_ID . ']');
		$this->success(L('UPDATE_SUCCESS'), Url::U('linkage/list_linkage'));
	}
}

?>