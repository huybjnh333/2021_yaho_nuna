<?php include _source . "banner_top.php" ?>

<?php
$rows_toado = LAY_banner_new("`id_parent` = 28");
if (count($rows_toado)) {
    ?>
    <div class="box_home_1">
        <div class="pagewrap">
            <div class="title_home">
                <ul>
                    <h3><?= $glo_lang['tong_hop_sp_vay'] ?></h3>
                    <p><?= $glo_lang['tong_hop_sp_vay_mt'] ?></p>
                </ul>
            </div>
            <div class="servicess_1 flex">
                <?php
                foreach ($rows_toado as $rows) {
                    ?>
                    <ul>
                        <li><?= full_img($rows) ?></li>
                        <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                        <p><?= SHOW_text($rows['mota_' . $lang]) ?></p>
                    </ul>
                <?php } ?>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(3, 9, "`opt` = 1");
// $sp_step      = LAY_step(3, 1);
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_2">
        <div class="pagewrap">
            <div class="title_home">
                <ul>
                    <h3><?= $glo_lang['chuong_tri_vay_noi_bat'] ?></h3>
                    <p><?= $glo_lang['chuong_tri_vay_noi_bat_mota'] ?></p>
                </ul>
            </div>
            <div class="servicess_2 flex">
                <?php
                foreach ($sp_baiviet as $rows) {
                    ?>
                    <ul>
                        <a <?= full_href($rows) ?>>
                            <li><?= full_img($rows) ?></li>
                            <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                            <p><span class="lm_4"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></span></p>
                        </a>
                    </ul>
                <?php } ?>

                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(4, 9, "`opt` = 1");
// $sp_step      = LAY_step(3, 1);
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_1">
        <div class="pagewrap">
            <div class="title_home">
                <ul>
                    <h3><?= $glo_lang['ho_tro_cho_vay_tien_trong_ngay'] ?></h3>
                    <p><?= $glo_lang['ho_tro_cho_vay_tien_trong_ngay_mo_ta'] ?></p>
                </ul>
            </div>
            <div class="servicess_2 flex">
                <?php
                foreach ($sp_baiviet as $rows) {
                    ?>
                    <ul>
                        <a <?= full_href($rows) ?>>
                            <li><?= full_img($rows) ?></li>
                            <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                            <p><span class="lm_4"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></span></p>
                        </a>
                    </ul>
                <?php } ?>

                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$sp_baiviet = LAY_baiviet(7, 18, "`opt` = 1");
// $sp_step      = LAY_step(3, 1);
if (count($sp_baiviet)) {
    ?>
    <div class="box_home_2">
        <div class="pagewrap">
            <div class="title_home">
                <ul>
                    <h3><?= $glo_lang['tin_tuc_su_kien'] ?></h3>
                    <p><?= $glo_lang['tin_tuc_su_kien_mo_ta'] ?></p>
                </ul>
            </div>
            <div class="tintuc_home_id tintuc_home_id_slider no_box">
                <!--  -->
                <?php $data = array("1", "1", "2", "2", "3", "3") ?>
                <div class="owl-auto owl-carousel owl-theme flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                     data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                     is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
                    <?php
                    foreach ($sp_baiviet as $rows) {
                        ?>
                        <div class="item">
                            <ul>
                                <li><a <?= full_href($rows) ?>><img src="<?= full_src($rows) ?>"
                                                                    alt="<?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>"/></a>
                                </li>
                                <h4>
                                    <i class="fa fa-calendar"></i><?= CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>
                                    , <?= date("d/m/Y", $rows['ngaydang']) ?></h4>
                                <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                                <p><span class="lm_4"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></span></p>
                            </ul>

                        </div>
                    <?php } ?>

                </div>
                <div class="clr"></div>
                <!--  -->
            </div>
        </div>
    </div>
<?php } ?>
    <div class="newsletter_home">
        <div class="pagewrap">
            <ul class="no_box">
                <h3><?= $glo_lang['dang_ky_nhan_ban_tin'] ?></h3>
                <p><?= $glo_lang['test_dang_ky_nhan_ban_tin'] ?></p>

                <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin"
                      enctype="multipart/form-data">
                    <div class="col-md row-frm">
                        <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control"
                               placeholder="<?= $glo_lang['ho_va_ten'] ?>">
                    </div>
                    <div class="col-md row-frm">
                        <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control"
                               placeholder="<?= $glo_lang['so_dien_thoai'] ?>">
                    </div>
                    <div class="col-md row-frm">
                        <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control"
                               placeholder="<?= $glo_lang['email'] ?> *">
                    </div>
                    <h4><a onclick="DANGKY_email('<?= $full_url ?>')" class="cur"><?= $glo_lang['dang_ky_ngay'] ?> <img
                                    src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a></h4>
                    <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
                    <div class="clr"></div>
                </form>
            </ul>
        </div>
    </div>
<?php
$banner_top = LAY_banner_new("`id_parent` = 29");
if (count($banner_top)) {
    ?>
    <div class="box_doitac_home">
        <div class="pagewrap">
            <div class="logo_doitac">
                <!--  -->
                <?php $data = array("2", "3", "4", "5", "6", "7") ?>
                <div class="owl-auto owl-carousel owl-theme flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                     data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                     is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
                    <?php
                    // $i = 0;
                    foreach ($banner_top as $rows) {
                        // $i++;
                        // if($i == 1) echo '<div class="item">';
                        ?>
                        <div class="item">
                            <ul>
                                <a <?= full_href($rows) ?>>
                                    <li class="logo_thuonghieu"><img src="<?= full_src($rows, '') ?>"></li>
                                </a>
                            </ul>
                        </div>
                    <?php } // if($i == 2) { echo '</div>'; $i = 0;} } if($i == 1)  echo '</div>'; ?>

                </div>
                <div class="clr"></div>
                <!--  -->
            </div>
        </div>
    </div>
<?php } ?>