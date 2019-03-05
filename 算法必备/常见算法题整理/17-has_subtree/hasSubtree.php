<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function HasSubtree($pRoot1, $pRoot2)
{
        // write code here
   $re = false;
    if($pRoot1!=null && $pRoot2 != null)
        {
        if($pRoot1->val==$pRoot2->val)
            $re = isSubtree($pRoot1,$pRoot2);
        if(!$re)
            $re = HasSubtree($pRoot1->left, $pRoot2);
        if(!$re)
            $re = HasSubtree($pRoot1->right, $pRoot2);
    }
    return $re;
}
function isSubtree($pRoot1,$pRoot2){
    if($pRoot2 == null) return true;
    if($pRoot1 == null) return false;
    if($pRoot1->val != $pRoot2->val) return false;
    return isSubtree($pRoot1->left,$pRoot2->left)&&isSubtree($pRoot1->right,$pRoot2->right);
}