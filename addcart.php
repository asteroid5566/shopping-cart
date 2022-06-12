<?php
session_start();

if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];
$op = $_GET['op'];

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$sql = "SELECT * FROM book where isbn='$id'";
if ($result = mysqli_query($link, $sql)) {
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無此商品!');
        window.location.href='index.php';
        </script>";
        exit();
    }
    else {
        $row = mysqli_fetch_assoc($result);
        $price = $row['price'];
    }
}

if ($op == 1) {             //+1
    $_SESSION['cost'] += $price; 
    if (!isset($_COOKIE[$id.'ISBN'])) {
        setcookie($id.'ISBN', 1, time() + 36000);
        if (!isset($_SESSION['cnt']))
            $_SESSION['cnt'] = 1;
        else
            $_SESSION['cnt'] += 1;
    }
    else {
        setcookie($id.'ISBN', $_COOKIE[$id.'ISBN'] + 1, time() + 36000);
    }
}
else if ($op == 2) {        //-1
    $_SESSION['cost'] -= $price;
    if ($_COOKIE[$id.'ISBN'] == 1) {
        setcookie($id.'ISBN', '', 1);
        if (!isset($_SESSION['cnt']))
            $_SESSION['cnt'] = 0;
        else
            $_SESSION['cnt'] -= 1;
    }
    else
        setcookie($id.'ISBN', $_COOKIE[$id.'ISBN'] - 1, time() + 36000);
}
else if ($op == 3) {        //del
    $_SESSION['cost'] -= $price * $_COOKIE[$id.'ISBN'];
    if ($_COOKIE[$id.'ISBN'] >= 1) {
        setcookie($id.'ISBN', '', 1);
        $_SESSION['cnt'] -= 1;
    }
}

$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
?>
