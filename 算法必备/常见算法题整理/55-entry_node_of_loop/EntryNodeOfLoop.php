<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function EntryNodeOfLoop($pHead)
{
    if($pHead == NULL || $pHead->next == NULL){
        return NULL;
    }
    $p1 = $pHead;
    $p2 = $pHead->next;
    while($p2){
        $tmp = $p2->next;
        $p1->next = NULL;
        $p1 = $p2;
        $p2 = $tmp;
    }
    return $p1;
}