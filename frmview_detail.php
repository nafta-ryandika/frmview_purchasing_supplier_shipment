<?php
	$xrdm = date("YmdHis");
	include("../../connection.php");

	if(isset($_POST['xid'])){
    $xid = $_POST['xid'];
  }

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
         WHERE id =  ".$xid."";

	$res = mysql_query($sql,$conn);
	$row = mysql_num_rows($res);

	while ($data = mysql_fetch_array($res)) {
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
	}
?>

<script type="text/javascript" src="js/frmview_detail.js?version=<?=$xrdm?>"></script>
<fieldset class="info_fieldset" style="padding-right: 10px;"><legend>Form Input Detail -> <?=$nmbrg?> </legend>
	<br/>
	<input type="hidden" id="inxid">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
      <td style="">
        <label>Departement</label>
        <select name="indept" id="indept" onkeydown="enter(event,this.id)" style="margin-bottom: 5px; margin-left: 5px;" autofocus="">
          <option value="prd">Production</option>
          <option value="rnd">R & D</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>No. Order</label>
        <input id="inno_order" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$no_order?>"><br/>
      </td>
      <td>
        <label>Export Date</label>
        <input id="inexport_date" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$tgl_export?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Type</label>
        <input id="intype" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$type?>"><br/>
      </td>
      <td>
        <label>Remark</label>
        <input id="inremark" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$remark?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Article</label>
        <input id="inarticle" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$article?>"><br/>
      </td>
      <td>
      	<label>Sent 1</label>
        <input id="insent_1" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id)" value="<?=$sent_1?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Size</label>
        <input id="insize" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$size?>"><br/>
      </td>
      <td>
        <label>Sent 2</label>
        <input id="insent_2" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);" value="<?=$sent_2?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Color</label>
        <input id="incolor" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$color?>"><br/>
      </td>
      <td>
        <label>Sent 3</label>
        <input id="insent_3" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);" value="<?=$sent_3?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Shipment Mode</label>
        <input id="inshipment_mode" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$tgl_shipment_mode?>"><br/>
      </td>
      <td>
        <label>BQ.</label>
        <input id="inbq" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);" value="<?=$bq?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Shipment Etd.</label>
        <input id="inshipment_etd" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$tgl_shipment_etd?>"><br/>
      </td>
      <td>
        <label>No. Invoice</label>
        <input id="ininvoice_no" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$invoice_no?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Shipment Eta.</label>
        <input id="inshipment_eta" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$tgl_shipment_eta?>"><br/>
      </td>
      <td>
      	<label>Invoice Finish</label>
        <input id="ininvoice_finish" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$tgl_invoice_finish?>"><br/>
      </td>
    </tr>
    <tr>
      <td>
        <label>User</label>
        <input id="inuser" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeypress="get_customer()" onkeydown="enter(event,this.id)" value="<?=$user?>"><br/>
      </td>
      <td>
      	<label>Invoice Partial</label>
        <input id="ininvoice_partial" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)" value="<?=$tgl_invoice_partial?>"><br/>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      	<br/>
        <div align="center">
          <input id="cmdsavedetail" class="buttonadd" type="button" name="nmcmdsave" value="Save" onclick="save_detail('<?=$xid?>')">
          <input id="cmdcanceldetail" class="buttondelete" type="button" name="nmcmdcancel" value="Cancel" onclick="cancelclick()">
        </div>
      </td>
    </tr>
  </table>
</fieldset>