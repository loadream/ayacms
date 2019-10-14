<?php

if(count($LANG)<2) return;

$paths=array();
foreach($CHANNELS as $v){
	if(!isset($paths[$v['language']]))
	$paths[$v['language']]=$v['path'];
}
?>

<div class="btn-group" data-toggle="buttons-radio">
<?php foreach($LANG as $k=>$v){?>
                <a href="<?php echo AYA_URL.($k>0?$paths[$v]:'')?>" class="btn btn-mini <?php if(AYA_LANG==$v)echo 'btn-primary active';?>"><?php echo $ALLLANG[$v]?></a>
<?php }?>                
              </div>