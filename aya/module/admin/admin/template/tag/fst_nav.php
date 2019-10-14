
  <ul class="breadcrumb">
          <li><a href="?action=fst&file="> / 根目录</a></li>
          
          <?php
		  $arr=explode('/',$nav_dir);
		  $p='';
		  foreach($arr as $v){
			  if(strlen($v) && $v!='.'){
				  if($p) $p.='/';
				  $p.=$v;
          ?>
          <li><a href="?action=fst&file=<?php echo $p?>"><?php echo $v?></a></li>
		  <?php
		  }
		  }?>
          
          <?php
		  if($nav_filename){
          ?>
          <li class="active"><?php echo $nav_filename?></li>
		  <?php
		  }?>
        </ul>