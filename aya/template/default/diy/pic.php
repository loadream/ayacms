<?php
if(!$item=$db->get_one("SELECT * FROM {$db->pre}pic WHERE itemid='$itemid'"))
	return '{diy "pic"} itemid值不存在';

if(!in_array((int)$number,array (
		1,
		2,
		3,
		4,
		6,
		12 
)))
	return '{diy "pic"} number值非法';

$titles=explode('|',$item['titles']);
$contents=explode('|',$item['contents']);
$openlinks=explode('|',$item['openlinks']);
$urls=explode('|',$item['urls']);
$blank=!empty($blank)?' target="_blank"':'';

if(empty($style)){
	$width=$width?$width:'150px';
	$height=$height?$height:'150px';
	$class='img-circle';
}else{
	$width=$width?$width:'auto';
	$height=$height?$height:'auto';
	$class='img-thumbnail';
}
$domid=random();
$more=$more?$more:'more';
$page=(int)$page;
$page=$page<1?1:$page;
$n=12/$number;

?>
<div id="<?php echo $domid?>" class="diybox slide"
	data-ride="carousel">
	<div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>">
		<span><?php echo $box_title?></span>
	</div>
	
	<div class="diybox_body">
		<div class="carl-inner diybox_main" style="<?php echo $box_style?>">
            <?php
												
												for($i=0;$i<$page;$i++){
													?>
              <div class="item<?php if($i<1) echo ' active'?>">
				<div class="row">
<?php
													for($k=0;$k<$number;$k++){
														?>
    
<div class="col-md-<?php echo $n?>">
 
<?php if(empty($style)){?> 
 
 
<div style="text-align: center">

							<div>

								<img src="<?php echo AYA_URL.'aya/upload/'.$urls[$k]?>"
									width="<?php echo $width?>" height="<?php echo $height?>"
									class="<?php echo $class?>" alt="">
							</div>

							<!--icon box top -->

							<h4><?php echo html($titles[$k])?></h4>

							<p>
<?php echo html($contents[$k])?>

					</p>

							<p>

								<a <?php echo $blank?> href="<?php echo $openlinks[$k]?$openlinks[$k]:'javascript:void(0)'?>" style="font-weight: bold;"><?php echo html($more)?> →</a>

							</p>

						</div>
  <?php } else if($style==1){?>                
                
                
             <article>

							<img src="<?php echo AYA_URL.'aya/upload/'.$urls[$k]?>" alt=""
								class="<?php echo $class?>">


							<h4>
								<a <?php echo $blank?> href="<?php echo $openlinks[$k]?$openlinks[$k]:'javascript:void(0)'?>"><?php echo html($titles[$k])?></a>
							</h4>

							<p style="text-indent: 2em"><?php echo html($contents[$k])?> <a <?php echo $blank?>
									href="<?php echo $openlinks[$k]?$openlinks[$k]:'javascript:void(0)'?>" class="read-more"><?php echo html($more)?> <i
										class="icon-angle-right"></i>
								</a>

							</p>

						</article> 
       
    <?php }?>
                </div>                       
 <?php }?>               
                 
                </div>
			</div>
      <?php }?>            
</div>
	</div>
	<?php if($page>1){?>
	<ol
		class="carousel-indicators carl-indicators ">
            <?php
												for($i=0;$i<$page;$i++){
													?>
              <li data-target="#<?php
													
echo $domid?>"
			data-slide-to="<?php echo $i?>"
			class="<?php if($i<1) echo 'active'?>"></li>
              <?php }?>
            </ol>
	<a
		class="left carl-control bg-primary"
		href="#<?php
		
		echo $domid?>" data-slide="prev">
		<span class="icon-chevron-left"></span>
	</a>
	<a
		class="right carl-control bg-primary"
		href="#<?php
		
		echo $domid?>" data-slide="next">
		<span class="icon-chevron-right"></span>
	</a>
	<?php }?>
</div>
<script text="text/javascript">  
        $(function() {  
            $("#<?php echo $domid?> img").css("opacity", 1.0)  
                .hover(  
                    function () {  
                        $(this).animate({opacity:0.5});  
                    },  
                    function () {  
                        $(this).animate({opacity:1.0});  
                    }  
                );  
            });
</script>