<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function isSymmetrical($pRoot)
{
    if($pRoot==null)
        return true;
    return comRoot($pRoot->left,$pRoot->right);
}
  
function comRoot($left,$right)
{
    if($left==null&&$right==null)
        return true;
    if(($right==null&&$right!=null)||($right!=null&&$right==null))
        return false;
    if($left->val!=$right->val)
        return false;
    return comRoot($left->right,$right->left) && comRoot($left->left,$right->right);
}