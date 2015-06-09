<?php

/**
 *--------------------------------------
 * model base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Modl extends Pfa {
	protected $connection; // connect option
	protected $name = ''; // model name
	public $db = null; // current database operation object
	protected $dbName = ''; // database name
	protected $tablePrefix = ''; // database table prefix
	protected $tableSuffix = ''; // database table suffix
	protected $tableName = ''; // table name(not contain prefix and suffix)
	protected $trueTableName = ''; // true table name(contain prefix and suffix)
	protected $pk = 'id'; // default primary key
	protected $fields = array(); // fields information
	protected $data = array(); // data object
	protected $options = array(); // options
	protected $error = ''; // latest error
	protected $_validate = array(); // auto validate data. array(field, rule, message, type)
	protected $autoCheckFields = true; // whether auto check fields information

	public function __construct($name = '', $connection = '') {
		/* get model name */
		if(!empty($name)) {
			$this->name = $name;
		}
		elseif(empty($this->name)) {
			$this->name = $this->get_modlName();
		}
		/* set table prefix and suffix */
		$this->tablePrefix = $this->tablePrefix ? $this->tablePrefix : C('DB.PREFIX');
		/* get database operation object */
		$this->db(0, empty($this->connection) ? $connection : $this->connection);

		if(!empty($this->name) && $this->autoCheckFields) {
			$this->check_tableInfo(); // check table fields
		}
	}

	/* toggle current database connect */
	protected function db($linkNum, $config = '') {
		static $_db = array();
		if(!isset($_db[$linkNum])) {
			if(!empty($config) && false === strpos($config, '/')) {
				$config = C($config);
			}
			$_db[$linkNum] = get_instance('Db', '', 'get_db', $config);
		}
		elseif(null === $config) {
			$_db[$linkNum]->close(); // close database connect
			unset($_db[$linkNum]);
			return;
		}
		$this->db = $_db[$linkNum];
 		/* toggle current database connect */
		return $this;
	}

	/* check table information */
	protected function check_tableInfo() {
	    //exit;
		if(empty($this->fields)) {
			if(C('DB.FIELDS_CACHE')) {
				$this->fields = F('~fields/~' . $this->name);
				if(!$this->fields) {
					$this->flush();
				}
			}
			else {
				$this->flush();
			}
		}
	}

	/* get fields information and save cache */
	public function flush() {
		$fields = $this->db->get_fields($this->get_tableName());
		if(!$fields) {
			return false; // can't get fields information
		}
		$this->fields = array_keys($fields);
		$this->fields['_autoinc'] = false;
		foreach($fields as $key => $val) {
			$type[$key] = $val['type']; // record field type
			if($val['primary']) {
				$this->fields['_pk'] = $key;
				if($val['autoinc']) {
					$this->fields['_autoinc'] = true;
				}
			}
		}
		if(C('DB.FIELDTYPE_CHECK')) {
			$this->fields['_type'] = $type;
 			/* record fields type information */
		}
		if(C('DB.FIELDS_CACHE')) {
			F('~fields/~' . $this->name, $this->fields);
 			/* cache table fields information */
		}
	}

	/* get current data object name */
	public function get_modlName() {
		if(empty($this->name)) {
			$this->name = substr(get_class($this), 0, -4);
		}
		return $this->name;
	}

	/* get full table name */
	public function get_tableName() {
		if(empty($this->trueTableName)) {
			$tableName = !empty($this->tablePrefix) ? $this->tablePrefix : '';
			if(!empty($this->tableName)) {
				$tableName .= $this->tableName;
			}
			else {
				$tableName .= parse_name($this->name);
			}
			$tableName .= !empty($this->tableSuffix) ? $this->tableSuffix : '';
			$this->trueTableName = strtolower($tableName);
		}
		return (!empty($this->dbName) ? $this->dbName . '.' : '') . $this->trueTableName;
	}

	/* get table field information */
	public function get_dbFields() {
		return $this->fields;
	}

	/* get primary key name */
	public function get_pk() {
		return isset($this->fields['_pk']) ? $this->fields['_pk'] : $this->pk;
	}

	/* get model error information */
	public function get_error() {
		return $this->error;
	}

	/* create and verify data object[$data], but do not save to database */
	public function create($data = '', $type = '') {
		if(empty($data)) {
			$data = $_POST; // default get data from $_POST
		}
		elseif(is_object($data)) {
			$data = get_object_vars($data);
		}

		if(empty($data) || !is_array($data)) {
			$this->error = L('_DATA_TYPE_INVALID_');
			return false;
		}

		/* auto verify data */
		if(!$this->verify_data($data, $type)) {
			return false;
		}

		/* verify data according fields */
		if($this->autoCheckFields) {
 			/* filter illegal field data */
			$vo = array();
			foreach($this->fields as $key => $name) {
				if(substr($key, 0, 1) == '_') {
					continue;
				}
				$val = isset($data[$name]) ? $data[$name] : null;
				/* remove invalid data */
				if(!is_null($val)) {
					$vo[$name] = $val;
				}
			}
			$data = $vo;
		}
		return $this->data = $data;
	}

	/* deal with MAGIC_QUOTES_GPC */
	private function deal_mq($data) {
		if(is_array($data)) {
			foreach($data as $k => $v) {
				$data[$k] = $this->deal_mq($v);
			}
		}
		elseif(is_string($data)) {
			$data = (MAGIC_QUOTES_GPC ? stripslashes($data) : $data);
		}
		return $data;
	}

	/* query one row */
	public function find($options = array()) {
		if(is_numeric($options) || is_string($options)) {
			$where[$this->get_pk()] = $options;
			$options = array();
			$options['where'] = $where;
		}
		$options['limit'] = 1; // always find one row
		$options = $this->parse_options($options); // parse option expression
		$resultSet = $this->db->select($options);
		if(false === $resultSet) {
			return false;
		}
		if(empty($resultSet)) {
			return '';
		}
		$this->data = $resultSet[0];
		return $this->data;
	}

	/* increase field value */
	public function field_inc($field, $condition = '', $step = 1) {
		return $this->set_field($field, array('exp', $field . '+' . $step), $condition);
	}

	/* decrease field value */
	public function field_dec($field, $condition = '', $step = 1) {
		return $this->set_field($field, array('exp', $field . '-' . $step), $condition);
	}

	/* set field, support use database field and method */
	public function set_field($field, $value, $condition = '') {
		if(empty($condition) && isset($this->options['where'])) {
			$condition = $this->options['where'];
		}
		$options['where'] = $condition;
		if(is_array($field)) {
			foreach($field as $key => $val) {
				$data[$val] = $value[$key];
			}
		}
		else {
			$data[$field] = $value;
		}
		return $this->update($data, $options);
	}

	/* get field value. $spea: field data delimiter */
	public function get_field($field, $condition = '', $sepa = ' ') {
		if(empty($condition) && isset($this->options['where'])) {
			$condition = $this->options['where'];
		}
		$options['where'] = $condition;
		$options['field'] = $field;
		$options = $this->parse_options($options);
		if(strpos($field, ',')) {
 			/* multi field */
			$resultSet = $this->db->select($options);
			if(!empty($resultSet)) {
				$_field = explode(',', $field);
				$field = array_keys($resultSet[0]);
				if($_field[0] == $_field[1]) {
					$field = array_merge(array($field[0]), $field);
				}
				$key = array_shift($field);
				$cols = array();
				foreach($resultSet as $result) {
					$name = $result[$key];
					$cols[$name] = '';
					foreach($field as $val) {
						$cols[$name] .= $result[$val] . $sepa;
					}
					$cols[$name] = substr($cols[$name], 0, -strlen($sepa));
				}
				return $cols;
			}
		}
		else {
			$options['limit'] = 1;
			$result = $this->db->select($options);
			if(!empty($result)) {
				return reset($result[0]);
			}
		}
		return '';
	}

	/* get latest insert ID */
	public function get_lastInsID() {
		return $this->db->lastInsID;
	}

	/* get latest SQL */
	public function get_lastSql() {
		return $this->db->get_lastSql();
	}
    
	public function dbdg()
	{
	    $sql = $this->get_lastSql();
	    echo $sql;
	}
	/* insert data */
	public function insert($data = '', $options = array(), $replace = false) {
		if(empty($data)) {
			if(!empty($this->data)) {
				$data = $this->data;
				$this->data = array(); // reset data
			}
			else {
				$this->error = L('_DATA_TYPE_INVALID_');
				return false;
			}
		}
		
		$data = $this->deal_mq($data); // deal with magic quote
		
		
		
		
		$data = $this->facade($data); // deal with data
		
		
		
		
		$options = $this->parse_options($options); // parse database operation parameters
		
		
		
		$result = $this->db->insert($data, $options, $replace); // write data to database
		//$sql = $this->db->get_lastSql();
		//print_r($sql); exit;
		if(false !== $result) {
			$insertId = $this->get_lastInsID();
			if($insertId) {
				$data[$this->get_pk()] = $insertId; // return insert ID to increment primary key
				return $insertId;
			}
		}
		return $result;
	}

	/* update data */
	public function update($data = '', $options = array()) {
		if(empty($data)) {
			if(!empty($this->data)) {
				$data = $this->data;
				$this->data = array(); // reset data
			}
			else {
				$this->error = L('_DATA_TYPE_INVALID_');
				return false;
			}
		}
		$data = $this->deal_mq($data); // deal with magic quote
		$data = $this->facade($data); // deal with data
		$options = $this->parse_options($options); // parse database operation parameters
		if(!isset($options['where'])) {
			/* if the primary key data exists, set it as automatically updated conditions */
			if(isset($data[$this->get_pk()])) {
				$pk = $this->get_pk();
				$where[$pk] = $data[$pk];
				$options['where'] = $where;
				$pkValue = $data[$pk];
				unset($data[$pk]);
			}
			else {
				$this->error = L('_OPERATION_WRONG_');
 				/* do not execute if no update condition. */
				return false;
			}
		}
		$result = $this->db->update($data, $options);
		if(false !== $result) {
			if(isset($pkValue)) {
				$data[$pk] = $pkValue;
			}
		}
		return $result;
	}

	/* delete data */
	public function delete($options = array()) {
		if(empty($options) && empty($this->options)) {
			/* if condition is empty, delete current data object row */
			if(!empty($this->data) && isset($this->data[$this->get_pk()])) {
				return $this->delete($this->data[$this->getPk()]);
			}
			return false;
		}
		if(is_numeric($options) || is_string($options)) {
			/* delete according primary key */
			$pk = $this->get_pk();
			if(strpos($options, ',')) {
				$where[$pk] = array('IN', $options);
			}
			else {
				$where[$pk] = $options;
				$pkValue = $options;
			}
			$options = array();
			$options['where'] = $where;
		}
		$options = $this->parse_options($options); // parse database operation parameters
		$result = $this->db->delete($options);
		if(false !== $result) {
			$data = array();
			if(isset($pkValue)) {
				$data[$pk] = $pkValue;
			}
		}
		return $result; // return number of rows that have been deleted
	}

	/* select data */
	public function select($options = array()) {
		if(is_string($options) || is_numeric($options)) {
			/* select according primary key */
			$pk = $this->get_pk();
			if(strpos($options, ',')) {
				$where[$pk] = array('IN', $options);
			}
			else {
				$where[$pk] = $options;
			}
			$options = array();
			$options['where'] = $where;
		}
		$options = $this->parse_options($options); // parse database operation parameters
		$resultSet = $this->db->select($options);
		if(false === $resultSet) {
			return false;
		}
		if(empty($resultSet)) {
			return ''; // query result empty
		}
		return $resultSet;
	}

	/* SQL query */
	public function query($sql, $parse = false) {
		if(!empty($sql)) {
			if($parse) {
				$sql = preg_replace("/__([0-9A-Z_-]+)__/esU", "C('DB.PREFIX').strtolower('$1').C('DB.SUFFIX')", $sql);
			}
			return $this->db->query($sql);
		}
		return false;
	}

	/* execute SQL */
	public function execute($sql, $parse = false) {
		if(!empty($sql)) {
			if($parse) {
				$sql = preg_replace("/__([0-9A-Z_-]+)__/esU", "C('DB.PREFIX').strtolower('$1').C('DB.SUFFIX')", $sql);
			}
			return $this->db->execute($sql);
		}
		return false;
	}

	/* start transaction */
	public function start_trans() {
		$this->commit();
		$this->db->startTrans();
		return;
	}

	/* commit transaction */
	public function commit() {
		return $this->db->commit();
	}

	/* transaction rollback */
	public function rollback() {
		return $this->db->rollback();
	}

	/* parse database operation parameters */
	protected function parse_options($options = array()) {
		if(is_array($options)) {
			$options = array_merge($this->options, $options);
		}
		$this->options = array();
 		/* clear sql expression option after query */
		if(!isset($options['table'])) {
			$options['table'] = $this->get_tableName(); // auto get table name
		}
		if(!empty($options['alias'])) {
			$options['table'] .= ' ' . $options['alias'];
		}
		/* verify field type */
		if(C('DB.FIELDTYPE_CHECK')) {
			if(isset($options['where']) && is_array($options['where'])) {
				/* check field type of array query condition */
				foreach($options['where'] as $key => $val) {
					if(in_array($key, $this->fields, true) && is_scalar($val)) {
						$this->parse_type($options['where'], $key);
					}
				}
			}
		}
		return $options;
	}

	/* deal with data saved to database */
	protected function facade($data) {
		if(!empty($this->fields)) {
			foreach($data as $key => $val) {
				if(!in_array($key, $this->fields, true)) {
 					/* remove non-data field */
					unset($data[$key]);
				}
				elseif(C('DB.FIELDTYPE_CHECK') && is_scalar($val)) {
					$this->parse_type($data, $key); // data type verify and conversion
				}
			}
		}
		return $data;
	}

	/* data type verify and conversion */
	protected function parse_type(&$data, $key) {
		$fieldType = strtolower($this->fields['_type'][$key]);
		if(false === strpos($fieldType, 'bigint') && false !== strpos($fieldType, 'int')) {
			$data[$key] = intval($data[$key]);
		}
		elseif(false !== strpos($fieldType, 'float') || false !== strpos($fieldType, 'double')) {
			$data[$key] = floatval($data[$key]);
		}
		elseif(false !== strpos($fieldType, 'bool')) {
			$data[$key] = (bool)$data[$key];
		}
	}

	/* verify data */
	protected function verify_data($data, $type) {
		$this->error = array();
		if(!empty($this->_validate)) {
			foreach($this->_validate as $val) {
				/* array(field, rule, message, type) */
				$val[2] = isset($val[2]) ? $val[2] : L('_DATA_TYPE_INVALID_');
				$val[3] = isset($val[3]) ? $val[3] : 'regex';
				if(isset($data[$val[0]])) {
					if(false === $this->check($data[$val[0]], $val[1], $val[3])) {
						$this->error = $val[2];
						return false;
					}
				}
			}
		}
		return true;
	}

	/* verify data use func. support in, between, equal, regex  */
	public function check($value, $rule, $type = 'regex') {
		switch(strtolower($type)) {
			case 'in':
 				/* verify whether value is in a range. use array or string delimited by ','. */
				$range = is_array($rule) ? $rule : explode(',', $rule);
				return in_array($value, $range);
			case 'between':
 				/* verify whether value is between a range */
				list($min, $max) = explode(',', $rule);
				return $value >= $min && $value <= $max;
			case 'equal':
 				/* verify whether equal some value */
				return $value == $rule;
			case 'regex':
			default:
				return $this->regex($value, $rule);
 				/* use regular validation data */
		}
	}

	/* use regular validation data */
	public function regex($value, $rule) {
		$validate = array(
			'require' => '/.+/',
			'email' => '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
			'url' => '/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',
			'currency' => '/^\d+(\.\d+)?$/',
			'number' => '/^\d+$/',
			'zip' => '/^[1-9]\d{5}$/',
			'integer' => '/^[-\+]?\d+$/',
			'double' => '/^[-\+]?\d+(\.\d+)?$/',
			'english' => '/^[A-Za-z]+$/',
			);
		/* check whether there is a built-in regular expression */
		if(isset($validate[strtolower($rule)])) {
			$rule = $validate[strtolower($rule)];
		}
		return preg_match($rule, $value) === 1;
	}

	/* set data object value */
	public function __set($name, $value) {
		$this->data[$name] = $value;
	}

	/* get data object value */
	public function __get($name) {
		return isset($this->data[$name]) ? $this->data[$name] : '';
	}

	/* check data object value */
	public function __isset($name) {
		return isset($this->data[$name]);
	}

	/* unset data object value */
	public function __unset($name) {
		unset($this->data[$name]);
	}

	/* use __call to achieve some special model method */
	public function __call($method, $args) {
		if(in_array(strtolower($method), array(
			'field',
			'table',
			'where',
			'order',
			'limit',
			'page',
			'alias',
			'having',
			'group',
			'lock',
			'distinct'), true)) {
			/* achieve coherent operation */
			$this->options[strtolower($method)] = $args[0];
			return $this;
		}
		elseif(in_array(strtolower($method), array(
			'count',
			'sum',
			'min',
			'max',
			'avg'), true)) {
			/* achieve statistics query */
			$field = isset($args[0]) ? $args[0] : '*';
			return $this->get_field(strtoupper($method) . '(' . $field . ') AS pfa_' . $method);
		}
		elseif(strtolower(substr($method, 0, 5)) == 'getby') {
			/* query according some field */
			$field = parse_name(substr($method, 5));
			$where[$field] = $args[0];
			return $this->where($where)->find();
		}
		else {
			echo (__CLASS__ . ':' . $method . L('_METHOD_NOT_EXIST_'));
			return;
		}
	}

	/* set data value */
	public function data($data) {
		if(is_object($data)) {
			$data = get_object_vars($data);
		}
		elseif(is_string($data)) {
			parse_str($data, $data);
		}
		elseif(!is_array($data)) {
			halt(L('_DATA_TYPE_INVALID_'));
		}
		$this->data = $data;
		return $this;
	}

	/* set query SQL join */
	public function join($join) {
		if(is_array($join)) {
			$this->options['join'] = $join;
		}
		else {
			$this->options['join'][] = $join;
		}
		return $this;
	}
}

?>