<?php
session_start();

if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];
$op = $_GET['op'];

if ($op == 1) {
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
else if ($op == 2) {
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
else if ($op == 3) {
    if ($_COOKIE[$id.'ISBN'] >= 1) {
        setcookie($id.'ISBN', '', 1);
        $_SESSION['cnt'] -= 1;
    }
}

$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
?>
