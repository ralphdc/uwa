<?php

/**
 *--------------------------------------
 * menu
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MenuModl extends Modl {
	public function get_menuList($msAlias = null) {
		$_ML = F('~menu/~ml_' . $msAlias);
		if(empty($_ML)) {
			$where = array();
			if(!empty($msAlias)) {
				$where['__MENU__.ms_alias'] = array('EQ', $msAlias);
			}
			$_ML = $this->order('ms.menu_space_id ASC, m_display_order ASC')->join('__MENU_SPACE__ AS ms ON ms.ms_alias = __MENU__.ms_alias')->where($where)->select();
			if(!empty($_ML)) {
				/* get top menu */
				$_T = array();
				foreach($_ML as $k => $menu) {
					if(0 == $menu['m_parent_id']) {
						$menu['url'] = get_url($menu['m_url'], $menu['m_type']);
						$menu['url_o'] = get_url($menu['m_url'], $menu['m_type'], true);
						$_T[$menu['menu_id']] = $menu;
						unset($_ML[$k]);
					}
				}
				/* get child menu */
				foreach($_ML as $k => $menu) {
					if(isset($_T[$menu['m_parent_id']])) {
						$menu['url'] = get_url($menu['m_url'], $menu['m_type']);
						$menu['url_o'] = get_url($menu['m_url'], $menu['m_type'], true);
						$_T[$menu['m_parent_id']]['m_sub_menu'][] = $menu;
					}
				}
				$_ML = array_values($_T);
				F('~menu/~ml_' . $msAlias, $_ML);
			}
		}
		return $_ML;
	}

	public function get_menuInfo($menuId) {
		$_MI = $this->where(array('menu_id' => array('EQ', $menuId)))->find();
		return $_MI;
	}

	public function add_menu($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['menu_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~menu/~ml_', null);
		F('~menu/~ml_' . $data['ms_alias'], null);

		return $result;
	}

	public function edit_menu($data) {
		$result = array('data' => '', 'error' => '');

		$_MI = $this->get_menuInfo($data['menu_id']);

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		F('~menu/~ml_', null);
		F('~menu/~ml_' . $data['ms_alias'], null);
		if($_MI['ms_alias'] != $data['ms_alias']) {
			F('~menu/~ml_' . $_MI['ms_alias'], null);
		}

		return $result;
	}

	public function delete_menu($menuId) {
		$result = array('data' => '', 'error' => '');

		$_MI = $this->where(array('menu_id' => array('EQ', $menuId)))->find();
		if(empty($_MI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$_t_sub = $this->where(array('m_parent_id' => array('EQ', $menuId)))->select();
		if(!empty($_t_sub)) {
			$result['error'] = L('SUB_MENU_EXIST');
			return $result;
		}

		if(false === $this->delete($menuId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		F('~menu/~ml_', null);
		F('~menu/~ml_' . $_MI['ms_alias'], null);

		return $result;
	}
}

?>