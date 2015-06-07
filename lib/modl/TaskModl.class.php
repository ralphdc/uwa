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

class TaskModl extends Modl {
	public function get_taskList($limit = null) {
		$_TL = F('~tl_all');
		if(empty($_TL)) {
			$_TL = $this->order('`task_id` ASC')->select();
			F('~tl_all', $_TL);
		}

		if(!is_null($limit)) {
			if(!strpos($limit, ',')) {
				$limit = '0,' . $limit;
			}
			$limit = explode(',', $limit);
			$_TL = array_slice($_TL, $limit[0], $limit[1]);
		}
		return $_TL;
	}

	public function get_taskInfo($taskId) {
		$_LI = $this->where(array('task_id' => array('EQ', $taskId)))->find();
		return $_LI;
	}

	public function add_task($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['task_id']);
		if(false === $this->insert($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~tl_all', null);

		return $result;
	}

	public function edit_task($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~tl_all', null);

		return $result;
	}

	public function delete_task($taskId) {
		$result = array('data' => '', 'error' => '');

		$_t_li = $this->get_taskInfo($data['task_id']);

		if(false === $this->delete($taskId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		F('~tl_all', null);

		return $result;
	}

	public function run_task() {
		$_TL = $this->get_taskList();
		if(empty($_TL)) {
			exit("\r\n//task list empty.\r\n");
		}

		/* get a task */
		$_T = null;
		foreach($_TL as $task) {
			/* is not time limit or is time limit and now is in period */
			if((0 == $task['t_time_limit']) or (time() >= $task['t_start_time']) and (time() <= $task['t_end_time'])) {
				$runtime = strtotime(date('Y-m-d ', $task['t_last_run_time']) . $task['t_run_time']) + $task['t_cycle_time'];
				/* now is later than run time mark */
				if($runtime < time()) {
					$_T = $task;
					break;
				}
			}
		}

		if(is_null($_T)) {
			exit("\r\n//have no task.\r\n");
		}

		$tFile = APP_PATH . D_S . 'api' . D_S . 'task' . D_S . $_T['t_file'];
		if(!file_exists($tFile)) {
			exit("\r\n//task file not exist.\r\n");
		}

		define('IS_UWA_TASK', true);

		/* task params */
		$_TP = array();
		if(!empty($_T['t_addon_params'])) {
			$at = get_instance('ATag', 't');
			$at->tags = array();
			$at->parse_content($_T['t_addon_params']);
			$_TP = $at->tags;
			$_TP = $_TP['p'];
		}

		include($tFile);

		if($_TR['data']) {
			/* update last run time */
			$this->where(array('task_id' => array('EQ', $_T['task_id'])))->set_field('t_last_run_time', time());
			F('~tl_all', null);

			exit("\r\n//" . $_TR['info'] . "\r\n");
		}
	}

	public function run_task_now($taskId) {
		$result = array('data' => '', 'error' => '');

		$_TI = M('Task')->get_taskInfo($taskId);
		if(empty($_TI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$tFile = APP_PATH . D_S . 'api' . D_S . 'task' . D_S . $_TI['t_file'];
		if(!file_exists($tFile)) {
			$result['error'] = L('TASK_FILE_NOT_EXIST');
			return $result;
		}

		define('IS_UWA_TASK', true);

		/* task params */
		$_TP = array();
		if(!empty($_TI['t_addon_params'])) {
			$at = get_instance('ATag', 't');
			$at->tags = array();
			$at->parse_content($_TI['t_addon_params']);
			$_TP = $at->tags;
			$_TP = $_TP['p'];
		}

		include($tFile);

		if(!$_TR['data']) {
			$result['error'] = L('RUN_TASK_FAILED');
			return $result;
		}

		/* update last run time */
		$this->where(array('task_id' => array('EQ', $_TI['task_id'])))->set_field('t_last_run_time', time());
		F('~tl_all', null);
		return $result;
	}



}

?>