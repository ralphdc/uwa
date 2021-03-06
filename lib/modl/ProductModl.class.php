<?php

/**
 *--------------------------------------
 * single page
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-19
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ProductModl extends Modl {
	public function get_productPageList($where = '', $order = '', $limit = 10) {
		$_SPL = $this->where($where)->order($order)->limit($limit)->select();
		return $_SPL;
	}

	public function get_productInfo($productId) {
		$_SPI = $this->where(array('product_id' => array('EQ', $productId)))->find();
		if(!empty($_SPI)) {
			/* update url */
		}
		return $_SPI;
	}

	public function add_product($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['product_id']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		/* update upload */
		M('Upload')->update_upload($_t_id);

		return $result;
	}

	public function edit_product($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* update upload */
		M('Upload')->update_upload($data['product_id']);

		return $result;
	}

	public function delete_product($productId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($productId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'product'), 'u_item_id' => array('EQ', $productId)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', 'product'), 'u_item_id' => array('EQ', $productId)))->delete();

		return $result;
	}

	public function build_url($productId) {
		$result = array('data' => '', 'error' => '');

		$_SPI = $this->where(array('product_id' => array('EQ', $productId)))->find();
		if(empty($_SPI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$url_o = Url::U('home@single_page/show_pcatogery_page?category_id=' . $productId);

		if($_SPI['sp_is_html']) {
			vendor('Pinyin#class');
			$pyc = get_instance('Pinyin');
			$naming = str_replace(array('{uwa_path}', '{sp_py}'), array('', $pyc->get_pinyin($_SPI['sp_title'], 'utf-8')), $_SPI['sp_html_naming']);
			$url = __APP__ . trim($naming, '/') . C('HTML.FILE_SUFFIX');
		}
		else {
			$url = $url_o;
		}
		$this->where(array('single_page_id' => array('EQ', $productId)))->set_field(array('sp_url', 'sp_url_o'), array($url, $url_o));
		$result['sp_url'] = $url;
		$result['sp_url_o'] = $url_o;
		return $result;
	}

}

?>