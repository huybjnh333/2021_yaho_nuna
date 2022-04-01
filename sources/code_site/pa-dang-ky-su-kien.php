<?php
$rows = LAY_baiviet(8, 1, "`id` = '" . @$_GET['id'] . "'");
$rows = reset($rows);
?>
<div class="tuvanbaogia_popup pop-quotation">
    <ul>
        <form action="" class="formBox no_box" method="post" accept-charset="UTF-8" name="formnamecontact_baogia"
              id="formnamecontact_baogia">
            <h3><?= $glo_lang['dang_ky_thong_tin'] ?></h3>
            <input type="hidden" name="send_lienhe">
            <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
            <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
            <input type="hidden" name="tieude_lienhe" value="<?= base64_encode($glo_lang['dang_ky_thong_tin']) ?>">

            <input type="hidden" name="s_address_s" value="<?= base64_encode($glo_lang['su_kien']) ?>">
            <input name="s_address" id="s_address" type="hidden" value="<?= $rows['tenbaiviet_' . $lang] ?>"/>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                    <input class="form-control cls_data_check_form_bg" data-rong="1" name="s_fullname" id="s_fullname"
                           type="text" placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                           value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                           onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                           data-name="<?= $glo_lang['ho_va_ten'] ?> (*)" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                    <input class="form-control cls_data_check_form_bg" data-rong="1" data-email="1" name="s_email"
                           id="s_email" type="text" placeholder="<?= $glo_lang['email'] ?> (*)"
                           value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                           onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                           data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                           data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_dienthoai_s" value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                    <input class="form-control cls_data_check_form_bg" data-rong="1" name="s_dienthoai" id="s_dienthoai"
                           type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                           value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                           onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                           data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                           data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md col-md-3 row-frm">
                    <input type="hidden" name="s_message_s" value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                    <textarea class="cls_data_check_form_bg form-control form-control_3" data-rong="1" name="s_message"
                              id="s_message" cols="" rows="" placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>  (*)"
                              data-msso="<?= $glo_lang['nhap_noi_dung'] ?>"><?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <span style="line-height: 0;padding-right: 0;"><img src="<?= $full_url . "/load-capcha/" ?>"
                                                                        alt="CAPTCHA code"
                                                                        style="height: 41px; width: auto; cursor: pointer; position: relative; top: 2px; right: 2px;"
                                                                        onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')"
                                                                        id="img_contact_cap"><i class="fa fa-refresh"
                                                                                                style="position: absolute; right: 3px; bottom: 3px; font-size: 10px; color: #666;"
                                                                                                onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i></span>
                    <input class="cls_data_check_form_bg form-control" data-rong="1" name="mabaove" id="mabaove"
                           type="text" placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                           onFocus="if (this.value == '<?= $glo_lang['ma_bao_ve'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['ma_bao_ve'] ?> (*)';}"
                           data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                </div>
            </li>
            <h4>
                <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#formnamecontact_baogia', '.cls_data_check_form_bg')"
                   style="cursor:pointer"><?= $glo_lang['dang_ky'] ?><i class="fa fa-long-arrow-right"></i> <img
                            src="images/loading2.gif" class="ajax_img_loading"></a></h4>

            <div class="clr"></div>
        </form>
    </ul>
</div>