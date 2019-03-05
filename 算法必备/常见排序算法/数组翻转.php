<?php
/* 数组翻转
 *
 */
    $o_array = array('1','2','3','4','5','6','7');
    $o_count = count($o_array);
    $o_count_r = $o_count % 2;
    
    if($o_count_r){
        $o_count = ($o_count - 1) / 2;
    }else{
        $o_count = ($o_count) / 2;
    }
    
    $start = 0;
    $end = count($o_array) - 1;
    for($i=0;$i<$o_count;$i++){
        $temp = $o_array[$start];
        $o_array[$start] = $o_array[$end];
        $o_array[$end] = $temp;
        $start++;
        $end--;
    }

    var_dump($o_array);

?>