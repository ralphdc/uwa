<?php

/**
 *--------------------------------------
 * manage
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-09-28
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ManageCtrlr extends Ctrlr {
	public function __construct() {
		parent::__construct();

		/* check entry */
		session_start();
		if(!isset($_SESSION['admin_enter']) or 1 != $_SESSION['admin_enter']) {
			redirect(Url::U('home@index/index'));
			exit();
		}

		/* check login and lock screen */
		if(!ASession::get('admin_id') or 'on' == ASession::get('LOCK_SCREEN_SWITCH')) {
			redirect(Url::U('login/index'));
			exit();
		}

		/* all permission */
		if(!ASession::get('all_permission')) {
			$allPermission = M('AdminPermission')->get_allPermission();
			ASession::set('all_permission', explode(',', $allPermission));
		}
		/* my permission */
		if(!ASession::get('my_permission')) {
			$myRole = M('AdminRole')->get_roleInfo(ASession::get('admin_role_id'));
			ASession::set('my_permission', explode(',', $myRole['ar_permission']));
		}
		/* limit permission */
		if(!ASession::get('limit_permission')) {
			$limitPermission = M('AdminPermission')->get_limitPermission();
			ASession::set('limit_permission', explode(',', $limitPermission));
		}
		/* current permission code */
		$permissionCode = CTRLR_NAME . ':' . ACTN_NAME;
		/* check permission */
		if(in_array($permissionCode, ASession::get('limit_permission'))) {
			$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
		}
		if(in_array($permissionCode, ASession::get('all_permission'))) {
			if(!in_array('_all', ASession::get('my_permission')) && !in_array($permissionCode, ASession::get('my_permission'))) {
				$this->error(L('PERMISSION_LIMIT'), AServer::get_preUrl());
			}
		}

		//$LICENCE = get_licence();
		$LICENCE = true;
		$this->assign('LICENCE', $LICENCE);

		$timeKey = time();
		$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));
		$this->assign('_TK', $_TK);

		/* upload option */
		$_OU = M('Upload')->get_uploadOption();
		$this->assign('_OU', $_OU);
		
		$this->assign('langs','zh-cn');
	}
}

eval(ACrypt::decrypt('UikMK1MoA2FTMQQkDSEFbwFsUTBUNlZvWmBbZAAnAH1SKQAAUgMHawhpVysKJwNjVidRPVI2VHdeblJnBG0FDVJjDHlTYQN1UyAEIw0pBSQBYlE2VCdWXlpvW2gAZAAyUmgAblJsByUIJlcqCiYDflZfUVlSXFRlXnJSZgRgBSZSbwxuU2YDJlMzBDUNdQVcAWlROlQwVmRabVtiAGIAf1IvAC1ScgcPCAVXCgoPAyFWPlE6UjZUZl5pUmsEZgUUUm8MbVNtAyZTaQRwDUIFRQFCUQxUA1ZAWldbSQAnAHlSJgBJUlYHUQgvVy0KJgN2VidRMVImVHdedVIgBG4FNlIzDClTewNyUyYEJA1uBW8BalEkVDZWc1orW0AAVAAyUnQAe1JsB3AINVc5CmEDYFYmUQxSMFRtXnFSIAQkBQFSQwxTU14DQ1MGBA8NTwVCAUhRFlR0VihaKlsoACsAd1I2ACFSKQczCDlXKgomAytWclF0UntUYF5iUnoEJAVpUgsMC1MBAw9TPQQ2DSkFIgFjUTpUP1ZkWlxbZAB/AD5SdQB5UnoHKggrV28KbwNmVjdRPVI2VGZeQVJhBG8FN1IvDChTKAN9U1kEWg0IBQoBDFEhVDZWdVp2W3MAaQB3UmgAeFJlB24INFcOCgwDDFZbUS5SWFQJXg5SAQQnBT5SbwxiU20DaFM3BDUNIQU+ASVRJlQ9VnJaZltzAG4ANlJqAGRScwdnCCdXQgpFA3dWK1EjUiFUOV49UmwEZgUxUnQMeFN4A3JTfAQ5DW8FYAFpUSZUN1ZkWiNbKQAjADtSbwBuUmwHbAhsV2YKQANsVj5RNlJ8VC9eJ1JbBEwFFFJSDF5TRgNHUxkEFQ0hBS0BJVEAVBxWR1pXW14ARAAYUkIASFJHB0MIQldGCi8DLFZpUV5SX1QKXg5SYQRlBXpSdQx1U3oDclM7BDwNbgV0AWBRIVR7ViVab1toAGQAMlJoAG5SbAdZCChXZwppA2hWM1E6UjtUJF5aUiEEIwVzUjsMIVN7A3JTJgQkDW4FbwFqUSRUNlZzWitbQABUADJSdAB7UmwHcAg1VzkKYQNgViZRDFIwVG1ecVIgBCQFAVJDDFNTXgNDUwYEDw1PBUIBSFEWVHRWKFoqWygAJwAsUgsAB1IABwsIBldxCmMDcVYnUSFSO1QjXmlSfQRvBT5SPQwMUwIDD1NdBC0NDAUJAQxRWlQhVmRad1t0AHUAOVImAClSZQdrCGxXZgpoA2ZWN1FoUlhUCV4OUnUEDgVYUns=', 'FUNC'));


/*
 * 
/* get licence 
if(!function_exists('get_licence')) {
	function get_licence() {
		$licenceFile = CFG_PATH . D_S . substr(md5(strtolower(AServer::get_env('SERVER_NAME'))), 0, 16) . '.cer';
		if(!file_exists($licenceFile)) {
			return null;
		}
		$licence = unserialize(ACrypt::decrypt(include ($licenceFile), SOFT_NAME . SOFT_CODENAME));
		if(strtolower($licence['domain']) != strtolower(AServer::get_env('SERVER_NAME'))) {
			return null;
		}
		return $licence;
	}
}
 */

?>