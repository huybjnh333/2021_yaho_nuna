<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id_parent` = (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
$numview = 8;

$nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", " `step` IN (" . $slug_step . ") $wh ", " `catasort` DESC ", $numview);

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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "12", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="pagewrap page_conten_page">
    <div class="tin_left tin_left_1column">
        <div class="title_news">
            <h3><?= SHOW_text($arr_running['tenbaiviet_' . $lang]); ?></h3>
            <h4><i class="fa fa-calendar"></i><?=fullDate($arr_running['ngaydang'],$glo_lang)?></h4>
        </div>
        <div class="showText">
            <?=SHOW_text($arr_running['noidung_'.$lang])?>
        </div>
        <?php include _source . "fb_sharelink.php"; ?>
        <div class="titile_page" style="padding-top:20px;">
            <ul>
                <h3><?=$glo_lang['bai_viet_lien_quan']?></h3>
                <div class="clr"></div>
            </ul>
        </div>
        <?php $data = array("1", "2", "2", "3", "3", "3") ?>
        <div class="owl-auto owl-carousel owl-theme owl-custome flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
             data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
             is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
            <?php foreach ($bvlienquan as $rows) {?>
                <div class="item">
                    <div class="new_id_bs slider">
                        <li><a <?= full_href($rows) ?>><?= full_img($rows) ?></a></li>
                        <ul>
                            <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a><span><i
                                            class="fa fa-calendar"></i><?= fullDate($rows['ngaydang'], $glo_lang) ?></span>
                            </h3>
                            <p class="limit-row-3"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
                        </ul>
                        <div class="clr"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="clr"></div>
    </div>
</div>
