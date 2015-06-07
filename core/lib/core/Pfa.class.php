<?php

/**
 *--------------------------------------
 * framework base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Pfa {
	/* auto set veriable */
	public function __set($name, $value) {
		if(property_exists($this, $name)) {
			$this->$name = $value;
		}
	}

	/* auto get veriable */
	public function __get($name) {
		return isset($this->$name) ? $this->$name : '';
	}
}

?>