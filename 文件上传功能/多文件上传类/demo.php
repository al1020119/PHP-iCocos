<?php
    	print_r($_FILES['spic']);
header('Content-Type:text/html;charset=utf-8');
//if(@$_FILES['spic'])echo "ddddddddd";;
include "UpFile.class.php";
$upfile = new UpFile(array('filepath'=>'./upload/','allowtype'=>array('php','bmp','gif','jpg','png'),'israndfile'=>true,'maxsize'=>'1000000'));
 /*if (is_dir('./upload')) {
 	echo "存在";
    $f = scandir('./upload');
    print_r($f);
 }else{
 	echo "不存在";
 }*/
if($upfile ->uploadeFile('spic')){
 $arrfile = $upfile ->getnewFile();
 foreach($arrfile as $v){
 echo $v,"<br/>";
 }
 echo "上传成功！"._PUBLIC_;
}else{
 $err = $upfile ->gteerror();
 if(is_array($err)){
 foreach($err as $v1){
  echo $v1,"<br/>";
 }
 }else{
 echo $err;
 }
 //var_dump($err);
}