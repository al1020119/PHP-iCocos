<?php
/*
 * 希尔排序
 */

$array = array(3,1,5,6,35,63,23,4,7,2,65);
$count_array = count($array);


for($i = (int)($count_array/2);$i>0;$i=(int)($i/2)){ //循环分隔整个数组为多个长度为增量(增量为整数，每次循环除以2)的子序列
    for($j = (int)$i;$j<$count_array;$j++){ //从增量开始判断
        $index = (int)($j - $i); //步长为增量
        $current = $array[$j];
        while($index >= 0 && $array[$index] > $current){ //相对选择排序只是步长为增量而不为1
            $array[$index + $i] = $array[$index];
            $index = $index - $i;
        }
        $array[$index + $i] = $current;
    }
}

var_dump($array);
?>
