<?php

/**
 *--------------------------------------
 * inlink
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-29
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class InlinkCtrlr extends ManageCtrlr {
	public function edit_option() {
		$this->assign('_O', get_extensionOption('inlink'));

		$this->display();
	}
	public function edit_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);

		if(!edit_extensionOption('inlink', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_INLINK_OPTION') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('inlink/edit_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_INLINK_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('inlink/edit_option'));
	}

	public function list_inlink() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Inlink')->count();
		$p = new APage($rowsNum, 20, Url::U('inlink/list_inlink?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_IL = M('Inlink')->get_inlinkList($limit);
		$this->assign('_IL', $_IL);

		$this->display();
	}

	public function add_inlink() {
		$this->display();
	}
	public function add_inlink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(M('Inlink')->inlink_exsit($data['il_word'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_INLINK') . ': WORD[' . $data['il_word'] . ']' . L('EXIST'), 0);
			$this->error(L('INLINK') . ': [' . $data['il_word'] . ']' . L('EXIST'), Url::U('inlink/list_inlink'));
		}

		$result = M('Inlink')->add_inlink($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_INLINK') . ': WORD[' . $data['il_word'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('inlink/list_inlink'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_INLINK') . ': WORD[' . $data['il_word'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('inlink/list_inlink'));
	}

	public function edit_inlink() {
		$inlinkId = ARequest::get('inlink_id');

		$_II = M('Inlink')->get_inlinkInfo($inlinkId);
		if(empty($_II)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('inlink/list_inlink'));
		}
		$this->assign('_II', $_II);

		$this->display();
	}
	public function edit_inlink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('Inlink')->edit_inlink($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_INLINK') . ': WORD[' . $data['il_word'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('inlink/list_inlink'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_INLINK') . ': WORD[' . $data['il_word'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('inlink/list_inlink'));
	}

	public function delete_inlink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$inlinkId = ARequest::get('inlink_id');
		$inlinkId = is_array($inlinkId) ? $inlinkId : explode(',', $inlinkId);
		$_L_ID = implode(', ', $inlinkId);

		foreach($inlinkId as $inlinkId) {
			$result = M('Inlink')->delete_inlink($inlinkId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_INLINK') . ': ID[' . $inlinkId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('inlink/list_inlink'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_INLINK') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('inlink/list_inlink'));
	}
}

?>