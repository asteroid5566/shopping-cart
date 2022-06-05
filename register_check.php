<?php
session_start();
if (isset($_SESSION['account']) || !isset($_GET["p_usr"])) {
   header("Location:index.php");
   exit();
}

$user = trim($_GET["p_usr"]);
$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM user where account='$user' ";

if ($result = mysqli_query($link, $sql)) {
   if ($row = mysqli_fetch_assoc($result)) {
      $_SESSION['checkaccount'] = 1;
      echo "1";
   }
   else {
      $_SESSION['checkaccount'] = 0;
      echo "0";
   }
   mysqli_free_result($result);
}
mysqli_close($link);
?>
