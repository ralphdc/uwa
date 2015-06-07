<?php

/**
 *--------------------------------------
 * flink category
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FlinkCategoryModl extends Modl {
	public function get_categoryList() {
		$_FCL = F('~fcl');
		if(empty($_FCL)) {
			$_FCL = $this->order('fc_display_order asc')->select();
			F('~fcl', $_FCL);
		}
		return $_FCL;
	}

	public function add_category($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['flink_category_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~fcl', null);

		return $result;
	}

	public function edit_category($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~fcl', null);

		return $result;
	}

	public function delete_category($flinkCategoryId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($flinkCategoryId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete flink */
		$flinkId = M('Flink')->field('flink_id')->where(array('flink_category_id' => array('EQ', $flinkCategoryId)))->select();
		if(!empty($flinkId)) {
			foreach($flinkId as $flinkId) {
				M('Flink')->delete_flink($flinkId['flink_id']);
			}
		}

		F('~fcl', null);

		return $result;
	}
}

?>