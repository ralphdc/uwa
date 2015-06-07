<?php

/**
 *--------------------------------------
 * uwa:ac_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaAcList {
	public function get_tagStr($a) {
		$cid = 'cid';
		$issub = 'no';
		$row = 100;
		$key = 'key';
		$as = 'channel';

		/* channel id */
		if(!isset($a['cid']) or empty($a['cid'])) {
			if(isset($a['issub']) and 'yes' == $a['issub']) /* as sub cycle */ {
				$cid = "'.C('AC_ID').'";
				$issub = 'yes';
			}
			else {
				$cid = "'.(isset(\$AC_ID) ? \$AC_ID : 0).'";
			}
		}
		elseif('all' == $a['cid']) {
			$cid = 0;
		}
		else {
			if(strpos($a['cid'], '$')) {
				$cid = "'.(!empty(" . substr($a['cid'], 2, -2) . ") ? '{$a['cid']}' : 0).'";
			}
			else {
				$cid = $a['cid'];
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
		$str .= "\$var_ac = '_ac_list_{$cid}_{$issub}_{$row}';\r\n";
		$str .= "\$\$var_ac = S('~list/~'.ltrim(\$var_ac, '_'));\r\n";
		$str .= "if(empty(\$\$var_ac)) {\r\n";
		$str .= "	\$\$var_ac = M('ArchiveChannel')->get_channelList(0, '{$cid}', 1, '{$row}', 1);\r\n";
		$str .= "	S('~list/~'.ltrim(\$var_ac, '_'), \$\$var_ac);\r\n";
		$str .= "}\r\n";
		$str .= "if(\$\$var_ac) : foreach(\$\$var_ac as \${$key} => \${$as}): \r\n";
		$str .= "C('AC_ID', \${$as}['archive_channel_id']);\r\n";
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php C('AC_ID', null); endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>