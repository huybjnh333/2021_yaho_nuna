<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 6;
else $numview = $thongtin_step['num_view'];


$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = $motty == 'search' ? true : false;
$wh = "";
$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $slug_step = 4;
    $name_titile = $glo_lang['tim_kiem'];
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = $slug_step LIMIT 1");
    $thongtin_step = mysqli_fetch_assoc($thongtin_step);
    $motty_phantrang = $motty;
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
} else {
    $motty_phantrang = $thongtin_step['seo_name'];
}
if ($lay_all_kx != "") {
    $wh .= "  AND (FIND_IN_SET('" . $arr_running['id'] . "', `id_parent_muti`) OR (`id_parent` in (" . $lay_all_kx . "))) ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_" . $lang . "` LIKE '%" . $key . "%' )";
}

//
//if ($motty != "search") {
//    $sp_baiviet = LAY_baiviet($slug_step, 6, "`opt` = 1");
//    $arr_bv = array();
//    foreach ($sp_baiviet as $rows) {
//        array_push($arr_bv, $rows['id']);
//    }
//    $arr_bv = implode(",", $arr_bv);
//    if (!empty($arr_bv)) {
//        $wh .= " AND `id` NOT IN (" . $arr_bv . ") ";
//    }
//} else {
//    $numview = 15;
//}
include _source . "phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search) {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
}
include _source . "box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page">
    <?php include _source . "menu_right.php"; ?>
    <div class="pagewrap">
        <div class="tin_left">
            <div class="title_news">
                <h2><?= $thongtin_step['tenbaiviet_' . $lang] ?></h2>
            </div>
            <div class="showText">
                <?= $thongtin_step['noidung_' . $lang] ?>
                <div class="clr"></div>
            </div>
            <?php include _source."do_can_nang_va_chieu_cao.php";?>
            <div class="clr"></div>
            <?php include _source . "fb_sharelink.php"; ?>
            <?php
                $banner = LAY_banner_new("`id_parent` = 42",1);
                if(!empty($banner)){
            ?>
            <div class="v2-tipsadv-promopod visible-lg visible-md">
                <a <?=full_href($banner)?>>
                    <img src="<?=full_src($banner,"")?>" class="img-responsive"
                         alt="<?=$banner['tenbaiviet_'.$lang]?>">
                </a>
            </div>
            <?php } ?>
        </div>
        <?php include _source . "tin_right.php"; ?>
    </div>
    <div class="clr"></div>
</div>