<?php

/**
 *--------------------------------------
 * uwa:tag_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-11-17
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaTagList {
	public function get_tagStr($a) {
		$days = 'days';
		$orderby = 'orderby';
		$offset = 0;
		$row = 10;
		$key = 'k';
		$as = 'item';

		$where = "	\$where = array();\r\n";
		/* time limit */
		if(isset($a['days']) and !empty($a['days'])) {
			if(strpos($a['days'], '$')) {
				$where .= "	if(0 < " . substr($a['days'], 2, -2) . ") {\r\n";
				$where .= "		\$where['t_add_time'] = array('GT', time() - 86400*('{$a['days']}'));\r\n";
				$where .= "	}\r\n";
			}
			else {
				$where .= "	\$where['t_add_time'] = array('GT', time() - 86400*('{$a['days']}'));\r\n";
			}
			$days = $a['days'];
		}

		/* order by */
		if(isset($a['orderby']) and !empty($a['orderby'])) {
			if(strpos($a['orderby'], '$')) {
				$order = "'.(!empty(" . substr($a['orderby'], 2, -2) . ") ? '`{$a['orderby']}`' : '`t_update_time`').'";
			}
			else {
				$order = "`{$a['orderby']}`";
			}
			if(isset($a['order']) and !empty($a['order'])) {
				$order .= " {$a['order']}";
				$orderby = $a['orderby'] . '_' . $a['order'];
			}
			else {
				$orderby = $a['orderby'] . '_order';
			}
		}
		if(empty($order)) {
			$order = '`t_update_time` DESC';
		}

		/* limit strat row */
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
		$str .= "\$var_a = '_tag_list_{$days}_{$orderby}_{$offset}_{$row}';\r\n";
		$str .= "\$\$var_a = S('~list/~'.ltrim(\$var_a, '_'));\r\n";
		$str .= "if(empty(\$\$var_a)) {\r\n";
		$str .= $where;
		$str .= "	\$\$var_a = M('Tag')->get_tagList(\$where, '{$order}', '{$offset},{$row}');\r\n";
		$str .= "	S('~list/~'.ltrim(\$var_a, '_'), \$\$var_a);\r\n";
		$str .= "}\r\n";
		$str .= "if(\$\$var_a) : foreach(\$\$var_a as \${$key} => \${$as}): \r\n";
		$str .= $titleLenStr;
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>