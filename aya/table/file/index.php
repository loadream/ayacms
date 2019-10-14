<?php
foreach($values as $val){
	if(strlen($val))
		echo '<a class="btn btn-sm" href="'.AYA_URL.'aya/upload/'.$val.'"><span class="icon-download-alt"></span> '.l('下载文件').'</a> ';
}