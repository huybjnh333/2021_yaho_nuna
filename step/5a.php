<?php
LOCATION_js($full_url."/".$thongtin_step['seo_name']."/");
exit();
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id_parent` = (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
//$numview = 8;
//$nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", " `step` IN (" . $slug_step . ") $wh ", " `catasort` DESC ", $numview);

// $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
// $nd_total = mysqli_num_rows($nd_total);
// $retuen_arr = array();
// while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
//   $retuen_arr[] = $r;
// }
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
// $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

// if($arr_running['icon_hover'] != "") {
//   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
// }
// full_src($thongtin_step, '')
include _source . "box-header.php";
?>
<div class="page_conten_page pagewrap">
    <div class="left_contact">
        <h3><?=$glo_lang['lien_he_ngay_voi_chung_toi']?></h3>
        <h5><?=$arr_running['tenbaiviet_'.$lang]?></h5>

    </div>
    <div class="right_contact">
        <h3>Gửi thông tin liên hệ</h3>
        <div class="contact">
            <?php _source."lien_he_form.php"; ?>
        </div>
    </div>
    <div class="contact-maps">
        <li>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15677.684748873357!2d106.690252!3d10.779018!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x312e2babd77bc83b!2zQ8O0bmcgdHkgUC5BIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1606268915324!5m2!1svi!2s"
                    width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
        </li>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

<div class="page_conten_page pagewrap">
    <div class="col-lg-4">
        <div class="address-wrapper">
            <div class="item">
                <div class="address">
                    <div class="title"><a href="javascript:void(0)"
                                          onclick="initAutocomplete(10.792123030216453, 106.67402630570179)">
                            <?=$arr_running['tenbaiviet_'.$lang]?></a></div>
                    <div class="showText">
                        <?=SHOW_text($arr_running['noidung_'.$lang])?>
                    </div>
                    <img class="lazy" <?=full_src_lazy($arr_running)?>>
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="col-lg-8">
        <div class="map" id="map">
            <iframe class="iframe_load" iframe-src="<?=$arr_running['mota_'.$lang]?>"
                    width="100%" height="525" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0">
            </iframe>
        </div>
    </div>
    <div class="clr"></div>
    <?php include _source . "fb_sharelink.php"; ?>
    <div class="clr"></div>
</div>