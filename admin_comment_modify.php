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

$sql = "SELECT * FROM comment where account='$id' AND time='$time'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result))
        mysqli_free_result($result);
    else {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無此留言!');
        window.location.href='admin_comment.php';
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
    <title>修改留言</title>
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
                        <form class="form-horizontal" id="form1" name="form1" action="admin_comment_verify.php?op=1" method="POST">
                            <div class="form-group logbox">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="hidden" name="time" value="<?php echo $time;?>">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">修改留言</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td class="control-label" colspan="2">帳號:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="question" id="question" size="30" maxlength="30" value="<?php echo $id;?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">評鑑分數:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <select name="rate">
                                                <option value="5" <?php if($row['rate']==5)echo "selected";?>>5</option>
                                                <option value="4" <?php if($row['rate']==4)echo "selected";?>>4</option>
                                                <option value="3" <?php if($row['rate']==3)echo "selected";?>>3</option>
                                                <option value="2" <?php if($row['rate']==2)echo "selected";?>>2</option>
                                                <option value="1" <?php if($row['rate']==1)echo "selected";?>>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td class="control-label" width='50'>留言:</td>
                                    </tr>
                                    <tr>
                                        <td width='400'>
                                            <input type="text" id="content" name="content" size="30" maxlength="30" placeholder="若未填則只顯示評分" value="<?php echo $row['content'];?>">
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
