<?php

?>
<ul class="nav nav-primary nav-stacked">
  <li class="nav-heading"><?php echo html($c_name)?></li>
  <li <?php echo $action=='index'?'class="active"':''?>><a href="<?php echo AYA_URL?><?php echo $c_path?>index.php"><i class="icon-user"></i> <?php echo l('个人信息')?> </a></li>
 <li <?php echo $action=='edit'?'class="active"':''?>><a href="<?php echo AYA_URL?><?php echo $c_path?>edit.php"><i class="icon-edit"></i> <?php echo l('编辑资料')?> </a></li>
 <li <?php echo $action=='pass'?'class="active"':''?>><a href="<?php echo AYA_URL?><?php echo $c_path?>pass.php"><i class="icon-key"></i> <?php echo l('修改密码')?> </a></li>
</ul>
<div class="mt-30"></div>
