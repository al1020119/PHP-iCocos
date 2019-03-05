<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function FindPath($root, $expectNumber)
{
    if($root==null){
        return [];
    }
    $stack = array($root);
    $result = array();
    while(count($stack)!=0){
        $topnode = end($stack);
        while ($topnode->left != null || $topnode->right!= null){
            if($topnode->left != null){
                $stack[] = $topnode->left;
                $p = $topnode->left;
                $topnode->left = null;
                $topnode = $p;
            }elseif ($topnode->right != null){
                $stack[] = $topnode->right;
                $p = $topnode->right;
                $topnode->right = null;
                $topnode = $p;
            }
        }
        $sum = 0;
        $sub_paths = array();
        foreach ($stack as $node){
            $sum += $node->val;
            $sub_paths[] = $node->val;
            if($sum>$expectNumber){
                break;
            }
        }
        if($sum==$expectNumber){
            $result[] = $sub_paths;
        }
        while($topnode->left == null && $topnode->right== null){
            array_pop($stack);
            if(count($stack)==0){
                return $result;
            }
            $topnode = end($stack);
        }
    }
    return result;
}