<?php

/**
 *--------------------------------------
 * uwa tag
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-25
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwa {
	public function parse_tag($params) {
		$params = explode(' ', $params, 2);
		/* get tag */
		$tag = $params[0];

		/* get parameter */
		$a = array();
		if(isset($params[1])) {
			$params[1] = $params[1] . ' ';
			preg_match_all('/.*?(\s*.*?=.*?[\"|\'].*?[\"|\']\s).*?/si', $params[1], $arr);
			if(isset($arr[1]) and !empty($arr[1])) {
				foreach($arr[1] as $v) {
					$t = explode('=', trim(str_replace(array('"', "'"), '', $v)));
					$a = array_merge($a, array(trim($t[0]) => trim($t[1])));
				}
			}
		}

		foreach($a as $k => $v) {
			/* variable in prarmeter $a.b.c */
			if('$' == substr($v, 0, 1)) {
				$ak = '$';
				$_var = explode('.', substr($v, 1));
				foreach($_var as $_k => $_var) {
					if(0 == $_k) {
						$ak .= $_var;
					}
					else {
						$ak .= "['" . $_var . "']";
					}
				}
				$a[$k] = "'.{$ak}.'";
			}
		}

		if(!is_file(LIB_COMM_PATH . '/tag/uwa/' . $tag . '.tag.php')) {
			return '';
		}

		import('tag.uwa.' . $tag . '#tag', LIB_COMM_PATH, '.php');
		$className = 'TagUwa' . parse_name(strtolower($tag), 1);
		$tagClass = get_instance($className);
		$str = $tagClass->get_tagStr($a);

		return $str;
	}

	public function parse_tag_end($tag) {
		if(!is_file(LIB_COMM_PATH . '/tag/uwa/' . $tag . '.tag.php')) {
			return '';
		}

		import('tag.uwa.' . $tag . '#tag', LIB_COMM_PATH, '.php');
		$className = 'TagUwa' . parse_name(strtolower($tag), 1);
		$tagClass = get_instance($className);
		$str = $tagClass->get_tagEndStr();

		return $str;
	}
}

?>