<?php

/**
 *--------------------------------------
 * report
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-17
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ReportCtrlr extends ManageCtrlr {
	public function list_report() {
		$where = array();
		/* filter status*/
		$rItemType = ARequest::get('r_item_type') ? ARequest::get('r_status') : '';
		if(!empty($rItemType)) {
			$where['r_item_type'] = array('EQ', $rItemType);
		}

		/* filter status */
		$rStatus = ARequest::get('r_status') ? ARequest::get('r_status') : '';
		if('n' == $rStatus) {
			$where['r_status'] = array('EQ', 0);
		}
		elseif('d' == $rStatus) {
			$where['r_status'] = array('EQ', 1);
		}

		/* filter info keyword */
		$rInfo = ARequest::get('r_info');
		if(!empty($rInfo)) {
			$where['r_info'] = array('LIKE', '%' . $rInfo . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'report_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Report')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('reportw/list_report?r_item_type=' . $rItemType . '&r_status=' . $rStatus . '&r_info=' . $rInfo . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* report list */
		$_RL = M('Report')->where($where)->order($order)->limit($limit)->select();
		if(!empty($_RL)) {
			foreach($_RL as $k => $v) {
				if(false !== strpos($v['r_item_type'], '_')) {
					$_RL[$k]['editor'] = 'edit_' . substr($v['r_item_type'], strpos($v['r_item_type'], '_') + 1);
				}
				else {
					$_RL[$k]['editor'] = 'edit_' . $v['r_item_type'];
				}
			}
		}
		$this->assign('_RL', $_RL);

		$this->display();
	}

	public function toggle_report_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['report_id'] = ARequest::get('report_id');
		$data['r_status'] = ARequest::get('r_status');
		if(false === M('Report')->update($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_REPORT') . ': ID[' . $data['report_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('report/list_report'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_REPORT') . ': ID[' . $data['report_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('report/list_report'));
	}

	public function deal_report_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$reportId = ARequest::get('report_id');
		$reportId = is_array($reportId) ? $reportId : explode(',', $reportId);
		$_L_ID = implode(', ', $reportId);

		foreach($reportId as $reportId) {
			$result = M('Report')->deal_report($reportId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DEAL_REPORT') . ': ID[' . $reportId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('report/list_report'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DEAL_REPORT') . ': ID[' . $_L_ID . ']');
		$this->success(L('DEAL_SUCCESS'), Url::U('report/list_report'));
	}

	public function delete_report_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$reportId = ARequest::get('report_id');
		$reportId = is_array($reportId) ? $reportId : explode(',', $reportId);
		$_L_ID = implode(', ', $reportId);

		foreach($reportId as $reportId) {
			$result = M('Report')->delete_report($reportId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_REPORT') . ': ID[' . $reportId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('report/list_report'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_REPORT') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('report/list_report'));
	}


}

?>