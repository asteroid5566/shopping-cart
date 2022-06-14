<?php
if (!isset($_SESSION['cnt']))
    $_SESSION['cnt'] = 0;
?>
<div class="row">
    <div class="col-12" style="padding: 0px;">
        <div class="topnav">
            <a class="active" href="index.php">書城首頁</a>

            <a href="cart.php" style="float:right">購物車&nbsp;<span style="color:red; font-weight:bold;">(<?php echo $_SESSION['cnt']; ?>)</span></a>
            <?php
            if (!isset($_SESSION['account']))
                echo '<a href="register.php" style="float:right">會員註冊</a>';
            else if ($_SESSION['level'] < 9)
                echo '<a href="member.php" style="float:right">會員中心</a>';
            else
                echo '<a href="member.php" style="float:right">管理中心</a>';

            if (isset($_SESSION['account']))
                echo '<a href="logout.php" style="float:right">登出</a>';

            if (isset($_SESSION['account']))
                echo '<div style="float:right">您好&nbsp;'.$_SESSION['account'].'</div>';
            else
                echo '<a href="login.php" style="float:right">登入</a>';
            ?>
        </div>
    </div>
</div>

