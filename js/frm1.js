$(document).ready(function(){
  $("#frmloading").hide();
  $("#tabelinput").hide();
  $("input[name=intype]").bind("keydown", function(event) {
    if (event.which === 13) {
        event.stopPropagation();
        event.preventDefault();
        $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
    }
  });
});

function enterfind(event){
  if(event.keyCode==13){
    findclick();
  }else{
    return ;
  }
}

function findclick(){
  var n = $(".txtfield").length;
  var txtfield = '';
  var txtparameter = '';
  var txtdata = '';
  var data = '';
  
  if(n > 1){
    $(".txtfield").each(function () {
      txtfield += $(this).val()+"|";
    });
    
    $(".txtparameter").each(function () {
      txtparameter += $(this).val()+"|";
    });
        
    $(".txtdata").each(function () {
      txtdata += $(this).val()+"|";
    });
            
    data = "txtpage="+$("#txtpage").val()+
         "&txtperpage="+$("#txtperpage").val()+
         "&txtfield="+txtfield+
         "&txtparameter="+txtparameter+
         "&txtdata="+txtdata+
         "&data_order=" + $("#data_order").val() +
         "&jns_supp=" + $("#jns_supp").val() +
         "";   
  }
  else{
    data = "txtpage="+$("#txtpage").val()+
         "&txtperpage="+$("#txtperpage").val()+
         "&txtfield="+$(".txtfield").val()+
         "&txtparameter="+$(".txtparameter").val()+
         "&txtdata="+$(".txtdata").val()+
         "&data_order=" + $("#data_order").val() +
         "&jnssupp=" + $("#jnssupp").val() +
         "";
  }
               
  $("#frmbody").slideUp('fast',function(){
    $("#frmloading").slideDown('fast',function(){
      $.ajax({
        url: "frmview.php",
        type: "POST",
        data: data,
        cache: false,
        success: function (html) {
                $("#frmcontent").html(html);
                $("#frmbody").slideDown('fast',function(){
                $("#frmloading").slideUp('fast');
                // console.log('find click');
        });
        }
      });
    });
  });
};

function showinput(){
  $.ajax({
    url: "frminput.php",
    cache: false,
    success: function(html) {
      $("#areainput").html(html);
    }
  });
}

function clearinput(){
  $("#indepartemen").val("prd");
  $("#inno_pp").val("");
  $("#indate_pp").val("");
  $("#inno_po").val("");
  $("#inno_order").val("");
  $("#inno").val("");
  $("#intype").val("");
  $("#inarticle").val("");
  $("#insize").val("");
  $("#incolor").val("");
  $("#inunit").val("");
  $("#inqty").val("");
  $("#inshipment_mode").val("");
  $("#inshipment_etd").val("");
  $("#inshipment_eta").val("");
  $("#inuser").val("");
  $("#inexport_date").val("");
  $("#invaluta").val("");
  $("#inprice").val("");
  $("#inamount").val("");
  $("#inremark").val("");
  $("#insent_1").val("");
  $("#insent_2").val("");
  $("#insent_3").val("");
  $("#inbq").val("");
  $("#ininvoice_no").val("");
  $("#ininvoice_finish").val("");
  $("#ininvoice_partial").val("");
}

function disabled(){
  $("#file").attr('disabled',true);
}

function enabled(){
  $("#file").attr('disabled',false);
}

