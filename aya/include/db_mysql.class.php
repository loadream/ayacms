<?php
defined('IN_AYA') or exit('Access Denied');
class db_mysql{
	var $connid;
	var $pre;
	var $querynum=0;
	var $cursor=0;
	var $halt=0;
	var $linked=1;
	function connect($dbhost,$dbuser,$dbpass,$dbname,$dbcharset,$pconnect=0){
		$func=$pconnect==1?'mysql_pconnect':'mysql_connect';
		if(!$this->connid=@$func($dbhost,$dbuser,$dbpass)){
			$this->linked=0;
			$retry=5;
			while($retry-->0){
				if($this->connid=@$func($dbhost,$dbuser,$dbpass)){
					$this->linked=1;
					break;
				}
			}
			if($this->linked==0){
				$this->halt('Can not connect to MySQL server');
			}
		}
		$version=$this->version();
		
		if($version>'4.1'&&$dbcharset)
			mysql_query(IN_ADMIN?"SET NAMES '".$dbcharset."'":"SET character_set_connection=".$dbcharset.", character_set_results=".$dbcharset.", character_set_client=binary",$this->connid);
		if($version>'5.0')
			mysql_query("SET sql_mode=''",$this->connid);
		if($dbname&&!mysql_select_db($dbname,$this->connid))
			$this->halt('Cannot use database '.$dbname);
		return $this->connid;
	}
	function select_db($dbname){
		return mysql_select_db($dbname,$this->connid);
	}
	function query($sql,$type=''){
		$func=$type=='UNBUFFERED'?'mysql_unbuffered_query':'mysql_query';
		if(!($query=$func($sql,$this->connid)))
			$this->halt('MySQL Query Error',$sql);
		$this->querynum++;
		return $query;
	}
	function get_one($sql,$type=''){
		$sql=str_replace(array (
				'select ',
				' limit ' 
		),array (
				'SELECT ',
				' LIMIT ' 
		),$sql);
		if(strpos($sql,'SELECT ')!==false&&strpos($sql,' LIMIT ')===false)
			$sql.=' LIMIT 0,1';
		$query=$this->query($sql,$type);
		$r=$this->fetch_array($query);
		$this->free_result($query);
		return $r;
	}
	function count($table,$condition=''){
		global $DT_TIME;
		$sql='SELECT COUNT(*) as amount FROM '.$table;
		if($condition)
			$sql.=' WHERE '.$condition;
		$r=$this->get_one($sql);
		return $r?$r['amount']:0;
	}
	function fetch_array($query,$result_type=MYSQL_ASSOC){
		return mysql_fetch_array($query,$result_type);
	}
	function data_seek($query,$offset){
		return mysql_data_seek($query,$offset);
	}
	function affected_rows(){
		return mysql_affected_rows($this->connid);
	}
	function num_rows($query){
		return mysql_num_rows($query);
	}
	function num_fields($query){
		return mysql_num_fields($query);
	}
	function result($query,$row){
		return @mysql_result($query,$row);
	}
	function free_result($query){
		if(is_resource($query)&&get_resource_type($query)==='mysql result'){
			return @mysql_free_result($query);
		}
	}
	function insert_id(){
		return mysql_insert_id($this->connid);
	}
	function fetch_row($query){
		return mysql_fetch_row($query);
	}
	function version(){
		return mysql_get_server_info($this->connid);
	}
	function close(){
		return mysql_close($this->connid);
	}
	function error(){
		return @mysql_error($this->connid);
	}
	function errno(){
		return intval($this->error());
	}
	function halt($message='',$sql=''){
		if($this->halt)
			exit('MySQL Query:'.str_replace($this->pre,'[pre]',$sql).' <br/> MySQL Error:'.str_replace($this->pre,'[pre]',$this->error()).' MySQL Errno:'.$this->errno().' <br/>Message:'.$message);
	}
}
?>