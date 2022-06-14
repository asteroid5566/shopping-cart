<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}

if (isset($_GET['id']))
    $user = $_GET['id'];
else
    $user = $_SESSION['account'];

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM user where account='$user'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result))
        mysqli_free_result($result);
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員資料更改</title>
    <link rel="shortcut icon" type="image/png" href="images/icon.png?">
    <?php include("import.php"); ?>
    <script>
        $(document).ready(function($) {
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form1").validate({
                submitHandler: function(form) {
                    //alert("success!");
                    form.submit();
                },
                rules: {
                    p_usr: {
                        required: true,
                    },
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 12,
                    },
                    email: {
                        email: true,
                    },
                    question: {
                        required: true
                    },
                    answer: {
                        required: true
                    },
                },
                messages: {
                    p_usr: {
                        required: "不得為空",
                    },
                    pwd: {
                        required: "不得為空",
                        minlength: "6至12個字元",
                        maxlength: "6至12個字元",
                    },
                    email: {
                        email: "格式錯誤",
                    },
                    question: {
                        required: "不得為空",
                    },
                    answer: {
                        required: "不得為空",
                    },
                }
            });
        });
    </script>
    <style type="text/css">
        .error {
            color: #D82424;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }
    </style>
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
                        <form class="form-horizontal" id="form1" name="form1" action="member_verify.php" method="POST">
                            <div class="form-group logbox">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">會員資料更改</h2>
                                <br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td colspan="2"><span id='show_msg' style="color:red"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50' style="font-size:12pt">帳號:
                                            <input type="hidden" name="account" id="account" value="<?php echo $row['account'];?>">
                                        </td>
                                        <td width='400'>
                                            <input type="text" name="p_usr" id="p_usr" maxLength="12" disabled placeholder="<?php echo $row['account'];?>">
                                            <label for="p_user" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>密碼:</td>
                                        <td width='400'>
                                            <input type="password" name="pwd" id="pwd" maxLength="12" value="<?php echo $row['pw'];?>">
                                            <label for="pwd" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>姓名:</td>
                                        <td width='400'>
                                            <input type="text" name="name" id="name" maxLength="12" placeholder="可免填" value="<?php echo $row['user_name'];?>">
                                            <label for="name" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>email:</td>
                                        <td width='400'>
                                            <input type="text" name="email" id="email" maxLength="30" placeholder="可免填" value="<?php echo $row['email'];?>">
                                            <label for="email" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>電話:</td>
                                        <td width='400'>
                                            <input type="text" name="phone" id="phone" maxLength="12" placeholder="可免填" value="<?php echo $row['phone'];?>">
                                            <label for="phone" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">安全問題&nbsp;(忘記密碼時使用，必填)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="question" id="question" size="30" maxlength="30" placeholder="最多30字(例如: 您就讀哪間高中?)" value="<?php echo $row['question'];?>">
                                            <label for="question" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">回答&nbsp;(請牢記或妥善保存)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="answer" id="answer" size="30" maxlength="30" placeholder="最多30字" value="<?php echo $row['answer'];?>">
                                            <label for="answer" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" class="btn btn-primary">送 出</button>&nbsp;&nbsp;
                                <button type="reset" class="btn btn-danger">復 原</button>
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