function saveclick(){
  if (confirm("Simpan Data ?")){
    $("#cmdsave").attr('disabed','disabled');

    var data =  "intxtmode="+$("#intxtmode").val()+
                "&indepartemen="+encodeURIComponent($("#indepartemen").val())+
                "&inno_pp="+encodeURIComponent($("#inno_pp").val())+
                "&indate_pp="+encodeURIComponent($("#indate_pp").val())+
                "&inno_po="+encodeURIComponent($("#inno_po").val())+
                "&inno_order="+encodeURIComponent($("#inno_order").val())+
                "&inno="+encodeURIComponent($("#inno").val())+
                "&intype="+encodeURIComponent($("#intype").val())+
                "&inarticle="+encodeURIComponent($("#inarticle").val())+
                "&insize="+encodeURIComponent($("#insize").val())+
                "&incolor="+encodeURIComponent($("#incolor").val())+
                "&inunit="+encodeURIComponent($("#inunit").val())+
                "&inqty="+encodeURIComponent($("#inqty").val())+
                "&inshipment_mode="+encodeURIComponent($("#inshipment_mode").val())+
                "&inshipment_etd="+encodeURIComponent($("#inshipment_etd").val())+
                "&inshipment_eta="+encodeURIComponent($("#inshipment_eta").val())+
                "&inuser="+encodeURIComponent($("#inuser").val())+
                "&inexport_date="+encodeURIComponent($("#inexport_date").val())+
                "&invaluta="+encodeURIComponent($("#invaluta").val())+
                "&inprice="+encodeURIComponent($("#inprice").val())+
                "&inamount="+encodeURIComponent($("#inamount").val())+
                "&inremark="+encodeURIComponent($("#inremark").val())+
                "&insent_1="+encodeURIComponent($("#insent_1").val())+
                "&insent_2="+encodeURIComponent($("#insent_2").val())+
                "&insent_3="+encodeURIComponent($("#insent_3").val())+
                "&inbq="+encodeURIComponent($("#inbq").val())+
                "&ininvoice_no="+encodeURIComponent($("#ininvoice_no").val())+
                "&ininvoice_finish="+encodeURIComponent($("#ininvoice_finish").val())+
                "&ininvoice_partial="+encodeURIComponent($("#ininvoice_partial").val())+
                "";
    //alert(data);
    $.ajax({
      url: "actfrm.php",
      type: "POST",
      data: data,
      cache: false,
      success: function(data) {
        if ($("#intxtmode").val() == 'edit'){
          if (data == 0) {
            alert("Data Berhasil Disimpan");
            cancelclick();
          }
          else {
            alert(data);
          }
        }
        else {
          alert(data);
          clearinput();
        }
          $("#cmdsave").attr('disabed','');
      }
    });
  }
}

function save_detail(id){
  if (confirm("Simpan Data ?")){
    $("#cmdsavedetail").attr('disabed','disabled');

    var data =  "intxtmode=save_detail"+
                "&xid="+id+
                "&indept="+encodeURIComponent($("#indept").val())+
                "&inno_order="+encodeURIComponent($("#inno_order").val())+
                "&intype="+encodeURIComponent($("#intype").val())+
                "&inarticle="+encodeURIComponent($("#inarticle").val())+
                "&insize="+encodeURIComponent($("#insize").val())+
                "&incolor="+encodeURIComponent($("#incolor").val())+
                "&inshipment_mode="+encodeURIComponent($("#inshipment_mode").val())+
                "&inshipment_etd="+encodeURIComponent($("#inshipment_etd").val())+
                "&inshipment_eta="+encodeURIComponent($("#inshipment_eta").val())+
                "&inuser="+encodeURIComponent($("#inuser").val())+
                "&inexport_date="+encodeURIComponent($("#inexport_date").val())+
                "&inremark="+encodeURIComponent($("#inremark").val())+
                "&insent_1="+encodeURIComponent($("#insent_1").val())+
                "&insent_2="+encodeURIComponent($("#insent_2").val())+
                "&insent_3="+encodeURIComponent($("#insent_3").val())+
                "&inbq="+encodeURIComponent($("#inbq").val())+
                "&ininvoice_no="+encodeURIComponent($("#ininvoice_no").val())+
                "&ininvoice_finish="+encodeURIComponent($("#ininvoice_finish").val())+
                "&ininvoice_partial="+encodeURIComponent($("#ininvoice_partial").val())+
                "";
    //alert(data);
    $.ajax({
      url: "actfrm.php",
      type: "POST",
      data: data,
      cache: false,
      success: function(data) {
        alert(data);
        clearinput();
        $("#cmdsavedetail").attr('disabed','');
      }
    });
  }
}

function editclick() {
  var n = $("input:checked").length;
  if (n > 1) {
    alert("Maksimal 1 Data !");
  } else if (n == 0) {
    alert("Pilih Data !");
  } else {
    showinput();
    $("#intxtmode").val("edit");
    $("#mode").text("Edit");
    var data = "intxtmode=getedit&inprice_id=" + $("input:checked").val() + "";
    $.ajax({
      url: "actfrm.php",
      type: "POST",
      data: data,
      cache: false,
      success: function(data) {
        $("#areaedit").html(data);
        setinput();
        $("#tabelview").fadeOut("slow",function(){
          $("#tabelinput").fadeIn("slow");
        });

        $("#inprice_customer").focus();
      }
    });
  }
}

