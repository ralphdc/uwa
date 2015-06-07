<?php

/**
 *--------------------------------------
 * archvie
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-4
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveCtrlr extends ManageCtrlr {
	public function list_archive() {
		/* archive model list */
		$_AML = M('ArchiveModel')->get_modelList(true, true);
		$this->assign('_AML', $_AML);

		/* archive flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$archiveChannelId = ARequest::get('archive_channel_id') ? ARequest::get('archive_channel_id') : 0;
		if(0 < $archiveChannelId) {
			/* check permission */
			$_t_AI = M('Admin')->get_adminInfo(ASession::get('admin_id'));
			$myChannel = $_t_AI['a_ac_id'];
			if(!in_array('_all', $myChannel) && !in_array($archiveChannelId, $myChannel)) {
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive'));
			}
			$archiveModelId = M('ArchiveChannel')->field('archive_model_id')->find($archiveChannelId);
			$archiveModelId = $archiveModelId['archive_model_id'];
		}
		else {
			$archiveModelId = ARequest::get('archive_model_id') ? ARequest::get('archive_model_id') : 0;
		}

		$_AMI = '';
		if(0 < $archiveModelId) {
			$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
			$this->assign('_AMI', $_AMI);
		}

		/* all channel list of model */
		$_ACL = M('ArchiveChannel')->get_myChannelList($archiveModelId);
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n", ARequest::get('archive_channel_id'), "<option value='\$archive_channel_id' selected='selected'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$where = array();
		/* filter channel */
		if(!empty($_ACL)) {
			$_t_acid = $act->get_leafid($archiveChannelId);
		}
		$where['__ARCHIVE__.archive_channel_id'] = array('IN', $_t_acid);

		/* filter flag */
		$afAlias = ARequest::get('af_alias') ? ARequest::get('af_alias') : '';
		if(!empty($afAlias)) {
			$where['__ARCHIVE__.af_alias'] = array('INSET', $afAlias);
		}

		/* filter status */
		$aStatus = ARequest::get('a_status') ? ARequest::get('a_status') : '';
		if('n' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 0);
		}
		elseif('p' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		}
		elseif('r' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 2);
		}

		/* filter title */
		$aTitle = ARequest::get('a_title');
		if(!empty($aTitle)) {
			$where['__ARCHIVE__.a_title'] = array('LIKE', '%' . $aTitle . '%');
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['__ARCHIVE__.member_id'] = array('EQ', $memberId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'archive_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Archive')->get_archiveCount($where, $archiveModelId);
		$p = new APage($rowsNum, $pageSize, Url::U('archive/list_archive?archive_model_id=' . $archiveModelId . '&archive_channel_id=' . $archiveChannelId . '&a_status=' . $aStatus . '&a_title=' . $aTitle . '&member_id=' . $memberId . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $archiveModelId);
		$this->assign('_AL', $_AL);

		if(!empty($_AMI)) {
			$this->display('admin/' . $_AMI['am_tpl_list']);
		}
		else {
			$this->display();
		}
	}

	public function choose_archive() {
		/* archive model list */
		$_AML = M('ArchiveModel')->get_modelList(true, true);
		$this->assign('_AML', $_AML);

		/* archive flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$archiveChannelId = ARequest::get('archive_channel_id') ? ARequest::get('archive_channel_id') : 0;
		if(0 < $archiveChannelId) {
			/* check permission */
			$_t_AI = M('Admin')->get_adminInfo(ASession::get('admin_id'));
			$myChannel = $_t_AI['a_ac_id'];
			if(!in_array('_all', $myChannel) && !in_array($archiveChannelId, $myChannel)) {
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive'));
			}
			$archiveModelId = M('ArchiveChannel')->field('archive_model_id')->find($archiveChannelId);
			$archiveModelId = $archiveModelId['archive_model_id'];
		}
		else {
			$archiveModelId = ARequest::get('archive_model_id') ? ARequest::get('archive_model_id') : 0;
		}

		$_AMI = '';
		if(0 < $archiveModelId) {
			$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
			$this->assign('_AMI', $_AMI);
		}

		/* all channel list of model */
		$_ACL = M('ArchiveChannel')->get_myChannelList($archiveModelId);
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n", ARequest::get('archive_channel_id'), "<option value='\$archive_channel_id' selected='selected'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$where = array();
		/* filter channel */
		if(!empty($_ACL)) {
			$_t_acid = $act->get_leafid($archiveChannelId);
		}
		$where['__ARCHIVE__.archive_channel_id'] = array('IN', $_t_acid);

		/* filter flag */
		$afAlias = ARequest::get('af_alias') ? ARequest::get('af_alias') : '';
		if(!empty($afAlias)) {
			$where['__ARCHIVE__.af_alias'] = array('INSET', $afAlias);
		}

		/* filter status */
		$aStatus = ARequest::get('a_status') ? ARequest::get('a_status') : '';
		if('n' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 0);
		}
		elseif('p' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		}
		elseif('r' == $aStatus) {
			$where['__ARCHIVE__.a_status'] = array('EQ', 2);
		}

		/* filter title */
		$aTitle = ARequest::get('a_title');
		if(!empty($aTitle)) {
			$where['__ARCHIVE__.a_title'] = array('LIKE', '%' . $aTitle . '%');
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['__ARCHIVE__.member_id'] = array('EQ', $memberId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'archive_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('archive/choose_archive?archive_model_id=' . $archiveModelId . '&archive_channel_id=' . $archiveChannelId . '&a_status=' . $aStatus . '&a_title=' . $aTitle . '&member_id=' . $memberId . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $archiveModelId, true);
		$this->assign('_AL', $_AL);

		$this->display();
	}

	/* add archive */
	public function add_archive() {
		$archiveModelId = ARequest::get('archive_model_id');
		$archiveChannelId = ARequest::get('archive_channel_id');

		if(!$archiveModelId) {
			$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
			$archiveModelId = $_ACI['archive_model_id'];
		}

		$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
		if(empty($_AMI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive/list_archive'));
		}
		if(0 == $_AMI['am_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('archive/list_archive'));
		}
		$_AMI['archive_channel_id'] = $archiveChannelId;
		$this->assign('_AI', $_AMI);

		$_FI = '';
		load('field#func');
		foreach($_AMI['am_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$this->display('admin/' . $_AMI['am_tpl_add']);
	}
	public function add_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('ArchiveChannel')->check_permission($data['archive_channel_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE') . ': ' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive'));
		}

		$data['af_alias'] = (!empty($data['af_alias']) ? implode(',', $data['af_alias']) : '');
		$data['a_add_time'] = time();
		$data['a_edit_time'] = !empty($data['a_edit_time']) ? strtotime($data['a_edit_time']) : time();
		$data['a_add_ip'] = AServer::get_ip();
		$data['a_edit_ip'] = $data['a_add_ip'];
		$data['member_id'] = ASession::get('member_id');
		$data['m_username'] = ASession::get('m_username');

		/* get thumb */
		if(isset($data['first_img_as_thumb']) and !empty($data['first_img_as_thumb'])) {
			$field = $data['first_img_as_thumb'][0];
			$data['a_thumb'] = M('Upload')->get_thumb($data[$field], $data['am_alias']);
		}

		/* get abstract */
		if(isset($data['get_abstract']) and !empty($data['get_abstract'])) {
			$field = $data['get_abstract'][0];
			$data['a_description'] = AFilter::plain_text(str_replace('<p>#uwa_paging#</p>', '', $data[$field]), 200);
		}

		/* deal with remote source */
		if(isset($data['save_remote_source']) and !empty($data['save_remote_source'])) {
			foreach($data['save_remote_source'] as $field) {
				$waterMark = false;
				if(isset($data['watermark_remote_img']) and in_array($field, $data['watermark_remote_img'])) {
					$waterMark = true;
				}
				$data[$field] = M('Upload')->deal_reomote_file($data[$field], $waterMark, $data['am_alias']);
			}
		}

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

		/* deal with meta */
		$data['a_title'] = AFilter::text(AFilter::plain_text($data['a_title']));
		$data['a_keywords'] = AFilter::text(AFilter::plain_text($data['a_keywords']));
		$data['a_description'] = AFilter::text($data['a_description']);

		/* insert into main table */
		$result = M('Archive')->add_archive($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
		}

		/* insert into addon table */
		$data['archive_id'] = $result['data'];
		$result = M('Archive')->add_archive_addon($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['archive_id']);

		/* update member experience, point and credit */
		if(1 == $data['a_status']) {
			M('Member')->update_credit($data['member_id'], 'publish');
		}

		/* build */
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('Archive')->build_url($data['archive_id']);
			ARequest::set('archive_id', $data['archive_id']);
			$this->build_html_do();
		}

		/* update TAG */
		$_o_tag = get_extensionOption('tag');
		if($data['a_status'] and $_o_tag['switch'] and $_o_tag['auto_admin'] and !empty($data['a_keywords'])) {
			$keywords = explode(',', $data['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->add_tag_archive($keyword, $data['archive_id']);
				}
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE') . ': ID[' . $data['archive_id'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
	}

	/* edit archive */
	public function edit_archive() {
		$archiveId = ARequest::get('archive_id');
		$_AI = M('Archive')->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive/list_archive'));
		}
		if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive'));
		}
		$this->assign('_AI', $_AI);

		$_FI = '';
		load('field#func');
		foreach($_AI['am_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_AI));
				$_FI .= $this->te->fetch('admin/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* archive flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);
        echo $_AI['am_tpl_edit'];
		$this->display('admin/' . $_AI['am_tpl_edit']);
	}
	public function edit_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['member_id']);
		unset($data['m_username']);

		$_AI = M('Archive')->field('archive_channel_id,member_id,a_status,a_keywords')->where(array('archive_id' => array('EQ', ARequest::get('archive_id'))))->find();
		if(empty($_AI)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $data['archive_id'] . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive/list_archive'));
		}
		if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id']) or !M('ArchiveChannel')->check_permission($data['archive_channel_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $data['archive_id'] . ']' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive/list_archive'));
		}

		/* delete old tag */
		$_o_tag = get_extensionOption('tag');
		if($_o_tag['switch'] and !empty($_AI['a_keywords'])) {
			$keywords = explode(',', $_AI['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->delete_tag_archive($keyword, ARequest::get('archive_id'));
				}
			}
		}

		$data['member_id'] = $_AI['member_id'];
		$data['af_alias'] = (!empty($data['af_alias']) ? implode(',', $data['af_alias']) : '');
		if(isset($data['not_upodate_edit_time']) and 'n' == strtolower($data['not_upodate_edit_time'])) {
			unset($data['a_edit_time']);
		}
		else {
			$data['a_edit_time'] = !empty($data['a_edit_time']) ? strtotime($data['a_edit_time']) : time();
		}
		$data['a_edit_ip'] = AServer::get_ip();

		/* get thumbnail */
		if(isset($data['first_img_as_thumb']) and !empty($data['first_img_as_thumb'])) {
			$field = $data['first_img_as_thumb'][0];
			$data['a_thumb'] = M('Upload')->get_thumb($data[$field], $data['am_alias']);
		}

		/* get abstract */
		if(isset($data['get_abstract']) and !empty($data['get_abstract'])) {
			$field = $data['get_abstract'][0];
			$data['a_description'] = AFilter::plain_text(str_replace('<p>#uwa_paging#</p>', '', $data[$field]), 200);
		}

		/* deal with remote source */
		if(isset($data['save_remote_source']) and !empty($data['save_remote_source'])) {
			foreach($data['save_remote_source'] as $field) {
				$waterMark = false;
				if(isset($data['watermark_remote_img']) and in_array($field, $data['watermark_remote_img'])) {
					$waterMark = true;
				}
				$data[$field] = M('Upload')->deal_reomote_file($data[$field], $waterMark, $data['am_alias']);
			}
		}

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

		/* deal with meta */
		$data['a_title'] = AFilter::text(AFilter::plain_text($data['a_title']));
		$data['a_keywords'] = AFilter::text(AFilter::plain_text($data['a_keywords']));
		$data['a_description'] = AFilter::text($data['a_description']);

		/* edit main table data */
		$result = M('Archive')->edit_archive($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $data['archive_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
		}

		/* edit addon table data */
		$result = M('Archive')->edit_archive_addon($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $data['archive_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
		}

		/* update upload */
		M('Upload')->update_upload($data['archive_id'], $data['member_id']);

		/* update member experience, point and credit */
		if(1 == $data['a_status'] and 1 != $_AI['a_status']) {
			M('Member')->update_credit($_AI['member_id'], 'publish');
		}
		elseif(1 != $data['a_status'] and 1 == $_AI['a_status']) {
			M('Member')->update_credit($_AI['member_id'], 'publish', false);
		}

		/* send notify */
		if($_AI['a_status'] != $data['a_status'] and isset($data['send_notify']) and 'y' == strtolower($data['send_notify'])) {
			switch($data['a_status']) {
				case 0:
					$_t_status = L('NOT_PASSED');
					break;
				case 1:
					$_t_status = L('PASSED');
					break;
				case 2:
					$_t_status = L('REFUNDED');
					break;
				default:
					$_t_status = '';
					break;
			}
			$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $data['archive_id']) . '" target="_blank">' . $data['a_title'] . '</a>] ' . $_t_status;
			M('MemberNotify')->send_notify($data['member_id'], L('ARCHIVE_STATUS_IS_CHANGED'), $mnContent);
		}

		/* build now */
		if(isset($data['build_now']) and 1 == $data['build_now']) {
			M('Archive')->build_url($data['archive_id']);
			ARequest::set('archive_id', $data['archive_id']);
			$this->build_html_do();
		}

		/* update tag */
		$_o_tag = get_extensionOption('tag');
		if($data['a_status'] and $_o_tag['switch'] and $_o_tag['auto_admin'] and !empty($data['a_keywords'])) {
			$keywords = explode(',', $data['a_keywords']);
			foreach($keywords as $keyword) {
				$keyword = trim($keyword);
				if(!empty($keyword)) {
					M('Tag')->add_tag_archive($keyword, $data['archive_id']);
				}
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $data['archive_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive/list_archive?archive_channel_id=' . $data['archive_channel_id']));
	}

	/* delete archive */
	public function delete_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$archiveId = is_array($archiveId) ? $archiveId : explode(',', $archiveId);
		$_L_ID = implode(', ', $archiveId);

		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_status,a_title,a_keywords')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				continue;
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$result = M('Archive')->delete_archive($archiveId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* update member experience, point and credit */
			if(1 == $_AI['a_status']) {
				M('Member')->update_credit($_AI['member_id'], 'publish', false);
			}

			/* send notify */
			if('y' == strtolower(ARequest::get('send_notify'))) {
				M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_IS_DELETED'), L('ARCHIVE') . '[' . $_AI['a_title'] . ']');
			}

			/* delete tag */
			$_o_tag = get_extensionOption('tag');
			if($_o_tag['switch'] and !empty($_AI['a_keywords'])) {
				$keywords = explode(',', $_AI['a_keywords']);
				foreach($keywords as $keyword) {
					$keyword = trim($keyword);
					if(!empty($keyword)) {
						M('Tag')->delete_tag_archive($keyword, $archiveId);
					}
				}
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), AServer::get_preUrl());
	}

	/* pass archive */
	public function pass_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$archiveId = is_array($archiveId) ? $archiveId : explode(',', $archiveId);
		$_L_ID = implode(', ', $archiveId);

		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_status,a_title,a_keywords')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				continue;
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$result = M('Archive')->pass_archive($archiveId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* update member experience, point, credit, tag */
			if(1 != $_AI['a_status']) {
				M('Member')->update_credit($_AI['member_id'], 'publish');

				/* send notify */
				if('y' == strtolower(ARequest::get('send_notify'))) {
					$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $archiveId) . '" target="_blank">' . $_AI['a_title'] . '</a>] ' . L('PASSED');
					M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_STATUS_IS_CHANGED'), $mnContent);
				}

				/* update tag */
				$_o_tag = get_extensionOption('tag');
				if($_o_tag['switch'] and $_o_tag['auto_admin'] and !empty($_AI['a_keywords'])) {
					$keywords = explode(',', $_AI['a_keywords']);
					foreach($keywords as $keyword) {
						$keyword = trim($keyword);
						if(!empty($keyword)) {
							M('Tag')->add_tag_archive($keyword, $archiveId);
						}
					}
				}
			}

		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE') . ': ID[' . $_L_ID . ']');
		$this->success(L('PASS_SUCCESS'), AServer::get_preUrl());
	}

	/* refund archive */
	public function refund_archive_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$archiveId = is_array($archiveId) ? $archiveId : explode(',', $archiveId);
		$_L_ID = implode(', ', $archiveId);

		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_status,a_title,a_keywords')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				continue;
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('REFUND_ARCHIVE') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$result = M('Archive')->refund_archive($archiveId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('REFUND_ARCHIVE') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* update member experience, point and credit */
			if(1 == $_AI['a_status']) {
				M('Member')->update_credit($_AI['member_id'], 'publish', false);

				/* send notify */
				if('y' == strtolower(ARequest::get('send_notify'))) {
					$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $archiveId) . '" target="_blank">' . $_AI['a_title'] . '</a>] ' . L('REFUNDED');
					M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_STATUS_IS_CHANGED'), $mnContent);
				}
			}

			/* delete tag */
			$_o_tag = get_extensionOption('tag');
			if($_o_tag['switch'] and !empty($_AI['a_keywords'])) {
				$keywords = explode(',', $_AI['a_keywords']);
				foreach($keywords as $keyword) {
					$keyword = trim($keyword);
					if(!empty($keyword)) {
						M('Tag')->delete_tag_archive($keyword, $archiveId);
					}
				}
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('REFUND_ARCHIVE') . ': ID[' . $_L_ID . ']');
		$this->success(L('REFUND_SUCCESS'), AServer::get_preUrl());
	}

	/* change channel */
	public function change_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$archiveChannelId = ARequest::get('archive_channel_id');
		$_L_ID = is_array($archiveId) ? implode(', ', $archiveId) : $archiveId;

		if(empty($archiveChannelId) or empty($archiveId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $archiveId . ']' . L('PARAMS_ERROR'), 0);
			$this->error(L('PARAMS_ERROR'), AServer::get_preUrl());
		}

		$archiveId = explode(',', $archiveId);
		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_title')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $archiveId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'] . ',' . $data['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$data['archive_channel_id'] = $archiveChannelId;
			$data['archive_id'] = $archiveId;
			$result = M('Archive')->edit_archive($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* send notify */
			if('y' == strtolower(ARequest::get('send_notify'))) {
				$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $archiveId) . '" target="_blank">' . $_AI['a_title'] . '</a>] ' . L('MOVED');
				M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_CHANNEL_IS_CHANGED'), $mnContent);
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), AServer::get_preUrl());
	}

	/* add flag */
	public function add_flag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$afALias = ARequest::get('af_alias');
		$_L_ID = is_array($archiveId) ? implode(', ', $archiveId) : $archiveId;

		if(empty($afALias) or empty($archiveId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('PARAMS_ERROR'), 0);
			$this->error(L('PARAMS_ERROR'), AServer::get_preUrl());
		}

		$archiveId = explode(',', $archiveId);
		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_title')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$result = M('Archive')->add_flag($archiveId, $afALias);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* send notify */
			if('y' == strtolower(ARequest::get('send_notify'))) {
				$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $archiveId) . '" target="_blank">' . $_AI['a_title'] . '</a>] ' . L('ADD_FLAG') . '[' . $afALias . ']';
				M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_FLAG_IS_CHANGED'), $mnContent);
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_FLAG') . ': ID[' . $_L_ID . ']');
		$this->success(L('ADD_FLAG_SUCCESS'), AServer::get_preUrl());
	}

	/* delete flag */
	public function delete_flag_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId = ARequest::get('archive_id');
		$afALias = ARequest::get('af_alias');
		$_L_ID = is_array($archiveId) ? implode(', ', $archiveId) : $archiveId;

		if(empty($afALias) or empty($archiveId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('PARAMS_ERROR'), 0);
			$this->error(L('PARAMS_ERROR'), AServer::get_preUrl());
		}

		$archiveId = explode(',', $archiveId);
		foreach($archiveId as $archiveId) {
			$_AI = M('Archive')->field('archive_channel_id,member_id,a_title')->where(array('archive_id' => array('EQ', $archiveId)))->find();
			if(empty($_AI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
			}
			if(!M('ArchiveChannel')->check_permission($_AI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}

			$result = M('Archive')->delete_flag($archiveId, $afALias);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': ID[' . $archiveId . ']' . $result['error'], 0);
				$this->error($result['error'], AServer::get_preUrl());
			}

			/* send notify */
			if('y' == strtolower(ARequest::get('send_notify'))) {
				$mnContent = L('ARCHIVE') . '[<a href="' . Url::U('home@archive/show_archive?archive_id=' . $archiveId) . '" target="_blank">' . $_AI['a_title'] . '</a>] ' . L('DELETE_FLAG') . '[' . $afALias . ']';
				M('MemberNotify')->send_notify($_AI['member_id'], L('ARCHIVE_FLAG_IS_CHANGED'), $mnContent);
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_FLAG') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_FLAG_SUCCESS'), AServer::get_preUrl());
	}

	public function build_html_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveId = ARequest::get('archive_id');
		$_AI = M('Archive')->get_archiveInfo($archiveId, true);
		if(empty($_AI) or 0 == $_AI['ac_is_html'] or !in_array(0, $_AI['ac_view_ml_ids']) or !$_AI['a_is_html'] or 1 != $_AI['a_status'] or 0 != $_AI['a_cost_points']) {
			return;
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

		$this->assign('AC_ID', $_AI['archive_channel_id']);
		$this->assign('A_ID', $_AI['archive_id']);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $_AI['archive_channel_id']);

		$_ACI = M('ArchiveChannel')->get_channelInfo($_AI['archive_channel_id']);
		$_AI['ac_sibling'] = $_ACI['ac_sibling'];

		$_ACI['ac_position'][] = array('name' => $_AI['a_title'], 'url' => '');
		$this->assign('_CP', $_ACI['ac_position']);

		$this->assign('TASK', 'build_html_archive&archive_id=' . $archiveId);

		/* get html directory */
		$_dir = '';
		if(0 == $_AI['a_html_path']) {
			$_dir = '/' . trim(str_replace('{uwa_path}', '', $_AI['ac_html_dir']), '/');
		}

		vendor('Pinyin#class');
		$pyc = get_instance('Pinyin');

		/* get html filename */
		if(!empty($_AI['a_html_naming'])) {
			$naming = $_AI['a_html_naming'];
		}
		else {
			$naming = $_AI['ac_html_naming_archive'];
		}
		$naming = str_replace(array(
			'{ac_py}',
			'{ac_id}',
			'{Y}',
			'{M}',
			'{D}',
			'{a_py}',
			'{a_id}'), array(
			$pyc->get_pinyin($_AI['ac_name'], 'utf-8'),
			$_AI['archive_channel_id'],
			date('Y', $_AI['a_add_time']),
			date('m', $_AI['a_add_time']),
			date('d', $_AI['a_add_time']),
			$pyc->get_pinyin($_AI['a_title'], 'utf-8'),
			$_AI['archive_id']), $naming);
		$file = $_dir . '/' . trim($naming, '/');

		/* get template */
		if(!empty($_AI['a_tpl'])) {
			$tpl = 'home/' . $_AI['a_tpl'];
		}
		else {
			$tpl = 'home/' . $_AI['ac_tpl_archive'];
		}

		/* deal paging field */
		foreach($_ACI['am_field'] as $field => $params) {
			if(isset($params['f_is_paging']) and (1 == $params['f_is_paging'])) {
				$pagingField = $field;
				break;
			}
		}
		if(isset($pagingField) and false !== strpos($_AI[$pagingField], '<p>#uwa_paging#</p>')) {
			$_title = $_AI['a_title'];
			$_content = explode('<p>#uwa_paging#</p>', $_AI[$pagingField]);

			$rowsNum = count($_content);
			/* build paging */
			foreach($_content as $key => $_c) {
				$_GET[C('VAR.PAGE')] = $key + 1;
				$p = new APage($rowsNum, 1, __APP__ . trim($file ,'/') . '-_page_' . C('HTML.FILE_SUFFIX'));
				$this->assign('PAGING', $p->get_paging());
				$_AI[$pagingField] = $_content[ARequest::get(C('VAR.PAGE')) - 1];
				$_AI['a_title'] = $_title . '(' . ARequest::get(C('VAR.PAGE')) . ')';
				$this->assign('_V', $_AI);

				$_C = require (CFG_PATH . D_S . 'comm.php');
				$this->te->tplTheme = $_C['TE']['TPL_THEME'];
				$this->build_html($file . '-' . ARequest::get(C('VAR.PAGE')) . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
				/* build default page */
				if(1 == ARequest::get(C('VAR.PAGE'))) {
					$this->build_html($file . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
				}
				$this->te->tplTheme = 'default';
			}
		}
		else {
			$this->assign('PAGING', '');

			$this->assign('_V', $_AI);

			$_C = require (CFG_PATH . D_S . 'comm.php');
			$this->te->tplTheme = $_C['TE']['TPL_THEME'];
			$this->build_html($file . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
			$this->te->tplTheme = 'default';
		}

		if(true != ARequest::get('log_off')) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_ARCHIVE_HTML') . ': ID[' . $archiveId . ']');
		}
	}
}

?>