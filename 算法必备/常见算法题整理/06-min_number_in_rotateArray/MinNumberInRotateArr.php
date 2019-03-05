<?php
/*
解析：
采用二分法解答这个问题，
mid = low + (high - low)/2
需要考虑三种情况：
(1)array[mid] > array[high]:
出现这种情况的array类似[3,4,5,6,0,1,2]，此时最小数字一定在mid的右边。
low = mid + 1
(2)array[mid] == array[high]:
出现这种情况的array类似 [1,0,1,1,1] 或者[1,1,1,0,1]，此时最小数字不好判断在mid左边
还是右边,这时只好一个一个试 ，
high = high - 1
(3)array[mid] < array[high]:
出现这种情况的array类似[2,2,3,4,5,6,6],此时最小数字一定就是array[mid]或者在mid的左
边。因为右边必然都是递增的。
high = mid
注意这里有个坑：如果待查询的范围最后只剩两个数，那么mid 一定会指向下标靠前的数字
比如 array = [4,6]
array[low] = 4 ;array[mid] = 4 ; array[high] = 6 ;
如果high = mid - 1，就会产生错误， 因此high = mid
但情形(1)中low = mid + 1就不会错误
*/
function minNumberInRotateArray($rotateArray)
{
    #第一种方法
    $low = 0;
    $high = count($rotateArray)-1;
    while($low < $high){
        $mid = $low + floor(($high - $low)/2);
        if($rotateArray[$mid] > $rotateArray[$high])
            $low = $mid+1;
        elseif($rotateArray[$mid] == $rotateArray[$high])
            $high = $high - 1;
        else
            $high = $mid;
    }
     return $rotateArray[$low];
     /* 
    #第二种方法
    return min($rotateArray);
    */
}