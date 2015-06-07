<?php

/**
 *--------------------------------------
 * string filter
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-11-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AFilter {
	public static function safeHtml($string, $allowTags = 'table|tbody|tfoot|th|tr|td|div|p|ul|ol|li|dl|dt|dd|strong|em|b|i|u|a|span|img|br|object|param|embed|sup|sub|h1|h2|h3|h4|h5|h6|h7|blockquote|hr') {
		if(!is_scalar($string)) {
			return '';
		}

		$string = str_replace('[', '&#091;', $string);
		$string = str_replace(']', '&#093;', $string);
		$string = str_replace('|', '&#124;', $string);
		/* br */
		$string = preg_replace('/<br(\s\/)?' . '>/i', '[br]', $string);
		$string = preg_replace('/(\[br\]\s*){1,}/i', '[br]', $string);
		/*
		while(preg_match('/(<[^><]+)(lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i', $string, $mat)) {
			$string = str_replace($mat[0], $mat[1], $string);
		}
		while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $string, $mat)) {
			$string = str_replace($mat[0], $mat[1].$mat[3], $string);
		} */

		/* convert allowed html tags */
		while(preg_match('/<(' . $allowTags . ')>/i', $string, $mat)) {
			$string = str_replace($mat[0], str_replace(array('<', '>'), array('[', ']'), $mat[0]), $string);
		}
		while(preg_match('/<(' . $allowTags . ') [^><]*>/i', $string, $mat)) {
			$string = str_replace($mat[0], str_replace(array('<', '>'), array('[', ']'), $mat[0]), $string);
		}
		while(preg_match('/<\/(' . $allowTags . ')>/i', $string, $mat)) {
			$string = str_replace($mat[0], str_replace(array('<', '>'), array('[', ']'), $mat[0]), $string);
		}

		/* convert qoute */
		while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2=\[\]]+)\2([^\[\]]*\])/i', $string, $mat)) {
			$string = str_replace($mat[0], $mat[1] . '|' . $mat[3] . '|' . $mat[4], $string);
		}
		/* convert empty property */
		$string = str_replace(array('\'\'', '""'), '||', $string);
		/* filter error single quotes */
		while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i', $string, $mat)) {
			$string = str_replace($mat[0], str_replace($mat[1], '', $mat[0]), $string);
		}

		/* convert all other unlawful < > " */
		$string = str_replace('<', '&lt;', $string);
		$string = str_replace('>', '&gt;', $string);
		$string = str_replace('"', '&quot;', $string);

		$string = str_replace('[', '<', $string);
		$string = str_replace(']', '>', $string);
		$string = str_replace('|', '"', $string);
		return $string;
	}

	/* check word format */
	public static function is_word($string) {
		if(empty($string) or !is_string($string) or preg_match("/\W+/", $string)) {
 			/* \W:[^A-Za-z0-9_] */
			return false;
		}
		return true;
	}

	/* check userid format, [veriable] */
	public static function is_userid($string) {
		if(empty($string) or !is_string($string) or !preg_match("/^[a-zA-Z_][a-zA-Z0-9_]+$/", $string)) {
			return false;
		}
		return true;
	}

	/* check username format, [chinese,number,letter,_] */
	public static function is_username($string) {
		if(empty($string) or !is_string($string) or !preg_match("/^[\x7f-\xff\w]+$/", $string)) {
			return false;
		}
		return true;
	}

	/* check email format */
	public static function is_email($string) {
		if((strlen($string) <= 5) or !is_string($string) or !preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $string)) {
			return false;
		}
		return true;
	}

	/* deal with search keyword */
	public static function keyword($keyword) {
		if(!is_scalar($keyword)) {
			return '';
		}

		if(MAGIC_QUOTES_GPC) {
			$keyword = stripslashes(trim($keyword));
		}
		$keyword = str_replace('\'', '', $keyword);
		$keyword = str_replace('"', '', $keyword);
		$keyword = preg_replace('/\s+/', ' ', $keyword);

		return $keyword;
	}

	/* text */
	public static function text($string, $strlen = false) {
		if(!is_scalar($string)) {
			return '';
		}

		$string = htmlspecialchars($string);
		if(0 < $strlen) {
			$string = AString::msubstr($string, 0, $strlen);
		}
		return $string;
	}

	/* plain text */
	public static function plain_text($string, $strlen = false) {
		if(!is_scalar($string)) {
			return '';
		}

		$string = htmlspecialchars($string);
		$string = preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)+/i", ' ', strip_tags($string));
		if(0 < $strlen) {
			$string = AString::msubstr($string, 0, $strlen);
		}
		return $string;
	}

	/* trim  script */
	public static function trim_script($string) {
		if(!is_scalar($string)) {
			return '';
		}

		$string = preg_replace('/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $string);
		$string = preg_replace('/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $string);
		$string = preg_replace('/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $string);
		$string = preg_replace('/]]\>/si', ']] >', $string);
		return $string;
	}

	/* remove browser XSS hack string */
	public static function remove_XSS($val) {
		if(!is_scalar($val)) {
			return '';
		}

		$val = preg_replace('/([\x00-\x08\x0b-\x0c\x0e-\x19])/', '', $val);
		$search = 'abcdefghijklmnopqrstuvwxyz';
		$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$search .= '1234567890!@#$%^&*()';
		$search .= '~`";:?+/={}[]-_|\'\\';
		for($i = 0; $i < strlen($search); $i++) {
			$val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
			$val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
		}
		$ra1 = array(
			'javascript',
			'vbscript',
			'expression',
			'applet',
			'meta',
			'xml',
			'blink',
			'link',
			//'style',
			'script',
			'embed',
			'object',
			'iframe',
			'frame',
			'frameset',
			'ilayer',
			'layer',
			'bgsound',
			//'title',
			'base');
		$ra2 = array(
			'onabort',
			'onactivate',
			'onafterprint',
			'onafterupdate',
			'onbeforeactivate',
			'onbeforecopy',
			'onbeforecut',
			'onbeforedeactivate',
			'onbeforeeditfocus',
			'onbeforepaste',
			'onbeforeprint',
			'onbeforeunload',
			'onbeforeupdate',
			'onblur',
			'onbounce',
			'oncellchange',
			'onchange',
			'onclick',
			'oncontextmenu',
			'oncontrolselect',
			'oncopy',
			'oncut',
			'ondataavailable',
			'ondatasetchanged',
			'ondatasetcomplete',
			'ondblclick',
			'ondeactivate',
			'ondrag',
			'ondragend',
			'ondragenter',
			'ondragleave',
			'ondragover',
			'ondragstart',
			'ondrop',
			'onerror',
			'onerrorupdate',
			'onfilterchange',
			'onfinish',
			'onfocus',
			'onfocusin',
			'onfocusout',
			'onhelp',
			'onkeydown',
			'onkeypress',
			'onkeyup',
			'onlayoutcomplete',
			'onload',
			'onlosecapture',
			'onmousedown',
			'onmouseenter',
			'onmouseleave',
			'onmousemove',
			'onmouseout',
			'onmouseover',
			'onmouseup',
			'onmousewheel',
			'onmove',
			'onmoveend',
			'onmovestart',
			'onpaste',
			'onpropertychange',
			'onreadystatechange',
			'onreset',
			'onresize',
			'onresizeend',
			'onresizestart',
			'onrowenter',
			'onrowexit',
			'onrowsdelete',
			'onrowsinserted',
			'onscroll',
			'onselect',
			'onselectionchange',
			'onselectstart',
			'onstart',
			'onstop',
			'onsubmit',
			'onunload');
		$ra = array_merge($ra1, $ra2);

		$found = true;
		while($found == true) {
			$val_before = $val;
			for($i = 0; $i < sizeof($ra); $i++) {
				$pattern = '/';
				for($j = 0; $j < strlen($ra[$i]); $j++) {
					if($j > 0) {
						$pattern .= '(';
						$pattern .= '(&#[xX]0{0,8}([9ab]);)';
						$pattern .= '|';
						$pattern .= '|(&#0{0,8}([9|10|13]);)';
						$pattern .= ')*';
					}
					$pattern .= $ra[$i][$j];
				}
				$pattern .= '/i';
				$replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2);
				$val = preg_replace($pattern, $replacement, $val);
				if($val_before == $val) {
					$found = false;
				}
			}
		}
		return $val;
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>