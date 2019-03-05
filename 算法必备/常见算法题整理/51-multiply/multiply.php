<?php

function multiply($numbers)
{
    $len = count($numbers);
     
    for ($i=0; $i < $len; $i++) {
        $mult = 1;
        for ($j=0; $j < $i; $j++) {
            $mult *= $numbers[$j];
        }
        for ($j=$i+1; $j < $len; $j++) {
            $mult *= $numbers[$j];
        }
        $arr[$i] = $mult;
    }
    return $arr;
}