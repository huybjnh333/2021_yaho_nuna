<?php
$bg = LAY_banner_new("`id_parent` = 28",1);
?>
<div class="newsletter_home" style="<?=!empty($bg['icon']) ? "background:url(".full_src($bg,"").");background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;-ms-background-size: cover;" : ""?>">
    <div class="pagewrap">
        <div class="contact">
            <h2 class="tiltle wow flipInX"><?=$glo_lang['dat_lich_hen_now']?></h2>
            <p class="p-brief"><?=$glo_lang['mota_dat_lich_hen_now']?></p>
            <form action="#" class="formbox wow fadeInLeft" method="post" name="form_datlichhen" id="form_datlichhen">
                <input type="hidden" name="send_datlichhen">
                <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                <input type="hidden" name="tieude_lienhe"
                       value="<?= !empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['thongtin_datlichhen']) ?>">
                <ul>
                    <div class="form-group qtext col-12">
                        <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ten_quy_khach']) ?>">
                        <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname" id="s_fullname"
                               type="text" placeholder="<?= $glo_lang['ten_quy_khach'] ?> (*)"
                               value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                               onFocus="if (this.value == '<?= $glo_lang['ten_quy_khach'] ?> (*)'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['ten_quy_khach'] ?> (*)';}"
                               data-name="<?= $glo_lang['ten_quy_khach'] ?> (*)"
                               data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                    </div>
                    <div class="form-group qtext col-6">
                        <input type="hidden" name="s_dienthoai_s"
                               value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                        <input class="cls_data_check_form form-control" data-rong="1" name="s_dienthoai" id="s_dienthoai" type="text"
                               placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-phone="1"
                               value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                               onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                               data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                               data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                               data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                    </div>
                    <div class="form-group qtext col-6">
                        <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                        <input class="cls_data_check_form form-control" name="s_email" id="s_email"
                               type="text"
                               placeholder="<?= $glo_lang['email'] ?>"
                               value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                               onFocus="if (this.value == '<?= $glo_lang['email'] ?>'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?>';}"
                               data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                               data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                    </div>

                    <div class="clr"></div>
                    <div class="form-group qtext col-12">
                        <input type="hidden" name="s_chinhanh_s" value="<?= base64_encode($glo_lang['chi_nhanh']) ?>">
                        <select class="cls_data_check_form form-control" data-rong="1" name="s_chinhanh"
                                data-msso="<?= $glo_lang['chua_chon_chi_nhanh'] ?>">
                            <option><?=$glo_lang['chon_chi_nhanh']?></option>
                            <?php
                            $chi_nhanh = explode(",",$glo_lang['chi_nhanh_dat_lich']);
                            foreach ($chi_nhanh as $key => $val){
                                $key = (int) $key + 2;
                                ?>
                                <option value="<?=$key?>"><?=$val?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clr"></div>

                    <div class="form-group qtext col-6">
                        <input type="hidden" name="s_purchasedate_s" value="<?= base64_encode($glo_lang['ngay_den']) ?>">
                        <input type="date" id="s_purchasedate" name="s_purchasedate" min="<?php echo date('Y-m-d'); ?>"
                               class="cls_data_check_form form-control"
                               data-rong="1" data-msso="<?= $glo_lang['ngay_den'] ?>">
                    </div>
                    <div class="form-group qtext col-6">
                        <input type="hidden" name="s_chongio_s"
                               value="<?= base64_encode($glo_lang['gio']) ?>">
                        <select class="cls_data_check_form form-control" name="s_chongio"
                                data-msso="<?= $glo_lang['chua_chon_gio'] ?>">
                            <option value=""><?=$glo_lang['chon_gio']?></option>
                            <?php
                            $gio = explode(",",$glo_lang['gio_dat_lich']);
                            foreach ($gio as $key => $val){
                                ?>
                                <option value="<?=$key?>"><?=$val?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clr"></div>
                    <div class="form-group qtext col-12">
                        <input type="hidden" name="s_message_s"
                               value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                        <input class="cls_data_check_form form-control contact_lbl" name="s_message" id="s_message"
                               placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>  (*)"
                               data-msso="<?= $glo_lang['nhap_noi_dung'] ?>" value="<?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?>">
                        <input name="capcha_hd" type="hidden" id="capcha_hd" value="<?=$_SESSION['cap'] = RAND(11111,99999) ?>">
                    </div>
                    <p class="read_more"><a class="cur" onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#form_datlichhen', '.cls_data_check_form')">
                            <?=$glo_lang['dat_lich_hen']?><i class="fa fa-caret-right"></i>
                            <img src="images/loading2.gif" class="ajax_img_loading"></a></p>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </form>
            <div class="clr"></div>
        </div>
    </div>
</div>