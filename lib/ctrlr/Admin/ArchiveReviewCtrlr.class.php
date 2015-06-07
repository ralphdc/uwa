<?php

/**
 *--------------------------------------
 * archive review
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveReviewCtrlr extends ManageCtrlr {
	public function list_review() {
		/* all channel list of model */
		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n", ARequest::get('archive_channel_id'), "<option value='\$archive_channel_id' selected='selected'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$where = array();
		/* filter channel */
		$archiveChannelId = ARequest::get('archive_channel_id') ? ARequest::get('archive_channel_id') : 0;
		if($archiveChannelId > 0) {
			/* check permission */
			$_t_AI = M('Admin')->get_adminInfo(ASession::get('admin_id'));
			$myChannel = $_t_AI['a_ac_id'];
			if(!in_array('_all', $myChannel) && !in_array($archiveChannelId, $myChannel)) {
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
			}
		}
		if(0 == $archiveChannelId && !empty($_ACL)) {
			foreach($_ACL as $c) {
				$archiveChannelId .= ',' . $c['archive_channel_id'];
				if(isset($c['ac_sub_channel']) and !empty($c['ac_sub_channel'])) {
					foreach($c['ac_sub_channel'] as $cs) {
						$archiveChannelId .= ',' . $cs['archive_channel_id'];
					}
				}
			}
			$archiveChannelId = rtrim($archiveChannelId, ',');
		}
		$where['__ARCHIVE_REVIEW__.archive_channel_id'] = array('IN', $archiveChannelId);

		/* filter status */
		$arStatus = ARequest::get('ar_status') ? ARequest::get('ar_status') : '';
		if('n' == $arStatus) {
			$where['ar_status'] = array('EQ', 0);
		}
		elseif('p' == $arStatus) {
			$where['ar_status'] = array('EQ', 1);
		}
		elseif('f' == $arStatus) {
			$where['ar_status'] = array('EQ', 2);
		}

		/* filter content */
		$arContent = ARequest::get('ar_content');
		if(!empty($arContent)) {
			$where['ar_content'] = array('LIKE', '%' . $arContent . '%');
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['__ARCHIVE_REVIEW__.member_id'] = array('EQ', $memberId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'archive_review_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('ArchiveReview')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('archive_review/list_review?archive_channel_id=' . $archiveChannelId . '&ar_status=' . $arStatus . '&ar_content=' . $arContent . '&member_id=' . $memberId . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive review list */
		$_ARL = M('ArchiveReview')->get_reviewList($where, $order, $limit, false);
		$this->assign('_ARL', $_ARL);

		$this->display();
	}

	public function edit_review() {
		$archiveReviewId = ARequest::get('archive_review_id');
		$_ARI = M('ArchiveReview')->get_reviewInfo($archiveReviewId);
		if(empty($_ARI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
		}

		if(!M('ArchiveChannel')->check_permission($archiveReviewId)) {
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
		}

		$this->assign('_ARI', $_ARI);

		$this->display();
	}
	public function edit_review_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$_ARI = M('ArchiveReview')->field('archive_channel_id,member_id,ar_status')->where(array('archive_review_id' => array('EQ', $data['archive_review_id'])))->find();
		if(empty($_ARI)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
		}
		if(!M('ArchiveChannel')->check_permission($_ARI['archive_channel_id']) or !M('ArchiveChannel')->check_permission($data['archive_channel_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
		}

		$result = M('ArchiveReview')->edit_review($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('archive_review/list_review'));
		}

		if(1 == $data['ar_status'] and 1 != $_ARI['ar_status']) {
			M('Member')->update_credit($_ARI['member_id'], 'review');
		}
		elseif(1 != $data['ar_status'] and 1 == $_ARI['ar_status']) {
			M('Member')->update_credit($_ARI['member_id'], 'review', false);
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('archive_review/list_review'));

	}

	public function pass_review_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveReviewId = ARequest::get('archive_review_id');
		$archiveReviewId = is_array($archiveReviewId) ? $archiveReviewId : explode(',', $archiveReviewId);
		$_L_ID = implode(', ', $archiveReviewId);

		foreach($archiveReviewId as $archiveReviewId) {
			$_ARI = M('ArchiveReview')->field('archive_channel_id,member_id,ar_status')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->find();
			if(empty($_ARI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
			}
			if(!M('ArchiveChannel')->check_permission($_ARI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
			}

			$result = M('ArchiveReview')->pass_review($archiveReviewId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_review/list_review'));
			}

			if(1 != $_ARI['ar_status']) {
				M('Member')->update_credit($_ARI['member_id'], 'review');
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_ARCHIVE_REVIEW') . ': ID[' . $_L_ID . ']');
		$this->success(L('PASS_SUCCESS'), Url::U('archive_review/list_review'));
	}

	public function toggle_review_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['archive_review_id'] = ARequest::get('archive_review_id');
		$data['ar_status'] = ARequest::get('ar_status');

		$_ARI = M('ArchiveReview')->field('archive_channel_id,member_id,ar_status')->where(array('archive_review_id' => array('EQ', $data['archive_review_id'])))->find();
		if(empty($_ARI)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
		}
		if(!M('ArchiveChannel')->check_permission($_ARI['archive_channel_id'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']' . L('PERMISSION_LIMIT'), 0);
			$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
		}

		if(false === M('ArchiveReview')->update($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('archive_review/list_review'));
		}

		/* update member credit */
		if(1 == $data['ar_status'] and 1 != $_ARI['ar_status']) {
			M('Member')->update_credit($_ARI['member_id'], 'review');
		}
		elseif(1 != $data['ar_status'] and 1 == $_ARI['ar_status']) {
			M('Member')->update_credit($_ARI['member_id'], 'review', false);
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_ARCHIVE_REVIEW') . ': ID[' . $data['archive_review_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('archive_review/list_review'));
	}

	public function delete_review_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveReviewId = ARequest::get('archive_review_id');
		$archiveReviewId = is_array($archiveReviewId) ? $archiveReviewId : explode(',', $archiveReviewId);
		$_L_ID = implode(', ', $archiveReviewId);

		foreach($archiveReviewId as $archiveReviewId) {
			$_ARI = M('ArchiveReview')->field('archive_channel_id,member_id,ar_status')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->find();
			if(empty($_ARI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
			}
			if(!M('ArchiveChannel')->check_permission($_ARI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
			}

			$result = M('ArchiveReview')->delete_review($archiveReviewId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_review/list_review'));
			}

			if(1 == $_ARI['ar_status']) {
				M('Member')->update_credit($_ARI['member_id'], 'review', false);
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_review/list_review'));
	}

	public function delete_same_ip_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$archiveReviewId = ARequest::get('archive_review_id');
		$archiveReviewId = is_array($archiveReviewId) ? $archiveReviewId : explode(',', $archiveReviewId);
		$_L_ID = implode(', ', $archiveReviewId);

		foreach($archiveReviewId as $archiveReviewId) {
			$_ARI = M('ArchiveReview')->field('archive_channel_id,member_id,ar_status')->where(array('archive_review_id' => array('EQ', $archiveReviewId)))->find();
			if(empty($_ARI)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('ITEM_NOT_EXIST'), 0);
				$this->error(L('ITEM_NOT_EXIST'), Url::U('archive_review/list_review'));
			}
			if(!M('ArchiveChannel')->check_permission($_ARI['archive_channel_id'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . L('PERMISSION_LIMIT'), 0);
				$this->error(L('PERMISSION_LIMIT'), Url::U('archive_review/list_review'));
			}

			$result = M('ArchiveReview')->delete_same_ip($archiveReviewId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $archiveReviewId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('archive_review/list_review'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_ARCHIVE_REVIEW') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('archive_review/list_review'));
	}
}

?>