<?php
include("../../connection.php");
$q = strtolower($_GET['term']);
$query = "SELECT trim(kdsupp), trim(nmsupp) FROM kmmstsupp WHERE trim(kdsupp) LIKE '%$q%' OR trim(nmsupp) LIKE '%$q%' ORDER BY trim(nmsupp) limit 10";
$query = mysql_query($query);
$num = mysql_num_rows($query);

if($num > 0){
  	while ($row = mysql_fetch_array($query)){
      $row_set[] = array('value' => stripslashes($row[0]),'label' => stripslashes($row[1]));
  	}
echo json_encode($row_set);
}
?>