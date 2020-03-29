<?php
  if(isset($_POST['code'])){
    $data=$_POST['code'];
    $prob_id="prob13";
    $fp=fopen('../configs/add.c','w');
    fwrite($fp,$data);
    fclose($fp);
}
header("Location:http://localhost/judgesystem/configs/pythonrunner.php")

?>
