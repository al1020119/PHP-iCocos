<?php
/*
PHP防止SQL注入
我们在查询数据库时，出于安全考虑，需要过滤一些非法字符防止SQL恶意注入，请看一下函数：
 */
function injCheck($sql_str) {  
    $check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str); 
    if ($check) { 
        echo '非法字符！！'; 
        exit; 
    } else { 
        return $sql_str; 
    } 
} 