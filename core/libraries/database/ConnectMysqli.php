<?php
 /**
  * @Copyright 2008 be-member Inc
  * MYSQLI数据操作类
  *
  * @Author Wusongbo
  * Date: 2016-10-10 
  */
class ConnectMysqli {
	//私有的属性
	private static $dbcon = false;
	private $host;
	private $port;
	private $user;
	private $pass;
	private $db;
	private $charset;
	private $link;
	//私有的构造方法
	private function __construct($config = array()) {
		$this -> host = $config['hostname'] ? $config['hostname'] : 'localhost';
		$this -> port = $config['port'] ? $config['port'] : '3306';
		$this -> user = $config['username'] ? $config['username'] : 'root';
		$this -> pass = $config['password'] ? $config['password'] : '';
		$this -> db = $config['database'] ? $config['database'] : 'jq';
		$this -> charset = isset($arr['char_set']) ? $arr['char_set'] : 'utf8';
		//连接数据库
		$this -> db_connect();
		//选择数据库
		$this -> db_usedb();
		//设置字符集
		$this -> db_charset();
	}

	//连接数据库
	private function db_connect() {
		$this -> link = mysqli_connect($this -> host . ':' . $this -> port, $this -> user, $this -> pass);
		if (!$this -> link) {
			echo "数据库连接失败<br>";
			echo "错误编码" . mysqli_errno($this -> link) . "<br>";
			echo "错误信息" . mysqli_error($this -> link) . "<br>";
			exit ;
		}
	}

	//设置字符集
	private function db_charset() {
		mysqli_query($this -> link, "set names {$this->charset}");
	}

	//选择数据库
	private function db_usedb() {
		mysqli_query($this -> link, "use {$this->db}");
	}

	//私有的克隆
	private function __clone() {
		die('clone is not allowed');
	}

	//公用的静态方法
	public static function getIntance($config = array()) {
		if (self::$dbcon == false) {
			self::$dbcon = new self($config);
		}
		return self::$dbcon;
	}

	//执行sql语句的方法
	public function query($sql) {
		$res = mysqli_query($this -> link, $sql);
		if (!$res) {
			echo "sql语句执行失败<br>";
			echo "错误编码是" . mysqli_errno($this -> link) . "<br>";
			echo "错误信息是" . mysqli_error($this -> link) . "<br>";
		}
		return $res;
	}

	//获得最后一条记录id
	public function getInsertid() {
		return mysqli_insert_id($this -> link);
	}

	/**
	 * 查询某个字段
	 * @param
	 * @return string or int
	 */
	public function getOne($sql) {
		$query = $this -> query($sql);
		return mysqli_free_result($query);
	}

	//获取一行记录,return array 一维数组
	public function getRow($sql, $type = "assoc") {
		$query = $this -> query($sql);
		if (!in_array($type, array("assoc", 'array', "row"))) {
			die("mysqli_query error");
		}
		$funcname = "mysqli_fetch_" . $type;
		return $funcname($query);
	}

	//获取一条记录,前置条件通过资源获取一条记录
	public function getFormSource($query, $type = "assoc") {
		if (!in_array($type, array("assoc", "array", "row"))) {
			die("mysqli_query error");
		}
		$funcname = "mysqli_fetch_" . $type;
		return $funcname($query);
	}

	//获取多条数据，二维数组
	public function getAll($sql) {
		$query = $this -> query($sql);
		$list = array();
		while ($r = $this -> getFormSource($query)) {
			$list[] = $r;
		}
		return $list;
	}

	/**
	 * 定义添加数据的方法
	 * @param string $table 表名
	 * @param string orarray $data [数据]
	 * @return int 最新添加的id
	 */
	public function insert($table, $data) {
		//遍历数组，得到每一个字段和字段的值
		$key_str = '';
		$v_str = '';
		foreach ($data as $key => $v) {
			if (empty($v)) {
				die("error");
			}
			//$key的值是每一个字段s一个字段所对应的值
			$key_str .= $key . ',';
			$v_str .= "'$v',";
		}
		$key_str = trim($key_str, ',');
		$v_str = trim($v_str, ',');
		//判断数据是否为空
		$sql = "insert into $table ($key_str) values ($v_str)";
		$this -> query($sql);
		//返回上一次增加操做产生ID值
		return $this -> getInsertid();
	}

	/*
	 * 删除一条数据方法
	 * @param1 $table, $where=array('id'=>'1') 表名 条件
	 * @return 受影响的行数
	 */
	public function deleteOne($table, $where) {
		if (is_array($where)) {
			foreach ($where as $key => $val) {
				$condition = $key . '=' . $val;
			}
		} else {
			$condition = $where;
		}
		$sql = "delete from $table where $condition";
		$this -> query($sql);
		//返回受影响的行数
		return mysqli_affected_rows($this -> link);
	}

	/*
	 * 删除多条数据方法
	 * @param1 $table, $where 表名 条件
	 * @return 受影响的行数
	 */
	public function deleteAll($table, $where) {
		if (is_array($where)) {
			foreach ($where as $key => $val) {
				if (is_array($val)) {
					$condition = $key . ' in (' . implode(',', $val) . ')';
				} else {
					$condition = $key . '=' . $val;
				}
			}
		} else {
			$condition = $where;
		}
		$sql = "delete from $table where $condition";
		$this -> query($sql);
		//返回受影响的行数
		return mysqli_affected_rows($this -> link);
	}

	/**
	 * [修改操作description]
	 * @param [type] $table [表名]
	 * @param [type] $data [数据]
	 * @param [type] $where [条件]
	 * @return [type]
	 */
	public function update($table, $data, $where) {
		//遍历数组，得到每一个字段和字段的值
		$str = '';
		foreach ($data as $key => $v) {
			$str .= "$key='$v',";
		}
		$str = rtrim($str, ',');
		//修改SQL语句
		$sql = "update $table set $str where $where";
		$this -> query($sql);
		//返回受影响的行数
		return mysqli_affected_rows($this -> link);
	}
	function fetch_array($query, $result_type = MYSQLI_ASSOC) {
		return mysqli_fetch_array($query, $result_type);
	}

	function affected_rows() {
		return mysqli_affected_rows($this->link);
	}

	function error() {
		return (($this->link) ? mysqli_error($this->link) : mysqli_error());
	}

	function errno() {
		return intval(($this->link) ? mysqli_errno($this->link) : mysqli_errno());
	}

	function result($query, $row) {
		if(empty($query) || !isset($query) || $query==''){
			return '';
		}
		mysqli_data_seek($query, $row);
        $row = mysqli_fetch_array($query);
		return $row[0];
	}

	function num_rows($query) {
		$query = mysqli_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysqli_num_fields($query);
	}

	function free_result($query) {
		return mysqli_free_result($query);
	}

	function insert_id() {
		return ($id = mysqli_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysqli_fetch_row($query);
		return $query;
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
		return mysqli_close($this->link);
	}
	function halt($message = '', $sql = '') {
	}
}
?>