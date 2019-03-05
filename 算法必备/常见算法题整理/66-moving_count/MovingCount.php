<?php

function movingCount($threshold, $rows, $cols)
{
    // write code here
    $q = new SplQueue();
    if($threshold <= 0 || $rows * $cols == 0){
        return 0;
    }
    $q->push([0,0]);
    $v = [];
    $v[0][0] = 1;
    $cnt = 0;
    while(!$q->isEmpty()){
        $t = $q->shift();
        $cnt ++;
        $i=$t[0];
        $j=$t[1];
        if(judge($i,$j+1,$threshold, $rows, $cols, $v)){
            $v[$i][$j+1] = 1;
            $q->push([$i,$j+1]);
        } 
        if(judge($i,$j-1,$threshold, $rows, $cols, $v)){
            $v[$i][$j-1] = 1;
            $q->push([$i,$j-1]);
        }
        if(judge($i+1,$j,$threshold, $rows, $cols, $v)){
            $v[$i+1][$j] = 1;
            $q->push([$i+1,$j]);
        }
        if(judge($i-1,$j,$threshold, $rows, $cols, $v)){
            $v[$i-1][$j] = 1;
            $q->push([$i-1,$j]);
        }
    }
    return $cnt;
}
 
function judge($i, $j, $k, $rows, $cols, &$v){
    if($i >= $rows || $j >=$cols || $i < 0 || $j < 0 || (isset($v[$i]) && isset($v[$i][$j]) && $v[$i][$j] == 1)){
        return false;
    }
    return array_sum(str_split($i)) + array_sum(str_split($j)) <= $k;
}