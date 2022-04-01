<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 10;
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
    <?php include _source."menu_right.php";?>
    <div class="pagewrap">
        <div class="tin_left">
            <div class="tt_page_top tt_ngaysinh">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    foreach ($nd_kietxuat as $rows) {
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item">
                                <div class="img-box">
                                    <a <?=full_href($rows)?> class="open-post">
                                        <img class="img-fluid lazy" <?=full_src_lazy($rows)?>>
                                    </a>
                                </div>
                                <div class="text-box">
                                    <a <?=full_href($rows)?> class="title-blog">
                                        <h5 class="lm_2"><?=$rows['tenbaiviet_'.$lang]?></h5>
                                    </a>
                                    <p class="lm_4"><?=strip_tags($rows['mota_'.$lang])?></p>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div>
            <div class="clr"></div>
        </div>
        <?php include _source."tin_right.php";?>
    </div>
    <div class="clr"></div>
</div>