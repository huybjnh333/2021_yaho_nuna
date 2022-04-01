<?php
// Update Luot view
 DB_que("UPDATE `#_baiviet` SET `soluotxem` = `soluotxem` + 1 WHERE `id` = '".$arr_running['id']."' LIMIT 1");
// Update Luot views
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id_parent` = (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
$numview = 8;

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
include _source."box-header.php";
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent IN(" . $lay_all_kx . ") and step=" . $slug_step, "RAND()", "12", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap">
    <div class="viewLeft">
        <div id="pro_img_main">
            <div id="bridal_images">
                <img src="<?=full_src($arr_running)?>" alt="<?=$arr_running['tenbaiviet_'.$lang]?>">
            </div>
        </div>
    </div>
    <!--end viewLeft-->
    <div class="viewRight">
        <div class="viewRight_more">
            <div class="titleView"><?=$arr_running['tenbaiviet_'.$lang]?></div>
            <div class="showText"><?=$arr_running['mota_'.$lang]?></div>
            <?php include _source."tags.php"; ?>
            <div class="clr"></div>
            <div class="ct_add">
                <ul>
                    <h3><a onclick="LOAD_popup_new('<?=$full_url . "/pa-size-child/form-tu-van/" ?>', '550px')" class="cur clor_01 preview fancybox.ajax"><?=$glo_lang['tu_van_bao_gia']?></a></h3>
                    <div class="clr"></div>
                </ul>
            </div>
            <?php include _source . "fb_sharelink.php"; ?>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
    <div class="detail-sp">
        <h5><?=$glo_lang['mo_ta_chi_tiet']?></h5>
        <div id="ftwp-postcontent" class="showText">
            <?=$arr_running['noidung_'.$lang]?>
        </div>
    </div>
    <?php include _source."fb_coment.php"; ?>
    <?php if(!empty($bvlienquan)){ ?>
    <div class="box_page">
        <div class="title_page">
            <ul><h3 class="h_title"><?=$glo_lang['dich_vu_lien_quan']?></h3>
            </ul>
        </div>
        <?php $data = array("2", "2", "2", "3", "3", "3") ?>
        <div class="owl-auto owl-carousel owl-theme owl-custome flex" id="dichvu_slide" data0="<?= $data[0] ?>"
             data1="<?= $data[1] ?>" data2="<?= $data[2] ?>" data3="<?= $data[3] ?>"
             data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
             is_autoplay="1">
            <?php foreach ($bvlienquan as $rows) { ?>
            <div class="col-lg-4">
                <div class="scale_hover_img lazyload">
                    <div class="scale_hover">
                        <a <?=full_href($rows)?>><img src="<?=full_src($rows)?>"></a>
                    </div>
                    <div class="info">
                        <h3>
                            <a <?=full_href($rows)?> title="<?=$arr_running['tenbaiviet_'.$lang]?>">
                                <?=$arr_running['tenbaiviet_'.$lang]?>
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="clr"></div>
</div>