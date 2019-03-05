<?php

function GetLeastNumbers_Solution($input, $k)
{
    $length=count($input);
    $result=array();
    if($length>0 && $length>=$k){
        sort($input);
        $result = array_slice($input,0,$k);
        return $result;
    }else{
        return $result;
    }
}