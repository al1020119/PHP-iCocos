<?php
function rectCover($number)
{
    $prePreNum = 1;
    $preNum = 2;
    $temp = 0;
    if($number == 1){
        return 1;
    }
    if($number == 2){
        return 2;
    }
    for($i=3;$i<=$number;$i++){
        $temp = $prePreNum + $preNum;
        $prePreNum = $preNum;
        $preNum = $temp;
    }
    return $temp;
}