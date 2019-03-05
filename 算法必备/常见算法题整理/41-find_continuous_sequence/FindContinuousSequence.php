<?php

function FindContinuousSequence($sum)
{
    $m = sqrt(2*$sum);
    $sum2 = 2 * $sum;
    $result = [];
    if($sum < 3){
        return [];
    }
    for($l=2;$l<=$m;$l++){
       if($sum2 % $l ==0){
            $k = $sum2/$l;
            if((($k+$l-1) & 1) == 0 && (($k-$l+1) & 1) == 0){
                 $result[] = range(($k-$l+1)/2, ($k+$l-1)/2);
            }
        }
    }
    return array_reverse($result);
}