<?php

function IsContinuous($numbers)
{
    if(count($numbers) != 5)
        return false;
    $arr = array_count_values($numbers);
    krsort($arr);
    $max = 0;
    foreach($arr as $k=>$v){
        $k>$max?$max=$k:'';
        if(($k !=0 && $v>1) || ($k!=0 && ($max-$k>=5)))
            return false;
    }
    return true;
}