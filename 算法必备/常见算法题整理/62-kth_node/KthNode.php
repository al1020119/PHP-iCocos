<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function KthNode($pRoot, $k)
{
    return deal($pRoot, $k);
}
 
function deal($root, &$k){
    if(!$root){
        return NULL;
    }
    $t = deal($root->left, $k);
    if($t) return $t;
    if(--$k == 0){
        return $root;
    }
    $t = deal($root->right, $k);
    if($t) return $t;
}