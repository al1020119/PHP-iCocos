<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function ReverseList($pHead)
{
    if($pHead == null){
        return null;
    }
    $pre = null;
    while($pHead != null){
        $tmp = $pHead->next;
        $pHead->next = $pre;
        $pre = $pHead;
        $pHead = $tmp;
    }
    return $pre;
}