<?php

/**
 *--------------------------------------
 * member favorite
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-16
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberFavoriteModl extends Modl {
	public function get_favoriteList($where, $order, $limit = 500) {
		$_MFL = $this->where($where)->order($order)->limit($limit)->select();
		return $_MFL;
	}

	public function delete_favorite($memberFavoriteId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($memberFavoriteId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>