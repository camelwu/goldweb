<?php
 /**
  * @Copyright 2008 union voole Inc
  * MYSQL数据操作类
  *
  * Creater: nemo  
  * Date: 2008-9-10 
  */
class DB {
	var $querynum = 0;
	var $charset = 'utf8';
	var $link_identifier = null;

	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0) {
		if($pconnect) {
			if(!$this->link_identifier = @mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			if(!$this->link_identifier = @mysql_connect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		}
		$version = $this->version();
		if($version > '4.1') {
			if(!empty($this->charset)) {
				mysql_query('SET character_set_connection='.$this->charset.', character_set_results='.$this->charset.', character_set_client=binary', $this->link_identifier);
			}
			if($version > '5.0.1') {
				mysql_query("SET sql_mode=''", $this->link_identifier);
			}
		}

		if($dbname) {
			mysql_select_db($dbname, $this->link_identifier);
		}
	}

	function select_db($dbname) {
		return mysql_select_db($dbname, $this->link_identifier);
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function query($sql, $type = '') {
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->link_identifier)) && $type != 'SILENT') {
			$this->halt('MySQL Query Error', $sql);
		}
		$this->querynum++;
		return $query;
	}

	function affected_rows() {
		return mysql_affected_rows($this->link_identifier);
	}

	function error() {
		return (($this->link_identifier) ? mysql_error($this->link_identifier) : mysql_error());
	}

	function errno() {
		return intval(($this->link_identifier) ? mysql_errno($this->link_identifier) : mysql_errno());
	}

	function result($query, $row) {
		if(empty($query) || !isset($query) || $query==''){
			return '';
		}
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return ($id = mysql_insert_id($this->link_identifier)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function version() {
		return mysql_get_server_info($this->link_identifier);
	}
	/*********************************************
	函数功能：查询一条信息
	参    数: sql>>sql语句
	**********************************************/
	function getOneInfo($sql){
		return $this->fetch_array($this->query($sql));
	}
	/*********************************************
	函数功能：查询信息
	参    数: tablename>>表名
			  selectsqlarr>>需要查询的字段信息数组
			  wheresqlarr>>条件数组
			  plussql>>排序方式或检索条数等其它sql
	**********************************************/
	public function selecttable($tablename, $selectsqlarr, $wheresqlarr, $plussql='') {
		$selectsql = $comma = '';
		if(count($selectsqlarr)) {
			foreach ($selectsqlarr as $select_key => $select_value) {
				$selectsql .= $comma.$select_value;
				$comma = ', ';
			}
		} else {
			$selectsql = '*';
		}

		$results = array();
		$query = $this->query('SELECT '.$selectsql.' FROM '.trim($tablename).' WHERE '.getwheresql($wheresqlarr).' '.$plussql);
		while ($r_array = $this->fetch_array($query)) {
			$results[] = $r_array;
		}
		return $results;
	}

	/*****************************************
	函数功能：把信息插入数据表
	参    数: tablename>>表名
			  insertsqlarr>>要插入的信息数组
			  此数组的键名对应数据表里的相应
			  字段
			  returnid>>是否返回插入后的主键id
	******************************************/
	public function inserttable($tablename, $insertsqlarr, $returnid=0) {
		$insertkeysql = $insertvaluesql = $comma = '';
		foreach ($insertsqlarr as $insert_key => $insert_value) {
			$insertkeysql .= $comma.$insert_key;
			$insertvaluesql .= $comma.'\''.$insert_value.'\'';
			$comma = ', ';
		}
		$this->query('INSERT INTO '.trim($tablename).' ('.$insertkeysql.') VALUES ('.$insertvaluesql.') ');
		if($returnid) {
			$id = $this->insert_id();
			return $id;
		}
	}

	/*************************************
	函数功能：删除信息
	参    数：tablename>>表名
			  wheresqlarr>>删除条件数组
	*************************************/
	public function deletetable($tablename, $wheresqlarr) {
		
		if(empty($wheresqlarr)) {
			$this->query('TRUNCATE TABLE '.trim($tablename));
		} else {
			$this->query('DELETE FROM '.trim($tablename).' WHERE '.getwheresql($wheresqlarr));
		}
	}

	/************************************
	函数功能：更新数据记录
	参    数：tablename>>表名
			  setsqlarr>>要更新的字段数组
			  数组的键值应跟要更新的数据
			  字段名相对应
			  wheresqlarr>>条件数组,键名
			  应跟数据表字段名相对应。
	*************************************/
	public function updatetable($tablename, $setsqlarr, $wheresqlarr) {

		$setsql = $comma = '';
		foreach ($setsqlarr as $set_key => $set_value) {
			$setsql .= $comma.$set_key.'=\''.$set_value.'\'';
			$comma = ', ';
		}
		$this->query('UPDATE '.trim($tablename).' SET '.$setsql.' WHERE '.$this->getwheresql($wheresqlarr));
	}

	/*************************************
	函数功能：插入或更新数据记录
	参    数: tablename>>表名
			  insertsqlarr>>要插入或更新的
			  信息数组此数组的键名对应数据
			  表里的相应字段
	**************************************/
	public function replacetable($tablename, $insertsqlarr) {

		$insertkeysql = $insertvaluesql = $comma = '';
		foreach ($insertsqlarr as $insert_key => $insert_value) {
			$insertkeysql .= $comma.$insert_key;
			$insertvaluesql .= $comma.'\''.$insert_value.'\'';
			$comma = ', ';
		}
		$this->query('REPLACE INTO '.trim($tablename).' ('.$insertkeysql.') VALUES ('.$insertvaluesql.') ');
	}
	/************************************
	函数功能：把条件数组转变为相应sql语句
	参    数：wheresqlarr>>条件数组
	*************************************/
	private function getwheresql($wheresqlarr) {
		$result = $comma = '';
		if(empty($wheresqlarr)) {
			$result = '1';
		} elseif(is_array($wheresqlarr)) {
			foreach ($wheresqlarr as $key => $value) {
				$result .= $comma.$key.'=\''.$value.'\'';
				$comma = ' AND ';
			}
		} else {
			$result = $wheresqlarr;
		}
		return $result;
	}

	function close() {
		return mysql_close($this->link_identifier);
	}

	function halt($message = '', $sql = '') {
	}
}
?>