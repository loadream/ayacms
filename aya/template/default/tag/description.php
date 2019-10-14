<?php
$arr=do_apply('seo_description');
	foreach($arr as $k=>$v){
		if($v=='')
			unset($arr[$k]);
	}
	echo count($arr)>0?html(implode(',',array_reverse($arr))):'';