#composer require phpoffice/phpexcel
use PHPExcel;
    
    /**导出成为Excel
     * @param $name string 要保存的Excel的名字
     * @param $ret_data 转换为表格的二维数组
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    function exportExcel($name, $ret_data){
        $objPHPExcel = new PHPExcel();
        //设置表格
        $objPHPExcel->getProperties()->setCreator($name)
                ->setLastModifiedBy($name)
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
        //填充数据
        foreach ($ret_data as $key => $row) {
            $num = $key + 1;
            //$row = array_values($row);
            $i=0;
            foreach ($row as $key2 => $value2) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue( Cell::stringFromColumnIndex($i). ($num), $value2);
                $i++;
            }
        }
        //设置表格并输出
        $objPHPExcel->getActiveSheet()->setTitle($name);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename={$name}.xls");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    //导入Excel
    function getRows($inputFileName)
    {
        if (!file_exists($inputFileName)) {
            throw new Exception("File not existed");
        }
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
        $row = 1;
        $curr = array();
        while ($row <= $highestRow) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $value = str_replace(array("\n", "\n\r", "\r"), "", $objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
                $curr[$row][] = $value;
            }
            $row++;
        }
        array_shift($curr);//第一行一般是字段名（Excel中列的标题），导入时要移除
        return $curr;
    }
