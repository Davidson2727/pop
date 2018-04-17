

<?php
include_once 'dbconn.php';


 $rows = array();

 $sql = "SELECT * FROM employee";
 $result = $conn->query($sql) or die("cannot write");
 while($row = $result->fetch_assoc()){
 	$rows[] = $row;
 }

 echo "<pre>";
 print json_encode(array('data'=>$rows));
 echo "</pre>";

 ?>
