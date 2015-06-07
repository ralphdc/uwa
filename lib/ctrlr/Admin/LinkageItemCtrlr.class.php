<?php

/**
 *--------------------------------------
 * linkage item
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-07
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class LinkageItemCtrlr extends ManageCtrlr {
	public function list_item() {
		/* linkage list */
		$_LL = M('Linkage')->get_linkageList('', '`linkage_id` ASC', 500);
		$this->assign('_LL', $_LL);

		$where = array();

		$liParentId = 0 < ARequest::get('li_parent_id') ? ARequest::get('li_parent_id') : 0;
		$where['__LINKAGE_ITEM__.li_parent_id'] = array('EQ', $liParentId);
		if(0 < $liParentId) {
			$_t_lii = M('LinkageItem')->get_itemInfo($liParentId);
			if(empty($_t_lii)) {
				$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage_item/list_item'));
			}
			else {
				$lAlias = $_t_lii['l_alias'];
				$where['__LINKAGE_ITEM__.l_alias'] = array('EQ', $lAlias);
			}
		}
		else {
			$lAlias = ARequest::get('l_alias') ? ARequest::get('l_alias') : '';
			if(!empty($lAlias)) {
				$where['__LINKAGE_ITEM__.l_alias'] = array('EQ', $lAlias);
			}
		}

		$order = '__LINKAGE_ITEM__.li_display_order ASC';

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('LinkageItem')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('linkage_item/list_item?l_alias=' . $lAlias . '&li_parent_id=' . $liParentId . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* linkage item list */
		$_LIL = M('LinkageItem')->get_itemList($where, $order, $limit);
		$this->assign('_LIL', $_LIL);

		$_V = M('Linkage')->where(array('l_alias' => array('EQ', $lAlias)))->find();
		$_V['li_parent_id'] = $liParentId;
		/* linkage item position */
		$_V['position'] = M('LinkageItem')->get_position($lAlias, $liParentId);
		$this->assign('_V', $_V);

		$this->display();  
	}

	/* add item */
	public function add_item() {
		$_V = array();
		$_V['li_parent_id'] = 0 < ARequest::get('li_parent_id') ? ARequest::get('li_parent_id') : 0;
		if(0 < $_V['li_parent_id']) {
			$_t_lii = M('LinkageItem')->get_itemInfo($_V['li_parent_id']);
			if(empty($_t_lii)) {
				$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage_item/list_item'));
			}
			$_V['l_alias'] = $_t_lii['l_alias'];
			$_V['l_name'] = $_t_lii['l_name'];
		}
		else {
			$lAlias = ARequest::get('l_alias') ? ARequest::get('l_alias') : '';
			$_t_li = M('Linkage')->where(array('l_alias' => array('EQ', $lAlias)))->find();
			if(empty($_t_li)) {
				$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage_item/list_item'));
			}
			$_V['l_alias'] = $_t_li['l_alias'];
			$_V['l_name'] = $_t_li['l_name'];
		}
		$this->assign('_V', $_V);

		$_LIL = M('LinkageItem')->get_itemList("__LINKAGE_ITEM__.l_alias ='" . $_V['l_alias'] . "'");
		$act = new ATree($_LIL, array(
			'linkage_item_id',
			'li_parent_id',
			'li_sub_item'));
		$_LILStr = $act->get_leafStr(0, "<option value='\$linkage_item_id'>\$spacer \$li_name</option>\r\n", $_V['li_parent_id'], "<option value='\$linkage_item_id' selected='selected'>\$spacer \$li_name</option>\r\n");
		$this->assign('_LILStr', $_LILStr);

		$this->display();
	}
	public function add_item_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$_liNameList = trim_array(explode("\n", $data['li_name_list']));

		$_L_ID = array();
		foreach($_liNameList as $liName) {
			if(empty($liName)) {
				continue;
			}
			$data['li_name'] = $liName;

			$result = M('LinkageItem')->add_item($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_LINKAGE_ITEM') . ': ' . $result['error'], 0);
				$this->error($result['error'], Url::U('linkage_item/list_item?l_alias=' . $data['l_alias'] . '&li_parent_id=' . $data['li_parent_id']));
			}

			$_L_ID[] = $result['data'];
		}

		$_L_ID = implode(', ', $_L_ID);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_LINKAGE_ITEM') . ': ID[' . $_L_ID . ']');

		$this->success(L('ADD_SUCCESS'), Url::U('linkage_item/list_item?l_alias=' . $data['l_alias'] . '&li_parent_id=' . $data['li_parent_id']));
	}

	/* eidt item */
	public function edit_item() {
		$linkageItemId = ARequest::get('linkage_item_id');
		$_LII = M('LinkageItem')->get_itemInfo($linkageItemId);
		if(empty($_LII)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage_item/list_item'));
		}
		$this->assign('_LII', $_LII);

		$_LIL = M('LinkageItem')->get_itemList("__LINKAGE_ITEM__.l_alias ='" . $_LII['l_alias'] . "'");
		foreach($_LIL as $k => $v) {
			if($_LII['linkage_item_id'] == $v['linkage_item_id']) {
				unset($_LIL[$k]);
				break;
			}
		}
		$act = new ATree($_LIL, array(
			'linkage_item_id',
			'li_parent_id',
			'li_sub_item'));
		$_LILStr = $act->get_leafStr(0, "<option value='\$linkage_item_id'>\$spacer \$li_name</option>\r\n", $_LII['li_parent_id'], "<option value='\$linkage_item_id' selected='selected'>\$spacer \$li_name</option>\r\n");
		$this->assign('_LILStr', $_LILStr);

		$this->display();
	}
	public function edit_item_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('LinkageItem')->edit_item($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE_ITEM') . ': NAME[' . $data['li_name'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('linkage_item/list_item?li_parent_id=l_alias=' . $data['l_alias'] . '&' . $data['li_parent_id']));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE_ITEM') . ': NAME[' . $data['li_name'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('linkage_item/list_item?li_parent_id=l_alias=' . $data['l_alias'] . '&' . $data['li_parent_id']));
	}

	public function update_item_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$lAlias = 0 < ARequest::get('l_alias') ? ARequest::get('l_alias') : '';
		$liParentId = 0 < ARequest::get('li_parent_id') ? ARequest::get('li_parent_id') : 0;
		$linkageItemId = ARequest::get('linkage_item_id');
		$_L_ID = is_array($linkageItemId) ? implode(', ', $linkageItemId) : $linkageItemId;

		if(empty($linkageItemId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('linkage_item/list_item'));
		}

		$liDisplayOrder = ARequest::get('li_display_order');
		$liName = ARequest::get('li_name');
		$data = array();
		foreach($linkageItemId as $k => $linkageItemId) {
			$data['linkage_item_id'] = $linkageItemId;
			$data['li_display_order'] = $liDisplayOrder[$k];
			$data['li_name'] = $liName[$k];
			$result = M('LinkageItem')->edit_item($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE_ITEM') . ': NAME[' . $data['li_name'] . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('linkage_item/list_item?l_alias=' . $lAlias . '&li_parent_id=' . $liParentId));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_LINKAGE_ITEM') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('linkage_item/list_item?l_alias=' . $lAlias . '&li_parent_id=' . $liParentId));
	}

	public function delete_item_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$lAlias = 0 < ARequest::get('l_alias') ? ARequest::get('l_alias') : '';
		$liParentId = 0 < ARequest::get('li_parent_id') ? ARequest::get('li_parent_id') : 0;
		$linkageItemId = ARequest::get('linkage_item_id');
		$linkageItemId = is_array($linkageItemId) ? $linkageItemId : explode(',', $linkageItemId);
		$_L_ID = implode(', ', $linkageItemId);

		foreach($linkageItemId as $linkageItemId) {
			$result = M('LinkageItem')->delete_item($linkageItemId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_LINKAGE_ITEM') . ': ID[' . $linkageItemId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('linkage_item/list_item?li_parent_id=l_alias=' . $lAlias . '&' . $liParentId));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_LINKAGE_ITEM') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('linkage_item/list_item?li_parent_id=l_alias=' . $lAlias . '&' . $liParentId));
	}
}

?>