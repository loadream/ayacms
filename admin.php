<?php
if(!is_file(dirname(__FILE__).'/aya/config.inc.php')){
	header('Location: install.php');
	exit();
}
$filename=basename(__FILE__);
require './aya/admin.inc.php';

exit;

