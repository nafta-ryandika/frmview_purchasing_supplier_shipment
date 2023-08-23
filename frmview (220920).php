<?php
include("../../configuration.php");
include("../../connection.php");
include("actsearch.php");

$sqlWHERE = " ";
$datax = "";

if(isset($_POST['datax'])){
  if ($_POST['datax']!=''){
    $datax = $_POST['datax'];

    $sqlWHERE .= " AND departemen = '".$datax."' ";
  }
}

if(isset($_POST['txtfield'])){
  if($_POST['txtfield']!=''){
    $txtfield = $_POST['txtfield'];

    if(isset($_POST['txtparameter'])){
      if ($_POST['txtparameter']!=''){
        $txtparameter = $_POST['txtparameter'];
      }
    }

    if(isset($_POST['txtdata'])){
      if ($_POST['txtdata']!=''){
        $txtdata = $_POST['txtdata'];
      }
    }

    $txtfieldx = explode("|",rtrim($txtfield,'|'));
    $txtparameterx = explode("|",rtrim($txtparameter,'|'));
    $txtdatax = explode("|",rtrim($txtdata,'|'));
    
    for($a=0;$a<count($txtfieldx);$a++){
      if ($txtfieldx[$a] == "date_pp") {
        $tgl_pp = strtr($txtdatax[$a], '/', '-');
        $tgl_pp = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($tgl_pp))));

        $sqlWHERE .= multisearch('tbl_pch_supplier_shipment',$txtfieldx[$a],$txtparameterx[$a],$tgl_pp);
      }
      else {
        $sqlWHERE .= multisearch('tbl_pch_supplier_shipment',$txtfieldx[$a],$txtparameterx[$a],$txtdatax[$a]);
      }
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Form View</title>
</head>

<!-- DATATABLE -->
<!-- <script type="text/javascript" src="DataTables/datatables.js"></script>
<link rel="stylesheet" href="DataTables/datatables.css"/>
 -->
<?php
$xrdm = date("YmdHis");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css?verion=$xrdm\" />";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/frmstyle.css?version=$xrdm\" />";
?>

<script type="text/javascript">
  $('#myTable').DataTable({
    "lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "All"] ],
    "ordering": false,
                                    "autoWidth": false 
                                    //  keys: true
                                    // "columns": [{ "width": "50px" },{ "width": "35%" },{ "width": "20%" },{ "width": "20%" },{ "width": "20%" },
                                    //             { "width": "35%" },{ "width": "20%" },{ "width": "20%" },{ "width": "20%" },{ "width": "35%" },
                                    //             { "width": "20%" },{ "width": "20%" },{ "width": "20%" },{ "width": "35%" },{ "width": "20%" },
                                    //             { "width": "20%" },{ "width": "20%" },{ "width": "35%" },{ "width": "20%" },{ "width": "20%" },
                                    //             { "width": "20%" },{ "width": "35%" },{ "width": "20%" },{ "width": "20%" },{ "width": "20%" },
                                    //             { "width": "35%" },{ "width": "20%" }]
  });
