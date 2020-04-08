<?php
  session_start();
  $code=$_POST['code'];
  $prob_id=$_POST['prob_id'];
  $lang=$_POST['language'];
  $user=$_SESSION['UID'];
  if($lang=='C'){
    $extension=".c";
  }
  else if($lang=='C++'){
    $extension=".cpp";
  }
  else if($lang=="Java"){
    $extension=".java";
  }
  else{
    $extension=".py";
  }

  $codefile="temp".$extension;
  $fp=fopen('../temp/'.$codefile,'w');
  fwrite($fp,$code);
  fclose($fp);
  exec('C:\Users\manoh\AppData\Local\Programs\Python\Python37\python ../judger/judge.py ../temp/'.$codefile.' '.$prob_id.' '.$lang.' '.$user.' >> ../temp/submissionlog.txt');
  ?>
