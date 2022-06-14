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
    <title>會員中心</title>
    <link rel="shortcut icon" type="image/png" href="images/icon.png?">
    <?php include("import.php"); ?>
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
                <div class="row">
                    <div class="col-12" style="padding-left: 10px; padding-right:2px;">
                        <div style="margin-top: 10%; margin-left:10%;">
                            <a href="member_data.php"><button type="button" class="btn btn-primary">會員資料更改</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="member_order.php"><button type="button" class="btn btn-primary">訂單查詢、取消</button></a>
                <?php
                    if ($_SESSION['level'] >= 9) {
                        echo '
                            <br><br><br><br>
                            <a href="admin_member.php"><button type="button" class="btn btn-warning">會員管理</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="admin_product.php"><button type="button" class="btn btn-warning">商品管理</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="admin_comment.php"><button type="button" class="btn btn-warning">留言管理</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="admin_order.php"><button type="button" class="btn btn-warning">訂單管理</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="admin_file_add.php"><button type="button" class="btn btn-warning">圖片上傳</button></a>
                        ';
                    }
                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
