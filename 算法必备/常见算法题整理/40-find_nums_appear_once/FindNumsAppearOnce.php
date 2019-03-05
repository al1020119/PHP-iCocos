<?php

function FindNumsAppearOnce($array)
{
    // write code here
    // return list, 比如[a,b]，其中ab是出现一次的两个数字
    $count_array = array_count_values($array);
    foreach($count_array as $key=>$value)
    {
        if($value==1)
        {
            $new_array[] = $key;
        }
    }
    return $new_array;
}