<?php

/**
 *--------------------------------------
 * guestbook
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class GuestbookModl extends Modl {
	public function get_guestbookList($where = '', $order = '', $limit = 10, $filter = true) {
		$_GL = $this->where($where)->order($order)->limit($limit)->select();
		if(!empty($_GL) and $filter) {
			foreach($_GL as $k => $v) {
				if(2 == $v['g_status']) {
					$_GL[$k]['g_author'] = M('Report')->filter_content($v['g_author']);
					$_GL[$k]['g_content'] = M('Report')->filter_content($v['g_content']);
				}
			}
		}
		return $_GL;
	}

	public function get_guestbookInfo($guestbookId) {
		$_GI = $this->where(array('guestbook_id' => array('EQ', $guestbookId)))->find();
		return $_GI;
	}

	public function pass_guestbook($guestbookId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->where(array('guestbook_id' => array('EQ', $guestbookId)))->set_field('g_status', 1)) {
			$result['error'] = L('PASS_FAILED');
			return $result;
		}

		return $result;
	}

	public function add_guestbook($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['guestbook_id']);
		if(false === $this->insert($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function edit_guestbook($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_guestbook($guestbookId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($guestbookId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_same_ip($guestbookId) {
		$result = array('data' => '', 'error' => '');

		$_GI = $this->get_guestbookInfo($guestbookId);
		if(empty($_GI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('g_add_ip' => array('EQ', $_GI['g_add_ip'])))->delete()) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

}

?>