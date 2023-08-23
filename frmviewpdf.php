<?php

include("../../configuration.php");
include("../../connection.php");
include("../../endec.php");

//Class For Pdf
require('../../mpdf/mpdf.php');

//Cek Get Data
if(isset($_POST['sql'])){
  $sql = $_POST['sql'];
}
else {
  $sql = "";
}

$xname = $_SESSION[$domainApp."_myname"];
$xgroup = $_SESSION[$domainApp."_mygroup"];
date_default_timezone_set("Asia/Bangkok");
$today = date("d/m/Y H:i:s");

$header .= "<img src='img/logokmbs.jpg' style='height: 5%;'></img><br/>
            <b style='font-size: 15px; '>PT KARYAMITRA BUDISENTOSA</b><br/>
            <b style='font-size: 11px;'>Price List</b><br/>";

$content .= "<table id='myTable' class='table' style = 'margin : 0px;'>
              <thead>
                <tr style='background-color: lightgray; font-size: 9pt;'>
                  <th align='center' rowspan='2' style='width: 3%;'>No.</th>
                  <th align='center' rowspan='2' style='width: 10%;'>Customer</th>
                  <th align='center' rowspan='2' style='width: 13%;'>Article</th>
                  <th align='center' rowspan='2' style='width: 13%;'>Last</th>
                  <th align='center' rowspan='2' style='width: 17%;'>Material</th>
                  <th align='center' rowspan='2' style='width: 10%;'>Lining</th>
                  <th align='center' rowspan='2' style='width: 6%;'>Currency</th>
                  <th align='center' colspan='5'>Price</th>
                  <th align='center' rowspan='2' style='width: 5%;'>Amount</th>
                </tr>
                <tr style='background-color: lightgray; font-size: 9pt;'>
                  <th align='center' style='width: 5%;'>Upper</th>
                  <th align='center' style='width: 5%;'>L & O</th>
                  <th align='center' style='width: 5%;'>Edge Color</th>
                  <th align='center' style='width: 5%;'>Strobel</th>
                  <th align='center' style='width: 5%;'>RICAMI</th>
                </tr>
              </thead>
              <tbody>";

// $content .= "<table id='myTable' class='table' style = 'margin : 0px; overflow: wrap'>";

$res = mysql_query($sql,$conn);
$no = 1;

while ($data = mysql_fetch_array($res)){
  $content .= "<tr>
                <td align='center' style='width: 3%; text-align: left;'>".$no."</td>
                <td align='center' style='width: 10%; text-align: left;'>".$data["nama"]."</td>
                <td align='center' style='width: 13%; text-align: left;'>".$data["price_article"]."</td>
                <td align='center' style='width: 13%; text-align: left;'>".$data["price_last"]."</td>
                <td align='center' style='width: 17%; text-align: left;'>".$data["price_material"]."</td>
                <td align='center' style='width: 10%; text-align: left;'>".$data["price_lining"]."</td>
                <td align='center' style='width: 6%; text-align: right;'>".$data["price_valuta"]."</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_upper"]."</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_lando"]."</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_edgecolor"]."r</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_strobel"]."</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_ricami"]."</td>
                <td align='center' style='width: 5%; text-align: right;'>".$data["price_amount"]."</td>
              </tr>";
  $no++;
}

$content .= "   </tbody>
              </table>";

$footer = "Printed : ".$_SESSION[$domainApp."_myname"]." ".$today."";

//$mpdf=new mPDF('1mode','2format kertas','3font size','4font','5margin left','6margin right','7margin top','8margin bottom','9margin header','10margin footer','11orientasi kertas');
$mpdf=new mPDF('','A4-L','7','Arial','4','4','30','10','5','5');
$mpdf->simpleTables = true;
$mpdf->packTableData = true;
$keep_table_proportions = TRUE;
$mpdf->shrink_tables_to_fit=1;
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$stylesheet = file_get_contents('css/table.css');
$mpdf->WriteHTML($stylesheet,1);

$mpdf->WriteHTML($content);
 
//save the file put which location you need folder/filname
$mpdf->Output("MP-".$mpno.".pdf", 'I');
 
 
//out put in browser below output function
$mpdf->Output();

?>