<?php
$bre = $glo_lang['dang_nhap'];

if (isset($_SESSION['id'])) {
    LOCATION_js($full_url);
    exit();
}
$nd_dangnhap = LAYTEXT_rieng(89);
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <h3><?=$bre?></h3>
            <li><a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?>
                </a>| <a class="active"><?= $bre ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="page_conten_page">
    <div class="pagewrap">
        <div class="center_column">
            <div class="sign_col1">
                <div class="col1-top">
                    <div class="images">
                        <img src="<?=full_src($nd_dangnhap,"")?>"></div>
                    <p class="col1_des showText"><?=SHOW_text($nd_dangnhap['noidung_'.$lang])?></p>
                </div>
            </div>
            <div class="sign_col2">
                <h3 class="col2_subheading"><?=$glo_lang['thong_tin_dang_nhap']?></h3>
                <form action="" method="post" name="dangnhap" id="dangnhap">
                    <input type="text" name="txt_email" class="form-control cls_jsdangky sign_input" data-rong="1" data-email="1"
                           data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                           data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>" placeholder='<?=$glo_lang['email']?>'>
                    <input type="password" name="txt_pass" id="txt_pass" class="form-control cls_jsdangky sign_input" data-rong="1"
                           data-msso="<?= $glo_lang['login_nhap_mat_khau'] ?>" placeholder='<?= $glo_lang['login_pass'] ?>'>
                    <div class="col-12 text-center">
                        <button class="btn btn-default btn-login button_sign" type="button"
                                onclick="check_dangnhap_new()"><?= $glo_lang['dang_nhap'] ?> <img
                                    class="img_load_from_dktv" src="images/loading2.gif"></button>
                    </div>
                </form>
                <div class="link_login">
                    <p> <a href="<?= $full_url . "/quen-mat-khau" ?>"><?= $glo_lang['quen_mat_khau']."?" ?></a></p>
                </div>
                <div class="link_login">
                    <p><?=$glo_lang['chua_co_tai_khoan']?> <a href="<?= $full_url . "/dang-ky" ?>"><?= $glo_lang['dang_ky'] ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>

<script type="text/javascript">
    var send_d = 0;

    function check_dangnhap_new() {
        var check = 0;
        $(".cls_jsdangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var email = $(this).attr('data-email');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && val == '') {
                alert($(this).attr('data-msso'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            } else if (email == 1 && !regex.test(val) && val != "") {
                alert($(this).attr('data-msso1'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            }
        });

        if (check == 0) {
            if (send_d == 0) {
                send_d = 1;
                $(".img_load_from_dktv").show();
                var dataString = $('#dangnhap').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "<?=$full_url . "/check-dang-nhap/" ?>",
                    data: dataString,
                    success: function (response) {
                        console.log(response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.error > 0) {
                            alert(obj.ms);
                        } else {
                            window.location.href = "<?=$full_url . "/tai-khoan/" ?>";
                        }
                        $(".img_load_from_dktv").hide();
                        send_d = 0;
                    }
                });
            }
        }
    }

    $('.form-control').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            check_dangnhap_new();
        }
    });
</script> 