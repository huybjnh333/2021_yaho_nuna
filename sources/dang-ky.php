<?php
$bre = $glo_lang['dang_ky'];
if (isset($_SESSION['id'])) {
    LOCATION_js($full_url);
    exit();
}
$nd_dangky = LAYTEXT_rieng(90);
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <h3><?= $bre ?></h3>
            <li><a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?></a> | <a
                        class="active"><?= $glo_lang['dang_ky_tai_khoan'] ?></a></li>
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
                        <img src="<?=full_src($nd_dangky,"")?>"></div>
                    <p class="col1_des showText"><?=SHOW_text($nd_dangky['noidung_'.$lang])?></p>
                </div>
            </div>
            <div class="sign_col2">
                <div class="row title">
                    <div class="col-md-6 col-xs-12"><h3><?= $glo_lang['dang_ky_thong_tin'] ?></h3></div>
                </div>

                <form action="" method="post" name="dangkythanhvien" id="dangkythanhvien">
                    <input type="text" name="email_dk" class="form-control cls_data_check_form_check_dangky sign_input"
                           data-rong="1"
                           data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                           data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"
                           placeholder="<?= $glo_lang['email'] ?> (*)">
                    <input type="password" name="pass_dk"
                           class="form-control cls_data_check_form_check_dangky sign_input" id="pass_dk"
                           data-rong="1" data-msso="<?= $glo_lang['login_nhap_mat_khau'] ?>"
                           placeholder="<?= $glo_lang['login_pass'] ?> (*)">
                    <input type="password" name="repass_dk"
                           class="form-control cls_data_check_form_check_dangky sign_input"
                           id="repass_dk" id-khac="#pass_dk" data-rong="1" data-khac="1"
                           data-msso="<?= $glo_lang['vui_long_nhap_lai_mat_khau'] ?>"
                           data-msso1="<?= $glo_lang['nhap_lai_mat_khau_khong_chinh_xac'] ?>"
                           placeholder="<?= $glo_lang['register_repass'] ?> (*)">
                    <input type="text" name="fullname_dk"
                           class="form-control cls_data_check_form_check_dangky sign_input"
                           data-rong="1" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"
                           placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)">
                    <!--<input type="text" id="phone_dk" class="form-control cls_data_check_form_check_dangky sign_input"
                           name="phone_dk"
                           data-rong="1" data-phone="1" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                           data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"
                           placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)">
                    <input type="text" name="diachi" class="form-control cls_data_check_form_check_dangky sign_input"
                           data-rong="1"
                           data-msso="<?= $glo_lang['nhap_dia_chi'] ?>" placeholder="<?= $glo_lang['dia_chi'] ?> (*)">-->
                    <div class="col-md-4 row-frm row-frm-mbv">
      <span class="span_mbv">
        <img src="<?= $full_url . "/load-capcha/" ?>" alt="CAPTCHA code"
             onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')" id="img_contact_cap"><i
                  class="fa fa-refresh"
                  onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i>
      </span>
                        <input class="form-control cls_data_check_form_check_dangky sign_input" data-rong="1"
                               name="mabaove"
                               id="mabaove" type="text" placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                               data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                    </div>
                    <div class="col-md-4 row-frm">
                        <label class="checkbox">
                            <input type="checkbox" class="cls_data_check_form_check_dangky" data-check="1"
                                   data-msso="<?= $glo_lang['ban_chua_dong_y_thoa_thuan'] ?>" checked="checked">
                            <?= $glo_lang['dieu_khoan_dk_thanh_vien'] ?></label>
                    </div>
                    <p><a class="cur button_sign" onClick="check_dangky()"><?= $glo_lang['dang_ky'] ?> <img
                                    class="img_load_from_dktv"
                                    src="images/loading2.gif"></a>
                    </p>
                </form>

                <div class="link_login">
                    <p><?= $glo_lang['da_co_tai_khoan'] ?> <a
                                href="<?= $full_url . "/dang-nhap" ?>"><?= $glo_lang['dang_nhap'] ?></a></p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="clr"></div>
</div>
<script>
    var send_d = 0;

    function check_dangky() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var phone = $(this).attr('data-phone');
            var email = $(this).attr('data-email');
            var d_check = $(this).attr('data-check');
            var place = $(this).attr('placeholder');
            var khac = $(this).attr('data-khac');

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
            // else if(phone == 1 && !CHECK_phone(this) && val != ""){
            //     alert($(this).attr('data-msso1'));
            //     $(this).focus();
            //     $(".ajax_img_loading").hide();
            //     check = 1;
            //     send_d = 0;
            //     return false;
            // }
            else if (d_check == 1 && !$(this).is(":checked")) {
                alert($(this).attr('data-msso'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            } else if (khac == 1 && val != $($(this).attr('id-khac')).val()) {
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
                var dataString = $('#dangkythanhvien').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "<?=$full_url . "/check-dang-ky/" ?>",
                    data: dataString,
                    success: function (response) {
                        console.log(response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.error == 10) {
                            alert("<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>");
                            $("#mabaove").focus();
                        } else if (obj.error > 0) {
                            alert("<?=$glo_lang['email_da_duoc_dang_ky']  ?>");
                            $("#email_dk").focus();
                        } else {
                            alert("<?=$glo_lang['dang_ky_tai_khoan_thanh_cong']  ?>");
                            window.location.href = full_url + '/dang-nhap';
                        }
                        $("#img_contact_cap").attr("src", "<?=$full_url ?>/load-capcha/");
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
            check_dangky();
        }
    });

</script>