<?php include _source . "banner_top.php"; ?>
<?php $ndkhac = LAYTEXT_rieng(82); ?>
<section class="dv-home-gioithieu">
    <div class="pagewrap">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <?php if (!empty($ndkhac['icon'])) { ?>
                    <img src="<?= full_src($ndkhac, "") ?>" alt="<?= $ndkhac['tenbaiviet_' . $lang] ?>">
                <?php } ?>
            </div>
            <div class="col-lg-6 sp-pre1">
                <div class="title_home align_left wow flipInX">
                    <h4><?= $ndkhac['p1_' . $lang] ?></h4>
                    <h2 class="tiltle"><?= $ndkhac['tenbaiviet_' . $lang] ?></h2>
                </div>
                <div class="showText"><?= $ndkhac['noidung_' . $lang] ?></div>
                <p class="read-more">
                    <a <?= full_href($ndkhac) ?>><?= $glo_lang['xem_them'] ?></a>
                </p>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</section>
<?php
$banner_sphome = LAY_banner_new("`id_parent` = 26");
if (!empty($banner_sphome)) {
    foreach ($banner_sphome as $rows){
?>
<section class="dv-home-sanpham">
    <div class="pagewrap">
        <div class="col-lg-12 flex">
            <div class="col-lg-6">
                <div class="title_home align_left wow flipInX">
                    <h2 class="tiltle"><?=$rows['tenbaiviet_'.$lang]?></h2>
                </div>
                <div class="showText"><?=SHOW_text($rows['noidung_'.$lang])?></div>
                <p class="read-more">
                    <a <?=full_href($rows)?> target="<?=$rows['blank']?>"><?=$glo_lang['xem_them']?></a>
                </p>
            </div>
            <div class="col-lg-6">
                <img <?=full_src_lazy($rows,"")?> class="lazy">
            </div>
        </div>
    </div>
    <div class="clr"></div>
</section>
<?php }} ?>
<?php
$sp_banchay = LAY_baiviet(2,6,"`opt2` = 1");
if(!empty($sp_banchay)){
?>
<div class="box_page" style="margin-top: 60px">
    <div class="pagewrap">
        <div class="title_page">
            <ul><h3 class="h_title"><?=$glo_lang['san_pham_ban_chay']?></h3>
            </ul>
        </div>
        <?php $data = array("2", "2", "2", "3", "3", "3") ?>
        <div class="pro_home_id pro_id owl-carousel owl-theme owl-custome owl-auto" id="pro_slide"
             data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
             data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
             is_slidespeed="1000" is_navigation="1" is_dots="0" is_autoplay="0">
            <?php foreach ($sp_banchay as $rows){ ?>
                <ul>
                    <li><a <?=full_href($rows)?>><img class="lazy" <?=full_src_lazy($rows)?>/></a></li>
                    <h3><a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a></h3>
                </ul>
            <?php } ?>
        </div>
        <div class="clr"></div>
    </div>
</div>
<?php } ?>
<section class="dv-home-tienich">
    <div class="title_page">
        <ul><h3 class="h_title"><?=$glo_lang['tien_ich_thong_minh']?></h3>
        </ul>
    </div>
    <ul>
        <li>
            <?php $banner_ddns = DB_que("SELECT * FROM `#_step` WHERE `id` = 10 LIMIT 1");
            $banner_ddns = mysqli_fetch_assoc($banner_ddns); ?>
            <img <?=full_src_lazy($banner_ddns,"","icon_hover")?> class="lazy">
            <div class="sp-pre">
                <div class="sp-pre1">
                    <div class="due-date-calc-section">
                        <div class="calc-header">
                            <div class="topIconImage">
                                <img src="delete/tienich/ic-1.svg" alt="<?=$glo_lang['du_doan_ngay_sinh']?>">
                            </div>
                            <h2 class="due-calc-heading"><?=$glo_lang['du_doan_ngay_sinh']?></h2>
                        </div>
                        <?php include _source."tinh_ngay_du_sinh.php";?>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </li>
        <div class="clr"></div>
    </ul>
    <div class="clr"></div>
</section>
<section class="dv-home-tienich dv-home-tienich1">
    <ul>
        <li>
            <?php $banner_dtcb = DB_que("SELECT * FROM `#_step` WHERE `id` = 11 LIMIT 1");
            $banner_dtcb = mysqli_fetch_assoc($banner_dtcb) ?>
            <img <?=full_src_lazy($banner_dtcb,"","icon_hover")?> class="lazy">
            <div class="sp-pre">
                <div class="sp-pre1">
                    <div class="due-date-calc-section">
                        <div class="calc-header color_vang">
                            <div class="topIconImage">
                                <img src="delete/tienich/ic-2.svg" alt="<?=$glo_lang['dat_ten_cho_be']?>">
                            </div>
                            <h2 class="due-calc-heading"><?=$glo_lang['dat_ten_cho_be']?></h2>
                        </div>

                        <?php include _source."dat_ten_cho_be.php";?>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </li>
        <div class="clr"></div>
    </ul>
    <div class="clr"></div>
</section>
<article class="bmi-advice">
    <div class="bmi-advice__input-board js-bmi-input-board pagewrap">
        <div class="title_home align_center wow flipInX">
            <h4><?=$glo_lang['be_dang_co_nguy_co_thua_can']?></h4>
            <h2 class="tiltle"><?=$glo_lang['kiem_tra_bmi']?></h2>
        </div>
        <div class="bmi-advice_content flex">
            <div class="bmi-advice__input-board__left">
                <div class="bmi-advice__graph">
                    <?php $banner_dcncc = DB_que("SELECT * FROM `#_step` WHERE `id` = 12 LIMIT 1");
                    $banner_dcncc = mysqli_fetch_assoc($banner_dcncc) ?>
                    <img src="<?=full_src($banner_dcncc,"","icon_hover")?>" alt="<?=$banner_dcncc['tenbaiviet_'.$lang]?>">
                </div>
            </div>
            <div class="bmi-advice__input-board__center">
                <div class="bmi-advice__arrow">
                    <img src="images/bmi-arrow.png">
                </div>
            </div>
            <?php include _source."do_can_nang_va_chieu_cao.php";?>
        </div>
    </div>

</article>
