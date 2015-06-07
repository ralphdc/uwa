<?php

/**
 *--------------------------------------
 * archive review
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-2
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveReviewCtrlr extends IndexCtrlr {
	public function list_review() {
		$type = ARequest::get('type');
		$archiveId = intval(ARequest::get('archive_id'));
		$_o_review_switch = M('Option')->get_option('interaction/review_switch');
		$_ai = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field('archive_id,a_title,a_review_switch,archive_channel_id,a_url,a_url_o')->find();
		if(empty($_ai)) {
			halt('', true, true);
		}
		$_aci = M('ArchiveChannel')->where(array('archive_channel_id' => array('EQ', $_ai['archive_channel_id'])))->field('ac_review_switch')->find();

		$_ai['msg_err'] = '';
		if(!$_o_review_switch or !$_aci['ac_review_switch'] or !$_ai['a_review_switch']) {
			$_ai['msg_err'] = L('REVIEW_IS_OFF');
		}
		elseif(1 == $_o_review_switch and '' == ASession::get('member_id')) {
			$_ai['msg_err'] = L('LOGIN_NEED_TIP') . ' <a target="_parent" href="' . Url::U('member@member/login') . '">' . L('LOGIN') . '</a>' . ' <a target="_parent" href="' . Url::U('member@member/register') . '">' . L('REGISTER') . '</a>';
		}

		$where = array();
		$where['__ARCHIVE_REVIEW__.archive_id'] = array('EQ', $archiveId);
		$where['ar_status'] = array('GT', 0);

		$this->assign('_V', $_ai);

		$this->assign('_GCAP', 'home@archive_review/list_review');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('REVIEW_LIST'), 'url' => ''))
		);

		/* sort list */
		$order = "`ar_add_time` DESC";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('ArchiveReview')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('archive_review/list_review?archive_id=' . $archiveId . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive review list */
		$_ARL = M('ArchiveReview')->get_reviewList($where, $order, $limit);
		$this->assign('_L', $_ARL);

		if('clip' == $type) {
			$this->display('home/clip/list_archive_review');
		}
		else {
			$this->display('home/list_archive_review');
		}
	}

	public function add_review_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveId =intval(ARequest::get('archive_id'));

		$_o_i = M('Option')->get_option('interaction');
		$_ai = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field('a_review_switch,archive_channel_id')->find();
		$_aci = M('ArchiveChannel')->where(array('archive_channel_id' => array('EQ', $_ai['archive_channel_id'])))->field('ac_review_switch')->find();
		if(!$_o_i['review_switch'] or !$_aci['ac_review_switch'] or !$_ai['a_review_switch']) {
			$this->error(L('REVIEW_IS_OFF'), AServer::get_preUrl());
		}
		elseif(1 == $_o_review_switch and '' == ASession::get('member_id')) {
			$this->error(L('LOGIN_NEED'), Url::U('member@member/login'));
		}

		check_interaction('feedback');
		$data = array();

		$data['member_id'] = ASession::get('member_id') ? ASession::get('member_id') : 0;
		$data['ar_author'] = AFilter::is_username(ACookie::get('m_username')) ? ACookie::get('m_username') : L('GUEST');

		$data['archive_id'] = $archiveId;
		$data['archive_channel_id'] = $_ai['archive_channel_id'];
		$data['ar_content'] = str_replace(array("\r\n", "\n"), "<br />", AFilter::text(ARequest::get('ar_content'), 500));
		$data['ar_add_time'] = time();
		$data['ar_add_ip'] = AServer::get_ip();

		/* content need filter or archive need audit */
		$report = false;
		$_o_i = M('Option')->get_option('interaction');
		if($_o_i['auto_report'] > 0 and !M('Report')->report_check($data['ar_content'])) {
			if(2 == $_o_i['auto_report']) {
				$data['ar_status'] = 2;
			}
			else {
				$data['ar_status'] = 0;
			}
			$report = true;
		}
		elseif($_o_i['feedback_check']) {
			$data['ar_status'] = 0;
		}
		else {
			$data['ar_status'] = 1;
		}

		$result = M('ArchiveReview')->add_review($data);

		/* need report */
		if($report) {
			$_t_data['r_item_type'] = 'archive_review';
			$_t_data['r_item_id'] = M('ArchiveReview')->get_lastInsID();
			$_t_data['r_info'] = 'filter';
			$_t_data['r_add_time'] = time();
			$_t_data['r_add_ip'] = AServer::get_ip();
			$_t_data['r_status'] = 0;
			M('Report')->insert($_t_data);
		}

		if(!empty($result['error'])) {
			$this->error($result['error'], AServer::get_preUrl());
		}

		/* update member credit */
		if($data['ar_status']) {
			M('Member')->update_credit($data['member_id'], 'review');
		}

		/* update archive review count */
		M('Archive')->where(array('archive_id' => array('EQ', $data['archive_id'])))->field_inc('a_review_count');

		$this->success(L('ADD_SUCCESS'), AServer::get_preUrl());
	}

	/* get count */
	public function get_count() {
		$archiveReviewId = intval(ARequest::get('archive_review_id'));
		$type = ARequest::get('type');
		if('do_support' == $type) {
			if(!I('feedback_short', 1)) {
				$this->ajax_return(array('data' => 0, 'info' => L('_TRY_LATER_')));
			}
			M('ArchiveReview')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->field_inc('ar_support_count');
			I('feedback_short');
			$this->ajax_return(array('data' => 1, 'info' => L('SUPPORT_SUCCESS')));
		}
		if('do_oppose' == $type) {
			if(!I('feedback', 1)) {
				$this->ajax_return(array('data' => 0, info => L('_TRY_LATER_')));
			}
			M('ArchiveReview')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->field_inc('ar_oppose_count');
			I('feedback_short');
			$this->ajax_return(array('data' => 1, 'info' => L('OPPOSE_SUCCESS')));
		}
	}
}

?>