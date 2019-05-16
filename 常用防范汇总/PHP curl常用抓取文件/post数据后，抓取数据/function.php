<?php  
//单独说一下数据提交数据，因为用 curl的时候，很多时候会有数据交互的，所以比较重要的。
     $ch = curl_init();  
     /*在这里需要注意的是，要提交的数据不能是二维数组或者更高 
     *例如array('name'=>serialize(array('tank','zhang')),'sex'=>1,'birth'=>'20101010') 
     *例如array('name'=>array('tank','zhang'),'sex'=>1,'birth'=>'20101010')这样会报错的*/ 
     $data = array('name' => 'test', 'sex'=>1,'birth'=>'20101010');  
     curl_setopt($ch, CURLOPT_URL, 'http://localhost/mytest/curl/upload.php');  
     curl_setopt($ch, CURLOPT_POST, 1);  
     curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//返回的数据转换成可存储数据
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
     $return = curl_exec($ch);  //数据储存在$return变量中
     curl_close($ch);
?>