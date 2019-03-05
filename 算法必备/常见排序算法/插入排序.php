<?php
/*
 * 插入排序
 */

$array = array(1,3,5,1,2,35,6,123);
$count_array = count($array);

for($i=1;$i<$count_array;$i++){
    $index = $i - 1;
    $current = $array[$i];
    while($index>=0 && $array[$index] > $current){
        $array[$index+1] = $array[$index]; //不用担心覆盖，当前位置之前的所有有序数组元素都比current大，也就是说有序数组最后一位(最先比较的那一位的键值已经加1了)
        $index--;
    }
    $array[$index+1] = $current;
}

var_dump($array);

?>