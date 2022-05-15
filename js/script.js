window.onscroll = function () { scrollFunction() }; //捲動20px顯示
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("topbtn").style.display = "block";
    } else {
        document.getElementById("topbtn").style.display = "none";
    }
}

function topFunction() { //返回頂部
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
