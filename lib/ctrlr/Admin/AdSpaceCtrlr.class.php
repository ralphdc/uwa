<?php

/**
 *--------------------------------------
 * ad space
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdSpaceCtrlr extends ManageCtrlr {
	public function list_space() {
		$_ASL = M('AdSpace')->get_spaceList(false);
		$this->assign('_ASL', $_ASL);
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

		$result = M('AdSpace')->add_space($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_AD_SPACE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('ad_space/list_space'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_AD_SPACE') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('ad_space/list_space'));
	}

	public function edit_space() {
		$adSpaceId = ARequest::get('ad_space_id');
		$_ASI = M('AdSpace')->get_spaceInfo($adSpaceId);
		if(empty($_ASI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('ad_space/list_space'));
		}
		$this->assign('_ASI', $_ASI);

		$this->display();
	}
	public function edit_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('AdSpace')->edit_space($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD_SPACE') . ': ID[' . $data['ad_space_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('ad_space/list_space'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_AD_SPACE') . ': ID[' . $data['ad_space_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('ad_space/list_space'));
	}

	public function delete_space_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$adSpaceId = ARequest::get('ad_space_id');
		$adSpaceId = is_array($adSpaceId) ? $adSpaceId : explode(',', $adSpaceId);
		$_L_ID = implode(', ', $adSpaceId);

		foreach($adSpaceId as $adSpaceId) {
			$result = M('AdSpace')->delete_space($adSpaceId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_AD_SPACE') . ': ID[' . $adSpaceId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('ad_space/list_space'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_AD_SPACE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('ad_space/list_space'));
	}

	public function toggle_space_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['ad_space_id'] = ARequest::get('ad_space_id');
		$data['as_status'] = ARequest::get('as_status');
		if(false === M('AdSpace')->update($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('TOGGLE_AD_SPACE_STATUS') . ': ID[' . $data['ad_space_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('ad_space/list_space'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('TOGGLE_AD_SPACE_STATUS') . ': ID[' . $data['ad_space_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('ad_space/list_space'));
	}

	/* build ad js */
	public function build_js_do() {
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
		$this->display('admin/build/progress');

		$adSpaceId = ARequest::get('ad_space_id');

		$_L_ID = is_array($adSpaceId) ? implode(', ', $adSpaceId) : $adSpaceId;
		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_AD_SPACE_JS') . ' ID[' . $_L_ID . ']');

		if(!is_array($adSpaceId)) {
			$adSpaceId = explode(',', $adSpaceId);
		}
		sort($adSpaceId);
		$rowNum = count($adSpaceId);
		foreach($adSpaceId as $key => $adSpaceId) {
			$progress = round(($key + 1) / $rowNum * 100, 1);

			$_ASI = M('AdSpace')->get_spaceInfo($adSpaceId);
			if(empty($_ASI) or 0 == $_ASI['as_status']) {
				M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . L('EMPTY_SKIP'), $progress);
				continue;
			}
			$_AL = M('Ad')->get_adList($adSpaceId, true);
			if(empty($_AL)) {
				M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . $_ASI['as_name'] . L('EMPTY_SKIP'), $progress);
				continue;
			}
			$_ASI['ad'] = $_AL;

			$this->assign('_ASI', $_ASI);

			$_C = require (CFG_PATH . D_S . 'comm.php');
			$this->te->tplTheme = $_C['TE']['TPL_THEME'];
			$this->build_html('~ad' . $_ASI['ad_space_id'] . '.js', RUNTIME_PATH . D_S . 'js', 'home/clip/ad/js/' . $_ASI['as_type']);
			$this->te->tplTheme = 'default';

			M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . $_ASI['as_name'] . ' ' . L('BUILD_COMPLETE'), $progress);
		}

		set_time_limit(30);
		M('Build')->show_direction(Url::U('ad_space/list_space'));
	}

}

?>