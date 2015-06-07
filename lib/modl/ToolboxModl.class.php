<?php

/**
 *--------------------------------------
 * toolbox
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-29
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ToolboxModl extends Modl {
	public function delete_duplicate_archive($aTitle, $retainType) {
		$result = array('data' => '', 'error' => '');

		$orderBy = ('oldest' == $retainType ? "`archive_id` DESC" : "`archive_id` ASC");
		foreach($aTitle as $aTitle) {
			$_AL = M('Archive')->field('`archive_id`,`a_title`,`a_keywords`')->where(array('a_title' => array('EQ', $aTitle)))->order($orderBy)->select();
			$row = count($_AL);
			foreach($_AL as $k => $a) {
				if($k + 1 < $row) {
					M('Archive')->delete_archive($a['archive_id']);
					if(!empty($a['a_keywords'])) {
						$keywords = explode(',', $a['a_keywords']);
						foreach($keywords as $keyword) {
							$keyword = trim($keyword);
							if(!empty($keyword)) {
								M('Tag')->delete_tag_archive($keyword, $a['archive_id']);
							}
						}
					}
				}
			}
		}
		$this->query('OPTIMIZE TABLE __ARCHIVE__', true);

		return $result;
	}

	/* return true if code is found */
	public function scan_code($file, $fileType = array('php', 'js'), $functionName = array(
		'eval',
		'cmd',
		'system',
		'exec'), $featureCode = '_GET[', $ignoreCase = false, $verifyCode = array()) {
		$result = array(
			'match' => false,
			'type' => '',
			'feature' => '',
			'count' => 0,
			'verified' => 0,
			'verify_info' => L('NOT_VERIFY_FINGERPRINT'));

		foreach($fileType as $fileType) {
			if('.' . $fileType == substr($file, (-1 - strlen($fileType)))) {
				$content = file_get_contents($file);
				/* check funtion */
				if(!empty($functionName)) {
					foreach($functionName as $functionName) {
						if(($ignoreCase and preg_match_all('/[^a-z]?(' . $functionName . ')\s*\(/i', $content, $matches, PREG_SET_ORDER)) or (!$ignoreCase and preg_match_all('/[^a-z]?(' . $functionName . ')\s*\(/', $content, $matches, PREG_SET_ORDER))) {
							$result = array(
								'match' => true,
								'type' => L('FUNCTION_NAME'),
								'feature' => $functionName,
								'count' => count($matches),
								'verify_info' => L('NOT_VERIFY_FINGERPRINT'));
							/* verify md5 */
							if(!empty($verifyCode) and isset($verifyCode[str_replace(APP_PATH . D_S, '', $file)])) {
								if(md5($content) == $verifyCode[str_replace(APP_PATH . D_S, '', $file)]) {
									$result['verified'] = 1;
									$result['verify_info'] = L('FINGERPRINT_MATCH');
								}
								else {
									$result['verified'] = 2;
									$result['verify_info'] = L('FINGERPRINT_NOT_MATCH');
								}
							}
							return $result;
						}
					}
				}
				/* check code */
				if(!empty($featureCode)) {
					if(($ignoreCase and preg_match_all('/[^a-z]?(' . $featureCode . ')/i', $content, $matches, PREG_SET_ORDER)) or (!$ignoreCase and preg_match_all('/[^a-z]?(' . $featureCode . ')/', $content, $matches, PREG_SET_ORDER))) {
						$result = array(
							'match' => true,
							'type' => L('FEATURE_CODE'),
							'feature' => $featureCode,
							'count' => count($matches),
							'verify_info' => L('NOT_VERIFY_FINGERPRINT'));
						/* verify md5 */
						if(!empty($verifyCode) and isset($verifyCode[str_replace(APP_PATH . D_S, '', $file)])) {
							if(md5($content) == $verifyCode[str_replace(APP_PATH . D_S, '', $file)]) {
								$result['verified'] = 1;
								$result['verify_info'] = L('FINGERPRINT_MATCH');
							}
							else {
								$result['verified'] = 2;
								$result['verified'] = L('FINGERPRINT_NOT_MATCH');
							}
						}
						return $result;
					}
				}
			}
		}
		return $result;
	}

	/* show progress $barLength: % */
	public function show_progress($msg, $barLength = '50') {
		if(0 == $barLength) {
			echo '<script>start_progress("' . $msg . '");</script>';
			@ob_flush();
			@flush();
		}
		elseif(100 == $barLength) {
			echo '<script>finish_progress("' . $msg . '");</script>';
			@ob_flush();
			@flush();
		}
		else {
			echo '<script>show_progress("' . $msg . '", "' . $barLength . '%");</script>';
			@ob_flush();
			@flush();
		}
	}
}

?>