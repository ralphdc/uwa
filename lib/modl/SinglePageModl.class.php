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

class SinglePageModl extends Modl {
	public function get_singlePageList($where = '', $order = '', $limit = 10) {
		$_SPL = $this->where($where)->order($order)->limit($limit)->select();
		if(!empty($_SPL)) {
			foreach($_SPL as $k => $v) {
				/* update url */
				if(empty($v['sp_url']) or empty($v['sp_url_o'])) {
					$_r = $this->build_url($v['single_page_id']);
					$_SPL[$k]['sp_url'] = $_r['sp_url'];
					$_SPL[$k]['sp_url_o'] = $_r['sp_url_o'];
				}
			}
		}
		return $_SPL;
	}

	public function get_singlePageInfo($singlePageId) {
		$_SPI = $this->where(array('single_page_id' => array('EQ', $singlePageId)))->find();
		if(!empty($_SPI)) {
			/* update url */
			if(empty($_SPI['sp_url']) or empty($_SPI['sp_url_o'])) {
				$_r = $this->build_url($_SPI['single_page_id']);
				$_SPI['sp_url'] = $_r['sp_url'];
				$_SPI['sp_url_o'] = $_r['sp_url_o'];
			}
		}
		return $_SPI;
	}

	public function add_single_page($data) {
		$result = array('data' => '', 'error' => '');

		unset($data['single_page_id']);
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

	public function edit_single_page($data) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		/* update upload */
		M('Upload')->update_upload($data['single_page_id']);

		return $result;
	}

	public function delete_single_page($singlePageId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($singlePageId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete upload */
		$_UL = M('Upload')->where(array('u_item_type' => array('EQ', 'single_page'), 'u_item_id' => array('EQ', $singlePageId)))->select();
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
		M('Upload')->where(array('u_item_type' => array('EQ', 'single_page'), 'u_item_id' => array('EQ', $singlePageId)))->delete();

		return $result;
	}

	public function build_url($singlePageId) {
		$result = array('data' => '', 'error' => '');

		$_SPI = $this->where(array('single_page_id' => array('EQ', $singlePageId)))->find();
		if(empty($_SPI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		$url_o = Url::U('home@single_page/show_single_page?single_page_id=' . $singlePageId);

		if($_SPI['sp_is_html']) {
			vendor('Pinyin#class');
			$pyc = get_instance('Pinyin');
			$naming = str_replace(array('{uwa_path}', '{sp_py}'), array('', $pyc->get_pinyin($_SPI['sp_title'], 'utf-8')), $_SPI['sp_html_naming']);
			$url = __APP__ . trim($naming, '/') . C('HTML.FILE_SUFFIX');
		}
		else {
			$url = $url_o;
		}
		$this->where(array('single_page_id' => array('EQ', $singlePageId)))->set_field(array('sp_url', 'sp_url_o'), array($url, $url_o));
		$result['sp_url'] = $url;
		$result['sp_url_o'] = $url_o;
		return $result;
	}

}

?>