<?php

/**
 *--------------------------------------
 * admin log
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2013-11-22
 * @copyright	: (c)2013 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminLogCtrlr extends ManageCtrlr {
	public function list_log() {
		/* filter status */
		$alStatus = ARequest::get('al_status') ? ARequest::get('al_status') : '';
		if('f' == $alStatus) {
			$where['__ADMIN_LOG__.al_status'] = array('EQ', 0);
		}
		elseif('s' == $alStatus) {
			$where['__ADMIN_LOG__.al_status'] = array('EQ', 1);
		}

		/* sort list */
		$orderBy = 'admin_log_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('AdminLog')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('admin_log/list_log?al_status=' . $alStatus . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* admin log list */
		$_ALL = M('AdminLog')->get_logList($where, $order, $limit);
		$this->assign('_ALL', $_ALL);

		$this->display();
	}

	public function download_log() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		/* filter status */
		$alStatus = ARequest::get('al_status') ? ARequest::get('al_status') : '';
		if('f' == $alStatus) {
			$where['__ADMIN_LOG__.al_status'] = array('EQ', 0);
		}
		elseif('s' == $alStatus) {
			$where['__ADMIN_LOG__.al_status'] = array('EQ', 1);
		}

		/* sort list */
		$orderBy = 'al_time';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		$limit = '';
		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('AdminLog')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('admin_log/list_log?al_status=' . $alStatus . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* admin log list */
		$_ALL = M('AdminLog')->get_logList($where, $order, $limit);

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DOWNLOAD_ADMIN_LOG'));

		if(!empty($_ALL)) {
			header('Cache-Control: no-cache, must-revalidate');
			header("Content-type:application/vnd.ms-excel");
			header("Content-Disposition:filename=log_" . date('YmdHi', time()) . ".xls");

			$this->assign('_ALL', $_ALL);
			$data = $this->te->fetch();
			echo ($data);
		}
		else {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DOWNLOAD_ADMIN_LOG') . ': ' . L('EMPTY'), 0);
			$this->error(L('EMPTY'), Url::U('admin_log/list_log'));
		}
	}

	public function delete_old_log() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$where = array();
		$where['al_time'] = array('LT', time() - 86400 * 30);
		$result = M('AdminLog')->where($where)->delete();
		if(false === $result) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_OLD_LOG'), 0);
			$this->error(L('DELETE_FAILED'), Url::U('admin_log/list_log'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_OLD_LOG'));
		$this->success(L('DELETE_SUCCESS'), Url::U('admin_log/list_log'));
	}

}

?>