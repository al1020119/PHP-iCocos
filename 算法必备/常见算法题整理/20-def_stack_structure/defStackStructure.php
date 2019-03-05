<?php
$stack = new SplStack();
$stackM = new SplStack();
 
function mypush($node)
{
    // write code here
    global $stack;
    global $stackM;
    $stack->push($node);
    if($stackM->isEmpty() || $stackM->top()>$node){
        $stackM->push($node);
    }
}
function mypop()
{
    // write code here
    global $stack;
    global $stackM;
    $node = $stack->pop();
    if($node == $stackM->top()){
        $stackM->pop();
    }
    return $node;
}
function mytop()
{
    // write code here
    global $stack;
    return $stack->top();
}
function mymin()
{
    // write code here
    global $stackM;
    return $stackM->top();
}