<?php

/**
 *--------------------------------------
 * tree structure
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-12-13
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ATree {
	private $data; // tree structure data
	private $fields; // field names
	private $root; // root parent id
	private $tmp;
	private $arr; // result array
	private $str; // result string
	private $already = array();
	public $icon = array(
		'┃　',
		'┣',
		'┗',
		'　　'); // item icon

	public function __construct($data, $fields = array(
		'id',
		'pid',
		'child'), $root = 0) {
		$this->data = $data;
		$this->fields = $fields;
		$this->root = $root;
		$this->handler();
	}

	/* tree structure data table handler */
	private function handler() {
		foreach($this->data as $node) {
			$tmp[$node[$this->fields[1]]][] = $node;
		}
		krsort($tmp);
		for($i = count($tmp); $i > 0; $i--) {
			foreach($tmp as $k => $v) {
				if(!in_array($k, $this->already)) {
					if(!$this->tmp) {
						$this->tmp = array($k, $v);
						$this->already[] = $k;
						continue;
					}
					else {
						foreach($v as $key => $value) {
							if($value[$this->fields[0]] == $this->tmp[0]) {
								$tmp[$k][$key][$this->fields[2]] = $this->tmp[1];
								$this->tmp = array($k, $tmp[$k]);
							}
						}
					}
				}
			}
			$this->tmp = null;
		}
		$this->tmp = $tmp;
	}

	/* reverse recursion */
	private function recur_n($arr, $id) {
		foreach($arr as $v) {
			if($v[$this->fields[0]] == $id) {
				$this->arr[] = $v;
				if($v[$this->fields[1]] != $this->root) {
					$this->recur_n($arr, $v[$this->fields[1]]);
				}
			}
		}
	}

	/* forward recursion */
	private function recur_p($arr) {
		foreach($arr as $v) {
			$this->arr[] = $v[$this->fields[0]];
			if(isset($v[$this->fields[2]]) and !empty($v[$this->fields[2]])) {
				$this->recur_p($v[$this->fields[2]]);
			}
		}
	}

	/* get menu. $id: id, return leaf, default return full tree */
	public function get_leaf($id = null) {
		$id = ($id == null) ? $this->root : $id;
		return $this->tmp[$id];
	}

	/* get navigation. $id: id, return root to id */
	public function get_navi($id) {
		$this->arr = null;
		$this->recur_n($this->data, $id);
		if(!is_null($this->arr)) {
			krsort($this->arr);
		}
		return $this->arr;
	}

	/* get leaf ids. $id: id, retrun ids under leaf */
	public function get_leafid($id) {
		$this->arr = null;
		$this->arr[] = $id;
		$this->recur_p($this->get_leaf($id));
		return $this->arr;
	}

	/* get select form <option value='\$id' \$selected>\$spacer \$name</option>\r\n, <optgroup label='\$name'></optgroup>\r\n */
	public function get_leafStr($id, $str, $selectId = 0, $selectedStr = '', $spacer_addon = '') {
		$return = '';
		$child = $this->get_leaf($id);
		if(is_array($child)) {
			$number = 1;
			$count = count($child);
			foreach($child as $v) {
				if($number == $count) {
					$icon = $this->icon[2];
					$spacer = $spacer_addon . $icon;
				}
				else {
					$icon = $this->icon[1];
					$spacer = $spacer_addon . $icon;
				}

				@extract($v);
				if(!is_array($selectId)) {
					$selectId = explode(',', $selectId);
				}
				in_array($v[$this->fields[0]], $selectId) ? eval("\$_t_str = \"$selectedStr\";") : eval("\$_t_str = \"$str\";");
				$return .= $_t_str;

				if(isset($v[$this->fields[2]])) {
					if($number == $count) {
						$addon = $spacer_addon . $this->icon[3];
					}
					else {
						$addon = $spacer_addon . $this->icon[0];
					}
					$return .= $this->get_leafStr($v[$this->fields[0]], $str, $selectId, $selectedStr, $addon);
				}
				$number++;
			}
		}
		return $return;
	}
}

/**
 * $tree= new ATree($data, array('id', 'pid', 'child'));
 * $arr=$tree->get_leaf(0);
 * $nav=$tree->get_navi(15);
 * $str = $tree->get_leafStr(0, "<option value='\$id'>\$spacer \$name</option>\r\n", 4, "<option value='\$id' selected='selected'>\$spacer \$name</option>\r\n");
 *
 * echo "<select name=\"f_id\" size=10>\r\n";
 * echo $str;
 * echo "</select>";
 */

?>