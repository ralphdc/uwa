<?php

/**
 *--------------------------------------
 * archive channel
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-3
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveChannelModl extends Modl {
	public function get_allChannel() {
		$_ACL = F('~acl_all');
		if(empty($_ACL)) {
			$_ACL = $this->field('`archive_channel_id`,`ac_name`,`ac_thumb`,`ac_keywords`,`ac_description`,`ac_parent_id`,`ac_display_switch`,`ac_display_order`,`ac_view_ml_ids`,`ac_add_ml_ids`,`ac_url`,`ac_url_o`,am.`archive_model_id`,`am_alias`,`am_name`,`am_status`')
				->join('__ARCHIVE_MODEL__ AS am ON am.archive_model_id = __ARCHIVE_CHANNEL__.archive_model_id')->order('`ac_display_order` ASC')->select();
			if(!empty($_ACL)) {
				foreach($_ACL as $k => $ac) {
					$_ACL[$k]['ac_view_ml_ids'] = explode(',', $ac['ac_view_ml_ids']);
					$_ACL[$k]['ac_add_ml_ids'] = explode(',', $ac['ac_add_ml_ids']);

					/* default thumb */
					if(empty($ac['ac_thumb'])) {
						$_ACL[$k]['ac_thumb'] = __APP__ . 'u/site/default_channel_thumb.png';
					}
				}
				F('~acl_all', $_ACL);
			}
		}
		return $_ACL;
	}

	public function get_channelList($archiveModelId = 0, $acParentId = 0, $displayFilter = false, $limit = 500, $tree = false) {
		$_ACL = $this->get_allChannel();
		if(!empty($_ACL)) {
			foreach($_ACL as $key => $value) {
				/* filter model */
				if(0 < $archiveModelId and $archiveModelId != $value['archive_model_id']) {
					unset($_ACL[$key]);
				}
				/* filter display */
				if($displayFilter and !$value['ac_display_switch']) {
					unset($_ACL[$key]);
				}
			}

			if($tree) {
				$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'));
				$_ACL = $act->get_leaf($acParentId);
			}

			/* limit */
			if(0 < $limit) {
				$_ACL = array_slice($_ACL, 0, $limit);
			}
			return $_ACL;
		}
		return null;
	}

	/* get channel list for member */
	public function get_memberChannelList($archiveModelId = 0, $memberLevelId = 0, $idsOnly = false) {
		$_ACL = $this->get_allChannel();
		if(!empty($_ACL)) {
			$ids = '';
			/* filter model and permission */
			foreach($_ACL as $key => $value) {
				if((0 < $archiveModelId and $archiveModelId != $value['archive_model_id']) 
				or in_array(- 1, $value['ac_add_ml_ids']) 
				or (!in_array(0, $value['ac_add_ml_ids']) and !in_array($memberLevelId, $value['ac_add_ml_ids']))) {
					unset($_ACL[$key]);
				}
				else {
					$ids .= $_ACL[$key]['archive_channel_id'] . ',';
				}
			}
			if($idsOnly) {
				return trim($ids, ',');
			}
			return $_ACL;
		}
		return null;
	}

	/* get my channel list */
	public function get_myChannelList($archiveModelId = 0, $acParentId = 0) {
		$_t_AI = M('Admin')->get_adminInfo(ASession::get('admin_id'));
		$myChannel = $_t_AI['a_ac_id'];

		$_ACL = $this->get_allChannel();

		if(!empty($_ACL)) {
			/* filter model */
			if(0 < $archiveModelId) {
				foreach($_ACL as $key => $value) {
					if($archiveModelId != $value['archive_model_id']) {
						unset($_ACL[$key]);
					}
				}
			}

			/* filter permission */
			if(!in_array('_all', $myChannel)) {
				foreach($_ACL as $k => $v) {
					if(!in_array($v['archive_channel_id'], $myChannel)) {
						unset($_ACL[$k]);
					}
				}
			}
			return $_ACL;
		}
		return null;
	}

	public function get_channelInfo($archiveChannelId) {
		$_ACI = F('~aci/~ac_' . $archiveChannelId);
		if(empty($_ACI)) {
			$_ACI = $this->join('__ARCHIVE_MODEL__ AS am ON am.archive_model_id = __ARCHIVE_CHANNEL__.archive_model_id')->where(array('__ARCHIVE_CHANNEL__.archive_channel_id' => array('EQ', $archiveChannelId)))->find();
			if(!empty($_ACI)) {
				/* get parent channel */
				if(0 < $_ACI['ac_parent_id']) {
					$_t_ac_parent = $this->where(array('archive_channel_id' => array('EQ', $_ACI['ac_parent_id'])))->find();
					if(!empty($_t_ac_parent)) {
						$_ACI['ac_parent'] = $_t_ac_parent;
					}
				}

				/* default thumb */
				if(empty($_ACI['ac_thumb'])) {
					$_ACI['ac_thumb'] = __APP__ . 'u/site/default_channel_thumb.png';
				}

				/* get sibling channel */
				$_t_ac_sibling = $this->where(array('ac_parent_id' => array('EQ', $_ACI['ac_parent_id']), 'ac_display_switch' => array('EQ', 1)))->order('`ac_display_order` ASC')->select();
				if(!empty($_t_ac_sibling)) {
					$_ACI['ac_sibling'] = $_t_ac_sibling;
				}

				/* update url */
				if(empty($_ACI['ac_url']) or empty($_ACI['ac_url_o'])) {
					$_r = $this->build_url($_ACI['archive_channel_id']);
					$_ACI['ac_url'] = $_r['ac_url'];
					$_ACI['ac_url_o'] = $_r['ac_url_o'];
				}

				/* get position */
				$_ACL = $this->get_allChannel();
				$act = new ATree($_ACL, array(
					'archive_channel_id',
					'ac_parent_id',
					'ac_sub_channel'));
				$navi = $act->get_navi($archiveChannelId);
				$_ACI['ac_position'] = array();
				$_ACI['ac_position'][] = array('name' => L('HOME'), 'url' => __APP__);
				$_ACI['ac_position_o'] = array();
				$_ACI['ac_position_o'][] = array('name' => L('HOME'), 'url' => __APP__);
				foreach($navi as $k => $v) {
					$_ACI['ac_position'][] = array('name' => $v['ac_name'], 'url' => $v['ac_url']);
					$_ACI['ac_position_o'][] = array('name' => $v['ac_name'], 'url' => $v['ac_url_o']);
				}

				/* get model addon field */
				$at = get_instance('ATag', 'field');
				$at->tags = array();
				$at->parse_content($_ACI['am_fieldset']);
				$_ACI['am_field'] = $at->tags;

				$_ACI['ac_view_ml_ids'] = explode(',', $_ACI['ac_view_ml_ids']);
				$_ACI['ac_add_ml_ids'] = explode(',', $_ACI['ac_add_ml_ids']);
			}
			F('~aci/~ac_' . $archiveChannelId, $_ACI);
		}
		return $_ACI;
	}

	public function add_channel($data) {
		$result = array('data' => '', 'error' => '');

		if(in_array(0, $data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = -1;
		}
		elseif(!empty($data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = implode(',', $data['ac_view_ml_ids']);
		}

		if(in_array(0, $data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = -1;
		}
		elseif(!empty($data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = implode(',', $data['ac_add_ml_ids']);
		}

		unset($data['archive_channel_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~acl_all', null);

		return $result;
	}

	public function edit_channel($data) {
		$result = array('data' => '', 'error' => '');

		if(in_array(0, $data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = -1;
		}
		elseif(!empty($data['ac_view_ml_ids'])) {
			$data['ac_view_ml_ids'] = implode(',', $data['ac_view_ml_ids']);
		}

		if(in_array(0, $data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = -1;
		}
		elseif(!empty($data['ac_add_ml_ids'])) {
			$data['ac_add_ml_ids'] = implode(',', $data['ac_add_ml_ids']);
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~aci/~ac_' . $data['archive_channel_id'], null);
		F('~acl_all', null);

		return $result;
	}

	public function delete_channel($archiveChannelId) {
		$result = array('data' => '', 'error' => '');

		$_t_sub = $this->where(array('ac_parent_id' => array('EQ', $archiveChannelId)))->select();
		if(!empty($_t_sub)) {
			$result['error'] = L('SUB_CHANNEL_EXIST');
			return $result;
		}

		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		/* delete archive */
		$_AL = M('Archive')->field('archive_id')->where(array('archive_channel_id' => array('EQ', $archiveChannelId)))->select();
		if(!empty($_AL)) {
			foreach($_AL as $a) {
				M('Archive')->delete_archive($a['archive_id']);
			}
		}
		/* delete html file */
		$_dir = '/' . trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/');
		if(!empty($_dir)) {
			if(false != realpath(APP_PATH . $_dir)) {
				clear_dir(realpath(APP_PATH . $_dir), 1, '', 1);
			}
		}

		if(false === $this->delete($archiveChannelId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		F('~aci/~ac_' . $archiveChannelId, null);
		F('~acl_all', null);

		return $result;
	}

	public function build_url($archiveChannelId) {
		$result = array('data' => '', 'error' => '');

		$_ACI = $this->field('ac_name, ac_is_html, ac_html_dir, ac_html_index, ac_html_naming_list, ac_type')->where(array('archive_channel_id' => array('EQ', $archiveChannelId)))->find();
		if(empty($_ACI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$url_o = Url::U('home@archive/show_channel?archive_channel_id=' . $archiveChannelId);
		$_o = M('Option')->get_option('core');

		if($_o['html_switch'] and 1 == $_ACI['ac_is_html']) {
			$_dir = __APP__ . trim(str_replace('{uwa_path}', '', $_ACI['ac_html_dir']), '/') . '/';

			if(1 == $_ACI['ac_type']) {
				$url = $_dir . trim($_ACI['ac_html_index'], '/') . C('HTML.FILE_SUFFIX');
			}
			elseif(2 == $_ACI['ac_type']) {
				vendor('Pinyin#class');
				$pyc = get_instance('Pinyin');
				$listNaming = str_replace(array(
					'{ac_py}',
					'{page}',
					'{ac_id}'), array(
					$pyc->get_pinyin($_ACI['ac_name'], 'utf-8'),
					1,
					$archiveChannelId), $_ACI['ac_html_naming_list']);
				$url = $_dir . trim($listNaming, '/') . C('HTML.FILE_SUFFIX');
			}
		}
		else {
			$url = $url_o;
		}

		$this->where(array('archive_channel_id' => array('EQ', $archiveChannelId)))->set_field(array('ac_url', 'ac_url_o'), array($url, $url_o));

		$result['ac_url'] = $url;
		$result['ac_url_o'] = $url_o;

		F('~aci/~ac_' . $archiveChannelId, null);
		F('~acl_all', null);

		return $result;
	}

	public function check_permission($archiveChannelId) {
		$archiveChannelId = explode(',', $archiveChannelId);
		foreach($archiveChannelId as $archiveChannelId) {
			$_t_AI = M('Admin')->get_adminInfo(ASession::get('admin_id'));
			$myChannel = $_t_AI['a_ac_id'];
			if(!in_array('_all', $myChannel) && !in_array($archiveChannelId, $myChannel)) {
				return false;
			}
		}
		return true;
	}

	/* get channel select */
	public function get_channelSelect($_ACL, $archiveChannelId = 0, $selectType = 'current') {
		$channelSelect = '';

		$channel = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));

		if('current' == $selectType) {
			/* get sub channel when archive channel id is zero */
			if(0 == $archiveChannelId) {
				$acNav = $channel->get_leaf($archiveChannelId);
					$channelSelect .= ' <select>';
					$channelSelect .= '<option value="">----</option>';
				if(!empty($acNav)) {
					foreach($acNav as $acn) {
						$channelSelect .= '<option value="' . $acn['archive_channel_id'] . '">' . $acn['ac_name'] . '</option>';
					}
				}
					$channelSelect .= '</select>';
			}
			else {
				$acNav = $channel->get_navi($archiveChannelId);
				foreach($acNav as $acn) {
					$channelSelect .= ' <select>';
					$channelSelect .= '<option value="">----</option>';

					/* current archive channel list */
					$_CACL = $channel->get_leaf($acn['ac_parent_id']);
					foreach($_CACL as $k => $ac) {
						if(($archiveChannelId == $ac['archive_channel_id']) 
							or ((0 != $archiveChannelId) and ($acn['archive_channel_id'] == $ac['archive_channel_id']))) {
							$channelSelect .= '<option value="' . $ac['archive_channel_id'] . '" selected="selected">' . $ac['ac_name'] . '</option>';
						}
						else {
							$channelSelect .= '<option value="' . $ac['archive_channel_id'] . '">' . $ac['ac_name'] . '</option>';
						}
					}

					$channelSelect .= '</select>';
				}
			}
		}
		elseif('sub' == $selectType) {
			if(!empty($archiveChannelId)) {
				$acNav = $channel->get_leaf($archiveChannelId);
				if(!empty($acNav)) {
					$channelSelect .= ' <select>';
					$channelSelect .= '<option value="">----</option>';
					foreach($acNav as $acn) {
						$channelSelect .= '<option value="' . $acn['archive_channel_id'] . '">' . $acn['ac_name'] . '</option>';
					}
					$channelSelect .= '</select>';
				}
			}
		}

		return $channelSelect;
	}
}

?>