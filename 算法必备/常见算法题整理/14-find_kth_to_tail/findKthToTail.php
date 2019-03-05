<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function FindKthToTail($head, $k)
{
    $count = 0;
    $node = $head;
    while($head != null){
        $count++;
        $head = $head->next;
    }
    if ($count < $k)
        return null;
    for($j = 0; $j<$count-$k; $j++)
        $node = $node->next;
    return $node;
}