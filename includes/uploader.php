<?php
  $name=$_POST['prob_name'];
  $score=$_POST['Score'];
  $desc=$_POST['Description'];
  $diff=$_POST['Difficulty'];
  $inp=$_POST['Input'];
  $out=$_POST['Output'];
  include_once "..\includes\dbConnector.php";
  $sql="INSERT INTO problems(prob_id,prob_name,score,difficulty)values(NULL,'$name','$score','$diff')";
  $result=mysqli_query($conn,$sql);
  if($result!=false){
    $id=mysqli_insert_id($conn);
    $file_path='..\problems\prob'.$id.'.html' ;
    $fp=fopen($file_path,'w');
    fwrite($fp,'<span style="font-family: &quot;andale mono&quot;, monospace;" data-mce-style="font-family: \'andale mono\', monospace;"><h2><strong>'.$name.'</strong></h2></span>');
    fwrite($fp,$desc);
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
