<?php
session_start();
if (!isset($_GET['keyword']) || $_GET['keyword'] == "") {
    header("Location:index.php");
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
    <?php include("import.php");?>
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
                    <?php include("searchbar.php"); ?>
                </div>
                <?php
                $link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
                mysqli_query($link, 'SET CHARACTER SET utf8');
                mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
             
                if ($result = mysqli_query($link, 'SELECT isbn, book_name, full_name, eng_name, author, category, spec, content_intro, author_intro, index_intro, preface_intro, price, sales FROM book where book_name like "%'.$_GET['keyword'].'%"')) {
                    if (mysqli_num_rows($result) == 0) {
                        echo '<div style="margin-left: 4%; margin-top: 4%;" class="control-label">找不到相關資料，換個關鍵字吧&nbsp;!</div>';
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="row list" style="margin-top: 2%; max-height: 40%;">
                            <div class="col-3">
                                <a style="display:block;" href="products.php?id='.$row["isbn"].'">
                                    <img style="max-height: 140px; width:auto;" src="images/'.$row["isbn"].'.jpg">
                                </a>
                            </div>
                            <div class="col-4">
                                <a class="listlink" href="products.php?id='.$row["isbn"].'">
                                    <p class="listlink">'.$row["full_name"].'</p>
                                </a>
                            </div>
                            <div class="col-4">
                                <span >定價:&nbsp;&nbsp;<span style="color: brown; font-weight: bold; font-size:20px;">'.$row["price"].'</span></span>
                                <a style="width:50%; display: block; margin-left: 36%; margin-top:20%;" href="addcart.php?id='.$row['isbn'].'&op=1"><p><button class="boxbutton">放入購物車</button></p></a>
                            </div>
                        </div>';
                    }
                }
                mysqli_free_result($result);
                mysqli_close($link);
                ?>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
