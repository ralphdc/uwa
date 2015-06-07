<?php

/**
 *--------------------------------------
 * email
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-15
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class EmailModl extends Modl {
	public function edit_template($file, $name, $content) {
		$result = array('data' => '', 'error' => '');

		/* save tpl file */
		$tplFile = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl' . D_S . $file;

		if(MAGIC_QUOTES_GPC) {
			$content = stripslashes($content);
		}
		$content = preg_replace("/##textarea/i", "<textarea", $content);
		$content = preg_replace("/##\/textarea/i", "</textarea", $content);
		$content = preg_replace("/##form/i", "<form", $content);
		$content = preg_replace("/##\/form/i", "</form", $content);

		if(!file_put_contents($tplFile, $content)) {
			$result['error'] = L('FILE_WRITE_FAILED', null, array('filename' => $file));
			return $result;
		}

		/* save tpl names */
		$tplNameFile = C('TE.TPL_PATH') . D_S . C('TE.TPL_THEME') . D_S . 'admin' . D_S . 'email' . D_S . 'tpl' . D_S . '_names.php';

		$_O = include ($tplNameFile);
		$_O = array_merge($_O, array($file => $name));
		$content = var_export($_O, true);
		$content = "<?php\r\nreturn {$content};\r\n?>";

		if(!@file_put_contents($tplNameFile, $content)) {
			$result['error'] = L('FILE_WRITE_FAILED', null, array('filename' => '_names.php'));
			return $result;
		}

		return $result;
	}

	/* $data array('~var~' => 'some value', '~var1~' => 'some value1') */
	public function send_tpl_email($toAddress, $title, $tplName, $data, $attachment = array()) {
		$result = array('data' => '', 'error' => '');

		$EmailTpl = C('TE.TPL_PATH') . D_S . 'default' . D_S . 'admin' . D_S . 'email' . D_S . 'tpl' . D_S . $tplName;
		if(!file_exists($EmailTpl) or !is_file($EmailTpl)) {
			$result['error'] = L('TEMPLATE_FILE_INEXISTENCE');
			return $result;
		}

		$content = file_get_contents($EmailTpl);
		$content = str_replace(
			array_keys($data),
			$data,
			$content
		);

		return $this->send_email($toAddress, $title, $content, $attachment);
	}

	public function send_email($toAddress, $title, $content, $attachment = array()) {
		$result = array('data' => '', 'error' => '');

		$_O = get_extensionOption('email');
		vendor('PHPMailer.phpmailer#class');
		$mailer = new PHPMailer();
		if('smtp' == $_O['mailer']) {
			$mailer->IsSMTP();
			$mailer->Host = $_O['smtp']['host'];
			$mailer->Port = $_O['smtp']['port'];
			$mailer->SMTPAuth = $_O['smtp']['auth'];
			$mailer->SMTPSecure = $_O['smtp']['secure'];
			$mailer->Username = $_O['smtp']['username'];
			$mailer->Password = $_O['smtp']['password'];
		}
		$mailer->XMailer = 'UWA Emailer (http://asthis.net)';
		$mailer->CharSet = 'utf-8';
		$mailer->IsHTML(true);
		$mailer->From = $_O['sender'];
		$mailer->FromName = $_O['sender_name'];
		if(is_array($toAddress)) {
			$mailer->AddAddress($toAddress['email'], $toAddress['name']);
			$recipient = $toAddress['name'];
		}
		else {
			$mailer->AddAddress($toAddress);
			$recipient = $toAddress;
		}

		$mailer->Subject = $title;

		$mailer->Body = str_replace(array(
			'~sender_name~',
			'~recipient~',
			'~datetime~'), array(
			$_O['sender_name'],
			$recipient,
			date(C('APP.TIME_FORMAT'))), $content);
		$mailer->AltBody = "This is an Email form an site that prowered by UWA.";

		if(!empty($attachment)) {
			foreach($attachment as $_a) {
				$_a['path'] = $this->utf8_check($_a['path']);
				$mailer->AddAttachment($_a['path'], $_a['name']);
			}
		}

		if(!$mailer->Send()) {
			$result['error'] = $mailer->ErrorInfo;
			return $result;
		}

		return $result;
	}

	private function utf8_check($string = '') {
		if(preg_match('/[' . chr(0xa1) . '-' . chr(0xff) . ']/', $string)) {
			$string = iconv('utf-8', 'gb2312', $string);
		}
		return $string;
	}
}

?>