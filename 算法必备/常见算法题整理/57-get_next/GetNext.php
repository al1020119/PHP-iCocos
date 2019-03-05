<?php
/*class TreeLinkNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function GetNext($pNode)
{
    if($pNode==null)
        return null;
    if($pNode->right)
        {
        $pNode=$pNode->right;
        while($pNode->left)
            {
            $pNode=$pNode->left;
        }
        return $pNode;
    }
    else
        while($pNode->next)
            {
            if($pNode->next->left==$pNode)
                return $pNode->next;
            $pNode = $pNode->next;
        }
    return null;
}