<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function IsBalanced_Solution($pRoot)
{
    $height = 0;
    return isBalanced($pRoot, $height);
}
 
function isBalanced($pRoot, &$height)
{
    if ($pRoot == null)
        return true;
    $left = 0;
    $right = 0;
    if (!isBalanced($pRoot->left, $left)) return false;
    if (!isBalanced($pRoot->right, $right)) return false;
    if (abs($left - $right) > 1)
        return false;
    $height = max($left, $right) + 1;
    return true;
}