<?php
$alert='';
if(!$link=fm_path('search')){
	$alert=' onclick="alert(\''.l('需要先创建一个搜索栏目').'\');return false;" ';
}
$id=random();
?>
<div class="input-group col-md-12">
 
<input id="<?php echo $id?>" type="text" class="form-control" placeholder="<?php echo l('请输入关键字')?>" value="">
<span class="input-group-btn">
<button class="btn btn-default" type="button" <?php echo $alert?> onclick="location='<?php echo AYA_URL?><?php echo $link?>?q='+encodeURIComponent($('#<?php echo $id?>').val());">搜索</button>
</span>
</div>