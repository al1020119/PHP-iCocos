<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function PrintFromTopToBottom($root)
{
    $quene=array();
    $res=array();
    if($root==null) return $res;
    array_push($quene,$root);
    while(!empty($quene)){
        $tmp=array_shift($quene);
        if($tmp->left!=null){
            array_push($quene,$tmp->left);
        }
        if($tmp->right!=null){
            array_push($quene,$tmp->right);
        }
        array_push($res,$tmp->val);
    }
    return $res;
}