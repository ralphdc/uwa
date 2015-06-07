<?php

/**
 *--------------------------------------
 * archive
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-6
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveModl extends Modl {
	public function get_archiveCount($where = '', $archiveModelId = 0) {
		if(0 < $archiveModelId) {
			$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
			if(empty($_AMI)) {
				return null;
			}
			$_count = M('Archive')->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')
				->join('__' . strtoupper($_AMI['am_addon_table']) . '__ AS addon ON addon.archive_id = __ARCHIVE__.archive_id')->where($where)->count();
		}
		else {
			$_count = M('Archive')->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')->where($where)->count();
		}
		return $_count;
	}

	public function get_archiveList($where = '', $order = '`a_rank` DESC, `a_edit_time` DESC', $limit = 10, $archiveModelId = 0, $output = false) {
		if('`random`' == substr($order, 0, 8)) {
			$where['__ARCHIVE__.archive_id'] = array('EXP', ' >= ((SELECT MAX(archive_id) FROM __ARCHIVE__) - (SELECT MIN(archive_id) FROM __ARCHIVE__)) * RAND() + (SELECT MIN(archive_id) FROM __ARCHIVE__) ');
			$order = '`a_rank` DESC, `a_edit_time` DESC';
		}

		/* get field for list in addon table */
		if(0 < $archiveModelId) {
			$addonFields = '';
			$_AMI = M('ArchiveModel')->get_modelInfo($archiveModelId);
			if(empty($_AMI)) {
				return null;
			}
			foreach($_AMI['am_field'] as $field => $params) {
				if(1 == $params['f_is_list']) {
					$addonFields .= ',`' . $field . '`';
				}
			}
			$_AL = M('Archive')->field('__ARCHIVE__.`archive_id`,`member_id`,`m_username`,`a_title`,`a_short_title`,`a_thumb`,`a_keywords`,`a_description`,`a_add_time`,`a_edit_time`,`a_add_ip`,`a_edit_ip`,`a_cost_points`,`a_view_count`,`a_review_count`,`a_support_count`,`a_oppose_count`,`a_rank`,`a_status`,`a_review_switch`,`a_is_html`,`af_alias`,__ARCHIVE__.`archive_channel_id`,`a_url`,`a_url_o`,`ac_name`,`ac_keywords`,`ac_description`,`ac_url`,`ac_url_o`' . $addonFields)
				->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')
				->join('__' . strtoupper($_AMI['am_addon_table']) . '__ AS addon ON addon.archive_id = __ARCHIVE__.archive_id')
				->where($where)->order($order)->limit($limit)->select();

			/* deal with addon field */
			if(!empty($_AL)) {
				load('field#func');
				foreach($_AL as $k => $a) {
					foreach($_AMI['am_field'] as $field => $params) {
						if(isset($a[$field])) {
							$_AL[$k][$field] = deal_fieldValue($a[$field], $params, $output);
						}
					}
				}
			}
		}
		else {
			$_AL = M('Archive')->field('__ARCHIVE__.`archive_id`,`member_id`,`m_username`,`a_title`,`a_short_title`,`a_thumb`,`a_keywords`,`a_description`,`a_add_time`,`a_edit_time`,`a_add_ip`,`a_edit_ip`,`a_cost_points`,`a_view_count`,`a_review_count`,`a_support_count`,`a_oppose_count`,`a_rank`,`a_status`,`a_review_switch`,`a_is_html`,`af_alias`,__ARCHIVE__.`archive_channel_id`,`a_url`,`a_url_o`,`ac_name`,`ac_keywords`,`ac_description`,`ac_url`,`ac_url_o`')
				->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')
				->where($where)->order($order)->limit($limit)->select();
		}

		if(!empty($_AL)) {
			foreach($_AL as $k => $v) {
				/* update url */
				if(empty($v['a_url']) or empty($v['a_url_o'])) {
					$_r = $this->build_url($v['archive_id']);
					$_AL[$k]['a_url'] = $_r['a_url'];
					$_AL[$k]['a_url_o'] = $_r['a_url_o'];
				}

				/* default thumb */
				if(empty($v['a_thumb'])) {
					$_AL[$k]['a_thumb'] = __APP__ . 'u/site/no_thumb.png';
				}
			}
		}
		return $_AL;
	}

	public function get_archiveInfo($archiveId, $output = false) {
		$_AI = $this->where(array('__ARCHIVE__.archive_id' => array('EQ', $archiveId)))->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')->join('__ARCHIVE_MODEL__ AS am ON am.archive_model_id = ac.archive_model_id')->find();
		if(empty($_AI)) {
			return null;
		}

		/* member level ids */
		$_AI['ac_view_ml_ids'] = explode(',', $_AI['ac_view_ml_ids']);
		$_AI['ac_add_ml_ids'] = explode(',', $_AI['ac_add_ml_ids']);

		/* update url */
		if(empty($_AI['a_url']) or empty($_AI['a_url_o'])) {
			$_r = $this->build_url($_AI['archive_id']);
			$_AI['a_url'] = $_r['a_url'];
			$_AI['a_url_o'] = $_r['a_url_o'];
		}

		/* default thumb */
		if(empty($_AI['a_thumb'])) {
			$_AI['a_thumb'] = __APP__ . 'u/site/no_thumb.png';
		}

		/* archive flag */
		$_AI['af_alias'] = explode(',', $_AI['af_alias']);

		/* get addon field */
		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_AI['am_fieldset']);
		$_AI['am_field'] = $at->tags;

		/* get addon table information */
		$addon = M(parse_name($_AI['am_addon_table'], 1))->where(array('archive_id' => array('EQ', $_AI['archive_id'])))->find();
		if(!empty($addon)) {
			load('field#func');
			foreach($_AI['am_field'] as $field => $params) {
				if(isset($addon[$field])) {
					$addon[$field] = deal_fieldValue($addon[$field], $params, $output);
				}
			}
			$_AI = array_merge($_AI, $addon);
		}

		/* get previous and next archive */
		$_t_where = array();
		$_t_where['a_status'] = array('EQ', 1);
		$_t_where['archive_channel_id'] = array('EQ', $_AI['archive_channel_id']);
		$_t_where['archive_id'] = array('LT', $_AI['archive_id']);
 		/* prev */
		$_AI['a_prev'] = $this->field('`a_title`,`a_thumb`,`a_url`,`a_url_o`')->order('`archive_id` DESC')->where($_t_where)->find();
		$_t_where['archive_id'] = array('GT', $_AI['archive_id']);
 		/* next */
		$_AI['a_next'] = $this->field('`a_title`,`a_thumb`,`a_url`,`a_url_o`')->order('`archive_id` ASC')->where($_t_where)->find();

		return $_AI;
	}

	public function add_archive($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['archive_id']);
		$result['data'] = $this->insert($data);
		if(false === $result['data']) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function add_archive_addon($data) {
		$result = array('data' => '', 'error' => '');

		$archiveChannelId = $data['archive_channel_id'];
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		/* deal addon field */
		if(!empty($_ACI['am_field'])) {
			load('field#func');
			foreach($_ACI['am_field'] as $tag => $params) {
				if(isset($data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $data);
				}
			}
		}

		if(false === M(parse_name($_ACI['am_addon_table'], 1))->insert($data)) {
			$result['error'] = L('ADD_ADDON_DATA_FAILED');
			return $result;
		}

		return $result;
	}

	public function edit_archive($data) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($data['archive_id']);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_FAILED');
			return $result;
		}

		return $result;
	}

	public function edit_archive_addon($data) {
		$result = array('data' => '', 'error' => '');

		/* edit addon table data */
		$archiveChannelId = $data['archive_channel_id'];
		$_ACI = M('ArchiveChannel')->get_channelInfo($archiveChannelId);
		/* deal with addon field */
		if(!empty($_ACI['am_field'])) {
			load('field#func');
			foreach($_ACI['am_field'] as $tag => $params) {
				if(isset($data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $data);
				}
			}
		}

		if(false === M(parse_name($_ACI['am_addon_table'], 1))->update($data)) {
			$result['error'] = L('UPDATE_ADDON_DATA_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_archive($archiveId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->delete($archiveId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete addon table data */
		if(false === M(parse_name($_AI['am_addon_table'], 1))->delete($archiveId)) {
			$result['error'] = L('DELETE_ADDON_DATA_FAILED');
			return $result;
		}

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', $_AI['am_alias']), 'u_item_id' => array('EQ', $archiveId)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', $_AI['am_alias']), 'u_item_id' => array('EQ', $archiveId)))->delete();

		/* delete html file */
		$_dir = '';
		if(0 == $_AI['a_html_path']) {
			$_dir = '/' . trim(str_replace('{uwa_path}', '', $_AI['ac_html_dir']), '/');
		}

		vendor('Pinyin#class');
		$pyc = get_instance('Pinyin');

		/* get html filename */
		if(!empty($_AI['a_html_naming'])) {
			$naming = $_AI['a_html_naming'];
		}
		else {
			$naming = $_AI['ac_html_naming_archive'];
		}
		$naming = str_replace(array(
			'{ac_py}',
			'{ac_id}',
			'{Y}',
			'{M}',
			'{D}',
			'{a_py}',
			'{a_id}'), array(
			$pyc->get_pinyin($_AI['ac_name'], 'utf-8'),
			$_AI['archive_channel_id'],
			date('Y', $_AI['a_add_time']),
			date('m', $_AI['a_add_time']),
			date('d', $_AI['a_add_time']),
			$pyc->get_pinyin($_AI['a_title'], 'utf-8'),
			$_AI['archive_id']), $naming);
		@unlink(realpath(APP_PATH . $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX')));
		/* delete paging file */
		foreach($_AI['am_field'] as $field => $params) {
			if(isset($params['f_is_paging']) and (1 == $params['f_is_paging'])) {
				$pagingField = $field;
				break;
			}
		}
		if(isset($pagingField) and false !== strpos($_AI[$pagingField], '<p>#uwa_paging#</p>')) {
			$rowsNum = count(explode('<p>#uwa_paging#</p>', $_AI[$pagingField]));
			for($_i = 1; $_i < $rowsNum + 1; $_i++) {
				@unlink(realpath(APP_PATH . $_dir . '/' . trim($naming, '/') . '-' . $_i . C('HTML.FILE_SUFFIX')));
			}
		}
		return $result;
	}

	public function pass_archive($archiveId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('archive_id' => array('EQ', $archiveId)))->set_field('a_status', 1)) {
			$result['error'] = L('PASS_FAILED');
			return $result;
		}

		return $result;
	}

	public function refund_archive($archiveId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->where(array('archive_id' => array('EQ', $archiveId)))->set_field('a_status', 2)) {
			$result['error'] = L('REFUND_FAILED');
			return $result;
		}

		return $result;
	}

	public function add_flag($archiveId, $afALias) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* get flag */
		$afAliasValue = M('ArchiveFlag')->get_flag_value($afALias);

		if(!$afAliasValue) {
			$result['error'] = L('PARAMS_ERROR');
			return $result;
		}

		/* add flag */
		$_t_sql = "UPDATE `" . C('DB.PREFIX') . 'archive' . C('DB.SUFFIX') . "` SET `af_alias` = `af_alias` | {$afAliasValue} WHERE `archive_id` = '{$archiveId}';";
		if(!$this->execute($_t_sql)) {
			$result['error'] = L('ADD_FLAG_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_flag($archiveId, $afALias) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->get_archiveInfo($archiveId);
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* get flag */
		$afAliasValue = M('ArchiveFlag')->get_flag_value($afALias);

		if(!$afAliasValue) {
			$result['error'] = L('PARAMS_ERROR');
			return $result;
		}

		/* delete flag */
		$_t_sql = "UPDATE `" . C('DB.PREFIX') . 'archive' . C('DB.SUFFIX') . "` SET `af_alias` = `af_alias` &~ {$afAliasValue} WHERE `archive_id` = '{$archiveId}';";
		if(!$this->execute($_t_sql)) {
			$result['error'] = L('DELETE_FLAG_FAILED');
			return $result;
		}

		return $result;
	}

	public function build_url($archiveId) {
		$result = array('data' => '', 'error' => '');

		$_AI = $this->join('__ARCHIVE_CHANNEL__ AS ac ON ac.archive_channel_id = __ARCHIVE__.archive_channel_id')->where(array('__ARCHIVE__.archive_id' => array('EQ', $archiveId)))->find();
		if(empty($_AI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$url_o = Url::U('home@archive/show_archive?archive_id=' . $archiveId);

		$_o = M('Option')->get_option('core');

		if($_o['html_switch'] and 0 != $_AI['ac_is_html'] and 0 == $_AI['ac_view_ml_ids'] and 1 == $_AI['a_status'] and $_AI['a_is_html'] and 0 == $_AI['a_cost_points']) {
			$_dir = __APP__;
			if(0 == $_AI['a_html_path']) {
				$_dir .= trim(str_replace('{uwa_path}', '', $_AI['ac_html_dir']), '/') . '/';
			}

			vendor('Pinyin#class');
			$pyc = get_instance('Pinyin');

			/* get html filename */
			if(!empty($_AI['a_html_naming'])) {
				$naming = $_AI['a_html_naming'];
			}
			else {
				$naming = $_AI['ac_html_naming_archive'];
			}
			$naming = str_replace(array(
				'{ac_py}',
				'{ac_id}',
				'{Y}',
				'{M}',
				'{D}',
				'{a_py}',
				'{a_id}'), array(
				$pyc->get_pinyin($_AI['ac_name'], 'utf-8'),
				$_AI['archive_channel_id'],
				date('Y', $_AI['a_add_time']),
				date('m', $_AI['a_add_time']),
				date('d', $_AI['a_add_time']),
				$pyc->get_pinyin($_AI['a_title'], 'utf-8'),
				$_AI['archive_id']), $naming);
			$url = $_dir . trim($naming, '/') . C('HTML.FILE_SUFFIX');
		}
		else {
			$url = $url_o;
		}
		$this->where(array('archive_id' => array('EQ', $archiveId)))->set_field(array('a_url', 'a_url_o'), array($url, $url_o));

		$result['a_url'] = $url;
		$result['a_url_o'] = $url_o;
		return $result;
	}

}

?>