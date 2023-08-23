<?php

include("../../configuration.php");
include("../../connection.php");
include("../../endec.php");
include("akses.php");
require_once('calendar/classes/tc_calendar.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Form View Purchasing Supplier Shipment</title>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="expires" content="0">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    </head>


   <script language="javascript" src="calendar/calendar.js"></script>

    <link rel="stylesheet" href="../../theme/south-street/jquery-ui-1.8.13.custom.css">
    <!-- <script src="../../js/jquery-1.5.1.js"></script> -->
    <script src="../../js/ui/jquery.ui.core.js"></script>
    <script src="../../js/ui/jquery.ui.widget.js"></script>
    <script src="../../js/ui/jquery.ui.datepicker.js"></script>
    <link rel="stylesheet" href="css/demos.css">
    <link rel="stylesheet" href="css/table.css">

    <!-- MODAL DIALOG -->
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css"/>

    <?php
    $xrdm = date("YmdHis");
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css?verion=$xrdm\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/frmstyle.css?version=$xrdm\" />";
    ?>
    <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/frm1.js"></script>

    <!-- DATA TABLE -->
    <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="DataTables/js/dataTables.fixedColumns.min.js"></script>
    <link rel="stylesheet" href="DataTables/datatables.css"/>

    <!-- mask input -->
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>

    <!-- CHART -->
    <script type="text/javascript" src="Chart/Chart.min.js"></script>
    <script type="text/javascript" src="Chart/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="Chart/Chart.min.css"/>

    <body>
      <table id="tabelview" width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2">
                  <div align="left">
                    <span style="font-size: 14px;font:Arial, Helvetica, sans-serif;font-weight: bold;">
                      Form View Purchasing Supplier Shipment
                    </span>
                    <hr />
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <?php            
                  if(in_array(1, $id_tombol) == 1){
                  ?>
                    <!-- <INPUT id="cmdadd" class="buttonadd" type="button" name="nmcmdadd" value="Add New" onclick="addnewclick()">&nbsp; -->
                  <?php 
                  }
                  ?>
                  <?php            
                  if(in_array(1, $id_tombol) == 1){
                  ?>
                    <INPUT id="cmdget" class="buttonget" type="button" name="nmcmdget" value="Get Data" onclick="get_data()">&nbsp;
                  <?php 
                  }
                  ?>
                  <?php            
                  if(in_array(1, $id_tombol) == 1){
                  ?>
                    <INPUT id="cmdget" class="buttonget" type="button" name="nmcmdget" value="Get Data" onclick="dialog_getdata()">&nbsp;
                  <?php 
                  }
                  ?>
                  <INPUT id="cmdsearch" class="buttonfind" type="button" name="nmcmdsearch" value="Search" onclick="searchclick()">&nbsp;
                </td>
                <td>
                  <div align="right">
                    <INPUT id="cmdexport" class="buttonexport" type="button" name="nmcmdexport" value="Export" onclick="exportclick()">&nbsp;
                    <select id="exporttype">
                      <option value="xls" selected>Excel (.xls)</option>
                      <option value="ods" selected>Excel (.ods)</option>
                    </select>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td><hr></td>
        </tr>
        <tr>
          <td>
            <div id="areasearch">
              <fieldset class="info_fieldset"><legend>Search</legend>
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <table id="tblSearch">
                        <tr>
                          <td><label style="margin-left: 0px; padding: 0px; width: 110px;"> Data Order : </label> 
                            <select id="data_order">
                              <option value='' selected="">All Data</option>
                              <option value='rnd'>R & D</option>
                              <option value='prd'>Production</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><label style="margin-left: 0px; padding: 0px; width: 110px;">Jenis Suppplier : </label> 
                            <select id="jnssupp">
                              <option value='' selected="">All Data</option>
                              <option value='1'>Lokal</option>
                              <option value='2'>Import</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Field : 
                            <select class='txtfield' id="txtfield0" onchange="setFilterData(0)">
                              <option value=''>-</option>
                              <option value='pp_no'>No. PP</option>
                              <option value='pp_date'>Tgl. PP</option>
                              <option value='po_no'>No. PO</option>
                              <option value='po_date'>Tgl. PO</option>
                              <option value='no_order'>No. Order</option>
                              <option value='article'>Article</option>
                              <option value='user'>User</option>
                              <option value='nmsupp'>Supplier</option>
                            </select>
                          </td>
                          <td>
                            <select class='txtparameter' id="txtparameter0">
                              <option value='like'>like</option>
                              <option value='equal'>equal</option>
                              <option value='notequal'>not equal</option>
                              <option value='less'>less</option>
                              <option value='lessorequal'>less or equal</option>
                              <option value='greater'>greater</option>
                              <option value='greaterorequal'>greater or equal</option>
                              <option value='isnull'>is null</option>
                              <option value='isnotnull'>is not null</option>
                              <option value='isin'>is in</option>
                              <option value='isnotin'>is not in</option>
                            </select>
                          </td>
                          <td>
                            <div id='filter_data0'>Data : 
                              <input type="text" class="txtdata" id="txtdata0" onkeydown="enterfind(event)">
                            </div>
                          </td>
                          <td>
                            <input type="button" value="[+]" onclick="addSearch()">
                          </td>
                          <td>
                           <input type="button" value="clear" id="rmv1" onclick="deleteRow(this.id)" style="cursor:pointer;">
                         </td>
                        </tr>
                     </table>
                    </td>
                    <td valign='top'><INPUT id="cmdfind" class="buttongofind" type="button" name="nmcmdfind" value="Find" onclick="findclick()" style="margin-top: 7px;"></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <table width="100%">
                        <tr>
                          <td>
                            <div id="infoview" align="left">
                              view : <INPUT id="txtperpage" class="textbox" type="text" name="txtperpage" value="20" onkeydown="enterfind(event)">
                            </div>
                          </td>
                          <td style="text-align: right;">
                            <div id="infocmdpage" align="left" style="float: right;">
                              <INPUT id="cmdback" class="buttonback" type="button" name="nmcmdback" value="Prev" onclick="prevpage()">
                              <INPUT id="txtpage" class="textbox" type="text" name="nmtxtpage" value="1">
                              <INPUT id="cmdnext" class="buttonnext" type="button" name="nmcmdnext" value="Next" onclick="nextpage()">
                            </div>
                          </td>
                        </tr>
                      </table>    
                    </td>
                  </tr>
                </table>
              </fieldset>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div id="frmloading" align="center">
              <img src="img/ajax-loader.gif" />
            </div>
            <div id="frmbody">
              <div id="frmcontent">
              </div>
            </div>
          </td>
        </tr>
      </table>
      <table id="tabelinput" width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <input id="intxtmode" name="innmmode" type="hidden" value="">Mode: <span id="mode"></span>
          </td>
        </tr>
        <tr>
          <td><hr></td>
        </tr>
        <tr>
          <td>
            <div id="areaedit" style="display:none"></div>
            <div id="areainput"></div>
          </td>
        </tr>
      </table>

      <div id="dialog-open"></div>

    </body>

    </html>
    <?php
    mysql_close($conn);
    ?>
