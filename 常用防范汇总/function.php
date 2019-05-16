<?php
/*
  实用的应用方法
 */
                  //使用Excel函数前将导入phpexcel  /ThinkPHP/Library/Vendor/PHPExcel
/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file){
    // 判断文件是什么格式
    $type = pathinfo($file); 
    $type = strtolower($type["extension"]);
    $type=$type==='csv' ? $type : 'Excel5';
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file); 
    $sheet = $objPHPExcel->getSheet(0); 
    // 取得总行数 
    $highestRow = $sheet->getHighestRow();     
    // 取得总列数      
    $highestColumn = $sheet->getHighestColumn(); 
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for($j=1;$j<=$highestRow;$j++){
        //从A列读取数据
        for($k='A';$k<=$highestColumn;$k++){
            // 读取单元格
            $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        } 
    }  
    return $data;
}

                      //生成EXCEL函数
/*
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
        $data = array(
            array(NULL, 2010, 2011, 2012),
            array('Q1',   12,   15,   21),
            array('Q2',   56,   73,   86),
            array('Q3',   52,   61,   69),
            array('Q4',   30,   32,    0),
           );
 */
function create_xls($data,$filename='simple.xls'){
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}
/**
     * 删除指定的标签和内容
     * @param array  $tags 需要删除的标签数组
     * @param string $str 数据源
     * @param boole  $content 是否删除标签内的内容 默认为false保留内容  true不保留内容
     * @return string
     */
    function strip_html_tags($tags,$str,$content=false){
        $html=array();
        foreach ($tags as $tag) {
            if($content){
                $html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
            }else{
                $html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
            }
        }
        $data=preg_replace($html, '', $str);
        return $data;
    }

/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
 
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=mt_rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);//将得到的数组key格式化；
    return $data;
}

//排序函数： uasort(array, cmp_function//自定义的排序函数)
//uasort主要是用在需要按照自定义的方法并且保留索引关系对多维数组的排序上；
$sort_array = array(
    "array1" => array(
        'word'=>'test1',
        'sortnumber'=>1,
    ),
    'array3'=>array(
        'word'=>'test4',
        'sortnumber'=>4,
    ),
    'array2'=>array(
        'word'=>'test3',
        'sortnumber'=>3,
    ),
    'array5'=>array(
        'word'=>'test5',
    ),
    'array4'=>array(
        'word'=>'test2',
        'sortnumber'=>2,
    ),
);
// 自定义排序函数
function my_sort($a,$b){
    $prev = isset($a['sortnumber']) ? $a['sortnumber'] : 0;
    $next = isset($b['sortnumber']) ? $b['sortnumber'] : 0;
    if($prev == $next)return 0;
    return ($prev<$next) ? -1 : 1;
}
echo '<pre>排序前:<br>';
print_r($sort_array);
uasort($sort_array, "my_sort");
echo "排序后:<br>";
print_r ($sort_array);


             //filter_var() 验证邮箱、ip、url的格式 php、
/**
 * 验证是否是邮箱
 * @param  string  $email 邮箱
 * @return boolean        是否是邮箱
 */
function is_email($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
 
var_dump(is_email('baijunyao@baijunyao.com'));
// 打印 ture
var_dump(is_email('baijunyao.com'));
// 打印 false


/**
 * 验证是否是url
 * @param  string  $url   url
 * @return boolean        是否是url
 */
function is_url($url){
    if(filter_var($url,FILTER_VALIDATE_URL)){
        return true;
    }else{
        return false;
    }
}
 
var_dump(is_url('http://baijunyao.com'));// 打印 true
var_dump(is_url('baijunyao.com'));// 打印 false
var_dump(is_url('http://a'));// 打印 true


//将FILTER_VALIDATE_URL换成FILTER_VALIDATE_IP就可以验证是否是ip地址了


                   生成二维码
//1：首先将/ThinkPHP/Library/Vendor/下的Phpqrcode文件夹拷贝到自己的项目中；
//2：/Application/Common/Common/function.php增加如下函数
/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');
    // 如果没有http 则添加
    if (strpos($url, 'http')===false) {
        $url='http://'.$url;
    }
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
}
png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4,
 $saveandprint=false, $back_color = 0xFFFFFF, $fore_color = 0x000000);
