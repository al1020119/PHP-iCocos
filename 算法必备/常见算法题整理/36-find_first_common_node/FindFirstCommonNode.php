<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function FindFirstCommonNode($pHead1, $pHead2)
{
    if ($pHead1 == NULL || $pHead2 == NULL) {
        return NULL;
    }
    $arrData1 = array();
    $arrData2 = array();
    while ($pHead1 != NULL) {
        $arrData1[] = $pHead1;
        $pHead1 = $pHead1->next;
    }
    while ($pHead2 != NULL) {
        $arrData2[] = $pHead2;
        $pHead2 = $pHead2->next;
    }
    $pFirstCommon = NULL;
    while (!empty($arrData1) && !empty($arrData2)) {
        $pNode = array_pop($arrData1);
        $pNode2 = array_pop($arrData2);
        if ($pNode->val == $pNode2->val) {
            $pFirstCommon = $pNode;
        } else {
            break;
        }
    }
    return $pFirstCommon;
}