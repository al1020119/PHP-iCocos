<?php

function reOrderArray($array)
{
    $odd = [];
    $even = [];
    foreach($array as $v){
        if($v%2)
            $odd[] = $v;
        else
            $even[] = $v;
    }
    return array_merge($odd,$even);
}