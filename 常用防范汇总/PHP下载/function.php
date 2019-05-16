<?php
/**
 * 下载
 * @param [type] $filename [description]
 * @param string $dir  [description]
 * @return [type]   [description]
 */
function downloads($filename,$dir='./'){
 $filepath = $dir.$filename;
 if (!file_exists($filepath)){
  header("Content-type: text/html; charset=utf-8");
  echo "File not found!";
  exit;
 } else {
  $file = fopen($filepath,"r");
  Header("Content-type: application/octet-stream");
  Header("Accept-Ranges: bytes");
  Header("Accept-Length: ".filesize($filepath));
  Header("Content-Disposition: attachment; filename=".$filename);
  echo fread($file, filesize($filepath));
  fclose($file);
 }
}
 