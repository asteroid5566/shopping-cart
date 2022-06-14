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
                                <td colspan="3" style="border:none;"><a href="register.php"><button class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px;">新增帳號</button></a></td>
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
                        $result = mysqli_query($link, "SELECT * FROM user WHERE user_name like '%$s%' OR account like '%$s%' OR email like '%$s%' OR phone like '%$s%' OR level like '%$s%' ORDER BY level DESC");
                        echo '
                                    <tr>
                                        <td style="width:15%;">帳號</td>
                                        <td style="width:15%;">姓名</td>
                                        <td style="width:15%;">email</td>
                                        <td style="width:15%;">電話</td>
                                        <td style="width:15%;">等級</td>
                                        <td style="width:20%;">操作</td>
                                    </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <tr>
                                        <td>'.$row['account'].'</td>
                                        <td>'.$row['user_name'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['phone'].'</td>
                                        <td>'.$row['level'].'</td>
                                        <td>
                                            <a href="admin_member_modify.php?id='.$row['account'].'&op=1"><button type="button" class="btn btn-warning">修改</button></a>
                                            <a href="admin_member_modify.php?id='.$row['account'].'&op=2"><button type="button" class="btn btn-danger">刪除</button></a>
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
                        $result = mysqli_query($link, "SELECT * FROM user ORDER BY level DESC");
                        echo '
                                    <tr>
                                        <td style="width:15%;">帳號</td>
                                        <td style="width:15%;">姓名</td>
                                        <td style="width:15%;">email</td>
                                        <td style="width:15%;">電話</td>
                                        <td style="width:15%;">等級</td>
                                        <td style="width:20%;">操作</td>
                                    </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <tr>
                                        <td>'.$row['account'].'</td>
                                        <td>'.$row['user_name'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['phone'].'</td>
                                        <td>'.$row['level'].'</td>
                                        <td>
                                            <a href="admin_member_modify.php?id='.$row['account'].'&op=1"><button type="button" class="btn btn-warning">修改</button></a>
                                            <a href="admin_member_modify.php?id='.$row['account'].'&op=2"><button type="button" class="btn btn-danger">刪除</button></a>
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
