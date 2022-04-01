<?php
$bre = $glo_lang['quen_mat_khau'];
if (isset($_SESSION['id'])) {
    LOCATION_js($full_url);
    exit();
}
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <h3><?=$bre?></h3>
            <li><a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?>
                </a> | <a class="active"><?= $bre ?></a></li>
            <div class="clr"></div>
        </ul>
    </div>
</div>
<div class="page_conten_page">
    <div class="pagewrap">
        <div class="center_column">
            <div class="sign_col2" style="width: 100%;">
                <h4>
                    <?= $glo_lang['text_quen_pass'] ?>
                </h4>
                <div>
                    <input type="text" id="forget_pass" name="forget_pass" class="form-control cls_data_check_form_check_dangky sign_input"
                           data-rong="1" data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                           data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>" placeholder="<?= $glo_lang['login_email'] ?> *">

                    <p>
                        <a class="cur btn_send_qmk button_sign"  onclick="check_email('<?= $full_url ?>')"><?= $glo_lang['gui'] ?>
                            <img class="img_load_from_dktv" src="images/loading2.gif"></a>
                    </p>
                    <input type="hidden" class="email_khong_hop_le" value="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>">
                    <input type="hidden" class="alert_forget_pass_error" value="<?= $glo_lang['alert_forget_pass_error'] ?>">
                    <input type="hidden" class="alert_forget_pass2" value="<?= $glo_lang['alert_forget_pass2'] ?>">
                    <input type="hidden" class="alert_forget_pass" value="<?= $glo_lang['alert_forget_pass'] ?>">
                </div>
                <div class="link_login">
                    <p><?=$glo_lang['chua_co_tai_khoan']?> <a href="<?= $full_url . "/dang-ky" ?>"><?= $glo_lang['dang_ky'] ?></a></p>
                </div>
                <div class="link_login">
                    <p><?= $glo_lang['da_co_tai_khoan'] ?> <a
                                href="<?= $full_url . "/dang-nhap" ?>"><?= $glo_lang['dang_nhap'] ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<script type="text/javascript">
    var send_d = 0;

    function check_email(url) {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var email = $(this).attr('data-email');
            var place = $(this).attr('placeholder');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && (val == "" || val == place)) {
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
                $.ajax({
                    type: "POST",
                    url: url + "/check-email/",
                    data: {"email": $('#forget_pass').val()},
                    success: function (response) {
                        // console.log(response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.error > 0) {
                            var er = $(".alert_forget_pass_error").val();
                            alert(er);
                        } else {
                            alert($(".alert_forget_pass").val() + " " + obj.ms + '\n' + $(".alert_forget_pass2").val());
                            //bat login
                            window.location.href = full_url + "/dang-nhap";
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
            check_dangnhap();
        }
    });
</script>