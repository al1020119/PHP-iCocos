<?php
//Init module if you need
function Init(){
    $GLOBALS['once']=[];
}
//Insert one char from stringstream
function Insert($ch)
{
    // write code here
    if(isset($GLOBALS['once'][$ch])&&$GLOBALS['once'][$ch]!='#'){
        $GLOBALS['once'][$ch]=0;
    }else{
        $GLOBALS['once'][$ch]=1;
    }
}
//return the first appearence once char in current stringstream
function FirstAppearingOnce()
{
    // write code here
    foreach($GLOBALS['once'] as $key=>$a){
        if($a){
            return $key;
        }
    }
    return '#';
}