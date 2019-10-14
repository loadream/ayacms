<?php
defined('IN_AYA') or exit('Access Denied');
class book{
	var $db;
	var $channel;
	var $channelid;
	var $table;
	var $posts;
	var $fds;
	var $htmlid;
	var $msg;
	function book(){
		global $db;
		$this->db=&$db;
	}
	function check(&$p){
		if(strlen($p['title'])<1)
			amsg(l('请填写标题'),'w','$("#title").focus();');
		if(strlen($p['name'])<1)
			amsg(l('请填写称呼'),'w','$("#name").focus();');
		if(strlen($p['content'])<1)
			amsg(l('请填写内容'),'w','$("#content").focus();');
	}
	function fields_check(&$p){
		$fd=cache_read('field-'.$this->table.'.php');
		fields_check($p,$fd);
		return true;
	}
	function add($p){
		$sql=sql_insert($p);
		$this->db->query("insert into ".PF.$this->table.' '.$sql);
		return true;
	}
	function edit(&$p,$item){
		$sql=sql_update($p);
		$this->db->query("UPDATE ".PF.$this->table." SET ".$sql." WHERE itemid='".$item['itemid']."'");
		return true;
	}
	function del($itemid){
		$item=$this->get_one('itemid',$itemid);
		$fd=cache_read('field-'.$this->table.'.php');
		
		fields_data_del($fd,$item);
		$this->db->query("delete from ".PF.$this->table." where itemid='".$itemid."'");
		
		return true;
	}
	function channel_clean(){
		$rs=$this->db->query("SELECT * FROM ".PF.$this->table);
		while($r=$this->db->fetch_array($rs)){
			$this->del($r['itemid']);
		}
		return true;
	}
	function get_one($field,$val){
		$where='`'.$field.'`="'.addslashes($val).'"';
		return $this->db->get_one("SELECT * FROM ".PF.$this->table."  WHERE ".$where);
	}
}
?>