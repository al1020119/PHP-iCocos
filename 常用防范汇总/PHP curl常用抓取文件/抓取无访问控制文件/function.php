<?php  
//用php 的curl主要是抓取数据，当然我们可以用其他的方法来抓取，比如fsockopen,file_get_contents等。但是只能抓那些能直接访问的页面，如果要抓取有页面访问控制的页面，或者是登录以后的页面就比较困难了。
     $ch = curl_init();  
     curl_setopt($ch, CURLOPT_URL, "http://localhost/mytest/phpinfo.php");  
     curl_setopt($ch, CURLOPT_HEADER, false);  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
     $result=curl_exec($ch);  
     curl_close($ch);  
?>