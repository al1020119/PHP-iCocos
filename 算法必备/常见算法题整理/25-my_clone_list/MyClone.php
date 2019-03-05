<?php
/*class RandomListNode{
    var $label;
    var $next = NULL;
    var $random = NULL;
    function __construct($x){
        $this->label = $x;
    }
}*/
function MyClone($pHead)
{
    if($pHead == null)
        return null;
    $head = new RandomListNode($pHead->label);
    $tmp = $head;
    while($pHead != null){
        $tmp->label = $pHead->label;
        $tmp->next = $pHead->next;
        $tmp->random = $pHead->random;
        $pHead = $pHead->next;
        $tmp = $tmp->next;
    }
    return $head;
}