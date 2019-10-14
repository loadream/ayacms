<?php
$arr=array_merge(do_apply('seo_keywords'),array (
			$CFG['keywords'] 
	));
	
	foreach($arr as $k=>$v){
		if($v=='')
			unset($arr[$k]);
	}
	echo count($arr)>0?htmlspecialchars(implode(',',$arr)):'';