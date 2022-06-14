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
    <title>新增商品</title>
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
                    price: {
                        required: true,
                    },
                    book_name: {
                        required: true,
                    },
                    full_name: {
                        required: true
                    },
                    author: {
                        required: true
                    },
                    press: {
                        required: true
                    },
                    publish_date: {
                        required: true
                    },
                    lang: {
                        required: true
                    },
                    category: {
                        required: true
                    },
                    spec: {
                        required: true
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
                        <form class="form-horizontal" id="form1" name="form1" action="admin_product_verify.php?op=3" method="POST">
                            <div class="form-group logbox">
                                <input type="hidden" name="id" value="">
                                <h2 style="margin-right:2%;text-align:center; text-decoration:underline; text-underline-position: under;">新增商品</h2>
                                <br><br>
                                <table cellspacing="2" cellpadding="10" align=center>
                                    <tr><td class="control-label" colspan="2">ISBN:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" value="" name="id"></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">價格:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="price" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="book_name" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">完整書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="full_name" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">原文書名:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="eng_name" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">作者:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="author" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">譯者:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="translator" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">出版社:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="press" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">出版日期:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="publish_date" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">語言:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="lang" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">分類:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="category" value=""></td>
                                    </tr>
                                    <tr><td class="control-label" width='50'>內容簡介:</td></tr>
                                    <tr>
                                        <td width='400'><textarea name="content_intro" cols="50" rows="10"></textarea></td>
                                    </tr>
                                    <tr><td class="control-label" colspan="2">規格:</td></tr>
                                    <tr>
                                        <td colspan="2"><input type="text" size="30" maxlength="30" name="spec" value=""></td>
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
