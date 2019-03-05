<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function MySerialize($pRoot)
{
    return serialize($pRoot);
}
function MyDeserialize($s)
{
    return unserialize($s);
}