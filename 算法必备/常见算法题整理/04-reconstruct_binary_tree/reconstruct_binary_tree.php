<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/

/*
假设：
     1
    / \
   2   3
  / \ / \
 4  5 6  7
    1、先序遍历第一个位置肯定是根节点node，
    2、中序遍历的根节点位置在中间p，在p左边的肯定是node的左子树的中序数组，p右边的肯定是node的右子树的中序数组
    另一方面，先序遍历的第二个位置到p，也是node左子树的先序子数组，剩下p右边的就是node的右子树的先序子数组
    把四个数组找出来，分左右递归调用即可 
*/
function reConstructBinaryTree($pre, $vin)
{
    if($pre && $vin){
        $treeRoot = new TreeNode($pre[0]);
        $index = array_search($pre[0],$vin);
        $treeRoot->left = reConstructBinaryTree(array_slice($pre,1,$index),array_slice($vin,0,$index));
        $treeRoot->right = reConstructBinaryTree(array_slice($pre,$index+1),array_slice($vin,$index+1));
        return $treeRoot;
    }
 
}