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

  exec('C:\Users\manoh\AppData\Local\Programs\Python\Python37\python ../judge/judger.py '.$codefile.' '.$prob_id.'> temp/output.txt');

?>
