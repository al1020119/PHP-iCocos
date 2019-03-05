<?php

function Add($num1, $num2)
{
    while($num2){
        //相加之后的进位
        $tmp = $num1 ^ $num2;
        //相加之后没有进位
        $num2 = ($num1 & $num2) << 1;
        $num1 = $tmp;
    }
    return $num1;
}