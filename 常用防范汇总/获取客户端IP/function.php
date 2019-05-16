<?php
/**
 * 获取客户端IP
 * @return [string] [description]
 */
function getClientIp() {
 $ip = NULL;
 if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
  $pos = array_search('unknown',$arr);
  if(false !== $pos) unset($arr[$pos]);
  $ip = trim($arr[0]);
 }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
 }elseif (isset($_SERVER['REMOTE_ADDR'])) {
  $ip = $_SERVER['REMOTE_ADDR'];
 }
 // IP地址合法验证
 $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
 return $ip;
}
 
/**
 * 获取在线IP
 * @return String
 */
function getOnlineIp($format=0) {
 global $S_GLOBAL;
 if(empty($S_GLOBAL['onlineip'])) {
  if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
   $onlineip = getenv('HTTP_CLIENT_IP');
  } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
   $onlineip = getenv('HTTP_X_FORWARDED_FOR');
  } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
   $onlineip = getenv('REMOTE_ADDR');
  } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
   $onlineip = $_SERVER['REMOTE_ADDR'];
  }
  preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
  $S_GLOBAL['onlineip'] = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
 }
 
 if($format) {
  $ips = explode('.', $S_GLOBAL['onlineip']);
  for($i=0;$i<3;$i++) {
   $ips[$i] = intval($ips[$i]);
  }
  return sprintf('%03d%03d%03d', $ips[0], $ips[1], $ips[2]);
 } else {
  return $S_GLOBAL['onlineip'];
 }
}