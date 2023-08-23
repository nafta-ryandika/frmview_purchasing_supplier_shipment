<?php
  $xrdm = date("YmdHis");
  include("../../configuration.php");
  include("../../connection.php");
?>
<script type="text/javascript" src="js/frminput.js?version=<?=$xrdm?>"></script>

<fieldset class="info_fieldset"><legend>Form Input</legend>
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="">
        <label>Departement</label>
        <select name="indepartemen" id="indepartemen" onkeydown="enter(event,this.id)" style="margin-bottom: 5px; margin-left: 5px;" autofocus="">
          <option value="prd">Production</option>
          <option value="rnd">R & D</option>
        </select>
      </td>
    </tr>
    <tr>
      <td style="">
        <label>No. PO</label>
        <input id="innopo" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px;" onkeydown="get_detail_po(event)"><br/>
      </td>
    </tr>
    <tr>
      <td style="" valign="top">
        <fieldset class="info_fieldset"><legend>Detail PO</legend>
          <table id="table_detail_po" class="table" width="100%"  border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>No. PP</th>
                <th>No. PO</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Qty.</th>
                <th>...</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <label>No. PP</label>
              <input id="inno_pp" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>User</label>
              <input id="inuser" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeypress="get_customer()" onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Tgl. PP</label>
              <input id="indate_pp" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Export Date</label>
              <input id="inexport_date" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>No. PO</label>
              <input id="inno_po" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Valuta</label>
              <input id="invaluta" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeypress="get_valuta()"  onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>No. Order</label>
              <input id="inno_order" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Price</label>
              <input id="inprice" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>No</label>
              <input id="inno" class="textbox" type="text" name="intype" style="width: 20px; margin: 5px; text-align: center;" onkeydown="number(event); enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Amount</label>
              <input id="inamount" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Type</label>
              <input id="intype" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Remark</label>
              <input id="inremark" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Article</label>
              <input id="inarticle" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Sent 1</label>
              <input id="insent_1" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Size</label>
              <input id="insize" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Sent 2</label>
              <input id="insent_2" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Color</label>
              <input id="incolor" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Sent 3</label>
              <input id="insent_3" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Unit</label>
              <input id="inunit" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>BQ.</label>
              <input id="inbq" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Qty.</label>
              <input id="inqty" class="textbox" type="text" name="intype" style="width: 150px; margin: 5px; text-align: right;" onkeydown="number(event); enter(event,this.id);"><br/>
            </td>
            <td>
              <label>No. Invoice</label>
              <input id="ininvoice_no" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Shipment Mode</label>
              <input id="inshipment_mode" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Invoice Finish</label>
              <input id="ininvoice_finish" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Shipment Etd.</label>
              <input id="inshipment_etd" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
            <td>
              <label>Invoice Partial</label>
              <input id="ininvoice_partial" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
          <tr>
            <td>
              <label>Shipment Eta.</label>
              <input id="inshipment_eta" class="textbox" type="text" name="intype" style="width: 80px; margin: 5px;" onkeydown="enter(event,this.id)"><br/>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input id="cmdsave" class="buttonadd" type="button" name="nmcmdsave" value="Save" onclick="saveclick()">
          <input id="cmdcancel" class="buttondelete" type="button" name="nmcmdcancel" value="Cancel" onclick="cancelclick()">
        </div>
      </td>
    </tr>
  </table>
</fieldset>

<!--     id, departemen, supplier, no_pp, date_pp, no_po, no_order, `no`, `type`, article, size, color, unit, qty, shipment_mode, shipment_etd, shipment_eta, user, export_date, price, amount, remark, sent_1, sent_2, sent_3, bq, invoice_no, invoice_finish, invoice_partial -->