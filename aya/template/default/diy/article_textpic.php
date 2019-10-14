<?php
if($CHANNELS[$channelid]['module']!='article')
	return '{diy "article_textpic"}$channelid不存在';

extract($CHANNELS[$channelid],EXTR_PREFIX_ALL,'c');
if(!in_array($number,array (
		1,
		2,
		3,
		4,
		6,
		12 
)))
	return '{diy "article_textpic"}$number参数有误';
	
$blank=!empty($blank)?' target="_blank"':'';
$page=(int)$page;
$page=$page<2?1:$page;

$domid=random();

$wheres=array ();
$wheres[]="thumb!=''";
$where=empty($wheres)?'1':implode(' && ',$wheres);

if(in_array($order,array (
		'hits',
		'level',
		'posttime' 
))){
	$order=$order.' desc';
}else
	$order='original desc,posttime desc';

$c=$CHANNELS[$channelid];
$items=array ();
$rs=$db->query("SELECT * FROM ".PF."article_".$channelid." WHERE {$where} order by {$order} LIMIT 0,".$number*$page);

while($r=$db->fetch_array($rs)){
	$itemid=$r['itemid'];
	$r['new']=is_new($r['posttime']);
	$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.get_4x4($r['thumb']):'';
	$r['url']=url(AYA_URL.$c_path,'show.php',$r['sign']?('sign='.$r['sign']):('itemid='.$itemid));
	$r['posttime']=date('y-m',$r['posttime']);
	$items[$itemid]=$r;
}
$db->free_result($rs);
?>

<div id="<?php echo $domid?>" class="diybox slide" data-ride="carousel">
	<div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>">
		<span><?php echo $box_title?$box_title:$c_name?></span>
	</div>

	<div class="diybox_body">
		<div class="carl-inner diybox_main" style="<?php echo $box_style?>">
            <?php
												
												for($i=0;$i<$page;$i++){
													?>
              <div class="item<?php if($i<1) echo ' active'?>">

				<div class="row">
            <?php for($m=0;$m<$number;$m++){?>
<div class="col-md-<?php echo 12/$number?>">
<?php if (list($id, $item) = @each($items)) {?>

<?php if($item['thumb']){?>
<img style="float: left; margin-right: 20px; width: 33%;"
							src="<?php echo $item['thumb']?>" />
<?php }?>
<h5><a <?php echo $blank?> href="<?php echo $item['url']?>"><?php echo html($item['title'])?></a></h5>
						<p><?php echo html($item['note'])?></p>
						<div class="clearfix"></div>
<?php }?></div>
<?php }?>
</div>


			</div>
            <?php }?>  
              
            </div>
	</div>
  <?php if($page>1) {?>          
    <ol class="carousel-indicators carl-indicators">
            <?php
			for($i=0;$i<$page;$i++){
				?>
              <li data-target="#<?php
				
				echo $domid?>"
			data-slide-to="<?php echo $i?>"
			class="<?php if($i<1) echo 'active'?>"></li>
              <?php }?>
            </ol>
	<a class="left carl-control bg-primary"
		href="#<?php
			
			echo $domid?>" data-slide="prev"> <span class="icon-chevron-left"></span>
	</a> <a class="right carl-control bg-primary"
		href="#<?php
			
			echo $domid?>" data-slide="next"> <span class="icon-chevron-right"></span>
	</a>
	<?php }?>
</div>
