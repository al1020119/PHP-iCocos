<?php

function printMatrix($matrix)
{
     $row = count($matrix);
    $col = count($matrix[0]);
    $len = $row * $col;
    $top = 0; $x = 0; $y = 0;
    $list = array();
    while($top+1 < $len){
        while($y+1 < $col && $matrix[$x][$y+1] !== null){
            array_push($list, $matrix[$x][$y]);
            $matrix[$x][$y] = null;
            $y++;
            $top++;
        }
        while($x+1 < $row && $matrix[$x+1][$y] !== null){
            array_push($list, $matrix[$x][$y]);
            $matrix[$x][$y] = null;
            $x++;
            $top++;
        }
        while($y-1 >= 0 && $matrix[$x][$y-1] !== null){
            array_push($list, $matrix[$x][$y]);
            $matrix[$x][$y] = null;
            $y--;
            $top++;
        }
        while($x-1 >= 0 && $matrix[$x-1][$y] != null){
            array_push($list, $matrix[$x][$y]);
            $matrix[$x][$y] = null;
            $x--;
            $top++;
        }
    }
    array_push($list, $matrix[$x][$y]);
    return $list;
}