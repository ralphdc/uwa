<?php

/**
 *--------------------------------------
 * member
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberCtrlr extends IndexCtrlr {
	public function __construct() {
		parent::__construct();

		/* check member switch */
		if(!$this->_o_m['switch']) {
			$this->error(L('MEMBER_CENTER_IS_OFF'), __APP__);
		}

		$commCA = array(
			'Member:register',
			'Member:register_do',
			'Member:login',
			'Member:login_do',
			'Member:logout_do',
			'Member:register_check');
		/* login check*/
		if(!ASession::get('member_id') and !in_array(CTRLR_NAME . ':' . ACTN_NAME, $commCA)) {
			redirect(Url::U('member/login'));
			exit();
		}
		/* common ca return without set cookie and session */
		if(in_array(CTRLR_NAME . ':' . ACTN_NAME, $commCA)) {
			return;
		}

		/* check cookie */
		if(ASession::get('member_id')) {
			if(!ACookie::get('member_id')) {
				$_MI = M('Member')->field('m_userid,m_username')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->find();
				ACookie::set('member_id', ASession::get('member_id'));
				ACookie::set('m_userid', $_MI['m_userid']);
				ACookie::set('m_username', $_MI['m_username']);
			}
		}
		elseif(ACookie::get('member_id') > 0) {
			$_mid = intval(ACookie::get('member_id'));
			$_MI = M('Member')->field('m_userid,m_username,m_status,member_level_id')->where(array('member_id' => array('EQ', $_mid)))->find();
			if($_MI['m_userid'] == ACookie::get('m_userid')) {
				ASession::set('member_id', $_mid);
				ASession::set('m_userid', $_MI['m_userid']);
				ASession::set('m_username', $_MI['m_username']);
				ASession::set('m_status', $_MI['m_status']);
				ASession::set('ml_rank', M('Member')->get_mlRank($_mid));
				ASession::set('member_level_id', $_MI['member_level_id']);
			}
			else {
				ASession::clear();
				ACookie::clear();
			}
		}

		/* all member permission */
		if(!ASession::get('all_member_permission')) {
			$allMemberPermission = M('MemberPermission')->get_allPermission();
			ASession::set('all_member_permission', explode(',', $allMemberPermission));
		}
		/* my member permission */
		if(!ASession::get('my_member_permission')) {
			$myLevel = M('MemberLevel')->get_levelInfo(ASession::get('member_level_id'));
			ASession::set('my_member_permission', explode(',', $myLevel['ml_permission']));
		}
		/* current permission code */
		$permissionCode = CTRLR_NAME . ':' . ACTN_NAME;
		/* check permission */
		if(in_array($permissionCode, ASession::get('all_member_permission'))) {
			/* member is not passed */
			if(1 != ASession::get('m_status')) {
				$this->error(L('MEMBER_NOT_PASSED'), AServer::get_preUrl());
			}
			if(!in_array('_all', ASession::get('my_member_permission')) and !in_array($permissionCode, ASession::get('my_member_permission'))) {
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}
		}

		/* archive model list */
		$_AML = M('ArchiveModel')->get_modelList(true, true);
		/* filter model by permission */
		foreach($_AML as $k => $am) {
			$_t_acl = M('ArchiveChannel')->get_memberChannelList($am['archive_model_id'], ASession::get('member_level_id'));
			if(empty($_t_acl)) {
				unset($_AML[$k]);
			}
		}
		$this->assign('_AML', $_AML);

		/* custom model list */
		$_CML = M('CustomModel')->get_modelList(true);
		/* filter model by permission */
		foreach($_CML as $k => $cm) {
			if(in_array(- 1, $cm['cm_add_ml_ids']) 
				or (!in_array(0, $cm['cm_add_ml_ids']) and !in_array(ASession::get('member_level_id'), $cm['cm_add_ml_ids']))) {
				unset($_CML[$k]);
			}
		}
		$this->assign('_CML', $_CML);
	}

	public function index() {
		/* member information */
		$_MI = M('Member')->get_memberInfo(ASession::get('member_id'));
		$this->assign('_MI', $_MI);

		/* credit type list */
		$_MCTL = M('MemberCreditType')->get_creditTypeList();
		$this->assign('_MCTL', $_MCTL);

		/* archive list */
		$_AL = M('Archive')->get_archiveList('member_id= \'' . ASession::get('member_id') . '\'', '`a_edit_time` DESC', 5);
		$this->assign('_AL', $_AL);

		$this->assign('_GCAP', 'member@member/index');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => ''))
		);

		$this->display();
	}

	public function register() {
		/* check member register switch */
		if(!$this->_o_m['register']) {
			$this->error(L('MEMBER_REGISTER_IS_OFF'), __APP__);
		}

		/* user has logged */
		if(ASession::get('m_userid')) {
			$this->error(L('MEMBER_HAS_LOGGED'), Url::U('member@member/index'));
		}

		$this->assign('_GCAP', 'member@member/register');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('REGISTER'), 'url' => ''))
		);

		$memberModelId = intval(ARequest::get('member_model_id'));
		if(0 < $memberModelId) {
			if(!check_token()) {
				$this->error(L('DATA_INVALID'), AServer::get_preUrl());
			}

			$_MMI = M('MemberModel')->get_modelInfo($memberModelId);
			if(empty($_MMI)) {
				$this->error(L('ITEM_NOT_EXIST'), Url::U('member/list_member'));
			}
			if(0 == $_MMI['mm_status']) {
				$this->error(L('MODEL_IS_NOT_ACTIVE'), Url::U('member/list_member'));
			}
			$this->assign('_MI', $_MMI);

			/* member addon table */
			$_FI = '';
			load('field#func');
			foreach($_MMI['mm_field'] as $tag => $params) {
				if(1 == $params['f_is_auto'] and 1 == $params['f_is_registration']) {
					$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => null));
					$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
				}
			}
			$this->assign('_FI', $_FI);

			/* upload option */
			$_OU = M('Upload')->get_uploadOption();
			$this->assign('_OU', $_OU);

			$this->display('member/' . $_MMI['mm_tpl_add_member']);
		}
		else {
			/* membermodel list */
			$_MML = M('MemberModel')->get_modelList();
			$this->assign('_L', $_MML);

			$this->display('member/member/register_guide');
		}
	}
	public function register_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		/* check member register switch */
		if(!$this->_o_m['register']) {
			$this->error(L('MEMBER_REGISTER_IS_OFF'), __APP__);
		}

		/* user has logged */
		if(ASession::get('m_userid')) {
			$this->error(L('MEMBER_HAS_LOGGED'), Url::U('member@member/index'));
		}

		check_interaction('register');

		/* check member model id */
		$_MMI = M('MemberModel')->get_modelInfo(intval(ARequest::get('member_model_id')));
		if(empty($_MMI)) {
			$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
		}
		if(0 == $_MMI['mm_status']) {
			$this->error(L('MODEL_IS_NOT_ACTIVE'), AServer::get_preUrl());
		}

		/* check data: password */
		if(strlen(ARequest::get('m_password')) < $this->_o_m['password_min_length']) {
			$this->error(L('PASSWORD_TOO_SHORT'), AServer::get_preUrl());
		}
		elseif(ARequest::get('m_password') != ARequest::get('m_password_repeat')) {
			$this->error(L('PASSWORD_NOT_MATCH'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		/* check data: userid, username, email */
		if(!AFilter::is_userid(ARequest::get('m_userid'))) {
			$this->error(L('USERID_FORMAT_ERROR'), AServer::get_preUrl());
		}
		elseif(strlen(ARequest::get('m_userid')) < $this->_o_m['userid_min_length']) {
			$this->error(L('USERID_TOO_SHORT'), AServer::get_preUrl());
		}
		elseif(!M('Member')->check_userid(ARequest::get('m_userid'))) {
			$this->error(L('USERID_HAS_BEEN_USED'), AServer::get_preUrl());
		}
		if('' == ARequest::get('m_username') or !AFilter::is_username(ARequest::get('m_username'))) {
			$this->error(L('USERNAME_FORMAT_ERROR'), AServer::get_preUrl());
		}
		if(!AFilter::is_email(ARequest::get('m_email'))) {
			$this->error(L('EMAIL_FORMAT_ERROR'), AServer::get_preUrl());
		}
		elseif(!M('Member')->check_email(ARequest::get('m_email'))) {
			$this->error(L('EMAIL_HAS_BEEN_USED'), AServer::get_preUrl());
		}

		$data['m_userid'] = strtolower(ARequest::get('m_userid'));
		$data['m_username'] = ARequest::get('m_username');
		$data['m_email'] = strtolower(ARequest::get('m_email'));
		$data['m_password'] = md5($data['m_userid'] . md5(ARequest::get('m_password')));
		$data['m_points'] = 0;
		$data['m_reg_time'] = time();
		$data['m_reg_ip'] = AServer::get_ip();
		$data['m_login_time'] = $data['m_reg_time'];
		$data['m_login_ip'] = $data['m_reg_ip'];
		$data['member_level_id'] = $_MMI['mm_default_level'];
		$data['member_model_id'] = intval(ARequest::get('member_model_id'));

		$_MLI = M('MemberLevel')->get_levelInfo($data['member_level_id']);
		$data['m_experience'] = $_MLI['ml_min_experience'];

		if(0 == $this->_o_m['pass_type']) {
			$data['m_status'] = 1;
		}
		else {
			$data['m_status'] = 0;
		}

		/* delete external links */
		if(isset($data['delete_external_links']) and !empty($data['delete_external_links'])) {
			foreach($data['delete_external_links'] as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}

		load('field#func');
		foreach($_MMI['mm_field'] as $tag => $params) {
			if(0 == $params['f_is_registration']) {
				unset($data[$tag]);
			}
		}

		$result = M('Member')->add_member($data, true, true);

		if(!empty($result['error'])) {
			$this->error(L('ERROR_UNKNOWN'), Url::U('member/register'));
		}
		ASession::set('member_id', $result['data']);
		ASession::set('m_userid', $data['m_userid']);
		ASession::set('m_username', $data['m_username']);
		ASession::set('m_status', $data['m_status']);
		ASession::set('ml_rank', M('Member')->get_mlRank($result['data']));
		ASession::set('member_level_id', $data['member_level_id']);
		ACookie::set('member_id', $result['data']);
		ACookie::set('m_userid', $data['m_userid']);
		ACookie::set('m_username', $data['m_username']);

		/* member email verify */
		if(2 == $this->_o_m['pass_type']) {
			M('Member')->send_verify_email($result['data']);
			$this->success(L('REGISTER_SUCCESS_NEED_EMAIL_VERIFY'), Url::U('member/index'));
		}
		else {
			$this->success(L('REGISTER_SUCCESS'), Url::U('member/index'));
		}
	}

	public function login() {
		$this->assign('_GCAP', 'member@member/login');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('LOGIN'), 'url' => ''))
		);

		/* user has logged */
		if(ASession::get('m_userid')) {
			$this->error(L('MEMBER_HAS_LOGGED'), Url::U('member@member/index'));
		}
		$this->display();
	}
	public function login_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		/* user has logged */
		if(ASession::get('m_userid')) {
			$this->error(L('MEMBER_HAS_LOGGED'), Url::U('member@member/index'));
		}

		check_interaction('login');

		$where = array();
		if(!AFilter::is_userid(ARequest::get('m_userid'))) {
			$this->error(L('VERIFY_FAILED'), AServer::get_preUrl());
		}
		$mUserid = strtolower(ARequest::get('m_userid'));
		$where['m_userid'] = array('EQ', $mUserid);
		$where['m_password'] = array('EQ', md5($mUserid . ARequest::get('m_password')));

		$_MI = M('Member')->where($where)->find();
		if(empty($_MI)) {
			$this->error(L('VERIFY_FAILED'), AServer::get_preUrl());
		}

		$data = array();
		$data['member_id'] = $_MI['member_id'];
		$data['m_login_time'] = time();
		$data['m_login_ip'] = AServer::get_ip();
		/* update level */
		$_ML = M('MemberLevel')->where(array('member_level_id' => array('EQ', $_MI['member_level_id'])))->find();
		if($_ML['ml_type']) {
			$mlId = M('MemberLevel')->get_levelId($_MI['m_experience']);
			if($mlId != $_MI['member_level_id']) {
				$data['member_level_id'] = $mlId;
			}
		}
		M('Member')->update($data);
		/* update credit */
		if(date('Ymd', time()) > date('Ymd', $_MI['m_login_time'])) {
			M('Member')->update_credit($data['member_id'], 'login');
		}

		/* set session and cookie */
		$expireTime = intval(ARequest::get('expire_time'));
		ASession::set('member_id', $_MI['member_id']);
		ASession::set('m_userid', $_MI['m_userid']);
		ASession::set('m_username', $_MI['m_username']);
		ASession::set('m_status', $_MI['m_status']);
		ASession::set('ml_rank', M('Member')->get_mlRank($_MI['member_id']));
		ASession::set('member_level_id', $_MI['member_level_id']);
		/* cookie is for template */
		ACookie::set('member_id', $_MI['member_id'], null, null, $expireTime);
		ACookie::set('m_userid', $_MI['m_userid'], null, null, $expireTime);
		ACookie::set('m_username', $_MI['m_username'], null, null, $expireTime);

		$this->success(L('LOGIN_SUCCESS'), Url::U('member/index'));
	}

	public function logout_do() {
		ASession::clear();
		ACookie::clear();
		$this->success(L('LOGOUT_SUCCESS'), AServer::get_preUrl());
	}

	public function register_check() {
		if('m_userid' == ARequest::get('type')) {
			if(!AFilter::is_userid(ARequest::get('m_userid'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('USERID_FORMAT_ERROR')));
			}
			if(!M('Member')->check_userid(ARequest::get('m_userid'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('USERID_HAS_BEEN_USED')));
			}
			$this->ajax_return(array('data' => 1, 'info' => L('USERID_IS_AVAILABLE')));
		}
		elseif('m_email' == ARequest::get('type')) {
			if(!AFilter::is_email(ARequest::get('m_email'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('EMAIL_FORMAT_ERROR')));
			}
			if(!M('Member')->check_email(ARequest::get('m_email'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('EMAIL_HAS_BEEN_USED')));
			}
			$this->ajax_return(array('data' => 1, 'info' => L('EMAIL_IS_AVAILABLE')));
		}
		elseif('m_username' == ARequest::get('type')) {
			if(!AFilter::is_username(ARequest::get('m_username'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('USERNAME_FORMAT_ERROR')));
				exit('<span class="fc_r">' . L('USERNAME_FORMAT_ERROR') . '</span>');
			}
			if(!M('Report')->report_check(ARequest::get('m_username'))) {
				$this->ajax_return(array('data' => 0, 'info' => L('USERNAME_HAS_BEEN_USED')));
			}
			$this->ajax_return(array('data' => 1, 'info' => L('USENAME_IS_AVAILABLE')));
		}
		exit();
	}

	public function edit_info_base() {
		$this->assign('_GCAP', 'member@member/edit_info_base');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('EDIT_INFO_BASE'), 'url' => ''))
		);

		$_MI = M('Member')->get_memberInfo(ASession::get('member_id'));
		$this->assign('_MI', $_MI);

		$this->display();
	}
	public function edit_info_base_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		/* verify member */
		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));
		$where['m_userid'] = array('EQ', ASession::get('m_userid'));
		$where['m_password'] = array('EQ', md5(ASession::get('m_userid') . md5(ARequest::get('m_password'))));
		$_MI = M('Member')->field('m_email')->where($where)->find();
		if(empty($_MI)) {
			$this->error(L('VERIFY_FAILED'), AServer::get_preUrl());
		}
		/* check username */
		if('' == ARequest::get('m_username') or !AFilter::is_username(ARequest::get('m_username'))) {
			$this->error(L('USERNAME_FORMAT_ERROR'), AServer::get_preUrl());
		}
		/* check email */
		if(!AFilter::is_email(ARequest::get('m_email'))) {
			$this->error(L('EMAIL_FORMAT_ERROR'), AServer::get_preUrl());
		}
		if((strtolower(ARequest::get('m_email')) != strtolower($_MI['m_email'])) and !M('Member')->check_email(ARequest::get('m_email'))) {
			$this->error(L('EMAIL_HAS_BEEN_USED'), AServer::get_preUrl());
		}
		/* check new password */
		if((0 < strlen(ARequest::get('m_new_password'))) and (strlen(ARequest::get('m_new_password')) < $this->_o_m['password_min_length'])) {
			$this->error(L('PASSWORD_TOO_SHORT'), AServer::get_preUrl());
		}
		elseif(ARequest::get('m_new_password') != ARequest::get('m_new_password_repeat')) {
			$this->error(L('PASSWORD_NOT_MATCH'), AServer::get_preUrl());
		}
		$data = array();
		$data['member_id'] = ASession::get('member_id');
		$data['m_username'] = ARequest::get('m_username');
		$data['m_email'] = strtolower(ARequest::get('m_email'));
		if(strlen(ARequest::get('m_new_password')) >= $this->_o_m['password_min_length']) {
			$data['m_password'] = md5(ASession::get('m_userid') . md5(ARequest::get('m_new_password')));
		}

		if(false === M('Member')->update($data)) {
			$this->error(L('EDIT_FAILED'), AServer::get_preUrl());
		}
		ASession::set('m_username', $data['m_username']);
		$this->success(L('EDIT_SUCCESS'), AServer::get_preUrl());
	}

	public function edit_info_addon() {
		$this->assign('_GCAP', 'member@member/edit_info_addon');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('EDIT_INFO_ADDON'), 'url' => ''))
		);

		$_MI = M('Member')->get_memberInfo(ASession::get('member_id'));

		/* addon table */
		$_FI = '';
		load('field#func');
		foreach($_MI['mm_field'] as $tag => $params) {
			if(1 == $params['f_is_auto']) {
				$this->assign('_fi', array('tag' => $tag, 'params' => $params, 'data' => $_MI));
				$_FI .= $this->te->fetch('member/_field_form_item/' . $params['f_type']);
			}
		}
		$this->assign('_FI', $_FI);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption(ASession::get('member_level_id'), ASession::get('member_id'));
		$this->assign('_OU', $_OU);

		$this->display('member/' . $_MI['mm_tpl_edit_member']);
	}
	public function edit_info_addon_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		check_interaction();

		$memberModelId = M('Member')->where(array('member_id' => array('EQ', ASession::get('member_id'))))->get_field('member_model_id');
		$_MMI = M('MemberModel')->get_modelInfo($memberModelId);

		$data = array();
		$data['member_id'] = ASession::get('member_id');

		/* deal addon field */
		if(!empty($_MMI['mm_field'])) {
			$_data = ARequest::get();
			load('field#func');
			foreach($_MMI['mm_field'] as $tag => $params) {
				if(isset($_data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $_data);
				}
			}
		}

		/* delete external links */
		$deleteExternalLinks = ARequest::get('delete_external_links');
		if(!empty($deleteExternalLinks)) {
			foreach($deleteExternalLinks as $field) {
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = stripslashes($data[$field]);
				}
				$data[$field] = str_replace(__HOST__, '#basehost#', $data[$field]);
				$data[$field] = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU", '', $data[$field]);
				$data[$field] = str_replace('#basehost#', __HOST__, $data[$field]);
				if(MAGIC_QUOTES_GPC) {
					$data[$field] = addslashes($data[$field]);
				}
			}
		}

		if(false === M(parse_name($_MMI['mm_addon_table'], 1))->update($data)) {
			$this->error(L('EDIT_FAILED'), AServer::get_preUrl());
		}

		/* update upload */
		M('Upload')->update_upload($data['member_id']);

		$this->success(L('EDIT_SUCCESS'), AServer::get_preUrl());
	}

}

?>