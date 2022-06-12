<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location:login.php");
    exit();
}

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
                        <div style="margin-top: 10%; margin-left:10%;">
                            <a href="member_data.php"><button type="button" class="btn btn-primary">會員資料更改</button></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="member_order.php"><button type="button" class="btn btn-primary">訂單取消、查詢</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
