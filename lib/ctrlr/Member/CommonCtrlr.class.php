<?php

/**
 *--------------------------------------
 * member common
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CommonCtrlr extends IndexCtrlr {
	public function captcha_img() {
		$name = in_array(ARequest::get('name'), array('vcode', 'test')) ? ARequest::get('name', 'get') : 'vcode';

		$fonts = array(
			'spacing' => 2,
			'size' => 16,
			'font' => PUBLIC_PATH . D_S . 'font/font.ttf');
		$ac = new ACaptcha(90, 30, 5, $fonts);
		ASession::set($name, strtolower($ac->text));
		$ac->create_image();
	}

	function get_member_info() {
		/* check member switch */
		$o_m = M('Option')->get_option('member');
		if($o_m['switch']) {
			if(ASession::get('member_id')) {
				if(!ACookie::get('member_id')) {
					$_MI = M('Member')->field('m_userid,m_username')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->find();
					ACookie::set('member_id', ASession::get('member_id'));
					ACookie::set('m_userid', $_MI['m_userid']);
					ACookie::set('m_username', $_MI['m_username']);
				}
			}
			elseif(ACookie::get('member_id')) {
				$_mid = intval(ACookie::get('member_id'));
				$_MI = M('Member')->field('m_userid,m_status,member_level_id')->where(array('member_id' => array('EQ', $_mid)))->find();
				if($_MI['m_userid'] == ACookie::get('m_userid')) {
					ASession::set('member_id', $_mid);
					ASession::set('m_status', $_MI['m_status']);
					ASession::set('ml_rank', M('Member')->get_mlRank($_mid));
					ASession::set('member_level_id', $_MI['member_level_id']);
				}
				else {
					ASession::clear();
					ACookie::clear();
				}
			}

			if(ASession::get('member_id')) {
				$where = array();
				$where['mn_m_id'] = array('EQ', ASession::get('member_id'));
				$where['mn_status'] = array('EQ', 0);
				$_MNC = M('MemberNotify')->where($where)->count();
				$this->assign('_MNC', $_MNC);
			}

			$this->display('member/clip/member_info', 'utf-8', 'application/x-javascript');
			exit;
		}
	}

	public function member_email_verify() {
		$memberId = intval(ARequest::get('member_id'));
		$mevCode = AFilter::is_word(ARequest::get('mevc')) ? ARequest::get('mevc') : '';
		if(empty($mevCode)) {
			halt('', true, true);
		}

		$this->assign('_GCAP', 'member@common/member_email_verify');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('MEMBER_EMAIL_VERIFY'), 'url' => ''))
		);

		/* verify result */
		$_VR = array('status' => 0, 'info' => '');

		$where = array();
		$where['member_id'] = array('EQ', $memberId);
		$where['mev_code'] = array('EQ', $mevCode);
		$_MEVI = M('MemberEmailVerify')->where($where)->find();
		if(empty($_MEVI)) {
			$_VR['info'] = L('MEMBER_EMAIL_VERIFY_CODE_INVALID_TIP');
		}
		elseif(time() > $_MEVI['mev_add_time'] + M('Option')->get_option('member/verify_email_validity')) {
			$_VR['info'] = L('MEMBER_EMAIL_VERIFY_CODE_EXPIRED_TIP');
			/* delete verify data */
			M('MemberEmailVerify')->where($where)->delete();
		}
		else {
			$_VR['status'] = 1;
			$_VR['info'] = L('MEMBER_EMAIL_VERIFY_SUCCESS_TIP');
			/* update member status */
			M('Member')->pass_member($memberId);
			/* delete verify data */
			M('MemberEmailVerify')->where($where)->delete();
		}
		$this->assign('_VR', $_VR);

		$this->display('member/member/email_verify');
	}

	public function get_linkage_select() {
		$data = array('data' => 0);

		$lAlias = ARequest::get('l_alias');
		if(empty($lAlias) or !AFilter::is_word($lAlias)) {
			$this->ajax_return($data);
		}

		$linkageItemId = intval(ARequest::get('linkage_item_id'));
		$selectType = 'current' == ARequest::get('select_type') ? 'current' : 'sub';

		$linkageSelect = M('Linkage')->get_linkageSelect($lAlias, $linkageItemId, $selectType);
		$data = array('data' => 1, 'info' => $linkageSelect);
		$this->ajax_return($data);
	}

	public function task() {
		$tasks = explode('|', ARequest::get('task'));
		foreach($tasks as $task) {
			switch($task) {
				default:
					break;
			}
		}

		/* system task */
		if(!get_licence()) {
			echo '$("body").append("<div style=\"position:absolute;right:0;bottom:0;width:20px;height:14px;text-indent:-9999px;overflow:hidden;background:url(\'data:image/gif;base64,R0lGODlhFAAOAIABAM/W5v///yH5BAEAAAEALAAAAAAUAA4AAAInjI+py40AnII0ylDrpYYziEXg aB0cGYZlV3rslFnZMqtgc7/XzisFADs=\')\"><a target=\"_blank\" href=\"' . SOFT_AUTHOR_URL . '\">Pow' . 'ered by ' . SOFT_NAME . ' ' . SOFT_CODENAME . '</a></div>");';
		}
		M('Task')->run_task();
		exit();
	}

	public function toggle_ua() {
		$data = array('data' => 0);

		$ua = strtolower(ARequest::get(C('VAR.USER_AGENT')));
		$tuab = C('TE.TPL_USER_AGENT_BRANCH');

		if(empty($ua) or !preg_match('/^[A-Za-z_0-9]+$/', $ua) or !in_array($ua, $tuab)) {
			$this->ajax_return($data);
		}

		ACookie::set('user_agent', $ua);

		$data = array('data' => 1);
		$this->ajax_return($data);
	}
}

?>