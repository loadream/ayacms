<?php
if($CHANNELS[$channelid]['module']!='article')
	return '{diy "article_title"}$channelid不存在';
$blank=!empty($blank)?'target="_blank"':'';
extract($CHANNELS[$channelid],EXTR_PREFIX_ALL,'c');

$number=(int)$number;
$number=$number<2?1:$number;

$page=(int)$page;
$page=$page<2?1:$page;

$domid=random();
$wheres=array ();

$where=empty($wheres)?'1':implode(' && ',$wheres);

if(in_array($order,array (
		'hits',
		'level',
		'posttime' 
))){
	$order=$order.' desc';
}else
	$order='original desc,posttime desc';

$items=array ();
$rs=$db->query("SELECT * FROM ".PF."article_".$channelid." WHERE {$where} order by {$order} LIMIT 0,".$page*$number);

while($r=$db->fetch_array($rs)){
	$itemid=$r['itemid'];
	$r['new']=is_new($r['posttime']);
	$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.$r['thumb']:'';
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
				<ol>
       <?php $j=0; while (list($id, $item) = @each($items)){?>
       <li class="text-ellipsis">
       <?php if(!empty($date)) {?><span class="pull-right"><?php echo $item['posttime']?></span><?php }?><a
						<?php echo $blank?> href="<?php echo $item['url']?>"><?php echo html($item['title'])?></a>
					</li>
       <?php if(++$j>=$number) break;}?>
       </ol>
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
	<a class="left carl-control bg-primary" href="#<?php
									
									echo $domid?>"
		data-slide="prev"> <span class="icon-chevron-left"></span>
	</a> <a class="right carl-control bg-primary"
		href="#<?php
									
									echo $domid?>" data-slide="next"> <span class="icon-chevron-right"></span>
	</a>
	<?php }?>
       </div>