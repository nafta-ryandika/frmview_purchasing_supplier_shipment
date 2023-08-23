<?php
  include("../../configuration.php");
  include("../../connection.php");
  include("../../endec.php");

  if(isset($_POST['intxtmode'])){
    $intxtmode = $_POST['intxtmode'];
  }

  if(isset($_POST['innopo'])){
    $innopo = strtoupper(trim(mysql_escape_string($_POST['innopo'])));
  }

  if(isset($_POST['indept'])){
    $indept = strtoupper(trim(mysql_escape_string($_POST['indept'])));
  }

  if(isset($_POST['inno_pp'])){
    $inno_pp = strtoupper(trim(mysql_escape_string($_POST['inno_pp'])));
  }
  
  if(isset($_POST['indate_pp'])){
    $indate_pp = strtr($_POST['indate_pp'], '/', '-');
    $indate_pp = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($indate_pp))));
  }
  
  if(isset($_POST['inno_po'])){
    $inno_po = strtoupper(trim(mysql_escape_string($_POST['inno_po'])));
  }
  
  if(isset($_POST['inno_order'])){
    $inno_order = strtoupper(trim(mysql_escape_string($_POST['inno_order'])));
  }
  
  if(isset($_POST['intype'])){
    $intype = strtoupper(trim(mysql_escape_string($_POST['intype'])));
  }
  
  if(isset($_POST['inarticle'])){
    $inarticle = strtoupper(trim(mysql_escape_string($_POST['inarticle'])));
  }
  
  if(isset($_POST['insize'])){
    $insize = strtoupper(trim(mysql_escape_string($_POST['insize'])));
  }
  
  if(isset($_POST['incolor'])){
    $incolor = strtoupper(trim(mysql_escape_string($_POST['incolor'])));
  }
  
  if(isset($_POST['inshipment_mode'])){
    $inshipment_mode = strtoupper(trim(mysql_escape_string($_POST['inshipment_mode'])));
  }
  
  if(isset($_POST['inshipment_etd'])){
    $inshipment_etd = strtr($_POST['inshipment_etd'], '/', '-');
    $inshipment_etd = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($inshipment_etd))));
  }
  
  if(isset($_POST['inshipment_eta'])){
    $inshipment_eta = strtr($_POST['inshipment_eta'], '/', '-');
    $inshipment_eta = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($inshipment_eta))));
  }
  
  if(isset($_POST['inuser'])){
    $inuser = strtoupper(trim(mysql_escape_string($_POST['inuser'])));
  }
  
  if(isset($_POST['inexport_date'])){
    $inexport_date = strtr($_POST['inexport_date'], '/', '-');
    $inexport_date = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($inexport_date))));
  }
  
  if(isset($_POST['inremark'])){
    $inremark = strtoupper(trim(mysql_escape_string($_POST['inremark'])));
  }
  
  if(isset($_POST['insent_1'])){
    $insent_1 = strtoupper(trim(mysql_escape_string($_POST['insent_1'])));
  }
  
  if(isset($_POST['insent_2'])){
    $insent_2 = strtoupper(trim(mysql_escape_string($_POST['insent_2'])));
  }
  
  if(isset($_POST['insent_3'])){
    $insent_3 = strtoupper(trim(mysql_escape_string($_POST['insent_3'])));
  }
  
  if(isset($_POST['inbq'])){
    $inbq = strtoupper(trim(mysql_escape_string($_POST['inbq'])));
  }
  
  if(isset($_POST['ininvoice_no'])){
    $ininvoice_no = strtoupper(trim(mysql_escape_string($_POST['ininvoice_no'])));
  }
  
  if(isset($_POST['ininvoice_finish'])){
    $ininvoice_finish = strtr($_POST['ininvoice_finish'], '/', '-');
    $ininvoice_finish = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($ininvoice_finish))));
  }
  
  if(isset($_POST['ininvoice_partial'])){
    $ininvoice_partial = strtr($_POST['ininvoice_partial'], '/', '-');
    $ininvoice_partial = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($ininvoice_partial))));
  }

  if(isset($_POST['xid'])){
    $xid = strtoupper(trim(mysql_escape_string($_POST['xid'])));
  }

  if($intxtmode=='get_detail_po') {
    $sql = "SELECT 
              dt1.*, dt2.*,
              (DATE_FORMAT((SELECT tglpp FROM kmppbelih WHERE nopp = ddnopp),'%d/%m/%Y')) AS tglpp,
              (SELECT trim(nmbrg) FROM kmmstbhnbaku WHERE kdbrg = ddkdbrg) AS nmbrg,
              (SELECT trim(nmsupp) FROM kmmstsupp WHERE kdsupp = pokdsupp) AS nmsupp,
              (ddqtypo * ddhrgsatuan) AS amount
            FROM 
            (
              SELECT 
              ddnopo, ddnopp, ddnobaris, ddkdbrg, ddsatbeli, ddqtypo, ddhrgsatuan, dddisc1, dddisc2, ddsubtot
              FROM kmpodd 
              WHERE ddnopo = '".$innopo."'
            )dt1
            LEFT JOIN 
            (
              SELECT 
              pono, pokdsupp, povaluta
              FROM kmpoh
              WHERE pono = '".$innopo."'
            )dt2
            ON dt1.ddnopo = dt2.pono
            ORDER BY dt1.ddnobaris desc";
    $res = mysql_query($sql,$conn);
    $row = mysql_num_rows($res);
    $data_detail = "";

    if ($row > 0) {
      while ($data = mysql_fetch_array($res)) {
        $ddnopo = strtoupper(trim(mysql_escape_string($data["ddnopo"])));
        $ddnopp = strtoupper(trim(mysql_escape_string($data["ddnopp"])));
        $ddnobaris = strtoupper(trim(mysql_escape_string($data["ddnobaris"])));
        $ddkdbrg = strtoupper(trim(mysql_escape_string($data["ddkdbrg"])));
        $ddsatbeli = strtoupper(trim(mysql_escape_string($data["ddsatbeli"])));
        $ddqtypo = strtoupper(trim(mysql_escape_string($data["ddqtypo"])));
        $ddhrgsatuan = strtoupper(trim(mysql_escape_string($data["ddhrgsatuan"])));
        $dddisc1 = strtoupper(trim(mysql_escape_string($data["dddisc1"])));
        $dddisc2 = strtoupper(trim(mysql_escape_string($data["dddisc2"])));
        $ddsubtot = strtoupper(trim(mysql_escape_string($data["ddsubtot"])));
        $pokdsupp = strtoupper(trim(mysql_escape_string($data["pokdsupp"])));
        $povaluta = strtoupper(trim(mysql_escape_string($data["povaluta"])));
        $tglpp = strtoupper(trim(mysql_escape_string($data["tglpp"])));
        $nmbrg = strtoupper(trim(htmlspecialchars($data["nmbrg"])));
        $nmsupp = strtoupper(trim(mysql_escape_string($data["nmsupp"])));
        $amount = (float) $data["amount"];

        $data_detail .= $ddnopo."|".$ddnopp."|".$ddnobaris."|".$ddkdbrg."|".$ddsatbeli."|".$ddqtypo."|".$ddhrgsatuan."|".$dddisc1."|".$dddisc2."|".$ddsubtot."|".$pokdsupp."|".$povaluta."|".$tglpp."|".$nmbrg."|".$nmsupp."|".$amount."#@";
      }
    }
    else {
      echo(0);
    }
    echo(rtrim($data_detail,"#@"));
  }
  elseif($intxtmode=='add') {
    $sql = "INSERT INTO tbl_pch_supplier_shipment 
            (id, departemen, no_pp, date_pp, no_po, no_order, no, type, article, size, color, unit, qty, shipment_mode,
             shipment_etd, shipment_eta, user, export_date, price, amount, remark, sent_1, sent_2, sent_3, bq, invoice_no, 
             invoice_finish, invoice_partial,access,komp,userby) 
            VALUES 
            ('', 
            '".$indepartemen."', 
            '".$inno_pp."', 
            '".$indate_pp."', 
            '".$inno_po."', 
            '".$inno_order."', 
            '".$inno."', 
            '".$intype."', 
            '".$inarticle."', 
            '".$insize."', 
            '".$incolor."', 
            '".$inunit."', 
            '".$inqty."', 
            '".$inshipment_mode."', 
            '".$inshipment_etd."', 
            '".$inshipment_eta."', 
            '".$inuser."', 
            '".$inexport_date."', 
            '".$inprice."', 
            '".($inprice*$inqty)."', 
            '".$inremark."', 
            '".$insent_1."', 
            '".$insent_2."', 
            '".$insent_3."', 
            '".$inbq."', 
            '".$ininvoice_no."', 
            '".$ininvoice_finish."',
            '".$ininvoice_partial."',
            NOW(), 
            '".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."', 
            '".$_SESSION[$domainApp."_myname"]."'
            )";

    if (!mysql_query($sql,$conn)){
      die('Error (Insert): ' . mysql_error());
    }

    echo "Data Berhasil Disimpan";
  }
  elseif ($intxtmode == "get_data") {
    $sql = "SELECT dt3.* FROM
            (
              SELECT * FROM 
              (
                SELECT nopp, IF(tgltrmpp IS NULL, 0, IF(komptrmpp IS NULL, 0, IF(usrtrmpp IS NULL, 0, 1))) AS trmpp 
                FROM kmppbelih
                WHERE YEAR(tglpp) = YEAR(curdate()) AND MONTH(tglpp) >= MONTH(CURDATE() - INTERVAL 1 month)
              )dt1
              WHERE trmpp = 1
            )dt2
            LEFT JOIN 
            (
              SELECT dnopp, dtglpp, dnopp_baris, dkdbrg, dqty, dsatbeli, dsatpakai, dtglbth, dqtypo
              FROM kmppbelid
              WHERE YEAR(dtglpp) = YEAR(curdate()) AND MONTH(dtglpp) >= MONTH(CURDATE() - INTERVAL 1 month)
            )dt3
            ON dt2.nopp = dt3.dnopp
            ORDER BY dt3.dnopp, dtglpp, dnopp_baris";

    $res = mysql_query($sql,$conn);
    $row = mysql_num_rows($res);

    if ($row > 0) {
      while ($data = mysql_fetch_array($res)) {
        $pp_no = $data["dnopp"];
        $pp_date = $data["dtglpp"];
        $pp_baris = $data["dnopp_baris"];
        $pp_kdbrg = $data["dkdbrg"];
        $pp_satuan = $data["dsatbeli"];
        $pp_qty = $data["dqty"];

        $sql1 = "SELECT * FROM tbl_pch_supplier_shipment 
                 WHERE pp_no = '".$pp_no."' AND pp_baris = '".$pp_baris."' AND pp_kdbrg = '".$pp_kdbrg."'";
        $res1 = mysql_query($sql1,$conn);
        $row1 = mysql_num_rows($res1);

        if ($row1 <= 0) {
          $sql2 = "SELECT * FROM 
                  (
                    SELECT 
                    ddnopo, ddnopp, ddnobaris, ddkdbrg, ddsatbeli, ddqtypp, ddqtypo, ddhrgsatuan, dddisc1, dddisc2, ddsubtot 
                    FROM kmpodd
                    WHERE ddnopp = '".$pp_no."' AND ddnobaris = '".$pp_baris."' AND ddkdbrg = '".$pp_kdbrg."' AND ddsatbeli = '".$pp_satuan."'
                  )dt1
                  LEFT JOIN 
                  (
                    SELECT pono, potgl, pokdsupp, povaluta, pokurs
                    FROM kmpoh
                  )dt2
                  ON dt1.ddnopo = dt2.pono";

          $res2 = mysql_query($sql2,$conn);
          $row2 = mysql_num_rows($res2);

          if ($row2 > 0) {
            while ($data2 = mysql_fetch_array($res2)) {
              $po_no = $data2["ddnopo"];
              $po_date = $data2["potgl"];
              $po_kdsupp = $data2["pokdsupp"];
              $po_valuta = $data2["povaluta"];
              $po_kurs = $data2["pokurs"];
              $po_qty = $data2["ddqtypo"];
              $po_price = $data2["ddhrgsatuan"];
              $po_subtotal = $data2["ddsubtot"];
            }

            $sql3 = "INSERT INTO tbl_pch_supplier_shipment 
                    (id, dept, pp_no, pp_date, pp_baris, pp_kdbrg, pp_qty, pp_satuan, po_no, 
                    po_date, po_kdsupp, po_valuta, po_kurs, po_qty, po_price, po_subtotal, access, komp, userby) 
                    VALUES
                    ('',
                     '', 
                     '".$pp_no."', 
                     '".$pp_date."', 
                     '".$pp_baris."', 
                     '".$pp_kdbrg."', 
                     '".$pp_qty."', 
                     '".$pp_satuan."', 
                     '".$po_no."', 
                     '".$po_date."', 
                     '".$po_kdsupp."', 
                     '".$po_valuta."', 
                     '".$po_kurs."', 
                     '".$po_qty."', 
                     '".$po_price."', 
                     '".$po_subtotal."', 
                     NOW(), 
                     '".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."', 
                     '".$_SESSION[$domainApp."_myname"]."'
                    )";

            if (!mysql_query($sql3,$conn)){
              die('Error (Insert): ' . mysql_error());
            }
          }
        }
        else {
          $data1 = mysql_fetch_array($res1);
          $po_no = $data1["po_no"];
        }
      }
    }


  }
  elseif($intxtmode=='save_detail') {
    $sql = "UPDATE tbl_pch_supplier_shipment 
            SET
            dept = '".$indept."', 
            no_order = '".$inno_order."', 
            type = '".$intype."', 
            article = '".$inarticle."', 
            size = '".$insize."', 
            color = '".$incolor."', 
            shipment_mode = '".$inshipment_mode."', 
            shipment_etd = '".$inshipment_etd."', 
            shipment_eta = '".$inshipment_eta."', 
            user = '".$inuser."', 
            export_date = '".$inexport_date."', 
            remark = '".$inremark."', 
            sent_1 = '".$insent_1."',
            sent_2 = '".$insent_2."',
            sent_3 = '".$insent_3."',
            bq = '".$inbq."',
            invoice_no = '".$ininvoice_no."',
            invoice_finish = '".$ininvoice_finish."',
            invoice_partial = '".$ininvoice_partial."',
            access = NOW(), 
            komp = '".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."', 
            userby = '".$_SESSION[$domainApp."_myname"]."'
            WHERE id = '".$xid."'";

    if (!mysql_query($sql,$conn)){
      die('Error (Update): ' . mysql_error());
    }

    echo "Data Berhasil Di Simpan";
  }
  elseif($intxtmode=='save_row') {
    if(isset($_POST['incolumn'])){
      $incolumn = trim(mysql_escape_string($_POST['incolumn']));
    }

    if(isset($_POST['indata'])){
      $indata = strtoupper(trim(mysql_escape_string($_POST['indata'])));
      $indata = str_replace("<BR>", "", $indata);

      if($incolumn == "export_date" || $incolumn == "shipment_etd" || $incolumn == "shipment_eta" || $incolumn == "invoice_finish" || $incolumn == "invoice_partial"){
        if ($indata != "") {
          $indata = strtr($indata, '/', '-');
          $indata = strtoupper(htmlspecialchars(date("Y-m-d", strtotime($indata))));
        }
      }
    }

    if(isset($_POST['inid'])){
      $inid = strtoupper(trim(mysql_escape_string($_POST['inid'])));
    }


    $sql = "UPDATE tbl_pch_supplier_shipment
            SET
            ".$incolumn." = '".$indata."'
            WHERE id = '".$inid."'";

    if (!mysql_query($sql,$conn)){
      die('Error (Update): ' . mysql_error());
    }

    echo "0";
  }

// close connection !!!!
mysql_close($conn)


?>