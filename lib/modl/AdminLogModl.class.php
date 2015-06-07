<?php

/**
 *--------------------------------------
 * admin log
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-27
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminLogModl extends Modl {
	public function get_logList($where, $order = '`al_time` DESC', $limit = 3) {
		$_ALL = $this->where($where)->order($order)->limit($limit)->select();
		return $_ALL;
	}

	public function add_log($userid, $operation, $status = 1) {
		$al_data = array();
		$al_data['m_userid'] = $userid;
		$al_data['al_operation'] = $operation;
		$al_data['al_status'] = $status;
		$al_data['al_time'] = time();
		$al_data['al_ip'] = AServer::get_ip();
		M('AdminLog')->insert($al_data);
	}
}

?>