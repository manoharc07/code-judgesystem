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
  exec('..\judger\env\Scripts\python.exe ../judger/judge.py ../temp/'.$codefile.' '.$prob_id.' '.$lang.' '.$user.' >> ../temp/submissionlog.txt');
  ?>
