<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel {

    private $spreadsheet;
    private $column_headers = array();

    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
    }

    function excelToArray($filePath, $header = true) {
        //Create excel reader after determining the file type
        $inputFileName = $filePath;
        /**  Identify the type of $inputFileName  * */
        $inputFileType = IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type that has been identified  * */
        $objReader = IOFactory::createReader($inputFileType);
        /** Set read type to read cell data onl * */
        $objReader->setReadDataOnly(true);
        /**  Load $inputFileName to a PHPExcel Object  * */
        $objPHPExcel = $objReader->load($inputFileName);
        //Get worksheet and built array with first row as header
        $objWorksheet = $objPHPExcel->getActiveSheet();
        //excel with first row header, use header as key
        if ($header) {
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();
            $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
            $headingsArray = $headingsArray[1];
            $r = -1;
            $namedDataArray = array();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    foreach ($headingsArray as $columnKey => $columnHeading) {
                        $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                    }
                }
            }
        } else {
            //excel sheet with no header
            $namedDataArray = $objWorksheet->toArray(null, true, true, true);
        }
        return $namedDataArray;
    }

    public function save($path) {
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($path);
    }

    public function stream($filename, $data = null) {
        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $this->spreadsheet->getActiveSheet()->getCell($col . '1')->setValue($val);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $key => $row) {
                if ($key != 0) {
                    $col = 'A';
                    foreach ($row as $cell) {
                        $this->spreadsheet->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                        $col++;
                    }
                    $rowNumber++;
                }
            }
        }

        $this->save($filename);
    }

    public function __call($name, $arguments) {
        if (method_exists($this->spreadsheet, $name)) {
            return call_user_func_array(array($this->spreadsheet, $name), $arguments);
        }
        return null;
    }

}
