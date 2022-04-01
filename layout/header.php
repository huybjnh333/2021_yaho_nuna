<div class="dv-header">
    <div class="dv-header-center">
        <div class="pagewrap flex">
            <div class="right-top">
            </div>
            <div class="logo_top">
                <a href="index.php"><img src="delete/logo.jpg" alt="logo"/></a>
            </div>
            <div class="left-top">
                <div class="timkiem_top">
                    <form action="" method="post">
                        <div class="search">
                            <a href="#" onclick="#" style="cursor:pointer">Nhập từ khóa tìm kiếm</a>
                            <input class="input_search" type="text" id="search" placeholder="Nhập từ khóa tìm kiếm">
                        </div>
                    </form>
                </div>
                <ul class="flag-language">
                    <li>
                        <a href="#" title="Tiếng Việt"><img src="images/vn.png" alt="Tiếng Việt"></a>
                    </li>
                    <li>
                        <a href="#" title="American"><img src="images/eng.png" alt="American"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="dv-header-bt">
        <div class="pagewrap">
            <div class="box_menu">
                <ul class="menu">
                    <li><a href="index.php" title="Trang chủ">Trang chủ</a></li>
                    <li><a href="index.php?page=gioithieu" title="Về nuna">Về nuna</a></li>
                    <li><a href="index.php?page=sanpham" title="Sản phẩm">Sản phẩm</a></li>
                    <li><a href="index.php?page=mevabe_page" title="Góc Mẹ Và Bé">Góc Mẹ Và Bé</a>
                    </li>
                    <li><a href="index.php?page=tienich" title="Tiện ích">Tiện ích <i class="fa fa-angle-down"></i></a>
                        <ul>
                            <li><a href="index.php?page=ngaysinh_view" title="Dự đoán ngày sinh">Dự đoán ngày sinh</a>
                            </li>
                            <li><a href="index.php?page=datten" title="Đặt tên cho bé">Đặt tên cho bé</a></li>
                            <li><a href="index.php?page=chieucao_cannang" title="Đo cân nặng chiều cao">Đo cân nặng
                                    chiều cao</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="index.php?page=hoidap" title="Hỏi đáp">Hỏi đáp</a></li>
                    <li><a href="index.php?page=khuyenmai" title="Tin khuyến mãi">Tin khuyến mãi</a></li>
                    <li><a href="index.php?page=lienhe" title="Liên hệ">Liên hệ</a></li>
                    <li><a href="index.php?page=diemban" title="Điểm bán">Điểm bán</a></li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    <div class="level2navbar hidden-sm hidden-xs dv-ul-menu-child <?php if (isset($_GET['page'])) echo "class_an_trangchon" ?>">
        <div class="l2links pagewrap">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="index.php?page=ngaysinhvatuoibe" class="btn-rounded">
                        <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> Dự đoán ngày sinh và số
                        tuổi của bé
                    </a>
                </li>
                <li>
                    <a href="index.php?page=datten" class="btn-rounded  blue">
                        <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> Đặt tên cho bé
                    </a>
                </li>
                <li>
                    <a href="index.php?page=chieucao_cannang" class="btn-rounded  red">
                        <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> Đo cân nặng chiều cao
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="clr"></div>
</div>

<script type="text/javascript" src="js/placeholdertypewriter.js"></script>
<script type="text/javascript">
    $(function () {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".menu a").each(function () {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
            }
        });
    });
</script>