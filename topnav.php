<?php
if (isset($_SESSION['cart'])) {
    $_SESSION['cnt'] = count($_SESSION['cart']);
} else {
    $_SESSION['cnt'] = 0;
}
echo '
    <div class="row">
        <div class="col-12" style="padding: 0px;">
            <div class="topnav">
                <a class="active" href="index.php">首頁</a>
                <a href="#">近期活動</a>
                <a href="#">熱門商品</a>
                <a href="#">最新上架</a>

                <a href="#" style="float:right">購物車&nbsp;<span style="color:red; font-weight:bold;">('.$_SESSION['cnt'].')</span></a>
                <a href="#" style="float:right">會員中心</a>
                <a href="#" style="float:right">會員註冊</a>';

                if (isset($_SESSION['account']) && $_SESSION['account'] == 'member')
                    echo '<div style="float:right">您好,&nbsp;'.$_SESSION['account'].'</div>';
                else
                    echo '<a href="login.php" style="float:right">登入</a>';
        echo '</div>
        </div>
    </div>
';
?>
