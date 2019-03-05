<?php
/*
解析：
在本体中只有两种跳法即，一阶或者两两阶
a.那么假定第一次跳的是一阶，那么剩下的是n-1个台阶，跳法是f(n-1);
b.假定第一次跳的是2阶，那么剩下的是n-2个台阶，跳法是f(n-2)
c.由a和b假设可以得出总跳法为: f(n) = f(n-1) + f(n-2) 
d.然后通过实际的情况可以得出：只有一阶的时候 f(1) = 1 ,只有两阶的时候可以有 f(2) = 2
e.可以发现最终得出的是一个斐波那契数列：
          | 1, (n=1)
f(n) =    | 2, (n=2)
          | f(n-1)+f(n-2) ,(n>2,n为整数)
采用迭代比递归效率高
*/
function jumpFloor($number)
{
    $value=0;
    if($number==1){
        $value = 1;
    }else if($number==2){
        $value = 2;
    }else{
        $f1 = 1; $f2 = 2;
        for($i=3;$i<=$number;$i++){
            $value = $f1+$f2;
            $f1 = $f2;
            $f2 = $value;
        }
    }
    return $value; 
}