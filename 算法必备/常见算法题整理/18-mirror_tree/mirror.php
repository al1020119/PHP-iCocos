<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function Mirror(&$root)
{
    if(!$root){
        return;
    }
    $temp1 = $temp2 = NULL;
    if($root->left){
        $temp1 = Mirror($root->left);
    }
    if($root->right){
        $temp2 = Mirror($root->right);
    }
    $root->left = $temp2;
    $root->right = $temp1;
    return $root;
}