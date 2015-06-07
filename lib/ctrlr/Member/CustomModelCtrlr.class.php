<?php

/**
 *--------------------------------------
 * custom model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomModelCtrlr extends MemberCtrlr {
	public function list_content() {
		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));

		/* get custom model information */
		$customModelId = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}
		$this->assign('_CMI', $_CMI);

		$this->assign('_GCAP', 'member@custom_model/list_content?custom_model_id=' . $customModelId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => $_CMI['cm_name'] . ' ' . L('LIST'), 'url' => ''))
		);

		/* check permission */
		if(in_array(- 1, $_CMI['cm_view_ml_ids']) or (!in_array(0, $_CMI['cm_view_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_view_ml_ids']))) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		/* filter status */
		$status = in_array(ARequest::get('status'), array(
			'n',
			'p',
			'r')) ? ARequest::get('status') : '';
		if('n' == $status) {
			$where['status'] = array('EQ', 0);
		}
		elseif('p' == $status) {
			$where['status'] = array('EQ', 1);
		}
		elseif('r' == $status) {
			$where['status'] = array('EQ', 2);
		}

		$order = "`id` DESC";

		/* get paging */
		$rowsNum = M(parse_name($_CMI['cm_table'], 1))->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('custom_model/list_content?custom_model_id=' . $customModelId . '&status=' . $status . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$_CMCL = M('CustomModel')->list_content($_CMI, $where, $order, $limit, true);
		$this->assign('_CMCL', $_CMCL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/' . $_CMI['cm_tpl_list_member']);
		}
		else {
			$this->display('member/' . $_CMI['cm_tpl_list_member']);
		}
	}

	public function add_content() {
		/* get model information */
		$customModelId = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}

		/* check permission */
		if(in_array(- 1, $_CMI['cm_add_ml_ids']) or (!in_array(0, $_CMI['cm_add_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_add_ml_ids']))) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		$this->assign('_CMI', $_CMI);

		$this->assign('_GCAP', 'member@custom_model/list_content?custom_model_id=' . $customModelId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('PUBLISH') . ' ' . $_CMI['cm_name'], 'url' => ''))
		);

		$_FI = '';
		load('field#func');
		foreach($_CMI['cm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
				$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption(ASession::get('member_level_id'), ASession::get('member_id'));
		$this->assign('_OU', $_OU);

		$this->display('member/' . $_CMI['cm_tpl_add_member']);
	}
	public function add_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$data = array();
		$data['custom_model_id'] = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($data['custom_model_id']);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}

		/* check permission */
		if(in_array(- 1, $_CMI['cm_add_ml_ids']) or (!in_array(0, $_CMI['cm_add_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_add_ml_ids']))) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		$data['member_id'] = ASession::get('member_id');

		if(0 == $_CMI['cm_pass_switch']) {
			$data['status'] = 1;
		}
		else {
			$data['status'] = 0;
		}

		$data = array_merge(ARequest::get(), $data);

		/* delete external links */
		if(isset($data['delete_external_links']) and !empty($data['delete_external_links'])) {
			foreach($data['delete_external_links'] as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}
		/* insert into model table */
		$result = M('CustomModel')->add_content($data);
		if(!empty($result['error'])) {
			$this->error(L('PUBLISH_FAILED'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($result['data']);

		$this->success(L('PUBLISH_SUCCESS'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
	}

	public function edit_content() {
		$customModelId = intval(ARequest::get('custom_model_id'));
		$id = intval(ARequest::get('id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}

		/* check permission */
		if(in_array(- 1, $_CMI['cm_add_ml_ids']) or (!in_array(0, $_CMI['cm_add_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_add_ml_ids']))) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		$this->assign('_CMI', $_CMI);

		$this->assign('_GCAP', 'member@custom_model/list_content?custom_model_id=' . $customModelId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('EDIT') . ' ' . $_CMI['cm_name'], 'url' => ''))
		);

		$_CMCI = M('CustomModel')->get_contentInfo($customModelId, $id);
		if(empty($_CMCI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_content?custom_model_id=' . $customModelId));
		}
		$this->assign('_CMCI', $_CMCI);

		$_FI = '';
		load('field#func');
		foreach($_CMI['cm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_CMCI));
				$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption(ASession::get('member_level_id'), ASession::get('member_id'));
		$this->assign('_OU', $_OU);

		$this->display('member/' . $_CMI['cm_tpl_edit_member']);
	}
	public function edit_content_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$data = array();
		$data['custom_model_id'] = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($data['custom_model_id']);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}

		/* check permission */
		if(in_array(- 1, $_CMI['cm_add_ml_ids']) or (!in_array(0, $_CMI['cm_add_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_add_ml_ids']))) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		$data['member_id'] = ASession::get('member_id');

		if(0 == $_CMI['cm_pass_switch']) {
			$data['status'] = 1;
		}
		else {
			$data['status'] = 0;
		}

		$data['id'] = intval(ARequest::get('id'));
		$data['member_id'] = ASession::get('member_id');
		$_CMCI = M(parse_name($_CMI['cm_table'], 1))->where(array('id' => array('EQ', $data['id']), 'member_id' => array('EQ', $data['member_id'])))->field('status')->find();
		if(empty($_CMCI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
		}

		/* merge data */
		$data = array_merge(ARequest::get(), $data);

		/* delete external links */
		if(isset($data['delete_external_links']) and !empty($data['delete_external_links'])) {
			foreach($data['delete_external_links'] as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}

		$result = M('CustomModel')->edit_content($data);
		if(!empty($result['error'])) {
			$this->error(L('EDIT_FAILED'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['id']);

		$this->success(L('EDIT_SUCCESS'), Url::U('custom_model/list_content?custom_model_id=' . $data['custom_model_id']));
	}

}

?>