<?php

/**
 *--------------------------------------
 * TAG
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-28
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagCtrlr extends ManageCtrlr {
	public function edit_option() {
		/* Tag option */
		$this->assign('_O', get_extensionOption('tag'));

		$this->display();
	}
	public function edit_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);

		if(!edit_extensionOption('tag', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TAG_OPTION') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('tag/edit_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TAG_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('tag/edit_option'));
	}

	public function list_tag() {
		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Tag')->count();
		$p = new APage($rowsNum, 20, Url::U('tag/list_tag?' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_TL = M('Tag')->get_tagList('', '`tag_id` DESC', $limit);
		$this->assign('_TL', $_TL);

		$this->display();
	}

	public function add_tag() {
		$this->display();
	}
	public function add_tag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(M('Tag')->tag_exsit($data['t_name'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TAG') . ': [' . $data['t_name'] . ']' . L('EXIST'), 0);
			$this->error(L('TAG') . ': [' . $data['t_name'] . ']' . L('EXIST'), Url::U('tag/list_tag'));
		}

		$data['t_add_time'] = !empty($data['t_add_time']) ? strtotime($data['t_add_time']) : time();
		$data['t_update_time'] = !empty($data['t_update_time']) ? strtotime($data['t_update_time']) : time();

		$result = M('Tag')->add_tag($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TAG') . ': TAG[' . $data['t_name'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('tag/list_tag'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TAG') . ': TAG[' . $data['t_name'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('tag/list_tag'));
	}

	public function edit_tag() {
		$tagId = ARequest::get('tag_id');

		$_TI = M('Tag')->get_tagInfo($tagId);
		if(empty($_TI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('tag/list_tag'));
		}
		$this->assign('_TI', $_TI);

		$this->display();
	}
	public function edit_tag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['t_add_time'] = !empty($data['t_add_time']) ? strtotime($data['t_add_time']) : time();
		$data['t_update_time'] = !empty($data['t_update_time']) ? strtotime($data['t_update_time']) : time();

		$result = M('Tag')->edit_tag($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TAG') . ': TAG[' . $data['t_name'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('tag/list_tag'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TAG') . ': TAG[' . $data['t_name'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('tag/list_tag'));
	}

	public function delete_tag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$tagId = ARequest::get('tag_id');
		$tagId = is_array($tagId) ? $tagId : explode(',', $tagId);
		$_L_ID = implode(', ', $tagId);

		foreach($tagId as $tagId) {
			$result = M('Tag')->delete_tag($tagId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TAG') . ': ID[' . $tagId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('tag/list_tag'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TAG') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('tag/list_tag'));
	}
}

?>