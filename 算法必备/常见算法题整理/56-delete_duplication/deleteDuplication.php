<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function deleteDuplication($pHead)
{
    if($pHead==null){
        return null;
    }
    if($pHead!=null&&$pHead->next==null){
        return $pHead;
    }
    $cur = $pHead;
    if($pHead->next->val==$pHead->val){
        $cur = $pHead->next->next;
        while($cur!=null&&$cur->val==$pHead->val){
            $cur = $cur->next;
        }
        return deleteDuplication($cur);
    }else{
        $cur = $pHead->next;
        $pHead->next = deleteDuplication($cur);
        return $pHead;
    }
}