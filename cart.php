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
    <title>購物車</title>
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
                else if ($result = mysqli_query($link, 'SELECT * FROM book where isbn IN '.$in)) {
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

                echo '
                <br>
                <form action="order.php" method="POST">
                    <table style="width:100%;">
                        <tr><td><br></td></tr>
                        <tr>
                            <td width="50%"><h4 style="text-align:right;">總金額: <span style="color:red;">'.$_SESSION['cost'].'</span></h4></td>
                            <td width="50%" align="center"><button type="submit" class="btn btn-primary">結 帳</button></td>
                        </tr>
                        <tr><td><br></td></tr>
                    </table>
                </form>
                ';
                ?>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
