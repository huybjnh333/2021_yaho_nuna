<?php
if (!isset($_SESSION['id'])) {
    LOCATION_js($full_url);
    exit();
}

$table = "#_members";
$sql = DB_que("SELECT * FROM $table WHERE `showhi` = 1 AND `id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
$row = mysqli_fetch_array($sql);
$sql_keypass = SHOW_text($row['keypass']);
$sql_matkhau = SHOW_text($row['matkhau']);
$hoten = SHOW_text($row['hoten']);
$email = SHOW_text($row['email']);

$bre = $glo_lang['doi_mat_khau'];

?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <h3><?= $bre ?></h3>
            <li><a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?></a> |
                <a class="active"><?= $bre ?></a></li>
            <div class="clr"></div>
        </ul>
    </div>
</div>
<div class="page_conten_page">
    <div class="pagewrap">
        <div class="center_column">
            <div class="sign_col2" style="width: 100%;">
                <?php include _source . "left_thanh_vien.php"; ?>
                <h3><?= $glo_lang['thay_doi_mat_khau'] ?></h3>
                <h6></h6>
                <form action="" method="post" name="dangkythanhvien" id="dangkythanhvien" enctype="multipart/form-data">
                    <div class=" row-frm">
                        <input type="text" class="form-control sign_input" value="<?= $email ?>" readonly="readonly">
                    </div>
                    <div class=" row-frm">
                        <p><?= $glo_lang['nhap_mat_khau_cu'] ?></p>
                        <input type="password" id="passold_dk" name="passold_dk"
                               class="form-control cls_data_check_form_check_dangky sign_input" data-rong="1"
                               data-msso="<?= $glo_lang['vui_long_nhap_mat_khau_cu'] ?>">
                    </div>
                    <div class=" row-frm">
                        <p><?= $glo_lang['nhap_mat_khau_moi'] ?></p>
                        <input type="password" id="pass_dk" name="pass_dk"
                               class="form-control cls_data_check_form_check_dangky sign_input" data-rong="1"
                               data-msso="<?= $glo_lang['nhap_mat_khau_moi'] ?>">
                    </div>
                    <div class=" row-frm">
                        <p><?= $glo_lang['nhap_lai_mat_khau_moi'] ?></p>
                        <input type="password" id="repass_dk" name="repass_dk"
                               class="form-control cls_data_check_form_check_dangky sign_input" id="repass_dk"
                               id-khac="#pass_dk"
                               data-rong="1" data-khac="1" data-msso="<?= $glo_lang['vui_long_nhap_lai_mat_khau'] ?>"
                               data-msso1="<?= $glo_lang['nhap_lai_mat_khau_khong_chinh_xac'] ?>">

                    </div>

                    <p><a class="cur button_sign" onClick="return check_capnhat()"><?= $glo_lang['cap_nhat'] ?> <img
                                    class="img_load_from_dktv" src="images/loading2.gif"></a></p>

                </form>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>

<script>
    var send_d = 0;

    function check_capnhat() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var khac = $(this).attr('data-khac');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && val == "") {
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
                    url: "<?=$full_url . "/doi-mat-khau/" ?>",
                    data: dataString,
                    success: function (response) {
                        if (response == 1) {
                            alert("<?=$glo_lang['doi_mat_khau_thanh_cong'] ?>");
                            window.location.href = full_url + "/tai-khoan";
                        } else {
                            alert("<?=$glo_lang['mat_khau_cu_khong_dung'] ?>")
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
            check_dangky();
        }
    });
</script>