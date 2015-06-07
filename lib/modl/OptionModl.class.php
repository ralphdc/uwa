<?php

/**
 *--------------------------------------
 * option
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-15
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class OptionModl extends Modl {
	/* get system option. $key: page_size, page_size/article */
	public function get_option($key = null) {
		$option = F('~_O');
		if(empty($option)) {
			$option = array();
			$_O = $this->select();
			foreach($_O as $k => $v) {
				if('array' == $v['o_value_type']) {
					$v['o_value'] = unserialize($v['o_value']);
					if(MAGIC_QUOTES_GPC) {
						$v['o_value'] = stripslashes_array($v['o_value']);
					}
				}
				$option[$v['o_key']] = $v['o_value'];
			}
			F('~_O', $option);
		}

		if(is_string($key)) {
			$key = explode('/', $key);
			foreach($key as $key) {
				$option = $option[$key];
			}
		}
		elseif(is_array($key)) {
			$_O = array();
			foreach($key as $key) {
				$_O[$key] = $option[$key];
			}
			$option = $_O;
		}
		return $option;
	}

	/* save */
	public function save_option($option) {
		if(is_array($option)) {
			foreach($option as $k => $v) {
				$where['o_key'] = array('EQ', $k);
				$o = $this->where($where)->find();
				if('array' == $o['o_value_type']) {
					$v = serialize($v);
					if(MAGIC_QUOTES_GPC) {
						$v = addslashes($v);
					}
				}
				$this->where($where)->set_field('o_value', $v);
				F('~_O', null);
			}
			/* update upload */
			M('Upload')->update_upload(-1);
			return true;
		}
		return false;
	}

}

?>