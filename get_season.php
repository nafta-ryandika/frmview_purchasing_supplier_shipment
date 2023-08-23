<?php
include("../../connection.php");

$q = strtolower($_GET['term']);
$query = "select trim(kdseason), trim(nmseason) from rpseason where trim(nmseason) like '%".$q."%' order by right(kdseason,4) desc, kdseason asc";
$query = mysql_query($query);
$num = mysql_num_rows($query);

if($num > 0){
  	while ($row = mysql_fetch_array($query)){
      $row_set[] = array('value' => stripslashes($row[0]),'label' => stripslashes($row[1]));
  	}
echo json_encode($row_set);
}
?>