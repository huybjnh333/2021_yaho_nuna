<div class="level2navbar">
    <div class="click-right">
        <i class="fa fa-life-ring" aria-hidden="true"></i><br>Hỗ<br>trợ<br>khách<br>hàng
    </div>
    <div class="l2links">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="index.php?page=ngaysinh_view" class="btn-rounded">
                    <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> Dự đoán ngày sinh bé
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

<script>
    $(document).ready(function () {
        $(".level2navbar").click(function () {
            $(".l2links").toggle();
        });
    });
</script>