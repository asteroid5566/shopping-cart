<?php
session_start();

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
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
        <div class="row">
            <div class="col-12" style="padding: 0px;">
                <img src="images/banner.png" width=100%>
            </div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <?php include("sidebar.php"); ?>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <?php include("searchbar.php"); 

                    if ($result = mysqli_query($link, 'SELECT * FROM book ORDER BY publish_date')) {
                        if (!isset($_GET['page']))
                            $page = 1;
                        else
                            $page = $_GET['page'];

                        $page_num = ceil(mysqli_num_rows($result)/8);
                        mysqli_data_seek($result, ($page - 1) * 8);
                        
                        for ($i = 0; $i < 8; $i++) {
                            if ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <a href="products.php?id=' . $row["isbn"] . '" class="cardlink">
                                            <img class="cardimg" src="images/' . $row["isbn"] . '.jpg">
                                            <h5>' . $row['book_name'] . '</h5>
                                        </a>
                                        <p class="price">$' . $row['price'] . '</p>';
                                    echo '</div>
                                </div>';
                            }
                            else
                                break;
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                    ?>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align:center; padding:4%; font-weight:bold;">
                        <?php
                            $str = "";
                            for ($i = 1; $i <= $page_num; $i++) {
                                if ($i == $page)
                                    $str = $str."&nbsp;&nbsp;". $i . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                else
                                    $str .= "<a href='".$_SERVER['PHP_SELF']."?page=$i'><button class='addbt' style='font-weight:bold;'>$i</button></a>&nbsp;&nbsp;";
                            }
                            echo $str;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