function deleteclick(){
  var n = $("input:checked").length;
  if(n == 0){
    alert('Pilih Data !');
  }
  else if (confirm("Hapus Data ?")){
    var check = $("#chk:checked").length;
    $("input:checked").each(function () {
      $("#intxtmode").val('delete');
      var data = "intxtmode=delete&inprice_id="+$(this).val()+"";
      $.ajax({
        url: "actfrm.php",
        type: "POST",
        data: data,
        cache: false,
        success: function(data) {
          if (n == 1) {
            alert("Data Berhasil Dihapus");
          }
        }
      });
    });
    if (n > 1) {
      alert("Data Berhasil Dihapus");
    }
    findclick();
  }
}

function setinput(){
  $("#inprice_id").val($("#getprice_id").text());
  $("#inprice_customer").val($("#getprice_customer").text());
  $("#inprice_article").val($("#getprice_article").text());
  $("#inprice_last").val($("#getprice_last").text());
  $("#inprice_material").val($("#getprice_material").text());
  $("#inprice_lining").val($("#getprice_lining").text());
  $("#inprice_valuta").val($("#getprice_valuta").text());
  $("#inprice_upper").val($("#getprice_upper").text());
  $("#inprice_lando").val($("#getprice_lando").text());
  $("#inprice_edgecolor").val($("#getprice_edgecolor").text());
  $("#inprice_strobel").val($("#getprice_strobel").text());
  $("#inprice_ricami").val($("#getprice_ricami").text());
  $("#inprice_amount").val($("#getprice_amount").text());
  $("#innama_customer").val($("#getnama_customer").text());
  $("#innama_valuta").val($("#getnama_valuta").text());
}

function cancelclick() {
    clearinput();
    $("#intxtmode").val('');
    $("#mode").text('');
    $("#tabelinput").fadeOut("slow", function() {
        $("#tabelview").fadeIn("slow");
        findclick();
    });
    $("#frmcontent").html("");
};

function searchclick(){
  if ($("#areasearch").is(":hidden")) {
    $("#areasearch").slideDown("slow");
  } else {
    $("#areasearch").slideUp("slow");
  }
}

function importclick(){
  if ($("#area_import").is(":hidden")) {
    $("#area_import").slideDown("slow");
  } else {
    $("#area_import").slideUp("slow");
  }
}

function setFilterData(rowx) {
  var xdata = $("#txtfield" + rowx).val();
  if (xdata == "pp_date" || xdata == "po_date") {
    var data_select = "Data : \n\
                      <input type='text' id=\"txtdata"+rowx+"\" class='txtdata' onkeydown='enterfind(event)'>\n\
                      <input type='hidden' id=\"txtdata"+rowx+"x\" class='txtdatax'>";
    $("#filter_data" + rowx).html(data_select);
    $("#txtdata" + rowx).mask("99/99/9999");
    $("#txtdata" + rowx).datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true
    });
  }
  else if(xdata == "nmsupp"){
    var data_select = "Data : \n\
                      <input type='text' id=\"txtdata"+rowx+"\" class='txtdata' onkeydown='enterfind(event)' onkeypress='get_supplier(this)'>\n\
                      <input type='hidden' id=\"txtdata"+rowx+"x\" class='txtdatax'>";
    $("#filter_data" + rowx).html(data_select);
  }
  else {
    var data_select = "Data : <input type='text' id=\"txtdata"+rowx+"\" class='txtdata' onkeydown='enterfind(event)'>";
    $("#filter_data" + rowx).html(data_select);
  }
}

function addnewclick() {
  showinput();
  clearinput();
  $("#intxtmode").val('add');
  $("#mode").text('Add New');
  $("#tabelview").fadeOut(function() {
      $("#tabelinput").fadeIn();
      $("#indepartemen").focus();
  });
};

function openDialog(id) {
  var data ="xid="+id;
  $.ajax({
    url: "frmview_detail.php",
    data: data, 
    type: "POST",
    cache: false,
    success: function(html) {
      $("#frmbody").slideDown("slow");
      $("#dialog-open").html(html);
      var width = screen.width;
      var height = screen.height;
      var lebar = width * 80 / 100;
      var tinggi = height * 55 / 100;

      $("#dialog-open").dialog({
        autoOpen: true,
        modal: true,
        height: tinggi,
        width: lebar,
        title: "Update Detail",
        close: function(event) {
          $("#dialog-open").hide();
          $("#dialog-open").html("");
        }
      });
    }
  })
}

