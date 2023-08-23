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
<script type="text/javascript" src="DataTables/datatables.js"></script>
<link rel="stylesheet" href="DataTables/datatables.css"/>

<?php
$xrdm = date("YmdHis");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css?verion=$xrdm\" />";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/frmstyle.css?version=$xrdm\" />";
?>

<script type="text/javascript">
  $('#myTable').DataTable({"lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "All"] ],
                                    "autoWidth": false 
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
                   (SELECT TRIM(nmsupp) FROM kmmstsupp WHERE kdsupp = po_kdsupp) AS nmsupp
                   FROM tbl_pch_supplier_shipment 
                   WHERE 1 ".$sqlWHERE."
                   ORDER BY pp_date, pp_no, pp_baris";
            // echo($sql);

            $res = mysql_query($sql,$conn);
            $row = mysql_num_rows($res);
            $numrow = 1;
            ?>

            <table width="100%" id="myTable" style="margin-top: 5px; margin-bottom: 5px; font-weight: 8px; padding: 0px;" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>...</th>
                 <!--  <th rowspan="2">Nama Barang</th>
                  <th rowspan="2">Satuan</th>
                  <th rowspan="2">Qty. PP</th>
                  <th rowspan="2">Supplier</th>
                  <th rowspan="2">Valuta</th>
                  <th rowspan="2">Kurs</th>
                  <th rowspan="2">Qty. PO</th>
                  <th rowspan="2">Price</th>
                  <th rowspan="2">Amount</th>
                  <th rowspan="2">No. Order</th>
                  <th rowspan="2">Type</th>
                  <th rowspan="2">Article</th>
                  <th rowspan="2">Size</th>
                  <th rowspan="2">Color</th>
                  <th rowspan="2">Unit</th>
                  <th rowspan="2">Qty.</th>
                  <th colspan="3">Shipment</th>
                  <th rowspan="2">User</th>
                  <th rowspan="2">Export Date</th>
                  <th colspan="2">Price</th>
                  <th rowspan="2">Remark</th>
                  <th colspan="3">Sent</th>
                  <th rowspan="2">BQ</th>
                  <th colspan="3">Invoice</th> -->
                </tr>
                <!-- <tr>
                  <th>Mode</th>
                  <th>ETD</th>
                  <th>ETA</th>
                  <th>Price</th>
                  <th>Amount</th>
                  <th>1</th>
                  <th>2</th>
                  <th>3</th>
                  <th>No.</th>
                  <th>Finish</th>
                  <th>Partial</th>
                </tr> -->
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
                    $po_kurs = trim(htmlspecialchars($data["po_kurs"]));
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
                ?>
                  <tr style="cursor: pointer;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onclick="openDialog('<?=$id?>')">
                      <td ><?=$numrow?></td>
                      <td style="padding: 0px;">
                        <table class="table" style="margin: 1px; width: 100%;">
                          <tr>
                            <td style="width: 9%; text-align: left;">PP</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$pp_no?></td>
                            <td style="width: 9%; text-align: left;">Tgl. PP</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$tgl_pp?></td>
                            <td style="width: 9%; text-align: left;">PO</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$po_no?></td>
                            <td style="width: 9%;" text-align: left;>Tgl. PO</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$tgl_po?></td>
                          </tr>
                          <tr>
                            <td style="width: 9%; text-align: left;">Nama Barang</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left;' colspan="4"><?=$nmbrg?></td>
                            <td style="width: 9%; text-align: left;">Supplier</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left;' colspan="4"><?=$nmsupp?></td>
                          </tr>
                          <tr>
                            <td style="width: 9%; text-align: left;">Type</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$type?></td>
                            <td style="width: 9%; text-align: left;">Article</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$article?></td>
                            <td style="width: 9%; text-align: left;">Size</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$size?></td>
                            <td style="width: 9%; text-align: left;">Color</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$color?></td>
                          </tr>
                          <tr>
                            <td style="width: 9%; text-align: left;">Satuan</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$pp_satuan?></td>
                            <td style="width: 9%; text-align: left;">Valuta</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$po_valuta?></td>
                            <td style="width: 9%; text-align: left;">Kurs</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=$po_kurs?></td>
                            <td style="width: 9%; text-align: left;">Harga</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left; width: 15%;'><?=number_format($po_price)?></td>
                          </tr>
                          <tr>
                            <td style="width: 9%; text-align: left;">User</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left;' colspan="4"><?=$user?></td>
                            <td style="width: 9%; text-align: left;">Remark</td>
                            <td style="width: 1%;">:</td>
                            <td style='text-align:left;' colspan="4"><?=$remark?></td>
                          </tr>
                        </table>
                         <table class="table" style="margin: 1px; margin-top: -1px;">
                            <tr>
                              <th rowspan="2">Qty. PP</th>
                              <th rowspan="2">Qty. PO</th>
                              <th rowspan="2">Amount</th>
                              <th rowspan="2">No. Order</th>
                              <th colspan="3">Shipment</th>
                              <th rowspan="2">Export Date</th>
                              <th colspan="3">Sent</th>
                              <th rowspan="2">BQ</th>
                              <th colspan="3">Invoice</th>
                            </tr>
                            <tr>
                              <th>Mode</th>
                              <th>ETD</th>
                              <th>ETA</th>
                              <th>1</th>
                              <th>2</th>
                              <th>3</th>
                              <th>No.</th>
                              <th>Finish</th>
                              <th>Partial</th>
                            </tr>
                            <tr>
                              <td><?=$pp_qty?></td>
                              <td><?=$po_qty?></td>
                              <td><?=$po_price?></td>
                              <td><?=$no_order?></td>
                              <td><?=$shipment_mode?></td>
                              <td><?=$tgl_shipment_etd?></td>
                              <td><?=$tgl_shipment_eta?></td>
                              <td><?=$tgl_export?></td>
                              <td><?=$sent_1?></td>
                              <td><?=$sent_2?></td>
                              <td><?=$sent_3?></td>
                              <td><?=$bq?></td>
                              <td><?=$invoice_no?></td>
                              <td><?=$tgl_invoice_finish?></td>
                              <td><?=$tgl_invoice_partial?></td>
                            </tr>
                        </table>
                      </td>
                      <!-- <td style='text-align:left;' nowrap=""><?=$nmbrg?></td>
                      <td style='text-align:center;' nowrap=""><?=$pp_satuan?></td>
                      <td style='text-align:right;' nowrap=""><?=$pp_qty?></td>
                      <td style='text-align:left;' nowrap=""><?=$nmsupp?></td>
                      <td style='text-align:left;' nowrap=""><?=$po_valuta?></td>
                      <td style='text-align:right;' nowrap=""><?=$po_kurs?></td>
                      <td style='text-align:right;' nowrap=""><?=$po_qty?></td>
                      <td style='text-align:right;' nowrap=""><?=number_format($po_price)?></td>
                      <td style='text-align:right;' nowrap=""><?=number_format($po_subtotal)?></td>
                      <td style='text-align:left;' nowrap=""><?=$no_order?></td>
                      <td style='text-align:left;' nowrap=""><?=$type?></td>
                      <td style='text-align:left;' nowrap=""><?=$article?></td>
                      <td style='text-align:left;' nowrap=""><?=$size?></td>
                      <td style='text-align:left;' nowrap=""><?=$color?></td>
                      <td style='text-align:left;' nowrap=""><?=$unit?></td>
                      <td style='text-align:right;' nowrap=""><?=$qty?></td>
                      <td style='text-align:left;' nowrap=""><?=$shipment_mode?></td>
                      <td style='text-align:left;' nowrap=""><?=$tgl_shipment_etd?></td>
                      <td style='text-align:left;' nowrap=""><?=$tgl_shipment_eta?></td>
                      <td style='text-align:left;' nowrap=""><?=$user?></td>
                      <td style='text-align:left;' nowrap=""><?=$tgl_export?></td>
                      <td style='text-align:right;' nowrap=""><?=$price?></td>
                      <td style='text-align:right;' nowrap=""><?=$amount?></td>
                      <td style='text-align:left;' nowrap=""><?=$remark?></td>
                      <td style='text-align:right;' nowrap=""><?=$sent_1?></td>
                      <td style='text-align:right;' nowrap=""><?=$sent_2?></td>
                      <td style='text-align:right;' nowrap=""><?=$sent_3?></td>
                      <td style='text-align:right;' nowrap=""><?=$bq?></td>
                      <td style='text-align:left;' nowrap=""><?=$invoice_no?></td>
                      <td style='text-align:left;' nowrap=""><?=$tgl_invoice_finish?></td>
                      <td style='text-align:left;' nowrap=""><?=$tgl_invoice_partial?></td> -->
                  </tr>
                <?php
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
