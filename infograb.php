<?php
include_once 'dbconn.php';
$sql = "SELECT * FROM employee;";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
  while($row = mysqli_fetch_array($result))
    {
        $data['ssn'] = $row['ssn'];
        $data['dob'] = $row['dob'];
        $data['fn'] = $row['fn'];
        $data['mi'] = $row['mi'];
        $data['ln'] = $row['ln'];
        
            }
            echo json_encode($data);
          }

 ?>
