<?php

$bigTop = new SplMaxHeap();
$smallTop = new SplMinHeap();
 
function Insert($num)
{
    // write code here
    global $bigTop;
    global $smallTop;
    //保证小顶堆的数 都大于大顶堆的数 其实就是小顶堆的顶 大于大顶堆的顶
    if($smallTop->isEmpty() || $num >= $smallTop->top()){
        $smallTop->insert($num);
    }else{
        $bigTop->insert($num);
    }
    if($smallTop->count() == $bigTop->count() + 2) $bigTop->insert($smallTop->extract());
    if($smallTop->count() + 1 == $bigTop->count()) $smallTop->insert($bigTop->extract());
}
function GetMedian(){
    // write code here
    global $bigTop;
    global $smallTop;
    return $smallTop->count() == $bigTop->count() ? ($smallTop->top() + $bigTop->top())/2 : $smallTop->top();
}