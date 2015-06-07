<?php

/**
 *--------------------------------------
 * menu space
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MenuSpaceCtrlr extends ManageCtrlr {
	public function list_space() {
		$_MSL = M('MenuSpace')->get_spaceList();
		$this->assign('_MSL', $_MSL);
		$this->display();
	}

	public function add_space() {
		$this->display();
	}
	public function add_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('MenuSpace')->add_space($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MENU_SPACE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('menu_space/list_space'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MENU_SPACE') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('menu_space/list_space'));
	}

	public function edit_space() {
		$menuSpaceId = ARequest::get('menu_space_id');
		$_MSI = M('MenuSpace')->get_spaceInfo($menuSpaceId);
		if(empty($_MSI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('menu_space/list_space'));
		}
		$this->assign('_MSI', $_MSI);

		$this->display();
	}
	public function edit_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('MenuSpace')->edit_space($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU_SPACE') . ': ID[' . $data['menu_space_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('menu_space/list_space'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU_SPACE') . ': ID[' . $data['menu_space_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('menu_space/list_space'));
	}

	public function update_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$menuSpaceId = ARequest::get('menu_space_id');
		$msAlias = ARequest::get('ms_alias');
		$msName = ARequest::get('ms_name');
		$_L_ID = is_array($menuSpaceId) ? implode(', ', $menuSpaceId) : $menuSpaceId;

		if(!is_array($menuSpaceId) or empty($menuSpaceId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU_SPACE') . ': ID[' . $menuSpaceId . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('menu_space/list_space'));
		}

		$data = array();
		foreach($menuSpaceId as $k => $id) {
			$data['menu_space_id'] = $id;
			$data['ms_alias'] = $msAlias[$k];
			$data['ms_name'] = $msName[$k];
			$result = M('MenuSpace')->edit_space($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU_SPACE') . ': ID[' . $data['menu_space_id'] . ']', 0);
				$this->error(L('EDIT_FAILED'), Url::U('menu_space/list_space'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MENU_SPACE') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('menu_space/list_space'));
	}

	public function delete_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$menuSpaceId = ARequest::get('menu_space_id');
		$menuSpaceId = is_array($menuSpaceId) ? $menuSpaceId : explode(',', $menuSpaceId);
		$_L_ID = implode(', ', $menuSpaceId);

		foreach($menuSpaceId as $menuSpaceId) {
			$result = M('MenuSpace')->delete_space($menuSpaceId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MENU_SPACE') . ': ID[' . $menuSpaceId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('menu_space/list_space'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MENU_SPACE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('menu_space/list_space'));
	}
}

?>