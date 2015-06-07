<?php

/**
 *--------------------------------------
 * custom list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-01
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomListModl extends Modl {
	public function get_customListList($where = '', $order = '', $limit = 10) {
		$_CLL = $this->where($where)->order($order)->limit($limit)->select();
		return $_CLL;
	}

	public function get_customListInfo($customListId) {
		$_CLI = $this->where(array('custom_list_id' => array('EQ', $customListId)))->find();
		if(!empty($_CLI)) {
			$_CLI['cl_config'] = unserialize($_CLI['cl_config']);
			if(MAGIC_QUOTES_GPC) {
				$_CLI['cl_config'] = stripslashes_array($_CLI['cl_config']);
			}
		}
		return $_CLI;
	}

	public function add_custom_list($data) {
		$result = array('data' => '', 'error' => '');

		$data['cl_config'] = serialize($data['cl_config']);
		if(MAGIC_QUOTES_GPC) {
			$data['cl_config'] = addslashes($data['cl_config']);
		}

		unset($data['custom_list_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_custom_list($data) {
		$result = array('data' => '', 'error' => '');

		$data['cl_config'] = serialize($data['cl_config']);
		if(MAGIC_QUOTES_GPC) {
			$data['cl_config'] = addslashes($data['cl_config']);
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_custom_list($customListId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($customListId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function update_update_time($customListId) {
		$result = array('data' => '', 'error' => '');

		$date['cl_update_time'] = time();
		$date['custom_list_id'] = $customListId;

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

}

?>