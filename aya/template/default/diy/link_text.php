<?php
if(!$item=$db->get_one("SELECT * FROM {$db->pre}link WHERE itemid='$itemid'"))
	return '{diy "link_text"} itemid值不存在';


$number=(int)$number;
$text_align=(string)$text_align;
$padding=(string)$padding;
$color=(string)$color;
$linkcolor=(string)$linkcolor;
$blank=!empty($blank)?'target="_blank"':'';

$titles=explode('|',$item['titles']);
$contents=explode('|',$item['contents']);
$openlinks=explode('|',$item['openlinks']);
$urls=explode('|',$item['urls']);

?>

<div style="text-align:<?php echo $text_align?>;padding:<?php echo $padding?>;color:<?php echo $color?>">
<?php
$i=0;
foreach($titles as $k=>$title){
	if(strlen($title)<1)
		break;
	if($number>0&&$number<$i+1)
		break;
	if($i>0)
		echo '<span style="padding:0 8px"> | </span>';
	?>
	
<a style="color: <?php echo $linkcolor?>;font-weight: <?php echo $bold?'bold':''?>" <?php echo $blank?> href="<?php echo $openlinks[$k]?>"><?php echo html($title)?></a>
	
	<?php
	$i++;
}
?>

</div>