<?php

/**
 *--------------------------------------
 * cache base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Cache extends Pfa {
	protected $handler; // operation handler
	protected $connected; // whether connect
	protected $options = array(); // cache connect option

	/* connect cache. $type: cache type, $options: config array */
	public static function connect($options = array()) {
		if(!isset($options['cacheType'])) {
			$options['cacheType'] = C('CACHE.TYPE');
		}
		$cacheClass = 'Cache' . ucwords(strtolower($options['cacheType']));
		import('lib.ext.cache.' . $cacheClass, PFA_PATH);
		$cache = get_instance($cacheClass, $options);
		return $cache;
	}

	public function __get($name) {
		return $this->get($name);
	}

	public function __set($name, $value) {
		return $this->set($name, $value);
	}

	public function __unset($name) {
		return $this->del($name);
	}

	public function set_option($name, $value) {
		$this->options[$name] = $value;
	}

	public function get_option($name) {
		return $this->options[$name];
	}
}

?>