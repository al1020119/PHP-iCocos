<?php
// 第一种方法
function Find($target, $array)
{
    foreach($array as  $v){
        if(in_array($target,$v)){
            return 'true';
        }
    }
    return 'false';
}

while(fscanf(STDIN, "%d,%s", $a,$b) == 2){
    try{
        $target = $a;
        eval('$array = '.$b.";");
        echo Find($target, $array)."\n";
    }catch(Exception $e){
        die;
    }
}


// 第二种方法
/*
【过程解析】
1、分析题目
    首先题目给出的是一个二维数组，并且该二维数组是有规律的。每一行向右递增、每一列向下递增。将数组写出来是一个规律矩阵
。因此我们的最优解是从该矩阵的左下角开始遍历判断。
2、结题关键步骤
    假设是j*i的矩阵（二维数组），最开始遍历左下角的数据，大于则j++（向右移）;小于则i--（向上移）
*/
function Find2($target, $array){
    $i = count($array)-1;
    $j = 0;
    while($i>=0 && $j<count($array[0])){
        if($array[$i][$j] > $target)
            $i--;
        elseif($array[$i][$j] < $target)
            $j++;
        else
            return 1;
    }
    return 0;
}

