<?php
$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="judgesystem";
$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
if(mysqli_connect_errno()){
  echo "Failed to connect" . mysqli_connect_errno();
}
?>