第一个参数$text；就是上面代码里的URL网址参数；

第二个参数$outfile默认为否；不生成文件；只将二维码图片返回；否则需要给出存放生成二维码图片的路径；

第三个参数$level默认为L；这个参数可传递的值分别是L(QR_ECLEVEL_L，7%)、M(QR_ECLEVEL_M，15%)、Q(QR_ECLEVEL_Q，25%)、H(QR_ECLEVEL_H，30%)；这个参数控制二维码容错率；不同的参数表示二维码可被覆盖的区域百分比。利用二维维码的容错率；我们可以将头像放置在生成的二维码图片任何区域；

第四个参数$size；控制生成图片的大小；默认为4；

第五个参数$margin；控制生成二维码的空白区域大小；

第六个参数$saveandprint；保存二维码图片并显示出来；$outfile必须传递图片路径；

第七个参数$back_color；背景颜色；

第八个参数$fore_color；绘制二维码的颜色；

/*
PHP获取文件大小并格式化
以下使用的函数可以获取文件的大小，并且转换成便于阅读的KB，MB等格式。
 */
function formatSize($size) { 
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB"); 
    if ($size == 0) {  
        return('n/a');  
    } else { 
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);  
    } 
} 
$thefile = filesize('test_file.mp3'); 
echo formatSize($thefile); 

S
/*
   PHP替换标签字符
   有时我们需要将字符串、模板标签替换成指定的内容，可以用到下面的函数：
 */
function stringParser($string,$replacer){ 
    $result = str_replace(array_keys($replacer), array_values($replacer),$string); 
    return $result; 
} 
//演示
$string = 'The {b}anchor text{/b} is the {b}actual word{/b} or words used {br}to describe the link {br}itself'; 
$replace_array = array('{b}' => '<b>','{/b}' => '</b>','{br}' => '<br />'); 
 
echo stringParser($string,$replace_array); 


/*
PHP列出目录下的文件名
如果你想列出目录下的所有文件，使用以下代码即可：
 */
function listDirFiles($DirPath){ 
    if($dir = opendir($DirPath)){ 
         while(($file = readdir($dir))!== false){ 
                if(!is_dir($DirPath.$file)) 
                { 
                    echo "filename: $file<br />"; 
                } 
         } 
    } 
} 


/*
PHP获取当前页面URL
以下函数可以获取当前页面的URL，不管是http还是https。
 */
function curPageURL() { 
    $pageURL = 'http'; 
    if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";} 
    $pageURL .= "://"; 
    if ($_SERVER["SERVER_PORT"] != "80") { 
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
    } else { 
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
    } 
    return $pageURL; 
} 


/*
PHP强制下载文件
有时我们不想让浏览器直接打开文件，如PDF文件，而是要直接下载文件，那么以下函数可以强制下载文件，函数中使用了application/octet-stream头类型。
 */
function download($filename){ //文件地址
    if ((isset($filename))&&(file_exists($filename))){ 
       header("Content-length: ".filesize($filename)); 
       header('Content-Type: application/octet-stream'); 
       header('Content-Disposition: attachment; filename="' . $filename . '"'); 
       readfile("$filename"); 
    } else { 
       echo "Looks like file does not exist!"; 
    } 
} 


/*
   PHP截取字符串长度
我们经常会遇到需要截取字符串(含中文汉字)长度的情况，比如标题显示不能超过多少字符，超出的长度用...表示，以下函数可以满足你的需求
 */
