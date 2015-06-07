<?php

/**
 *--------------------------------------
 * vote
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-14
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class VoteCtrlr extends ManageCtrlr {
	public function list_vote() {
		$_VL = M('Vote')->get_voteList(false);
		$this->assign('_VL', $_VL);
		$this->display();
	}

	public function add_vote() {
		$this->display();
	}
	public function add_vote_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Vote')->add_vote($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_VOTE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('vote/list_vote'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_VOTE') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('vote/list_vote'));
	}

	public function edit_vote() {
		$voteId = ARequest::get('vote_id');

		$_VI = M('Vote')->get_voteInfo($voteId);
		if(empty($_VI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('vote/list_vote'));
		}
		$this->assign('_VI', $_VI);

		$this->display();
	}
	public function edit_vote_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Vote')->edit_vote($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_VOTE') . ': ID[' . $data['vote_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('vote/list_vote'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_VOTE') . ': ID[' . $data['vote_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('vote/list_vote'));
	}

	public function toggle_vote_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['vote_id'] = ARequest::get('vote_id');
		$data['v_status'] = ARequest::get('v_status');
		if(false === M('Vote')->update($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('TOGGLE_VOTE_STATUS') . ': ID[' . $data['vote_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('vote/list_vote'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('TOGGLE_VOTE_STATUS') . ': ID[' . $data['vote_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('vote/list_vote'));
	}

	public function delete_vote_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$voteId = ARequest::get('vote_id');
		$voteId = is_array($voteId) ? $voteId : explode(',', $voteId);
		$_L_ID = implode(', ', $voteId);

		foreach($voteId as $voteId) {
			$result = M('Vote')->delete_vote($voteId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_VOTE') . ': ID[' . $voteId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('vote/list_vote'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_VOTE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('vote/list_vote'));
	}

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

		$voteId = ARequest::get('vote_id');
		$_L_ID = is_array($voteId) ? implode(', ', $voteId) : $voteId;
		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_VOTE_JS') . ' ID[' . $_L_ID . ']');

		if(!is_array($voteId)) {
			$voteId = explode(',', $voteId);
		}
		sort($voteId);
		$rowNum = count($voteId);
		foreach($voteId as $key => $voteId) {
			$progress = round(($key + 1) / $rowNum * 100, 1);

			$_VI = M('Vote')->get_voteInfo($voteId);
			if(empty($_VI) or 0 == $_VI['v_status']) {
				M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . L('EMPTY_SKIP'), $progress);
				continue;
			}
			$_VI['v_description'] = str_replace(array("\n", "\r"), '', $_VI['v_description']);
			$this->assign('_VI', $_VI);

			$_C = require (CFG_PATH . D_S . 'comm.php');
			$this->te->tplTheme = $_C['TE']['TPL_THEME'];
			$this->build_html('~vote' . $_VI['vote_id'] . '.js', RUNTIME_PATH . D_S . 'js', 'home/' . $_VI['v_tpl_js']);
			$this->te->tplTheme = 'default';

			M('Build')->show_progress($progress . '% [' . ($key + 1) . '/' . $rowNum . ']: ' . $_VI['v_name'] . ' ' . L('BUILD_COMPLETE'), $progress);
		}

		set_time_limit(30);
		M('Build')->show_direction(Url::U('vote/list_vote'));
	}

	public function clear_vote_record_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$voteId = ARequest::get('vote_id');
		$voteId = is_array($voteId) ? $voteId : explode(',', $voteId);
		$_L_ID = implode(', ', $voteId);

		foreach($voteId as $voteId) {
			$result = M('Vote')->clear_vote_record($voteId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('CLEAR_VOTE_RECORD') . ': ID[' . $voteId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('vote/list_vote'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('CLEAR_VOTE_RECORD') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('vote/list_vote'));
	}
}

?>