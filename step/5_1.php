<?php
if (isset($_SESSION['id'])) {
    $info_acc = DB_fet("*", "#_members", "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0", "`id` DESC", 1);
    if (mysqli_num_rows($info_acc)) {
        $info_acc = mysqli_fetch_assoc($info_acc);
        foreach ($info_acc as $key => $value) {
            ${$key} = $value;
        }
    }
}
// full_src($thongtin_step, '')
include _source . "box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="contact-full">
    <div class="pagewrap">
        <div class="contact-maps">
            <li><?php if ($thongtin_step['map_google'] != "") { ?>
                    <iframe class="iframe_load" iframe-src="<?= $thongtin_step['map_google'] ?>" width="600"
                            height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php } ?></li>
        </div>
        <div class="left_contact">
            <?php
            $i = 0;
            $baiviet = LAY_baiviet($thongtin_step['id'], 1);
            foreach ($baiviet as $rows) {
                $i++;
                // if($i > 1) continue;
                // full_img($rows, '')
                ?>
                <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                <ul>
                    <div class="showText showText_lienhe"><?= $rows['noidung_' . $lang] ?></div>
                </ul>
            <?php } ?>
        </div>
        <div class="right_contact">
            <h3><?= $glo_lang['form_lien_he'] ?></h3>
            <form action="" class="formBox no_box" method="post" accept-charset="UTF-8" name="formnamecontact2"
                  id="formnamecontact2">
                <input type="hidden" name="send_lienhe">
                <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                <input type="hidden" name="tieude_lienhe"
                       value="<?= !empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['thongtin_lienhe']) ?>"
                       class="js_title_lh">
                <div class="contact">
                    <form action="#" class="formBox" method="post" name="FormNameContact" id="FormNameContact">
                        <div class="left">
                            <div class="contact-topics ">
                                <select name="id" onchange="$('.js_title_lh').val($(this).val())">
                                    <option value="<?= base64_encode($glo_lang['vui_long_chon_chu_de']) ?>"><?= $glo_lang['vui_long_chon_chu_de'] ?></option>
                                    <option value="<?= base64_encode($glo_lang['yeu_cau_dat_hang']) ?>"><?= $glo_lang['yeu_cau_dat_hang'] ?></option>
                                    <option value="<?= base64_encode($glo_lang['thong_tin_san_pham']) ?>"><?= $glo_lang['thong_tin_san_pham'] ?></option>
                                    <option value="<?= base64_encode($glo_lang['yeu_cau_viec_lam']) ?>"><?= $glo_lang['yeu_cau_viec_lam'] ?></option>
                                    <option value="<?= base64_encode($glo_lang['cac_tai_lieu']) ?>"><?= $glo_lang['cac_tai_lieu'] ?></option>
                                    <option value="<?= base64_encode($glo_lang['khac']) ?>"><?= $glo_lang['khac'] ?></option>
                                </select>
                            </div>
                            <li class="name">
                                <input type="hidden" name="s_fullname_s"
                                       value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                                <input class="cls_data_check_form" data-rong="1" name="s_fullname" id="s_fullname"
                                       type="text" placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                                       value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                                       data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                                       data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                            </li>
                            <li class="phone">
                                <input type="hidden" name="s_dienthoai_s"
                                       value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                                <input class="cls_data_check_form" data-rong="1" name="s_dienthoai" id="s_dienthoai"
                                       type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                                       value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                                       data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                                       data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                                       data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                            </li>
                            <li class="mail">
                                <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                                <input class="cls_data_check_form" data-rong="1" data-email="1" name="s_email"
                                       id="s_email" type="text" placeholder="<?= $glo_lang['email'] ?> (*)"
                                       value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                                       data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                                       data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                            </li>
                        </div>
                        <div class="right">
                            <li class="mess">
                                <input type="hidden" name="s_message_s"
                                       value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                                <textarea class="cls_data_check_form" data-rong="1" name="s_message" id="s_message"
                                          cols="" rows="" placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>  (*)"
                                          data-msso="<?= $glo_lang['nhap_noi_dung'] ?>"><?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                                <div class="clr"></div>
                            </li>
                            <li class="code">
                                <span style="line-height: 0;padding-right: 0;"><img
                                            src="<?= $full_url . "/load-capcha/" ?>" alt="CAPTCHA code"
                                            style="height: 41px; width: auto; cursor: pointer; position: relative; top: 2px; right: 2px;"
                                            onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')"
                                            id="img_contact_cap"><i class="fa fa-refresh"
                                                                    style="position: absolute; right: 3px; bottom: 3px; font-size: 10px; color: #666;"
                                                                    onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i></span>
                                <input class="cls_data_check_form" data-rong="1" name="mabaove" id="mabaove" type="text"
                                       placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                                       onFocus="if (this.value == '<?= $glo_lang['ma_bao_ve'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['ma_bao_ve'] ?> (*)';}"
                                       data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                            </li>
                            <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#formnamecontact2', '.cls_data_check_form')"
                               style="cursor:pointer" class="button"><?= $glo_lang['gui'] ?> <img
                                        src="images/loading2.gif" class="ajax_img_loading"></a>
                        </div>
                        <div class="clr"></div>
                    </form>
                </div>
            </form>
        </div>
        <div class="clr"></div>
    </div>
</div>
