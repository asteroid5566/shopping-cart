<?php
session_start();
if (isset($_SESSION['account'])) {
    header("Location:index.php");
    exit();
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM user where account='".$_POST['account']."'";

if ($result = mysqli_query($link, $sql)) {
    if ($row = mysqli_fetch_assoc($result))
        mysqli_free_result($result);
    else {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('查無此帳號!');
        window.location.href='reset.php';
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
    <title>會員註冊</title>
    <link rel="shortcut icon" type="image/png" href="images/icon.png?">
    <?php include("import.php"); ?>
    <script>
        $(document).ready(function($) {
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form1").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    question: {
                        required: true
                    },
                    answer: {
                        required: true
                    },
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 12,
                    },
                },
                messages: {
                    question: {
                        required: "不得為空",
                    },
                    answer: {
                        required: "不得為空",
                    },
                    pwd: {
                        required: "不得為空",
                        minlength: "6至12個字元",
                        maxlength: "6至12個字元",
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
            <div class="col-2 d-none d-lg-block" style="padding: 0px; border: 5px lightgray solid; border-top: 6px #04AA60 solid;">
                <div class="categorybox">
                    <p class="category" style="margin-top: 4%; margin-right: 10%; text-align: center; color: brown; padding-bottom: 0px;">
                        全站分類</p>
                </div>
                <a href="" class="category">商業/財經</a>
                <a href="" class="category">醫療/健康</a>
                <a href="" class="category">文學/哲學</a>
                <a href="" class="category">科學/科技</a>
                <a href="" class="category">語言/學習</a>
                <a href="" class="category">旅遊/生活</a>
                <a href="" class="category">社會/人文</a>
                <a href="" class="category">電腦/資訊</a>
                <a href="" class="category">漫畫/輕小說</a>
            </div>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <?php include("searchbar.php"); ?>
                </div>
                <div class="row">
                    <div class="col-12" style="padding-left: 10px; padding-right:2px;">
                        <form class="form-horizontal" id="form1" name="form1" action="reset_verify.php" method="POST">
                            <div class="form-group logbox">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">請回答安全問題</h2>
                                <br><br>
                                <input type="hidden" name="account" value="<?php echo $row['account'];?>" />
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td class="control-label" colspan="2">安全問題:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="question" id="question" size="30" maxlength="30" value="<?php echo $row['question'];?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">請輸入您的回答:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="answer" id="answer" size="30" maxlength="30">
                                            <label for="answer" class="error"></label>
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td class="control-label" width='50'>設定新密碼:</td>
                                    </tr>
                                    <tr>
                                        <td width='400'>
                                            <input type="password" name="pwd" id="pwd" maxLength="12" placeholder="6至12個字元">
                                            <label for="pwd" class="error"></label>
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
