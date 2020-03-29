<?php
  $name=$_POST['prob_name'];
  $score=$_POST['score'];
  $stmt=$_POST['Statement'];
  $const=$_POST['const'];
  $samp=$_POST['sample'];
  $inp=$_POST['input'];
  $out=$_POST['output'];
  include_once "..\includes\dbConnector.php";
  $sql="INSERT INTO problems(prob_id,prob_name,score)values(NULL,'$name','$score')";
  $result=mysqli_query($conn,$sql);
  if($result!=false){
    $id=mysqli_insert_id($conn);
    $file_path='..\problems\prob'.$id.'.html' ;
    $fp=fopen($file_path,'w');
    fwrite($fp,'<b>Statement</b><br>');
    fwrite($fp,$stmt);
    fwrite($fp,'<br><b>Constraints</b><br>');
    fwrite($fp,$const);
    fwrite($fp,'<br><b>Sample Input</b><br>');
    fwrite($fp,$samp);
    fclose($fp);
    $file_path='..\problems\prob'.$id.'input.txt';
    $fp=fopen($file_path,'w');
    fwrite($fp,$inp);
    fclose($fp);
    $file_path='..\problems\prob'.$id.'output.txt';
    $fp=fopen($file_path,'w');
    fwrite($fp,$out);
    fclose($fp);
  }
 ?>
