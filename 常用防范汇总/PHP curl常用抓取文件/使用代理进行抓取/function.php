<?php  
//为什么要使用代理进行抓取呢？以google为例吧，如果去抓google的数据，短时间内抓的很频繁的话，你就抓取不到了。google对你的ip地址做限制这个时候，你可以换代理重新抓。
     $ch = curl_init();  
     curl_setopt($ch, CURLOPT_URL, "http://blog.51yip.com");  
     curl_setopt($ch, CURLOPT_HEADER, false);  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
     curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);  
     curl_setopt($ch, CURLOPT_PROXY, 125.21.23.6:8080);  
     //url_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password');如果要密码的话，加上这个  
     $result=curl_exec($ch);  
     curl_close($ch);  
 ?>