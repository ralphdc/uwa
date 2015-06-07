<?php

/**
 *--------------------------------------
 * uwa:fl_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaFlList {
	public function get_tagStr($a) {
		$cid = 'cid';
		$type = 'type';
		$offset = 0;
		$row = 10;
		$key = 'k';
		$as = 'item';

		$where = "	\$where = array();\r\n";
		$where .= "	\$where['__FLINK__.f_status'] = array('EQ', 1);\r\n";

		/* category id */
		if(isset($a['cid']) and !empty($a['cid'])) {
			if(strpos($a['cid'], '$')) {
				$where .= "	if(!empty(" . substr($a['cid'], 2, -2) . ")) {\r\n";
				$where .= "		\$where['__FLINK__.flink_category_id'] = array('IN', '{$a['cid']}');\r\n";
				$where .= "	}\r\n";
			}
			else {
				$where .= "	\$where['__FLINK__.flink_category_id'] = array('IN', '{$a['cid']}');\r\n";
			}
			$cid = $a['cid'];
		}

		/* show type */
		if(isset($a['type']) and !empty($a['type'])) {
			if('text' == $a['type']) {
				$where .= "	\$where['__FLINK__.f_show_type'] = array('EQ', 0);\r\n";

			}
			elseif('logo' == $a['type']) {
				$where .= "	\$where['__FLINK__.f_show_type'] = array('EQ', 1);\r\n";
			}
			elseif(strpos($a['type'], '$')) {
				$where .= "	if('text' == " . substr($a['type'], 2, -2) . ") {\r\n";
				$where .= "		\$where['__FLINK__.f_show_type'] = array('EQ', 0);\r\n";
				$where .= "	}\r\n";
				$where .= "	elseif('logo' == " . substr($a['type'], 2, -2) . ") {\r\n";
				$where .= "		\$where['__FLINK__.f_show_type'] = array('EQ', 1);\r\n";
				$where .= "	}\r\n";
			}
			$type = $a['type'];
		}

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
		$str .= "\$var_fl = '_flink_list_{$cid}_{$type}_{$offset}_{$row}';\r\n";
		$str .= "\$\$var_fl = F('~list/~'.ltrim(\$var_fl, '_'));\r\n";
		$str .= "if(empty(\$\$var_fl)) {\r\n";
		$str .= $where;
		$str .= "	\$\$var_fl = M('Flink')->get_flinkList(\$where, '`f_display_order` ASC', '{$offset},{$row}');\r\n";
		$str .= "	F('~list/~'.ltrim(\$var_fl, '_'), \$\$var_fl);\r\n";
		$str .= "}\r\n";
		$str .= "if(\$\$var_fl) : foreach(\$\$var_fl as \${$key} => \${$as}): \r\n";
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>