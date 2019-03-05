<?php

/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function printListFromTailToHead($head)
{
    $list = [];
    while($head != null){
        $list[] = $head->val;
        $head = $head->next;
    }
    return array_reverse($list);
}