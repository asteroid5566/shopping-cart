<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

$id = $_GET['id'];

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM book where isbn='$id'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result))
        mysqli_free_result($result);
    else {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_product.php';
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
    <title>修改商品</title>
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
                        <form class="form-horizontal" id="form1" name="form1" action="admin_product_verify.php" method="POST">
                            <div class="form-group logbox">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">修改商品</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr><td class="control-label" colspan="2">ISBN:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" value="<?php echo $id;?>" disabled></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">價格:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="price" value="<?php echo $row['price'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="book_name" value="<?php echo $row['book_name'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">完整書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="full_name" value="<?php echo $row['full_name'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">原文書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="eng_name" value="<?php echo $row['eng_name'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">作者:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="author" value="<?php echo $row['author'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">譯者:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="translator" value="<?php echo $row['translator'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">出版社:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="press" value="<?php echo $row['press'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">出版日期:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="publish_date" value="<?php echo $row['publish_date'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">語言:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="lang" value="<?php echo $row['lang'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">分類:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="category" value="<?php echo $row['category'];?>"></td>
                                    </tr>
                                    <tr><td class="control-label" width='50'>內容簡介:</td></tr>
                                    <tr>
                                        <td width='400'><textarea name="content_intro" cols="50" rows="10"><?php echo $row['content_intro'];?></textarea></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">規格:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="spec" value="<?php echo $row['spec'];?>"></td>
                                    </tr>
                                    <tr><td colspan="2">&nbsp;</td></tr>
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
