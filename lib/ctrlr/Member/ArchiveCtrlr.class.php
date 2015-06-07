<?php

/**
 *--------------------------------------
 * member archive
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveCtrlr extends MemberCtrlr {
	public function list_archive() {
		$where = array();
		$where['__ARCHIVE__.member_id'] = array('EQ', ASession::get('member_id'));

		/* get archive model information */
		$archiveModelId = intval(ARequest::get('archive_model_id'));
		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI) or !$_AMI['am_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}
		$this->assign('_AMI', $_AMI);

		$this->assign('_GCAP', 'member@archive/list_archive?archive_model_id=' . $archiveModelId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => $_AMI['am_name'] . ' ' . L('LIST'), 'url' => ''))
		);

		/* filter channel */
		$_ACL = M('ArchiveChannel')->get_memberChannelList($archiveModelId, ASession::get('member_level_id'));
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_aclId = implode(',', $act->get_leafid());
		$where['__ARCHIVE__.archive_channel_id'] = array('IN', $_aclId);

		/* filter status */
		$aStatus = in_array(ARequest::get('a_status'), array(
			'n',
			'p',
			'r')) ? ARequest::get('a_status') : '';
		if('n' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 0);
		}
		elseif('p' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		}
		elseif('r' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 2);
		}

		$order = "`a_edit_time` DESC";

		/* get paging */
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('archive/list_archive?archive_model_id=' . $archiveModelId . '&a_status=' . $aStatus . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $archiveModelId, true);
		$this->assign('_AL', $_AL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/' . $_AMI['am_tpl_list_member']);
		}
		else {
			$this->display('member/' . $_AMI['am_tpl_list_member']);
		}
	}

	public function choose_archive() {
		$this->assign('_GCAP', 'member@archive/choose_archive');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('CHOOSE_ARCHIVE'), 'url' => ''))
		);

		$where = array();
		$where['__ARCHIVE__.member_id'] = array('EQ', ASession::get('member_id'));

		/* filter channel */
		$_ACL = M('ArchiveChannel')->get_memberChannelList(0, ASession::get('member_level_id'));
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_aclId = implode(',', $act->get_leafid());
		$where['__ARCHIVE__.archive_channel_id'] = array('IN', $_aclId);

		/* filter status */
		$where['__ARCHIVE__.a_status'] = array('EQ', 1);

		$order = "`a_edit_time` DESC";

		/* get paging */
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('archive/choose_archive?a_status=' . $aStatus . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $archiveModelId, true);
		$this->assign('_AL', $_AL);

		$this->display();
	}

	public function add_archive() {
		/* get model information */
		$archiveModelId = intval(ARequest::get('archive_model_id'));
		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI) or !$_AMI['am_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/index'));
		}
		$this->assign('_AI', $_AMI);

		$this->assign('_GCAP', 'member@archive/list_archive?archive_model_id=' . $archiveModelId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('PUBLISH') . ' ' . $_AMI['am_name'], 'url' => ''))
		);

		$_FI = '';
		load('field#func');
		foreach($_AMI['am_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
				$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption(ASession::get('member_level_id'), ASession::get('member_id'));
		$this->assign('_OU', $_OU);

		$this->display('member/' . $_AMI['am_tpl_add_member']);
	}
	public function add_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$data = array();
		$data['archive_channel_id'] = intval(ARequest::get('archive_channel_id'));
		/* check permission */
		$_aclId = explode(',', M('ArchiveChannel')->get_memberChannelList(0, ASession::get('member_level_id'), true));
		if(!in_array($data['archive_channel_id'], $_aclId)) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('member/index'));
		}

		/* upload thumb */
		if(M('Option')->get_option('upload/switch') and '' != $_FILES['a_thumb_uploader']['name']) {
			$_t_ai = M('ArchiveChannel')->get_channelInfo($data['archive_channel_id']);
			$result = M('Upload')->upload_file('a_thumb_uploader', $_t_ai['am_alias'], 'image', 'yes', false, 'normal', false, array('member_level_id' => ASession::get('member_level_id'), 'member_id' => ASession::get('member_id')));
			if(empty($result['error'])) {
				$data['a_thumb'] = $result['data'];
			}
		}
		else if(AFilter::text(ARequest::get('a_thumb'), 255)) {
			$data['a_thumb'] = AFilter::text(ARequest::get('a_thumb'), 255);
		}

		$data['member_id'] = ASession::get('member_id');
		$data['m_username'] = ASession::get('m_username');
		$data['a_title'] = AFilter::text(AFilter::plain_text(ARequest::get('a_title'), 85));
		$data['a_keywords'] = AFilter::text(AFilter::plain_text(ARequest::get('a_keywords'), 85));
		$data['a_description'] = AFilter::text(ARequest::get('a_description'), 200);
		$data['a_add_time'] = time();
		$data['a_edit_time'] = $data['a_add_time'];
		$data['a_add_ip'] = AServer::get_ip();
		$data['a_edit_ip'] = $data['a_add_ip'];
		$data['a_cost_points'] = intval(ARequest::get('a_cost_points'));
		$data['a_rank'] = 50;

		$_pass_switch = M('ArchiveChannel')->field('ac_pass_switch')->find($data['archive_channel_id']);
		if(0 == $_pass_switch['ac_pass_switch']) {
			$data['a_status'] = 1;
		}
		else {
			$data['a_status'] = 0;
		}

		$_o = M('Option')->get_option(array('core', 'interaction'));
		$_aci = M('ArchiveChannel')->where(array('archive_channel_id' => array('EQ', $data['archive_channel_id'])))->find();
		if($_o['interaction']['review_switch'] and $_aci['ac_review_switch']) {
			$data['a_review_switch'] = 1;
		}
		else {
			$data['a_review_switch'] = 0;
		}
		if($_o['core']['html_switch'] and 0 != $_aci['ac_is_html']) {
			$data['a_is_html'] = 1;
		}
		else {
			$data['a_is_html'] = 0;
		}

		// non-custom data
		unset($data['a_short_title']);
		unset($data['a_view_count']);
		unset($data['a_review_count']);
		unset($data['a_support_count']);
		unset($data['a_oppose_count']);
		unset($data['a_html_path']);
		unset($data['a_html_naming']);
		unset($data['a_related']);
		unset($data['af_alias']);
		unset($data['a_url']);
		unset($data['a_url_o']);
 
		/* insert to main table */
		$result = M('Archive')->add_archive($data);
		if(!empty($result['error'])) {
			$this->error(L('PUBLISH_FAILED'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
		}

		/* insert to addon table */
		$data['archive_id'] = $result['data'];
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

		$result = M('Archive')->add_archive_addon($data);
		if(!empty($result['error'])) {
			$this->error(L('PUBLISH_FAILED'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['archive_id']);

		/* update member credit */
		if($data['a_status']) {
			M('Member')->update_credit(ASession::get('member_id'), 'publish');
		}

		/* update TAG */
		$_o_tag = get_extensionOption('tag');
		if($data['a_status'] and $_o_tag['switch'] and $_o_tag['auto_member'] and !empty($data['a_keywords'])) {
			$keywords = explode(',', $data['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->add_tag_archive($keyword, $data['archive_id']);
				}
			}
		}

		$this->success(L('PUBLISH_SUCCESS'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
	}

	public function edit_archive() {
		$_AI = M('Archive')->get_archiveInfo(intval(ARequest::get('archive_id')));
		if(empty($_AI) or ASession::get('member_id') != $_AI['member_id']) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member/index'));
		}
		$this->assign('_AI', $_AI);

		$this->assign('_GCAP', 'member@archive/list_archive?archive_model_id=' . $_AI['archive_model_id']);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('EDIT') . ' ' . $_AI['am_name'], 'url' => ''))
		);

		$_FI = '';
		load('field#func');
		foreach($_AI['am_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_AI));
				$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption(ASession::get('member_level_id'), ASession::get('member_id'));
		$this->assign('_OU', $_OU);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/' . $_AI['am_tpl_edit_member']);
		}
		else {
			$this->display('member/' . $_AI['am_tpl_edit_member']);
		}
	}
	public function edit_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$data = array();
		/* check permission */
		$data['archive_id'] = intval(ARequest::get('archive_id'));
		$_AI = M('Archive')->where(array('archive_id' => array('EQ', $data['archive_id']), 'member_id' => array('EQ', ASession::get('member_id'))))->field('archive_channel_id,a_status,a_thumb,a_keywords')->find();
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member/index'));
		}
		$data['archive_channel_id'] = intval(ARequest::get('archive_channel_id'));

		$_ACL = M('ArchiveChannel')->get_memberChannelList(0, ASession::get('member_level_id'));
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_aclId = $act->get_leafid();
		if(!in_array($data['archive_channel_id'], $_aclId)) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
		}

		/* upload thumb */
		if(M('Option')->get_option('upload/switch') and '' != $_FILES['a_thumb_uploader']['name']) {
			$_t_ai = M('ArchiveChannel')->get_channelInfo($data['archive_channel_id']);
			$result = M('Upload')->upload_file('a_thumb_uploader', $_t_ai['am_alias'], 'image', 'yes', false, 'normal', false, array('member_level_id' => ASession::get('member_level_id'), 'member_id' => ASession::get('member_id')));
			if(empty($result['error'])) {
				$data['a_thumb'] = $result['data'];
			}

			/* delete old thumb */
			if(!empty($_AI['a_thumb'])) {
				M('Upload')->where(array('u_src' => array('EQ', $_AI['a_thumb'])))->delete();
				if(__HOST__ == substr($_AI['a_thumb'], 0, strlen(__HOST__))) {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . substr($_AI['a_thumb'], strlen(__HOST__))));
				}
				else {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . $_AI['a_thumb']));
				}
			}
		}
		else if(AFilter::text(ARequest::get('a_thumb'), 255)) {
			$data['a_thumb'] = AFilter::text(ARequest::get('a_thumb'), 255);
		}

		/* delete old tag */
		$_o_tag = get_extensionOption('tag');
		if($_o_tag['switch'] and !empty($_AI['a_keywords'])) {
			$keywords = explode(',', $_AI['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->delete_tag_archive($keyword, $data['archive_id']);
				}
			}
		}

		$data['a_title'] = AFilter::text(AFilter::plain_text(ARequest::get('a_title'), 85));
		$data['a_keywords'] = AFilter::text(AFilter::plain_text(ARequest::get('a_keywords'), 85));
		$data['a_description'] = AFilter::text(ARequest::get('a_description'), 200);
		$data['a_cost_points'] = intval(ARequest::get('a_cost_points'));
		$data['member_id'] = ASession::get('member_id');
		$data['a_edit_time'] = time();
		$data['a_edit_ip'] = AServer::get_ip();

		$_pass_switch = M('ArchiveChannel')->field('ac_pass_switch')->find($data['archive_channel_id']);
		if(0 == $_pass_switch['ac_pass_switch']) {
			$data['a_status'] = 1;
		}
		else {
			$data['a_status'] = 0;
		}

		// non-custom data
		unset($data['a_short_title']);
		unset($data['a_view_count']);
		unset($data['a_review_count']);
		unset($data['a_support_count']);
		unset($data['a_oppose_count']);
		unset($data['a_html_path']);
		unset($data['a_html_naming']);
		unset($data['a_related']);
		unset($data['af_alias']);
		unset($data['a_url']);
		unset($data['a_url_o']);

		/* edit main table data */
		$result = M('Archive')->edit_archive($data);
		if(!empty($result['error'])) {
			$this->error(L('EDIT_FAILED'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
		}

		/* edit addon table data */
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

		$result = M('Archive')->edit_archive_addon($data);
		if(!empty($result['error'])) {
			$this->error(L('EDIT_FAILED'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['archive_id']);

		/* update TAG */
		$_o_tag = get_extensionOption('tag');
		if($data['a_status'] and $_o_tag['switch'] and $_o_tag['auto_member'] and !empty($data['a_keywords'])) {
			$keywords = explode(',', $data['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->add_tag_archive($keyword, $data['archive_id']);
				}
			}
		}

		$this->success(L('EDIT_SUCCESS'), Url::U('archive/list_archive?archive_model_id=' . $data['archive_model_id']));
	}

}

?>