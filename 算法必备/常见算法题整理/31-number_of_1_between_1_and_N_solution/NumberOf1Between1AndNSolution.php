<?php

function NumberOf1Between1AndN_Solution($str)
{
    settype($str, 'string');
     
    if ($str == 0 || strlen($str) == 0) {
        return 0;
    }
 
    $first = $str[0];
 
    $numFirstDigit = 0;
    if ($first > 1) {
        $numFirstDigit = powerBase10(strlen($str) - 1);
    } else {
        $numFirstDigit = substr($str, 1) + 1;
    }
 
    $numOtherDigits = $first * (strlen($str)-1) * powerBase10(strlen($str)-2);
    $numRecursive = NumberOf1Between1AndN_Solution(substr($str, 1));
 
    return $numFirstDigit + $numOtherDigits + $numRecursive;
}
 
function powerBase10($number) {
    return pow(10, $number);
}