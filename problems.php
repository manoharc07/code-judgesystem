<?php
session_start();
if(!isset($_SESSION['UID'])){
  session_destroy();
  header("Location:http://localhost/judgesystem/index.html");
}
include_once "includes\dbConnector.php";
?>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <p>Problems:</p><br>
  <table>
    <tr>
      <th>Problem Name</th>
      <th>Points</th>
    </tr>
  <?php
  $sql="SELECT prob_id,prob_name,score FROM problems";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>".$row['prob_name']."</td><td>".$row['score']."</td><td><a href='editor.html?probid=prob".$row['prob_id']."'>Click</a></td></tr>";
  }
  ?>
</body>
</html>
