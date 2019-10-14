<?php $act=substr($action,0,3);?>
<ul class="nav nav-secondary nav-stacked">
  <li <?php echo in_array($action,array('index','add','edit'))?'class="active"':''?>><a href="?action=index&channelid=<?php echo $channelid?>&in_module=1">信息</a></li>
  <li <?php echo $act=='cla'?'class="active"':''?>><a href="?action=class&channelid=<?php echo $channelid?>&in_module=1">分类</a></li>
  <li <?php echo $act=='fie'?'class="active"':''?>><a href="?action=field&channelid=<?php echo $channelid?>&in_module=1">表单</a></li>
  <li <?php echo $act=='tpl'?'class="active"':''?>><a href="?action=tpl&channelid=<?php echo $channelid?>&in_module=1">模板</a></li><li <?php echo $act=='pv'?'class="active"':''?>><a href="?action=pv&channelid=<?php echo $channelid?>&in_module=1">权限</a></li>
  <li <?php echo $act=='set'?'class="active"':''?>><a href="?action=set&channelid=<?php echo $channelid?>&in_module=1">配置</a></li>
</ul>