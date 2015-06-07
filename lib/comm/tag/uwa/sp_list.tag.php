<?php

/**
 *--------------------------------------
 * uwa:sp_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaSpList {
	public function get_tagStr($a) {
		$group = "'group'";
		$offset = 0;
		$row = 10;
		$key = 'k';
		$as = 'item';

		$where = "	\$where = array();\r\n";

		/* group */
		if(isset($a['group']) and !empty($a['group'])) {
			if(strpos($a['group'], '$')) {
				$where .= "	if(!empty(" . substr($a['group'], 2, -2) . ")) {\r\n";
				$where .= "		\$where['__SINGLE_PAGE__.sp_group'] = array('EQ', '{$a['group']}');\r\n";
				$where .= "	}\r\n";
			}
			else {
				$where .= "	\$where['__SINGLE_PAGE__.sp_group'] = array('EQ', '{$a['group']}');\r\n";
			}
			$group = $a['group'];
		}
		else {
			$where .= "	if(!empty(\$GROUP)) {\r\n";
			$where .= "		\$where['__SINGLE_PAGE__.sp_group'] = array('EQ', \$GROUP);\r\n";
			$where .= "	}\r\n";
			$group = "'.(isset(\$GROUP) ? \$GROUP : 'all').'";
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
		$str .= "\$var_sp = '_sp_list_{$group}_{$offset}_{$row}';\r\n";
		$str .= "\$\$var_sp = F('~list/~'.ltrim(\$var_sp, '_'));\r\n";
		$str .= "if(empty(\$\$var_sp)) {\r\n";
		$str .= $where;
		$str .= "	\$\$var_sp = M('SinglePage')->get_singlePageList(\$where, '`sp_display_order` ASC', '{$offset},{$row}');\r\n";
		$str .= "	F('~list/~'.ltrim(\$var_sp, '_'), \$\$var_sp);\r\n";
		$str .= "}\r\n";
		$str .= "if(\$\$var_sp) : foreach(\$\$var_sp as \${$key} => \${$as}): \r\n";
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>