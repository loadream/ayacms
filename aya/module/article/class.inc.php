<?php
defined('IN_AYA') or exit('Access Denied');
class article{
	var $db;
	var $channel;
	var $channelid;
	var $table;
	var $posts;
	var $fds;
	var $htmlid;
	var $msg;
	function article(){
		global $db;
		$this->db=&$db;
	}
	function check(&$p){
		strlens($p['title'],2,100) or amsg(l('标题字数为%s~%s个字',2,100),'w','$("#title").focus();');
		strlens($p['subtitle'],0,100) or amsg(l('副标题字数为%s~%s个字',0,100),'w','$("#subtitle").focus();');
		strlens($p['note'],0,255) or amsg(l('备注字数为%s~%s个字',0,255),'w','$("#note").focus();');
		strlens($p['keyword'],0,100) or amsg(l('关键字字数为%s~%s个字',0,100),'w','$("#keyword").focus();');
		strlens($p['tag'],0,100) or amsg(l('Tag字数为%s~%s个字',0,100),'w','$("#tag").focus();');
		
		if(strlen($p['sign'])>0){
			str_is_int($p['sign'])&&amsg(l('标记不能全为数字'),'w','$("#sign").focus();');
			strlens($p['sign'],0,100) or amsg(l('标记字数为%s~%s个字',0,100),'w','$("#sign").focus();');
		}
	}
	function fields_check(&$p){
		$fd=cache_read('field-'.$this->table.'.php');
		fields_check($p,$fd);
		return true;
	}
	function add($p){
		global $USER;
		$p['thumb']=move_upload($p['thumb']);
		$p['author']=$USER['name'];
		$sql=sql_insert($p);
		
		$itemid=0;
		if($this->db->query("insert into ".PF.$this->table.' '.$sql)){
			$itemid=$this->db->insert_id();
			$this->db->query("update ".PF."member set aya_a=aya_a+".ADD_A.",aya_b=aya_b+".ADD_B.",aya_c=aya_c+".ADD_C." where itemid=".$USER['itemid']);
			
			tag_add($this->channelid,$p,$itemid);
			search_add($this->channelid,$p,$itemid);
		}
		return $itemid;
	}
	function edit(&$p,$item){
		
		// 缩略图处理;
		if($item['thumb']!=$p['thumb']){
			upload_del($item['thumb']);
			$p['thumb']=move_upload($p['thumb']);
		}
		
		$sql=sql_update($p);
		
		if($this->db->query("UPDATE ".PF.$this->table." SET ".$sql." WHERE itemid='".$item['itemid']."'")){
			tag_edit($this->channelid,$p,$item['itemid']);
			search_edit($this->channelid,$p,$item['itemid']);
		}
		
		return true;
	}
	function del($itemid){
		$item=$this->get_one('itemid',$itemid);
		$fd=cache_read('field-'.$this->table.'.php');
		
		upload_del($item['thumb']);
		
		fields_data_del($fd,$item);
		$this->db->query("delete from ".PF.$this->table." where itemid='".$itemid."'");
		tag_del($this->channelid,$itemid);
		search_del($this->channelid,$itemid);
		$this->comment_del($itemid);
		return true;
	}
	function move($itemid,$to_channelid){
		if(!$item=$this->get_one('itemid',$itemid))
			return false;
		$fd=cache_read('field-'.$this->table.'.php');
		$p=$item;
		if(is_array($fd)){
		foreach($fd as $k=>$v){
			unset($p[$k]);
		}
		}
		unset($p['itemid']);
		
		fields_data_del($fd,$item);
		$this->db->query("delete from ".PF.$this->table." where itemid='".$itemid."'");
		tag_del($this->channelid,$itemid);
		search_del($this->channelid,$itemid);
		
		// add
		$sql=sql_insert($p);
		if($this->db->query("insert into ".PF.'article_'.$to_channelid.' '.$sql)){
			$insert_id=$this->db->insert_id();
			tag_add($to_channelid,$p,$insert_id);
			search_add($to_channelid,$p,$insert_id);
		}
		
		return true;
	}
	function comment_del($itemid){
		$this->db->query("delete from ".PF."comment where itemid_by='".$itemid."'");
		return true;
	}
	function comment_edit(&$p,$item){
		$sql=sql_update($p);
		
		$this->db->query("UPDATE ".PF."comment SET ".$sql." WHERE itemid='".$item['itemid']."'");
		
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
		$where=$field.'="'.addslashes($val).'"';
		return $this->db->get_one("SELECT * FROM ".PF.$this->table."  WHERE ".$where);
	}
}
?>