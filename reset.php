<?php
session_start();

if (isset($_SESSION['account'])) {
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
                    agree: {
                        required: true
                    },
                },
                messages: {
                    account: {
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
            <?php include("sidebar.php"); ?>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <?php include("searchbar.php"); ?>
                </div>
                <div class="row">
                    <div class="col-12" style="padding-left: 10px; padding-right:2px;">
                        <form class="form-horizontal" role="form" id="form1" action="reset_check.php" method="POST">
                            <div class="form-group logbox">
                                <h2 style="text-align:center; text-decoration:underline; text-underline-position: under;">重設密碼</h2>
                                <br><br><br>
                                <h4 class="control-label">帳號</h4>
                                <input type="text" class="form-inline textbox" id="account" name="account">
                                <label for="account" class="error"></label>
                                <br><br>
                                <input type="checkbox" id="agree" name="agree">&nbsp;我不是機器人
                                <label class="error" for="agree"></label>
                                <br><br><br>
                                <button type="submit" class="btn btn-primary">確 認</button>&nbsp;&nbsp;
                                <button type="reset" class="btn btn-danger">清  除</button>
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
