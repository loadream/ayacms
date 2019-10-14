<?php
include 'common.inc.php';

if(!IN_POST){
	// 验证
	echo $_GET["echostr"];
	exit();
}

$access_token=get_access_token();
$o=get_msg();

$msgtype=strtolower($o->MsgType); // 消息类型，event
$event=strtolower($o->Event); // 事件类型，CLICK
$eventkey=$o->EventKey; // 事件KEY值，与自定义菜单接口中KEY值对应
$fromusername=$o->FromUserName; // 发送方
$tousername=$o->ToUserName; // 开发者微信号

if($event=='click'){
	
	$arr=explode('_',$eventkey);
	$x=$arr[0];
	$y=$arr[1];
	$menu=$cfg['menu'][$x][$y];
	
	if($menu['type']=='pic_id'){
		
		$id=(int)$menu['pic_id'];
		$item=$db->get_one("SELECT * FROM {$db->pre}pic WHERE itemid='".$id."'");
		
		$titles=explode('|',$item['titles']);
		$contents=explode('|',$item['contents']);
		$openlinks=explode('|',$item['openlinks']);
		$urls=explode('|',$item['urls']);
		
		$tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml> ";
		echo sprintf($tpl,$fromusername,$tousername,TIME,'1',$titles[0],$contents[0],AYA_URL.'aya/upload/'.$urls[0],$openlinks[0]);
	}elseif($menu['type']=='article_cid'){
		
		$id=$menu['article_cid'];
		if($CHANNELS[$id]['module']!='article')
			exit();
		
		$wheres=array (
				"thumb!=''" 
		);
		$where=empty($wheres)?'1':implode(' && ',$wheres);
		$order='original desc,posttime desc';
		
		$items=array ();
		$rs=$db->query("SELECT * FROM ".PF."article_".$id." WHERE {$where} order by {$order} LIMIT 0,4");
		
		while($r=$db->fetch_array($rs)){
			$itemid=$r['itemid'];
			$r['new']=is_new($r['posttime']);
			$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.$r['thumb']:'';
			$r['url']=url(AYA_URL.$CHANNELS[$id]['c_path'],'show.php',$r['sign']?('sign='.$r['sign']):('itemid='.$itemid));
			$r['posttime']=date('y-m',$r['posttime']);
			$items[$itemid]=$r;
		}
		$db->free_result($rs);
		
		$tpl='<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>';
		
		$xml='';
		foreach($items as $item){
			$xml.=sprintf($tpl,$item['title'],$item['note'],$item['thumb'],$item['url']);
		}
		
		$tpl='<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>
</xml>';
		
		echo sprintf($tpl,$fromusername,$tousername,TIME,count($items),$xml);
	}elseif($menu['type']=='product_cid'){
		
		$id=$menu['product_cid'];
		if($CHANNELS[$id]['module']!='product')
			exit();
		
		$wheres=array (
				"thumb!=''" 
		);
		$where=empty($wheres)?'1':implode(' && ',$wheres);
		$order='original desc,posttime desc';
		
		$items=array ();
		$rs=$db->query("SELECT * FROM ".PF."product_".$id." WHERE {$where} order by {$order} LIMIT 0,4");
		
		while($r=$db->fetch_array($rs)){
			$itemid=$r['itemid'];
			$r['new']=is_new($r['posttime']);
			$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.$r['thumb']:'';
			$r['url']=url(AYA_URL.$CHANNELS[$id]['c_path'],'show.php',$r['sign']?('sign='.$r['sign']):('itemid='.$itemid));
			$r['posttime']=date('y-m',$r['posttime']);
			$items[$itemid]=$r;
		}
		$db->free_result($rs);
		
		$tpl='<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>';
		
		$xml='';
		foreach($items as $item){
			$xml.=sprintf($tpl,$item['title'],$item['note'],$item['thumb'],$item['url']);
		}
		
		$tpl='<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>
</xml>';
		
		echo sprintf($tpl,$fromusername,$tousername,TIME,count($items),$xml);
	}else{
		
		$tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>
</xml>";
		
		echo sprintf($tpl,$fromusername,$tousername,TIME,'2',$menu['name'],$menu['text'].(strlen($menu['link'])?' [查看全文]':''),'',$menu['link']);
	}
}

if($event=='subscribe'){
	$tpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
	
	echo sprintf($tpl,$fromusername,$tousername,TIME,'感谢您的关注!');
	
}

