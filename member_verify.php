<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$account = $_POST['account'];
$pw = $_POST['pwd'];
$name = $_POST["name"];
$email = $_POST['email'];
$phone = $_POST['phone'];
$question = $_POST['question'];
$answer = $_POST['answer'];

$sql = "UPDATE user SET pw='$pw', user_name='$name', email='$email', phone='$phone', question='$question', answer='$answer' WHERE account = '$account'";

mysqli_query($link, $sql)or die(mysqli_error($link));
mysqli_close($link);

echo "<script type='text/javascript'>alert('會員資料修改成功!');
window.location.href='index.php';
</script>";
?>
