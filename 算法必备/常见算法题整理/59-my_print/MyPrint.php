<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function MyPrint($pRoot)
{
    if($pRoot == NULL)
        return [];
    $current = 0;
    $next    = 1;
     
    $stack[0] = array();
    $stack[1] = array();
    $resultQueue = array();
     
    array_push($stack[0], $pRoot);
     
    $i = 0;
    $result = array();
    $result[0]= array();
     
    while(!empty($stack[0]) || !empty($stack[1])){
        $node = array_pop($stack[$current]);
        array_push($result[$i], $node->val);
         
        //var_dump($resultQueue);echo "</br>";
        if($current == 0){
            if($node->left != NULL)
                array_push($stack[$next], $node->left);
            if($node->right != NULL)
                array_push($stack[$next], $node->right);
        }else{
            if($node->right != NULL)
                array_push($stack[$next], $node->right);
            if($node->left != NULL)
                array_push($stack[$next], $node->left);
        }
         
        if(empty($stack[$current])){
            $current = 1-$current;
            $next    = 1-$next;
            if(!empty($stack[0]) || !empty($stack[1])){
                $i++;
                $result[$i] = array();
            }
        }
         
    }
    return $result;
}