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

class ReportModl extends Modl {
	public function add_report($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['report_id']);
		if(false === $this->insert($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function deal_report($reportId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->where(array('report_id' => array('EQ', $reportId)))->set_field('r_status', 1)) {
			$result['error'] = L('DEAL_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_report($reportId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($reportId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	/* filter_content */
	public function filter_content($content) {
		$_o_i = M('Option')->get_option('interaction');
		if(is_array($content)) {
			foreach($content as $key => $val) {
				$content[$key] = $this->filter_content($val);
			}
			return $content;
		}
		else {
			$filterWords = explode('|', $_o_i['filter_words']);
			foreach($filterWords as $word) {
				$word = trim($word);
				if(empty($word)) {
					continue;
				}
				$replaceStr = str_repeat($_o_i['filter_replace'], AString::mstrlen($word));
				$content = str_replace($word, $replaceStr, $content);
			}
			return $content;
		}
	}

	/* report check */
	public function report_check($content) {
		$_o_i = M('Option')->get_option('interaction');
		if(is_array($content)) {
			foreach($content as $c) {
				if(!$this->report_check($c)) {
					return 0;
				}
			}
			return 1;
		}

		$filterWords = explode('|', $_o_i['filter_words']);
		foreach($filterWords as $word) {
			$word = trim($word);
			if(empty($word)) {
				continue;
			}
			if(strstr($content, $word)) {
				return 0;
			}
		}
		return 1;
	}
}

?>