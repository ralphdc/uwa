<?php

/**
 *--------------------------------------
 * linkage item
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-07
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class LinkageItemModl extends Modl {
	public function get_itemList($where = '', $order = '', $limit = '') {
		$_LIL = $this->where($where)->join('__LINKAGE__ AS l ON l.l_alias = __LINKAGE_ITEM__.l_alias')->order($order)->limit($limit)->select();
		return $_LIL;
	}

	public function get_position($lAlias, $liParentId) {
		$postion = '';
		 while(0 < $liParentId) {
			$_lii = $this->where(array('l_alias' => array('EQ', $lAlias), 'linkage_item_id' => array('EQ', $liParentId)))->find();
			$postion = '<a href="' . Url::U('linkage_item/list_item?l_alias=' . $lAlias . '&li_parent_id=' . $_lii['li_parent_id']) . '">' . $_lii['li_name'] . '</a> / ' . $postion;
			$liParentId = $_lii['li_parent_id'];
		}
		return $postion;
	}

	public function get_itemInfo($linkageItemId) {
		$_LII = $this->where(array('linkage_item_id' => array('EQ', $linkageItemId)))->join('__LINKAGE__ AS l ON l.l_alias = __LINKAGE_ITEM__.l_alias')->find();
		return $_LII;
	}

	/* ouput item */
	public function output_item($linkageItemId, $outputType = 1, $pathSeparator = '/') {
		if(1 == $outputType) {
			return $linkageItemId;
		}

		$_t_lii = $this->where(array('linkage_item_id' => array('EQ', $linkageItemId)))->find();
		if(2 == $outputType) {
			return $_t_lii['li_name'];
		}

		$linkage = M('Linkage')->get_linkage($_t_lii['l_alias']);
		$item = '';
		if(3 == $outputType) {
			$liNav = $linkage->get_navi($linkageItemId);
			foreach($liNav as $lin) {
				$item .= $lin['li_name'] . $pathSeparator;
			}
			$item = trim($item, $pathSeparator);
		}
		return $item;
	}


	public function add_item($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['linkage_item_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_item($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_item($linkageItemId) {
		$result = array('data' => '', 'error' => '');

		$_t_lil = $this->where(array('li_parent_id' => array('EQ', $linkageItemId)))->select();

		if(!empty($_t_lil)) {
			$result['error'] = L('SUB_ITEM_EXIST');
			return $result;
		}

		if(false === $this->delete($linkageItemId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>