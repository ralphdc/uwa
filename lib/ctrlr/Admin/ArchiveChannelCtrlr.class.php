<?php

/**
 *--------------------------------------
 * archive channel
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-3
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveChannelCtrlr extends ManageCtrlr {
	public function list_channel() {
		$timeKey = time();
		$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));

		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));

		$strTpl = "<tr s_id='\$archive_channel_id' p_id='\$ac_parent_id'>\r\n";
		$strTpl .= "<td><input name='archive_channel_id[\$archive_channel_id]' type='checkbox' value='\$archive_channel_id'></td>\r\n";
		$strTpl .= "<td><input type='text' class='i required' size='4' maxlength='10' name='ac_display_order[\$archive_channel_id]' value='\$ac_display_order'></td>\r\n";
		$strTpl .= "<td><span class='toggle_tr fc_gry' toggle_tr_id='\$archive_channel_id'>\$spacer </span> <input type='text' class='i required' size='15' maxlength='30' name='ac_name[\$archive_channel_id]' value='\$ac_name'> ID:\$archive_channel_id</td>\r\n";
		$strTpl .= "<td>\$am_name | \$am_alias</td>\r\n";
		$strTpl .= "<td><a href='\".Url::U('home@archive/show_channel?archive_channel_id='.\$archive_channel_id).\"' target='_blank'>" . L('PREVIEW') . "</a> | <a href='\".Url::U('archive/list_archive?archive_channel_id='.\$archive_channel_id).\"'>" . L('CONTENT_LIST') . "</a> | <a href='\".Url::U('archive/add_archive?archive_channel_id='.\$archive_channel_id).\"'>" . L('ADD_CONTENT') . "</a> | <a href='\".Url::U('archive_channel/add_channel?ac_parent_id='.\$archive_channel_id).\"'>" . L('ADD_SUB_CHANNEL') . "</a> | <a href='\".Url::U('archive_channel/add_channel?is_batch=1&ac_parent_id='.\$archive_channel_id).\"'>" . L('ADD_BATCH_OF_SUB_CHANNEL') . "</a> | <a href='\".Url::U('archive_channel/edit_channel?archive_channel_id='.\$archive_channel_id).\"'>" . L('EDIT') . "</a> | <a href='\".Url::U('archive_channel/delete_channel_do?archive_channel_id='.\$archive_channel_id.'&timeKey={$_TK['timeKey']}&token={$_TK['token']}').\"' onclick='javascript:return delete_confirm();' >" . L('DELETE') . "</a></td>\r\n";
		$strTpl .= "</tr>\r\n";

		$_ACLStr = $act->get_leafStr(0, $strTpl);
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}

	/* add channel */
	public function add_channel() {
		$acParentId = ARequest::get('ac_parent_id');

		if(!M('ArchiveChannel')->check_permission($acParentId)) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
		}

		$_AML = M('ArchiveModel')->get_modelList();
		$this->assign('_AML', $_AML);

		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		if(0 < $acParentId) {
			$_ACI = M('ArchiveChannel')->get_channelInfo($acParentId);
		}
		if(empty($_ACI)) {
			$_o = M('Option')->get_option('core');
			$_ACI = array('ac_html_dir' => '{uwa_path}' . trim($_o['html_path'], '/'), 'ac_is_html' => $_o['html_switch']);
		}
		$this->assign('_ACI', $_ACI);

		$_is_batch = ARequest::get('is_batch');
		if(1 == $_is_batch) {
			$this->display('admin/archive_channel/add_batch_channel');
		}
		else {
			$this->display();
		}
	}
	public function add_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('ArchiveChannel')->check_permission($data['ac_parent_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
		}

		switch($data['ac_html_path']) {
			case 1:
				$_t_html_path = $data['ac_parent_dir'];
				break;
			case 2:
				$_t_html_path = '{uwa_path}';
				break;
			case 3:
				$_o = M('Option')->get_option('core');
				$_t_html_path = '{uwa_path}' . trim($_o['html_path'], '/');
				break;
			default:
				$_t_html_path = $data['ac_parent_dir'];
				break;
		}
		unset($data['ac_html_path']);
		unset($data['ac_parent_dir']);
		if((isset($data['pinyin_as_dirname']) and 1 == $data['pinyin_as_dirname']) || empty($data['ac_html_dir'])) {
			vendor('Pinyin#class');
			$pyc = get_instance('Pinyin');
			$data['ac_html_dir'] = $_t_html_path . (('{uwa_path}' != $_t_html_path) ? '/' : '') . strtolower($pyc->get_pinyin($data['ac_name'], 'utf-8'));
			unset($data['pinyin_as_dirname']);
		}
		else {
			$data['ac_html_dir'] = $_t_html_path . (('{uwa_path}' != $_t_html_path) ? '/' : '') . trim($data['ac_html_dir'], '/');
		}

		$result = M('ArchiveChannel')->add_channel($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_channel/list_channel'));
		}
		$archiveChannelId = M('ArchiveChannel')->db->lastInsID;
		M('ArchiveChannel')->build_url($archiveChannelId);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ID[' . $archiveChannelId . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('archive_channel/list_channel'));
	}

	/* add batch channel */
	public function add_batch_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(!M('ArchiveChannel')->check_permission($data['ac_parent_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
		}

		switch($data['ac_html_path']) {
			case 1:
				$_t_html_path = $data['ac_parent_dir'];
				break;
			case 2:
				$_t_html_path = '{uwa_path}';
				break;
			case 3:
				$_o = M('Option')->get_option('core');
				$_t_html_path = '{uwa_path}' . trim($_o['html_path'], '/');
				break;
			default:
				$_t_html_path = $data['ac_parent_dir'];
				break;
		}

		$_acNameList = trim_array(explode("\n", $data['ac_name_list']));
		unset($data['ac_html_path']);
		unset($data['ac_parent_dir']);
		unset($data['pinyin_as_dirname']);
		unset($data['ac_name_list']);

		$_L_ID = array();
		foreach($_acNameList as $acName) {
			if(empty($acName)) {
				continue;
			}
			$data['ac_name'] = $acName;
			vendor('Pinyin#class');
			$pyc = get_instance('Pinyin');
			$data['ac_html_dir'] = $_t_html_path . (('{uwa_path}' != $_t_html_path) ? '/' : '') . strtolower($pyc->get_pinyin($data['ac_name'], 'utf-8'));

			$result = M('ArchiveChannel')->add_channel($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_channel/list_channel'));
			}

			$archiveChannelId = M('ArchiveChannel')->db->lastInsID;
			M('ArchiveChannel')->build_url($archiveChannelId);
			$_L_ID[] = $archiveChannelId;
		}
		$_L_ID = implode(', ', $_L_ID);
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_ARCHIVE_CHANNEL') . ': ID[' . $_L_ID . ']');

		$this->success(L('ADD_SUCCESS'), Url::U('archive_channel/list_channel'));
	}

	/* edit channel */
	public function edit_channel() {
		$archiveChannelId = ARequest::get('archive_channel_id');

		if(!M('ArchiveChannel')->check_permission($archiveChannelId)) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
		}

		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_channel/list_channel'));
		}
		$this->assign('_ACI', $_ACI);

		$_AML = M('ArchiveModel')->get_modelList();
		$this->assign('_AML', $_AML);

		$_MLL = M('MemberLevel')->get_levelList();
		$this->assign('_MLL', $_MLL);

		$this->display();
	}
	public function edit_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$update_sub = ARequest::get('update_sub');
		$data = ARequest::get();

		if(!M('ArchiveChannel')->check_permission($data['archive_channel_id'] . ',' . $data['ac_parent_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $data['archive_channel_id'] . ']' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
		}

		$result = M('ArchiveChannel')->edit_channel($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $data['archive_channel_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_channel/list_channel'));
		}
		if($update_sub) {
			$subChannel = M('ArchiveChannel')->where(array('ac_parent_id' => array('EQ', $data['archive_channel_id'])))->select();
			if(!empty($subChannel)) {
				unset($data['ac_name']);
				unset($data['ac_parent_id']);
				unset($data['ac_display_order']);
				unset($data['ac_type']);
				unset($data['ac_keywords']);
				unset($data['ac_description']);
				unset($data['ac_content']);
				unset($data['ac_html_dir']);
				foreach($subChannel as $channel) {
					$data['archive_channel_id'] = $channel['archive_channel_id'];
					$result = M('ArchiveChannel')->edit_channel($data);
					if(!empty($result['error'])) {
						M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $data['archive_channel_id'] . ']' . $result['error'], 0);
						$this->error($result['error'], Url::U('archive_channel/list_channel'));
					}
				}
			}
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $data['archive_channel_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_channel/list_channel'));
	}

	/* update channel */
	public function update_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveChannelId = ARequest::get('archive_channel_id');
		$_L_ID = is_array($archiveChannelId) ? implode(', ', $archiveChannelId) : $archiveChannelId;

		if(empty($archiveChannelId)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_channel/list_channel'));
		}

		$acDisplayOrder = ARequest::get('ac_display_order');
		$acName = ARequest::get('ac_name');
		$data = array();
		foreach($archiveChannelId as $k => $id) {
			if(!M('ArchiveChannel')->check_permission($id)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $id . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
			}

			$data['archive_channel_id'] = $id;
			$data['ac_display_order'] = $acDisplayOrder[$k];
			$data['ac_name'] = $acName[$k];
			$result = M('ArchiveChannel')->edit_channel($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $id . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_channel/list_channel'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_CHANNEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_channel/list_channel'));
	}

	/* delete channel */
	public function delete_channel_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveChannelId = ARequest::get('archive_channel_id');
		$archiveChannelId = is_array($archiveChannelId) ? $archiveChannelId : explode(',', $archiveChannelId);
		$_L_ID = implode(', ', $archiveChannelId);

		foreach($archiveChannelId as $archiveChannelId) {
			if(!M('ArchiveChannel')->check_permission($archiveChannelId)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_CHANNEL') . ': ID[' . $archiveChannelId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_channel/list_channel'));
			}

			$result = M('ArchiveChannel')->delete_channel($archiveChannelId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_CHANNEL') . ': ID[' . $archiveChannelId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_channel/list_channel'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_CHANNEL') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_channel/list_channel'));
	}

	public function build_html_index_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveChannelId = ARequest::get('archive_channel_id');
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI) or 1 != $_ACI['ac_is_html'] or 1 != $_ACI['ac_type']) {
			return;
		}
		$this->assign('_V', $_ACI);

		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$this->assign('AC_ID', $archiveChannelId);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $archiveChannelId);

		/* Current Position */
		$this->assign('_CP', $_ACI['ac_position']);
		$this->assign('TASK', 'build_html_channel_index&archive_channel_id=' . $archiveChannelId);

		/* get html filename */
		$_dir = '/' . trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/');
		$file = $_dir . '/' . trim($_ACI['ac_html_index'], '/') . C('HTML.FILE_SUFFIX');

		$_C = require (CFG_PATH . D_S . 'comm.php');
		$this->te->tplTheme = $_C['TE']['TPL_THEME'];
		$this->build_html($file, APP_PATH, 'home/' . $_ACI['ac_tpl_index']);
		$this->te->tplTheme = 'default';

		if(true != ARequest::get('log_off')) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL_INDEX_HTML'));
		}
	}

	public function build_html_list_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveChannelId = ARequest::get('archive_channel_id');
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI) or 1 != $_ACI['ac_is_html']) {
			return;
		}
		$this->assign('_V', $_ACI);

		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$this->assign('AC_ID', $archiveChannelId);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $archiveChannelId);

		$this->assign('_CP', $_ACI['ac_position']);

		/* get html directory */
		$_dir = '/' . trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/');

		vendor('Pinyin#class');
		$pyc = get_instance('Pinyin');
		$naming = str_replace(array(
			'{ac_py}',
			'{page}',
			'{ac_id}'), array(
			$pyc->get_pinyin($_ACI['ac_name'], 'utf-8'),
			'_page_',
			$_ACI['archive_channel_id']), $_ACI['ac_html_naming_list']);
		$file = $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX');

		$where = array();
		$where['__ARCHIVE__.a_status'] = array('EQ', 1);

		$_ACL = M('ArchiveChannel')->get_channelList(0, $archiveChannelId);
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'), $archiveChannelId);
		$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($archiveChannelId)));

		$order = '`a_rank` DESC, `a_edit_time` DESC';

		/* get paging */
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, $_ACI['ac_page_size'], __APP__ . ltrim($file, '/'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $_ACI['archive_model_id'], true);
		$this->assign('_L', $_AL);

		$this->assign('TASK', 'build_html_channel_list&archive_channel_id=' . $archiveChannelId . '&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

		$_C = require (CFG_PATH . D_S . 'comm.php');
		$this->te->tplTheme = $_C['TE']['TPL_THEME'];
		$this->build_html(str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file), APP_PATH, 'home/' . $_ACI['ac_tpl_list']);

		/* build index */
		if(1 == $_GET[C('VAR.PAGE')] and 1 != $_ACI['ac_type']) {
			$this->build_html($_dir . '/' . trim($_ACI['ac_html_index'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/' . $_ACI['ac_tpl_list']);
		}
		$this->te->tplTheme = 'default';

		if(true != ARequest::get('log_off')) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL_LIST_HTML'));
		}
	}
}

?>