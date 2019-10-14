<?php
$sign=random();
?>
<div class="diybox">
        <div class="diybox_title <?php if($box_title=='hide') echo 'hidden';?>"><span><?php echo $box_title?></span></div>
        <div class="diybox_body">
        <div class="diybox_main" style="<?php echo $box_style?>">
        
<form class="form-horizontal" role="form" id="<?php echo sign?>" action="<?php echo AYA_URL?>ajax.php?fun=send_email&type=emailsend&sign=<?php echo $sign?>"
	method="post" onsubmit="aya_post(this.id);return false;">
    <div class="form-group">
          <div class="col-md-12">
          <input type="text" name="posts[title]" id="<?php echo $sign?>title" value="" placeholder="<?php echo l('标题')?>" class="form-control">
          </div>
        </div>
    <div class="form-group">
        <div class="col-md-6">
          <input type="text" name="posts[name]" id="<?php echo $sign?>name" value="" placeholder="<?php echo l('称呼')?>" class="form-control">
        </div>
        <div class="col-md-6">
          <input type="text" name="posts[email]" id="<?php echo $sign?>email" value="" placeholder="Email" class="form-control">
        </div>
      </div>
      
         <div class="form-group">
          <div class="col-md-12">
          <textarea class="form-control" rows="4" name="posts[content]" id="<?php echo $sign?>content" placeholder="<?php echo l('内容')?>"></textarea>
          
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-5">
            <input type="submit" class="btn btn-primary" value="<?php echo l('提交')?>" />
          </div>
          <div class="col-md-4" id="<?php echo $sign?>checkcode_box"></div>
         <div class="col-md-3" id="<?php echo $sign?>checkcode_img"></div>
        </div>
          
      </form>
      </div>
      </div>
      </div>
      <script type="text/javascript">
	  
 $(function(){
$('#<?php echo $sign?>content').focus(function()
{ 
if(!$('#<?php echo $sign?>checkcode_box').html()){
$('#<?php echo $sign?>checkcode_box').html('<input type="text" id="<?php echo $sign?>checkcode" name="posts[checkcode]" class="form-control" placeholder="<?php echo l('请输入验证码')?>" />');
$('#<?php echo $sign?>checkcode_img').html('<a href="javascript:<?php echo $sign?>checkcode()"><img style="height:32px" class="img-rounded" src="<?php echo AYA_URL?>checkcode.php" id="<?php echo $sign?>_checkcode"/></a>');
}
})
 });	  


function <?php echo $sign?>checkcode(){
$('#<?php echo $sign?>_checkcode').attr('src','<?php echo AYA_URL?>checkcode.php?'+Math.random());
$("#<?php echo $sign?>checkcode").focus();
}
</script> 