<?php

/**
 *--------------------------------------
 * file cache
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CacheFile extends Cache {
	protected $prefix = '~@'; // cache prefix

	public function __construct($options = array()) {
		$this->options = array(
			'temp' => C('CACHE.PATH'),
			'expire' => C('CACHE.EXPIRE'),
			'length' => 0,
			);
		if(!empty($options)) {
			$this->options = array_merge($this->options, $options);
		}

		$this->options['temp'] = rtrim($this->options['temp'], '/\\') . D_S;

		$this->connected = is_dir($this->options['temp']) && dir_writable($this->options['temp']);
		$this->init();
	}

	/* initialize */
	private function init() {
		if(!is_dir($this->options['temp'])) {
			if(!mk_dir($this->options['temp'])) {
				return false;
			}
		}
		return true;
	}

	/* whether is connected */
	private function is_connected() {
		return $this->connected;
	}

	/* get cache filename */
	private function get_filename($name) {
		$name = md5($name);
		if(C('CACHE.SUBDIR')) {
			$dir = '';
 			/* use sub directory */
			for($i = 0; $i < C('CACHE.PATH_LEVEL'); $i++) {
				$dir .= $name{$i} . D_S;
			}
			if(!is_dir($this->options['temp'] . $dir)) {
				mk_dir($this->options['temp'] . $dir);
			}
			$filename = $dir . $this->prefix . $name . '.php';
		}
		else {
			$filename = $this->prefix . $name . '.php';
		}
		return $this->options['temp'] . $filename;
	}

	/* write cache */
	public function set($name, $value, $expire = null) {
		N('cache_write', 1);
		if(is_null($expire)) {
			$expire = $this->options['expire'];
		}
		$filename = $this->get_filename($name);
		$data = serialize($value);
		if(C('CACHE.COMPRESS') && function_exists('gzcompress')) {
 			/* compress data */
			$data = gzcompress($data, 3);
		}
		$check = '';
		if(C('CACHE.CHECK')) {
 			/* verify data */
			$check = md5($data);
		}
		$data = "<?php\r\n//" . sprintf('%012d', $expire) . $check . $data . "\r\n?>";
		$result = file_put_contents($filename, $data);
		if($result) {
			clearstatcache();
			return true;
		}
		return false;
	}

	/* read cache */
	public function get($name) {
		$filename = $this->get_filename($name);
		if(!$this->is_connected() || !is_file($filename)) {
			return false;
		}
		N('cache_read', 1);
		$content = file_get_contents($filename);
		if(false !== $content) {
			$expire = (int)substr($content, 9, 12);
			if($expire != 0 && time() > filemtime($filename) + $expire) {
				@unlink($filename);
 				/* delete expire cache */
				return false;
			}
			if(C('CACHE.CHECK')) {
				$check = substr($content, 21, 32);
				$content = substr($content, 53, -4);
				if($check != md5($content)) {
 					/* verify failed */
					return false;
				}
			}
			else {
				$content = substr($content, 21, -4);
			}
			if(C('CACHE.COMPRESS') && function_exists('gzcompress')) {
 				/* uncompress data */
				$content = gzuncompress($content);
			}
			$content = unserialize($content);
			return $content;
		}
		return false;
	}

	/* delete cache */
	public function del($name) {
		return @unlink($this->get_filename($name));
	}

	/* clear cache */
	public function clear() {
		return clear_dir($this->options['temp'], true);
	}
}

?>