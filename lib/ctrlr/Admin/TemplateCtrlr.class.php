<?php

/**
 *--------------------------------------
 * template
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-22
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TemplateCtrlr extends ManageCtrlr {
	public function list_template() {
		$_TL = M('Template')->get_templateList();
		$this->assign('_TL', $_TL);

		$this->display();
	}

	public function list_template_file() {
		$template = ARequest::get('template') ? str_replace(' ', '', AFilter::text(ARequest::get('template'))) : 'default';
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$currentDir = D_S . ltrim(str_replace(array('*', '@'), array(D_S, '.'), $dir), D_S);
		if(D_S == $currentDir) {
			$currentDir = '';
		}

		$_FL = M('Template')->get_templateFileList($template, $currentDir);
		$this->assign('_FL', $_FL);

		$this->display();
	}

	/* template file list for choose*/
	public function choose_template_file() {
		$baseDir = in_array(ARequest::get('base_dir'), array('admin', 'home', 'member')) ? ARequest::get('base_dir') : '';

		$template = ('admin' == $baseDir) ? 'default' : M('Option')->get_option('site/theme');
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$currentDir = D_S . ltrim(str_replace(array('*', '@'), array(D_S, '.'), $dir), D_S);
		if(D_S == $currentDir) {
			$currentDir = '';
		}

		$_FL = M('Template')->get_templateFileList($template, $currentDir, $baseDir);
		$this->assign('_FL', $_FL);

		$this->display();
	}

	/* update template description */
	public function update_template_description_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$file = ARequest::get('file');
		$fileDescription = ARequest::get('description');

		$result = M('Template')->update_templateDescription($template, $file, $fileDescription);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('UPDATE_TEMPLATE_DESCRIPTION') . ': DIR[' . $dir . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('UPDATE_TEMPLATE_DESCRIPTION') . ': DIR[' . $dir . ']');
		$this->success(L('UPDATE_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}

	/* add template dir */
	public function add_template_dir() {
		$_V['template'] = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $_V['template'])) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$_V['current_dir'] = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($_V['current_dir'])) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$this->assign('_V', $_V);

		if(M('Template')->check_lock($_V['template'], $_V['current_dir'])) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $_V['template'] . '&dir=' . $_V['current_dir']));
		}

		$this->display();
	}
	public function add_template_dir_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dirname = str_replace(' ', '', AFilter::text(ARequest::get('dirname')));
		$dirDescription = ARequest::get('description');

		if(M('Template')->check_lock($template, $dir)) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		$result = M('Template')->add_templateDir($template, $dir, $dirname, $dirDescription);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TEMPLATE_DIR_FAILED') . ': ' . $result['error'], 0);
			$this->error(L('ADD_TEMPLATE_DIR_FAILED') . ': ' . $result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TEMPLATE_DIR_SUCCESS') . ': FILE[' . $template . $dir . '*' . $dirname . ']');
		$this->success(L('ADD_TEMPLATE_DIR_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}

	/* delete template dir */
	public function delete_template_dir_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dirname = str_replace(' ', '', AFilter::text(ARequest::get('dirname')));

		if(M('Template')->check_lock($template, $dir)) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		$result = M('Template')->delete_templateDir($template, $dir, $dirname);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TEMPLATE_DIR_FAILED') . ': ' . $result['error'], 0);
			$this->error(L('DELETE_TEMPLATE_DIR_FAILED') . ': ' . $result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TEMPLATE_DIR_SUCCESS') . ': FILE[' . $template . $dir . '*' . $dirname . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}

	/* add template file */
	public function add_template_file() {
		$_V['template'] = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $_V['template'])) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$_V['current_dir'] = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($_V['current_dir'])) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$this->assign('_V', $_V);

		if(M('Template')->check_lock($_V['template'], $_V['current_dir'])) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $_V['template'] . '&dir=' . $_V['current_dir']));
		}

		$this->display();
	}
	public function add_template_file_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$file = ARequest::get('file');
		if(!TemplateModl::check_tplFilename($file)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$fileDescription = ARequest::get('description');

		if(M('Template')->check_lock($template, $dir)) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		$content = ARequest::get('content');
		$content = preg_replace("/##textarea/i", "<textarea", $content);
		$content = preg_replace("/##\/textarea/i", "</textarea", $content);
		$content = preg_replace("/##form/i", "<form", $content);
		$content = preg_replace("/##\/form/i", "</form", $content);

		$result = M('Template')->add_templateFile($template, $dir, $file, $content, $fileDescription);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], 0);
			$this->error(L('ADD_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TEMPLATE_FILE_SUCCESS') . ': FILE[' . $template . $dir . '*' . $file . ']');
		$this->success(L('ADD_TEMPLATE_FILE_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}

	/* edit template file */
	public function edit_template_file() {
		$_V['template'] = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $_V['template'])) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$_V['current_dir'] = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($_V['current_dir'])) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$_V['file'] = ARequest::get('file');
		if(!TemplateModl::check_tplFilename($_V['file'])) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$_V['description'] = M('Template')->get_templateDescription($_V['template'], $_V['current_dir'] . '*' . $_V['file']);

		if(M('Template')->check_lock($_V['template'], $_V['current_dir'])) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $_V['template'] . '&dir=' . $_V['current_dir']));
		}

		$templateFilename = TPL_PATH . D_S . $_V['template'] . str_replace(array('*', '@'), array(D_S, '.'), $_V['current_dir']) . D_S . $_V['file'];
		if(!is_file($templateFilename)) {
			$this->error(L('TEMPLATE_FILE_INEXISTENCE'), Url::U('template/list_template_file?template=' . $_V['template'] . '&dir=' . $_V['current_dir']));
		}
		$content = file_get_contents($templateFilename);
		$content = preg_replace("#<textarea#i", "##textarea", $content);
		$content = preg_replace("#</textarea#i", "##/textarea", $content);
		$content = preg_replace("#<form#i", "##form", $content);
		$content = preg_replace("#</form#i", "##/form", $content);
		$_V['content'] = $content;

		$this->assign('_V', $_V);

		$this->display();
	}
	public function edit_template_file_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$file = ARequest::get('file');
		if(!TemplateModl::check_tplFilename($file)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$fileDescription = ARequest::get('description');

		if(M('Template')->check_lock($template, $dir)) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		$content = ARequest::get('content');
		$content = preg_replace("/##textarea/i", "<textarea", $content);
		$content = preg_replace("/##\/textarea/i", "</textarea", $content);
		$content = preg_replace("/##form/i", "<form", $content);
		$content = preg_replace("/##\/form/i", "</form", $content);

		$result = M('Template')->edit_templateFile($template, $dir, $file, $content, $fileDescription);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], 0);
			$this->error(L('EDIT_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TEMPLATE_FILE_SUCCESS') . ': FILE[' . $template . $dir . '*' . $file . ']');
		$this->success(L('EDIT_TEMPLATE_FILE_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}

	/* delete template file */
	public function delete_template_file_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = str_replace(' ', '', AFilter::text(ARequest::get('template')));
		if(!is_dir(TPL_PATH . D_S . $template)) {
			$this->error(L('TEMPLATE_INEXISTENCE'), Url::U('template/list_template'));
		}

		$dir = ARequest::get('dir');
		if(!TemplateModl::check_dirStr($dir)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		$file = ARequest::get('file');
		if(!TemplateModl::check_tplFilename($file)) {
			$this->error(L('DIR_INEXISTENCE'), Url::U('template/list_template'));
		}

		if(M('Template')->check_lock($template, $dir)) {
			$this->error(L('DEFAULT_TEMPLATE_IS_LOCKED'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		$result = M('Template')->delete_templateFile($template, $dir, $file);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], 0);
			$this->error(L('DELETE_TEMPLATE_FILE_FAILED') . ': ' . $result['error'], Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TEMPLATE_FILE') . ': FILE[' . $template . $dir . '*' . $file . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('template/list_template_file?template=' . $template . '&dir=' . $dir));
	}


	public function tag_wizard() {
		/* archive list */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		/* flag list */
		$_AFL = M('ArchiveFlag')->get_flagList();
		$this->assign('_AFL', $_AFL);

		$this->display();
	}

	/* tag preview */
	public function tag_preview() {
		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$_t_tpl = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin/template/tag_preview_default.php';
		$_tpl = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin/template/tag_preview.php';
		$preview = ARequest::get('code');
		if(MAGIC_QUOTES_GPC) {
			$preview = stripslashes($preview);
		}
		$code = str_replace(array(
			'{',
			'<uwa:',
			"</uwa:",
			'<?',
			'?>'), array(
			"{-php:echo '{';-}",
			"{-php:echo '<'.'uwa:';-}",
			"{-php:echo '</'.'uwa:';-}",
			"{-php:echo '<'.'?';-}",
			"{-php:echo '?'.'>';-}"), $preview);
		$content = file_get_contents($_t_tpl);
		$content = str_replace(array('~preview~', '~code~'), array($preview, $code), $content);
		file_put_contents($_tpl, $content);
		$this->display();
		file_put_contents($_tpl, '');
	}

	/* update tag wizard list */
	public function update_tag_wizard_list_do() {
		$_t_tpl = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin/template/tag_wizard_default.php';
		$_tpl = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin/template/tag_wizard.php';
		/* get tag wizard list */
		$_TWL = array();
		$dirRes = opendir(C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin/template/tag_wizard/');
		while($dir = readdir($dirRes)) {
			if(!in_array($dir, array(
				'.',
				'..',
				'index.html',
				'.svn'))) {
				$_TWL[] = basename($dir, '.php');
			}
		}
		$tagWizard = '';
		foreach($_TWL as $tw) {
			$tagWizard .= "{-include:tag_wizard/" . $tw . "-}\r\n";
		}
		$content = file_get_contents($_t_tpl);
		$content = str_replace('~tag_wizard~', $tagWizard, $content);
		file_put_contents($_tpl, $content);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('UPDATE_TAG_WIZARD_LIST'));
		$this->success(L('UPDATE_SUCCESS'), Url::U('template/tag_wizard'));
	}
}

?>