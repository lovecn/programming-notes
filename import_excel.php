/*
 * $path excel文件路径
 * $header_mapping 文字和数据库字段的对应关系
 * excel第一行 是 字段标准(通常是汉字)，
 * example
 * $header_mapping = [ '姓名' => 'uid' ];
 *
 */
private function readExcel( $path,$header_mapping = []){
        $objPHPExcel = PHPExcel_IOFactory::load( $path );
        //选择标签页
 
        $sheet = $objPHPExcel->getSheet(0);
 
        //获取行数与列数,注意列数需要转换
        $highestRowNum = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $usefullColumnNum = $highestColumnNum;
 
        //取得字段，这里测试表格中的第一行为数据的字段，因此先取出用来作后面数组的键名
        $filed = array();
        for($i=0; $i<$highestColumnNum;$i++){
            $cellName = PHPExcel_Cell::stringFromColumnIndex($i).'1';
            $cellVal = $sheet->getCell($cellName)->getValue();//取得列内容
            if( !$cellVal ){
                break;
            }
            $usefullColumnNum = $i;
            $filed []= $cellVal;
        }
 
        //开始取出数据并存入数组
        $data = [];
        for( $i=2; $i <= $highestRowNum ;$i++ ){//ignore row 1
            $row = array();
            for( $j = 0; $j <= $usefullColumnNum;$j++ ){
                if( !isset($header_mapping[ $filed[$j] ]) ){
                    continue;
                }
                $cellName = PHPExcel_Cell::stringFromColumnIndex($j).$i;
                $cellVal = $sheet->getCell($cellName)->getValue();
                if($cellVal instanceof PHPExcel_RichText){ //富文本转换字符串
                    $cellVal = $cellVal->__toString();
                }
 
                $fd = $header_mapping[ $filed[$j] ];
                $row[ $fd ] = $cellVal;
            }
            $data []= $row;
        }
        return $data;
}
 
/*
 * excel日期转化https://github.com/PHPOffice/PHPExcel
 * excel中日期读取出来是个数字，需要转化
 **/
private function excelTime( $date ){
    $date = date("Y-m-d",PHPExcel_Shared_Date::ExcelToPHP($date) );
    return  $date;
}
