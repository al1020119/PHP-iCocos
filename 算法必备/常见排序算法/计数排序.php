<?php

$array = array(1,2,1,1,1,1,1,1,2,5,3,45,2,25,3,22,3,3,4,4,4,4,4,23,23,42,3,22,2,3,4,23,4,234,32,2,2,3,1,1,1);

function countingSort($arr)
{
    
    //初始化数组，请求空间
    for ($m = 0; $m < max($arr) + 1; $m++) {
        $bucket[] = null; //元素设为null
    }

    $arrLen = count($arr);
    for ($i = 0; $i < $arrLen; $i++) {
        if (empty($bucket[$arr[$i]])) { //加1操作时需先转为0
            $bucket[$arr[$i]] = 0;
        }
        $bucket[$arr[$i]]++;
    }

    $sortedIndex = 0;
    foreach ($bucket as $key => $value) { //key为值，value为计数
        if ($value !== null){
            for($j=0;$j<(int)$value;$j++){ //不为空则循环将该值添加到数组
                $arr[$sortedIndex++] = $key;
            }
        }
    }

    return $arr;
}

var_dump(countingSort($array));

?>