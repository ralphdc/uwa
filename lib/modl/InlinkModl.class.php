<?php

/**
 *--------------------------------------
 * Inner Link
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-29
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class InlinkModl extends Modl {
	public function get_inlinkList($limit = 10, $random = false) {
		if($random) {
			$where['`inlink_id`'] = array('EXP', ' >= ((SELECT MAX(`inlink_id`) FROM __INLINK__) - (SELECT MIN(`inlink_id`) FROM __INLINK__)) * RAND() + (SELECT MIN(`inlink_id`) FROM __INLINK__) ');
			$_IL = $this->where($where)->limit($limit)->select();
		}
		else {
			$_IL = $this->order('`inlink_id` DESC')->limit($limit)->select();
		}
		return $_IL;
	}

	public function get_inlinkInfo($inlinkId) {
		$_II = $this->where(array('inlink_id' => array('EQ', $inlinkId)))->find();
		return $_II;
	}

	public function add_inlink($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['inlink_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_inlink($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_inlink($inlinkId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($inlinkId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function inlink_exsit($ilWord) {
		$_II = $this->where(array('il_word' => array('EQ', $ilWord)))->find();
		return empty($_II) ? false : true;
	}
}

?>