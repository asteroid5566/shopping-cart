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
    <title>新增留言</title>
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
                    isbn: {
                        required: true,
                        minlength: 13,
                        maxlength: 13,
                        digits: true,
                    },
                    id: {
                        required: true,
                    },
                },
                messages: {
                    isbn: {
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
                        <form class="form-horizontal" id="form1" name="form1" action="admin_comment_verify.php?op=3" method="POST">
                            <div class="form-group logbox">
                                <input type="hidden" name="time" value="<?php echo date("Y/m/d H:i:s", time());?>">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">新增留言</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr>
                                        <td class="control-label" colspan="2">帳號:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="id" id="id" size="30" maxlength="30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">ISBN:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="isbn" id="isbn" size="30" maxlength="30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="control-label" colspan="2">評鑑分數:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <select name="rate">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td class="control-label" width='50'>留言:</td>
                                    </tr>
                                    <tr>
                                        <td width='400'>
                                            <input type="text" id="content" name="content" size="30" maxlength="30" placeholder="若未填則只顯示評分">
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