/* 
 Utf-8、gb2312都支持的汉字截取函数 
 cut_str(字符串, 截取长度, 开始长度, 编码); 
 编码默认为 utf-8 
 开始长度默认为 0 
*/ 
function cutStr($string, $sublen, $start = 0, $code = 'UTF-8'){ 
    if($code == 'UTF-8'){ 
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
        preg_match_all($pa, $string, $t_string); 
 
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."..."; 
        return join('', array_slice($t_string[0], $start, $sublen)); 
    }else{ 
        $start = $start*2; 
        $sublen = $sublen*2; 
        $strlen = strlen($string); 
        $tmpstr = ''; 
 
        for($i=0; $i<$strlen; $i++){ 
            if($i>=$start && $i<($start+$sublen)){ 
                if(ord(substr($string, $i, 1))>129){ 
                    $tmpstr.= substr($string, $i, 2); 
                }else{ 
                    $tmpstr.= substr($string, $i, 1); 
                } 
            } 
            if(ord(substr($string, $i, 1))>129) $i++; 
        } 
        if(strlen($tmpstr)<$strlen ) $tmpstr.= "..."; 
        return $tmpstr; 
    } 
} 
/*
PHP获取客户端真实IP
我们经常要用数据库记录用户的IP，以下代码可以获取客户端真实的IP：
 */
function getIp() { 
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
    else 
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else 
            if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
                $ip = getenv("REMOTE_ADDR"); 
            else 
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
                    $ip = $_SERVER['REMOTE_ADDR']; 
                else 
                    $ip = "unknown"; 
    return ($ip); 
} 
/*
PHP页面提示与跳转
我们在进行表单操作时，有时为了友好需要提示用户操作结果，并跳转到相关页面，请看以下函数：
 */
function message($msgTitle,$message,$jumpUrl){ 
    $str = '<!DOCTYPE HTML>'; 
    $str .= '<html>'; 
    $str .= '<head>'; 
    $str .= '<meta charset="utf-8">'; 
    $str .= '<title>页面提示</title>'; 
    $str .= '<style type="text/css">'; 
    $str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}'; 
    $str .= '</style>'; 
    $str .= '</head>'; 
    $str .= '<body>'; 
    $str .= '<div class="message">'; 
    $str .= '<h3>'.$msgTitle.'</h3>'; 
    $str .= '<div class="msg_txt">'; 
    $str .= '<h4 class="red">'.$message.'</h4>'; 
    $str .= '<p>系统将在 <span style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="{$jumpUrl}">这里</a> 跳转</p>'; 
    $str .= "<script>setTimeout('location.replace(\'".$jumpUrl."\')',2000)</script>"; 
    $str .= '</div>'; 
    $str .= '</div>'; 
    $str .= '</body>'; 
    $str .= '</html>'; 
    echo $str; 
} 
//演示、
message('操作提示','操作成功！','http://www.helloweba.com/'); 


/*
PHP计算时长
我们在处理时间时，需要计算当前时间距离某个时间点的时长，如计算客户端运行时长，通常用hh:mm:ss表示。
 */
function changeTimeType($seconds) { 
    if ($seconds > 3600) { 
        $hours = intval($seconds / 3600); 
        $minutes = $seconds % 3600; 
        $time = $hours . ":" . gmstrftime('%M:%S', $minutes); 
    } else { 
        $time = gmstrftime('%H:%M:%S', $seconds); 
    } 
    return $time; 
} 

/*
  PHP获取当前月份第一天和最后一天
我们在做统计查询时，经常要查询某个月的数据，就是从当月的第一天到最后一天，那么这个日期的获取整理成一个函数直接调用，请看
 */
function getthemonth($date){ 
   $firstday = date('Y-m-01', strtotime($date)); 
   $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day")); 
   return array($firstday,$lastday); 
} 
$today = date("Y-m-d"); 
$day=getthemonth($today); 
echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1]; 

/*
PHP搜索和高亮显示字符串中的关键字
当我们需要将搜索结果高亮显示的时候，可以使用以下函数：
 */
function highlighter($text, $words) {  
  $split_words = explode(" " , $words );  
  foreach($split_words as $word) {  
    $color = "#4285F4";  
    $text = preg_replace("/($word)/i" , "<span style=\"color:".$color.";\"><b>$1</b></span>", $text );  
  }  
  return $text;  
} 
//实例
$string = "基于Zepto的内容滑动插件：zepto.hwSlider.js";  
$words = "zepto";  
echo highlighter($string ,$words); 