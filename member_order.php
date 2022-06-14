<?php
session_start();
if (!isset($_SESSION['account'])) {
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
    <title>訂單查詢</title>
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
             
                $id = $_SESSION['account'];
                $i = 1;
                if ($result = mysqli_query($link, "SELECT * FROM user_order where account='$id' ORDER BY time DESC")){
                    if (mysqli_num_rows($result) == 0) {
                        echo '<div style="margin-left: 4%; margin-top: 4%;" class="control-label">你還沒買過東西喔，快來逛逛吧!</div>';
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="row list" style="margin-top: 2%; max-height: 40%;">
                            <div class="col-2">
                                <h4>序號:&nbsp;'.$i.'</h4>
                                <h4>'.$row['time'].'</h4>
                            </div>
                            <div class="col-8">
                                <h6>'.nl2br($row['list']).'</h6>
                            </div>
                            <div class="col-2">
                                <span >總價:&nbsp;&nbsp;<span style="color: brown; font-weight: bold; font-size:20px;">'.$row["cost"].'</span></span>
                                <a style="width:80%; display: block; margin-left: 10%; margin-top:20%;" href="member_order_cancel.php?account='.$row['account'].'&time='.$row['time'].'&from=1"><p><button class="boxbutton">取消訂單</button></p></a>
                            </div>
                        </div>';
                        $i++;
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