function dialog_loading(){
  $.ajax({
    url: "frmmodal_loading.php",
    type: "POST",
    cache: false,
    success: function(html) {
      $("#frmbody").slideDown("slow");
      $("#dialog-open").html(html);

      var width = screen.width;
      var height = screen.height;
      var lebar = width * 20 / 100;
      var tinggi = height * 20 / 100;

      $("#dialog-open").dialog({
        autoOpen: true,
        modal: true,
        height: "150",
        width: "150",
        title: "Please Wait ...",
        my:'center',of:'center',collison:'fit',
        close: function(event) {
          $("#dialog-open").hide();
          $("#dialog-open").html("");
        }
      });
    }
  });
}

function dialog_getdata(){
  $.ajax({
    url: "frmview_getdata.php",
    // data: data,  
    type: "POST",
    cache: false,
    success: function(html) {
      $("#frmbody").slideDown("slow");
      $("#dialog-open").html(html);
      var width = screen.width;
      var height = screen.height;
      var lebar = width * 40 / 100;
      var tinggi = height * 40 / 100;

      $("#dialog-open").dialog({
        autoOpen: true,
        modal: true,
        height: tinggi,
        width: lebar,
        close: function(event) {
          $("#dialog-open").hide();
          $("#dialog-open").html("");
        }
      });
    }
  })
}

function get_customer(){
  $("#inuser").autocomplete({
    source: "get_customer.php",
    focus: function(event, ui) {
      event.preventDefault();
      $("#inuser").val(ui.item.value);
    },
    select: function (event, ui) {
      event.preventDefault();
      $("#inuser").val(ui.item.value);
    }
  });
}

function get_valuta(){
  $("#invaluta").autocomplete({
    source: "get_valuta.php",
    focus: function(event, ui) {
      event.preventDefault();
      $("#invaluta").val(ui.item.value);
    },
    select: function (event, ui) {
      event.preventDefault();
      $("#invaluta").val(ui.item.value);
    }
  });
}

function get_supplier(obj){
  $(obj).autocomplete({
    source: "get_supplier.php",
    focus: function(event, ui) {
      event.preventDefault();
      $(obj).val(ui.item.label);
    },
    select: function (event, ui) {
      event.preventDefault();
      $(obj).val(ui.item.label);
    }
  });
}

function get_data(){
  $.ajax({
      url: "actfrm.php",
      data: "intxtmode=get_data", 
      type: "POST",
      cache: false,
      beforeSend: function() {
        dialog_loading();
      },
      success: function(data) {
        $('#dialog-open').dialog('close');
        alert(data);
      }
  })
}

function show_edit(obj) {
  $(obj).css("background", "#2ecc71");
}

function save_row(obj,column,id){
  $(obj).css("background", "#f1c40f url(img/loading1.gif) no-repeat center right");

  var str = obj.innerHTML;
  str = str.replace(/<br>|<div>/,"");

  if ((column == "export_date" || column == "shipment_etd" || column == "shipment_eta" || column == "invoice_finish" || column == "invoice_partial") && str.replace(/\s/g, "") != "") {
    str = str.replace(/\s/g, "");
    if(checkValidDate(str)){
      $.ajax({
      url: "actfrm.php",
      data: "intxtmode=save_row&indata="+encodeURIComponent(str)+"&incolumn="+column+"&inid="+id, 
      type: "POST",
      cache: false,
      success: function(data) {
        if (data == 0) {
          $(obj).css("background", "#FFF");
        }
        else{
          $(obj).css("background", "#c0392b");
        }
      }
      })
    }
    else{
      alert("Format Tanggal Tidak Valid !");
      $(obj).text("");
      $(obj).css("background", "#FFF");
      return;
    }
  }
  else{
    $.ajax({
    url: "actfrm.php",
    data: "intxtmode=save_row&indata="+encodeURIComponent(str)+"&incolumn="+column+"&inid="+id, 
    type: "POST",
    cache: false,
    success: function(data) {
      if (data == 0) {
        $(obj).css("background", "#FFF");
      }
      else{
        $(obj).css("background", "#c0392b");
      }
    }
    })
  }


}

