<?php

/**
 *--------------------------------------
 * MySQLi
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class DbMysqli extends Db {
	/* read detabase config */
	public function __construct($dbCfg = '') {
		if(!extension_loaded('mysqli')) {
			halt(L('_NOT_SUPPERT_') . ':mysqli');
		}
		if(!empty($dbCfg)) {
			$this->dbCfg = $dbCfg;
		}
		$this->init_connect();
	}

	/* connect database */
	public function connect($dbCfg = '', $linkNum = 0) {
		if(!isset($this->linkID[$linkNum])) {
			if(empty($dbCfg)) {
				$dbCfg = $this->dbCfg;
			}
			$this->linkID[$linkNum] = new mysqli($dbCfg['hostname'], $dbCfg['username'], $dbCfg['password'], $dbCfg['database'], $dbCfg['hostport'] ? intval($dbCfg['hostport']) : 3306);
			if(mysqli_connect_errno()) {
				halt(mysqli_connect_error());
			}
			$dbVersion = mysqli_get_server_info($this->linkID[$linkNum]);
			if($dbVersion >= "4.1") {
				$this->linkID[$linkNum]->query("SET NAMES '" . C('DB.CHARSET') . "'");
			}
			if($dbVersion > '5.0.1') {
				$this->linkID[$linkNum]->query("SET sql_mode=''"); // set sql_model
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
		$this->queryID = $this->_linkID->query($sql);
		$this->debug();
		if(false === $this->queryID) {
			$this->error();
			return false;
		}
		else {
			$this->numRows = $this->queryID->num_rows;
			$this->numCols = $this->queryID->field_count;
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
		$result = $this->_linkID->query($sql);
		$this->debug();
		if(false === $result) {
			$this->error();
			return false;
		}
		else {
			$this->numRows = $this->_linkID->affected_rows;
			$this->lastInsID = $this->_linkID->insert_id;
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
			for($i = 0; $i < $this->numRows; $i++) {
				$result[$i] = $this->queryID->fetch_assoc();
			}
			$this->queryID->data_seek(0);
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

		if($this->transTimes == 0) {
			$this->_linkID->autocommit(false);
		}
		$this->transTimes++;
		return;
	}

	/* submit non-automatic submission query */
	public function commit() {
		if($this->transTimes > 0) {
			$result = $this->_linkID->commit();
			$this->_linkID->autocommit(true);
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
			$result = $this->_linkID->rollback();
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
			return $this->_linkID->real_escape_string($str);
		}
		else {
			return addslashes($str);
		}
	}

	/* free query result */
	public function free() {
		mysqli_free_result($this->queryID);
		$this->queryID = 0;
	}

	/* close */
	public function close() {
		if(!empty($this->queryID)) {
			$this->queryID->free_result();
		}
		if($this->_linkID && !$this->_linkID->close()) {
			halt($this->error());
		}
		$this->_linkID = 0;
	}

	/* database error information */
	public function error() {
		$this->error = $this->_linkID->error;
		if($this->debug && '' != $this->queryStr) {
			$this->error .= "\r\n [ SQL ] : " . $this->queryStr;
		}
		return $this->error;
	}
}

?>