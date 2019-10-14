<?php
$alert='';
if(!$link=fm_path('member')){
	$alert=' onclick="alert(\''.l('需要先创建一个用户中心栏目').'\');return false;" ';
}

if($USER['itemid']<1){
	?>

<a <?php echo $alert?>
	href="<?php echo AYA_URL?><?php echo $link?>login.php"
	class="btn btn-link btn-xs"><?php echo l('登录')?></a>
|
<a <?php echo $alert?>
	href="<?php echo AYA_URL?><?php echo $link?>reg.php"
	class="btn btn-link btn-xs"><?php echo l('注册')?></a>
|
<a <?php echo $alert?>
	href="<?php echo AYA_URL?><?php echo $link?>passz.php"
	class="btn btn-link btn-xs"><?php echo l('找回密码')?></a>

<?php }else{?>

<span class="btn btn-link btn-xs btn-text"> <i class="icon-user"></i> <?php echo html($USER['name'])?></span>
|
<a <?php echo $alert?> href="<?php echo AYA_URL?><?php echo $link?>"
	class="btn btn-link btn-xs"> <i class="icon-cog"></i> <?php echo l('用户中心')?></a>
|
<a <?php echo $alert?> href="javascript:;" class="btn btn-link btn-xs"
	onclick="if(confirm('<?php echo l('确定要退出吗')?>?'))aya_get('<?php echo AYA_URL?><?php echo $link?>out.php');">
	<i class="icon-signout"></i> <?php echo l('退出')?></a>
<?php }?>
