<?php
session_start();
if (!isset($_SESSION['account']) || $_SESSION['level'] < 9) {
    header("Location:index.php");
    exit();
}

if (isset($_GET['op']) && $_GET['op'] == 2) {   //del
    $op = 2;
    $id = $_GET['id'];
}
else if (isset($_GET['op']) && $_GET['op'] == 3) {   //add
    $op = 3;
    $id = $_POST['id'];
    $price = $_POST['price'];
    $book_name = $_POST['book_name'];
    $full_name = $_POST['full_name'];
    $eng_name = $_POST['eng_name'];
    $author = $_POST['author'];
    $translator = $_POST['translator'];
    $press = $_POST['press'];
    $publish_date = $_POST['publish_date'];
    $lang = $_POST['lang'];
    $category = $_POST['category'];
    $content_intro = $_POST['content_intro'];
    $spec = $_POST['spec'];
}
else if (isset($_POST['id'])){      //modify
    $op = 1;
    $id = $_POST['id'];
    $price = $_POST['price'];
    $book_name = $_POST['book_name'];
    $full_name = $_POST['full_name'];
    $eng_name = $_POST['eng_name'];
    $author = $_POST['author'];
    $translator = $_POST['translator'];
    $press = $_POST['press'];
    $publish_date = $_POST['publish_date'];
    $lang = $_POST['lang'];
    $category = $_POST['category'];
    $content_intro = $_POST['content_intro'];
    $spec = $_POST['spec'];
}

$link = mysqli_connect("localhost", "root", "root123456", "group_07") or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$sql = "SELECT * FROM `book` WHERE isbn='$id'";
if ($op != 3 && $result = mysqli_query($link, $sql)) {
    if ($result->num_rows <= 0) {
        mysqli_free_result($result);
        mysqli_close($link);
        echo "<script type='text/javascript'>alert('查無此書!');
        window.location.href='admin_product.php';
        </script>";
        exit();
    }
    else {
        $row = mysqli_fetch_assoc($result);
    }
}

if ($op == 1) {             //modify
    $sql = "UPDATE book SET price='$price', book_name='$book_name', full_name='$full_name', eng_name='$eng_name', author='$author', translator='$translator', press='$press', publish_date='$publish_date', lang='$lang', category='$category', content_intro='$content_intro', spec='$spec' WHERE isbn = '$id'";
    mysqli_query($link, $sql);
    echo "<script type='text/javascript'>alert('修改成功!');
    window.location.href='admin_product.php';
    </script>";
    exit();
}
else if ($op == 2) {        //delete
    $sql = "DELETE FROM `book` WHERE isbn='$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
    unlink("images/$id.jpg");
    echo "<script type='text/javascript'>alert('刪除成功".file_exists("images/$id.jpg")."!');
    window.location.href='admin_product.php';</script>";
    exit();
}
else if ($op == 3) {        //add
    $sql = "INSERT INTO `book`(`price`, `book_name`, `full_name`, `eng_name`, `author`, `translator`, `press`, `publish_date`, `lang`, `category`, `content_intro`, `isbn`, `spec`) VALUES ('".$_POST['price']."','".$_POST['book_name']."','".$_POST['full_name']."','".$_POST['eng_name']."','".$_POST['author']."','".$_POST['translator']."','".$_POST['press']."','".$_POST['publish_date']."','".$_POST['lang']."','".$_POST['category']."','".$_POST['content_intro']."','".$_POST['id']."','".$_POST['spec']."')";

    mysqli_query($link, $sql);
    mysqli_close($link);
    echo "<script type='text/javascript'>alert('新增商品成功!');
    window.location.href='admin_product.php';</script>";
    exit();
}

$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
?>
