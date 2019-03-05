<?php

function Sum_Solution($n)
{
    $sum = 0;
    $n > 0 &&  $sum+=$n+Sum_Solution($n-1);
    return $sum;
}