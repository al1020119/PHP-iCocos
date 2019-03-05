<?php

function Fibonacci($n)
{
    if($n<=0){
        $f1 = 0;
    }else if($n==1||$n==2){
        $f1 = 1;
    }else{
        $f1 = 1; $f2 = 1;
        while ($n-- > 2) {
            $f1 += $f2;
            $f2 = $f1-$f2;
        }
    }
    return $f1;
}