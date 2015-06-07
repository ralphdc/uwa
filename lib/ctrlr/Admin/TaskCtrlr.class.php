<?php

/**
 *--------------------------------------
 * task
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-12
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TaskCtrlr extends ManageCtrlr {
	public function list_task() {
		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Task')->count();
		$p = new APage($rowsNum, $pageSize, Url::U('task/list_task?page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* task list */
		$_TL = M('Task')->get_taskList($limit);
		$this->assign('_TL', $_TL);

		$this->display();
	}

	public function add_task() {
		/* task file list */
		$_TFL = list_file(APP_PATH . D_S . 'api' . D_S . 'task');
		$this->assign('_TFL', $_TFL);

		$this->display();
	}
	public function add_task_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['t_start_time'] = !empty($data['t_start_time']) ? strtotime($data['t_start_time']) : time();
		$data['t_end_time'] = !empty($data['t_end_time']) ? strtotime($data['t_end_time']) : time();
		$data['t_last_run_time'] = 0;

		$result = M('Task')->add_task($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TASK') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('task/list_task'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_TASK') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('task/list_task'));
	}

	public function edit_task() {
		$taskId = ARequest::get('task_id');

		$_TI = M('Task')->get_taskInfo($taskId);
		if(empty($_TI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('task/list_task'));
		}
		$this->assign('_TI', $_TI);

		/* task file list */
		$_TFL = list_file(APP_PATH . D_S . 'api' . D_S . 'task');
		$this->assign('_TFL', $_TFL);

		$this->display();
	}
	public function edit_task_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['t_start_time'] = !empty($data['t_start_time']) ? strtotime($data['t_start_time']) : time();
		$data['t_end_time'] = !empty($data['t_end_time']) ? strtotime($data['t_end_time']) : time();

		$result = M('Task')->edit_task($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TASK') . ': ID[' . $data['task_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('task/list_task'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TASK') . ': ID[' . $data['task_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('task/list_task'));
	}

	public function delete_task_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$taskId = ARequest::get('task_id');
		$taskId = is_array($taskId) ? $taskId : explode(',', $taskId);
		$_L_ID = implode(', ', $taskId);

		foreach($taskId as $taskId) {
			$result = M('Task')->delete_task($taskId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TASK') . ': ID[' . $taskId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('task/list_task'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_TASK') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('task/list_task'));
	}

	public function toggle_task_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['task_id'] = ARequest::get('task_id');
		$data['t_status'] = ARequest::get('t_status');
		if(false === M('Task')->edit_task($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TASK') . ': ID[' . $data['task_id'] . ']', 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('task/list_task'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_TASK') . ': ID[' . $data['task_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('task/list_task'));
	}

	public function run_task() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$taskId = ARequest::get('task_id');

		$result = M('Task')->run_task_now($taskId);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('RUN_TASK_NOW') . ': ID[' . $taskId . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('task/list_task'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('RUN_TASK_NOW') . ': ID[' . $taskId . ']');
		$this->success(L('RUN_TASK_SUCCESS'), Url::U('task/list_task'));
	}
}

?>