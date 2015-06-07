<?php

/**
 *--------------------------------------
 * memcache
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CacheMemcache extends Cache {
	function __construct($options = array()) {
		if(!extension_loaded('memcache')) {
			halt(L('_NOT_SUPPERT_') . ':memcache');
		}
		$this->options = array(
			'host' => C('CACHE.MEMCACHE_HOST'),
			'port' => C('CACHE.MEMCACHE_PORT'),
			'timeout' => C('CACHE.MEMCACHE_TIMEOUT'),
			'persistent' => false,
			'expire' => C('CACHE.EXPIRE'),
			'length' => 0,
			);
		if(!empty($options)) {
			$this->options = array_merge($this->options, $options);
		}
		$func = $this->options['persistent'] ? 'pconnect' : 'connect';
		$this->handler = new Memcache;
		$this->connected = $this->options['timeout'] === false ? $this->handler->$func($this->options['host'], $this->options['port']) : $this->handler->$func($this->options['host'], $this->options['port'], $this->options['timeout']);
	}

	/* whether is connected */
	private function is_connected() {
		return $this->connected;
	}

	/* read cache */
	public function get($name) {
		N('cache_read', 1);
		return $this->handler->get($name);
	}

	/* write cache */
	public function set($name, $value, $expire = null) {
		N('cache_write', 1);
		if(is_null($expire)) {
			$expire = $this->options['expire'];
		}
		if($this->handler->set($name, $value, 0, $expire)) {
			return true;
		}
		return false;
	}

	/* delete cache */
	public function del($name, $ttl = false) {
		return $ttl === false ? $this->handler->delete($name) : $this->handler->delete($name, $ttl);
	}

	/* clear cache */
	public function clear() {
		return $this->handler->flush();
	}
}

?>