<?php
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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap">
    <div class="tin_left">
        <div class="title_news">
            <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
            <li><i class="fa fa-calendar"></i><?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
        </div>
        <div class="showText table_banggia">
            <?= SHOW_text($arr_running['noidung_' . $_SESSION['lang']]); ?>
        </div>
        <!--  -->
        <?php include _source . "fb_sharelink.php"; ?>
        <div class="dv-fb_coment">
            <?php include _source . "fb_coment.php"; ?>
        </div>
        <div class="clr"></div>
        <?php if(!empty($bvlienquan)){ ?>
        <div class="box_page">
            <div class="title_page">
                <ul><h3 class="h_title"><?=$glo_lang['tin_lien_quan']?></h3>
                </ul>
            </div>
            <ul class="tin-add">
                <?php foreach ($bvlienquan as $rows){ ?>
                <p><a <?=full_href($rows)?> target="_blank" rel="noopener">- <?=$rows['tenbaiviet_'.$lang]?></a></p>
                <?php } ?>
            </ul>
            <div class="clr"></div>
        </div>
        <?php } ?>
    </div>
    <?php include _source . "tin_right_1.php"; ?>
</div>