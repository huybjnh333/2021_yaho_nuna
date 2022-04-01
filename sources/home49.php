<?php include _source . "banner_top.php"; ?>
<?php
$banner_top = LAY_banner_new("`id_parent` = 27");
if (count($banner_top)) {
    ?>
    <div class="box_home_top" id="box_home_top">
        <!--  -->
        <?php $data = array("1", "1", "2", "2", "3", "3") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
             data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
             is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
            <?php
            foreach ($banner_top as $rows) {
                ?>
                <div class="banner_sp_home">
                    <li><img src="<?= full_src($rows, '') ?>" alt="<?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>"></li>
                    <ul>
                        <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                        <p><?= SHOW_text($rows['mota_' . $lang]) ?></p>
                        <h4><a <?= full_href($rows) ?>><?= $glo_lang['shop_now'] ?></a></h4>
                        <div class="clr"></div>
                    </ul>
                </div>
            <?php } ?>

        </div>
        <!--  -->
        <div class="clr"></div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(2, 4, "`opt` = 1");
$sp_step = LAY_step(2, 1);
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_th">
        <div class="pagewrap">
            <div class="box_more">
                <div class="title_dm">
                    <ul>
                        <h3><?= $glo_lang['san_pham_moi'] ?></h3>
                    </ul>
                </div>
                <div class="pro_home_id flex">
                    <?php
                    foreach ($sp_baiviet as $rows) {
                        // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
                        $dvt = $rows['p3'] != "" ? $rows['p3'] : $rows['dvt'];
                        $gia = GET_gia($rows['giatien'], $rows['giakm'], $dvt, $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '');
                        include _source . 'home_temp.php';
                    }
                    ?>
                    <div class="clr"></div>
                </div>
                <div class="more_pro">
                    <h3><a <?= full_href($sp_step, "?p=1") ?>><?= $glo_lang['xem_them'] ?><i
                                    class="fa fa-angle-double-down"></i></a></h3>
                </div>
            </div>

        </div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(2, 4, "`opt1` = 1");
// $sp_step      = LAY_step(2, 1);
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_th_2">
        <div class="pagewrap">
            <div class="box_more">
                <div class="title_dm">
                    <ul>
                        <h3><?= $glo_lang['san_pham_khuyen_mai'] ?></h3>
                    </ul>
                </div>
                <div class="pro_home_id flex">
                    <?php
                    foreach ($sp_baiviet as $rows) {
                        // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
                        $dvt = $rows['p3'] != "" ? $rows['p3'] : $rows['dvt'];
                        $gia = GET_gia($rows['giatien'], $rows['giakm'], $dvt, $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '');
                        include _source . 'home_temp.php';
                    }
                    ?>
                    <div class="clr"></div>
                </div>
                <div class="more_pro">
                    <h3><a <?= full_href($sp_step, "?p=2") ?>><?= $glo_lang['xem_them'] ?><i
                                    class="fa fa-angle-double-down"></i></a></h3>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$noidung = LAYTEXT_rieng(82);
if (is_array($noidung)) {

    $hinhanh = LAY_banner_new("`id_parent` = 28", 1);
    ?>
    <div class="gioithieu_home_box"
         style="background: url(<?= full_src($hinhanh, '') ?>) center center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
        <div class="pagewrap">
            <div class="gioithieu_id_box">
                <li><?= full_img($noidung, '') ?></li>
                <ul>
                    <h3><?= SHOW_text($noidung['tenbaiviet_' . $lang]) ?>
                        <span><?= SHOW_text($noidung['p1_' . $lang]) ?></span></h3>
                    <div>
                        <?= SHOW_text($noidung['noidung_' . $lang]) ?>
                    </div>
                    <h4><a <?= full_href($noidung) ?>><?= $glo_lang['xem_chi_tiet'] ?></a></h4>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(3, 18, "`opt` = 1");
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_2">
        <div class="pagewrap">
            <div class="title_page_2"><?= $glo_lang['tin_tuc_su_kien'] ?></div>
            <div class="tintuc_home_id tintuc_home_id_slider no_box">
                <!--  -->
                <?php $data = array("1", "1", "2", "3", "3", "3") ?>
                <div class="owl-auto owl-carousel owl-theme flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                     data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                     is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
                    <?php
                    foreach ($sp_baiviet as $rows) {
                        ?>
                        <div class="item">
                            <ul>
                                <li><a <?= full_href($rows) ?>><?= full_img($rows) ?></a></li>
                                <h4>
                                    <i class="fa fa-calendar"></i><?= CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>
                                    , <?= date("d/m/Y", $rows['ngaydang']) ?></h4>
                                <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                                <p><span class="lm_4"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></span></p>
                            </ul>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="clr"></div>
            <!--  -->
        </div>
    </div>
    </div>
<?php } ?>
<?php
$hinhanh = LAY_banner_new("`id_parent` = 26", 1);
?>
<div class="newsletter_home"
     style="background: url(<?= full_src($hinhanh, '') ?>) center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
    <div class="pagewrap">
        <h3><?= $glo_lang['dang_ky_nhan_ban_tin'] ?></h3>
        <p><?= $glo_lang['test_dang_ky_nhan_ban_tin'] ?></p>
        <ul class="no_box">
            <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" enctype="multipart/form-data">
                <div class="col-md-7 row-frm">
                    <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control"
                           placeholder="<?= $glo_lang['ho_va_ten'] ?>">
                </div>
                <div class="col-md-7 row-frm">
                    <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control"
                           placeholder="<?= $glo_lang['so_dien_thoai'] ?>">
                </div>
                <div class="col-md-7 row-frm">
                    <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control"
                           placeholder="<?= $glo_lang['email'] ?> *">
                </div>
                <h2><a onclick="DANGKY_email('<?= $full_url ?>')" class="cur"><?= $glo_lang['dang_ky'] ?> <img
                                src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a></h2>
                <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
                <div class="clr"></div>
            </form>
            <div class="clr"></div>
        </ul>
    </div>
</div>
