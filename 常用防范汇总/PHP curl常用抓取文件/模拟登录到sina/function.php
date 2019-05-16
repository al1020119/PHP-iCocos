<?php     
    function checklogin( $user, $password )  
     {  
     if ( emptyempty( $user ) || emptyempty( $password ) )  
     {  
     return 0;  
     }  
     $ch = curl_init( );  
     curl_setopt( $ch, CURLOPT_REFERER, "http://mail.sina.com.cn/index.html" );  
     curl_setopt( $ch, CURLOPT_HEADER, true );  
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
     curl_setopt( $ch, CURLOPT_USERAGENT, USERAGENT );  
     curl_setopt( $ch, CURLOPT_COOKIEJAR, COOKIEJAR );  
     curl_setopt( $ch, CURLOPT_TIMEOUT, TIMEOUT );  
     curl_setopt( $ch, CURLOPT_URL, "http://mail.sina.com.cn/cgi-bin/login.cgi" );  
     curl_setopt( $ch, CURLOPT_POST, true );  
     curl_setopt( $ch, CURLOPT_POSTFIELDS, "&logintype=uid&u=".urlencode( $user )."&psw=".$password );  
     $contents = curl_exec( $ch );  
     curl_close( $ch );  
     if ( !preg_match( "/Location: (.*)\\/cgi\\/index\\.php\\?check_time=(.*)\n/", $contents, $matches ) )  
     {  
     return 0;  
     }else{  
     return 1;  
     }  
     }   
       
     define( "USERAGENT", $_SERVER['HTTP_USER_AGENT'] );  
     define( "COOKIEJAR", tempnam( "/tmp", "cookie" ) );  
     define( "TIMEOUT", 500 );   
       
     echo checklogin("zhangying215","xtaj227");  
?>