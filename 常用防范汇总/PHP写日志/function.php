<?php
/*
PHP写日志
我们在测试代码的时候，需要了解代码执行情况，而这中执行时在后台运行的，前台无法知道是否运行正常，在这种情况下，我们一般用写日志的形式来调试代码。
 */
function logResult($str='') { 
    $fp = fopen("log.txt","a"); 
    flock($fp, LOCK_EX) ; 
    fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$str."\n"); 
    flock($fp, LOCK_UN); 
    fclose($fp); 
} 
//函数logResult()记录执行时间，参数$str自定义，执行时会将运行日志写入到log.txt文件中，注意log.txt要有写权限。比如我们想知道支付接口返回的数据信息，可以这样调用：
logResult('获取数据reselt=xxx'); 
