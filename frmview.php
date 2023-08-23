<?php
include("../../configuration.php");
include("../../connection.php");
include("actsearch.php");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(isset($_POST['txtpage'])){
  $txtpage = $_POST['txtpage'];
  $showPage = $txtpage;
  $noPage = $txtpage;
}else{
  $txtpage = 1;
  $showPage = $txtpage;
  $noPage = $txtpage;
}
if(isset($_POST['txtperpage'])){
  $txtperpage=$_POST['txtperpage'];
}else{
  $txtperpage=10;
}

$offset = ($txtpage - 1) * $txtperpage;
$sqlLIMIT = " LIMIT $offset, $txtperpage";
$sqlWHERE = " ";
$sqlWHERE1 = " ";

if(isset($_POST['data_order'])){
  if ($_POST['data_order']!=''){
    $data_order = $_POST['data_order'];

    if ($data_order == "rnd") {
      $sqlWHERE .= " AND pp_no LIKE 'RNDMC/PP/%' "; 
    }
    elseif ($data_order == "prd") {
      $sqlWHERE .= " AND pp_no NOT LIKE 'RNDMC/PP/%' ";
    }
  }
}

if(isset($_POST['jnssupp'])){
  if ($_POST['jnssupp']!=''){
    $jnssupp = $_POST['jnssupp'];

    $sqlWHERE1 .= " AND jnssupp = '".$jnssupp."' ";
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
      if ($txtfieldx[$a] == "pp_date" || $txtfieldx[$a] == "po_date") {
        $tgl = strtr($txtdatax[$a], '/', '-');
        $tgl = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($tgl))));

        $sqlWHERE .= multisearch('tbl_pch_supplier_shipment',$txtfieldx[$a],$txtparameterx[$a],$tgl);
      }
      elseif ($txtfieldx[$a] == "nmsupp") {
        $sqlWHERE1 .= multisearch('kmmstsupp',$txtfieldx[$a],$txtparameterx[$a],$txtdatax[$a]);
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
<link rel="stylesheet" href="css/table.css">
<?php
$xrdm = date("YmdHis");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css?verion=$xrdm\" />";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/frmstyle.css?version=$xrdm\" />";
?>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/freeze-table.js"></script>
<script>
  // $(document).ready(function(){
  //   $('#myTable').on('click', 'span', function() {
  //     var $e = $(this).parent();
  //     var e1 = $e.parent();

  //   $(this).each(function(){
  //       .attr("class", "normal")
  //       .attr("onMouseOver", "this.className='highlight'")
  //       .attr("onMouseOut", "this.className='normal'")
  //       .attr("style", "cursor: pointer");
  //   });
  //   //   if($e.attr('class') === 'asset_value') {
  //   //         var val = $(this).html();
  //   //         $e.html('<input type="text" value="'+val+'" />');
  //   //         var $newE = $e.find('input');
  //   //         $newE.focus();
  //   //   }
  //   //   $newE.on('blur', function() {
  //   //         $(this).parent().html('<span>'+$(this).val()+'</span>');
  //   //     });
  //   })
  // });
//   $(document).ready(function() {
//     // $('#myTable').on('click', 'span', function() {
//     //     var $e = $(this).parent();
//     //     if($e.attr('class') === 'asset_value') {
//     //         var val = $(this).html();
//     //         $e.html('<input type="text" value="'+val+'" />');
//     //         var $newE = $e.find('input');
//     //         $newE.focus();
//     //     }
//     //     $newE.on('blur', function() {
//     //         $(this).parent().html('<span>'+$(this).val()+'</span>');
//     //     });
//     // });
// });​


  $(".example").freezeTable({
    'columnNum': 180,
    // 'scrollable': false,
    'freezeHead': true,
    'scrollBar': true

    // // freeze table header
    // freezeHead: true,

    // // freeze table columns
    // freezeColumn: true,

    // // freeze column(s) header (entire column)
    // freezeColumnHead: true,

    // // show fixed scrollbar
    // scrollBar: false,

    // // css class for the fixed navbar (Bootstrap)
    // // fixedNavbar: '.navbar-fixed-top',

    // // namespace
    // // namespace: 'freeze-table',

    // // Specify a document role element that contains the table. 
    // // Default container is window. 
    // // container: false,

    // // Enable <a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>able mode for inner scroll Y axis
    // scrollable: false,

    // // the number of table columns to freeze
    // columnNum: 3,

    // // freeze column(s) will always be displayed to support interactive table
    // columnKeep: false,

    // // border width
    // columnBorderWidth: 1,

    // // custom styles
    // // columnWrapStyles: null,
    // // headWrapStyles: null,
    // // columnHeadWrapStyles: null,

    // // 'false' to skip
    // // backgroundColor: 'white',

    // // show shadow effect
    // // shadow: false,
    
    // // enable fast mode for better performance
    // fastMode: true,

    // // callback
    // callback: null
  
});

</script>

<body>
  <div style="min-height: 380px;" class="xxx">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
          <div>
            <fieldset class="info_fieldset" style="margin-top: 10px; margin-bottom: 10px;">
              <div id="wrap-table" class="example" style="width: 1320px;">
                <table id="myTable" class="table" style="width: 100%; margin-top: 10px; margin-bottom: 10px;">
                  <thead>
                    <tr style="background-color: lightgray; font-size: 9pt;">
                      <th nowrap>No</th>
                      <th nowrap width="440">No PP</th>
                      <th nowrap>Tgl PP</th>
                      <th nowrap>Qty PP</th>
                      <th nowrap>No PO</th>
                      <th nowrap>Tgl PO</th>
                      <th nowrap>Qty PO</th>
                      <th nowrap>No Order</th>
                      <th nowrap>Supplier</th>
                      <th nowrap>Nama Barang</th>
                      <th nowrap>Satuan</th>
                      <th nowrap>Type</th>
                      <th nowrap>Article</th>
                      <th nowrap>Size</th>
                      <th nowrap>Color</th>
                      <th nowrap>Valuta</th>
                      <th nowrap>Price</th>
                      <th nowrap>Amount</th>
                      <th nowrap>User</th>
                      <th nowrap>Export Date</th>
                      <th nowrap>Mode</th>
                      <th nowrap>ETD</th>
                      <th nowrap>ETA</th>
                      <th nowrap>Sent I</th>
                      <th nowrap>Sent II</th>
                      <th nowrap>Sent III</th>
                      <th nowrap>BQ</th>
                      <th nowrap>No Invoice</th>
                      <th nowrap>Finish</th>
                      <th nowrap>Partial</th>
                      <th nowrap>Remark</th>
                      <!-- <th>test1</th>
                      <th>test2</th>
                      <th>test3</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT 
                            *,
                            (IF(pp_date = '0000-00-00', '', (DATE_FORMAT(pp_date,'%d/%m/%Y')))) AS tgl_pp,
                            (IF(po_date = '0000-00-00', '', (DATE_FORMAT(po_date,'%d/%m/%Y')))) AS tgl_po,
                            (IF(shipment_etd = '0000-00-00', '', (DATE_FORMAT(shipment_etd,'%d/%m/%Y')))) AS tgl_shipment_etd,
                            (IF(shipment_eta = '0000-00-00', '', (DATE_FORMAT(shipment_eta,'%d/%m/%Y')))) AS tgl_shipment_eta,
                            (IF(export_date = '0000-00-00', '', (DATE_FORMAT(export_date,'%d/%m/%Y')))) AS tgl_export,
                            (IF(invoice_finish = '0000-00-00', '', (DATE_FORMAT(invoice_finish,'%d/%m/%Y')))) AS tgl_invoice_finish,
                            (IF(invoice_partial = '0000-00-00', '', (DATE_FORMAT(invoice_partial,'%d/%m/%Y')))) AS tgl_invoice_partial,
                            (SELECT TRIM(nmbrg) FROM kmmstbhnbaku WHERE kdbrg = pp_kdbrg) AS nmbrg,
                            IF(TRIM(dt3.`type`) <> '', dt3.`type`, dt4.`type`) AS brg_type,
                            IF(TRIM(dt3.article) <> '', dt3.article, dt4.article) AS brg_article,
                            IF(TRIM(dt3.size) <> '', dt3.size, dt4.size) AS brg_size,
                            IF(TRIM(dt3.color) <> '', dt3.color, dt4.color) AS brg_color
                            FROM 
                            (
                              SELECT * FROM 
                              (
                                SELECT * 
                                FROM tbl_pch_supplier_shipment 
                                WHERE 1 ".$sqlWHERE."
                              )dt1
                              INNER JOIN
                              (
                                SELECT kdsupp, TRIM(nmsupp) AS nmsupp, jnssupp 
                                FROM kmmstsupp 
                                WHERE 1 ".$sqlWHERE1."
                              )dt2
                              ON dt1.po_kdsupp = dt2.kdsupp
                            )dt3
                            LEFT JOIN 
                            (
                              SELECT 
                              kdbrg, `type`, article, size, color 
                              FROM tbl_mstnmbrg
                            )dt4
                            ON dt3.pp_kdbrg = dt4.kdbrg
                            ORDER BY pp_date DESC, pp_no, pp_baris
                            ".$sqlLIMIT."";

                    // echo $sql;

                    $sql1 = "SELECT count(pp_no) AS jumlah 
                             FROM
                              (
                              SELECT *
                              FROM tbl_pch_supplier_shipment 
                              WHERE 1 ".$sqlWHERE."
                              )dt1
                              INNER JOIN
                              (
                                SELECT kdsupp, TRIM(nmsupp) AS nmsupp, jnssupp 
                                FROM kmmstsupp 
                                WHERE 1 ".$sqlWHERE1."
                              )dt2
                              ON dt1.po_kdsupp = dt2.kdsupp";
                    
                    // echo $sql1;

                    $res1 = mysql_query($sql1,$conn);
                    $data1 = mysql_fetch_array($res1);
                    $count = $data1["jumlah"]; 

                    $jumPage = ceil($count/$txtperpage);

                    if($count>0){
                      $row = $offset;
                      $res = mysql_query($sql,$conn);
                      while ($data = mysql_fetch_array($res, MYSQL_BOTH)){
                        $row += 1;
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
                          echo "<td style=\"text-align: center;\" nowrap>".$row."</td>";
                          echo "<td nowrap>".$pp_no."</td>";
                          echo "<td style=\"text-align: center;\" nowrap>".$tgl_pp."</td>";
                          echo "<td style=\"text-align: right;\" nowrap>".number_format($pp_qty)."</td>";
                          echo "<td nowrap>".$po_no."</td>";
                          echo "<td style=\"text-align: center;\" nowrap>".$tgl_po."</td>";
                          echo "<td style=\"text-align: right;\" nowrap>".number_format($po_qty)."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'no_order','".$id."')\" nowrap>".$no_order."</td>";
                          echo "<td nowrap>".$nmsupp."</td>";
                          echo "<td nowrap>".$nmbrg."</td>";
                          echo "<td style=\"text-align: center;\" nowrap>".$pp_satuan."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'`type`','".$id."')\" nowrap>".$brg_type."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'article','".$id."')\" nowrap>".$brg_article."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'size','".$id."')\" nowrap>".$brg_size."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'color','".$id."')\" nowrap>".$brg_color."</td>";
                          echo "<td style=\"text-align: center;\" nowrap>".$po_valuta."</td>";
                          echo "<td style=\"text-align: right;\" nowrap>".number_format($po_price)."</td>";
                          echo "<td style=\"text-align: right;\" nowrap>".number_format($po_subtotal)."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'user','".$id."')\" nowrap>".$user."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'export_date','".$id."')\" style=\"text-align: center;\" nowrap>".$tgl_export." </td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'shipment_mode','".$id."')\" nowrap>".$shipment_mode."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'shipment_etd','".$id."')\" style=\"text-align: center;\" nowrap>".$tgl_shipment_etd."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'shipment_eta','".$id."')\" style=\"text-align: center;\" nowrap>".$tgl_shipment_eta."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'sent_1','".$id."')\" style=\"text-align: right;\" nowrap>".$sent_1."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'sent_2','".$id."')\" style=\"text-align: right;\" nowrap>".$sent_2."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'sent_3','".$id."')\" style=\"text-align: right;\" nowrap>".$sent_3."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'bq','".$id."')\" style=\"text-align: right;\" nowrap>".$bq."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'invoice_no','".$id."')\" nowrap>".$invoice_no."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'invoice_finish','".$id."')\" style=\"text-align: center;\" nowrap>".$tgl_invoice_finish."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'invoice_partial','".$id."')\" style=\"text-align: center;\" nowrap>".$tgl_invoice_partial."</td>";
                          echo "<td contenteditable=\"true\" onFocus=\"show_edit(this);\" onBlur=\"save_row(this,'remark','".$id."')\" nowrap>".$remark."</td>";
                          // echo "<td class='asset_value' ><span>aaa1</span></td>";
                          // echo "<td class='asset_value' ><span>aaa2</span></td>";
                          // echo "<td class='asset_value' ><span>aaa3</span></td>";
                        echo "</tr>";
                      }
                      mysql_free_result($result);
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </fieldset>
          </div>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="info_fieldset">
          <tr>
            <td><div align="left"><input id="jumpage" name="nmjmlrow" type="hidden" value="<?php echo $jumPage; ?>">Records: <?php echo ($offset + 1); ?> / <?php echo $row; ?> of <?php echo $count; ?> </div></td>
            <td>
              <div align="right">
                <?php

                echo "Page [ ";
                if ($txtpage > 1) {$prevpage = $txtpage - 1; echo  "<a href='#' onClick='showpage(".$prevpage.")'>&lt;&lt; Prev</a>";}
                for($page = 1; $page <= $jumPage; $page++)
                {
                 if ((($page >= $noPage - 10) && ($page <= $noPage + 10)) || ($page == 1) || ($page == $jumPage))
                 {
                  if (($showPage == 1) && ($page != 2))  echo "...";
                  if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
                  if ($page == $noPage) echo " <b>".$page."</b> ";
                  else echo " <a href='#!' onClick='showpage(".$page.")'>".$page."</a> ";
                  $showPage = $page;
                }
              }
              if ($txtpage < $jumPage) {$nextpage = $txtpage + 1; echo "<a href='#' onClick='showpage(".$nextpage.")'>Next &gt;&gt;</a>";}

              echo " ] ";

              ?>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </div>
  <FORM id="formexport" name="nmformexport" action="export.php" method="post" onsubmit="window.open ('', 'NewFormInfo', 'scrollbars,width=730,height=500')" target="NewFormInfo">
    <input id="sql" name="sql" type="hidden" value="<?=$sql?>">
  </FORM>
</body>
</html>
<?php
mysql_close($conn);
?>
