<?php

/**
 *--------------------------------------
 * uwa:ad
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaAd {
	public function get_tagStr($a) {
		$id = 'id';
		$tpl = 'clip/ad/tag/code';

		/* ad id  */
		if(isset($a['id']) and !empty($a['id'])) {
			if(strpos($a['id'], '$')) {
				$id = "'.(!empty(" . substr($a['id'], 2, -2) . ") ? '{$a['id']}' : '{$id}').'";
			}
			else {
				$id = $a['id'];
			}
		}
		else {
			return '';
		}

		/* ad tpl  */
		if(isset($a['tpl']) and !empty($a['tpl'])) {
			if(strpos($a['tpl'], '$')) {
				$tpl = "'.(!empty(" . substr($a['tpl'], 2, -2) . ") ? '{$a['tpl']}' : '{$tpl}').'";
			}
			else {
				$tpl = $a['tpl'];
			}
		}

		$str = "<?php\r\n";
		$str .= "\$var_asi = '_asi_{$id}';\r\n";
		$str .= "\$\$var_asi = M('AdSpace')->get_spaceInfo('{$id}');\r\n";
		$str .= "\$_ASI = \$\$var_asi;\r\n";
		$str .= "if(!empty(\$_ASI) and 1 == \$_ASI['as_status']) {\r\n";
		$str .= "	\$var_al = '_al_{$id}';\r\n";
		$str .= "	\$\$var_al = S('~list/~'.ltrim(\$var_al, '_'));\r\n";
		$str .= "	if(empty(\$\$var_al)) {\r\n";
		$str .= "		\$\$var_al = M('Ad')->get_adList('{$id}', true);\r\n";
		$str .= "		S('~list/~'.ltrim(\$var_al, '_'), \$\$var_al);\r\n";
		$str .= "	}\r\n";
		$str .= "	if(!empty(\$\$var_al)) {\r\n";
		$str .= "		\$_ASI['ad'] = \$\$var_al;\r\n";
		$str .= "		\$this->assign('_ASI', \$_ASI);\r\n";
		/* template */
		if(isset($a['tpl']) and !empty($a['tpl'])) {
			$str .= "		\$ad = \$this->fetch('home/{$tpl}');\r\n";
		}
		else {
			$str .= "		\$ad = \$this->fetch('home/clip/ad/tag/'.\$_ASI['as_type']);\r\n";
		}
		$str .= "		echo \$ad;\r\n";
		$str .= "	}\r\n";
		$str .= "	else {\r\n";
		$str .= "		echo \$_ASI['as_default'];\r\n";
		$str .= "	}\r\n";
		$str .= "}\r\n";
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = '';
		return $str;
	}
}

?>