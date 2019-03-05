<?php

function LeftRotateString($str, $n)
{
    return preg_replace("/(.{0,$n})(.*)/i", "\$2\$1", $str);
}