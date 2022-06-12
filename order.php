<?php
session_start();
if (!isset($_SESSION['account']) || $_SESSION['cost'] == 0) {
    header("Location:index.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$li = "";
$arr = Array();
foreach ($_COOKIE as $key=>$val) {
    if (substr($key, -4) == "ISBN")
        $arr[] = substr($key, 0, -4);
}
$in = '(' . implode(',', $arr) .')';
if ($result = mysqli_query($link, 'SELECT * FROM book where isbn IN '.$in)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $li .= $row['full_name']."(".$row['isbn'].")"." * ".$_COOKIE[$row['isbn']."ISBN"]."\n";        
    }
}

$sql = "INSERT INTO `user_order`(`account`, `time`, `cost`, `list`) VALUES ('".$_SESSION['account']."',NOW(),'".$_SESSION['cost']."','$li')";

mysqli_query($link, $sql);
mysqli_close($link);

$_SESSION['cost'] = 0;
$_SESSION['cnt'] = 0;
foreach ($_COOKIE as $key=>$val) {
    if (substr($key, -4) == "ISBN") {
        setcookie($key, '', 1);
    }
}

echo "<script type='text/javascript'>alert('下單成功!');
window.location.href='index.php';
</script>";
?>
