<?php

if(!$item=$db->get_one("SELECT * FROM {$db->pre}pic WHERE itemid='$itemid'")) return '{diy "carousel"} itemid值不存在';
$titles=explode('|',$item['titles']);
$contents=explode('|',$item['contents']);
$openlinks=explode('|',$item['openlinks']);
$urls=explode('|',$item['urls']);

$domid=random();
?>


<div id="<?php echo $domid?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php foreach($urls as $k=>$url){
				if(!strlen($url)) break;
				?>
              <li data-target="#<?php echo $domid?>" data-slide-to="<?php echo $k?>" class="<?php if($k<1) echo 'active'?>"></li>
              <?php }?>
            </ol>
            <div class="carousel-inner">
            <?php foreach($urls as $k=>$url){
				if(!strlen($url)) break;
				?>
              <div class="item<?php if($k<1) echo ' active'?>">
             <img style="<?php echo $height?('width:100%;height:'.$height):'';?>" alt="<?php echo html($titles[$k])?>" src="<?php echo AYA_URL.'aya/upload/'.$url?>" />
                <div class="carousel-caption">
                  <h3><?php if ($openlinks[$k]) {?><a href="<?php echo $openlinks[$k]?>"><?php }?><?php echo html($titles[$k])?><?php if ($openlinks[$k]) {?></a><?php }?></h3>
                  <p><?php echo html($contents[$k])?></p>
                </div>
              </div>
            <?php }?>  
              
            </div>
            <a class="left carousel-control" href="#<?php echo $domid?>" data-slide="prev">
              <span class="icon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#<?php echo $domid?>" data-slide="next">
              <span class="icon-chevron-right"></span>
            </a>
          </div>
