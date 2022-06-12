<?php
session_start();
if (!isset($_GET['keyword']) && !isset($_GET['category'])) {
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
            <?php include("sidebar.php"); ?>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <?php include("searchbar.php"); ?>
                </div>
                <?php
                $link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
                mysqli_query($link, 'SET CHARACTER SET utf8');
                mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
             
                if (isset($_GET['keyword'])) {
                    $kw = $_GET['keyword'];
                    if ($result = mysqli_query($link, "SELECT * FROM book where book_name like '%$kw%' OR category like '%$kw%'")){
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
                        mysqli_free_result($result);
                    }
                }
                else if (isset($_GET['category'])) {
                    $cat1 = $_GET['category'][0];
                    $cat2 = $_GET['category'][1];
                    if ($result = mysqli_query($link, "SELECT * FROM book where category like '%$cat1%' OR category like '%$cat2%'")) {
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
                        mysqli_free_result($result);
                    }
                }
                mysqli_close($link);
                ?>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
