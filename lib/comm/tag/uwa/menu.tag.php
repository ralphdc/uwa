<?php

/**
 *--------------------------------------
 * uwa:menu
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaMenu {
	public function get_tagStr($a) {
		$str = '';
		$key = 'k';
		$as = 'm';

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

		if(isset($a['alias']) and !empty($a['alias'])) {
			$alias = $a['alias'];
			$str = "<?php\r\n";
			$str .= "\$_menu_{$alias} = M('Menu')->get_menuList('{$alias}');\r\n";
			$str .= "if(is_array(\$_menu_{$alias})) : foreach(\$_menu_{$alias} as \${$key} => \${$as}): \r\n";
			$str .= "?>\r\n";
		}
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>