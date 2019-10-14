<?php
?>
<ul class="breadcrumb breadcrumb-block">
	<li>
		<i class="icon-location-arrow icon-muted"></i>
	</li>
<?php
$fchannelid=0;

foreach($CHANNELS as $k=>$v){
if($v['language']==AYA_LANG) {
$fchannelid=$k;	
break;
}
}

if($channelid!=$fchannelid){
$arr=array (
		array (
				$CHANNELS[$fchannelid]['name'],
				($CHANNELS[$fchannelid]['module']=='anull'?'':AYA_URL). ($LANG[0]==AYA_LANG?'':$CHANNELS[$fchannelid]['path'])
		) 
);

$arr=array_merge($arr,do_apply('pathnav'));
}else 
	$arr=do_apply('pathnav');



$len=count($arr);
foreach($arr as $k=>$v){
	$active=$len==($k+1)?'active':'';
	if(isset($v[1])){
		?><li class="<?php echo $active?>">
		<a href="<?php echo $v[1]?>"><?php echo html($v[0])?></a>
	</li><?php
	}else{
		?>
	<li class="<?php echo $active?>"><?php
		echo html($v[0])?></li><?php
	}
}
?>
</ul>