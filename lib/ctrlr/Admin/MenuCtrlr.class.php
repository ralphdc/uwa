<?php

/**
 *--------------------------------------
 * menu
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MenuCtrlr extends ManageCtrlr {
	public function list_menu() {
		$_MSL = M('MenuSpace')->get_spaceList();
		if(empty($_MSL)) {
			$this->error(L('ADD_MENU_SPACE_FIRST'), Url::U('menu_space/add_space'));
		}
		$this->assign('_MSL', $_MSL);

		/* menu space lsit */
		$msAlias = ARequest::get('ms_alias') ? ARequest::get('ms_alias') : '';
		$_ML = M('Menu')->get_menuList($msAlias);
		$this->assign('_ML', $_ML);

		$this->display();
	}

	public function add_menu() {
		/* menu space list */
		$_MSL = M('MenuSpace')->get_spaceList();
		if(empty($_MSL)) {
			$this->error(L('ADD_MENU_SPACE_FIRST'), Url::U('menu_space/add_space'));
		}
		$this->assign('_MSL', $_MSL);

		/* home controller list */
		$_CL = get_ctrlrList(LIB_CTRLR_PATH . D_S . 'Home');
		$this->assign('_CL', $_CL);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}
	public function add_menu_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Menu')->add_menu($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MENU') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('menu/list_menu'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MENU') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('menu/list_menu?ms_alias=' . $data['ms_alias']));
	}

	public function edit_menu() {
		$menuId = ARequest::get('menu_id');

		$_MI = M('Menu')->get_menuInfo($menuId);
		if(empty($_MI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('menu/list_menu'));
		}
		$this->assign('_MI', $_MI);

		/* menu space list */
		$_MSL = M('MenuSpace')->get_spaceList();
		if(empty($_MSL)) {
			$this->error(L('ADD_MENU_SPACE_FIRST'), Url::U('menu_space/add_space'));
		}
		$this->assign('_MSL', $_MSL);

		/* menu list */
		$_ML = M('Menu')->get_menuList($_MI['ms_alias']);
		$this->assign('_ML', $_ML);

		/* home controller list */
		$_CL = get_ctrlrList(LIB_CTRLR_PATH . D_S . 'Home');
		$this->assign('_CL', $_CL);

		/* archive channel list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}
	public function edit_menu_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Menu')->edit_menu($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU') . ': ID[' . $data['menu_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('menu/list_menu'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU') . ': ID[' . $data['menu_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('menu/list_menu?ms_alias=' . $data['ms_alias']));
	}

	public function update_menu_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$menuId = ARequest::get('menu_id');
		$_L_ID = is_array($menuId) ? implode(', ', $menuId) : $menuId;

		if(empty($menuId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU') . ': ID[' . $menuId . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('menu/list_menu'));
		}

		$mDisplayOrder = ARequest::get('m_display_order');
		$mName = ARequest::get('m_name');
		$mTip = ARequest::get('m_tip');
		$data = array();
		foreach($menuId as $k => $id) {
			$data['menu_id'] = $id;
			$data['m_display_order'] = $mDisplayOrder[$k];
			$data['m_name'] = $mName[$k];
			$data['m_tip'] = $mTip[$k];
			$result = M('Menu')->edit_menu($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU') . ': ID[' . $data['menu_id'] . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('menu/list_menu'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('menu/list_menu'));
	}

	public function delete_menu_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$menuId = ARequest::get('menu_id');
		$menuId = is_array($menuId) ? $menuId : explode(',', $menuId);
		$_L_ID = implode(', ', $menuId);

		foreach($menuId as $menuId) {
			$result = M('Menu')->delete_menu($menuId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MENU') . ': ID[' . $menuId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('menu/list_menu'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MENU') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('menu/list_menu'));
	}

	/* get action from controller */
	public function get_actnList() {
		$ctrlr = ARequest::get('ctrlr');
		$file = LIB_CTRLR_PATH . D_S . 'Home' . D_S . $ctrlr . 'Ctrlr.class.php';
		$actnList = get_fileActnList($file);
		$this->ajax_return(array('data' => $actnList));
	}

	/* get top menu list form alias */
	public function get_menuList() {
		$msAlias = ARequest::get('ms_alias');
		$_ML = M('Menu')->get_menuList($msAlias);
		$this->ajax_return(array('data' => $_ML));
	}
}

?>