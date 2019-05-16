<?php
/*
多文件上传类
 */
 class UpFile{
 private $maxsize = '1000000'; //允许上传文件最大长度
 private $allowtype = array('jpg','png','gif','jpeg');//允许上传文件类型
 private $israndfile = true;//是否随机文件名
 private $filepath;//上传路径
 private $originName;//上传的源文件
 private $tmpfileName;//临时文件名
 private $newfileName;//新文件名
 private $fileSize;//文件大小
 private $fileType;//文件类型
 private $errorNum = 0;//错误号
 private $errorMessg = array();//错误消息
 //对成员初始化
 function __construct($options = array()){
 foreach($options as $key=>$val){
  $key = strtolower($key);
  //查看传进来的数组里下标是否与成员属性相同
  //print_r(array_keys(get_class_vars(get_class($this))));
  if(!in_array($key,array_keys(get_class_vars(get_class($this))))){
  continue;
  }else{
  $this->setOption($key,$val);
  }
 }
 }
 private function setOption($key,$val){
   $this->$key = $val;
 //echo $this->errorNum."<br>";
 }
 //检查文件上传路径
 private function checkfilePath(){
 //echo $this->filepath;
 if(empty($this->filepath)){
  $this->setOption('errorNum',"-5");
  return false;
 }
 if(!file_exists($this->filepath) || !is_writable($this->filepath)){
  if(!@mkdir($this->filepath,0755)){
  $this->setOption('errorNum','-4');
  return false;
  }
 }
 return true;
 }
 //获取错误信息
 private function getError(){
 $str = "上传文件{$this->originName}出错---";
 switch($this->errorNum){
  case 4; $str .= "没有文件被上传";break;
  case 3; $str .= "文件只被部分上传";break;
  case 2; $str .= "超过文件表单允许大小";break;
  case 1; $str .= "超过php.ini中允许大小";break;
  case -1; $str .= "未允许的类型";break;
  case -2; $str .= "文件过大，不能超过".$this->maxsize."个字节";break;
  case -3; $str .= "上传失败";break;
  case -4; $str .= "建立文件上传目录失败";break;
  case -5; $str .= "必须指定上传路径";break;
  default; $str .= "未知错误";
 }
 return $str."<br>";
 }
 //检查文件类型
 private function checkfileType(){
 //echo $this->fileType;
 if(!in_array(strtolower($this->fileType),$this->allowtype)){
 $this->setOption('errorNum','-1');
  return false;
 }else{
  return true;
 }
 }
 //检查文件大小
 private function checkfileSize(){
 if($this->fileSize > $this->maxsize){
  $this->setOption('errorNum','-2');
  return false;
 }else{
  return true;
 }
 }
 //处理随机文件名称
 private function prorandFile(){
 $ch = $this->israndfile;
 if($ch == 'true'){
  return true;
 }else{
  return false;
 }
 }
 //
 private function setFiles($name="",$tmp_name="",$size="",$error=""){
 //检查上传路径
 if(!$this->checkfilePath()){
  //$this->errorMessg = $this->getError();
  return false;
 }
 //echo $error."<br>";
 if($error){
 $this->setOption('errorNum',$error);
  return false;
 }
 $arrstr  = explode('.',$name);
 $type   = end($arrstr);
 $this->setOption('originName',$name);
 $this->setOption('fileSize',$size);
 $this->setOption('fileType',$type);
 $this->setOption('tmpfileName',$tmp_name);
 return true;
 }
 //检查是否有文件上传
 function checkFile($formname){
 if(!@$_FILES[$formname]){
  $this->setOption('errorNum',4);
  return false;
 }else{
  return true;
 }
 }
 //上传文件
 function uploadeFile($formname){
 if(!$this->checkFile($formname)){
  $this->errorMessg = $this->getError();
  return false;
 }
 $return  = true;
 $name   = @$_FILES[$formname]['name'];
 $tmp_name = @$_FILES[$formname]['tmp_name'];
 $size   = @$_FILES[$formname]['size'];
 $error  = @$_FILES[$formname]['error'];
 //$type   = $_FILES[$formname]['type'];
 if(is_array($name)){
  $errors = array();
  for($i=0; $i<count($name); $i++){
  if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
   if(!$this->checkfileSize() || !$this->checkfileType()){
   $errors[] = $this->getError();
   $return = false;
   }
  }else{
   $errors[] = $this->getError();
   $return = false;
  }
  if(!$return) $this->setFiles();
  }
  if($return){
  $newfileN = array();
  for($i=0; $i<count($name); $i++){
   if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
   if(!$this->copyFile()){
    $errors[] = $this->getError();
    $return = false;
   }else{
    $newfileN[] = $this->newfileName;
   }
   }
   $this->newfileName = $newfileN;
  }
  }
  //print_r($errors);
  $this->errorMessg = $errors;
  //echo $errors;
  return $return;
 }else{
  if($this->setFiles($name,$tmp_name,$size,$error)){
  $return = true;
  if($error) var_dump($error);
  if($this->checkfileSize() && $this->checkfileType()){
  }else{
   $return = false;
  }
  }else{
  $return = false;
  }
  if(!$return){
  $this->errorMessg = $this->getError();
  }
  return $return;
 }
 }
 //获取上传后的文件名
 function getnewFile(){
  return $this->newfileName;
 }
 //把文件拷贝到指定的路径
 function copyFile(){
 $filepath = rtrim($this->filepath,'/')."/";
 if(!$this->errorNum){
  if($this->prorandFile()){
   $this->newfileName = date('Ymdhis').rand(1000,9999).".".$this->fileType;
  }else{
   $this->newfileName = $this->originName;
  }
  if(!move_uploaded_file($this->tmpfileName,$filepath.$this->newfileName)){
  $this->setOption('errorNum',-3);
  return false;
  }else{
  $this->newfileName = $filepath.$this->newfileName;	
  return true;
  }
 }else{
  return false;
 }
 }
 //上传错误后返回的消息
 function gteerror(){
  $err = $this->errorMessg;
 return $err;
 }
 }
?>