<?php
$itemid=(int)$itemid;
if(!$item=$db->get_one("SELECT * FROM ".PF."poll WHERE itemid=".$itemid)) return '{diy "poll"} itemid值不存在';

$items=explode('|',$item['items']);
$polls=explode('|',$item['polls']);
?>

<div class="diybox">
        <div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>"><span><?php echo $box_title?></span></div>
        <div class="diybox_body">
        <div class="diybox_main" style="<?php echo $box_style?>">
<?php echo $item['content']?>
<form class="form-horizontal" role="form" id="<?php echo random()?>" action="<?php echo AYA_URL.'ajax.php?fun=poll&itemid='.$itemid.'&lang='.AYA_LANG?>"
	method="post" onsubmit="aya_post(this.id);return false;">
  <div class="form-group">
    <div class="col-md-12">
    
    <?php foreach($items as $k=>$v){
		if(strlen($v)<1) continue;
		if($item['ty']==1){
		?>
    
      <label class="radio-inline">
        <input type="radio" name="posts[id]" value="<?php echo $k?>" >
        <?php echo html($v)?></label>
   <br />
<?php }else{
	?>
      <label class="radio-inline">
        <input type="checkbox" name="posts[ids][]" value="<?php echo $k?>" >
        <?php echo html($v)?></label>
    <br />
	<?php
}
	 }?>
      
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
      <input type="submit" class="btn btn-primary" value="<?php echo l('提交')?>" />
    </div>
  </div>
</form>
</div>
</div>
</div>
