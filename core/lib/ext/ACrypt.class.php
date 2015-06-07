<?php

/**
 *--------------------------------------
 * encryption and decryption
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ACrypt {
	/* array can serialize to string before encrypt */
	public static function encrypt($txt, $key = '') {
		$encrypt_key = md5(mt_rand(0, 32000));
		$ctr = 0;
		$tmp = '';
		for($i = 0; $i < strlen($txt); $i++) {
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			$tmp .= $encrypt_key[$ctr] . ($txt[$i] ^ $encrypt_key[$ctr++]);
		}
		return base64_encode(self::_crypt($tmp, $key));
	}

	public static function decrypt($txt, $key = '') {
		$txt = self::_crypt(base64_decode($txt), $key);
		$tmp = '';
		for($i = 0; $i < strlen($txt); $i++) {
			$md5 = $txt[$i];
			$tmp .= $txt[++$i] ^ $md5;
		}
		return $tmp;
	}

	private static function _crypt($txt, $encrypt_key) {
		$encrypt_key = md5($encrypt_key);
		$ctr = 0;
		$tmp = '';
		for($i = 0; $i < strlen($txt); $i++) {
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
		}
		return $tmp;
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>