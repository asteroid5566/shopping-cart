<?php
session_start();
if (isset($_SESSION['account'])) {
    header("Location:index.php");
    exit();
}

$_SESSION['checkaccount'] = 0;
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
        function sendRequest() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) document.getElementById('show_msg').innerHTML = '此帳號已存在，請嘗試其他組合';
                    else document.getElementById('show_msg').innerHTML = '';
                }
            };
            var url = 'register_check.php?p_usr=' + document.form1.p_usr.value + '&timeStamp=' + new Date().getTime();
            xhttp.open('GET', url, true);
            xhttp.send();
        }

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
                    agree: {
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
                    <?php include("searchbar.php"); ?>
                </div>
                <div class="row">
                    <div class="col-12" style="padding-left: 10px; padding-right:2px;">
                        <form class="form-horizontal" id="form1" name="form1" action="register_verify.php" method="POST">
                            <div class="form-group logbox">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">會員註冊</h2>
                                <br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td colspan="2"><span id='show_msg' style="color:red"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50' style="font-size:12pt">帳號:</td>
                                        <td width='400'>
                                            <input type="text" name="p_usr" id="p_usr" maxLength="12" placeholder="6至12個字元" onkeyup=sendRequest();>
                                            <label for="p_user" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>密碼:</td>
                                        <td width='400'>
                                            <input type="password" name="pwd" id="pwd" maxLength="12" placeholder="6至12個字元">
                                            <label for="pwd" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>姓名:</td>
                                        <td width='400'>
                                            <input type="text" name="name" id="name" maxLength="12" placeholder="可免填">
                                            <label for="name" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>email:</td>
                                        <td width='400'>
                                            <input type="text" name="email" id="email" maxLength="30" placeholder="可免填">
                                            <label for="email" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" width='50'>電話:</td>
                                        <td width='400'>
                                            <input type="text" name="phone" id="phone" maxLength="12" placeholder="可免填">
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
                                            <input type="text" name="question" id="question" size="30" maxlength="30" placeholder="最多30字(例如: 您就讀哪間高中?)">
                                            <label for="question" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">回答&nbsp;(請牢記或妥善保存)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="answer" id="answer" size="30" maxlength="30" placeholder="最多30字">
                                            <label for="answer" class="error"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width='100'></td>
                                        <td class="control-label" width='400' style="text-align: center; padding-right: 20%;">
                                            <input type="checkbox" id="agree" name="agree">&nbsp;我不是機器人
                                            <label class="error" for="agree"></label>
                                        </td>
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
