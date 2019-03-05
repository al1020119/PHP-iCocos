<?php
/*
 * 冒泡排序
 */

$array = array(1,23,35,45,34,64,77,84,241,242,35,347,67);
$count_array = count($array);
$switch = 0;

for($i=0;$i<$count_array-1;$i++){
    for($j=0;$j<$count_array-$i-1;$j++){
       if($array[$j]>$array[$j+1]){ //两两相比
           $temp = $array[$j];
           $array[$j] = $array[$j+1];
           $array[$j+1] = $temp;
           $switch++;
       }
   }
    if($switch==0){ //没有交换则已为有序数组
        break;
    }
}

var_dump($array);

?>
