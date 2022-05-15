<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = Array();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!in_array($id,$_SESSION['cart'])){
    $_SESSION['cart'][]=$id;
    }
    $url = $_SERVER['HTTP_REFERER'];
    header("Location:$url");
}
?>
