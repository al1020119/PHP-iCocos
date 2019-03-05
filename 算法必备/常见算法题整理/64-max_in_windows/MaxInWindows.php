<?php

function maxInWindows($num, $size)
{
    if($num==null || $size<=0)
        return [];
    $len=count($num);
    $l=$len-$size+1;
    $max=0;
    $s=array();
    for($i=0;$i<$l;$i++)
        {
        $max=0;
        for($j=$i;$j<$i+$size;$j++)
            {
            if($max<$num[$j])
                $max=$num[$j];
        }
        array_push($s,$max);
    }
    return $s;
}