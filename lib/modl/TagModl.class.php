<?php

/**
 *--------------------------------------
 * Tag
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-28
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagModl extends Modl {
	public function get_tagList($where = '', $order = '', $limit = 10) {
		$_TL = $this->where($where)->order($order)->limit($limit)->select();
		if(!empty($_TL)) {
			foreach($_TL as $k => $v) {
				$_TL[$k]['t_url'] = Url::U('home@tag/show_tag?t_name=' . $v['t_name']);
			}
		}
		return $_TL;
	}

	public function get_tagInfo($tagId, $byName = false) {
		if($byName) {
			$_TI = $this->where(array('t_name' => array('EQ', $tagId)))->find();
		}
		else {
			$_TI = $this->where(array('tag_id' => array('EQ', $tagId)))->find();
		}
		return $_TI;
	}

	public function add_tag($data) {
		$result = array('data' => '', 'error' => '');

		$_t_tra = explode(',', $data['t_related_archive']);
		foreach($_t_tra as $k => $v) {
			if(empty($v)) {
				unset($_t_tra[$k]);
			}
		}
		$_t_tra = array_unique($_t_tra);
		$data['t_related_archive'] = implode(',', $_t_tra);
		$data['t_archive_count'] = count($_t_tra);

		unset($data['tag_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_tag($data) {
		$result = array('data' => '', 'error' => '');

		$_t_tra = explode(',', $data['t_related_archive']);
		foreach($_t_tra as $k => $v) {
			if(empty($v)) {
				unset($_t_tra[$k]);
			}
		}
		$_t_tra = array_unique($_t_tra);
		$data['t_related_archive'] = implode(',', $_t_tra);
		$data['t_archive_count'] = count($_t_tra);

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_tag($tagId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($tagId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function tag_exsit($tName) {
		$_TI = $this->where(array('t_name' => array('EQ', $tName)))->find();
		return empty($_TI) ? false : true;
	}

	public function add_tag_archive($tName, $archiveId) {
		$_TI = $this->where(array('t_name' => array('EQ', $tName)))->find();
		if(empty($_TI)) {
			$_TI = array(
				't_name' => $tName,
				't_keywords' => $tName,
				't_description' => $tName,
				't_related_archive' => $archiveId,
				't_archive_count' => 1,
				't_view_count' => 0,
				't_add_time' => time(),
				't_update_time' => time(),
				);
			return $this->insert($_TI);
		}

		/* merge id */
		$_t_tra = explode(',', $_TI['t_related_archive'] . ',' . $archiveId);
		foreach($_t_tra as $k => $v) {
			if(empty($v)) {
				unset($_t_tra[$k]);
			}
		}
		$_t_tra = array_unique($_t_tra);

		$_TI['t_related_archive'] = implode(',', $_t_tra);
		$_TI['t_archive_count'] = count($_t_tra);
		$_TI['t_update_time'] = time();

		return $this->update($_TI);
	}

	public function delete_tag_archive($tName, $archiveId) {
		$_TI = $this->where(array('t_name' => array('EQ', $tName)))->find();
		if(empty($_TI)) {
			return true;
		}

		/* merge id */
		$_t_tra = explode(',', $_TI['t_related_archive']);
		foreach($_t_tra as $k => $v) {
			if(empty($v) or $v == $archiveId) {
				unset($_t_tra[$k]);
			}
		}

		$_TI['t_related_archive'] = implode(',', $_t_tra);
		$_TI['t_archive_count'] = count($_t_tra);
		$_TI['t_update_time'] = time();

		return $this->update($_TI);
	}
}

?>