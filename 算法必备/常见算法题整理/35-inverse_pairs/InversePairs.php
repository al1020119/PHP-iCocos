<?php

function InversePairs($data)
{
    return mergeSort($data) % 1000000007;
}
  
function mergeSort(&$arr) {
    $len = count($arr);
    $sum = 0;
    mSort($arr, 0, $len-1, $sum);
    return $sum;
}
  
function mSort(&$arr, $left, $right, &$sum) {
    if($left < $right) {
        $center = ($left+$right) >> 1;
        mSort($arr, $left, $center, $sum);
        mSort($arr, $center+1, $right, $sum);
        mergeArray($arr, $left, $center, $right, $sum);
    }
}
   
function mergeArray(&$arr, $l, $m, $r, &$sum) {
    $i = $l;
    $j = $m+1;
    while($i<=$m && $j<=$r) {
        if($arr[$i] <= $arr[$j]) {
            $temp[] = $arr[$i++];
        } else {
            $sum += $m - $i + 1;
            $temp[] = $arr[$j++];
        }
    }
    while($i <= $m) {
        $temp[] = $arr[$i++];
    }
    while($j <= $r) {
        $temp[] = $arr[$j++];
    }
    for($i=0, $len=count($temp); $i<$len; $i++) {
        $arr[$l+$i] = $temp[$i];
    }
}