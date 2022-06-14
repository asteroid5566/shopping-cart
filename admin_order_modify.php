<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

$id = $_GET['id'];
$time = $_GET['time'];

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM `user_order` where account='$id' AND time='$time'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result))
        mysqli_free_result($result);
    else {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_order.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改訂單</title>
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
                        <form class="form-horizontal" id="form1" name="form1" action="admin_order_verify.php" method="POST">
                            <div class="form-group logbox">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="hidden" name="time" value="<?php echo $time;?>">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">修改訂單</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td class="control-label" colspan="2">帳號:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="" id="" size="30" maxlength="30" value="<?php echo $id;?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">時間:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="" id="" size="30" maxlength="30" value="<?php echo $time;?>" disabled>
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td class="control-label" width='50'>總價:</td>
                                    </tr>
                                    <tr>
                                        <td width='400'>
                                            <input type="text" id="cost" name="cost" size="30" maxlength="30" value="<?php echo $row['cost'];?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>訂單內容:</td>
                                    </tr>
                                    <tr>
                                        <td width='400'>
                                            <textarea name="list" cols="50" rows="10"><?php echo $row['list'];?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" class="btn btn-primary">送 出</button>&nbsp;&nbsp;
                                <button type="reset" class="btn btn-danger">清 除</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
