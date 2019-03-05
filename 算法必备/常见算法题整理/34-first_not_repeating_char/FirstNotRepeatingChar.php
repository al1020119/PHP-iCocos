<?php

function FirstNotRepeatingChar($str)
{
    $charArr = count_chars($str,1);
    $index = 10000;
    foreach($charArr as $k=>$v){
        if($v == 1){
            strpos($str, chr($k))<$index?$index = strpos($str, chr($k)):'';
        }
    }
    if($index == 10000)
        return -1;
    return $index;
}