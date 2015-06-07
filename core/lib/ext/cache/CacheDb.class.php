<?php

/**
 *--------------------------------------
 * cache to database
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

/* cache table structure
CREATE TABLE pfa_cache (
cachekey varchar(255) NOT NULL,
expire int(11) NOT NULL,
data blob,
datacrc int(32),
UNIQUE KEY `cachekey` (`cachekey`)
);
*/
defined('PFA_PATH') or exit('Access Denied');

class CacheDb extends Cache {
	private $db;
 	/* cache database object */

	function __construct($options = array()) {
		$this->options = array(
			'db' => C('DB.NAME'),
			'table' => C('CACHE.TABLE'),
			'expire' => C('CACHE.EXPIRE'),
			'length' => 0,
			);
		if(!empty($options)) {
			$this->options = array_merge($this->options, $options);
		}
		$this->db = get_instance('Db');
		$this->connected = is_resource($this->db);
	}

	/* whether cache is connected */
	private function is_connected() {
		return $this->connected;
	}

	/* get cache */
	public function get($name) {
		$name = addslashes($name);
		N('cache_read', 1);
		$result = $this->db->query('SELECT `data`, `datacrc` FROM `' . $this->options['table'] . '` WHERE `cachekey`=\'' . $name . '\' AND (`expire` = 0 OR `expire` > ' . time() . ') LIMIT 0, 1');
		if(false !== $result) {
			$result = $result[0];
			if(C('CACHE.CHECK')) {
				if($result['datacrc'] != md5($result['data'])) {
 					/* verify failed */
					return false;
				}
			}
			$content = $result['data'];
			if(C('CACHE.COMPRESS') && function_exists('gzcompress')) {
 				/* uncompress data */
				$content = gzuncompress($content);
			}
			$content = unserialize($content);
			return $content;
		}
		return false;
	}

	/* write data */
	public function set($name, $value, $expire = null) {
		$data = serialize($value);
		$name = addslashes($name);
		N('cache_write', 1);
		if(C('CACHE.COMPRESS') && function_exists('gzcompress')) {
 			/* compress data */
			$data = gzcompress($data, 3);
		}
		$crc = '';
 		/* verify data */
		if(C('CACHE.CHECK')) {
			$crc = md5($data);
		}
		$expire = !empty($expire) ? $expire : $this->options['expire'];
		$expire = ($expire == 0) ? 0 : (time() + $expire);
		$result = $this->db->query('select `cachekey` from `' . $this->options['table'] . '` where `cachekey`=\'' . $name . '\' limit 0,1');
		if(!empty($result)) {
 			/* update */
			$result = $this->db->execute('UPDATE ' . $this->options['table'] . ' SET `data` = \'' . $data . '\', `datacrc` = \'' . $crc . '\', `expire` = ' . $expire . ' WHERE `cachekey`=\'' . $name . '\'');
		}
		else {
 			/* add */
			$result = $this->db->execute('INSERT INTO ' . $this->options['table'] . ' (`cachekey`, `data`, `datacrc`, `expire`) VALUES (\'' . $name . '\',\'' . $data . '\',\'' . $crc . '\',' . $expire . ')');
		}
		if($result) {
			return true;
		}
		return false;
	}

	/* delete cache */
	public function del($name) {
		$name = addslashes($name);
		return $this->db->execute('DELETE FROM `' . $this->options['table'] . '` WHERE `cachekey`=\'' . $name . '\'');
	}

	/* clear cache */
	public function clear() {
		return $this->db->execute('TRUNCATE TABLE `' . $this->options['table'] . '`');
	}
}

?>