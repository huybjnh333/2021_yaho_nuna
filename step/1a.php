<?php
if ($motty == "404") {
    $nd_404 = DB_fet_rd("*", "`#_seo_name` ", " `id` = 1 ", "", 1);
    $arr_running = reset($nd_404);
    // $bre 				= SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]);
}

$bre = SHOW_text($arr_running['tenbaiviet_' . $lang]);
if (empty($thongtin_step)) {
    $thongtin_step['id'] = 1;
} else {
    $bre = '<a href="' . GET_link($full_url, SHOW_text($thongtin_step['seo_name'])) . '">' . $thongtin_step['tenbaiviet_' . $lang] . '</a>';
}
$thongtin_step = LAY_anhstep_now($thongtin_step['id']);

// $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

// if($arr_running['icon_hover'] != "") {
//   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
// }
// full_src($thongtin_step, '')
$list_hinhcon = LAY_hinhanhcon($arr_running['id'], 50);
include _source . "box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><span><i class="fa fa-angle-right"></i></span><a <?= full_href($arr_running) ?>><?= $arr_running['tenbaiviet_' . $lang] ?></a></li> -->
<?php if ($motty != "404") {
    LOCATION_js($full_url."/".$thongtin_step['seo_name']);
    exit;
    ?>
    <div class="page_conten_page pagewrap">
        <div class="tin_left_nd tin_left_2column">
            <div class="title_news">
                <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
                <li><i class="fa fa-calendar"></i><?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
            </div>
            <div class="showText">
                <?php
                $nd = SHOW_text($arr_running['noidung_' . $_SESSION['lang']]);
                if ($motty == "404") {
                    $nd = str_replace('[tencongty]', $thongtin['tenbaiviet_' . $lang], $nd);
                }
                echo $nd;
                ?>
            </div>

            <?php
            include _source."tags.php";
            include _source . "fb_sharelink.php";
            ?>
            <div class="dv-fb_coment">
                <?php include _source . "fb_coment.php"; ?>
            </div>
        </div>
        <?php include _source . "tin_right.php"; ?>
        <div class="clr"></div>
    </div>
<?php } else {
    include _source . "404.php";
} ?>
