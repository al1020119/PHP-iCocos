<?php
 
function Permutation($str)
{
    if($str==""){
        return [];
    }
    $arr = str_split($str);
    sort($arr);
    $r = [];
    per($arr, $r, '');
    return $r;
}
 
function swap(&$a, &$b){
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}
 
function per($arr, &$r, $str){
    $len = count($arr);
    if($len == 1){
        $r[] = $str.$arr[0];
        return;
    }
    for($i=0;$i<$len;$i++){
        if($i!=0 && $arr[$i] == $arr[0]){
            continue;
        }
        swap($arr[$i],$arr[0]);
        per(array_slice($arr,1), $r, $str.$arr[0]);
    }
}
