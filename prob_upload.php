<?php
  session_start();
  if(!isset($_SESSION['UID']) || $_SESSION['User_type']=="norm"){
    die("Not authorized to view content.");
  }
?>
<html>
<head><title>
  Upload</title>
</head>
<body><center>
<p>Enter the details below </p>
<form action="includes\uploader.php" method="post">
  Problem Name<input type="text" required="required" name="prob_name" /><br>
  Score<input type="number" min="10" max="100" required="required" name="score"/><br>
  Statement<textarea required="required" name="Statement"></textarea><br>
  Constraints<textarea  required="required" name="const"></textarea><br>
  Sample case<textarea  required="required" name="sample"></textarea><br>
  Input case<textarea  required="required" name="input"></textarea><br>
  output case <textarea  required="required" name="output"></textarea><br>
  <input type="submit" value="Submit"/>
</form>
</center>
</body>
</html>
