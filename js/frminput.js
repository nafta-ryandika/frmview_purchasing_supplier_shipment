$(document).ready(function() {
    // $("input[name=intype], textarea[name=intype]").bind("keydown", function(event) {
    //     if (event.which === 13) {
    //         event.stopPropagation();
    //         event.preventDefault();
    //         $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
    //     }
    // });

    $("#indate_pp,#inexport_date,#inshipment_etd,#inshipment_eta,#ininvoice_finish,#ininvoice_partial").mask("99/99/9999");

    $.mask.definitions["*"] = null;
    $.mask.definitions["^"] = "[a-za-zA-Z0-9]";
    $("#innopo").mask("PO/^^^/^^^^^^/^^^^");

    $("#indepartemen").focus();
});

function get_detail_po(){
  if (event.which === 13) {
    $.ajax({
      url: "actfrm.php",
      type: "POST",
      data: "intxtmode=get_detail_po&innopo="+ $("#innopo").val(),
      cache: false,
      success: function(data) {
        if (data == 0) {
          alert("Data PO Tidak Ada !");
        }
        else {
          data = data.split("#@");

          $("#table_detail_po tbody tr").remove();

          for (var i = 0; i < data.length; i++) {
            var data_detail = data[i].split("|");

            var ddnopo = data_detail[0];
            var ddnopp = data_detail[1];
            var ddnobaris = data_detail[2];
            var ddkdbrg = data_detail[3];
            var ddsatbeli = data_detail[4];
            var ddqtypo = parseFloat(data_detail[5]);
            var ddhrgsatuan = parseFloat(data_detail[6]);
            var dddisc1 = parseFloat(data_detail[7]);
            var dddisc2 = parseFloat(data_detail[8]);
            var ddsubtot = parseFloat(data_detail[9]);
            var pokdsupp = data_detail[10];
            var povaluta = data_detail[11];
            var tglpp = data_detail[12];
            var nmbrg = data_detail[13];
            var nmsupp = data_detail[14];
            var amount = data_detail[15];
          
            var table = document.getElementById('table_detail_po').getElementsByTagName('tbody')[0];
            var row = table.insertRow(0);

              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);
              var cell4 = row.insertCell(3);
              var cell5 = row.insertCell(4);
              var cell6 = row.insertCell(5);

              cell1.style.textAlign = "left";
              cell2.style.textAlign = "left";
              cell3.style.textAlign = "left";
              cell4.style.textAlign = "center";
              cell5.style.textAlign = "right";
              cell6.style.textAlign = "center";

              cell1.innerHTML = "<span>" + ddnopp.toUpperCase() + "</span>";
              cell2.innerHTML = "<span>" + ddnopo.toUpperCase() + "</span>";
              cell3.innerHTML = "<span>" + ddkdbrg.toUpperCase() +" - "+ nmbrg.toUpperCase() + "</span>";
              cell4.innerHTML = "<span>" + ddsatbeli.toUpperCase() + "</span>";
              cell5.innerHTML = "<span>" + ddqtypo + "</span>";
              cell6.innerHTML = "<input class='buttonchecked' type='button' value='Select' onclick=\"set_detail_po('"+ddnopo+"','"+ddnopp+"','"+ddnobaris+"','"+ddkdbrg+"','"+ddsatbeli+"','"+ddqtypo+"','"+ddhrgsatuan+"','"+dddisc1+"','"+dddisc2+"','"+ddsubtot+"','"+pokdsupp+"','"+povaluta+"','"+tglpp+"','"+nmbrg+"','"+nmsupp+"','"+amount+"')\">";
          }

          $("#table_detail_po tbody tr").each(function(){
          $(this)
              .attr("class", "normal")
              .attr("onMouseOver", "this.className='highlight'")
              .attr("onMouseOut", "this.className='normal'")
              .attr("style", "cursor: pointer")
              // .attr("onclick", "set_detail_po('"+ddnopo+"','"+ddnopp+"','"+ddnobaris+"','"+ddkdbrg+"','"+ddsatbeli+"','"+ddqtypo+"','"+ddhrgsatuan+"','"+dddisc1+"','"+dddisc2+"','"+ddsubtot+"','"+pokdsupp+"','"+povaluta+"','"+tglpp+"','"+nmbrg+"','"+nmsupp+"')")
              ;
          });
        }
      }
    });
  }
}

function set_detail_po(ddnopo,ddnopp,ddnobaris,ddkdbrg,ddsatbeli,ddqtypo,ddhrgsatuan,dddisc1,dddisc2,ddsubtot,pokdsupp,povaluta,tglpp,nmbrg,nmsupp,amount){
  $("#inno_pp").val(ddnopp);
  $("#indate_pp").val(tglpp);
  $("#inno_po").val(ddnopo);
  $("#inno").val(ddnobaris);
  $("#inunit").val(ddsatbeli);
  $("#inqty").val(ddqtypo);
  $("#invaluta").val(povaluta);
  $("#inprice").val(ddhrgsatuan);
  $("#inamount").val(amount);
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
        (e.keyCode >= 35 && e.keyCode <= 39)
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

function enter(event, xid){
  if (event.keyCode == 13) {
    if (xid == "indepartemen") {
      $("#innopo").focus();
    }
    else if (xid == "inno_pp") {
      $("#indate_pp").focus();
    }
    else if (xid == "indate_pp") {
      $("#inno_po").focus();
    }
    else if (xid == "inno_po") {
      $("#inno_order").focus();
    }
    else if (xid == "inno_order") {
      $("#inno").focus();
    }
    else if (xid == "inno") {
      $("#intype").focus();
    }
    else if (xid == "intype") {
      $("#inarticle").focus();
    }
    else if (xid == "inarticle") {
      $("#insize").focus();
    }
    else if (xid == "insize") {
      $("#incolor").focus();
    }
    else if (xid == "incolor") {
      $("#inunit").focus();
    }
    else if (xid == "inunit") {
      $("#inqty").focus();
    }
    else if (xid == "inqty") {
      $("#inshipment_mode").focus();
    }
    else if (xid == "inshipment_mode") {
      $("#inshipment_etd").focus();
    }
    else if (xid == "inshipment_etd") {
      $("#inshipment_eta").focus();
    }
    else if (xid == "inshipment_eta") {
      $("#inuser").focus();
    }
    else if (xid == "inuser") {
      $("#inexport_date").focus();
    }
    else if (xid == "inexport_date") {
      $("#invaluta").focus();
    }
    else if (xid == "invaluta") {
      $("#inprice").focus();
    }
    else if (xid == "inprice") {
      $("#inamount").focus();
    }
    else if (xid == "inamount") {
      $("#inremark").focus();
    }
    else if (xid == "inremark") {
      $("#insent_1").focus();
    }
    else if (xid == "insent_1") {
      $("#insent_2").focus();
    }
    else if (xid == "insent_2") {
      $("#insent_3").focus();
    }
    else if (xid == "insent_3") {
      $("#inbq").focus();
    }
    else if (xid == "inbq") {
      $("#ininvoice_no").focus();
    }
    else if (xid == "ininvoice_no") {
      $("#ininvoice_finish").focus();
    }
    else if (xid == "ininvoice_finish") {
      $("#ininvoice_partial").focus();
    }
    else if (xid == "ininvoice_partial") {
      // $("#ininvoice_partial").focus();
    }
  }
}