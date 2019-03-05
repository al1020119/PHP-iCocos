<?php

function VerifySquenceOfBST($sequence)
{
    $size = count($sequence);if ($size==0) {return false;}
    $i = 0;
    while ($size--) {
        while ($sequence[$i++]<$sequence[$size]);
        while ($sequence[$i++]>$sequence[$size]);
         
        if ($i<$size) {
            return false;
        }
        $i=0;
    }
    return true;
}