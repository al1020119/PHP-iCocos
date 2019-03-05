<?php

function PrintMinNumber($numbers)
{
    usort($numbers, function($a,$b){
       if("$a$b" > "$b$a") return 1;
        return -1;
    });
    return implode("",$numbers);
}