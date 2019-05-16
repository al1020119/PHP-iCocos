<?php
function get_mobile_location($mobile) {
	if (!isMobile($mobile)) {
		return false;
	}
	$return = array();
	$api = "http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel={$mobile}";
	$string = iconv('gb2312', 'utf-8', file_get_contents($api));
	$string = str_replace(array("\r", "\n", "\r\n", "'"), array('', '', '', ''), $string);
	$string = substr($string, strpos($string, '{') + 1);
	$string = substr($string, 0, strpos($string, '}'));
	$array = explode(',', $string);
	foreach ($array as $var) {
		$ex = explode(':', $var);
		$key = trim($ex[0]);
		$val = trim($ex[1]);
		$return[$key] = $val;
	}
	return $return['province'] . '-' . $return['catName'];
}
function isMobile($mobile = '') {
    return preg_match("/^1[3|4|5|7|8|9][0-9]{9}$/", $mobile) ? true : false;
}