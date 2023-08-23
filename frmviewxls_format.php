<?php
require_once '../../PHPExcel/PHPExcel.php';
include("../../configuration.php");
include("../../connection.php");

$xname = $_SESSION[$domainApp."_myname"];
$xgroup = $_SESSION[$domainApp."_mygroup"];

$excel = new PHPExcel();

$excel->getProperties()->setCreator('PT Karyamitra Budisentosa')
             ->setLastModifiedBy($xname)
             ->setTitle("Format Upload Price List")
             ->setSubject("Format Upload Price List")
             ->setDescription("Format Upload Price List")
             ->setKeywords("Format Upload Price List");

// $excel->setActiveSheetIndex(0)->setCellValue('A1', "picture");
$excel->setActiveSheetIndex(0)->setCellValue('A1', "article");
$excel->setActiveSheetIndex(0)->setCellValue('B1', "last");
$excel->setActiveSheetIndex(0)->setCellValue('C1', "material");
$excel->setActiveSheetIndex(0)->setCellValue('D1', "lining");
$excel->setActiveSheetIndex(0)->setCellValue('E1', "upper");
$excel->setActiveSheetIndex(0)->setCellValue('F1', "l&o");
$excel->setActiveSheetIndex(0)->setCellValue('G1', "edge color");
$excel->setActiveSheetIndex(0)->setCellValue('H1', "strobel");
$excel->setActiveSheetIndex(0)->setCellValue('I1', "ricami");
$excel->setActiveSheetIndex(0)->setCellValue('J1', "amount");

// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Sheet1");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Format Upload Price List.xls"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>