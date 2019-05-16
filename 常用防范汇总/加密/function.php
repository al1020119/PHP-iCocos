<?php
/*
PHP加密和解密函数可以用来加密一些有用的字符串存放在数据库里，并且通过可逆解密字符串，该函数使用了base64和MD5加密和解密。
 */
function encryptDecrypt($key, $string, $decrypt){ 
    if($decrypt){ 
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12"); 
        return $decrypted; 
    }else{ 
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key)))); 
        return $encrypted; 
    } 
} 
//以下是将字符串“Helloweba欢迎您”分别加密和解密 
//加密： 
echo encryptDecrypt('password', 'Helloweba欢迎您',0); 
//解密： 
echo encryptDecrypt('password', 'z0JAx4qMwcF+db5TNbp/xwdUM84snRsXvvpXuaCa4Bk=',1); 