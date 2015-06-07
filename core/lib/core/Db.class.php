<?php

/**
 *--------------------------------------
 * database base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Db extends Pfa {
	public $debug = false; // debug switch
	public $dbType = ''; // database type
	public $dbCfg = ''; // database config
	public $queryStr = ''; // current SQL command
	public $lastInsID  = null; // the last insert ID
	public $numRows = 0; // number of affect rows
	public $numCols = 0; // number of the return fields
	public $transTimes = 0; // transaction times
	public $linkID = array(); // database link ID, support multi-link
	public $_linkID = null; // current link ID
	public $queryID = null; // current query ID
	public $connected = false; // whether database is connected
	public $comparison = array( // expression comparison
		'eq' => '=',
		'neq' => '<>',
		'gt' => '>',
		'egt' => '>=',
		'lt' => '<',
		'elt' => '<=',
		'notlike' => 'NOT LIKE',
		'like' => 'LIKE'
	);
	protected $selectSql = 'SELECT%DISTINCT% %FIELDS% FROM %TABLE%%JOIN%%WHERE%%GROUP%%HAVING%%ORDER%%LIMIT%'; /* query expression */

	public function __construct() {}

	/* DB factory */
	public function get_db($dbCfg = '') {
		$dbCfg = $this->parse_cfg($dbCfg);
		if(empty($dbCfg['dbtype'])) {
			halt(L('_NO_DB_CFG_'));
		}
		$this->dbType = parse_name($dbCfg['dbtype'], 1);
		$dbClass = 'Db' . $this->dbType;
		import('lib.ext.db.' . $dbClass, PFA_PATH);
		$db = get_instance($dbClass, $dbCfg);
		if(C('DEBUG.SWITCH')) {
			$db->debug = true;
		}
		return $db;
	}

	/* initialize the database connect */
	protected function init_connect($master = true) {
		/* use distributed database */
		if(1 == C('DB.DEPLOY_TYPE')) {
			$this->_linkID = $this->multi_connect($master);
		}
		else {
			if(!$this->connected) {
				$this->_linkID = $this->connect(); // default single database
			}
		}
	}

	/* connect distributed database server $master: master server */
	protected function multi_connect($master = false) {
		static $_config = array();
		if(empty($_config)) {
			/* cache distributed database configuration parsing */
			foreach($this->dbCfg as $key => $val) {
				$_config[$key] = explode(',', $val);
			}
		}
		if(C('DB.RW_SEPARATE')) { // whether master-slave database is separate read and write
			if($master) {
				$r = 0; // default master server
			}
			else {
				$r = floor(mt_rand(1, count($_config['hostname']) - 1)); // random connection read operations database
			}
		}
		else {
			$r = floor(mt_rand(0, count($_config['hostname']) - 1)); // server is not separate read and write
		}
		$dbCfg = array(
			'username' => isset($_config['username'][$r]) ? $_config['username'][$r] : $_config['username'][0],
			'password' => isset($_config['password'][$r]) ? $_config['password'][$r] : $_config['password'][0],
			'hostname' => isset($_config['hostname'][$r]) ? $_config['hostname'][$r] : $_config['hostname'][0],
			'hostport' => isset($_config['hostport'][$r]) ? $_config['hostport'][$r] : $_config['hostport'][0],
			'database' => isset($_config['database'][$r]) ? $_config['database'][$r] : $_config['database'][0],
			'params' => isset($_config['params'][$r]) ? $_config['params'][$r] : $_config['params'][0],
		);
		return $this->connect($dbCfg, $r);
	}

	/* parse database config, support array and DSN */
	protected function parse_cfg($dbCfg = '') {
		if(!empty($dbCfg) && is_string($dbCfg)) {
			$dbCfg = $this->parse_dsn($dbCfg);
		}
		elseif(empty($dbCfg)) {
			$dbCfg = array (
				'dbtype' => C('DB.TYPE'),
				'username' => C('DB.USER'),
				'password' => C('DB.PWD'),
				'hostname' => C('DB.HOST'),
				'hostport' => C('DB.PORT'),
				'database' => C('DB.NAME'),
				'params' => C('DB.PARAMS'),
			);
		}
		return $dbCfg;
	}

	/* parse DSN. mysql://user:pass@host:port/dbName */
	protected function parse_dsn($dsnStr) {
		if(empty($dsnStr)) {
			return false;
		}
		$info = parse_url($dsnStr);
		if($info['scheme']) {
			$dsn = array(
				'dbtype' => $info['scheme'],
				'username' => isset($info['user']) ? $info['user'] : '',
				'password' => isset($info['pass']) ? $info['pass'] : '',
				'hostname' => isset($info['host']) ? $info['host'] : '',
				'hostport' => isset($info['port']) ? $info['port'] : '',
				'database' => isset($info['path']) ? substr($info['path'], 1) : ''
			);
		}
		else {
			preg_match('/^(.*?)\:\/\/(.*?)\:(.*?)\@(.*?)\:([0-9]{1, 6})\/(.*?)$/', trim($dsnStr), $matches);
			$dsn = array(
				'dbtype' => $matches[1],
				'username' => $matches[2],
				'password' => $matches[3],
				'hostname' => $matches[4],
				'hostport' => $matches[5],
				'database' => $matches[6]
			);
		}
		return $dsn;
	}

	/* parse set */
	protected function parse_set($data) {
		foreach($data as $key => $val) {
			$value = $this->parse_value($val);
			if(is_scalar($value)) { // filter non-scalar
				$set[] = $this->parse_key($key) . '=' . $value;
			}
		}
		return ' SET ' . implode(',', $set);
	}

	/* parse value */
	protected function parse_value($value) {
		if(is_string($value)) {
			$value = '\'' . $this->escape_string($value) . '\'';
		}
		elseif(isset($value[0]) && is_string($value[0]) && strtolower($value[0]) == 'exp') {
			$value = $this->escape_string($value[1]);
		}
		elseif(is_array($value)) {
			$value = array_map(array($this, 'parse_value'), $value);
		}
		elseif(is_null($value)) {
			$value = 'null';
		}
		return $value;
	}

	/* parse field. $fields:'f' | 'f1, f2' | array('f1', 'f2') | array('fld1' => 'f') */
	protected function parse_field($fields) {
		if(is_string($fields) && strpos($fields, ',')) {
			$fields = explode(',', $fields);
		}
		if(is_array($fields)) {
			$array = array();
			foreach($fields as $key => $field) {
				if(is_numeric($key)) {
					$array[] = $this->parse_key($field);
				}
				else {
					$array[] = $this->parse_key($key) . ' AS ' . $this->parse_key($field);
				}
			}
			$fieldsStr = implode(',', $array);
		}
		elseif(is_string($fields) && !empty($fields)) {
			$fieldsStr = $this->parse_key($fields);
		}
		else {
			$fieldsStr = '*';
		}
		return $fieldsStr;
	}

	/* parse table, support alias */
	protected function parse_table($tables) {
		if(is_array($tables)) {
			$array = array();
			foreach($tables as $table => $alias) {
				if(is_numeric($table)) {
					$array[] = $this->parse_key($alias);
				}
				else {
					$array[] = $this->parse_key($table) . ' ' . $this->parse_key($alias);
				}
			}
			$tables = $array;
		}
		elseif(is_string($tables)) {
			$tables = explode(',', $tables);
			array_walk($tables, array(&$this, 'parse_key'));
		}
		return implode(',', $tables);
	}

	/* parse distinct */
	protected function parse_distinct($distinct) {
		return !empty($distinct) ? ' DISTINCT ' : '';
	}

	/* parse join */
	protected function parse_join($join) {
		$joinStr = '';
		if(!empty($join)) {
			if(is_array($join)) {
				foreach($join as $key => $_join) {
					if(false !== stripos($_join, 'JOIN')) {
						$joinStr .= ' ' . $_join;
					}
					else {
						$joinStr .= ' LEFT JOIN ' . $_join;
					}
				}
			}
			else {
				$joinStr .= ' LEFT JOIN ' . $join;
			}
		}
		return $joinStr;
	}

	/* parse where */
	protected function parse_where($where) {
		$whereStr = '';
		if(is_string($where)) {
			$whereStr = $where;
		}
		else { /* use array conditional expression */
			if(array_key_exists('_logic', $where)) {
				/* logical rules. such as: OR XOR AND NOT */
				$operate = ' ' . strtoupper($where['_logic']) . ' ';
				unset($where['_logic']);
			}
			else {
				$operate = ' AND '; /* default AND */
			}
			foreach($where as $key => $val) {
				$whereStr .= "(";
				if(!preg_match('/^[A-Z_\-.a-z0-9]+$/', trim($key))) { /* safety filter */
					halt(L('_EXPRESS_ERROR_') . ' : ' . $key);
				}
				$key = trim($key);
				$whereStr .= $this->parse_whereItem($this->parse_key($key), $val);
				$whereStr .= ')' . $operate;
			}
			$whereStr = substr($whereStr, 0, -strlen($operate));
		}
		return empty($whereStr) ? '' : ' WHERE ' . $whereStr;
	}

	/* parse sub where item */
	protected function parse_whereItem($key, $val) {
		$whereStr = '';
		if(is_array($val)) {
			if(is_string($val[0])) {
				if(preg_match('/^(EQ|NEQ|GT|EGT|LT|ELT|NOTLIKE|LIKE)$/i', $val[0])) { // compare
					$whereStr .= $key . ' ' . $this->comparison[strtolower($val[0])] . ' ' . $this->parse_value($val[1]);
				}
				elseif('exp'==strtolower($val[0])) { // use expression
					$whereStr .= ' (' . $key . ' ' . $val[1].') ';
				}
				elseif(preg_match('/INSET/i',$val[0])) { // INSET
					if(strpos($val[1], '|')) {
						$_t_val = explode('|', $val[1]);
						$_t_whereStr = '';
						foreach($_t_val as $_val) {
							$_t_whereStr .= "(FIND_IN_SET(" . $this->parse_value($_val) . ", ". $key .") > 0) OR ";
						}
						$_t_whereStr = substr($_t_whereStr, 0, -4);
						$whereStr .= $_t_whereStr;
					}
					elseif(strpos($val[1], '&')) {
						$_t_val = explode('&', $val[1]);
						$_t_whereStr = '';
						foreach($_t_val as $_val) {
							$_t_whereStr .= "(FIND_IN_SET(" . $this->parse_value($_val) . ", ". $key .") > 0) AND ";
						}
						$_t_whereStr = substr($_t_whereStr, 0, -5);
						$whereStr .= $_t_whereStr;
					}
					else {
						$whereStr .= "FIND_IN_SET(" . $this->parse_value($val[1]) . ", {$key}) > 0";
					}
				}
				elseif(preg_match('/IN/i', $val[0])) { // IN
					if(isset($val[2]) && 'exp' == $val[2]) {
						$whereStr .= $key . ' ' . strtoupper($val[0]) . ' ' . $val[1];
					}
					else {
						if(is_string($val[1])) {
							$val[1] =  explode(',', $val[1]);
						}
						$zone = implode(',', $this->parse_value($val[1]));
						$whereStr .= $key . ' ' . strtoupper($val[0]) . ' (' . $zone . ')';
					}
				}
				elseif(preg_match('/BETWEEN/i',$val[0])) { // BETWEEN
					$data = is_string($val[1]) ? explode(',', $val[1]) : $val[1];
					$whereStr .= ' (' . $key . ' ' . strtoupper($val[0]) . ' ' . $this->parse_value($data[0]) . ' AND ' . $this->parse_value($data[1]) . ' )';
				}
				else {
					halt(L('_EXPRESS_ERROR_') . ':' . $val[0]);
				}
			}
			else {
				$count = count($val);
				if(in_array(strtoupper(trim($val[$count-1])), array('AND', 'OR', 'XOR'))) {
					$rule = strtoupper(trim($val[$count-1]));
					$count = $count - 1;
				}
				else {
					$rule = 'AND';
				}
				for($i = 0; $i < $count; $i++) {
					$data = is_array($val[$i]) ? $val[$i][1] : $val[$i];
					if('exp' == strtolower($val[$i][0])) {
						$whereStr .= '(' . $key . ' ' . $data . ') ' . $rule . ' ';
					}
					else {
						$op = is_array($val[$i]) ? $this->comparison[strtolower($val[$i][0])] : '=';
						$whereStr .= '(' . $key . ' ' . $op . ' ' . $this->parse_value($data) . ') ' . $rule . ' ';
					}
				}
				$whereStr = substr($whereStr, 0, -4);
			}
		}
		else {
			/* string type field using fuzzy matching */
			if(C('DB.LIKE_FIELDS') && preg_match('/('.C('DB.LIKE_FIELDS').')/i', $key)) {
				$val = '%' . $val . '%';
				$whereStr .= $key . ' LIKE ' . $this->parse_value($val);
			}
			else {
				$whereStr .= $key . ' = ' . $this->parse_value($val);
			}
		}
		return $whereStr;
	}

	/* parse group */
	protected function parse_group($group) {
		return !empty($group) ? ' GROUP BY ' . $group : '';
	}

	/* parse having */
	protected function parse_having($having) {
		return !empty($having) ? ' HAVING ' . $having : '';
	}

	/* parse order */
	protected function parse_order($order) {
		if(is_array($order)) {
			$array = array();
			foreach($order as $key => $val) {
				if(is_numeric($key)) {
					$array[] = $this->parse_key($val);
				}
				else {
					$array[] = $this->parse_key($key) . ' ' . $val;
				}
			}
			$order = implode(',', $array);
		}
		return !empty($order) ? ' ORDER BY ' . $order : '';
	}

	/* parse limit */
	protected function parse_limit($limit) {
		return !empty($limit) ? ' LIMIT ' . $limit . ' ' : '';
	}

	/* parse locking */
	protected function parse_lock($lock = false) {
		if(!$lock) {
			return '';
		}
		if('ORACLE' == $this->dbType) {
			return ' FOR UPDATE NOWAIT ';
		}
		return ' FOR UPDATE ';
	}

	/* insert data */
	public function insert($data, $options = array(), $replace = false) {
		$values = $fields = array();
		foreach($data as $key=>$val) {
			$value = $this->parse_value($val);
			if(is_scalar($value)) { // filter non-scalar
				$values[] = $value;
				$fields[] = $this->parse_key($key);
			}
		}
		$sql = ($replace ? 'REPLACE' : 'INSERT') . ' INTO ' . $this->parse_table($options['table']) . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')';
		$sql .= $this->parse_lock(isset($options['lock']) ? $options['lock'] : false);
		return $this->execute($sql);
	}

	/* update data */
	public function update($data, $options) {
		$sql = 'UPDATE '
		.$this->parse_table($options['table'])
		.$this->parse_set($data)
		.$this->parse_where(isset($options['where']) ? $options['where'] : '')
		.$this->parse_order(isset($options['order']) ? $options['order'] : '')
		.$this->parse_limit(isset($options['limit']) ? $options['limit'] : '')
		.$this->parse_lock(isset($options['lock']) ? $options['lock'] : false);
		return $this->execute($sql);
	}

	/* delete data */
	public function delete($options = array()) {
		$sql = 'DELETE FROM '
		.$this->parse_table($options['table'])
		.$this->parse_where(isset($options['where']) ? $options['where'] : '')
		.$this->parse_order(isset($options['order']) ? $options['order'] : '')
		.$this->parse_limit(isset($options['limit']) ? $options['limit'] : '')
		.$this->parse_lock(isset($options['lock']) ? $options['lock'] : false);
		return $this->execute($sql);
	}

	/* query data */
	public function select($options = array()) {
		$sql = $this->build_selectSql($options);
		$result = $this->query($sql);
		return $result;
	}

	/* build query SQL */
	protected function build_selectSql($options = array()) {
		if(isset($options['page'])) {
			/* count limit according page config */
			if(strpos($options['page'], ',')) {
				list($page, $listRows) =  explode(',', $options['page']);
			}
			else {
				$page = $options['page'];
			}
			$page = $page ? $page : 1;
			$listRows = isset($listRows) ? $listRows : (is_numeric($options['limit']) ? $options['limit'] : 20);
			$offset = $listRows * ((int)$page - 1);
			$options['limit'] = $offset . ',' . $listRows;
		}
		$sql = str_replace(
			array(
				'%TABLE%',
				'%DISTINCT%',
				'%FIELDS%',
				'%JOIN%',
				'%WHERE%',
				'%GROUP%',
				'%HAVING%',
				'%ORDER%',
				'%LIMIT%'),
			array(
				$this->parse_table($options['table']),
				$this->parse_distinct(isset($options['distinct']) ? $options['distinct'] : false),
				$this->parse_field(isset($options['field']) ? $options['field'] : '*'),
				$this->parse_join(isset($options['join']) ? $options['join'] : ''),
				$this->parse_where(isset($options['where']) ? $options['where'] : ''),
				$this->parse_group(isset($options['group']) ? $options['group'] : ''),
				$this->parse_having(isset($options['having']) ? $options['having'] : ''),
				$this->parse_order(isset($options['order']) ? $options['order'] : ''),
				$this->parse_limit(isset($options['limit']) ? $options['limit'] : '')),
			$this->selectSql);
		$sql .= $this->parse_lock(isset($options['lock']) ? $options['lock'] : false);
		/* parse __TABLE_NAME__ to table name with prefix and suffix */
		$sql = preg_replace("/__([0-9A-Z_-]+)__/esU", "C('DB.PREFIX').strtolower('$1').C('DB.SUFFIX')", $sql);
		return $sql;
	}

	/* get the last query SQL string */
	public function get_lastSql() {
		return $this->queryStr;
	}

	/* database debug, record current SQL string */
	protected function debug() {
		if($this->debug) {
			G('queryEndTime'); /* record operation end time */
			Log::record($this->queryStr . ' [RunTime:' . G('queryStartTime', 'queryEndTime', 6) . 's]');
		}
	}

	/* parse field and table name(defined by driver class) */
	protected function parse_key(&$key) {}
	/* escape SQL special characters(defined by driver class) */
	protected function escape_string($str) {}
	/* query(defined by driver class) */
	protected function query($sql) {}
	/* execute(defined by driver class) */
	protected function execute($sql) {}
	/* close database(defined by driver class) */
	protected function close() {}

	public function __destruct(){
		$this->close();
	}
}

?>