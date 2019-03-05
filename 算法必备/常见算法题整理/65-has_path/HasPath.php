<?php

function hasPath($matrix, $rows, $cols, $path)
{
    // write code here
    $m = str_split($matrix,$cols);
    $visited = [];
    for($i=0; $i<$rows; $i++){
        for($j=0; $j<$cols; $j++){
            if(back($m,$rows,$cols,$i,$j,$path,$visited)){
                return true;
            }
        }
    }
    return false;
}
 
function back(&$m,&$rows,&$cols,$i,$j,$path,&$v)
{
    if($i<0 || $j<0|| $cols<=$j || $rows<=$i || $v[$i][$j]==1){
        return false;
    }
    $v[$i][$j] = 1;
    if(substr($path,0,1)==$m[$i][$j]){
        if(strlen($path)==1){
            return true;
        }
          if(back($m,$rows,$cols,$i+1,$j,substr($path,1),$v)||
             back($m,$rows,$cols,$i-1,$j,substr($path,1),$v)||
             back($m,$rows,$cols,$i,$j+1,substr($path,1),$v)||
             back($m,$rows,$cols,$i,$j-1,substr($path,1),$v)){
             return true;
            }
    }
    $v[$i][$j] = 0;
    return false;
}