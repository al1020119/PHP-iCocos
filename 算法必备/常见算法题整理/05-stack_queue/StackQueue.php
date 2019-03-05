<?php
 $stack = [];
function mypush($node)
{   global $stack;
    return $stack[]=$node;
}
function mypop()
{  
    global $stack;
    if($stack){
        return array_shift($stack);
    }
 return $stack;
}