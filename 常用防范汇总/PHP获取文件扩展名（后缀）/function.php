<?php
function getExtension($filename){ 
  $myext = substr($filename, strrpos($filename, '.')); 
  return str_replace('.','',$myext); 
} 