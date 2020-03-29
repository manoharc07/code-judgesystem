<?php
  include_once "..\includes\dbConnector.php";
  $name=$_POST['name'];
  $email=$_POST['email'];
  $mob=$_POST['mob_no'];
  $usr=$_POST['username'];
  $pwd=$_POST['pwd'];
  $sql="INSERT INTO profile(UID,User_type,Name,Mob_no,Email,Username,pwd,score)
  VALUES (NULL,'norm','$name','$mob','$email','$usr','$pwd','0');";
  $result=mysqli_query($conn,$sql);
  if($result!=True){
    header("Location:http://localhost/judgesystem/index.php?feedback=exist");
  }
  else{
    header("Location:http://localhost/judgesystem/index.php?feedback=success");
  }
 ?>
