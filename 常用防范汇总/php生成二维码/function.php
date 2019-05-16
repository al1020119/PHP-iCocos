<?php
//应用phpqrcode之前应该先将phprqrcode导入到TP的vendor文件夹下
   function createqrcode($save_path,$url){
		vendor("phpqrcode.phpqrcode");
		$dir= dirname($save_path);
		if(!is_dir($dir))mkdir($dir,0755);
		if(!is_file($save_path))
			QRcode::png($url,$save_path,"H",5);
	}
?>