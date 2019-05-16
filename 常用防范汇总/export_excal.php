<?php
/*
    导出EXCEL文件
*/
    vendor('PHPExcel.PHPExcel');
    vendor('PHPExcel.PHPExcel.IOFactory');
    vendor('PHPExcel.PHPExcel.Writer.Excel5');
    $PHPExcel = new PHPExcel();
    //输出内容如下：
    $word = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $result = array();//需要输出的信息，字段名$cols的第二维数组的第一个一样
    //例如：
    $result = array(
         array(
            'id'=>'1',
            'username' => '路见不平',
            'names' => '张三',
            'mobile' => '18952732576',
            'campany' => '阿里巴巴',
            'status' => '0'
            ),
         array(
            'id'=>'2',
            'username' => '喜闻乐见',
            'names' => '李四',
            'mobile' => '18952732576',
            'campany' => '腾讯',
            'status' => '1'
            )
        );
    $arr_status=array('男','女');
    $cols = array()//EXCEL表的各列标题
    $cols = array(
        array('id','序号'),
        array('username','会员名'),
        array('names','姓名'),
        array('mobile','手机'),
        array('company','保险公司')
    );
    
    /*例：
    $cols = array(
        array('id','序号'),
        array('username','会员名'),
        array('names','姓名'),
        array('mobile','手机'),
        array('company','保险公司'),
        array('buy_year','购车年份'),
        array('buy_price','购车价格'),
        array('brand','品牌'),
        array('car_plate','车牌号'),
        array('car_city','行驶城市'),
        array('car_type','车辆型号')
      );*/
      foreach($cols as $key => $value){
            $PHPExcel->getActiveSheet()->setCellValue($word[$key].'1',$cols[$key][1]);
        }
    if($result){
            $i = 2;
            $cols_count = count($cols);
            foreach($result as $val){
                $val['status'] = $arr_status[$val['status']];//根据status值的不同赋值不同内容
                for($j=0;$j<$cols_count;$j++){
                    $PHPExcel->getActiveSheet()->setCellValueExplicit($word[$j].$i,$val[$cols[$j][0]],PHPExcel_Cell_DataType::TYPE_STRING);
                    $PHPExcel->getActiveSheet()->getStyle($word[$j].$i)->getNumberFormat()->setFormatCode("@");
                }
                $i++;
            }
        }
        $outputFileName = 'XX信息'.date('YmdHis').'.xls';//导出信息EXCEL文件名
        $xlsWriter = new PHPExcel_Writer_Excel5($PHPExcel);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $xlsWriter->save( "php://output" );
?>