<?php
include("../../connection.php");

$q = strtolower($_GET['term']);
$sql = "SELECT trim(kdvaluta) AS kdvaluta, trim(nmvaluta) AS nama FROM kmvaluta WHERE (trim(kdvaluta) LIKE '%$q%' OR  trim(nmvaluta) LIKE '%$q%') LIMIT 20";
$res = mysql_query($sql,$conn);
$row = mysql_num_rows($res);

if($row > 0){
  	while ($data = mysql_fetch_array($res)){
      $row_set[] = array('value' => stripslashes($data["kdvaluta"]));
	}
	echo json_encode($row_set);
}
