<?php

/**
 *--------------------------------------
 * archive flag
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-7
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveFlagModl extends Modl {
	public function get_flagList() {
		$_AFL = F('~afl');
		if(empty($_AFL)) {
			$_AFL = $this->order('af_display_order')->select();
			F('~afl', $_AFL);
		}
		return $_AFL;
	}

	public function add_flag($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['archive_flag_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~afl', null);

		if(false === $this->update_archive_flagSet()) {
			$result['error'] = L('UPDATE_ARCHIVE_FLAGSET_FAILED');
			return $result;
		}


		return $result;
	}

	public function update_flag($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_FLAG_FAILED');
			return $result;
		}

		F('~afl', null);

		if(false === $this->update_archive_flagSet()) {
			$result['error'] = L('UPDATE_ARCHIVE_FLAGSET_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_flag($afAlias) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($afAlias)) {
			$result['error'] = L('DELETE_FLAG_FAILED');
			return $result;
		}

		F('~afl', null);

		if(false === $this->update_archive_flagSet()) {
			$result['error'] = L('UPDATE_ARCHIVE_FLAGSET_FAILED');
			return $result;
		}

		return $result;
	}

	/* update archive flagset */
	protected function update_archive_flagSet() {
		$flagSet = '';
		$_FL = $this->get_flagList();
		if(empty($_FL)) {
			return false;
		}
		foreach($_FL as $flag) {
			$flagSet .= "'" . $flag['af_alias'] . "',";
		}
		$flagSet = rtrim($flagSet, ',');

		$_t_sql = "ALTER TABLE `" . C('DB.PREFIX') . 'archive' . C('DB.SUFFIX') . "` MODIFY COLUMN `af_alias`  set({$flagSet}) NULL DEFAULT '' COMMENT '" . L('FLAG') . "';";
		$result = $this->execute($_t_sql);
		/* update structure cache */
		M('Archive')->flush();

		return $result;
	}

	/* get flag value */
	public function get_flag_value($afAlias) {
		$_FL = $this->order('`af_display_order` ASC')->select();
		if(empty($_FL)) {
			return false;
		}
		foreach($_FL as $k => $flag) {
			if($afAlias == $flag['af_alias']) {
				return pow(2, $k);
			}
		}
		return false;
	}

}

?>