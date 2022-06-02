<?php
session_start();

if (!isset($_SESSION['account']) && isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', 1);
        setcookie($name, '', 1, '/');
    }
}

if (isset($_POST['account']) && isset($_POST['pw'])) {
    if ($_POST['account'] == 'member' && $_POST['pw'] == 'member123456') {
        $_SESSION['account'] = $_POST['account'];
        header("Location:index.php");
    }
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">
    <script src="js/script.js"></script>
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
                    account: {
                        required: true,
                    },
                    pwd: {
                        required: true,
                    },
                    agree: {
                        required: true
                    },
                },
                messages: {
                    account: {
                        required: "不得為空",
                    },
                    pwd: {
                        required: "不得為空",
                    },
                    agree: {
                        required: "你是機器人?!",
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
                    <div class="col-12" style="background-color:#EEEEEE; height: 48px; padding-left: 2%; margin-bottom: 1%;">
                        <input type="text" class="form" style="margin-top: 10px; border: 2px #04AA60 solid;">
                        <button class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px; background-color:#04AA60">搜尋</button>
                        <span style="margin-left: 8px;">
                            <span style="margin-right: 6px;">熱門關鍵字:</span>
                            <a href="" style="margin-right: 4px;">輕小說</a>
                            <a href="" style="margin-right: 4px;">PHP</a>
                            <a href="" style="margin-right: 4px;">多益</a>
                            <a href="" style="margin-right: 4px;">計算機組織</a>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="padding-left: 10px; padding-right:2px;">
                        <form class="form-horizontal" role="form" id="form1" action="" method="POST">
                            <div class="form-group logbox">
                                <h2>會員登入</h2>
                                <br><br><br>
                                <h4 class="control-label">帳號</h4>
                                <input type="text" class="form-inline textbox" id="account" name="account">
                                <label for="account" class="error"></label>
                                <br><br>
                                <h4 class="control-label">密碼</h4>
                                <input type="password" class="form-inline textbox" id="pwd" name="pw">
                                <label for="pwd" class="error"></label>
                                <br><br>
                                <input type="checkbox" id="agree" name="agree">&nbsp;我不是機器人
                                <label class="error" for="agree"></label>
                                <br><br><br>
                                <button type="submit" class="btn btn-primary">登  入</button>&nbsp;&nbsp;
                                <button type="reset" class="btn btn-warning">清  除</button>
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
