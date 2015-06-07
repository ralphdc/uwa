<?php

/**
 *--------------------------------------
 * custom model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-2
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomModelModl extends Modl {
	public function get_modelList($cmStatus = true) {
		$_CML = F('~cml');
		if(empty($_CML)) {
			$_CML = $this->order('`cm_display_order` ASC, `custom_model_id` ASC')->select();
			foreach($_CML as $k => $model) {
				$_CML[$k]['cm_view_ml_ids'] = explode(',', $model['cm_view_ml_ids']);
				$_CML[$k]['cm_add_ml_ids'] = explode(',', $model['cm_add_ml_ids']);
			}
			F('~cml', $_CML);
		}
		if(!empty($_CML) and $cmStatus) {
			foreach($_CML as $k => $model) {
				if(1 != $model['cm_status']) {
					unset($_CML[$k]);
				}
			}
		}
		return $_CML;
	}

	public function get_modelInfo($customModelId) {
		$_CMI = F('~cmi/~cm_' . $customModelId);
		if(empty($_CMI)) {
			$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
			if(!empty($_CMI)) {
				$at = get_instance('ATag', 'field');
				$at->tags = array();
				$at->parse_content($_CMI['cm_fieldset']);
				$_CMI['cm_field'] = $at->tags;
				$_CMI['cm_view_ml_ids'] = explode(',', $_CMI['cm_view_ml_ids']);
				$_CMI['cm_add_ml_ids'] = explode(',', $_CMI['cm_add_ml_ids']);
			}
			F('~cmi/~cm_' . $customModelId, $_CMI);
		}
		return $_CMI;
	}

	public function add_model($data) {
		$result = array('data' => '', 'error' => '');

		$tables = $this->db->get_tables();
		$modelTable = C('DB.PREFIX') . $data['cm_table'] . C('DB.SUFFIX');
		if(in_array($modelTable, $tables)) {
			$result['error'] = L('TABLE_EXIST') . ':' . $modelTable;
			return $result;
		}

		$_t_sql = "CREATE TABLE `{$modelTable}` (";
		$_t_sql .= "`id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', ";
		$_t_sql .= "`member_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID', ";
		$_t_sql .= "`status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Content Status(0:not passed; 1:passed; 2:refunded)', ";
		$_t_sql .= "PRIMARY KEY (`id`), ";
		$_t_sql .= "KEY `id` (`id`, `member_id`, `status`) ";
		$_t_sql .= ") ";
		$_t_sql .= "DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci ";
		$_t_sql .= "COMMENT='{$data['cm_name']}';";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_TABLE_FAILED');
			return $result;
		}

		if(in_array(0, $data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = -1;
		}
		elseif(!empty($data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = implode(',', $data['cm_view_ml_ids']);
		}

		if(in_array(0, $data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = -1;
		}
		elseif(!empty($data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = implode(',', $data['cm_add_ml_ids']);
		}

		unset($data['custom_model_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~cml', null);

		return $result;
	}

	public function edit_model($data) {
		$result = array('data' => '', 'error' => '');

		if(in_array(0, $data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = -1;
		}
		elseif(!empty($data['cm_view_ml_ids'])) {
			$data['cm_view_ml_ids'] = implode(',', $data['cm_view_ml_ids']);
		}

		if(in_array(0, $data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = 0;
		}
		elseif(in_array(- 1, $data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = -1;
		}
		elseif(!empty($data['cm_add_ml_ids'])) {
			$data['cm_add_ml_ids'] = implode(',', $data['cm_add_ml_ids']);
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_MODEL_FAILED');
			return $result;
		}

		F('~cmi/~cm_' . $data['custom_model_id'], null);
		F('~cml', null);

		return $result;
	}

	public function delete_model($customModelId) {
		$result = array('data' => '', 'error' => '');

		$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
		if(empty($_CMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$table = C('DB.PREFIX') . $_CMI['cm_table'] . C('DB.SUFFIX');
		$_t_sql = "DROP TABLE `{$table}`;";
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_TABLE_FAILED');
			return $result;
		}

		if(false === $this->delete($customModelId)) {
			$result['error'] = L('DELETE_MODEL_FAILED');
			return $result;
		}

		F('~cmi/~cm_' . $customModelId, null);
		F('~cml', null);

		return $result;
	}

	public function get_formFieldInfo($customModelId, $fName) {
		$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
		if(!empty($_CMI)) {
			$at = get_instance('ATag', 'field');
			$at->tags = array();
			$at->parse_content($_CMI['cm_fieldset']);
			$_CMFI = $at->get_tag($fName);
			return $_CMFI;
		}
		return null;
	}

	public function add_modelField($customModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
		if(empty($_CMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with model table */
		load('field#func');
		$modelTable = C('DB.PREFIX') . $_CMI['cm_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $modelTable . '` ADD COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('ADD_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_CMI['cm_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_CMI['cm_fieldset']);
		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['custom_model_id']);
		$at->add_tag($field);
		$data['custom_model_id'] = $customModelId;
		$data['cm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~cmi/~cm_' . $customModelId, null);
		F('~cml', null);

		return $result;
	}

	public function edit_modelField($customModelId, $field) {
		$result = array('data' => '', 'error' => '');

		$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
		if(empty($_CMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with addon table */
		load('field#func');
		$modelTable = C('DB.PREFIX') . $_CMI['cm_table'] . C('DB.SUFFIX');
		$fieldMakeSQL = get_fieldMakeSQL($field[key($field)]['f_type'], key($field), $field[key($field)]['f_default'], $field[key($field)]['f_length'], $field[key($field)]['f_item_name']);
		$_t_sql = 'ALTER TABLE `' . $modelTable . '` MODIFY COLUMN ' . $fieldMakeSQL . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('EDIT_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_CMI['cm_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_CMI['cm_fieldset']);
		unset($field[key($field)]['f_name']);
		unset($field[key($field)]['custom_model_id']);
		$at->add_tag($field);
		$data['custom_model_id'] = $customModelId;
		$data['cm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~cmi/~cm_' . $customModelId, null);
		F('~cml', null);

		return $result;
	}

	public function delete_modelField($customModelId, $fName) {
		$result = array('data' => '', 'error' => '');

		$_CMI = $this->where(array('custom_model_id' => array('EQ', $customModelId)))->find();
		if(empty($_CMI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		/* deal with model table */
		$modelTable = C('DB.PREFIX') . $_CMI['cm_table'] . C('DB.SUFFIX');
		$_t_sql = 'ALTER TABLE `' . $modelTable . '` DROP COLUMN ' . $fName . ';';
		if(false === $this->execute($_t_sql)) {
			$result['error'] = L('DROP_FIELD_FAILED');
			return $result;
		}
		/* update structure cache */
		M(parse_name($_CMI['cm_table'], 1))->flush();

		$at = get_instance('ATag', 'field');
		$at->tags = array();
		$at->parse_content($_CMI['cm_fieldset']);
		$at->delete_tag($fName);
		$data['custom_model_id'] = $customModelId;
		$data['cm_fieldset'] = $at->deparse_tag($at->tags);
		if(false === $this->update($data)) {
			$result['error'] = L('UPDATE_MODEL_FIELDSET_FAILED');
			return $result;
		}

		F('~cmi/~cm_' . $customModelId, null);
		F('~cml', null);

		return $result;
	}

	public function get_contentInfo($customModelId, $id, $output = false) {
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);

		$_CMCI = M(parse_name($_CMI['cm_table'], 1))->where(array('id' => array('EQ', $id)))->find();
		if(!empty($_CMCI)) {
			load('field#func');
			foreach($_CMI['cm_field'] as $field => $params) {
				if(isset($_CMCI[$field])) {
					$_CMCI[$field] = deal_fieldValue($_CMCI[$field], $params, $output);
				}
			}

			/* get previous and next content */
			$_t_where = array();
			$_t_where['status'] = array('EQ', 1);
			$_t_where['id'] = array('LT', $_CMCI['id']);
			/* prev */
			$_CMCI['prev'] = M(parse_name($_CMI['cm_table'], 1))->field('`id`')->order('`id` DESC')->where($_t_where)->find();
			if(!empty($_CMCI['prev'])) {
				$_CMCI['prev']['url'] = Url::U('custom_model/show_content?custom_model_id=' . $customModelId . '&id=' . $_CMCI['prev']['id']);
			}
			$_t_where['id'] = array('GT', $_CMCI['id']);
			/* next */
			$_CMCI['next'] = M(parse_name($_CMI['cm_table'], 1))->field('`id`')->order('`id` ASC')->where($_t_where)->find();
			if(!empty($_CMCI['next'])) {
				$_CMCI['next']['url'] = Url::U('custom_model/show_content?custom_model_id=' . $customModelId . '&id=' . $_CMCI['next']['id']);
			}
		}

		return $_CMCI;
	}

	public function list_content($_CMI, $where, $order = '`id` DESC', $limit = 50, $output = false) {
		/* custom model content list */
		$listFields = '';
		foreach($_CMI['cm_field'] as $field => $params) {
			if(1 == $params['f_is_list']) {
				$listFields .= ',`' . $field . '`';
			}
		}
		$_CMCL = M(parse_name($_CMI['cm_table'], 1))->field('`id`,`member_id`,`status`' . $listFields)->where($where)->order($order)->limit($limit)->select();
		if(!empty($_CMCL)) {
			load('field#func');
			foreach($_CMCL as $k => $cmc) {
				foreach($_CMI['cm_field'] as $field => $params) {
					if(isset($cmc[$field])) {
						$_CMCL[$k][$field] = deal_fieldValue($cmc[$field], $params, $output);
					}
				}
			}
		}

		return $_CMCL;
	}

	public function add_content($data) {
		$result = array('data' => '', 'error' => '');

		$customModelId = $data['custom_model_id'];
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		/* deal with data field */
		if(!empty($_CMI['cm_field'])) {
			load('field#func');
			foreach($_CMI['cm_field'] as $tag => $params) {
				if(isset($data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $data);
				}
			}
		}

		unset($data['id']);
		$result['data'] = M(parse_name($_CMI['cm_table'], 1))->insert($data);
		if(false === $result['data']) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}

		return $result;
	}

	public function edit_content($data) {
		$result = array('data' => '', 'error' => '');

		$customModelId = $data['custom_model_id'];
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		/* deal with data field */
		if(!empty($_CMI['cm_field'])) {
			load('field#func');
			foreach($_CMI['cm_field'] as $tag => $params) {
				if(isset($data[$tag])) {
					$data[$tag] = get_fieldValue($tag, $params, $data);
				}
			}
		}
		if(false === M(parse_name($_CMI['cm_table'], 1))->update($data)) {
			$result['error'] = L('UPDATE_DATA_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_content($customModelId, $id) {
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(false === M(parse_name($_CMI['cm_table'], 1))->delete($id)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', $_CMI['cm_alias']), 'u_item_id' => array('EQ', $id)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', $_CMI['cm_alias']), 'u_item_id' => array('EQ', $id)))->delete();

		return $result;
	}

}

?>