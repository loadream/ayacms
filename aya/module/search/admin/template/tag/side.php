<?php $act=substr($action,0,3);?>
<ul class="nav nav-secondary nav-stacked">
  <li <?php echo $act=='tpl'?'class="active"':''?>><a href="?action=tpl&channelid=<?php echo $channelid?>&in_module=1">模板</a></li>
  <li <?php echo $act=='set'?'class="active"':''?>><a href="?action=set&channelid=<?php echo $channelid?>&in_module=1">配置</a></li>
</ul>