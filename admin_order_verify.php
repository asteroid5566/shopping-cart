<?php
session_start();
if (!isset($_SESSION['account']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if (isset($_GET['op']) && $_GET['op'] == 3) {   //add
    $account = $_POST['account'];
    $cost = $_POST['cost'];
    $list = $_POST['list'];

    $sql = "SELECT * FROM `user` WHERE account='$account'";
    $result = mysqli_query($link, $sql);
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_order.php';
        </script>";
        exit();
    }

    $sql = "INSERT INTO `user_order`(`account`, `time`, `cost`, `list`) VALUES ('$account',NOW(),'$cost','$list')";
    mysqli_query($link, $sql);
    mysqli_close($link);
    echo "<script type='text/javascript'>alert('新增成功!');
    window.location.href='admin_order.php';</script>";
    exit();
}

$id = $_POST['id'];
$time = $_POST['time'];
$cost = $_POST['cost'];
$list = $_POST['list'];

$sql = "SELECT * FROM `user_order` WHERE account='$id' AND time='$time'";
if ($result = mysqli_query($link, $sql)) {
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_order.php';
        </script>";
        exit();
    }
    else {
        $row = mysqli_fetch_assoc($result);
    }
}

$sql = "UPDATE user_order SET cost='$cost', list='$list' WHERE account = '$id' AND time='$time'";
mysqli_query($link, $sql);
echo "<script type='text/javascript'>alert('修改成功!');
window.location.href='admin_order.php';
</script>";
exit();
?>
