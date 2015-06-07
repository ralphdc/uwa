<?php

/**
 *--------------------------------------
 * archive
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-28
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveCtrlr extends IndexCtrlr {
	public function show_channel() {
		$archiveChannelId = intval(ARequest::get('archive_channel_id'));

		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		if(empty($_ACI)) {
			halt('', true, true);
		}
		$this->assign('_V', $_ACI);

		/* html not support dynamic view */
		$_o = M('Option')->get_option('core');
		if($_o['html_switch'] and $_o['forced_html'] and 1 == $_ACI['ac_is_html'] and !is_mobile()) {
			$url = M('ArchiveChannel')->build_url($archiveChannelId);
			redirect($url['ac_url']);
		}

		/* define current channel id */
		$this->assign('AC_ID', $archiveChannelId);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $archiveChannelId);

		/* current position */
		$this->assign('_CP', $_ACI['ac_position']);
		$this->assign('_CP_O', $_ACI['ac_position_o']);

		if(1 == $_ACI['ac_type']) {
			/* task */
			$this->assign('TASK', 'build_html_channel_index&archive_channel_id=' . $archiveChannelId);

			$this->display('home/' . $_ACI['ac_tpl_index']);
		}
		else {
			$where = array();
			/* get page filter field */
			$_page_ff = array();
			foreach($_ACI['am_field'] as $field => $params) {
				if(1 == $params['f_is_list'] and ('select' == $params['f_type'] or 'radio' == $params['f_type'] or 'checkbox' == $params['f_type'])) {
					$valueSet = array();
					$_t = explode(',', $params['f_default']);
					foreach($_t as $v) {
						$_t1 = explode('|', $v);
						$valueSet[$_t1[0]] = $_t1[1];
					}

					$fieldValue = ARequest::get($field);

					if(!empty($fieldValue) and array_key_exists($fieldValue, $valueSet)) {
						$where['addon.' . $field] = array('INSET', $fieldValue);
						$_page_ff[$field] = $fieldValue;
					}
				}
			}

			/* filter field for show */
			$_FF = array();
			foreach($_ACI['am_field'] as $field => $params) {
				if(1 == $params['f_is_list'] and ('select' == $params['f_type'] or 'radio' == $params['f_type'] or 'checkbox' == $params['f_type'])) {
					$_FF[$field]['name'] = $params['f_item_name'];

					/* get ff params */
					$_t_page_ff = $_page_ff;
					unset($_t_page_ff[$field]);
					$_FF[$field]['params'][] = array(
						'name' => L('NOT_LIMIT'),
						'url' => Url::U('archive/show_channel?archive_channel_id=' . $archiveChannelId . '&' . http_build_query($_t_page_ff)),
						'field' => $field,
						'value' => '',
					);
					$_t = explode(',', $params['f_default']);
					foreach($_t as $k => $v) {
						$_t1 = explode('|', $v);
						$_t_page_ff = $_page_ff;
						$_t_page_ff[$field] = $_t1[0];

						$_FF[$field]['params'][] = array(
							'name' => $_t1[1],
							'url' => Url::U('archive/show_channel?archive_channel_id=' . $archiveChannelId . '&' . http_build_query($_t_page_ff)),
							'field' => $field,
							'value' => $_t1[0],
						);
					}
				}
			}
			$this->assign('_FF', $_FF);

			$where['__ARCHIVE__.a_status'] = array('EQ', 1);

			$_ACL = M('ArchiveChannel')->get_channelList(0, $archiveChannelId);
			$act = new ATree($_ACL, array(
				'archive_channel_id',
				'ac_parent_id',
				'ac_sub_channel'), $archiveChannelId);
			$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($archiveChannelId)));

			$order = '`a_rank` DESC, `a_edit_time` DESC';

			/* get paging */
			$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
			$rowsNum = M('Archive')->get_archiveCount($where, $_ACI['archive_model_id']);
			$p = new APage($rowsNum, $_ACI['ac_page_size'], Url::U('archive/show_channel?archive_channel_id=' . $archiveChannelId . '&' . C('VAR.PAGE') . '=_page_' . '&' . http_build_query($_page_ff)));
			$this->assign('PAGING', $p->get_paging());
			$limit = $p->get_limit();

			/* archive list */
			$_AL = M('Archive')->get_archiveList($where, $order, $limit, $_ACI['archive_model_id'], true);
			$this->assign('_L', $_AL);

			/* task */
			$this->assign('TASK', 'build_html_channel_list&archive_channel_id=' . $archiveChannelId . '&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

			if('clip' == ARequest::get('type')) {
				$this->display('home/clip/' . $_ACI['ac_tpl_list']);
			}
			else {
				$this->display('home/' . $_ACI['ac_tpl_list']);
			}
		}
	}

	public function show_archive() {
		$archiveId = intval(ARequest::get('archive_id'));
		$_AI = M('Archive')->get_archiveInfo($archiveId, true);
		if(empty($_AI)) {
			halt('', true, true);
		}

		/* html not support dynamic view */
		$_o = M('Option')->get_option('core');
		if($_o['html_switch'] and $_o['forced_html'] and 0 != $_AI['ac_is_html'] and 1 == $_AI['a_status'] and $_AI['a_is_html'] and 0 == $_AI['a_cost_points'] and !is_mobile()) {
			$url = M('Archive')->build_url($archiveId);
			redirect($url['a_url']);
		}

		/* define current channel id */
		$this->assign('AC_ID', $_AI['archive_channel_id']);
		/* define current archive id */
		$this->assign('A_ID', $_AI['archive_id']);
		$this->assign('_GCAP', 'home@archive/show_channel?archive_channel_id=' . $_AI['archive_channel_id']);

		/* channel information */
		$_ACI = M('ArchiveChannel')->get_channelInfo($_AI['archive_channel_id']);
		if(empty($_ACI)) {
			halt('', true, true);
		}
 		/* get sibling channel */
		$_AI['ac_sibling'] = $_ACI['ac_sibling'];

		/* current position */
		$_ACI['ac_position'][] = array('name' => $_AI['a_title'], 'url' => '');
		$this->assign('_CP', $_ACI['ac_position']);
		$_ACI['ac_position_o'][] = array('name' => $_AI['a_title'], 'url' => '');
		$this->assign('_CP_O', $_ACI['ac_position_o']);

		/* task */
		$this->assign('TASK', 'build_html_archive&archive_id=' . $archiveId);

		/* check status and permission */
		$_AI['msg_err'] = '';
		if(ASession::get('member_id') != $_AI['member_id']
			and (1 != $_AI['a_status']
				or in_array(- 1, $_AI['ac_view_ml_ids'])
				or (!in_array(0, $_AI['ac_view_ml_ids']) and !in_array(ASession::get('member_level_id'), $_AI['ac_view_ml_ids'])))) {
					$_AI['msg_err'] = L('PERMISSION_LIMIT');
		}
		/* check buy */
		if(0 < $_AI['a_cost_points'] and ASession::get('member_id') != $_AI['member_id']) {
			$timeKey = time();
			$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));
			$this->assign('_TK', $_TK);

			$_where = array();
			$_where['member_id'] = array('EQ', ASession::get('member_id'));
			$_where['mco_product_type'] = array('EQ', 'archive');
			$_where['mco_product_name'] = array('EQ', 'ARCHIVE' . $archiveId);
			$_mcoi = M('MemberCreditOrder')->where($_where)->find();
			if(empty($_mcoi)) {
				$_AI['msg_err'] = L('ITEM_COST') . ' <strong>' . $_AI['a_cost_points'] . '</strong> ' . L('POINTS') . ' <a href="' . Url::U('member@member_credit_order/buy_archive_do?archive_id=' . $archiveId . '&timeKey=' . $_TK['timeKey'] . '&token=' . $_TK['token']) . '">' . L('BUY') . '</a>';
			}
			elseif(1 != $_mcoi['mco_status']) {
				$_AI['msg_err'] = L('ITEM_COST') . ' <strong>' . $_AI['a_cost_points'] . '</strong> ' . L('POINTS') . ' <a href="' . Url::U('member@member_credit_order/pay_credit_order_do?credit_order_id=' . $_mcoi['member_credit_order_id'] . '&timeKey=' . $_TK['timeKey'] . '&token=' . $_TK['token']) . '">' . L('PAY') . '</a>';
			}
		}

		if(empty($_AI['msg_err'])) {
			/* deal with paging field */
			foreach($_ACI['am_field'] as $field => $params) {
				if(isset($params['f_is_paging']) and (1 == $params['f_is_paging'])) {
					$pagingField = $field;
					break;
				}
			}
			if(isset($pagingField) and false !== strpos($_AI[$pagingField], '<p>#uwa_paging#</p>')) {
				$_content = explode('<p>#uwa_paging#</p>', $_AI[$pagingField]);

				$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
				$rowsNum = count($_content);
				$p = new APage($rowsNum, 1, Url::U('archive/show_archive?archive_id=' . $archiveId . '&' . C('VAR.PAGE') . '=_page_'));
				$this->assign('PAGING', $p->get_paging());
				$_AI[$pagingField] = $_content[ARequest::get(C('VAR.PAGE')) - 1];
				$_AI['a_title'] = $_AI['a_title'] . '(' . ARequest::get(C('VAR.PAGE')) . ')';
			}
			else {
				$this->assign('PAGING', '');
			}
		}

		$this->assign('_V', $_AI);

		if(!empty($_AI['a_tpl'])) {
			if('clip' == ARequest::get('type')) {
				$this->display('home/clip/' . $_AI['a_tpl']);
			}
			else {
				$this->display('home/' . $_AI['a_tpl']);
			}
		}
		else {
			if('clip' == ARequest::get('type')) {
				$this->display('home/clip/' . $_AI['ac_tpl_archive']);
			}
			else {
				$this->display('home/' . $_AI['ac_tpl_archive']);
			}
		}
	}

	/* get count */
	public function get_count() {
		$archiveId = intval(ARequest::get('archive_id'));
		$type = ARequest::get('type');
		if('view' == $type) {
			M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field_inc('a_view_count');
			$count = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->get_field('a_view_count');
			echo "document.write('{$count}');";
			exit;
		}
		elseif('support' == $type) {
			$count = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->get_field('a_support_count');
			echo "document.write('{$count}');";
			exit;
		}
		elseif('do_support' == $type) {
			if(!I('feedback_short', 1)) {
				$this->ajax_return(array('data' => 0, 'info' => L('_TRY_LATER_')));
			}
			M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field_inc('a_support_count');
			I('feedback_short');
			$this->ajax_return(array('data' => 1, 'info' => L('SUPPORT_SUCCESS')));
		}
		elseif('oppose' == $type) {
			$count = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->get_field('a_oppose_count');
			echo "document.write('{$count}');";
			exit;
		}
		elseif('do_oppose' == $type) {
			if(!I('feedback_short', 1)) {
				$this->ajax_return(array('data' => 0, 'info' => L('_TRY_LATER_')));
			}
			M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field_inc('a_oppose_count');
			I('feedback_short');
			$this->ajax_return(array('data' => 1, 'info' => L('OPPOSE_SUCCESS')));
		}
	}
}

?>