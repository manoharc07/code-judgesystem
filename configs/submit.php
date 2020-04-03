<?php
  $code=$_POST['code'];
  $prob_id=$_POST['prob_id'];
  $lang=$_POST['language'];
  if($lang=='c'){
    $extension=".c";
  }
  else if($lang=='c++'){
    $extension=".cpp";
  }
  else{
    $extension=".java";
  }

  $codefile="temp".$extension;
  $fp=fopen('../configs/'.$codefile,'w');
  fwrite($fp,$code);
  fclose($fp);

  exec('C:\Users\manoh\AppData\Local\Programs\Python\Python37\python ../configs/grader.py '.$codefile.' '.$prob_id.'> result.txt');

?>
