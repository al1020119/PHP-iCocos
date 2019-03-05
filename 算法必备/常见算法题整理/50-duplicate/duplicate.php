<?php

function duplicate($numbers, &$duplication)
{
    // write code here
    //这里要特别注意~找到任意重复的一个值并赋值到duplication[0]
    //函数返回True/False
    if(empty($numbers)){
        return false;
    }
    $length = count($numbers);
    foreach($numbers as $value){
        if($value< 0 || $value > $length) {
            return false;
        }
    }
     
    
    foreach ($numbers as $key => &$value){
        while($value!= $key){
            if($value == $numbers[$value]){
                $duplication[0] = $value;
                return true;
            }
            $temp = $value;
            $value = $numbers[$temp];
            $numbers[$temp] = $temp;
        }   
    }
     
    return false;
}