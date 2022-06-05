<?php
session_start();
if (!isset($_SESSION['checkaccount']) || !isset($_POST['p_usr']) || isset($_SESSION['account'])) {
    header("Location:index.php");
    exit();
}

if ($_SESSION['checkaccount'] == 1) {
    echo "<script type='text/javascript'>alert('此帳號已存在!');
    window.location.href='register.php';
    </script>";
}
else {
    $link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $sql = "INSERT INTO `user`(`account`, `pw`, `user_name`, `email`, `phone`, `question`, `answer`, `status`, `level`) VALUES ('".$_POST['p_usr']."','".$_POST['pwd']."','".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['question']."','".$_POST['answer']."','1','5')";

    mysqli_query($link, $sql);
    mysqli_close($link);

    echo "<script type='text/javascript'>alert('會員註冊成功!');
    window.location.href='index.php';
    </script>";
}
?>
