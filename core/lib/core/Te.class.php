<?php

/**
 *--------------------------------------
 * template engine base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Te extends Pfa {
	protected $options = array(); // template engine option

	/* template engine factory */
	public function get_te($options = array()) {
		if(!isset($options['teType'])) {
			$options['teType'] = C('TE.TYPE');
		}
		$teClass = 'Te' . ucwords(strtolower($options['teType']));
		import('lib.ext.te.' . $teClass, PFA_PATH);
		$te = get_instance($teClass, $this->options);
		return $te;
	}

	/* set option */
	public function set_option($name, $value) {
		$this->options[$name] = $value;
	}

	/* get option */
	public function get_option($name) {
		return $this->options[$name];
	}
}

?>