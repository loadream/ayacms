<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/
defined('IN_AYA') or exit('Access Denied');

$uploadDir = AYA_ROOT.'upload/~tmp/';
//$fileTypes	=array('php','swf','js','html','htm');	
$fileTypes	=array();	
		
		$fname=time().rand(1000,9999);
		
		if (!empty($_FILES) ) {
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			
			$fileParts = pathinfo($_FILES['Filedata']['name']);
		
			$targetFile = $uploadDir .$fname .'.'.$fileParts['extension'];
		
			if (!in_array(strtolower($fileParts['extension']), $fileTypes)) {
		
				// Save the file
				move_uploaded_file($tempFile, $targetFile);
				return $fname .'.'.$fileParts['extension'];
		
			} else {
		
				return l('系统禁止上传该类型文件');
			}
		}
		return l('操作失败');