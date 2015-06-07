<?php

/**
 *--------------------------------------
 * ad
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdCtrlr extends ManageCtrlr {
	public function list_ad() {
		$_ASL = M('AdSpace')->get_spaceList();
		if(empty($_ASL)) {
			$this->error(L('ADD_AD_SPACE_FIRST'), Url::U('ad_space/add_space'));
		}
		$this->assign('_ASL', $_ASL);

		/* ad space */
		$adSpaceId = ARequest::get('ad_space_id') ? ARequest::get('ad_space_id') : '';
		$_AL = M('Ad')->get_adList($adSpaceId);
		$this->assign('_AL', $_AL);

		$this->display();
	}

	public function add_ad() {
		$adSpaceId = ARequest::get('ad_space_id');
		$_ASI = M('AdSpace')->get_spaceInfo($adSpaceId);
		if(empty($_ASI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ad_space/list_space'));
		}
		$this->assign('_ASI', $_ASI);

		$this->display();
	}
	public function add_ad_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Ad')->add_ad($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_AD') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('ad/list_ad'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_AD') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('ad/list_ad'));
	}

	public function edit_ad() {
		$adId = ARequest::get('ad_id');

		$_AI = M('Ad')->get_adInfo($adId);
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ad/list_ad'));
		}
		$this->assign('_AI', $_AI);

		$this->display();
	}
	public function edit_ad_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Ad')->edit_ad($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD') . ': ID[' . $data['ad_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('ad/list_ad'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD') . ': ID[' . $data['ad_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('ad/list_ad'));
	}

	public function update_ad_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adId = ARequest::get('ad_id');
		$_L_ID = is_array($adId) ? implode(', ', $adId) : $adId;

		if(empty($adId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD') . ': ' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ad/list_ad'));
		}

		$aDisplayOrder = ARequest::get('a_display_order');
		$data = array();
		foreach($adId as $k => $id) {
			$data['ad_id'] = $id;
			$data['a_display_order'] = $aDisplayOrder[$k];
			$result = M('Ad')->edit_ad($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD') . ': ID[' . $adId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('ad/list_ad'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('ad/list_ad'));
	}

	public function delete_ad_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adId = ARequest::get('ad_id');
		$adId = is_array($adId) ? $adId : explode(',', $adId);
		$_L_ID = implode(', ', $adId);

		foreach($adId as $adId) {
			$result = M('Ad')->delete_ad($adId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_AD') . ': ID[' . $adId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('ad/list_ad'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_AD') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('ad/list_ad'));
	}

}

?>