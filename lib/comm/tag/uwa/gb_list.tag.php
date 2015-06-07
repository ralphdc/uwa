<?php

/**
 *--------------------------------------
 * uwa:gb_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaGbList {
	public function get_tagStr($a) {
		$offset = 0;
		$row = 10;
		$key = 'k';
		$as = 'item';

		$where = "	\$where = array();\r\n";
		$where .= "	\$where['__GUESTBOOK__.g_status'] = array('GT', 0);\r\n";

		/* limit start row */
		if(isset($a['offset']) and !empty($a['offset'])) {
			if(strpos($a['offset'], '$')) {
				$offset = "'.(!empty(" . substr($a['offset'], 2, -2) . ") ? '{$a['offset']}' : '{$offset}').'";
			}
			else {
				$offset = $a['offset'];
			}
		}

		/* row */
		if(isset($a['row']) and !empty($a['row'])) {
			if(strpos($a['row'], '$')) {
				$row = "'.(!empty(" . substr($a['row'], 2, -2) . ") ? '{$a['row']}' : '{$row}').'";
			}
			else {
				$row = $a['row'];
			}
		}

		/* key */
		if(isset($a['key']) and !empty($a['key'])) {
			if(strpos($a['key'], '$')) {
				$key = "'.(!empty(" . substr($a['key'], 2, -2) . ") ? '{$a['key']}' : '{$key}').'";
			}
			else {
				$key = $a['key'];
			}
		}

		/* as */
		if(isset($a['as']) and !empty($a['as'])) {
			if(strpos($a['as'], '$')) {
				$as = "'.(!empty(" . substr($a['as'], 2, -2) . ") ? '{$a['as']}' : '{$as}').'";
			}
			else {
				$as = $a['as'];
			}
		}

		$str = "<?php\r\n";
		$str .= "\$var_gb = '_gb_list_{$offset}_{$row}';\r\n";
		$str .= "\$\$var_gb = S('~list/~'.ltrim(\$var_gb, '_'));\r\n";
		$str .= "if(empty(\$\$var_gb)) {\r\n";
		$str .= $where;
		$str .= "	\$\$var_gb = M('Guestbook')->get_guestbookList(\$where, '`g_add_time` DESC', '{$offset},{$row}');\r\n";
		$str .= "	S('~list/~'.ltrim(\$var_gb, '_'), \$\$var_gb);\r\n";
		$str .= "}\r\n";
		$str .= "if(\$\$var_gb) : foreach(\$\$var_gb as \${$key} => \${$as}): \r\n";
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>