<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] < 9) {
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
                
                <div class="row list" style="margin-top: 2%;">
                    <div class="col-12">
                        <table class="admintb" style="width:100%;">
                            <tr>
                                <td colspan="3" style="border:none;"><a href="admin_comment_add.php"><button class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px;">新增留言</button></a></td>
                                <td colspan="3" style="border:none;">
                                    <form id="ad" name="ad" action="" method="POST">
                                        <input type="text" class="form searchbar" style="margin-top: 10px; border: 2px solid;" name="adsearch">
                                        <button type="submit" class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px;">搜尋</button>
                                    </form>
                                </td>
                            </tr>

                    <?php
                    $link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
                    mysqli_query($link, 'SET CHARACTER SET utf8');
                    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

                    if (isset($_POST['adsearch'])) {
                        $s = $_POST['adsearch'];
                        $result = mysqli_query($link, "SELECT * FROM comment WHERE account like '%$s%' OR time like '%$s%' OR rate like '%$s%' OR content like '%$s%' OR isbn like '%$s%' ORDER BY time DESC");
                        echo '
                                    <tr>
                                        <td style="width:15%;">帳號</td>
                                        <td style="width:15%;">時間</td>
                                        <td style="width:15%;">ISBN</td>
                                        <td style="width:5%;">評級</td>
                                        <td style="width:25%;">留言</td>
                                        <td style="width:20%;">操作</td>
                                    </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <tr>
                                        <td>'.$row['account'].'</td>
                                        <td>'.$row['time'].'</td>
                                        <td>
                                            <a href="products.php?id='.$row['isbn'].'#comment">'.$row['isbn'].'</a>
                                        </td>
                                        <td>'.$row['rate'].'</td>
                                        <td>'.$row['content'].'</td>
                                        <td>
                                            <a href="admin_comment_modify.php?id='.$row['account'].'&time='.$row['time'].'"><button type="button" class="btn btn-warning">修改</button></a>
                                            <a href="admin_comment_verify.php?id='.$row['account'].'&time='.$row['time'].'&op=2"><button type="button" class="btn btn-danger">刪除</button></a>
                                        </td>
                                    </tr>
                                ';
                            }
                        echo '            
                                </table>
                            </div>';
                        mysqli_free_result($result);
                    }
                    else {
                        $result = mysqli_query($link, "SELECT * FROM comment ORDER BY time DESC");
                        echo '
                                    <tr>
                                        <td style="width:15%;">帳號</td>
                                        <td style="width:15%;">時間</td>
                                        <td style="width:15%;">ISBN</td>
                                        <td style="width:5%;">評級</td>
                                        <td style="width:25%;">留言</td>
                                        <td style="width:20%;">操作</td>
                                    </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <tr>
                                        <td>'.$row['account'].'</td>
                                        <td>'.$row['time'].'</td>
                                        <td>
                                            <a href="products.php?id='.$row['isbn'].'#comment">'.$row['isbn'].'</a>
                                        </td>
                                        <td>'.$row['rate'].'</td>
                                        <td>'.$row['content'].'</td>
                                        <td>
                                            <a href="admin_comment_modify.php?id='.$row['account'].'&time='.$row['time'].'"><button type="button" class="btn btn-warning">修改</button></a>
                                            <a href="admin_comment_verify.php?id='.$row['account'].'&time='.$row['time'].'&op=2"><button type="button" class="btn btn-danger">刪除</button></a>
                                        </td>
                                    </tr>
                                ';
                            }
                        echo '            
                                </table>
                            </div>';
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
