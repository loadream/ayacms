<?php
$arr=array_merge(do_apply('seo_title'),array (
		$CFG['title']
));
foreach($arr as $k=>$v){
	if($v=='')
		unset($arr[$k]);
}
echo htmlspecialchars(implode(' - ',array_reverse($arr)));