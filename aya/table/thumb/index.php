<?php
foreach($values as $pic=>$title){
	if(strlen($pic))
		echo '<img src="'.AYA_URL.'aya/upload/'.$pic.'" title="'.html($title).'"/> ';
}