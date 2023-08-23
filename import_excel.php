<?php
include("../../configuration.php");
include("../../connection.php");

require_once '../../PHPExcel/PHPExcel/IOFactory.php';
date_default_timezone_set("Asia/Bangkok");

$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];


if(isset($_GET['customer'])){
   $customer = $_GET['customer'];
}
if(isset($_GET['valuta'])){
   $valuta = $_GET['valuta'];
}


if($fileSize > 0 || $fileError == 0){
   $targetPath = 'temp/'.$fileName;
   $move = move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

   chmod($targetPath,0777);

   if ($move) {
      $excel = PHPExcel_IOFactory::load($targetPath);

      foreach($excel->getWorksheetIterator() as $xdata){
         $max_row = $xdata->getHighestRow();

            $sheet = $excel->getIndex($xdata);
            if ($sheet == 0){ 
               $article = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(0,1)->getValue())));
               $last = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(1,1)->getValue())));
               $material = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(2,1)->getValue())));
               $lining = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(3,1)->getValue())));
               $upper = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(4,1)->getValue())));
               $l_and_o = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(5,1)->getValue())));
               $edge_color = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(6,1)->getValue())));
               $strobel = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(7,1)->getValue())));
               $ricami = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(8,1)->getValue())));
               $amount = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(9,1)->getValue()))); 

               if ($article == "ARTICLE" && $last == "LAST" && $material == "MATERIAL" && $lining == "LINING" 
                  && $upper == "UPPER" && $l_and_o == "L&O" && $edge_color == "EDGE COLOR" && $strobel == "STROBEL" && $ricami == "RICAMI" 
                  && $amount == "AMOUNT") {
                  for($i = 2; $i <= $max_row; $i++){
                     $article = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(0,$i)->getValue())));
                     $last = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(1,$i)->getValue())));
                     $material = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(2,$i)->getValue())));
                     $lining = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(3,$i)->getValue())));
                     $upper = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(4,$i)->getValue())));
                     $l_and_o = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(5,$i)->getValue())));
                     $edge_color = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(6,$i)->getValue())));
                     $strobel = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(7,$i)->getValue())));
                     $ricami = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(8,$i)->getValue())));
                     $amount = strtoupper(trim(mysql_escape_string($xdata->getCellByColumnAndRow(9,$i)->getCalculatedValue()))); 

                     // get counter number
                     $date = date("Y-m-d");
                     $month = date("m",strtotime($date));
                     $year = date("Y",strtotime($date));

                     $counter = 0;
                     $sql =   "SELECT ckode, cnama, cbultah, ccounter, access, userby, entry 
                              FROM rlcounter WHERE ckode = 'PRCLS' AND cbultah = '".$month.$year."'";
                     $res = mysql_query($sql,$conn);
                     $row = mysql_num_rows($res);

                     if ($row == 0) {
                       $sql1 = "INSERT INTO rlcounter 
                               VALUES 
                               (
                               'PRCLS', 'PRICE LIST BARANG JADI', '".$month.$year."', 1, CURDATE(), '".$_SESSION[$domainApp."_myname"]."', CURTIME(), NULL 
                               )";

                       if (!mysql_query($sql1,$conn)){
                           die('Error (Insert Counter): ' . mysql_error());                  
                       }

                       $counter = 1;
                     }
                     else {
                       $data = mysql_fetch_array($res);
                       $counter = ($data["ccounter"]) + 1;

                       // update counter number
                       $sql2 =    "UPDATE rlcounter SET
                                   ccounter = '".$counter."',
                                   access = CURDATE(),
                                   userby = '".$_SESSION[$domainApp."_myname"]."',
                                   entry = CURTIME()
                                   WHERE
                                   ckode = 'PRCLS' AND cbultah = '".$month.$year."'";

                       if (!mysql_query($sql2,$conn)){
                           die('Error (Update Counter): ' . mysql_error());
                       }

                     }

                     $xid = sprintf("%06s", $counter);
                     $price_id = "PRCLS/".$month.$year."/".$xid;
 
                     $sql3 = "INSERT INTO mst_pricelist 
                              VALUES (
                              '".$price_id."',
                              '".$customer."',
                              '".$article."',
                              '".$last."',
                              '".$material."',
                              '".$lining."',
                              '".$valuta."',
                              '".$upper."',
                              '".$l_and_o."',
                              '".$edge_color."',
                              '".$strobel."',
                              '".$ricami."',
                              '".$amount."',
                              NULL,
                              now(),
                              '".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."', 
                              '".$_SESSION[$domainApp."_myname"]."')";

                        if (!mysql_query($sql3,$conn)){
                           die("Error (Insert mst_pricelist): " . mysql_error());
                        }
                     flush();
                  }  
               }
            }
      }
      echo("Upload Sukses!");
   }
   else{
      echo("Upload Gagal!");
   }
   unlink($targetPath);
}
?>