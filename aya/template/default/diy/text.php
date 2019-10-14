<?php
$items=array();
$rs=$db->query("SELECT * FROM ".PF."text WHERE itemid in (".$itemid.")");

	while($r=$db->fetch_array($rs)){
		if(!$title) $title=$r['title'];
		$r['pic']=$r['pic']?AYA_URL.'aya/upload/'.$r['pic']:'';	
		$items[]=$r;
	}
	$db->free_result($rs);

	$num=count($items);
	$domid=random();
	$width=$width?$width:'20%';
	$height=$height?$height:'20%';
?>
<div id="<?php echo $domid?>" class="diybox slide"
	data-ride="carousel">
        <div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>"><span><?php echo $box_title?></span></div>
        <div class="diybox_body">

            <div class="carl-inner diybox_main" style="<?php echo $box_style?>">
            <?php foreach ($items as $k=>$item){
				?>
              <div class="item<?php if($k<1) echo ' active'?>">
            
            <?php if($item['pic']){?>
            <img class="img-circle" style="float:left; margin-right: 10px;width:<?php echo $width?>;height:<?php echo $height?>" src="<?php echo $item['pic']?>" />
            <?php }?>
            <?php echo $item['content']?>
                
              </div>
            <?php }?>
          </div>  
              
            </div>
            <?php if($num>1){?>
            <a class="left carl-control bg-primary" href="#<?php echo $domid?>" data-slide="prev">
              <span class="icon-chevron-left"></span>
            </a>
            <a class="right carl-control bg-primary" href="#<?php echo $domid?>" data-slide="next">
              <span class="icon-chevron-right"></span>
            </a>
            <?php }?>
</div>