<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書城</title>
    <link rel="shortcut icon" type="image/png" href="images/icon.png?">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">
    <script src="js/script.js"></script>
    <style>

    </style>
</head>

<body>
    <button id="topbtn" onclick="topFunction()">^</button>

    <div class="container-fulid">
        <?php include("topnav.php"); ?>
        <div class="row" style="margin-top: 1%;">
            <div class="col-2 d-none d-lg-block" style="padding: 0px; border: 5px lightgray solid; border-top: 6px #04AA60 solid;">
                <div class="categorybox">
                    <p class="category" style="margin-top: 4%; margin-right: 10%; text-align: center; color: brown; padding-bottom: 0px;">
                        全站分類</p>
                </div>
                <a href="" class="category">商業/財經</a>
                <a href="" class="category">醫療/健康</a>
                <a href="" class="category">文學/哲學</a>
                <a href="" class="category">科學/科技</a>
                <a href="" class="category">語言/學習</a>
                <a href="" class="category">旅遊/生活</a>
                <a href="" class="category">社會/人文</a>
                <a href="" class="category">電腦/資訊</a>
                <a href="" class="category">漫畫/輕小說</a>
            </div>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <div class="col-12" style="background-color:#EEEEEE; height: 48px; padding-left: 2%; margin-bottom: 1%;">
                        <input type="text" class="form" style="margin-top: 10px; border: 2px #04AA60 solid;">
                        <button class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px; background-color:#04AA60">搜尋</button>
                        <span style="margin-left: 8px;">
                            <span style="margin-right: 6px;">熱門關鍵字:</span>
                            <a href="" style="margin-right: 4px;">輕小說</a>
                            <a href="" style="margin-right: 4px;">PHP</a>
                            <a href="" style="margin-right: 4px;">多益</a>
                            <a href="" style="margin-right: 4px;">計算機組織</a>
                        </span>
                    </div>
                </div>
                <?php
                $link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
                mysqli_query($link, 'SET CHARACTER SET utf8');
                mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
             
                $arr = Array();
                $flag = false;
                foreach ($_COOKIE as $key=>$val) {
                    if (substr($key, -4) == "ISBN") {
                        $flag = true;
                        $arr[] = substr($key, 0, -4);
                    }
                }
                $in = '(' . implode(',', $arr) .')';
                if (!$flag) {
                    echo "<script type='text/javascript'>alert('購物車內還沒有東西喔!');
                    window.location.href='index.php';
                    </script>";
                }
                else if ($result = mysqli_query($link, 'SELECT isbn, book_name, full_name, eng_name, author, category, spec, content_intro, author_intro, index_intro, preface_intro, price, sales FROM book where isbn IN '.$in)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="row list" style="margin-top: 2%; max-height: 50%;">
                            <div class="col-3">
                                <a href="products.php?id='.$row["isbn"].'">
                                    <img class="listimg" src="images/'.$row["isbn"].'.jpg">
                                </a>
                            </div>
                            <div class="col-4">
                                <a class="listlink" href="products.php?id='.$row["isbn"].'">
                                    <p class="listlink">'.$row["full_name"].'</p>
                                </a>
                                <div>
                                    <span>定價:&nbsp;&nbsp;<span style="color: brown; font-weight: bold;">'.$row["price"].'</span></span>
                                </div>
                                <br>
                            </div>
                            <div class="col-5" style="padding-top:14%;">
                                <a class="cardlink" href="addcart.php?id='.$row['isbn'].'&op=2">
                                    <button class="addbt">-</button>
                                </a>
                                <span class="price">&nbsp;&nbsp;&nbsp;'.$_COOKIE[$row["isbn"]."ISBN"].'&nbsp;&nbsp;&nbsp;</span>
                                <a class="cardlink" href="addcart.php?id='.$row['isbn'].'&op=1">
                                    <button class="addbt">+</button>
                                </a>
                                <a href="addcart.php?id='.$row['isbn'].'&op=3">
                                    <button class="btn-danger btn-lg rmbt" style="margin-left: 20px;">刪除</button>
                                </a>
                            </div>
                        </div>';
                    }
                    mysqli_free_result($result);
                }
                mysqli_close($link);
                ?>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
