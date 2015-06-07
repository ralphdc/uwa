<?php

/**
 *--------------------------------------
 * memeber upload
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class UploadCtrlr extends MemberCtrlr {
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
		$this->assign('_GCAP', 'member@upload/list_upload');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('UPLOAD'), 'url' => ''))
		);

		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));
		/* filter filename */
		$uFilename = AFilter::keyword(ARequest::get('u_filename'));
		if(MAGIC_QUOTES_GPC) {
			$uFilename = stripslashes($uFilename);
		}
		$uFilename = str_replace('\'', '', $uFilename);
		$uFilename = str_replace('"', '', $uFilename);
		$uFilename = preg_replace('/\s+/', ' ', $uFilename);
		if(!empty($uFilename)) {
			$where['u_filename'] = array('LIKE', '%' . $uFilename . '%');
		}

		/* sort list */
		$orderBy = in_array(ARequest::get('order_by'), array(
			'upload_id',
			'u_filename',
			'u_type',
			'u_size',
			'u_add_time')) ? ARequest::get('order_by') : 'upload_id';
		$orderTurn = in_array(ARequest::get('order_turn'), array('desc', 'asc')) ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('Upload')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('upload/list_upload?u_filename=' . $uFilename . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* upload list */
		$_UL = M('Upload')->get_uploadList($where, $order, $limit);
		$this->assign('_UL', $_UL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/upload/list_upload');
		}
		else {
			$this->display();
		}
	}

	/* upload file */
	public function upload_file() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		/* file field name */
		$field = 'upload';
		/* upload type: archive */
		$uploadType = AFilter::is_word(ARequest::get('upload_type')) ? ARequest::get('upload_type') : 'archive';
		/* filetype: image, file, all */
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

		/* system upload switch */
		$o_upload_switch = M('Option')->get_option('upload/switch');
		if(!$o_upload_switch) {
			if('editor' == $returnType) {
				exit('<script>window.parent.CKEDITOR.tools.callFunction(' . $fn . ', \'\', \'' . L('UPLOAD_IS_OFF') . '\');</script>');
			}
			else {
				exit(L('UPLOAD_IS_OFF'));
			}
		}

		/* upload file */
		$result = M('Upload')->upload_file($field, $uploadType, $typeset, $thumb, $watermark, $returnType, $fn, array('member_level_id' => ASession::get('member_level_id'), 'member_id' => ASession::get('member_id')));
		if(!empty($result['error'])) {
			exit($result['error']);
		}
		exit($result['data']);
	}

}

?>