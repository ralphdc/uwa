<?php

/**
 *--------------------------------------
 * linkage
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-07
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class LinkageModl extends Modl {
	public function get_linkageList($where = '', $order = '', $limit = 50) {
		$_LL = $this->where($where)->order($order)->limit($limit)->select();
		return $_LL;
	}

	public function get_linkageInfo($linkageId) {
		$_LI = $this->where(array('linkage_id' => array('EQ', $linkageId)))->find();
		return $_LI;
	}

	public function add_linkage($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['linkage_id']);
		if(false === $this->insert($data)) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_linkage($data) {
		$result = array('data' => '', 'error' => '');

		$_t_li = $this->get_linkageInfo($data['linkage_id']);

		/* update linkage items */
		if($data['l_alias'] != $_t_li['l_alias']) {
			if(false === M('LinkageItem')->where(array('l_alias' => array('EQ', $_t_li['l_alias'])))->set_field('l_alias', $data['l_alias'])) {
				$result['error'] = L('EDIT_LINKAGE_ITEM_FAILED');
				return $result;
			}
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_linkage($linkageId) {
		$result = array('data' => '', 'error' => '');

		$_t_li = $this->get_linkageInfo($data['linkage_id']);

		if(0 == $_t_li['l_type']) {
			$result['error'] = L('SYSTEM_LINKAGE_IS_LOCKED');
			return $result;
		}

		/* delete linkage items */
		if(false === M('LinkageItem')->where(array('l_alias' => array('EQ', $_t_li['l_alias'])))->delete()) {
			$result['error'] = L('DELETE_LINKAGE_ITEM_FAILED');
			return $result;
		}

		if(false === $this->delete($linkageId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}

	public function update_cache($lAlias) {
		$result = array('data' => '', 'error' => '');

		$_LIL = M('LinkageItem')->where(array('l_alias' => array('EQ', $lAlias)))->order('`li_display_order` ASC,`linkage_item_id` ASC')->select();
		F('~linkage/~' . $lAlias, $_LIL);

		return $result;
	}

	public function get_linkage($lAlias) {
		$_LIL = F('~linkage/~' . $lAlias);
		if(empty($_LIL)) {
			$this->update_cache($lAlias);
			$_LIL = F('~linkage/~' . $lAlias);
		}
		$linkage = new ATree($_LIL, array(
			'linkage_item_id',
			'li_parent_id',
			'li_sub_item'));
		return $linkage;
	}

	public function get_linkageSelect($lAlias, $linkageItemId = 0, $selectType = 'current') {
		$linkageSelect = '';

		$linkage = $this->get_linkage($lAlias);

		if('current' == $selectType) {
			/* get sub linkage when linkage item id is zero */
			if(0 == $linkageItemId) {
				$liNav = $linkage->get_leaf($linkageItemId);
				if(!empty($liNav)) {
					$linkageSelect .= ' <select>';
					$linkageSelect .= '<option value="">----</option>';
					foreach($liNav as $lin) {
						$linkageSelect .= '<option value="' . $lin['linkage_item_id'] . '">' . $lin['li_name'] . '</option>';
					}
					$linkageSelect .= '</select>';
				}
			}
			else {
				$liNav = $linkage->get_navi($linkageItemId);
				foreach($liNav as $lin) {
					$linkageSelect .= ' <select>';
					$linkageSelect .= '<option value="">----</option>';

					/* current linkage item list */
					$_CLIL = $linkage->get_leaf($lin['li_parent_id']);
					foreach($_CLIL as $k => $li) {
						if(($linkageItemId == $li['linkage_item_id']) 
							or ((0 != $linkageItemId) and ($lin['linkage_item_id'] == $li['linkage_item_id']))) {
							$linkageSelect .= '<option value="' . $li['linkage_item_id'] . '" selected="selected">' . $li['li_name'] . '</option>';
						}
						else {
							$linkageSelect .= '<option value="' . $li['linkage_item_id'] . '">' . $li['li_name'] . '</option>';
						}
					}

					$linkageSelect .= '</select>';
				}
			}
		}
		elseif('sub' == $selectType) {
			if(!empty($linkageItemId)) {
				$liNav = $linkage->get_leaf($linkageItemId);
				if(!empty($liNav)) {
					$linkageSelect .= ' <select>';
					$linkageSelect .= '<option value="">----</option>';
					foreach($liNav as $lin) {
						$linkageSelect .= '<option value="' . $lin['linkage_item_id'] . '">' . $lin['li_name'] . '</option>';
					}
					$linkageSelect .= '</select>';
				}
			}
		}

		return $linkageSelect;
	}
}

?>