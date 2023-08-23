$(document).ready(function() {
    $("#indate_pp,#inexport_date,#inshipment_etd,#inshipment_eta,#ininvoice_finish,#ininvoice_partial").mask("99/99/9999");

    $.mask.definitions["*"] = null;
    $.mask.definitions["^"] = "[a-za-zA-Z0-9]";
    $("#innopo").mask("PO/^^^/^^^^^^/^^^^");

    $("#indept").focus();
});

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
    if (xid == "indept") {
      $("#inno_order").focus();
    }
    else if (xid == "inno_order") {
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
      $("#inremark").focus();
    }
    else if (xid == "inremark") {
      $("#insent_1").focus();
      $("#insent_1").select();
    }
    else if (xid == "insent_1") {
      $("#insent_2").focus();
      $("#insent_2").select();
    }
    else if (xid == "insent_2") {
      $("#insent_3").focus();
      $("#insent_3").select();
    }
    else if (xid == "insent_3") {
      $("#inbq").focus();
      $("#inbq").select();
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
      $("#cmdsavedetail").focus();
    }
  }
}