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
    $q = new SplQueue();
    if(!$pRoot){
        return [];
    }
    $result = [];
    $i=0;
    $q->push($pRoot);
    while(!$q->isEmpty()){
        $count = $q->count();
        while($count--){
            $t = $q->shift();
            if($t){
                $result[$i][] = $t->val;
                $q->push($t->left);
                $q->push($t->right);
            }
        }
        $i++;
    }
    return $result;
}