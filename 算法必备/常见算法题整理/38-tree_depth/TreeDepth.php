<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function TreeDepth($pRoot)
{
    if($pRoot == null)
        return 0;
    $l = TreeDepth($pRoot->left);
    $r = TreeDepth($pRoot->right);
    return $l > $r ? $l+1 : $r +1;
}