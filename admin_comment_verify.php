<?php
session_start();
if (!isset($_SESSION['account']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

if (isset($_GET['op']) && $_GET['op'] == 2) {
    $op = 2;
    $id = $_GET['id'];
    $time = $_GET['time'];
}
else if (isset($_GET['op']) && $_GET['op'] == 1){   
    $op = $_GET['op'];
    $id = $_POST['id'];
    $time = $_POST['time'];
    $rate = $_POST['rate'];
    $content = $_POST['content'];
}
else if (isset($_GET['op']) && $_GET['op'] == 3){   
    $op = $_GET['op'];
    $id = $_POST['id'];
    $isbn = $_POST['isbn'];
    $time = $_POST['time'];
    $rate = $_POST['rate'];
    $content = $_POST['content'];
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($op != 3) {
    $sql = "SELECT * FROM `comment` WHERE account='$id' AND time='$time'";
    if ($result = mysqli_query($link, $sql)) {
        if ($result->num_rows <= 0) {
            mysqli_free_result($result);
            mysqli_close($link);
            echo "<script type='text/javascript'>alert('無資料!');
            window.location.href='admin_comment.php';
            </script>";
            exit();
        }
        else {
            $row = mysqli_fetch_assoc($result);
        }
    }
}

if ($op == 1) {             //modify
    $sql = "UPDATE comment SET rate='$rate', content='$content' WHERE account = '$id' AND time='$time'";
    mysqli_query($link, $sql);
    echo "<script type='text/javascript'>alert('修改成功!');
    window.location.href='admin_comment.php';
    </script>";
    exit();
}
else if ($op == 2) {        //delete
    if ($row['level'] >= 9) {
        echo "<script type='text/javascript'>alert('請從後台刪除管理員資料!');
        window.location.href='admin_comment.php';
        </script>";
        exit();
    }

    $sql = "DELETE FROM `comment` WHERE account='$id' AND time='$time'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    echo "<script type='text/javascript'>alert('刪除成功!');
    window.location.href='admin_comment.php';</script>";
    exit();
}
else if ($op == 3) {        //add
    $sql = "SELECT * FROM `book` WHERE isbn='$isbn'";
    $result = mysqli_query($link, $sql);
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_comment.php';
        </script>";
        exit();
    }
    $sql = "SELECT * FROM `user` WHERE account='$id'";
    $result = mysqli_query($link, $sql);
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('無資料!');
        window.location.href='admin_comment.php';
        </script>";
        exit();
    }

    $sql = "INSERT INTO `comment`(`account`, `time`, `rate`, `content`, `isbn`) VALUES ('$id',NOW(),'$rate','$content','$isbn')";
    mysqli_query($link, $sql);
    mysqli_close($link);
    echo "<script type='text/javascript'>alert('新增成功!');
    window.location.href='admin_comment.php';</script>";
    exit();
}

$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
?>
