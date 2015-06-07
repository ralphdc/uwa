<?php

/**
 *--------------------------------------
 * common
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-27
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CommonCtrlr extends IndexCtrlr {
	public function captcha_img() {
		$name = in_array(ARequest::get('name'), array('vcode', 'test')) ? ARequest::get('name', 'get') : 'vcode';

		$fonts = array(
			'spacing' => 2,
			'size' => 16,
			'font' => PUBLIC_PATH . D_S . 'font/font.ttf');
		$ac = new ACaptcha(90, 30, 5, $fonts);
		ASession::set($name, strtolower($ac->text));
		$ac->create_image();
	}

	public function task() {
		header('Content-Type:application/x-javascript; charset=utf-8');
		$tasks = explode('|', ARequest::get('task'));
		foreach($tasks as $task) {
			switch($task) {
				case 'build_html_index':
					$this->build_html_index_do();
					break;
				case 'build_html_channel_index':
					$this->build_html_channel_index_do();
					break;
				case 'build_html_channel_list':
					$this->build_html_channel_list_do();
					break;
				case 'build_html_archive':
					$this->build_html_archive_do();
					break;
			}
		}

		/* system task */
		if(!get_licence()) {
			echo '$("body").append("<div style=\"position:absolute;right:0;bottom:0;width:20px;height:14px;text-indent:-9999px;overflow:hidden;background:url(\'data:image/gif;base64,R0lGODlhFAAOAIABAM/W5v///yH5BAEAAAEALAAAAAAUAA4AAAInjI+py40AnII0ylDrpYYziEXg aB0cGYZlV3rslFnZMqtgc7/XzisFADs=\')\"><a target=\"_blank\" href=\"' . SOFT_AUTHOR_URL . '\">Pow' . 'ered by ' . SOFT_NAME . ' ' . SOFT_CODENAME . '</a></div>");';
		}
		M('Task')->run_task();
		exit();
	}

	private function build_html_index_do() {
		$_o = M('Option')->get_option('core');
		$_oi = M('Option')->get_option('index');
		if(!$_o['html_switch'] or !$_oi['html_switch']) {
			return;
		}

		$this->assign('_GCAP', 'home@index/index');

		/* allow index paging */
		if($_oi['paging_switch']) {
			$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;

			$_dir = '/' . trim(str_replace('{uwa_path}', '', $_oi['html_path_paging']), '/');
			$naming = str_replace('{page}', '_page_', $_oi['html_naming_paging']);
			$file = $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX');

			$htmlFile = APP_PATH . str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file);

			if((file_exists($htmlFile) and 0 == $_o['html_expire_index']) or (time() < filemtime($htmlFile) + $_o['html_expire_index'])) {
				return;
			}

			$where = array();
			$where['__ARCHIVE__.a_status'] = array('EQ', 1);
			$order = '`a_rank` DESC, `a_edit_time` DESC';

			$rowsNum = M('Archive')->get_archiveCount($where);
			$p = new APage($rowsNum, $_oi['page_size'], __APP__ . ltrim($file, '/'));

			if($p->__get('totalPages') < ARequest::get(C('VAR.PAGE'))) {
				return;
			}

			$this->assign('PAGING', $p->get_paging());
			$limit = $p->get_limit();

			/* archive list */
			$_AL = M('Archive')->get_archiveList($where, $order, $limit);
			$this->assign('_L', $_AL);

			/* task */
			$this->assign('TASK', 'build_html_index&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

			$this->build_html(str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file), APP_PATH, 'home/'.$_oi['tpl_paging']);

			/* build default index */
			if(1 == ARequest::get(C('VAR.PAGE'))) {
				/* task */
				$this->assign('TASK', 'build_html_index');

				$this->build_html(trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/'.$_oi['tpl_paging']);
			}

			/* deal with new next page */
			if($p->__get('totalPages') == ARequest::get(C('VAR.PAGE'))) {
				return;
			}
			ARequest::set(C('VAR.PAGE'), ARequest::get(C('VAR.PAGE')) + 1);
			$htmlFileNext = APP_PATH . D_S . str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file);
			if(file_exists($htmlFileNext)) {
				return;
			}
			$this->build_html_index_do();
		}
		else {
			$htmlFile = APP_PATH . D_S . $_oi['html_naming'] . C('HTML.FILE_SUFFIX');
			if((file_exists($htmlFile) and 0 == $_o['html_expire_index']) or (time() < filemtime($htmlFile) + $_o['html_expire_index'])) {
				return;
			}

			/* task */
			$this->assign('TASK', 'build_html_index');

			$this->build_html(trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/'.$_oi['tpl']);
		}
	}

	private function build_html_channel_index_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveChannelId = intval(ARequest::get('archive_channel_id'));
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI) or 1 != $_ACI['ac_is_html'] or 1 != $_ACI['ac_type']) {
			return;
		}

		/* get html filename */
		$_dir = trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/');
		$file = $_dir . '/' . trim($_ACI['ac_html_index'], '/') . C('HTML.FILE_SUFFIX');

		$htmlFile = APP_PATH . D_S . $file;
		if((file_exists($htmlFile) and 0 == $_o['html_expire_list']) or (time() < filemtime($htmlFile) + $_o['html_expire_list'])) {
			return;
		}

		$this->assign('_V', $_ACI);
		$this->assign('AC_ID', $archiveChannelId);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $archiveChannelId);

		$this->assign('_CP', $_ACI['ac_position']);
		$this->assign('TASK', 'build_html_channel_index&archive_channel_id=' . $archiveChannelId);

		$this->build_html($file, APP_PATH, 'home/' . $_ACI['ac_tpl_index']);
	}

	private function build_html_channel_list_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveChannelId = intval(ARequest::get('archive_channel_id'));
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI) or 1 != $_ACI['ac_is_html']) {
			return;
		}

		/* get html dir and filename */
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

		$htmlFile = APP_PATH . str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file);

		if((file_exists($htmlFile) and 0 == $_o['html_expire_list']) or (time() < filemtime($htmlFile) + $_o['html_expire_list'])) {
			return;
		}

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
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, $_ACI['ac_page_size'], __APP__ . ltrim($file, '/'));

		if($p->__get('totalPages') < ARequest::get(C('VAR.PAGE'))) {
			return;
		}

		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		$this->assign('_V', $_ACI);
		$this->assign('AC_ID', $archiveChannelId);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $archiveChannelId);

		$this->assign('_CP', $_ACI['ac_position']);

		$_AL = M('Archive')->get_archiveList($where, $order, $limit, $_ACI['archive_model_id'], true);
		$this->assign('_L', $_AL);

		$this->assign('TASK', 'build_html_channel_list&archive_channel_id=' . $archiveChannelId . '&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

		$this->build_html(str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file), APP_PATH, 'home/' . $_ACI['ac_tpl_list']);

		/* build index anyway */
		if(1 == ARequest::get(C('VAR.PAGE')) and 1 != $_ACI['ac_type']) {
			$this->build_html($_dir . '/' . trim($_ACI['ac_html_index'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/' . $_ACI['ac_tpl_list']);
		}

		/* deal with new next page */
		if($p->__get('totalPages') == ARequest::get(C('VAR.PAGE'))) {
			return;
		}
		ARequest::set(C('VAR.PAGE'), ARequest::get(C('VAR.PAGE')) + 1);
		$htmlFileNext = APP_PATH . D_S . str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file);
		if(file_exists($htmlFileNext)) {
			return;
		}
		$this->build_html_channel_list_do();
	}

	private function build_html_archive_do() {
		$_o = M('Option')->get_option('core');
		if(!$_o['html_switch']) {
			return;
		}

		$archiveId = intval(ARequest::get('archive_id'));
		$_AI = M('Archive')->field('`a_is_html`,`a_status`,`a_cost_points`,`a_html_path`,`a_html_naming`,`a_add_time`,`a_title`, `archive_channel_id`')->where(array('archive_id' => array('EQ', $archiveId)))->find();

		if(empty($_AI) or !$_AI['a_is_html'] or 1 != $_AI['a_status'] or 0 != $_AI['a_cost_points']) {
			return;
		}

		$_ACI = M('ArchiveChannel')->get_channelInfo($_AI['archive_channel_id']);

		if(0 == $_ACI['ac_is_html'] or !in_array(0, $_ACI['ac_view_ml_ids'])) {
			return;
		}

		/* get html dir and filename */
		$_dir = '';
		if(0 == $_AI['a_html_path']) {
			$_dir = '/' . trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/');
		}

		vendor('Pinyin#class');
		$pyc = get_instance('Pinyin');

		/* get filename */
		if(!empty($_AI['a_html_naming'])) {
			$naming = $_AI['a_html_naming'];
		}
		else {
			$naming = $_ACI['ac_html_naming_archive'];
		}
		$naming = str_replace(array(
			'{ac_py}',
			'{ac_id}',
			'{Y}',
			'{M}',
			'{D}',
			'{a_py}',
			'{a_id}'), array(
			$pyc->get_pinyin($_ACI['ac_name'], 'utf-8'),
			$_AI['archive_channel_id'],
			date('Y', $_AI['a_add_time']),
			date('m', $_AI['a_add_time']),
			date('d', $_AI['a_add_time']),
			$pyc->get_pinyin($_AI['a_title'], 'utf-8'),
			$_AI['archive_id']), $naming);
		$file = $_dir . '/' . trim($naming, '/');

		$htmlFile = APP_PATH . $file . C('HTML.FILE_SUFFIX');

		if((file_exists($htmlFile) and 0 == $_o['html_expire_archive']) or (time() < filemtime($htmlFile) + $_o['html_expire_archive'])) {
			return;
		}

		$_AI = M('Archive')->get_archiveInfo($archiveId, true);

		$this->assign('AC_ID', $_AI['archive_channel_id']);
		$this->assign('A_ID', $_AI['archive_id']);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $_AI['archive_channel_id']);

		$_AI['ac_sibling'] = $_ACI['ac_sibling'];

		$_ACI['ac_position'][] = array('name' => $_AI['a_title'], 'url' => '');
		$this->assign('_CP', $_ACI['ac_position']);

		$this->assign('TASK', 'build_html_archive&archive_id=' . $archiveId);

		/* deal with paging field */
		foreach($_ACI['am_field'] as $field => $params) {
			if(isset($params['f_is_paging']) and (1 == $params['f_is_paging'])) {
				$pagingField = $field;
				break;
			}
		}

		/* get template */
		if(!empty($_AI['a_tpl'])) {
			$tpl = 'home/' . $_AI['a_tpl'];
		}
		else {
			$tpl = 'home/' . $_AI['ac_tpl_archive'];
		}

		if(isset($pagingField) and false !== strpos($_AI[$pagingField], '<p>#uwa_paging#</p>')) {
			$_title = $_AI['a_title'];
			$_content = explode('<p>#uwa_paging#</p>', $_AI[$pagingField]);

			$rowsNum = count($_content);
			/* create paging */
			foreach($_content as $key => $_c) {
				$_GET[C('VAR.PAGE')] = $key + 1;
				$p = new APage($rowsNum, 1, __APP__ . trim($file, '/') . '-_page_' . C('HTML.FILE_SUFFIX'));
				$this->assign('PAGING', $p->get_paging());
				$_AI[$pagingField] = $_content[ARequest::get(C('VAR.PAGE')) - 1];
				$_AI['a_title'] = $_title . '(' . ARequest::get(C('VAR.PAGE')) . ')';
				$this->assign('_V', $_AI);
				$this->build_html($file . '-' . ARequest::get(C('VAR.PAGE')) . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
				/* create default page */
				if(1 == ARequest::get(C('VAR.PAGE'))) {
					$this->build_html($file . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
				}
			}
		}
		else {
			$this->assign('PAGING', '');

			$this->assign('_V', $_AI);
			$this->build_html($file . C('HTML.FILE_SUFFIX'), APP_PATH, $tpl);
		}
	}

	public function toggle_ua() {
		$ua = strtolower(ARequest::get(C('VAR.USER_AGENT')));
		$tuab = C('TE.TPL_USER_AGENT_BRANCH');

		if(M('Option')->get_option('core/html_switch')) {
			$url = Url::U('home@index/index');
		}
		else {
			$url = AServer::get_preUrl();
		}

		if(empty($ua) or !preg_match('/^[A-Za-z_0-9]+$/', $ua) or !in_array($ua, $tuab)) {
			if(IS_AJAX) {
				$this->ajax_return(array('data' => 0));
			}
			redirect($url);
		}

		ACookie::set('user_agent', $ua);

		if(IS_AJAX) {
			$this->ajax_return(array('data' => 1));
		}
		redirect($url);
	}
}

?>