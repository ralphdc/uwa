<?php

/**
 *--------------------------------------
 * member credit type
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-8
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCreditTypeModl extends Modl {
	public function get_creditTypeList() {
		$_MCTL = $this->select();
		return $_MCTL;
	}

	public function add_creditType($data) {
		$result = array('data' => '', 'error' => '');

		$_t_sql = "ALTER TABLE `" . C('DB.PREFIX') . 'member_credit' . C('DB.SUFFIX') . "`
			ADD COLUMN `{$data['mct_alias']}`  int(10) UNSIGNED NOT NULL DEFAULT {$data['mct_default']} COMMENT '{$data['mct_name']}';";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M('MemberCredit')->flush();

		unset($data['member_credit_type_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function delete_creditType($memberCreditTypeId) {
		$result = array('data' => '', 'error' => '');

		$_MCTI = $this->where(array('member_credit_type_id' => array('EQ', $memberCreditTypeId)))->find();
		if(empty($_MCTI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		$_t_sql = "ALTER TABLE `" . C('DB.PREFIX') . 'member_credit' . C('DB.SUFFIX') . "`
			DROP COLUMN `{$_MCTI['mct_alias']}`;";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M('MemberCredit')->flush();

		if(false === $this->delete($memberCreditTypeId)) {
			$result['error'] = L('DELETE_CREDIT_TYPE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>