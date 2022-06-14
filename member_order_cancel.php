<?php
session_start();
if (!isset($_SESSION['account']) || !isset($_GET['account']) || !isset($_GET['time']) || $_GET['from'] == 1 && $_SESSION['account'] != $_GET['account'] || $_GET['from'] == 2 && $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$id = $_GET['account'];
$time = $_GET['time'];
$sql = "DELETE FROM `user_order` WHERE account='$id' AND time='$time'";

mysqli_query($link, $sql);
mysqli_close($link);

echo "<script type='text/javascript'>alert('取消成功!');
window.location.href='index.php';
</script>";
?>
