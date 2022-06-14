<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

if (isset($_POST['id'])) {
    if (move_uploaded_file($_FILES['picture']['tmp_name'],"images/".$_POST['id'].".jpg")) {
        echo "<script type='text/javascript'>alert('上傳成功!');
        window.location.href='member.php';
        </script>";
        exit();
    }
    else {
        echo "<script type='text/javascript'>alert('上傳失敗!');
        window.location.href='member.php';
        </script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圖片上傳</title>
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
                    id: {
                        required: true,
                        minlength: 13,
                        maxlength: 13,
                        digits: true,
                    },
                },
                messages: {
                    id: {
                        minlength: "長度為13",
                        maxlength: "長度為13",
                        digits: "須為數字",
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
                        <form class="form-horizontal" id="form1" name="form1" action="" method="POST" enctype='multipart/form-data'>
                            <div class="form-group logbox">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">圖片上傳</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr><td class="control-label" colspan="2">ISBN(圖片將命名為"ISBN.jpg")</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="id"></td>
                                    </tr>
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr>
                                        <td><input type='file' name='picture'></td>
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
