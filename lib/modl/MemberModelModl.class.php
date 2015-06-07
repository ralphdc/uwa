<?php

/**
 *--------------------------------------
 * member model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-8
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberModelModl extends Modl {
	public function get_modelList($mmStatus = true) {
		$_MML = F('~mml');
		if(empty($_MML)) {
			$_MML = $this->order('`mm_display_order`, `member_model_id` ASC')->select();
			F('~mml', $_MML);
		}
		if(!empty($_MML) and $mmStatus) {
			foreach($_MML as $k => $model) {
				if(1 != $model['mm_status']) {
					unset($_MML[$k]);
				}
			}
		}
		return $_MML;
	}

	public function get_modelInfo($memberModelId) {
		$_MMI = F('~mmi/~mm_' . $memberModelId);
		if(empty($_MMI)) {
			$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
			F('~mmi/~mm_' . $memberModelId, $_MMI);
		}
		if(!empty($_MMI)) {
			$at = get_instance('ATag', 'field');
			$at->tags = array();
			$at->parse_content($_MMI['mm_fieldset']);
			$_MMI['mm_field'] = $at->tags;
			return $_MMI;
		}
		return null;
	}

	public function add_model($data) {
		$result = array('data' => '', 'error' => '');
		$tables = $this->db->get_tables();
		$addonTable = C('DB.PREFIX') . $data['mm_addon_table'] . C('DB.SUFFIX');
		if(in_array($addonTable, $tables)) {
			$result['error'] = L('TABLE_EXIST') . ':' . $addonTable;
			return $result;
		}

		$_t_sql = "CREATE TABLE `{$addonTable}` (`member_id` int UNSIGNED NOT NULL , PRIMARY KEY (`member_id`), KEY `member_id` (`member_id`)) ";
		$_t_sql .= "DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci ";
		$_t_sql .= "COMMENT='{$data['mm_name']}';";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_TABLE_FAILED');
			return $result;
		}

		unset($data['member_model_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~mml', null);

		return $result;
	}

	public function edit_model($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_MODEL_FAILED');
			return $result;
		}

		F('~mmi/~mm_' . $data['member_model_id'], null);
		F('~mml', null);

		return $result;
	}

	public function delete_model($memberModelId) {
		$result = array('data' => '', 'error' => '');

		$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
		if(empty($_MMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if(0 == $_MMI['mm_type']) {
			$result['error'] = L('SYSTEM_MODEL_IS_LOCKED');
			return $result;
		}

		$addonTable = C('DB.PREFIX') . $_MMI['mm_addon_table'] . C('DB.SUFFIX');
		$_t_sql = "DROP TABLE `{$addonTable}`;";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_TABLE_FAILED');
			return $result;
		}

		if(false === $this->delete($memberModelId)) {
			$result['error'] = L('EDIT_MODEL_FAILED');
			return $result;
		}

		F('~mmi/~mm_' . $memberModelId, null);
		F('~mml', null);

		return $result;
	}

	public function get_modelFieldInfo($memberModelId, $fName) {
		$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
		if(!empty($_MMI)) {
			$at = get_instance('ATag', 'field');
			$at->tags = array();
			$at->parse_content($_MMI['mm_fieldset']);
			$_MMFI = $at->get_tag($fName);
			return $_MMFI;
		}
		return null;
	}

	public function add_modelField($memberModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
		if(empty($_MMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$addonTable = C('DB.PREFIX') . $_MMI['mm_addon_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` ADD COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update table structure cache */
		M(parse_name($_MMI['mm_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_MMI['mm_fieldset']);

		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['member_model_id']);
		$at->add_tag($field);
		$data['member_model_id'] = $memberModelId;
		$data['mm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~mmi/~mm_' . $memberModelId, null);
		F('~mml', null);

		return $result;
	}

	public function edit_modelField($memberModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
		if(empty($_MMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$addonTable = C('DB.PREFIX') . $_MMI['mm_addon_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` MODIFY COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('EDIT_FIELD_FAILED');
			return $result;
		}
		/* update table structure cache */
		M(parse_name($_MMI['mm_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_MMI['mm_fieldset']);
		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['member_model_id']);
		$at->add_tag($field);
		$data['member_model_id'] = $memberModelId;
		$data['mm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~mmi/~mm_' . $memberModelId, null);
		F('~mml', null);

		return $result;
	}

	public function delete_modelField($memberModelId, $fName) {
		$result = array('data' => '', 'error' => '');

		$_MMI = $this->where(array('member_model_id' => array('EQ', $memberModelId)))->find();
		if(empty($_MMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		$addonTable = C('DB.PREFIX') . $_MMI['mm_addon_table'] . C('DB.SUFFIX');
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` DROP COLUMN ' . $fName . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_FIELD_FAILED');
			return $result;
		}
		/* update table structure cache */
		M(parse_name($_MMI['mm_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_MMI['mm_fieldset']);
		$at->delete_tag($fName);
		$data['member_model_id'] = $memberModelId;
		$data['mm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~mmi/~mm_' . $memberModelId, null);
		F('~mml', null);

		return $result;
	}

	public function import_model($_MMI) {
		$result = array('data' => '', 'error' => '');
		if(!isset($_MMI['mm_addon_table']) or empty($_MMI['mm_addon_table'])) {
			$result['error'] = L('CONFIG_ERROR');
			return $result;
		}

		$result = $this->add_model($_MMI);
		if(!empty($result['error'])) {
			$result['error'] = $result['error'];
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_MMI['mm_fieldset']);
		$addonTable = C('DB.PREFIX') . $_MMI['mm_addon_table'] . C('DB.SUFFIX');
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` ';
		foreach($at->tags as $tag => $params) {
			$_t_sql .= 'ADD COLUMN ' . get_fieldMakeSQL($params['f_type'], $tag, $params['f_default'], $params['f_length'], $params['f_item_name']) . ',';
		}
		$_t_sql = rtrim($_t_sql, ',') . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update table structure cache */
		M(parse_name($_MMI['mm_addon_table'], 1))->flush();

		/* check language */
		if(!empty($_MMI['up_lang'])) {
			$_t_lang = array();
			$_lang_set = trim_array(explode("\n", $_MMI['up_lang']));
			foreach($_lang_set as $ls) {
				$_t_ls = trim_array(explode("=", $ls));
				if(isset($_t_ls[1]) and !empty($_t_ls[1])) {
					$_t_lang[$_t_ls[0]] = $_t_ls[1];
				}
			}
			if(!empty($_t_lang)) {
				load('encode_file#func');
				$filename = APP_PATH . '/lang/' . C('LANG.NAME') . '/comm.lang.php';
				$content = base64_encode("<?php\r\nreturn " . var_export(array_merge(include ($filename), $_t_lang), true) . ";\r\n?>");
				$_MMI['file_list'][] = array(
					'filename' => str_replace(APP_PATH, '{uwa_path}', $filename),
					'content' => $content,
					'overwrite' => 1,
					);
			}
		}

		/* deal with files */
		$fileList = $_MMI['file_list'];
		if(!empty($fileList)) {
			foreach($fileList as $file) {
				$filename = str_replace('{uwa_path}', APP_PATH, $file['filename']);
				if(!is_file($filename) or (isset($file['overwrite']) and 1 == $file['overwrite'])) {
					if(false == dir_writable(dirname($filename))) {
						$result['error'] .= L('FILE_WRITE_FAILED', null, array('filename' => $file['filename']));
						continue;
					}
					if(0 == file_put_contents($filename, base64_decode($file['content']))) {
						$result['error'] .= L('FILE_WRITE_FAILED', null, array('filename' => $file['filename']));
					}
				}
			}
		}

		F('~mml', null);

		return $result;
	}

}

?>