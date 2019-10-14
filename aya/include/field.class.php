<?php
class field{
	var $db;
	var $table;
	var $name;
	var $newname;
	var $p;
	var $msg;
	function __construct(){
		global $db;
		$this->db=$db;
	}
	function add(){
		extract($this->p);
		
		if(field_exists($this->table,$name)){
			$this->msg=l('字段名已使用');
			return false;
		}
		
		if(!$sql=get_field_sql($this->table,$name,$html)){
			$this->msg=l('未生成sql语句');
			return false;
		}
		
		if(!$this->db->query($sql)){
			$this->msg=('未执行sql语句');
			return false;
		}
		
		$this->p['tb']=$this->table;
		
		$sql=sql_insert($this->p);
		$this->db->query("insert into ".PF."field $sql");
		
		return true;
	}
	function edit(){
		extract($this->p);
		
		if($this->newname!=$this->name&&field_exists($this->table,$this->newname)){
			$this->msg=l('字段名已使用');
			return false;
		}
		
		if(!$sql=get_field_sql($this->table,$this->name,$html,$this->newname)){
			$this->msg=l('未生成sql语句');
			return false;
		}
		if(!$this->db->query($sql)){
			$this->msg=l('未执行sql语句');
			return false;
		}
		
		$sql=sql_update($this->p);
		$this->db->query("update ".PF."field set $sql where tb='$this->table' && name='$this->name'");
		
		return true;
	}
	function del(){
		if(!$sql=get_field_sql($this->table,$this->name)){
			$this->msg=l('未生成sql语句');
			return false;
		}
		if(!$this->db->query($sql)){
			$this->msg=l('未执行sql语句');
			return false;
		}
		$this->db->query("delete from ".PF."field where tb='$this->table' && name='$this->name'");
		
		return true;
	}
}  