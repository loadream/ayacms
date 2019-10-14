<?php
$itemid=(int)$itemid;
$width=$width?$width:'100%';
$height=$height?$height:'100%';
$domid=random();
if(!$item=$db->get_one("SELECT * FROM ".PF."video WHERE itemid=".$itemid))
	return '{diy "video"} itemid值不存在';

if(preg_match('/\d{4}\/\d{2}\/[A-Za-z0-9\.]+/isU',$item['url']))
	$item['url']=AYA_URL.'aya/upload/'.$item['url'];

$ext=strtolower(pathinfo($item['url'],PATHINFO_EXTENSION));

?>
<div class="diybox">
	<div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>">
		<span><?php echo $box_title?$box_title:$item['title']?></span>
	</div>
	<div class="diybox_body">
		<div class="diybox_main" style="<?php echo $box_style?>">
	        <?php
									
									if($ext=='swf'){
										?>
	<embed src="<?php echo $item['url']?>" quality="high"
				width="<?php echo $width?>" height="<?php echo $height?>"
				align="middle" allowScriptAccess="always"
				type="application/x-shockwave-flash"></embed>

<?php
									}else{
										
										?>
	<div id="a1"></div>
			<script type="text/javascript"
				src="<?php echo AYA_URL?>aya/include/ckplayer/ckplayer.js"></script>
			<script type="text/javascript">
	var flashvars<?php echo $domid?>={
		f:'<?php echo $item['url']?>',
		c:0,
		h:3
		};
	var video<?php echo $domid?>=[];
	var params<?php echo $domid?>={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	CKobject.embed('<?php echo AYA_URL?>aya/include/ckplayer/ckplayer.swf','a1','ckplayer_a1','<?php echo $width?>','<?php echo $height?>',false,flashvars<?php echo $domid?>,video<?php echo $domid?>,params<?php echo $domid?>);
</script>
<?php }?>

        <?php echo $itme['content']?>
        <div class="clearfix"></div>
		</div>
	</div>
</div>