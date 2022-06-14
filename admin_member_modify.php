<?php
session_start();
if (!isset($_SESSION['account']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

$id = $_GET['id'];
$time = $_GET['time'];
$op = $_GET['op'];

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM `user` WHERE account='$id'";
if ($result = mysqli_query($link, $sql)) {
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無此會員!');
        window.location.href='member.php';
        </script>";
        exit();
    }
    else {
        $row = mysqli_fetch_assoc($result);
    }
}

if ($op == 1) {             //modify
    header("Location:member_data.php?id=".$id."");
    exit();
}
else if ($op == 2) {        //delete
    if ($row['level'] >= 9) {
        echo "<script type='text/javascript'>alert('請從後台刪除管理員資料!');
        window.location.href='admin_member.php';
        </script>";
        exit();
    }

    $sql = "DELETE FROM `user` WHERE account='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    echo "<script type='text/javascript'>alert('刪除成功!');
    window.location.href='admin_member.php';</script>";
    exit();
}

$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
?>
