<?php 
$path = "uploads/"; 
 
$extArr = array("jpg", "png", "gif"); 
 
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ 
    $name = $_FILES['file']['name']; 
    $size = $_FILES['file']['size']; 
     
    if(empty($name)){ 
        echo '请选择要上传的图片'; 
        exit; 
    } 
    $ext = extend($name); 
    if(!in_array($ext,$extArr)){ 
        echo '图片格式错误！'; 
        exit; 
    } 
    if($size>(100*1024)){ 
        echo '图片大小不能超过100KB'; 
        exit; 
    } 
    $image_name = time().rand(100,999).".".$ext; 
    $tmp = $_FILES['file']['tmp_name']; 
    if(move_uploaded_file($tmp, $path.$image_name)){ 
        echo 'ok'; 
    }else{ 
        echo '上传出错了！'; 
    } 
    exit; 
} 
 
//获取文件类型后缀 
function extend($file_name){ 
    $extend = pathinfo($file_name); 
    $extend = strtolower($extend["extension"]); 
    return $extend; 
} 
 ?>