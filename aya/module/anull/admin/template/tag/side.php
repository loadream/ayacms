<?php $act=substr($action,0,3);?>
<ul class="nav nav-secondary nav-stacked">
  <li <?php echo $action=='index'?'class="active"':''?>><a href="?action=index&channelid=<?php echo $channelid?>&in_module=1">配置</a></li>
  
</ul>