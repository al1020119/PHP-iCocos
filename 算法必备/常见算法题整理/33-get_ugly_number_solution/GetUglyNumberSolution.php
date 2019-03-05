<?php

function GetUglyNumber_Solution($index)
{
    if($index==0)
        return 0;
    if($index==1)
        return 1;
    $f=[1];
    $index2=0;
    $index3=0;
    $index5=0;
    for($i=1;$i<$index;$i++)
        {
        $f[$i]=min($f[$index2]*2,$f[$index3]*3,$f[$index5]*5);
        if ($f[$i]==$f[$index2]*2)
            $index2++;
        if ($f[$i]==$f[$index3]*3)
            $index3++;
        if ($f[$i]==$f[$index5]*5)
            $index5++;
    }
    return end($f);
}