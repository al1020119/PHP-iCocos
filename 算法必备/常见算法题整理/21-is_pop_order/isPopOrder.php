<?php

function IsPopOrder($pushV, $popV)
{
    $stack = new SplStack();
    $len = count($pushV);
    $j = 0;
    for($i=0;$i<$len;$i++){
        $stack->push($pushV[$i]);           
        while($j<$len && $popV[$j]==$stack->top()){
            $stack->pop();
            $j++;
        }
    }
    if($stack->isEmpty()){
        return true;
    }
    return false;
}