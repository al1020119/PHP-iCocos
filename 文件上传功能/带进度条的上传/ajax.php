<?php
//$file = $_FILES['file'];
//print_r($_FILES);
print_r($_POST);
die();
if ($file['error'] == 0) {
	echo $file['error'];
	$fileName = md5(time());
	$type = explode('/', $file['type'])[1];
	move_uploaded_file($file['tmp_name'], './upload/'.$fileName.'.'.$type);
	echo "上传成功";
}else{
	echo "上传出现问题".$file['error'];
}