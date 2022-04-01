<?php
LOCATION_js($full_url."/".$thongtin_step['seo_name']);
exit();
// Update Luot view
// DB_que("UPDATE `#_baiviet` SET `soluotxem` = `soluotxem` + 1 WHERE `id` = '".$arr_running['id']."' LIMIT 1");
// Update Luot view

$kietxuat_name = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "arr", 1);
if (empty($kietxuat_name))
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
else
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id` <>  '" . $arr_running['id'] . "'";
// $wh           = "  AND `id_parent` in (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
$numview = 12;

$nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $slug_step . ") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
// $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
// $nd_total = mysqli_num_rows($nd_total);
// $retuen_arr = array();
// while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
//   $retuen_arr[] = $r;
// }
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
$img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

if ($arr_running['icon_hover'] != "") {
    $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
}
// full_src($thongtin_step, '')
include _source."box-header.php";
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "", "10", 1);

?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap">
    <ul class="list-unstyled">
        <li><a <?=full_href($thongtin_step)?>><i class="fa fa-backward" aria-hidden="true"></i> <?=$glo_lang['quay_lai']?></a></li>
    </ul>
    <div class="title_news">
        <h2><?=$arr_running['tenbaiviet_'.$lang]?></h2>
    </div>
    <div class="showText">
        <?=SHOW_text($arr_running['noidung_'.$lang])?>
        <div class="clr"></div>
    </div>
    <?php
    include _source . "fb_sharelink.php"; ?>
    <div class="dv-fb_coment">
        <?php include _source . "fb_comment.php"; ?>
    </div>
    <div class="box_page">
        <div class="title_page">
            <ul><h3 class="h_title"><?=$glo_lang['cac_cau_hoi_khac']?></h3>
            </ul>
        </div>
        <ul class="list-question">
            <?php
            foreach ($bvlienquan as $rows) {
            ?>
            <li>
                <a <?=full_href($rows)?>><i class="fa fa-angle-right"></i> <?=$rows['tenbaiviet_'.$lang]?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="clr"></div>
</div>
<?php include _source."banner_duoi.php";?>