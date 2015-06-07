<?php

/**
 *--------------------------------------
 * Ajax need check permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-10
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AjaxCtrlr extends MemberCtrlr {
	/* get channel list select */
	public function get_channel_select() {
		$data = array('data' => 0);

		$archiveModelId = intval(ARequest::get('archive_model_id'));
		$_ACL = M('ArchiveChannel')->get_memberChannelList($archiveModelId, ASession::get('member_level_id'));

		$archiveChannelId = intval(ARequest::get('archive_channel_id'));
		$selectType = 'current' == ARequest::get('select_type') ? 'current' : 'sub';

		$channelSelect = M('ArchiveChannel')->get_channelSelect($_ACL, $archiveChannelId, $selectType);
		$data = array('data' => 1, 'info' => $channelSelect);
		$this->ajax_return($data);
	}
}

?>