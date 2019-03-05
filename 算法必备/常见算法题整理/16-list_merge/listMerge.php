<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function Merge($pHead1, $pHead2)
{
    if($pHead1 == NULL)
        return $pHead2;
    elseif($pHead2 == NULL)
        return $pHead1;
    $pMergeHead = new ListNode(null);
    if($pHead1->val < $pHead2->val){
        $pMergeHead = $pHead1;
        $pMergeHead->next = Merge($pHead1->next, $pHead2);
    }else{
        $pMergeHead = $pHead2;
        $pMergeHead->next = Merge($pHead1, $pHead2->next);
    }
    return $pMergeHead;
}