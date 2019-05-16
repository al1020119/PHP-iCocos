<?php
$file = $_FILES['file'];
if ($file['error'] == 0) {
	$fileName = md5(time());
	$type = explode('/', $file['type'])[1];
	move_uploaded_file($file['tmp_name'], './upload/'.$fileName.'.'.$type);
}