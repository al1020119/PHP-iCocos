<?php

function ReverseSentence($str)
{
    return implode(' ', array_reverse(explode(' ', $str)));
}