</script>

  <body>
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <fieldset class="info_fieldset" style="margin-top: 10px; margin-left: 0px; margin-right: 0px;">
          <div id="frmisi">
          <?php
            $sql = "SELECT *,
                    (IF(pp_date = '0000-00-00', '', (DATE_FORMAT(pp_date,'%d/%m/%Y')))) AS tgl_pp,
                    (IF(po_date = '0000-00-00', '', (DATE_FORMAT(po_date,'%d/%m/%Y')))) AS tgl_po,
                    (IF(shipment_etd = '0000-00-00', '', (DATE_FORMAT(shipment_etd,'%d/%m/%Y')))) AS tgl_shipment_etd,
                    (IF(shipment_eta = '0000-00-00', '', (DATE_FORMAT(shipment_eta,'%d/%m/%Y')))) AS tgl_shipment_eta,
                    (IF(export_date = '0000-00-00', '', (DATE_FORMAT(export_date,'%d/%m/%Y')))) AS tgl_export,
                    (IF(invoice_finish = '0000-00-00', '', (DATE_FORMAT(invoice_finish,'%d/%m/%Y')))) AS tgl_invoice_finish,
                    (IF(invoice_partial = '0000-00-00', '', (DATE_FORMAT(invoice_partial,'%d/%m/%Y')))) AS tgl_invoice_partial,
                    (SELECT TRIM(nmbrg) FROM kmmstbhnbaku WHERE kdbrg = pp_kdbrg) AS nmbrg,
                    (SELECT TRIM(nmsupp) FROM kmmstsupp WHERE kdsupp = po_kdsupp) AS nmsupp,
                    IF(TRIM(dt1.`type`) <> '', dt1.`type`, dt2.`type`) AS brg_type,
                    IF(TRIM(dt1.article) <> '', dt1.article, dt2.article) AS brg_article,
                    IF(TRIM(dt1.size) <> '', dt1.size, dt2.size) AS brg_size,
                    IF(TRIM(dt1.color) <> '', dt1.color, dt2.color) AS brg_color
                    FROM 
                    (
                      SELECT * FROM tbl_pch_supplier_shipment 
                      WHERE 1 ".$sqlWHERE."
                    )dt1
                    LEFT JOIN 
                    (
                      SELECT 
                      kdbrg, `type`, article, size, color 
                      FROM tbl_mstnmbrg
                    )dt2
                    ON dt1.pp_kdbrg = dt2.kdbrg
                    ".$sqlLIMIT."
                    ORDER BY pp_date, pp_no, pp_baris
                   ";
            // echo($sql);

            $res = mysql_query($sql,$conn);
            $row = mysql_num_rows($res);
            $numrow = 1;
            ?>

            <table width="100%" id="myTable" style="margin-top: 5px; margin-bottom: 5px; font-weight: 8px; padding: 0px;" class="table">
              <thead>
                <tr>
                  <th nowrap>No</th>
                  <th nowrap>No PP</th>
                  <th nowrap>Tgl PP</th>
                  <th nowrap>Qty PP</th>
                  <th nowrap>No PO</th>
                  <th nowrap>Tgl PO</th>
                  <th nowrap>Qty PO</th>
                  <th>No Order</th>
                  <th>Supplier</th>
                  <th>Nama Barang</th>
                  <th>Satuan</th>
                  <th>Type</th>
                  <th>Article</th>
                  <th>Size</th>
                  <th>Color</th>
                  <th>Valuta</th>
                  <th>Price</th>
                  <th>Amount</th>
                  <th>User</th>
                  <th>Export Date</th>
                  <th>Mode</th>
                  <th>ETD</th>
                  <th>ETA</th>
                  <th>Sent I</th>
                  <th>Sent II</th>
                  <th>Sent III</th>
                  <th>BQ</th>
                  <th>No Invoice</th>
                  <th>Finish</th>
                  <th>Partial</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($row > 0){
                  while ($data = mysql_fetch_array($res, MYSQL_BOTH)){
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

                    echo "<tr style=\"cursor: pointer;\" onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\" onclick=\"\">";
                      echo "<td>".$numrow."</td>";
                      echo "<td>".$pp_no."</td>";
                      echo "<td>".$tgl_pp."</td>";
                      echo "<td>".$pp_qty."</td>";
                      echo "<td>".$po_no."</td>";
                      echo "<td>".$tgl_po."</td>";
                      echo "<td>".$po_qty."</td>";
                      echo "<td>".$no_order."</td>";
                      echo "<td>".$nmsupp."</td>";
                      echo "<td>".$nmbrg."</td>";
                      echo "<td>".$pp_satuan."</td>";
                      echo "<td>".$brg_type."</td>";
                      echo "<td>".$brg_article."</td>";
                      echo "<td>".$brg_size."</td>";
                      echo "<td>".$brg_color."</td>";
                      echo "<td>".$po_valuta."</td>";
                      echo "<td>".$po_price."</td>";
                      echo "<td>".$po_subtotal."</td>";
                      echo "<td>".$user."</td>";
                      echo "<td>".$tgl_export."</td>";
                      echo "<td>".$shipment_mode."</td>";
                      echo "<td>".$tgl_shipment_etd."</td>";
                      echo "<td>".$tgl_shipment_eta."</td>";
                      echo "<td>".$sent_1."</td>";
                      echo "<td>".$sent_2."</td>";
                      echo "<td>".$sent_3."</td>";
                      echo "<td>".$bq."</td>";
                      echo "<td>".$invoice_no."</td>";
                      echo "<td>".$tgl_invoice_finish."</td>";
                      echo "<td>".$tgl_invoice_partial."</td>";
                      echo "<td>".$remark."</td>";
                    echo "</tr>";

                    $numrow++;
                  }
                }
                mysql_free_result($result);
                ?>
              </tbody>
            </table>
          </div>
        </fieldset>
        </td>
      </tr>
    </table>
  </body>
</html>
<?php
mysql_close($conn);
?>
