<?php

/**
 *--------------------------------------
 * Ajax need check permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-01-05
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AjaxCtrlr extends ManageCtrlr {

	/* get archive channel model id */
	public function get_model_id() {
		$archiveChannelId = ARequest::get('archive_channel_id');
		$_ACI = M('ArchiveChannel')->find($archiveChannelId);
		if(!empty($_ACI)) {
			$this->ajax_return(array('data' => 1, 'info' => $_ACI['archive_model_id']));
		}
		$this->ajax_return(array('data' => 0));
	}

	/* get archive channel html directory */
	public function get_html_dir() {
		$archiveChannelId = ARequest::get('archive_channel_id');
		$_ACI = M('ArchiveChannel')->find($archiveChannelId);
		if(!empty($_ACI)) {
			$this->ajax_return(array('data' => 1, 'info' => $_ACI['ac_html_dir']));
		}
		else {
			$_o = M('Option')->get_option('core');
			$this->ajax_return(array('data' => 1, 'info' => '{uwa_path}' . trim($_o['html_path'], '/')));
		}
	}

	/* get channel list select */
	public function get_channel_select() {
		$data = array('data' => 0);

		$archiveModelId = intval(ARequest::get('archive_model_id'));
		$_ACL = M('ArchiveChannel')->get_myChannelList($archiveModelId);

		$archiveChannelId = intval(ARequest::get('archive_channel_id'));
		$selectType = 'current' == ARequest::get('select_type') ? 'current' : 'sub';

		$channelSelect = M('ArchiveChannel')->get_channelSelect($_ACL, $archiveChannelId, $selectType);
		$data = array('data' => 1, 'info' => $channelSelect);
		$this->ajax_return($data);
	}

	/* get archive channel default show template */
	public function get_default_show_template() {
		$archiveModelId = ARequest::get('archive_model_id');
		$info = M('ArchiveModel')->field('`ac_tpl_index_default`, `ac_tpl_list_default`, `ac_tpl_archive_default`')->where(array('archive_model_id' => array('EQ', $archiveModelId)))->select();
		if(!empty($info)) {
			$tpls['ac_tpl_index'] = $info[0]['ac_tpl_index_default'];
			$tpls['ac_tpl_list'] = $info[0]['ac_tpl_list_default'];
			$tpls['ac_tpl_archive'] = $info[0]['ac_tpl_archive_default'];
			$this->ajax_return(array('data' => 1, 'info' => $tpls));
		}
		$this->ajax_return(array('data' => 0));
	}

	/* check model alias */
	public function check_model_alias() {
		$type = ARequest::get('type');
		$alias = ARequest::get('alias');
		if(empty($type) or empty($alias)) {
			$this->ajax_return(array('data' => 0));
		}
		if('archive' == strtolower($type)) {
			$_AL = M('ArchiveModel')->field('am_alias')->select();
			foreach($_AL as $a) {
				if($alias == $a['am_alias']) {
					$this->ajax_return(array('data' => 0));
				}
			}
		}
		elseif('member' == strtolower($type)) {
			$_AL = M('MemberModel')->field('mm_alias')->select();
			foreach($_AL as $a) {
				if($alias == $a['mm_alias']) {
					$this->ajax_return(array('data' => 0));
				}
			}
		}
		elseif('custom' == strtolower($type)) {
			$_AL = M('CustomModel')->field('cm_alias')->select();
			foreach($_AL as $a) {
				if($alias == $a['cm_alias']) {
					$this->ajax_return(array('data' => 0));
				}
			}
		}
		$this->ajax_return(array('data' => 1));
	}

	/* check addon table */
	public function check_table() {
		$_table = ARequest::get('table');
		if(empty($_table)) {
			$this->ajax_return(array('data' => 0));
		}
		$tables = M()->query("SHOW TABLES FROM `" . C('DB.NAME') . "`");
		foreach($tables as $table) {
			if(C('DB.PREFIX') . $_table . C('DB.SUFFIX') == $table['Tables_in_' . C('DB.NAME')]) {
				$this->ajax_return(array('data' => 0));
			}
		}
		$this->ajax_return(array('data' => 1));
	}

	/* get extension hashcode */
	public function get_extension_hashcode() {
		$extensionAlias = ARequest::get('e_alias');
		$extensionAuthor = ARequest::get('e_author');
		$extensionAuthorEmail = ARequest::get('e_author_email');
		if(empty($extensionAlias) or empty($extensionAuthor) or empty($extensionAuthorEmail)) {
			$this->ajax_return(L('EMPTY'));
		}
		$this->ajax_return(md5($extensionAlias . '|' . $extensionAuthor . '|' . $extensionAuthorEmail));
	}

	/* check archive title duplicate. not duplicate: return 0, duplicate: return 1 and archive_id */
	public function check_duplicate_archive() {
		$data = array('data' => 0);

		$aTitle = trim(ARequest::get('a_title'));
		if(empty($aTitle)) {
			$this->ajax_return($data);
		}

		$ai = M('Archive')->field('archive_id')->where(array('a_title' => array('EQ', $aTitle)))->find();
		if(!empty($ai)) {
			$data = array('data' => 1, 'info' => $ai['archive_id']);
			$this->ajax_return($data);
		}

		$this->ajax_return($data);
	}

	/* get file content */
	public function get_file_content() {
		$data = array('data' => 0);
		$filename = ltrim(ARequest::get('filename'), '\\/');
		if(!empty($filename)) {
			$data = array('data' => 1, 'info' => file_get_contents(APP_PATH . D_S . $filename));
			$this->ajax_return($data);
		}
		$this->ajax_return($data);
	}

	/* delete file */
	public function delete_file() {
		$data = array('data' => 0);
		$filename = ltrim(ARequest::get('filename'), '\\/');

		if(!empty($filename)) {
			if(!check_token()) {
				$data = array('data' => 0, 'info' => L('DATA_INVALID'));
				$this->ajax_return($data);
			}

			if('core' == substr($filename, 0, 4)) {
				$data = array('data' => 0, 'info' => L('CORE_FILE_IS_LOCKED'));
				$this->ajax_return($data);
			}

			if(!@unlink(APP_PATH . D_S . $filename)) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE') . $filename, 0);
				$data = array('data' => 0, 'info' => L('DELETE_FAILED'));
				$this->ajax_return($data);
			}
			else {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE') . $filename);
				$data = array('data' => 1, 'info' => L('DELETE_SUCCESS'));
				$this->ajax_return($data);
			}
		}
		$data = array('data' => 0, 'info' => L('_FILE_NOT_EXIST_', null, array('file' => $filename)));
		$this->ajax_return($data);
	}

	/* get linkage select */
	public function get_linkage_select() {
		$data = array('data' => 0);

		$lAlias = ARequest::get('l_alias');
		if(empty($lAlias) or !AFilter::is_word($lAlias)) {
			$this->ajax_return($data);
		}

		$linkageItemId = intval(ARequest::get('linkage_item_id'));
		$selectType = 'current' == ARequest::get('select_type') ? 'current' : 'sub';

		$linkageSelect = M('Linkage')->get_linkageSelect($lAlias, $linkageItemId, $selectType);
		$data = array('data' => 1, 'info' => $linkageSelect);
		$this->ajax_return($data);
	}
}

?>