<?php

/**
 *--------------------------------------
 * ad space
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdSpaceModl extends Modl {
	public function get_spaceList($status = true) {
		$_ASL = F('~ad/~asl');
		if(empty($_AML)) {
			$_ASL = $this->select();
			F('~ad/~asl', $_ASL);
		}
		if(!empty($_ASL) and $status) {
			foreach($_ASL as $k => $space) {
				if(1 != $space['as_status']) {
					unset($_ASL[$k]);
				}
			}
		}
		return $_ASL;
	}

	public function get_spaceInfo($adSpaceId) {
		$_ASI = F('~ad/~asi_' . $adSpaceId);
		if(empty($_ASI)) {
			$_ASI = $this->where(array('ad_space_id' => array('EQ', $adSpaceId)))->find();
			F('~ad/~asi_' . $adSpaceId, $_ASI);
		}
		//print_r($_ASI);exit;
// 		/Array ( [ad_space_id] => 9 [as_name] => 首页头图 [as_type] => banner [as_width] => 1920 [as_height] => 420 [as_default] => [as_status] => 1 ) 
		return $_ASI;
	}

	public function add_space($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['ad_space_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~ad/~asl', null);

		return $result;
	}

	public function edit_space($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~ad/~asi_' . $data['ad_space_id'], null);
		F('~ad/~asl', null);

		return $result;
	}

	public function delete_space($adSpaceId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($adSpaceId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete ad */
		$adId = M('Ad')->field('ad_id')->where(array('ad_space_id' => array('EQ', $adSpaceId)))->select();
		if(!empty($adId)) {
			foreach($adId as $adId) {
				M('Ad')->delete_ad($adId['ad_id']);
			}
		}

		F('~ad/~asi_' . $adSpaceId, null);
		F('~ad/~asl', null);

		return $result;
	}
}

?>