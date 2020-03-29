<? php
session_start();
if(!isset($_SESSION['UID'])){
  session_destroy();
  header("Location:http://localhost/judgesystem/index.html");
}
?>
<html>
<head><title>Leaderboard</title></head>
<body>
  <h1><center>Leaderboard</center></p>
  <ol>
  <?php
    include_once "includes\dbConnector.php";
    $sql="SELECT Username,score from profile order by score DESC;";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
      echo "<li>".$row['Username']."\t".$row['score'];
    }
    ?>
  </ol>
</body>
</html>
