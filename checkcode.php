<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once ("aya/include/caption.class.php");

$code=new VerificationCode();
$code->createCode();
$_SESSION['checkcode']=$code->getCode();
$code->showCode();  
