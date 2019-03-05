<?php

function MoreThanHalfNum_Solution($numbers)
{
    $count = count($numbers);
    if(!$count)
        return 0;
    $res = [];
    $num = 0;
    for($i=0; $i<$count; $i++){
        $val = $numbers[$i];
        isset($res[$val])? $res[$val]=$res[$val]+1:$res[$val]=1;
        if($res[$val] > floor($count/2))
            $num = $val;
    }
    return $num;
}