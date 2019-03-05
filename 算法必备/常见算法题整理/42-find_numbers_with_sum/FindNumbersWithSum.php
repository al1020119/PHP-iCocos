<?php

function FindNumbersWithSum($array, $sum)
{
    $result = [];
    $i = 0;
    $j = count($array)-1;
    while($i < $j){
        $sumRst = $array[$i]+$array[$j];
        if($sumRst == $sum){
            $result[] = $array[$i];
            $result[] = $array[$j];
            break;
        }
        while($i < $j && $array[$i] + $array[$j] > $sum) --$j;
        while($i < $j && $array[$i] + $array[$j] < $sum) ++$i;
    }
    return $result;
}