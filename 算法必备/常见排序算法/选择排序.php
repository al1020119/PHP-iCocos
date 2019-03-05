<?php
/*
 * 选择排序
 */

$array = array(2,4,1,7,3,9,6);
$count_array = count($array);

for($i=0;$i<$count_array - 1;$i++){ //共执行count-1次操作，最后一个一定是最大的
    $min = $i; //每次从排好的数列之余找到最小的那个，放在排好的数列的最后一个
    for($j=$i + 1;$j<$count_array;$j++){ //从排好数列最后一个的下一位开始找
        if($array[$j] < $array[$min]){ //获取最小的一个的下标
            $min = $j;
        }
    }
    $temp = $array[$i]; //与排好数列最后一个交换
    $array[$i] = $array[$min];
    $array[$min] = $temp;
}

var_dump($array);

?>
