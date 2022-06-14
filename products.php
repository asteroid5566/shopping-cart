
<?php
session_start();
if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit();
}
$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($result = mysqli_query($link, 'SELECT * FROM book where isbn = ' . $_GET["id"])) {
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無此商品!');
        window.location.href='index.php';
        </script>";
        exit();
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
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
                <div class="row" style="margin-top: 2%;">
                    <div class="col-5">
                        <div class="box">
                            <img class="boximg" src="images/<?php echo $row["isbn"] ?>.jpg">
                        </div>
                    </div>
                    <div class="col-7">
                        <h4 class="cardlink"><?php echo $row["full_name"] ?></h4>
                        <h6><?php echo $row["eng_name"] ?></h6>
                        <hr>
                        <h6>作者:&nbsp;&nbsp;<?php echo $row["author"] ?></h6>
                        <h6>譯者:&nbsp;&nbsp;
                            <?php 
                                if ($row["translator"] == "")
                                    echo '無';
                                else
                                    echo $row["translator"]; 
                            ?>
                        </h6>
                        <h6>出版社:&nbsp;&nbsp;<?php echo $row["press"] ?></h6>
                        <h6>出版日期:&nbsp;&nbsp;<?php echo $row["publish_date"] ?></h6>
                        <h6>語言:&nbsp;&nbsp;<?php echo $row["lang"] ?></h6>
                        <h6>ISBN:&nbsp;&nbsp;<?php echo $row["isbn"] ?></h6>
                        <h6>規格:&nbsp;&nbsp;<?php echo $row["spec"] ?></h6>
                        <hr>
                        <h6>定價:&nbsp;&nbsp;<?php echo '<span style="color: brown; font-weight: bold;">'.$row["price"].'</span>'; ?></h6>
                        <br>
                        <a style="width:30%; display:block;" href="addcart.php?id=<?php echo $row['isbn']; ?>&op=1"><p><button class="boxbutton">放入購物車</button></p></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 content">
                        <hr>
                        <pre>
                            <?php echo $row["content_intro"] ?>
                        </pre>
                    </div>
                </div>
                <?php                
                    if (isset($_SESSION['account'])) {
                        echo '
                        <div class="row">
                            <div class="col-12 content" id="comment">
                                <hr>
                                <form id="form1" action="comment.php" method="POST">
                                    <table>
                                        <tr>
                                            <td colspan="2" style="text-align: center;  text-decoration:underline; text-underline-position: under;">留下您對此書的評價</td>
                                        </tr>
                                        <tr><td colspan="2"><br></td></tr>
                                        <tr><td colspan="2"><br></td></tr>
                                        <tr>
                                            <td width="50%">評鑑分數:</td>
                                            <td align="center">
                                                <select name="rate">
                                                    <option value="5">5</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align:left;">留言:</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="text" id="content" name="content" size="30" maxlength="30" placeholder="若未填則只顯示評分">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><button type="submit" class="btn btn-primary">送 出</button>&nbsp;&nbsp;</td>
                                            <td><button type="reset" class="btn btn-danger">清 除</button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="account" value="'.$_SESSION['account'].'">
                                                <input type="hidden" name="isbn" value="'.$_GET['id'].'">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>';
                    }

                    $id = $_GET["id"];
                    $result = mysqli_query($link, "SELECT * FROM comment where isbn = '$id' ORDER BY time DESC");

                    while ($row2 = mysqli_fetch_assoc($result)) {
                        echo '
                        <hr>
                        <div class="col-12">
                            <h4>'.$row2['account'].'&nbsp;(評鑑分數:&nbsp;<span style="color:red;">'.$row2['rate'].'</span>)</h4>
                            <br>';
                        if ($row2['content'] != "") {
                            echo '
                            <h5 style="font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['content'].'</h5>
                            <br>';
                        }
                            echo '
                            <h6>於&nbsp;'.$row2['time'].'</h6>
                        </div>';
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
