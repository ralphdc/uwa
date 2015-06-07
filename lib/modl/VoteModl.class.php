<?php

/**
 *--------------------------------------
 * Vote
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-14
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class VoteModl extends Modl {
	public function get_voteList($status = true) {
		$_VL = $this->order('`vote_id` DESC')->select();
		if(!empty($_VL) and $status) {
			foreach($_VL as $k => $vote) {
				if(1 != $vote['v_status']) {
					unset($_VL[$k]);
				}
			}
		}
		return $_VL;
	}

	public function add_vote($data) {
		$result = array('data' => '', 'error' => '');

		$data['v_start_time'] = strtotime($data['v_start_time']);
		$data['v_end_time'] = strtotime($data['v_end_time']);

		$data['v_option_set'] = serialize($data['v_option_set']);
		if(MAGIC_QUOTES_GPC) {
			$data['v_option_set'] = addslashes($data['v_option_set']);
		}

		unset($data['vote_id']);
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

	public function get_voteInfo($voteId) {
		$_VI = $this->where(array('vote_id' => array('EQ', $voteId)))->find();
		if(!empty($_VI)) {
			$_VI['v_option_set'] = unserialize($_VI['v_option_set']);
			if(MAGIC_QUOTES_GPC) {
				$_VI['v_option_set'] = stripslashes_array($_VI['v_option_set']);
			}
			$_VI['v_votes'] = 0;
			foreach($_VI['v_option_set'] as $k => $vo) {
				$_VI['v_votes'] += $vo['votes'];
			}
			foreach($_VI['v_option_set'] as $k => $vo) {
				$_VI['v_option_set'][$k]['percentage'] = number_format($vo['votes'] / $_VI['v_votes'] * 100, 2, '.', '');
			}
		}
		return $_VI;
	}

	public function edit_vote($data) {
		$result = array('data' => '', 'error' => '');

		if(isset($data['v_start_time'])) {
			$data['v_start_time'] = strtotime($data['v_start_time']);
		}
		if(isset($data['v_end_time'])) {
			$data['v_end_time'] = strtotime($data['v_end_time']);
		}
		if(isset($data['v_option_set'])) {
			$data['v_option_set'] = serialize($data['v_option_set']);
			if(MAGIC_QUOTES_GPC) {
				$data['v_option_set'] = addslashes($data['v_option_set']);
			}
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* update upload */
		M('Upload')->update_upload($data['vote_id']);

		return $result;
	}

	public function delete_vote($voteId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($voteId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete vote record */
		M('VoteRecord')->where(array('vote_id' => array('EQ', $voteId)))->delete();

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'vote'), 'u_item_id' => array('EQ', $voteId)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', 'ad'), 'u_item_id' => array('EQ', $voteId)))->delete();

		return $result;
	}

	public function clear_vote_record($voteId) {
		$result = array('data' => '', 'error' => '');

		if(false === M('VoteRecord')->where(array('vote_id' => array('EQ', $voteId)))->delete()) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>