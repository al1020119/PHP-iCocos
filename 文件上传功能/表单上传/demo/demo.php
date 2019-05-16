<?php
  if(isset($_FILES['file'])){
    $file = $_FILES['file']; 
  }
    if($file['error'] == '0'){
        $type = explode("/", $file['type'])[1];
        echo './Upload/img/'.md5(time()).".".$file['type'];
        $status = move_uploaded_file($file['tmp_name'],'./upload/'.md5(time()).".".$type);
        if ($status) {
            echo "保存成功".$status;
        }else{
            echo "上传失败".$status;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="demo.php" enctype="multipart/form-data">
   <input type="file" name="file">
   <input type="submit" name="submit" value="上传">
</form>
</body>
</html>