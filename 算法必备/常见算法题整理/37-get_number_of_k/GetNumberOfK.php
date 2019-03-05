<?php

function GetNumberOfK($data, $k)
{
    $c= array_count_values($data);
    return isset($c[$k])?$c[$k]:0;
}