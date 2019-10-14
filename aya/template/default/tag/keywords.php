<?php
$arr=do_apply('seo_keywords');
foreach($arr as $k=>$v){
	if($v=='')
		unset($arr[$k]);
}
echo html(implode(',',array_reverse($arr)));