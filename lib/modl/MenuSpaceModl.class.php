<?php

/**
 *--------------------------------------
 * menu space
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-12
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MenuSpaceModl extends Modl {
	public function get_spaceList() {
		$_MSL = F('~menu/~msl');
		if(empty($_MSL)) {
			$_MSL = $this->order('`menu_space_id` DESC')->select();
			F('~menu/~msl', $_MSL);
		}
		return $_MSL;
	}

	public function get_spaceInfo($menuSpaceId) {
		$_MSI = F('~menu/~msi_' . $menuSpaceId);
		if(empty($_MSI)) {
			$_MSI = $this->where(array('menu_space_id' => array('EQ', $menuSpaceId)))->find();
			F('~menu/~msi_' . $menuSpaceId, $_MSI);
 			/* cache menu space information */
		}
		return $_MSI;
	}

	public function add_space($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['menu_space_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		F('~menu/~msl', null);

		return $result;
	}

	public function edit_space($data) {
		$result = array('data' => '', 'error' => '');

		$_MSI = $this->get_spaceInfo($data['menu_space_id']);
		if(empty($_MSI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* upload menu's space alias */
		if(isset($data['ms_alias']) and ($_MSI['ms_alias'] != $data['ms_alias'])) {
			M('Menu')->where(array('ms_alias' => array('EQ', $_MSI['ms_alias'])))->set_field('ms_alias', $data['ms_alias']);
			F('~menu/~ml_', null);
			F('~menu/~ml_' . $_MSI['ms_alias'], null);
		}

		F('~menu/~msi_' . $data['menu_space_id'], null);
 		/* delete menu space cache */
		F('~menu/~msl', null);

		return $result;
	}

	public function delete_space($menuSpaceId) {
		$result = array('data' => '', 'error' => '');

		$_MSI = $this->get_spaceInfo($menuSpaceId);
		if(empty($_MSI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->delete($menuSpaceId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete Menu */
		$menuId = M('Menu')->field('menu_id')->where(array('ms_alias' => array('EQ', $_MSI['ms_alias'])))->select();
		if(!empty($menuId)) {
			foreach($menuId as $menuId) {
				M('Menu')->delete_menu($menuId['menu_id']);
			}
		}

		F('~menu/~msi_' . $menuSpaceId, null);
 		/* delete menu space cache */
		F('~menu/~msl', null);

		return $result;
	}

}

?>