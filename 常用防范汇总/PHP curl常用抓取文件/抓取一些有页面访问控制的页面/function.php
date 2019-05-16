<?php  
     $ch = curl_init();  
     curl_setopt($ch, CURLOPT_URL, "http://club-china");  
     /*CURLOPT_USERPWD主要用来破解页面访问控制的 
     *例如平时我们所以htpasswd产生页面控制等。*/ 
     //curl_setopt($ch, CURLOPT_USERPWD, '231144:2091XTAjmd=');  
     curl_setopt($ch, CURLOPT_HTTPGET, 1);  
     curl_setopt($ch, CURLOPT_REFERER, "http://club-china");  
     curl_setopt($ch, CURLOPT_HEADER, 0);  
     $result=curl_exec($ch);  
     curl_close($ch);  
?>