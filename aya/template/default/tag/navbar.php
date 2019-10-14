<?php 
$hide='hide_'.CLIENT;

?>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar-<?php echo AYA_LANG?>">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse"
			id="navbar-<?php echo AYA_LANG?>">
			<ul class="nav navbar-nav">
          
          <?php
										if(is_array($LEVEL[AYA_LANG][0])){
											foreach($LEVEL[AYA_LANG][0] as $k=>$id){
												if($CHANNELS[$id][$hide])
													continue;
												if(!$LEVEL[AYA_LANG][$id]){
													$class=$channelid==$id?' class="active"':'';
													?>
            <li <?php echo $class?>><a
					<?php echo $CHANNELS[$id]['isblank']?'target="_blank"':''?>
					href="<?php if($CHANNELS[$id]['module']!='anull') echo AYA_URL; if(!($k<1 && $CHANNELS[$id]['language']==$LANG[0])) echo $CHANNELS[$id]['path'];?>"><?php echo html($CHANNELS[$id]['name'])?></a></li>
            <?php
												}else{
													?>
              
              <li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><?php echo html($CHANNELS[$id]['name'])?> <span
						class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
              <?php
													
foreach($LEVEL[AYA_LANG][$id] as $sid){
														if($CHANNELS[$sid][$hide])
															continue;
														$class=$channelid==$sid?' class="active"':'';
														?>
                <li <?php echo $class?>><a
							<?php echo $CHANNELS[$sid]['isblank']?'target="_blank"':''?>
							href="<?php if($CHANNELS[$id]['module']!='anull') echo AYA_URL;echo $CHANNELS[$sid]['path']?>"><?php echo html($CHANNELS[$sid]['name'])?></a></li>
                <?php
													}
													?>
              </ul></li>
              
              <?php
												}
											}
										}
										?>
            
          </ul>
		</div>
	</div>
</nav>
<div class="sha"></div>