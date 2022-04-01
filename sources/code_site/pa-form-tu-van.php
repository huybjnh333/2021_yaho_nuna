<div class="tuvanbaogia_popup">
    <?php $nd_tuvan = LAYTEXT_rieng(92); ?>
    <h3><?=$nd_tuvan['tenbaiviet_'.$lang]?> <img src="<?=full_src($nd_tuvan,"")?>"></h3>
    <form action="#" class="formbox wow fadeInLeft" method="post" name="form_datlichhen2" id="form_datlichhen2">
        <input type="hidden" name="send_tuvan">
        <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
        <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
        <input type="hidden" name="tieude_lienhe"
               value="<?= !empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['thongtin_tuvan']) ?>">
        <ul>
            <div class="form-group qtext col-12">
                <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                <input class="cls_data_check_form_2 form-control" data-rong="1" name="s_fullname" id="s_fullname"
                       type="text" placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                       value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                       onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                       data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                       data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
            </div>
            <div class="form-group qtext col-6">
                <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                <input class="cls_data_check_form_2 form-control" name="s_email" data-rong="1" data-email="1"
                       id="s_email"
                       type="text"
                       placeholder="<?= $glo_lang['email'] ?> "
                       value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                       onFocus="if (this.value == '<?= $glo_lang['email'] ?> '){this.value='';}"
                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> ';}"
                       data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                       data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
            </div>
            <div class="form-group qtext col-6">
                <input type="hidden" name="s_dienthoai_s"
                       value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                <input class="cls_data_check_form_2 form-control" data-rong="1" name="s_dienthoai" id="s_dienthoai"
                       type="text"
                       placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-phone="1"
                       value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                       onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                       data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                       data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                       data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
            </div>
            <div class="clr"></div>

            <div class="form-group qtext col-12">
                <input type="hidden" name="s_message_s"
                       value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                <textarea class="cls_data_check_form_2 form-control contact_lbl" name="s_message" placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>  (*)"
                          id="s_message" data-msso="<?= $glo_lang['nhap_noi_dung'] ?>"></textarea>
                <input name="capcha_hd" type="hidden" id="capcha_hd" value="<?=$_SESSION['cap'] = RAND(11111,99999) ?>">
            </div>
            <h4>
                <a class="cur" onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#form_datlichhen2', '.cls_data_check_form_2')">
                    <?= $glo_lang['gui_yeu_cau'] ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    <img src="images/loading2.gif" class="ajax_img_loading"></a></h4>
            <div class="clr"></div>
        </ul>
        <div class="clr"></div>
    </form>
    <div style="margin-top: 20px;">
        <?=$nd_tuvan['noidung_'.$lang]?>
    </div>
</div>