<?php

/**
 *--------------------------------------
 * ad
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdModl extends Modl {
	public function get_adList($adSpaceId = '', $timeLimit = false) {
		$where = array();
		if(!empty($adSpaceId)) {
			$where['__AD__.ad_space_id'] = array('EQ', $adSpaceId);
		}
		$_AL = $this->order('`as`.ad_space_id ASC, a_display_order ASC')->join('__AD_SPACE__ AS `as` ON `as`.ad_space_id = __AD__.ad_space_id')->where($where)->select();
		if($timeLimit) {
			foreach($_AL as $k => $v) {
				if((time() < $v['a_start_time'] or time() > $v['a_end_time']) and 1 == $v['a_time_limit']) {
					unset($_AL[$k]);
				}
			}
		}

		return $_AL;
	}

	public function get_adInfo($adId) {
		$_AI = $this->join('__AD_SPACE__ AS `as` ON `as`.ad_space_id = __AD__.ad_space_id')->where(array('__AD__.ad_id' => array('EQ', $adId)))->find();
		return $_AI;
	}

	public function add_ad($data) {
		$result = array('data' => '', 'error' => '');

		$data['a_start_time'] = strtotime($data['a_start_time']);
		$data['a_end_time'] = strtotime($data['a_end_time']);

		unset($data['ad_id']);
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

	public function edit_ad($data) {
		$result = array('data' => '', 'error' => '');

		if(isset($data['a_start_time'])) {
			$data['a_start_time'] = strtotime($data['a_start_time']);
		}
		if(isset($data['a_end_time'])) {
			$data['a_end_time'] = strtotime($data['a_end_time']);
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* update upload */
		M('Upload')->update_upload($data['ad_id']);

		return $result;
	}

	public function delete_ad($adId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->where(array('ad_id' => array('EQ', $adId)))->find();
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->delete($adId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'ad'), 'u_item_id' => array('EQ', $adId)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', 'ad'), 'u_item_id' => array('EQ', $adId)))->delete();

		return $result;
	}
}

?>