<?php

function LastRemaining_Solution($n, $m)
{
     if($n==0){
          return -1;
     }
        
    $s=0;
    for($i=2;$i<=$n;$i++)
    {
        $s=($s+$m)%$i;
    }
    return $s;
}