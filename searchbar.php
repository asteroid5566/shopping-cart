<?php
    echo '
    <div class="col-12" style="background-color:#EEEEEE; height: 48px; padding-left: 2%; margin-bottom: 1%;">
        <form id="form2" name="form2" action="search.php" method="GET">
            <input type="text" class="form" style="margin-top: 10px; border: 2px #04AA60 solid;" name="keyword">
            <button type="submit" class="btn btn-primary btn-sm" style="vertical-align: top; margin-top: 9px; background-color:#04AA60">搜尋</button>
            <span class="keyword" style="margin-left: 8px;">
                <span style="margin-right: 6px;">熱門關鍵字:</span>
                <a href="search.php?keyword=輕小說" style="margin-right: 4px;">輕小說</a>
                <a href="search.php?keyword=PHP" style="margin-right: 4px;">PHP</a>
                <a href="search.php?keyword=多益" style="margin-right: 4px;">多益</a>
                <a href="search.php?keyword=計算機組織" style="margin-right: 4px;">計算機組織</a>
            </span>
        </form>
    </div>';
?>
