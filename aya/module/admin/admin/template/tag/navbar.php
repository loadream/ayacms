<?php
if(!$USER['itemid']) return;
foreach($LANG as $k=>$_lang){
	?>
<nav class="navbar navbar-default" role="navigation" style="z-index:<?php echo 1000-$k?>">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-<?php echo $_lang?>">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="###"><?php echo $ALLLANG[$_lang]?></a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-<?php echo $_lang?>">
        
          <ul class="nav navbar-nav">
          
          <?php
		  if(is_array($LEVEL[$_lang][0])){
		  foreach($LEVEL[$_lang][0] as $id){
			  
			  $class=$channelid==$id?'active':'';
			  if(!$LEVEL[$_lang][$id]){
			  ?>
            <li class="<?php echo $class?>"><a href="?action=index&channelid=<?php echo $id?>&in_module=1"><?php echo html($CHANNELS[$id]['name'])?></a></li>
            <?php
			  }else{
			  ?>
              
              <li class="dropdown <?php echo $class?>">
              <a href="?action=index&channelid=<?php echo $id?>&in_module=1" class="dropdown-toggle" data-toggle="dropdown" onclick="javascript:location.href=this.href;"><?php echo html($CHANNELS[$id]['name'])?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" >
              <?php foreach($LEVEL[$_lang][$id] as $sid){
				  $class=$channelid==$sid?' class="active"':'';
				  ?>
                <li <?php echo $class?>><a href="?action=index&channelid=<?php echo $sid?>&in_module=1"><?php echo html($CHANNELS[$sid]['name'])?></a></li>
                <?php
			  }?>              
              </ul>
            </li>
              
              
              
              
              <?php
			  }
		  }
		  }
		  ?>
           
            
          </ul>
          
          <?php if($k<1){?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a id="<?php echo random()?>" style="color:<?php echo $_COOKIE[fix_navbar]?'#000':'#999'?>" href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-expanded="false" onclick="fix_navbar(this.id)"> <span class="icon-pushpin"> </span></a>
              
            </li>
          </ul>
          <?php }?>
          
          
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
<?php
}