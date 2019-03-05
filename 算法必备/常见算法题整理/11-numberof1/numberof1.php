<?php

function NumberOf1($n)
{
    $count = 0;
    if($n < 0)
    {
         $n = $n & 0x7FFFFFFF;
         ++$count;
    }
    while($n != 0)
    {
        $count++;
        $n = $n & ($n - 1);
    }
    return $count;
}