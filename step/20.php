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
<div class="page_conten_page">
    <?php include _source."menu_right.php";?>
    <div class="pagewrap">
        <?php
        $dudoan_ngaysinh = DB_fet("`tenbaiviet_$lang`,`mota_$lang`,`seo_name`", "#_baiviet", "`showhi` = 1 and `p2` = 1 and step = 10", "", 1,1);
        if(!empty($dudoan_ngaysinh)){
            $dudoan_ngaysinh = reset($dudoan_ngaysinh);
            ?>
            <section class="dv-tienich">
                <ul>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="title_home align_left wow flipInX">
                                    <h2 class="tiltle" style="color: #e44b3a;"><?=$dudoan_ngaysinh['tenbaiviet_'.$lang]?></h2>
                                </div>
                                <p><?=$dudoan_ngaysinh['mota_'.$lang]?></p>
                                <p class="read-more">
                                    <a <?=full_href($dudoan_ngaysinh)?>><?=$glo_lang['xem_them']?></a>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div class="sp-pre">
                                    <div class="sp-pre1">
                                        <div class="due-date-calc-section">
                                            <?php include _source."tinh_ngay_du_sinh.php";?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </li>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </section>
        <?php } ?>
        <?php
        $datten_chobe = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 11", "", 1,1);
        if(!empty($datten_chobe)){
            $datten_chobe = reset($datten_chobe);
            ?>
            <section class="dv-tienich dv-tienich1">
                <ul>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="title_home align_left wow flipInX">
                                    <h2 class="tiltle" style="color: #f57f20;"><?=$datten_chobe['tenbaiviet_'.$lang]?></h2>
                                </div>
                                <p><?=$datten_chobe['p3_'.$lang]?></p>
                                <p class="read-more">
                                    <a <?=full_href($datten_chobe)?>><?=$glo_lang['xem_them']?></a>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div class="sp-pre">
                                    <div class="sp-pre1">
                                        <div class="due-date-calc-section">
                                            <?php include _source."dat_ten_cho_be.php";?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </li>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </section>
        <?php } ?>
        <?php
        $do_cannang = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 12", "", 1,1);
        if(!empty($do_cannang)){
            $do_cannang = reset($do_cannang);
            ?>
            <section class="dv-tienich dv-tienich2">
                <ul>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="title_home align_left wow flipInX">
                                    <h2 class="tiltle" style="color: #c80e00;"><?=$do_cannang['tenbaiviet_'.$lang]?></h2>
                                </div>
                                <p><?=$do_cannang['p3_'.$lang]?></p>
                                <p class="read-more">
                                    <a <?=full_href($do_cannang)?>><?=$glo_lang['xem_them']?></a>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php include _source."do_can_nang_va_chieu_cao.php";?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </li>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </section>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>