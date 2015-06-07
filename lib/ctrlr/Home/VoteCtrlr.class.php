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

class VoteCtrlr extends IndexCtrlr {
	public function post_vote_do() {
		$voteId = intval(ARequest::get('vote_id'));

		$_VI = M('Vote')->get_voteInfo($voteId);
		if(empty($_VI) or 1 != $_VI['v_status']) {
			$this->error(L('VOTE_IS_NOT_ACTIVE'), __APP__);
		}

		/* out of vote validity period */
		if((time() < $_VI['v_start_time'] or time() > $_VI['v_end_time']) and 1 == $_VI['v_time_limit']) {
			if(1 == $_VI['v_allow_view']) {
				$this->error(L('OUT_OF_VOTE_VALIDITY_PERIOD'), Url::U('vote/show_vote_result?vote_id=' . $voteId));
			}
			$this->error(L('OUT_OF_VOTE_VALIDITY_PERIOD'), __APP__);
		}

		/* check vote interval */
		$_VRI = M('VoteRecord')->where(array('vote_id' => array('EQ', $voteId), 'vr_add_ip' => array('EQ', AServer::get_ip())))->order('`vote_record_id` DESC')->find();
		if(!empty($_VRI) and time() < $_VRI['vr_add_time'] + $_VI['v_interval']) {
			if(1 == $_VI['v_allow_view']) {
				$this->error(L('DO_NOT_REPEAT_VOTE'), Url::U('vote/show_vote_result?vote_id=' . $voteId));
			}
			$this->error(L('DO_NOT_REPEAT_VOTE'), __APP__);
		}

		/* insert vote record */
		$data = array();
		$data['vote_id'] = $voteId;
		$data['vr_add_time'] = time();
		$data['vr_add_ip'] = AServer::get_ip();
		M('VoteRecord')->insert($data);

		/* update vote data */
		$data = array();
		$data['vote_id'] = $voteId;

		$voteItem = ARequest::get('vote_item');
		if(0 == $_VI['v_is_multi']) {
			$voteItem = array($voteItem);
		}

		foreach($_VI['v_option_set'] as $k => $vo) {
			$data['v_option_set'][$k]['description'] = $vo['description'];
			$data['v_option_set'][$k]['votes'] = $vo['votes'];
		}
		foreach($voteItem as $k) {
			$k = intval($k);
			if(isset($data['v_option_set'][$k])) {
				$data['v_option_set'][$k]['votes'] = $data['v_option_set'][$k]['votes'] + 1;
			}
		}

		$result = M('Vote')->edit_vote($data);
		if(!empty($result['error'])) {
			if(1 == $_VI['v_allow_view']) {
				$this->error(L('POST_VOTE_FAILED'), Url::U('vote/show_vote_result?vote_id=' . $voteId));
			}
			$this->error(L('POST_VOTE_FAILED'), __APP__);
		}

		if(1 == $_VI['v_allow_view']) {
			$this->success(L('POST_VOTE_SUCCESS'), Url::U('vote/show_vote_result?vote_id=' . $voteId));
		}
		$this->success(L('POST_VOTE_SUCCESS'), __APP__);
	}

	public function show_vote_result() {
		$voteId = intval(ARequest::get('vote_id'));

		$_VI = M('Vote')->get_voteInfo($voteId);
		if(empty($_VI) or 1 != $_VI['v_status'] or 1 != $_VI['v_allow_view']) {
			halt('', true, true);
		}

		/* out of vote validity period */
		if((time() < $_VI['v_start_time'] or time() > $_VI['v_end_time']) and 1 == $_VI['v_time_limit']) {
		}

		$this->assign('_V', $_VI);

		/* current position */
		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('VOTE'), 'url' => ''),
			array('name' => $_VI['v_name'], 'url' => ''))
		);
		$this->display('home/' . $_VI['v_tpl_result']);
	}
}

?>