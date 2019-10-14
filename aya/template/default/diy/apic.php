<?php
if(!$item=$db->get_one("SELECT * FROM {$db->pre}pic WHERE itemid='$itemid'"))
	return '{diy "apic"} itemid值不存在';


$titles=explode('|',$item['titles']);
$contents=explode('|',$item['contents']);
$openlinks=explode('|',$item['openlinks']);
$urls=explode('|',$item['urls']);

$width=$width?$width:'auto';
$height=$height?$height:'auto';
$blank=!empty($blank)?' target="_blank"':'';
?>

<?php if($openlinks[0]){?>
<a href="<?php echo $openlinks[0]?>" <?php echo $blank?>>
<?php }?>
<img style="padding:<?php echo $padding?>;width:<?php echo $width?>;height:<?php echo $hight?>" src="<?php echo AYA_URL.'aya/upload/'.$urls[0]?>"/>
<?php if($openlinks[0]){?>
</a>
<?php }?>