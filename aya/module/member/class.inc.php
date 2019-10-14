<?php
defined('IN_AYA') or exit('Access Denied');
class member{
	var $db;
	var $channel;
	var $channelid;
	var $table;
	var $posts;
	var $fds;
	var $htmlid;
	var $msg;
	function member(){
		global $db;
		$this->db=&$db;
	}
	function check(&$p){
		if(!$this->is_username($p['name']))
			amsg($this->msg,'w','$("#'.$this->htmlid.'").focus();');
		
		if($this->get_one('name',$p['name']))
			amsg(l('用户名已存在'),'w','$("#name").focus();');
		
		if(!$this->is_email($p['email']))
			amsg($this->msg,'w','$("#'.$this->htmlid.'").focus();');
		if($this->get_one('email',$p['email']))
			amsg(l('EMAIL已存在'),'w','$("#email").focus();');
		
		if(!$this->is_password($p['password']))
			amsg($this->msg,'w','$("#'.$this->htmlid.'").focus();');
		if($p['password']!=$p['password2'])
			amsg(l('两次密码不相同'),'w','$("#password2").focus();');
	}
	function fields_check(&$p){
		$fd=cache_read('field-'.$this->table.'.php');
		fields_check($p,$fd);
		return true;
	}
	function edit_check(&$p,$item){
		if(!$this->is_email($p['email']))
			amsg($this->msg,'$("#'.$this->htmlid.'").focus();','w');
		if($r=$this->get_one('email',$p['email'])){
			if($r['itemid']!=$item['itemid'])
				amsg(l('EMAIL已存在'),'w','$("#email").focus();');
		}
		
		if(strlen($p['password'])>0){
			if(!$this->is_password($p['password']))
				amsg($this->msg,'w','$("#'.$this->htmlid.'").focus();');
			if($p['password']!=$p['password2'])
				amsg(l('两次密码不相同'),'w','$("#password2").focus();');
		}
	}
	function add($p){
		$p['password']=md5(md5($p['password']));
		unset($p['password2']);
		$sql=sql_insert($p);
		$this->db->query("insert into ".PF.$this->table.' '.$sql);
		return true;
	}
	function edit(&$p,$item){
		if(strlen($p['password'])>0)
			$p['password']=md5(md5($p['password']));
		else
			unset($p['password']);
		unset($p['password2']);
		
		$sql=sql_update($p);
		$this->db->query("UPDATE ".PF.$this->table." SET $sql WHERE itemid=$item[itemid]");
		
		return true;
	}
	function del($itemid){
		$item=$this->get_one('itemid',$itemid);
		$fd=cache_read('field-'.$this->table.'.php');
	
		fields_data_del($fd,$item);
		$this->db->query("delete from ".PF.$this->table." where itemid='".$itemid."'");
	    $this->comment_del($item['name']);
		return true;
	}
	function comment_del($name){
		$this->db->query("delete from ".PF."comment where author='".addslashes($name)."'");
		return true;
	}
	
	function login($user){
		$cookietime=TIME+86400*7;
		$auth=encrypt($user['itemid']."\t".$user['name']."\t".$user['password']);
		set_cookie('auth',$auth,$cookietime);
		return true;
	}
	function is_username($username){
		global $CFG;
		if(str_is_int($username))
			return $this->_msg(l('用户名不能为全数字'),'name');
		
		if(!strlens($username,3,20))
			return $this->_msg(l('用户名%s~%s位',3,20),'name');
		
		$k_regword=array_map('strtolower',explode(',',$CFG['kregword']));
		$k_name=strtolower($username);
		if($k_name!=str_replace($k_regword,'',$k_name))
			return $this->_msg(l('包含非法字符'),'username');
		return true;
	}
	function is_email($email){
		if(strlen($email)<1)
			return $this->_msg(l('请输入EMAIL'),'email');
		if(!preg_match("/^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,3}$/",$email))
			return $this->_msg(l('EMAIL格式不正确'),'email');
		return true;
	}
	function is_password($password){
		if(strlen($password)<1)
			return $this->_msg(l('请输入密码'),'password');
		if(strlen($password)<6)
			return $this->_msg(l('密码最少%s位',6),'password');
		return true;
	}
	function is_date($date){
		if(!preg_match("/^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/",$date))
			return $this->_msg(l('包含非法字符'),'email');
		return true;
	}
	function get_one($field,$val){
		$where=$field.'="'.addslashes($val).'"';
		return $this->db->get_one("SELECT * FROM ".PF.$this->table."  WHERE ".$where);
	}
	function _msg($msg,$htmlid){
		$this->msg=$msg;
		$this->htmlid=$htmlid;
		return false;
	}
}
?>