<?php
function FindGreatestSumOfSubArray($array)
{
    $sum = $array[0];
    $max = $sum;
    for($i = 1;$i<count($array);$i++){
        if($sum<0){
            $sum = $array[$i];
        }
        else {
            $sum += $array[$i];
        }
        if($sum>$max){
            $max = $sum;
        }
    }
    return $max;
}