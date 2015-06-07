<?php

/**
 *--------------------------------------
 * custom model
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-10-10
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomModelCtrlr extends IndexCtrlr {
	public function list_content() {
		$customModelId = intval(ARequest::get('custom_model_id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			halt('', true, true);
		}

		$_CMI['msg_err'] = '';
		if(in_array(- 1, $_CMI['cm_view_ml_ids']) or (!in_array(0, $_CMI['cm_view_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMI['cm_view_ml_ids']))) {
			$_CMI['msg_err'] = L('PERMISSION_LIMIT');
		}

		$this->assign('_GCAP', 'home@custom_model/list_content?custom_model_id=' . $customModelId);

		$this->assign('_V', $_CMI);

		if(empty($_CMI['msg_err'])) {
			$where = array();

			/* get page filter field */
			$_page_ff = array();
			foreach($_CMI['cm_field'] as $field => $params) {
				if(1 == $params['f_is_list'] and ('select' == $params['f_type'] or 'radio' == $params['f_type'] or 'checkbox' == $params['f_type'])) {
					$valueSet = array();
					$_t = explode(',', $params['f_default']);
					foreach($_t as $v) {
						$_t1 = explode('|', $v);
						$valueSet[$_t1[0]] = $_t1[1];
					}

					$fieldValue = ARequest::get($field);

					if(!empty($fieldValue) and array_key_exists($fieldValue, $valueSet)) {
						$where[$field] = array('INSET', $fieldValue);
						$_page_ff[$field] = $fieldValue;
					}
				}
			}

			/* filter field for show */
			$_FF = array();
			foreach($_CMI['cm_field'] as $field => $params) {
				if(1 == $params['f_is_list'] and ('select' == $params['f_type'] or 'radio' == $params['f_type'] or 'checkbox' == $params['f_type'])) {
					$_FF[$field]['name'] = $params['f_item_name'];

					/* get ff params */
					$_t_page_ff = $_page_ff;
					unset($_t_page_ff[$field]);
					$_FF[$field]['params'][] = array(
						'name' => L('NOT_LIMIT'),
						'url' => Url::U('custom_model/list_content?custom_model_id=' . $customModelId . '&' . http_build_query($_t_page_ff)),
						'field' => $field,
						'value' => '',
					);
					$_t = explode(',', $params['f_default']);
					foreach($_t as $k => $v) {
						$_t1 = explode('|', $v);
						$_t_page_ff = $_page_ff;
						$_t_page_ff[$field] = $_t1[0];

						$_FF[$field]['params'][] = array(
							'name' => $_t1[1],
							'url' => Url::U('custom_model/list_content?custom_model_id=' . $customModelId . '&' . http_build_query($_t_page_ff)),
							'field' => $field,
							'value' => $_t1[0],
						);
					}
				}
			}
			$this->assign('_FF', $_FF);

			$where['status'] = array('EQ', 1);
			$order = '`id` DESC';

			/* get paging */
			$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
			$rowsNum = M(parse_name($_CMI['cm_table'], 1))->where($where)->count();
			$p = new APage($rowsNum, $_CMI['cm_page_size'], Url::U('custom_model/list_content?custom_model_id=' . $customModelId . '&' . C('VAR.PAGE') . '=_page_' . '&' . http_build_query($_page_ff)));
			$this->assign('PAGING', $p->get_paging());
			$limit = $p->get_limit();

			$_CMCL = M('CustomModel')->list_content($_CMI, $where, $order, $limit, true);
			$this->assign('_L', $_CMCL);
		}

		/* current position */
		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => $_CMI['cm_name'], 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/' . $_CMI['cm_tpl_list_home']);
		}
		else {
			$this->display('home/' . $_CMI['cm_tpl_list_home']);
		}
	}

	public function show_content() {
		$customModelId = intval(ARequest::get('custom_model_id'));
		$id = intval(ARequest::get('id'));
		$_CMI = M('CustomModel')->get_modelInfo($customModelId);
		if(empty($_CMI) or !$_CMI['cm_status']) {
			halt('', true, true);
		}

		$_CMCI = M('CustomModel')->get_contentInfo($customModelId, $id, true);
		if(empty($_CMCI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('custom_model/list_content?custom_model_id=' . $customModelId));
		}

		$_CMCI = array_merge($_CMI, $_CMCI);

		$_CMCI['msg_err'] = '';
		if(ASession::get('member_id') != $_CMCI['member_id']
			and (1 != $_CMCI['status']
				or in_array(- 1, $_CMCI['cm_view_ml_ids'])
				or (!in_array(0, $_CMCI['cm_view_ml_ids']) and !in_array(ASession::get('member_level_id'), $_CMCI['cm_view_ml_ids'])))) {
					$_CMCI['msg_err'] = L('PERMISSION_LIMIT');
		}

		$this->assign('_GCAP', 'home@custom_model/list_content?custom_model_id=' . $customModelId);

		if(empty($_CMCI['msg_err'])) {
			/* deal with paging field */
			foreach($_CMCI['cm_field'] as $field => $params) {
				if(isset($params['f_is_paging']) and (1 == $params['f_is_paging'])) {
					$pagingField = $field;
					break;
				}
			}
			if(isset($pagingField) and false !== strpos($_CMCI[$pagingField], '<p>#uwa_paging#</p>')) {
				$_content = explode('<p>#uwa_paging#</p>', $_CMCI[$pagingField]);

				$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
				$rowsNum = count($_content);
				$p = new APage($rowsNum, 1, Url::U('custom_model/show_content?custom_model_id=' . $customModelId . '&id=' . $id . '&' . C('VAR.PAGE') . '=_page_'));
				$this->assign('PAGING', $p->get_paging());
				$_CMCI[$pagingField] = $_content[ARequest::get(C('VAR.PAGE')) - 1];
			}
			else {
				$this->assign('PAGING', '');
			}
		}

		$this->assign('_V', $_CMCI);

		/* current position */
		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => $_CMCI['cm_name'], 'url' => Url::U('custom_model/list_content?custom_model_id=' . $customModelId)),
			array('name' => 'ID ' . $id, 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/' . $_CMI['cm_tpl_show_home']);
		}
		else {
			$this->display('home/' . $_CMI['cm_tpl_show_home']);
		}
	}

}

?>