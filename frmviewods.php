<?php
require_once '../../PHPExcel/PHPExcel.php';
include("../../configuration.php");
include("../../connection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$xname = $_SESSION[$domainApp."_myname"];
$xgroup = $_SESSION[$domainApp."_mygroup"];

if(isset($_POST['sql'])){
  $sql = $_POST['sql'];
}
else {
  $sql = "";
}

$excel = new PHPExcel();

$excel->getProperties()->setCreator('PT Karyamitra Budisentosa')
             ->setLastModifiedBy($xname)
             ->setTitle("Supplier List")
             ->setSubject("Supplier List")
             ->setDescription("Supplier List")
             ->setKeywords("Supplier List");

$excel->setActiveSheetIndex(0)->setCellValue('A1', "No PP");
$excel->setActiveSheetIndex(0)->setCellValue('B1', "Tgl PP");
$excel->setActiveSheetIndex(0)->setCellValue('C1', "Qty PP");
$excel->setActiveSheetIndex(0)->setCellValue('D1', "No PO");
$excel->setActiveSheetIndex(0)->setCellValue('E1', "Tgl PO");
$excel->setActiveSheetIndex(0)->setCellValue('F1', "Qty PO");
$excel->setActiveSheetIndex(0)->setCellValue('G1', "No Order");
$excel->setActiveSheetIndex(0)->setCellValue('H1', "Supplier");
$excel->setActiveSheetIndex(0)->setCellValue('I1', "Nama Barang");
$excel->setActiveSheetIndex(0)->setCellValue('J1', "Satuan");
$excel->setActiveSheetIndex(0)->setCellValue('K1', "Type");
$excel->setActiveSheetIndex(0)->setCellValue('L1', "Article");
$excel->setActiveSheetIndex(0)->setCellValue('M1', "Size");
$excel->setActiveSheetIndex(0)->setCellValue('N1', "Color");
$excel->setActiveSheetIndex(0)->setCellValue('O1', "Valuta");
$excel->setActiveSheetIndex(0)->setCellValue('P1', "Price");
$excel->setActiveSheetIndex(0)->setCellValue('Q1', "Amount");
$excel->setActiveSheetIndex(0)->setCellValue('R1', "User");
$excel->setActiveSheetIndex(0)->setCellValue('S1', "Export Date");
$excel->setActiveSheetIndex(0)->setCellValue('T1', "Mode");
$excel->setActiveSheetIndex(0)->setCellValue('U1', "ETD");
$excel->setActiveSheetIndex(0)->setCellValue('V1', "ETA");
$excel->setActiveSheetIndex(0)->setCellValue('W1', "Sent I");
$excel->setActiveSheetIndex(0)->setCellValue('X1', "Sent II");
$excel->setActiveSheetIndex(0)->setCellValue('Y1', "Sent III");
$excel->setActiveSheetIndex(0)->setCellValue('Z1', "BQ");
$excel->setActiveSheetIndex(0)->setCellValue('AA1', "No Invoice");
$excel->setActiveSheetIndex(0)->setCellValue('AB1', "Finish");
$excel->setActiveSheetIndex(0)->setCellValue('AC1', "Partial");
$excel->setActiveSheetIndex(0)->setCellValue('AD1', "Remark");

// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
// $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
// $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
// $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
// $excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);

$res = mysql_query($sql,$conn);
$no = 2;

while ($data = mysql_fetch_array($res)){
  $id = trim(htmlspecialchars($data["id"]));
  $dept = trim(htmlspecialchars($data["dept"]));
  $pp_no = trim(htmlspecialchars($data["pp_no"]));
  $pp_date = trim(htmlspecialchars($data["pp_date"]));
  $pp_baris = trim(htmlspecialchars($data["pp_baris"]));
  $pp_kdbrg = trim(htmlspecialchars($data["pp_kdbrg"]));
  $pp_qty = (float) trim(htmlspecialchars($data["pp_qty"]));
  $pp_satuan = trim(htmlspecialchars($data["pp_satuan"]));
  $po_no = trim(htmlspecialchars($data["po_no"]));
  $po_date = trim(htmlspecialchars($data["po_date"]));
  $po_kdsupp = trim(htmlspecialchars($data["po_kdsupp"]));
  $po_valuta = trim(htmlspecialchars($data["po_valuta"]));
  $po_kurs = (float) trim(htmlspecialchars($data["po_kurs"]));
  $po_qty = (float) trim(htmlspecialchars($data["po_qty"]));
  $po_price = (float) trim(htmlspecialchars($data["po_price"]));
  $po_subtotal = (float) trim(htmlspecialchars($data["po_subtotal"]));
  $no_order = trim(htmlspecialchars($data["no_order"]));
  $type = trim(htmlspecialchars($data["type"]));
  $article = trim(htmlspecialchars($data["article"]));
  $size = trim(htmlspecialchars($data["size"]));
  $color = trim(htmlspecialchars($data["color"]));
  $shipment_mode = trim(htmlspecialchars($data["shipment_mode"]));
  $shipment_etd = trim(htmlspecialchars($data["shipment_etd"]));
  $shipment_eta = trim(htmlspecialchars($data["shipment_eta"]));
  $user = trim(htmlspecialchars($data["user"]));
  $export_date = trim(htmlspecialchars($data["export_date"]));
  $remark = trim(htmlspecialchars($data["remark"]));
  $sent_1 = trim(htmlspecialchars($data["sent_1"]));
  $sent_2 = trim(htmlspecialchars($data["sent_2"]));
  $sent_3 = trim(htmlspecialchars($data["sent_3"]));
  $bq = trim(htmlspecialchars($data["bq"]));
  $invoice_no = trim(htmlspecialchars($data["invoice_no"]));
  $invoice_finish = trim(htmlspecialchars($data["invoice_finish"]));
  $invoice_partial = trim(htmlspecialchars($data["invoice_partial"]));
  $tgl_pp = trim(htmlspecialchars($data["tgl_pp"]));
  $tgl_po = trim(htmlspecialchars($data["tgl_po"]));
  $tgl_shipment_etd = trim(htmlspecialchars($data["tgl_shipment_etd"]));
  $tgl_shipment_eta = trim(htmlspecialchars($data["tgl_shipment_eta"]));
  $tgl_export = trim(htmlspecialchars($data["tgl_export"]));
  $tgl_invoice_finish = trim(htmlspecialchars($data["tgl_invoice_finish"]));
  $tgl_invoice_partial = trim(htmlspecialchars($data["tgl_invoice_partial"]));
  $nmbrg = trim(htmlspecialchars($data["nmbrg"]));
  $nmsupp = trim(htmlspecialchars($data["nmsupp"]));
  $brg_type = trim(htmlspecialchars($data["brg_type"]));
  $brg_article = trim(htmlspecialchars($data["brg_article"]));
  $brg_size = trim(htmlspecialchars($data["brg_size"]));
  $brg_color = trim(htmlspecialchars($data["brg_color"]));

  $excel->setActiveSheetIndex(0)->setCellValue('A'.$no, $pp_no);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$no, $tgl_pp);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$no, $pp_qty);
  $excel->setActiveSheetIndex(0)->setCellValue('D'.$no, $po_no);
  $excel->setActiveSheetIndex(0)->setCellValue('E'.$no, $tgl_po);
  $excel->setActiveSheetIndex(0)->setCellValue('F'.$no, $po_qty);
  $excel->setActiveSheetIndex(0)->setCellValue('G'.$no, $no_order);
  $excel->setActiveSheetIndex(0)->setCellValue('H'.$no, $nmsupp);
  $excel->setActiveSheetIndex(0)->setCellValue('I'.$no, $nmbrg);
  $excel->setActiveSheetIndex(0)->setCellValue('J'.$no, $pp_satuan);
  $excel->setActiveSheetIndex(0)->setCellValue('K'.$no, $brg_type);
  $excel->setActiveSheetIndex(0)->setCellValue('L'.$no, $brg_article);
  $excel->setActiveSheetIndex(0)->setCellValue('M'.$no, $brg_size);
  $excel->setActiveSheetIndex(0)->setCellValue('N'.$no, $brg_color);
  $excel->setActiveSheetIndex(0)->setCellValue('O'.$no, $po_valuta);
  $excel->setActiveSheetIndex(0)->setCellValue('P'.$no, $po_price);
  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$no, $po_subtotal);
  $excel->setActiveSheetIndex(0)->setCellValue('R'.$no, $user);
  $excel->setActiveSheetIndex(0)->setCellValue('S'.$no, $tgl_export);
  $excel->setActiveSheetIndex(0)->setCellValue('T'.$no, $shipment_mode);
  $excel->setActiveSheetIndex(0)->setCellValue('U'.$no, $tgl_shipment_etd);
  $excel->setActiveSheetIndex(0)->setCellValue('V'.$no, $tgl_shipment_eta);
  $excel->setActiveSheetIndex(0)->setCellValue('W'.$no, $sent_1);
  $excel->setActiveSheetIndex(0)->setCellValue('X'.$no, $sent_2);
  $excel->setActiveSheetIndex(0)->setCellValue('Y'.$no, $sent_3);
  $excel->setActiveSheetIndex(0)->setCellValue('Z'.$no, $bq);
  $excel->setActiveSheetIndex(0)->setCellValue('AA'.$no, $invoice_no);
  $excel->setActiveSheetIndex(0)->setCellValue('AB'.$no, $tgl_invoice_finish);
  $excel->setActiveSheetIndex(0)->setCellValue('AC'.$no, $tgl_invoice_partial);
  $excel->setActiveSheetIndex(0)->setCellValue('AD'.$no, $remark);
  $no++;
}

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Sheet1");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Supplier List.ods"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'OpenDocument');
$write->save('php://output');
?>