<?php

/**
 *--------------------------------------
 * member notify
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-13
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberNotifyModl extends Modl {
	public function get_notifyList($where, $order, $limit) {
		$_MNL = $this->where($where)->order($order)->limit($limit)->select();
		return $_MNL;
	}

	public function add_notify($data) {
		$result = array('data' => '', 'error' => '');

		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function delete_notify($memberNotifyId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($memberNotifyId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function send_notify($mnMID, $mnTitle, $mnContent) {
		$result = array('data' => '', 'error' => '');

		$data = array();
		$data['mn_admin_userid'] = ASession::get('m_userid');

		if(empty($data['mn_admin_userid'])) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		$data['mn_status'] = 0;
		$data['mn_send_time'] = time();
		$data['mn_m_id'] = $mnMID;
		$data['mn_title'] = $mnTitle;
		$data['mn_content'] = $mnContent;

		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}
}

?>