<?php
//LOCATION_js($full_url . "/" . $thongtin_step['seo_name'] . "/");
//exit();
?>
<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id_parent` in (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
$numview = 6;

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
include _source."box-header.php";
?>
<div class="page_conten_page pagewrap">
    <div class="tin_left_nd tin_left_2column">
        <div class="title_news">
            <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
            <li><i class="fa fa-calendar"></i><?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
        </div>
        <div class="showText">
            <div class="partner-l"><img src="<?=full_src($arr_running)?>"></div>
            <div class="partner-r">
                <?=$arr_running['noidung_'.$lang]?>
            </div>
        </div>
        <?php include _source . "fb_sharelink.php"; ?>
        <div class="dv-fb_coment">
            <?php include _source . "fb_coment.php"; ?>
        </div>
    </div>
    <?php include _source."tin_right.php"; ?>
    <div class="clr"></div>
</div>