<?php
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function Convert($pRootOfTree)
{
    $root = $pRootOfTree;
    if(!$root){
        return NULL;
    }
    if(!$root->left && !$root->right){
        return $root;
    }
    //left指向比自己小的 right指向比自己大的
    $left = Convert($root->left);
    $tmp = $left;
    while($tmp && $tmp->right){
        $tmp = $tmp->right;
    }
    if($left){
        $root->left = $tmp;
        $tmp->right = $root;       
    }
     
    $right = Convert($root->right);
    if($right){
        $root->right = $right;
        $right->left = $root;       
    }
    return $left?$left:$root;
}