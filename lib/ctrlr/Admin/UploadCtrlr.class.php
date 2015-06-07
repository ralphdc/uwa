<?php

/**
 *--------------------------------------
 * upload
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-2
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class UploadCtrlr extends ManageCtrlr {
	public function __construct() {
		/* set SESSION_ID for uploadify */
		$session_id = ARequest::get(session_name());
		if(!empty($session_id)) {
			session_id($session_id);
		}
		if(!isset($_SESSION)) {
			session_start();
		}

		parent::__construct();
	}

	public function list_upload() {
		$where = array();
		/* filter filename */
		$uFilename = ARequest::get('u_filename');
		if(!empty($uFilename)) {
			$where['u_filename'] = array('LIKE', '%' . $uFilename . '%');
		}

		/* filter file type */
		$uType = ARequest::get('u_type');
		if(!empty($auType)) {
			$where['u_type'] = array('EQ', $uType);
		}

		/* filter item type */
		$uItemType = ARequest::get('u_item_type');
		if(!empty($uItemType)) {
			$where['u_item_type'] = array('EQ', $uItemType);
		}
		/* filter item id */
		if('not_used' == ARequest::get('u_item_id')) {
			$where['u_item_id'] = array('EQ', 0);
		}
		else {
			$uItemId = ARequest::get('u_item_id') ? ARequest::get('u_item_id') : 0;
			if($uItemId > 0) {
				$where['u_item_id'] = array('EQ', $uItemId);
			}
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['member_id'] = array('EQ', $memberId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'upload_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Upload')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('upload/list_upload?member_id=' . $memberId . '&u_filename=' . $uFilename . '&u_type=' . $uType . '&u_item_type=' . $uItemType . '&u_item_id=' . $uItemId . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* upload list */
		$_UL = M('Upload')->get_uploadList($where, $order, $limit);
		$this->assign('_UL', $_UL);

		$this->display();
	}

	public function edit_upload() {
		$uploadId = ARequest::get('upload_id');
		$_UI = M('Upload')->get_uploadInfo($uploadId);
		if(empty($_UI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('upload/list_upload'));
		}
		$this->assign('_UI', $_UI);
		$this->display();
	}
	public function edit_upload_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Upload')->edit_upload($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_UPLOAD') . ': ID[' . $data['upload_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('upload/list_upload'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_UPLOAD') . ': ID[' . $data['upload_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('upload/list_upload'));
	}

	public function delete_upload_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$uploadId = ARequest::get('upload_id');
		$uploadId = is_array($uploadId) ? $uploadId : explode(',', $uploadId);
		$_L_ID = implode(', ', $uploadId);

		foreach($uploadId as $uploadId) {
			$result = M('Upload')->delete_upload($uploadId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_UPLOAD') . ': ID[' . $uploadId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('upload/list_upload'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_UPLOAD') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('upload/list_upload'));
	}

	/* upload file */
	public function upload_file() {
		if(!check_token()) {
			exit(L('DATA_INVALID'));
		}

		/* file field name */
		$field = 'upload';
		/* upload type: archive */
		$uploadType = AFilter::is_word(ARequest::get('upload_type')) ? ARequest::get('upload_type') : 'archive';
		/* file type: image, file, all */
		$typeset = in_array(ARequest::get('typeset'), array(
			'image',
			'file',
			'all')) ? ARequest::get('typeset') : 'image';
		/* thumbnail */
		$thumb = in_array(ARequest::get('thumb'), array(
			'no',
			'yes',
			'both')) ? ARequest::get('thumb') : 'no';
		/* watermark */
		$watermark = ('yes' == ARequest::get('watermark')) ? true : false;
		/* return type: normal, editor */
		$returnType = in_array(ARequest::get('return_type'), array('editor', 'normal')) ? ARequest::get('return_type') : 'normal';
		/* editor func number */
		$fn = intval(ARequest::get('CKEditorFuncNum'));

		/* upload */
		$result = M('Upload')->upload_file($field, $uploadType, $typeset, $thumb, $watermark, $returnType, $fn);
		if(!empty($result['error'])) {
			exit($result['error']);
		}
		exit($result['data']);
	}

}

?>