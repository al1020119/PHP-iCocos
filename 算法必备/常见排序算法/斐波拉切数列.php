<?php
/*
 * 斐波拉切数列
 */

$arr = array(1,1);

for($i=2;$i<10;$i++){
    $arr[$i] = $arr[$i - 1] + $arr[$i - 2];
}

var_dump($arr);

?>