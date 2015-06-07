<?php

/**
 *--------------------------------------
 * archive model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-1
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ArchiveModelModl extends Modl {
	/* get archive model list. $amStatus: status, $used: is have channel */
	public function get_modelList($amStatus = true, $used = false) {
		$_AML = F('~aml');
		if(empty($_AML)) {
			$_AML = $this->order('`am_display_order` ASC, `archive_model_id` ASC')->select();
			F('~aml', $_AML);
		}
		if(!empty($_AML) and $amStatus) {
			foreach($_AML as $k => $model) {
				if(1 != $model['am_status']) {
					unset($_AML[$k]);
				}
			}
		}
		if(!empty($_AML) and $used) {
			foreach($_AML as $k => $model) {
				$_c = M('ArchiveChannel')->where(array('archive_model_id' => array('EQ', $model['archive_model_id'])))->select();
				if(empty($_c)) {
					unset($_AML[$k]);
				}
			}
		}
		return $_AML;
	}

	public function get_modelInfo($archiveModelId) {
		$_AMI = F('~ami/~am_' . $archiveModelId);
		if(empty($_AMI)) {
			$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
			if(!empty($_AMI)) {
				$at = get_instance('ATag', 'field');
				$at->tags = array();
				$at->parse_content($_AMI['am_fieldset']);
				$_AMI['am_field'] = $at->tags;
			}
			F('~ami/~am_' . $archiveModelId, $_AMI);
		}
		return $_AMI;
	}

	public function add_model($data) {
		$result = array('data' => '', 'error' => '');
		$tables = $this->db->get_tables();
		$addonTable = C('DB.PREFIX') . $data['am_addon_table'] . C('DB.SUFFIX');
		if(in_array($addonTable, $tables)) {
			$result['error'] = L('TABLE_EXIST') . ':' . $addonTable;
			return $result;
		}

		$_t_sql = "CREATE TABLE `{$addonTable}` (`archive_id` int UNSIGNED NOT NULL , PRIMARY KEY (`archive_id`), KEY `archive_id` (`archive_id`)) ";
		$_t_sql .= "DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci ";
		$_t_sql .= "COMMENT='{$data['am_name']}';";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_TABLE_FAILED');
			return $result;
		}

		unset($data['archive_model_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~aml', null);

		return $result;
	}

	public function edit_model($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_MODEL_FAILED');
			return $result;
		}

		F('~ami/~am_' . $data['archive_model_id'], null);
		F('~aml', null);

		/* delete channel cache */
		$_t_acl = M('ArchiveChannel')->field('archive_channel_id')->where(array('archive_model_id' => array('EQ', $data['archive_model_id'])))->select();
		if(!empty($_t_acl)) {
			foreach($_t_acl as $ac) {
				F('~aci/~ac_' . $ac['archive_channel_id'], null);
			}
			F('~acl', null);
		}

		return $result;
	}

	public function delete_model($archiveModelId) {
		$result = array('data' => '', 'error' => '');

		$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
		if(empty($_AMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}
		if(0 == $_AMI['am_type']) {
			$result['error'] = L('SYSTEM_MODEL_IS_LOCKED');
			return $result;
		}

		$addonTable = C('DB.PREFIX') . $_AMI['am_addon_table'] . C('DB.SUFFIX');
		$_t_sql = "DROP TABLE `{$addonTable}`;";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_TABLE_FAILED');
			return $result;
		}

		if(false === $this->delete($archiveModelId)) {
			$result['error'] = L('DELETE_MODEL_FAILED');
			return $result;
		}

		F('~ami/~am_' . $archiveModelId, null);
		F('~aml', null);

		return $result;
	}

	public function get_modelFieldInfo($archiveModelId, $fName) {
		$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
		if(!empty($_AMI)) {
			$at = get_instance('ATag', 'field');
			$at->tags = array();
			$at->parse_content($_AMI['am_fieldset']);
			$_AMFI = $at->get_tag($fName);
			return $_AMFI;
		}
		return null;
	}

	public function add_modelField($archiveModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
		if(empty($_AMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$addonTable = C('DB.PREFIX') . $_AMI['am_addon_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` ADD COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_AMI['am_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_AMI['am_fieldset']);
		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['archive_model_id']);
		$at->add_tag($field);
		$data['archive_model_id'] = $archiveModelId;
		$data['am_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~ami/~am_' . $archiveModelId, null);
		F('~aml', null);

		/* delete channel cache */
		$_t_acl = M('ArchiveChannel')->field('archive_channel_id')->where(array('archive_model_id' => array('EQ', $archiveModelId)))->select();
		if(!empty($_t_acl)) {
			foreach($_t_acl as $ac) {
				F('~aci/~ac_' . $ac['archive_channel_id'], null);
			}
			F('~acl', null);
		}

		return $result;
	}

	public function edit_modelField($archiveModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
		if(empty($_AMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$addonTable = C('DB.PREFIX') . $_AMI['am_addon_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` MODIFY COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('EDIT_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_AMI['am_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_AMI['am_fieldset']);
		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['archive_model_id']);
		$at->add_tag($field);
		$data['archive_model_id'] = $archiveModelId;
		$data['am_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~ami/~am_' . $archiveModelId, null);
		F('~aml', null);

		/* delete channel cache */
		$_t_acl = M('ArchiveChannel')->field('archive_channel_id')->where(array('archive_model_id' => array('EQ', $archiveModelId)))->select();
		if(!empty($_t_acl)) {
			foreach($_t_acl as $ac) {
				F('~aci/~ac_' . $ac['archive_channel_id'], null);
			}
			F('~acl', null);
		}

		return $result;
	}

	public function delete_modelField($archiveModelId, $fName) {
		$result = array('data' => '', 'error' => '');

		$_AMI = $this->where(array('archive_model_id' => array('EQ', $archiveModelId)))->find();
		if(empty($_AMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		$addonTable = C('DB.PREFIX') . $_AMI['am_addon_table'] . C('DB.SUFFIX');
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` DROP COLUMN ' . $fName . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_AMI['am_addon_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_AMI['am_fieldset']);
		$at->delete_tag($fName);
		$data['archive_model_id'] = $archiveModelId;
		$data['am_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~ami/~am_' . $archiveModelId, null);
		F('~aml', null);

		/* delete channel cache */
		$_t_acl = M('ArchiveChannel')->field('archive_channel_id')->where(array('archive_model_id' => array('EQ', $archiveModelId)))->select();
		if(!empty($_t_acl)) {
			foreach($_t_acl as $ac) {
				F('~aci/~ac_' . $ac['archive_channel_id'], null);
			}
			F('~acl', null);
		}

		return $result;
	}

	public function import_model($_AMI) {
		$result = array('data' => '', 'error' => '');
		if(!isset($_AMI['am_addon_table']) or empty($_AMI['am_addon_table'])) {
			$result['error'] = L('CONFIG_ERROR');
			return $result;
		}

		$result = $this->add_model($_AMI);
		if(!empty($result['error'])) {
			$result['error'] = $result['error'];
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_AMI['am_fieldset']);
		$addonTable = C('DB.PREFIX') . $_AMI['am_addon_table'] . C('DB.SUFFIX');
		$_t_sql = 'ALTER TABLE `' . $addonTable . '` ';
		foreach($at->tags as $tag => $params) {
			$_t_sql .= 'ADD COLUMN ' . get_fieldMakeSQL($params['f_type'], $tag, $params['f_default'], $params['f_length'], $params['f_item_name']) . ',';
		}
		$_t_sql = rtrim($_t_sql, ',') . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_AMI['am_addon_table'], 1))->flush();

		/* check language */
		if(!empty($_AMI['up_lang'])) {
			$_t_lang = array();
			$_lang_set = trim_array(explode("\n", $_AMI['up_lang']));
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
				$_AMI['file_list'][] = array(
					'filename' => str_replace(APP_PATH, '{uwa_path}', $filename),
					'content' => $content,
					'overwrite' => 1,
					);
			}
		}

		/* deal with file */
		$fileList = $_AMI['file_list'];
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
						continue;
					}
				}
			}
		}

		F('~aml', null);

		return $result;
	}

}

?>