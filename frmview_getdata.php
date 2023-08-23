<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>

<fieldset class="info_fieldset" style="padding-right: 10px;">
	<!-- <br/>
	<input type="hidden" id="inxid">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
      <td>
        <select id="indata" onkeydown="enter(event,this.id)" style="margin-bottom: 5px; margin-left: 5px;" autofocus="">
          <option value="0">All Data</option>
          <option value="1">Tanggal PP</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>No. Order</label>
        <input id="inno_order" class="textbox" type="text" name="intype" style="width: 250px; margin: 5px;"  onkeydown="enter(event,this.id)" value="<?=$no_order?>"><br/>
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
  </table> -->
  <div id="tabs">
  <ul>
    <li><a href="#tabs-1">All Data</a></li>
    <li><a href="#tabs-2">Tanggal</a></li>
    <li><a href="#tabs-3">No. PP</a></li>
  </ul>
  <div id="tabs-1" style="margin: auto;" align="center">
    <input type="hidden" id="indatax" value="1">
    <INPUT id="cmdprocess" class="buttonprocess" type="button" name="nmcmdprocess" value="Process" onclick="dialog_getdata()">&nbsp;
  </div>
  <div id="tabs-2" style="margin: auto;" align="center">
    <input type="hidden" id="indatax" value="2">
    <label style="width: 50px; padding-left: 10px;">Tanggal</label>
    <input type="text" id="inpp_date1"> s/d
    <input type="text" id="inpp_date2"><br/>
    <INPUT id="cmdprocess" class="buttonprocess" type="button" name="nmcmdprocess" value="Process" onclick="dialog_getdata()">&nbsp;
  </div>  
  <div id="tabs-3" style="margin: auto;" align="center">
    <input type="hidden" id="indatax" value="3">
    <label style="width: 50px; padding-left: 10px;">No. PP</label>
    <input type="text" id="inpp_no"><br/>
    <INPUT id="cmdprocess" class="buttonprocess" type="button" name="nmcmdprocess" value="Process" onclick="dialog_getdata()">&nbsp;
  </div>
</div>
</fieldset>