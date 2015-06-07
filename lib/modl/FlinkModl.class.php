<?php

/**
 *--------------------------------------
 * flink
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FlinkModl extends Modl {
	public function get_flinkList($where = '', $order = '', $limit = 200) {
		$_FL = $this->join('__FLINK_CATEGORY__ AS fc ON fc.flink_category_id = __FLINK__.flink_category_id')->where($where)->order($order)->limit($limit)->select();
		return $_FL;
	}

	public function get_flinkInfo($flinkId) {
		$_FI = $this->join('__FLINK_CATEGORY__ AS fc ON fc.flink_category_id = __FLINK__.flink_category_id')->where(array('flink_id' => array('EQ', $flinkId)))->find();
		return $_FI;
	}

	public function add_flink($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['flink_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		/* update upload */
		M('Upload')->update_upload($_t_id);

		return $result;
	}

	public function edit_flink($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* update upload */
		M('Upload')->update_upload($data['flink_id']);

		return $result;
	}

	public function delete_flink($flinkId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($flinkId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete upload file */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'flink'), 'u_item_id' => array('EQ', $flinkId)))->select();
		if(!empty($_UL)) {
			foreach($_UL as $u) {
				if(__HOST__ == substr($u['u_src'], 0, strlen(__HOST__))) {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . substr($u['u_src'], strlen(__HOST__))));
				}
				else {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . $u['u_src']));
				}
			}
		}
		M('Upload')->where(array('u_item_type' => array('EQ', 'flink'), 'u_item_id' => array('EQ', $flinkId)))->delete();

		return $result;
	}

}

?>