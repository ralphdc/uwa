<?php

/**
 *--------------------------------------
 * email
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-06
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class EmailCtrlr extends ManageCtrlr {
	public function edit_option() {
		$this->assign('_O', get_extensionOption('email'));

		$this->display();
	}
	public function edit_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);
		unset($data['send_test_email']);

		if(!edit_extensionOption('email', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_EMAIL_OPTION') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('email/edit_option'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_EMAIL_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('email/edit_option'));
	}

	public function edit_template() {
		$tplDir = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl';

		/* template list */
		$_TL = list_file($tplDir);
		$this->assign('_TL', $_TL);

		$_V = array(
			'file' => '',
			'name' => '',
			'content' => '');
		$template = ARequest::get('template') ? ARequest::get('template') : 'default.php';
		$tplFile = $tplDir . D_S . $template;
		if(file_exists($tplFile)) {
			$_V['file'] = $template;
			$_V['name'] = $template;
			foreach($_TL as $t) {
				if($_V['file'] == $t['file']) {
					$_V['name'] = $t['name'];
					break;
				}
			}
			$content = file_get_contents($tplFile);
			$content = preg_replace("#<textarea#i", "##textarea", $content);
			$content = preg_replace("#</textarea#i", "##/textarea", $content);
			$content = preg_replace("#<form#i", "##form", $content);
			$content = preg_replace("#</form#i", "##/form", $content);
			$_V['content'] = $content;
		}
		$this->assign('_V', $_V);

		$this->display();
	}
	public function edit_template_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$file = trim(ARequest::get('file'));
		$name = trim(ARequest::get('name'));
		$content = ARequest::get('content');

		$result = M('Email')->edit_template($file, $name, $content);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $result['error'] . ']', 0);
			$this->error(L('EDIT_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $result['error'] . ']', Url::U('email/edit_template'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_EMAIL_TEMPLATE'));
		$this->success(L('EDIT_SUCCESS'), Url::U('email/edit_template?template=' . $file));

	}

	public function delete_template_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$template = ARequest::get('template');
		$tplDir = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl';
		$tplFile = $tplDir . D_S . $template;
		if(!file_exists($tplFile) or !is_file($tplFile)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $template . L('INEXISTENCE') . ']', 0);
			$this->error(L('DELETE_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $template . L('INEXISTENCE') . ']', Url::U('email/edit_template'));
		}

		if(!unlink($tplFile)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $template . L('ERAD_ONLY') . ']', 0);
			$this->error(L('DELETE_EMAIL_TEMPLATE') . ': ' . L('FAILED') . '[' . $template . L('ERAD_ONLY') . ']', Url::U('email/edit_template'));
		}

		/* save tpl names */
		$tplNameFile = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl' . D_S . '_names.php';

		$_O = include ($tplNameFile);
		unset($_O[$template]);
		$content = var_export($_O, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";
		@file_put_contents($tplNameFile, $content);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_EMAIL_TEMPLATE'));
		$this->success(L('DELETE_SUCCESS'), Url::U('email/edit_template'));
	}

	public function send_email() {
		$tplDir = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl';

		/* template list */
		$_TL = list_file($tplDir);
		$this->assign('_TL', $_TL);

		$_V = array('content' => '');
		$template = ARequest::get('template') ? ARequest::get('template') : 'default.php';
		$_V['recipient_email'] = ARequest::get('recipient_email') ? ARequest::get('recipient_email') : '';
		$_V['recipient_name'] = ARequest::get('recipient_name') ? ARequest::get('recipient_name') : '';
		$tplFile = $tplDir . D_S . $template;
		if(file_exists($tplFile)) {
			$_V['file'] = $template;
			$_V['name'] = $template;
			foreach($_TL as $t) {
				if($_V['file'] == $t['file']) {
					$_V['name'] = $t['name'];
					break;
				}
			}
			$_V['content'] = file_get_contents($tplFile);
		}
		$this->assign('_V', $_V);

		$this->display();
	}
	public function send_email_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		if(MAGIC_QUOTES_GPC) {
			$data = stripslashes_array($data);
		}

		$attachment = array();
		if(!empty($_FILES['attachment'])) {
			foreach($_FILES['attachment']['name'] as $k => $name) {
				$attachment[] = array('path' => $_FILES['attachment']['tmp_name'][$k], 'name' => $name);
			}
		}

		$result = M('Email')->send_email($data['recipient'], $data['title'], $data['content'], $attachment);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('SEND_EMAIL') . ': ' . L('FAILED') . '[' . $result['error'] . ']', 0);
			$this->error(L('SEND_EMAIL') . ': ' . L('FAILED') . '[' . $result['error'] . ']', Url::U('email/edit_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('SEND_EMAIL') . ': ' . $data['recipient']['email']);
		$this->success(L('SEND_SUCCESS'), Url::U('email/send_email?template=' . $file));

	}
}

?>