<?php
session_start();

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = Array();
}

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     if (!in_array($id,$_SESSION['cart'])){
//         $_SESSION['cart'][]=$id;
//     }
//     $url = $_SERVER['HTTP_REFERER'];
//     header("Location:$url");
// }
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
    <script src="js/script.js"></script>
    <style>

    </style>
</head>

<body>
    <button id="topbtn" onclick="topFunction()">^</button>

    <div class="container-fulid">
        <?php include("topnav.php"); ?>
        <div class="row">
            <div class="col-12" style="padding: 0px;">
                <img src="images/banner.png" width=100%>
            </div>
        </div>
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
                    <?php
                    if ($result = mysqli_query($link, 'SELECT isbn, book_name,full_name, eng_name, author, translator, press, publish_date, lang, category, spec, content_intro, author_intro, index_intro, preface_intro, price, sales FROM book ORDER BY rand()')) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <a href="products.php?id=' . $row["isbn"] . '" class="cardlink">
                                        <img class="cardimg" src="images/' . $row["isbn"] . '.jpg">
                                        <h5>' . $row['book_name'] . '</h5>
                                    </a>
                                    <p class="price">$' . $row['price'] . '</p>';
                                    //<a href="index.php?id=' . $row["isbn"] . '"><p><button>放入購物車</button></p></a>
                                echo '</div>
                            </div>';
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
