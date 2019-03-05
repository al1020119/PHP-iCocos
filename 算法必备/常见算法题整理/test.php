<?php


$numbers = [1,2,4,4,0];
if(count($numbers) != 5)
        return false;
    $arr = array_count_values($numbers);
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    krsort($arr);
    echo "<pre>";
    print_r(key($arr));
    echo "</pre>";
    $max = 0;
    foreach($arr as $k=>$v){
        $k>$max?$max=$k:'';
        echo "<pre>";
        print_r($max);
        echo "</pre>";
        if($max-$k>=5)
            echo 99;

        if($v>1)
            echo 0;
    }
    echo 1;



// $arr = [1,2,3,5,5];

// $b = array_count_values($arr);
// krsort($b);
// foreach ($b as $key => $value) {
//     echo "<pre>";
//     print_r($key);
//     echo "</pre>";
// }
// echo "<pre>";
// print_r($b);
// echo "</pre>";die;