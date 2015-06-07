<?php

/**
 *--------------------------------------
 * common function library
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-2
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

/* get url for menu. $urlType 0:compose, 1:direct */
function get_url($urlStr, $urlType = 0, $mobile = false) {
	if(1 == $urlType) {
		return $urlStr;
	}

	/* index */
	if(false !== strpos($urlStr, 'index/index')) {
		if($mobile) {
			return Url::U($urlStr);
		}

		$_o = M('Option')->get_option('core');
		$_oi = M('Option')->get_option('index');
		if($_o['html_switch'] and $_oi['html_switch']) {
			$_t_a = explode('=', $urlStr);
			if(isset($_t_a[1])) {
				$_dir = '/' . trim(str_replace('{uwa_path}', '', $_oi['html_path_paging']), '/');
				$naming = str_replace('{page}', $_t_a[1], $_oi['html_naming_paging']);
				$file = $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX');
				$url = __APP__ . ltrim($file, '/');
			}
			else {
				$url = __APP__ . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX');
			}
			return $url;
		}
	}
	/* archive channel */
	if(false !== strpos($urlStr, 'archive/show_channel')) {
		$_t_a = explode('=', $urlStr);
		if(isset($_t_a[1])) {
			$_aci = M('ArchiveChannel')->get_channelInfo($_t_a[1]);
		}
		if(!empty($_aci)) {
			return $mobile ? $_aci['ac_url_o'] : $_aci['ac_url'];
		}
	}
	/* archive */
	if(false !== strpos($urlStr, 'archive/show_archive')) {
		$_t_a = explode('=', $urlStr);
		if(isset($_t_a[1])) {
			$_ai = M('Archive')->get_archiveInfo($_t_a[1]);
		}
		if(!empty($_ai)) {
			return $mobile ? $_ai['a_url_o'] : $_ai['a_url'];
		}
	}
	/* single page */
	if(false !== strpos($urlStr, 'single_page/show_single_page')) {
		$_t_a = explode('=', $urlStr);
		if(isset($_t_a[1])) {
			$_spi = M('SinglePage')->get_singlePageInfo($_t_a[1]);
		}
		if(!empty($_spi)) {
			return $mobile ? $_spi['sp_url_o'] : $_spi['sp_url'];
		}
	}
	return Url::U($urlStr);
}

/* addslashes for array */
function addslashes_array($array) {
	if(is_array($array)) {
		foreach($array as $n => $v) {
			$b[$n] = addslashes_array($v);
		}
		return $b;
	}
	else {
		return addslashes($array);
	}
}

/* strip slashes for array */
function stripslashes_array($array) {
	$array = is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
	return $array;
}

/* check interaction */
function check_interaction($interactionName = 'interaction', $manage = false) {
	$_o_i = M('Option')->get_option('interaction');

	if(!I($interactionName, $_o_i['feedback_interval'])) {
		A()->error(L('_TRY_LATER_'), AServer::get_preUrl());
	}
	I($interactionName);

	/* prevent duplicate submission */
	$timeKey = ARequest::get('timeKey');
	if(empty($timeKey)) {
		A()->error(L('VERIFY_FAILED'), AServer::get_preUrl());
	}
	if(ASession::get('timeKey') == ARequest::get('timeKey')) {
		A()->error(L('DUPLICATE_SUBMISSION'), AServer::get_preUrl());
	}
	ASession::set('timeKey', ARequest::get('timeKey'));

	/* captcha check */
	if((!$manage and $_o_i['captcha']) or ($manage and $_o_i['manage_captcha'])) {
		$vcode = strtolower(trim(ARequest::get('vcode')));
		$s_vcode = ASession::get('vcode');
		if($vcode != $s_vcode or empty($s_vcode)) {
			ASession::del('vcode');
			A()->error(L('VCODE_ERROR'), AServer::get_preUrl());
		}
	}
}

