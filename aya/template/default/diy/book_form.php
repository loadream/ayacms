<?php
$path=fm_path('book');
?>
<div class="diybox">
        <div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>"><span><?php echo $box_title?></span></div>
        <div class="diybox_body">
        <div class="diybox_main" style="<?php echo $box_style?>">
        
<form class="form-horizontal" role="form" id="<?php echo random()?>" action="<?php echo AYA_URL.$path?>"
	method="post" onsubmit="aya_post(this.id);return false;">
    <input name="posts[title]" type="hidden" value="<?php echo l('访客提交')?>" />
    <div class="form-group">
        <div class="col-md-6">
          <input type="text" name="posts[name]" id="name" value="" placeholder="<?php echo l('称呼')?>" class="form-control">
        </div>
        <div class="col-md-6">
          <input type="text" name="posts[email]" id="email" value="" placeholder="Email" class="form-control">
        </div>
      </div>
      
         <div class="form-group">
          <div class="col-md-12">
          <textarea class="form-control" rows="4" name="posts[content]" id="content" placeholder="<?php echo html($placeholder)?>"></textarea>
          
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-5">
            <input type="submit" class="btn btn-primary" value="<?php echo l('提交')?>" />
          </div>
          <div class="col-md-4" id="checkcode_box"></div>
         <div class="col-md-3" id="checkcode_img"></div>
        </div>
          
      </form>
      </div>
      </div>
      </div>
      <script type="text/javascript">
	  
 $(function(){
$('#content').focus(function()
{ 
if(!$('#checkcode_box').html()){
$('#checkcode_box').html('<input type="text" id="checkcode" name="posts[checkcode]" class="form-control" placeholder="<?php echo l('请输入验证码')?>" />');
$('#checkcode_img').html('<a href="javascript:checkcode()"><img style="height:32px" class="img-rounded" src="<?php echo AYA_URL?>checkcode.php" id="_checkcode"/></a>');
}
})
 });	  


function checkcode(){
$('#_checkcode').attr('src','<?php echo AYA_URL?>checkcode.php?'+Math.random());
$("#checkcode").focus();
}
</script> 