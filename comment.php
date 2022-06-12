<?php
session_start();
if (!isset($_POST['account'])) {
    header("Location:login.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "INSERT into comment (account, rate, time, content, isbn) values ('".$_POST['account']."', '".$_POST['rate']."', NOW(), '".$_POST['content']."','".$_POST['isbn']."')";

if ($result = mysqli_query($link, $sql)) {
    echo "<script type='text/javascript'>alert('發送成功!');
    window.location.href='products.php?id=".$_POST['isbn']."';
    </script>";
}
else {
    echo "<script type='text/javascript'>alert('傳送錯誤!');
    window.location.href='login.php';
    </script>";
}
mysqli_close($link);
?>
