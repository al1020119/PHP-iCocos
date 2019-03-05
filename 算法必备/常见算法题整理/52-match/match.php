<?php

function match($s, $pattern)
{
    if($pattern == "" && $s!="") return false;
    return preg_match("/^$pattern$/",$s);
}