/* check data token */
function check_token() {
	$timeKey = ARequest::get('timeKey');
	 /* token expire 3600s */
	if(($timeKey > time()) or (time() > (3600 + $timeKey)) or (substr(md5(SOFT_SEED . $timeKey), 8, 8) != ARequest::get('token'))) {
		return false;
	}
	return true;
}

/* get extension option from alias. $extensionAlias: such as[ aa_bb ] */
function get_extensionOption($extensionAlias) {
	$_O = array();
	$cfgFile = CFG_PATH . D_S . 'Extension' . D_S . parse_name($extensionAlias, 1) . '.php';
	if(file_exists($cfgFile)) {
		$_O = include ($cfgFile);
	}
	return $_O;
}

/* get tag from keywords */
function keywords_to_tag($keywords) {
	$str = '';
	$keywords = explode(',', $keywords);
	foreach($keywords as $keyword) {
		$keyword = trim($keyword);
		if(!empty($keyword)) {
			$str .= '<a href="' . Url::U('home@tag/show_tag?t_name=' . $keyword) . '" target="_blank">' . $keyword . '</a> ';
		}
	}
	return $str;
}

/* garble string */
function garble_string($content) {
	$_o = get_extensionOption('garble_string');

	$garbleStyle = AString::rand_string(!empty($_o['style_name_length']) ? $_o['style_name_length'] : 9);
	$fontColor = !empty($_o['font_color']) ? $_o['font_color'] : "#fff";
	$garbleTag = !empty($_o['tag']) ? $_o['tag'] : array( 'font', 'span', 'i', 'b', 'em', 'strong');
	$garbleString = !empty($_o['string']) ? $_o['string'] : array('uwa');
	$maxDistance = !empty($_o['max_distance']) ? $_o['max_distance'] : 1024;

	$return = "<style>.{$garbleStyle}{display:none;}</style>\r\n";

	$contentLen = strlen($content) - 1;
	$prepos = 0;
	for($i = 0; $i <= $contentLen; $i++) {
		if($i + 2 >= $contentLen || $i < 50) {
			$return .= $content[$i];
		}
		else {
			$ntag = @strtolower($content[$i] . $content[$i + 1] . $content[$i + 2]);
			if($ntag == '</p' || ($ntag == '<br' && $i - $prepos > $maxDistance)) {
				$tag = $garbleTag[mt_rand(0, count($garbleTag) - 1)];
				$str = $garbleString[mt_rand(0, count($garbleString) - 1)];
				if('font' != $tag) {
					$garble = " <{$tag} class=\"{$garbleStyle}\">{$str}</{$tag}> ";
				}
				else {
					$garble = " <font color='$fontColor'>$str</font> ";
				}
				$return .= $garble . $content[$i];
				$prepos = $i;
			}
			else {
				$return .= $content[$i];
			}
		}
	}
	return $return;
}

/* get file list in dir */
function get_fileList($dir) {
	$fileList = array();
	if(is_dir($dir)) {
		$dh = dir($dir);
		while(false !== ($filename = $dh->read())) {
			if('.' == $filename[0] || 'cvs' == strtolower($filename)) {
				continue;
			}
			$fileList = array_merge($fileList, get_fileList($dir . '/' . $filename));
		}
	}
	elseif(is_file($dir)) {
		$fileList[] = $dir;
	}
	return $fileList;
}

/* get url used for XML */
function get_xmlUrl($url) {
	$url = str_replace(array('&', '\'', '"', '>', '<'), array('&amp;', '&apos;', '&quot;', '&gt;', '&lt;'), $url);
	return preg_match("/^http:\/\//i", $url) ? $url : rtrim(__HOST__, '/') . $url;
}

/* is mobile user agent */
function is_mobile($cookie = true) {
	if(!M('Option')->get_option('site/mobile_version')) {
		return false;
	}
	if(!$cookie) {
		return true;
	}
	$ua = ACookie::get('user_agent');
	return (!empty($ua) and 'pc' != $ua);
}

?>