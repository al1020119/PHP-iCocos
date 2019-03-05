<?php 

    $array = array(1,2,5,3,7,1,8);
    
    function quick_sort($array){
        if(count($array) <= 1){ //数组只有一个元素，直接返回该数组
            return $array;
        }
        $left = array();
        $right = array();
        $pivot = $array[0];
        
        for($i = 1;$i < count($array);$i++){ //当前数组第一位为中间值
            if($array[$i] > $pivot){ //左右数组存放比中间值小或大的数组成的数组
                $right[] = $array[$i];
            }else{
                $left[] = $array[$i];
            }
        }
        
        $left = quick_sort($left); //左数组不停再隔分直到满足只有一个元素
        /*
            quick_sort( quick_sort(quick_sort( ... )) )
            递归就是从外括号到内括号直到不满足条件，再从内括号到外括号执行
            最内层将直接返回(只有一个元素)
            每次递归内部都有两个递归(左右)
            
            1,2,3
            (1 | 2,3)
            (1) |  (2 | 3)
            (1) |  (2)  |  (3)
            
        */
        $left[] = $pivot;
        return array_merge($left,quick_sort($right));
    }

    $array = quick_sort($array);
    var_dump($array);
?>