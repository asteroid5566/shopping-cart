<?php
session_start();
if (isset($_SESSION['account']) || !isset($_POST['pwd']) || !isset($_POST['account'])) {
    header("Location:index.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM user where account='".$_POST['account']."'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['answer'] == $_POST['answer']) {
            $sql = "UPDATE user SET pw='".$_POST['pwd']."' WHERE account = '".$_POST['account']."'";
            mysqli_query($link, $sql)or die(mysqli_error($link));
            mysqli_free_result($result);
            mysqli_close($link);
            echo "<script type='text/javascript'>alert('密碼修改成功!');
            window.location.href='index.php';
            </script>";
        }
        else {
            mysqli_free_result($result);
            mysqli_close($link);
            echo "<script type='text/javascript'>alert('回答錯誤!".$row['answer']."');
            window.location.href='reset.php';
            </script>";
        }
    }
}
else {
    echo "<script type='text/javascript'>alert('error!');
    window.location.href='index.php';
    </script>";
}
?>
