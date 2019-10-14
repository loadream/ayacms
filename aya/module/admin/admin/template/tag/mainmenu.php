<?php
if(!$USER['itemid']) return;
$_act='';
if(!$channelid){
	$_act=substr($action,0,3);
}
?>
<div class="btn-group btn-group-xs">
        <a class="btn <?php echo !$channelid && $action=='index'?'btn-warning':''?>" href="<?php echo AYA_ADMIN_URL?>">首页</a>
        <a class="btn <?php echo $_act=='set'?'btn-warning':''?>" href="<?php echo AYA_ADMIN_URL?>?action=set">系统设置</a>
        <a class="btn <?php echo $_act=='ust'?'btn-warning':''?>" href="<?php echo AYA_ADMIN_URL?>?action=ust">内容维护</a>
        <a class="btn <?php echo $_GET['in_module']?'btn-warning':''?>" data-toggle="collapse" data-target="#channelmenu" >栏目管理 <span class="caret"></span></a>
        <a class="btn <?php echo $_act=='api'?'btn-warning':''?>" href="<?php echo AYA_ADMIN_URL?>?action=api">API</a>
        <a class="btn <?php echo $_act=='fst'?'btn-warning':''?>" href="<?php echo AYA_ADMIN_URL?>?action=fst">文件编辑</a>
      </div>
