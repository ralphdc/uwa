<?php

/**
 *--------------------------------------
 * uwa:vote
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-14
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaVote {
	public function get_tagStr($a) {
		$id = 'id';
		$tpl = 'clip/vote/tag';

		/* vote id  */
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

		/* vote tpl  */
		if(isset($a['tpl']) and !empty($a['tpl'])) {
			if(strpos($a['tpl'], '$')) {
				$tpl = "'.(!empty(" . substr($a['tpl'], 2, -2) . ") ? '{$a['tpl']}' : '{$tpl}').'";
			}
			else {
				$tpl = $a['tpl'];
			}
		}

		$str = "<?php\r\n";
		$str .= "\$var_vi = '_vi_{$id}';\r\n";
		$str .= "\$\$var_vi = S('~vi/~'.ltrim(\$var_vi, '_'));\r\n";
		$str .= "if(empty(\$\$var_vi)) {\r\n";
		$str .= "	\$\$var_vi = M('Vote')->get_voteInfo('{$id}');\r\n";
		$str .= "	S('~vi/~'.ltrim(\$var_vi, '_'), \$\$var_vi);\r\n";
		$str .= "}\r\n";
		$str .= "if(!empty(\$\$var_vi)) {\r\n";
		$str .= "	\$_VI = \$\$var_vi;\r\n";
		$str .= "	\$this->assign('_VI', \$_VI);\r\n";
		/* template */
		if(isset($a['tpl']) and !empty($a['tpl'])) {
			$str .= "	\$vote = \$this->fetch('home/{$tpl}');\r\n";
		}
		else {
			$str .= "	\$vote = \$this->fetch('home/'.\$_VI['v_tpl_tag']);\r\n";
		}
		$str .= "	echo \$vote;\r\n";
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