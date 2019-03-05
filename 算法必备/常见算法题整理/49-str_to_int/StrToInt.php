<?php

function StrToInt($str)
{
    if(is_numeric($str))
        return $str+0;
    else
        return 0;
}