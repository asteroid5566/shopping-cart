<?php
session_start();
if (isset($_SESSION['account']) || !isset($_POST['account'])) {
    header("Location:index.php");
    exit();
}

$user = $_POST['account'];
$pw = $_POST['pwd'];
$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT `account`, `pw`, `level` FROM user where account='$user' ";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result)) {
        if ($pw == $row['pw']) {
            $_SESSION['account'] = $user;
            $_SESSION['level'] = $row['level'];
            $_SESSION['cost'] = 0;
            header("Location:index.php");
            exit();
        } else {
            echo "<script type='text/javascript'>alert('帳號或密碼錯誤!');
            window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('無此帳號!');
       window.location.href='login.php';
       </script>";
    }
    mysqli_free_result($result);
}
mysqli_close($link);
?>