function number(e) {
  // Allow: backspace, delete, tab, escape, enter and .
  if (
      $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
      // Allow: Ctrl/cmd+A
      (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: Ctrl/cmd+C
      (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: Ctrl/cmd+V
      (e.keyCode == 86 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: Ctrl/cmd+X
      (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39) || (e.keyCode == 111) || (e.keyCode = 191)
  ) {
      // let it happen, don't do anything
      return;
  }
  // Ensure that it is a number and stop the keypress
  if (
      (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
      (e.keyCode < 96 || e.keyCode > 105)
  ) {
      e.preventDefault();
  }
}

function separate(obj){
  var x = (obj.innerHTML).replace("<br>","");
  // console.log(x);

  // if(x.length == 2){
  //   // x = x + "-";
  //   $(obj).text(x.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
  // }
  // else if (x.length == 5) {
  //   // x = x + "-";
  //   $(obj).text(x.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")); 
  // }
  // else if (x.length > 10){
  //   return;
  // }
                        if (x.match(/^\d{2}$/) !== null) {
                            $(obj).text(x + '-');
                        } else if (x.match(/^\d{2}\-\d{2}$/) !== null) {
                            $(obj).text(x + '-');
                        }
}

function exportclick() {
  var exptype = $("#exporttype").val();
  switch (exptype)
  {
  case 'xls':
    $("#formexport").attr('action', 'frmviewxls.php');
    $("#formexport").submit();
  break;
  case 'ods':
    $("#formexport").attr('action', 'frmviewods.php');
    $("#formexport").submit();
  break;
  default:
    alert('Unidentyfication Type');
  }
};

// ******************************* START JS MULTISEARCH ***************************************
var xrow = 2;
function addSearch(){
  var table = document.getElementById("tblSearch");

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(xrow);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        
//        cell2.className = 'txtmultisearch';

        // Add some text to the new cells:
        cell1.innerHTML = 
        "Field : \n\
        <select class='txtfield' id='txtfield" +
        xrow +
        "' onchange=\"setFilterData(" +
        xrow +
        ")\">\n\
        <option value=''>-</option>\n\
        <option value='pp_no'>No. PP</option>\n\
        <option value='pp_date'>Tgl. PP</option>\n\
        <option value='po_no'>No. PO</option>\n\
        <option value='po_date'>Tgl. PO</option>\n\
        <option value='no_order'>No. Order</option>\n\
        <option value='article'>Article</option>\n\
        <option value='user'>User</option>\n\
        <option value='nmsupp'>Supplier</option>\n\
        </div>\n\
        </select>";
        cell2.innerHTML = "<select class='txtparameter' id='txtparameter"+xrow+"'>\n\
        <option value='like'>like</option>\n\
        <option value='equal'>equal</option>\n\
        <option value='notequal'>not equal</option>\n\
        <option value='less'>less</option>\n\
        <option value='lessorequal'>less or equal</option>\n\
        <option value='greater'>greater</option>\n\
        <option value='greaterorequal'>greater or equal</option>\n\
        <option value='isnull'>is null</option>\n\
        <option value='isnotnull'>is not null</option>\n\
        <option value='isnotnull'>is not null</option>\n\
        <option value='isin'>is in</option>\n\
        <option value='isnotin'>is not in</option>\n\
        </select>";
        cell3.innerHTML = 
        "<div id='filter_data" +
          xrow +
          "'>Data : <input type='text' class='txtdata' onkeydown='enterfind(event)'></div>";
        cell4.innerHTML = "<input type='button' value='[+]' onclick='addSearch()'>";
        cell5.innerHTML = "<input type='button' value='remove' onclick=\"deleteRow(this)\" style='cursor:pointer;'>";
        
        xrow++;
      }

      function deleteRow(btn) {
      //
      if (btn == "rmv1") {
        $("#txtfield0").val("");
        $("#txtparameter0").val("equal");

        var data_select =
        "Data : <input type='text' class='txtdata' onkeydown='enterfind(event)'>";

        $("#filter_data0").html(data_select);
        $("#txtdata0").val("");
      } else {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        xrow--;
      }
    }

// ******************************* END JS MULTISEARCH ***************************************

function showpage(page){
  $("#txtpage").val(page);
  findclick();
}

function prevpage(){
  var n = eval($("#txtpage").val())-1 ;
  if (n >= 1) {
    $("#txtpage").val(n);
    findclick();
  }
}

function nextpage(){
  var n = eval($("#txtpage").val())+1 ;
  if (eval(n)<=eval($("#jumpage").val())){
    $("#txtpage").val(n);
    findclick();
  }
}

$(function() {
  $( "#tglmasuk" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#tglkontrak" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#intxttglmasuk" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#intxttglkontrak" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
});


function MyValidDate(dateString){
    var validformat=/^\d{1,2}\/\d{1,2}\/\d{4}$/ //Basic check for format validity
    if (!validformat.test(dateString)){
      return ''
    }else{ //Detailed check for valid date ranges
      var dayfield=dateString.substring(0,2);
      var monthfield=dateString.substring(3,5);
      var yearfield=dateString.substring(6,10);
      var MyNewDate = monthfield + "/" + dayfield + "/" + yearfield;
      if (checkValidDate(MyNewDate)==true){
        var SQLNewDate = yearfield + "/" + monthfield + "/" + dayfield;
        return SQLNewDate;
      }else{
        return '';
      }
    }
  }

  function checkValidDate(dateStr) {
    // dateStr must be of format month day year with either slashes
    // or dashes separating the parts. Some minor changes would have
    // to be made to use day month year or another format.
    // This function returns True if the date is valid.
    var slash1 = dateStr.indexOf("/");
    if (slash1 == -1) { slash1 = dateStr.indexOf("-"); }
    // if no slashes or dashes, invalid date
    if (slash1 == -1) { return false; }
    var dateMonth = dateStr.substring(0, slash1)
    var dateMonthAndYear = dateStr.substring(slash1+1, dateStr.length);
    var slash2 = dateMonthAndYear.indexOf("/");
    if (slash2 == -1) { slash2 = dateMonthAndYear.indexOf("-"); }
    // if not a second slash or dash, invalid date
    if (slash2 == -1) { return false; }
    var dateDay = dateMonthAndYear.substring(0, slash2);
    var dateYear = dateMonthAndYear.substring(slash2+1, dateMonthAndYear.length);
    if ( (dateMonth == "") || (dateDay == "") || (dateYear == "") ) { return false; }
    // if any non-digits in the month, invalid date
    for (var x=0; x < dateMonth.length; x++) {
      var digit = dateMonth.substring(x, x+1);
      if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text month to a number
    var numMonth = 0;
    for (var x=0; x < dateMonth.length; x++) {
      digit = dateMonth.substring(x, x+1);
      numMonth *= 10;
      numMonth += parseInt(digit);
    }
    if ((numMonth <= 0) || (numMonth > 12)) { return false; }
    // if any non-digits in the day, invalid date
    for (var x=0; x < dateDay.length; x++) {
      digit = dateDay.substring(x, x+1);
      if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text day to a number
    var numDay = 0;
    for (var x=0; x < dateDay.length; x++) {
      digit = dateDay.substring(x, x+1);
      numDay *= 10;
      numDay += parseInt(digit);
    }
    if ((numDay <= 0) || (numDay > 31)) { return false; }
    // February can't be greater than 29 (leap year calculation comes later)
    if ((numMonth == 2) && (numDay > 29)) { return false; }
    // check for months with only 30 days
    if ((numMonth == 4) || (numMonth == 6) || (numMonth == 9) || (numMonth == 11)) {
      if (numDay > 30) { return false; }
    }
    // if any non-digits in the year, invalid date
    for (var x=0; x < dateYear.length; x++) {
      digit = dateYear.substring(x, x+1);
      if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text year to a number
    var numYear = 0;
    for (var x=0; x < dateYear.length; x++) {
      digit = dateYear.substring(x, x+1);
      numYear *= 10;
      numYear += parseInt(digit);
    }
    // Year must be a 2-digit year or a 4-digit year
    if ( (dateYear.length != 2) && (dateYear.length != 4) ) { return false; }
    // if 2-digit year, use 50 as a pivot date
    if ( (numYear < 50) && (dateYear.length == 2) ) { numYear += 2000; }
    if ( (numYear < 100) && (dateYear.length == 2) ) { numYear += 1900; }
    if ((numYear <= 0) || (numYear > 9999)) { return false; }
    // check for leap year if the month and day is Feb 29
    if ((numMonth == 2) && (numDay == 29)) {
      var div4 = numYear % 4;
      var div100 = numYear % 100;
      var div400 = numYear % 400;
        // if not divisible by 4, then not a leap year so Feb 29 is invalid
        if (div4 != 0) { return false; }
        // at this point, year is divisible by 4. So if year is divisible by
        // 100 and not 400, then it's not a leap year so Feb 29 is invalid
        if ((div100 == 0) && (div400 != 0)) { return false; }
      }
    // date is valid
    return true;
  }
