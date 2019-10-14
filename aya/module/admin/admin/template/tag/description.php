<?php
$arr=array_merge(do_apply('seo_description'),array (
			$CFG['description'] 
	));
	foreach($arr as $k=>$v){
		if($v=='')
			unset($arr[$k]);
	}
	echo count($arr)>0?htmlspecialchars(implode(',',$arr)):'';