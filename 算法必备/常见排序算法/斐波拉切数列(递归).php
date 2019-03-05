<?php
/*
 * 斐波拉切数列(递归)
 */


function feb($a,$b){
    $c = $a + $b;
    echo $c.'<br/>';
    if($c <=500){
        feb($b,$c);
    }
}

echo '1'.'<br/>';
echo '1'.'<br/>';
feb(1,1);


?>