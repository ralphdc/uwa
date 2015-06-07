<?php

/**
 *--------------------------------------
 * member
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-3
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberModl extends Modl {
	public function get_memberInfo($memberId, $output = false) {
		$_MI = $this->where(array('__MEMBER__.member_id' => array('EQ', $memberId)))
			->join('__MEMBER_MODEL__ AS mm ON mm.member_model_id = __MEMBER__.member_model_id')
			->join('__MEMBER_LEVEL__ AS ml ON ml.member_level_id = __MEMBER__.member_level_id')
			->join('__MEMBER_CREDIT__ AS mc ON mc.member_id = __MEMBER__.member_id')->find();
		if(empty($_MI)) {
			return null;
		}

		/* get model field */
		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_MI['mm_fieldset']);
		$_MI['mm_field'] = $at->tags;

		/* get information in addon table */
		$addon = M(parse_name($_MI['mm_addon_table'], 1))->where(array('member_id' => array('EQ', $_MI['member_id'])))->find();
		if(!empty($addon)) {
			load('field#func');
			foreach($_MI['mm_field'] as $field => $params) {
				if(isset($addon[$field])) {
					$addon[$field] = deal_fieldValue($addon[$field], $params, $output);
				}
			}
			$_MI = array_merge($_MI, $addon);
		}

		return $_MI;
	}

	public function get_memberList($where = '', $order = '`member_id` DESC', $limit = 10, $memberModelId = 0, $output = false) {
		/* get field for list in addon table */
		if(0 < $memberModelId) {
			$addonFields = '';
			$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
			if(empty($_MMI)) {
				return null;
			}
			foreach($_MMI['mm_field'] as $field => $params) {
				if(1 == $params['f_is_list']) {
					$addonFields .= ',`' . $field . '`';
				}
			}
			$_ML = M('Member')->field('__MEMBER__.`member_id`,`m_userid`,`m_username`,`m_email`,`m_reg_time`,`m_reg_ip`,`m_login_time`,`m_login_ip`,`m_experience`,`m_points`,`m_status`,__MEMBER__.`member_model_id`,`mm_alias`,`mm_name`,__MEMBER__.`member_level_id`,`ml_name`' . $addonFields)
				->join('__MEMBER_MODEL__ AS mm ON mm.member_model_id = __MEMBER__.member_model_id')
				->join('__MEMBER_LEVEL__ AS ml ON ml.member_level_id = __MEMBER__.member_level_id')
				->join('__' . strtoupper($_MMI['mm_addon_table']) . '__ AS addon ON addon.member_id = __MEMBER__.member_id')
				->where($where)->order($order)->limit($limit)->select();

			/* deal with addon field */
			if(!empty($_ML)) {
				load('field#func');
				foreach($_ML as $k => $a) {
					foreach($_MMI['mm_field'] as $field => $params) {
						if(isset($a[$field])) {
							$_ML[$k][$field] = deal_fieldValue($a[$field], $params, $output);
						}
					}
				}
			}
		}
		else {
			$_ML = M('Member')->field('__MEMBER__.`member_id`,`m_userid`,`m_username`,`m_email`,`m_reg_time`,`m_reg_ip`,`m_login_time`,`m_login_ip`,`m_experience`,`m_points`,`m_status`,__MEMBER__.`member_model_id`,`mm_alias`,`mm_name`,__MEMBER__.`member_level_id`,`ml_name`')
				->join('__MEMBER_MODEL__ AS mm ON mm.member_model_id = __MEMBER__.member_model_id')
				->join('__MEMBER_LEVEL__ AS ml ON ml.member_level_id = __MEMBER__.member_level_id')
				->where($where)->order($order)->limit($limit)->select();
		}

		return $_ML;
	}

	public function add_member($data, $addon = true, $credit = true) {
		$result = array('data' => '', 'error' => '');

		unset($data['member_id']);
		$data['member_id'] = $this->insert($data);
		if(false === $data['member_id']) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $data['member_id'];

		/* deal with data for addon table */
		if($addon) {
			$memberModelId = $data['member_model_id'];
			$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
			/* deal addon field */
			load('field#func');
			foreach($_MMI['mm_field'] as $tag => $params) {
				if(isset($data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $data);
				}
			}
			/* addon table model */
			if(false === M(parse_name($_MMI['mm_addon_table'], 1))->insert($data)) {
				$result['error'] = L('ADD_ADDON_DATA_FAILED');
				return $result;
			}
		}

		/* deal with credit */
		if($credit) {
			if(false === M('MemberCredit')->insert(array('member_id' => $data['member_id']))) {
				$result['error'] = L('ADD_CREDIT_DATA_FAILED');
				return $result;
			}
		}

		return $result;
	}

	public function edit_member($data, $addon = true, $credit = true) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_FAILED');
			return $result;
		}

		/* deal with addon table */
		if($addon) {
			$memberModelId = $data['member_model_id'];
			$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
			/* addon table field */
			if(!empty($_MMI['mm_field'])) {
				load('field#func');
				foreach($_MMI['mm_field'] as $tag => $params) {
					if(isset($data[$tag])) {
						$data[$tag] = get_fieldValue($tag, $params, $data);
					}
				}
			}
			if(false === M(parse_name($_MMI['mm_addon_table'], 1))->update($data)) {
				$result['error'] = L('UPDATE_ADDON_DATA_FAILED');
				return $result;
			}
		}

		/* credit */
		if($credit) {
			if(false === M('MemberCredit')->update($data)) {
				$result['error'] = L('UPDATE_CREDIT_DATA_FAILED');
				return $result;
			}
		}

		return $result;
	}

	public function delete_member($memberId) {

		$result = array('data' => '', 'error' => '');

		/* whether it is admin */
		$isAdmin = M('Admin')->is_admin($memberId);
		if($isAdmin) {
			$result['error'] = L('ADMIN_IS_LOCKED');
			return $result;
		}

		$_MI = $this->get_memberInfo($memberId);
		if(empty($_MI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->delete($memberId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete addon table information */
		if(false === M(parse_name($_MI['mm_addon_table'], 1))->delete($memberId)) {
			$result['error'] = L('DELETE_ADDON_DATA_FAILED');
			return $result;
		}

		/* delete credit information */
		if(false === M('MemberCredit')->delete($memberId)) {
			$result['error'] = L('DELETE_CREDIT_DATA_FAILED');
			return $result;
		}

		/* delete upload information */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'member'), 'u_item_id' => array('EQ', $memberId)))->select();
		if(!empty($_UL)) {
			foreach($_UL as $u) {
				if(__HOST__ == substr($u['u_src'], 0, strlen(__HOST__))) {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . substr($u['u_src'], strlen(__HOST__))));
				}
				else {
					@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . $u['u_src']));
				}
			}
		}
		M('Upload')->where(array('u_item_type' => array('EQ', 'member'), 'u_item_id' => array('EQ', $memberId)))->delete();

		return $result;
	}

	public function check_userid($userid) {
		$userid = strtolower(trim($userid));
		$_o_m = M('Option')->get_option('member');
		if(in_array($userid, explode(',', $_o_m['name_ban']))) {
			return false;
		}
		$result = M('Member')->field('m_userid')->where(array('m_userid' => array('EQ', $userid)))->find();
		if(!empty($result)) {
			return false;
		}
		return true;
	}

	public function check_email($email) {
		$email = strtolower(trim($email));
		$result = M('Member')->field('m_email')->where(array('m_email' => array('EQ', $email),'m_status' => array('EQ', 1)))->find();
		if(!empty($result)) {
			return false;
		}
		return true;
	}

	public function get_mlRank($memberId) {
		$mlId = $this->where(array('member_id' => array('EQ', $memberId)))->get_field('member_level_id');
		return M('MemberLevel')->where(array('member_level_id' => array('EQ', $mlId)))->get_field('ml_rank');
	}

	public function update_credit($memberId, $operation = 'publish', $add = true) {
		$data = array();
		$data['member_id'] = $memberId;
		$_mi = $this->where(array('member_id' => array('EQ', $memberId)))->field('m_experience,m_points')->find();
		$_o_moc = M('Option')->get_option('member/' . $operation . '_credit');
		if($add) {
			$data['m_experience'] = $_mi['m_experience'] + $_o_moc['m_experience'];
			$data['m_points'] = $_mi['m_points'] + $_o_moc['m_points'];
		}
		else {
			$data['m_experience'] = (0 < $_mi['m_experience'] - $_o_moc['m_experience']) ? ($_mi['m_experience'] - $_o_moc['m_experience']) : 0;
			$data['m_points'] = (0 < $_mi['m_points'] - $_o_moc['m_points']) ? ($_mi['m_points'] - $_o_moc['m_points']) : 0;
		}
		$this->update($data);

		$data = array();
		$_mc = M('MemberCredit')->where(array('member_id' => array('EQ', $memberId)))->find();
		foreach($_o_moc as $k => $v) {
			if('m_experience' == $k or 'm_points' == $k or 0 == $v) {
				continue;
			}
			if($add) {
				$data[$k] = $_mc[$k] + $v;
			}
			else {
				$data[$k] = (0 < $_mc[$k] - $v) ? ($_mc[$k] - $v) : 0;
			}
		}
		if(!empty($data)) {
			$data['member_id'] = $memberId;
			M('MemberCredit')->update($data);
		}
	}

	public function pass_member($memberId) {
		$result = array('data' => '', 'error' => '');

		$_MI = $this->where(array('member_id' => array('EQ', $memberId)))->find();
		if(empty($_MI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('member_id' => array('EQ', $memberId)))->set_field('m_status', 1)) {
			$result['error'] = L('PASS_FAILED');
			return $result;
		}

		return $result;
	}

	public function forbidden_member($memberId) {
		$result = array('data' => '', 'error' => '');

		$_MI = $this->where(array('member_id' => array('EQ', $memberId)))->find();
		if(empty($_MI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('member_id' => array('EQ', $memberId)))->set_field('m_status', 2)) {
			$result['error'] = L('FORBIDDEN_FAILED');
			return $result;
		}

		return $result;
	}

	public function send_verify_email($memberId) {
		$_MI = M('Member')->field('`member_id`,`m_username`,`m_status`,`m_email`')->find($memberId);
		if(empty($_MI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(0 != $_MI['m_status']) {
			$result['error'] = L('MEMBER_STATUS_NOT_MATCH');
			return $result;
		}

		/* check email send validity */
		$validity = M('Option')->get_option('member/verify_email_validity');
		$_MEVI = M('MemberEmailVerify')->where(array('member_id' => array('EQ', $memberId)))->find();
		if(!empty($_MEVI)) {
			if(time() < $_MEVI['mev_add_time'] + $validity) {
				$result['error'] = L('_TRY_LATER_');
				return $result;
			}
			M('MemberEmailVerify')->where(array('member_id' => array('EQ', $memberId)))->delete();
		}

		/* insert verify data */
		$data = array();
		$data['mev_code'] = AString::rand_string(32);
		$data['mev_add_time'] = time();
		$data['member_id'] = $_MI['member_id'];
		if(false == M('MemberEmailVerify')->insert($data)) {
			$result['error'] = L('INSERT_VERIFY_DATA_FAILD');
			return $result;
		}

		/* email data */
		$emailData = array();
		$emailData['~username~'] = $_MI['m_username'];
		$emailData['~site_name~'] = M('Option')->get_option('site/name');
		$emailData['~site_host~'] = M('Option')->get_option('site/host');
		$emailData['~datetime~'] = date('Y-m-d H:i:s', $data['mev_add_time']);
		$emailData['~validity~'] = second_format($validity);
		$verify_url = Url::U('member@common/member_email_verify?member_id=' . $data['member_id'] . '&mevc=' . $data['mev_code']);
		$verify_url = preg_match("/^http:\/\//i", $verify_url) ? $verify_url : rtrim(__HOST__, '/') . $verify_url;
		$emailData['~verify_url~'] = $verify_url;

		$emailRecipient = array('email' => $_MI['m_email'], 'name' => $_MI['m_username']);
		$emailTitle = $siteName . ' ' . L('MEMBER_EMAIL_VERIFY');

		$_t_result = M('Email')->send_tpl_email($emailRecipient, $emailTitle, 'member_email_verify.php', $emailData);
		if(!empty($_t_result['error'])) {
			$result['error'] = $_t_result['error'];
			return $result;
		}

		return $result;
	}
}

?>