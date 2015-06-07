<?php

/**
 *--------------------------------------
 * MySQL
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class DbMysql extends Db {
	/* read database config */
	public function __construct($dbCfg = '') {
		if(!extension_loaded('mysql')) {
			halt(L('_NOT_SUPPERT_') . ':mysql');
		}
		if(!empty($dbCfg)) {
			$this->dbCfg = $dbCfg;
			if(empty($this->dbCfg['params'])) {
				$this->dbCfg['params'] = '';
			}
		}
		$this->init_connect();
	}

	/* connect database */
	public function connect($dbCfg = '', $linkNum = 0) {
		if(!isset($this->linkID[$linkNum])) {
			if(empty($dbCfg)) {
				$dbCfg = $this->dbCfg;
			}
			$host = $dbCfg['hostname'] . ($dbCfg['hostport'] ? ":{$dbCfg['hostport']}" : '');
			$pconnect = !empty($dbCfg['params']['persist']) ? $dbCfg['params']['persist'] : false;
			if($pconnect) {
				$this->linkID[$linkNum] = mysql_pconnect($host, $dbCfg['username'], $dbCfg['password'], 131072);
			}
			else {
				$this->linkID[$linkNum] = mysql_connect($host, $dbCfg['username'], $dbCfg['password'], true, 131072);
			}
			if(!$this->linkID[$linkNum] || (!empty($dbCfg['database']) && !mysql_select_db($dbCfg['database'], $this->linkID[$linkNum]))) {
				halt(mysql_error());
			}

			$dbVersion = mysql_get_server_info($this->linkID[$linkNum]);
			mysql_query("SET NAMES '" . C('DB.CHARSET') . "'", $this->linkID[$linkNum]);
			if($dbVersion > '5.0.1') {
				mysql_query("SET sql_mode=''", $this->linkID[$linkNum]); // set sql_model
			}
			$this->connected = true; // mark connect success
			if(1 != C('DB.DEPLOY_TYPE')) {
				unset($this->dbCfg); // unset database config
			}
		}
		return $this->linkID[$linkNum];
	}

	/* query */
	public function query($sql) {
		if(0 === stripos($sql, 'call')) {
			$this->close();
			$this->connected = false;
		}
		$this->init_connect(false);
		if(!$this->_linkID) {
			return false;
		}
		$this->queryStr = $sql;
		if($this->queryID) {
			$this->free(); // free last query result
		}
		N('db_query', 1); // record database query time
		G('queryStartTime'); // record query start time
		$this->queryID = mysql_query($sql, $this->_linkID);
		$this->debug();
		if(false === $this->queryID) {
			$this->error();
			return false;
		}
		else {
			$this->numRows = mysql_num_rows($this->queryID);
			$this->numCols = mysql_num_fields($this->queryID);
			return $this->get_all();
		}
	}

	/* execute */
	public function execute($sql) {
		$this->init_connect(true);
		if(!$this->_linkID) {
			return false;
		}
		$this->queryStr = $sql;
		if($this->queryID) {
			$this->free(); // free last query result
		}
		N('db_write', 1); // record database write time
		G('queryStartTime'); // record query start time
		$result = mysql_query($sql, $this->_linkID);
		$this->debug();
		if(false === $result) {
			$this->error();
			return false;
		}
		else {
			$this->numRows = mysql_affected_rows($this->_linkID);
			$this->lastInsID = mysql_insert_id($this->_linkID);
			return $this->numRows;
		}
	}

	/* replace data */
	public function replace($data, $options = array()) {
		foreach($data as $key => $val) {
			$value = $this->parse_value($val);
			if(is_scalar($value)) {
 				/* filter non-scalar data */
				$values[] = $value;
				$fields[] = $this->parse_key($key);
			}
		}
		$sql = 'REPLACE INTO ' . $this->parse_table($options['table']) . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')';
		return $this->execute($sql);
	}

	/* get all query result */
	private function get_all() {
		$result = array();
		if($this->numRows > 0) {
			while($row = mysql_fetch_assoc($this->queryID)) {
				$result[] = $row;
			}
			mysql_data_seek($this->queryID, 0);
		}
		return $result;
	}

	/* get table information */
	public function get_tables($dbName = '') {
		$sql = !empty($dbName) ? 'SHOW TABLES FROM ' . $dbName : 'SHOW TABLES ';
		$result = $this->query($sql);
		$info = array();
		if($result) {
			foreach($result as $key => $val) {
				$info[$key] = current($val);
			}
		}
		return $info;
	}

	/* get table field information */
	public function get_fields($tableName) {
		$result = $this->query('SHOW COLUMNS FROM ' . $this->parse_key($tableName));
		$info = array();
		if($result) {
			foreach($result as $key => $val) {
				$info[$val['Field']] = array(
					'name' => $val['Field'],
					'type' => $val['Type'],
					'null' => $val['Null'],
					'default' => $val['Default'],
					'primary' => (strtolower($val['Key']) == 'pri'),
					'autoinc' => (strtolower($val['Extra']) == 'auto_increment'),
					);
			}
		}
		return $info;
	}

	/* start transaction */
	public function start_trans() {
		$this->initConnect(true);

		if(!$this->_linkID) {
			return false;
		}
		if(0 == $this->transTimes) {
			mysql_query('START TRANSACTION', $this->_linkID);
		}
		$this->transTimes++;
		return;
	}

	/* submit non-automatic submission query */
	public function commit() {
		if($this->transTimes > 0) {
			$result = mysql_query('COMMIT', $this->_linkID);
			$this->transTimes = 0;
			if(!$result) {
				halt($this->error());
			}
		}
		return true;
	}

	/* transaction rollback */
	public function rollback() {
		if($this->transTimes > 0) {
			$result = mysql_query('ROLLBACK', $this->_linkID);
			$this->transTimes = 0;
			if(!$result) {
				halt($this->error());
			}
		}
		return true;
	}

	/* insert data */
	public function insert_all($datas, $options = array(), $replace = false) {
		if(!is_array($datas[0])) {
			return false;
		}
		$fields = array_keys($datas[0]);
		array_walk($fields, array($this, 'parse_key'));
		$values = array();
		foreach($datas as $data) {
			$value = array();
			foreach($data as $val) {
				$val = $this->parse_value($val);
				if(is_scalar($val)) {
 					/* filter non-scalar data */
					$value[] = $val;
				}
			}
			$values[] = '(' . implode(',', $value) . ')';
		}
		$sql = ($replace ? 'REPLACE' : 'INSERT') . ' INTO ' . $this->parse_table($options['table']) . ' (' . implode(',', $fields) . ') VALUES ' . implode(',', $values);
		return $this->execute($sql);
	}

	/* parse field name and table name */
	protected function parse_key(&$key) {
		$key = trim($key);
		if(!preg_match('/[,\'\"\*\(\)`.\s]/', $key)) {
			$key = '`' . $key . '`';
		}
		return $key;
	}

	/* escape special characters */
	protected function escape_string($str) {
		if($this->_linkID) {
			return mysql_real_escape_string($str, $this->_linkID);
		}
		else {
			return mysql_escape_string($str);
		}
	}

	/* free query result */
	public function free() {
		mysql_free_result($this->queryID);
		$this->queryID = null;
	}

	/* close database */
	public function close() {
		if($this->_linkID) {
			mysql_close($this->_linkID);
		}
		$this->_linkID = null;
	}

	/* database error information */
	public function error() {
		$this->error = mysql_errno() . ':' . mysql_error($this->_linkID);
		if($this->debug && '' != $this->queryStr) {
			$this->error .= "\r\n [ SQL ] : " . $this->queryStr;
		}
		return $this->error;
	}
}

?>