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
    $slug_step = "2,3";
    $name_titile = $glo_lang['tim_kiem'];
    // $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '6' LIMIT 1");
    // $thongtin_step = mysqli_fetch_assoc($thongtin_step);
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
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
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
}
include _source . "box-header.php";
?>
<div class="page_conten_page">
    <?php include _source . "menu_right.php"; ?>
    <?php
    if ($nd_total == 0) {
        echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
    } else {
        foreach ($nd_kietxuat as $rows) {
            if ($rows['p2'] == 1) {
                ?>
                <div class="our_servise">
                    <div class="pagewrap">
                        <div class="title title-gioithieu align_center">
                            <h2><?= $rows['tenbaiviet_' . $lang] ?></h2>
                            <h3><?= $rows['mota_' . $lang] ?></h3>
                        </div>
                        <div class="home-quality__main hidden-xs">
                            <img src="delete/gioithieu/quality-line.png" alt="Quality line">
                            <div class="home-quality__list flex">
                                <div class="home-quality__item -center showText">
                                    <?= SHOW_text($rows['noidung_' . $lang]) ?>
                                </div>
                                <?php
                                $bv_con = LAY_baiviet_chitiet($rows['id'], "`catasort` ASC, `id` ASC", 6);
                                $i = 0;
                                foreach ($bv_con as $r) {
                                    $i++;
                                    ?>
                                    <div class="home-quality home-quality__item -item-<?= $i ?>">
                                        <figure>
                                            <img src="<?= full_src($r, "") ?>" alt="<?= $r['tenbaiviet_' . $lang] ?>">
                                            <figcaption>
                                                <?= $r['tenbaiviet_' . $lang] ?>
                                            </figcaption>
                                        </figure>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
            <?php } else if ($rows['p2'] == 2) { ?>
                <section class="dv-about-1">
                    <div class="pagewrap">
                        <div class="title title-gioithieu align_center">
                            <h2><?= $rows['tenbaiviet_' . $lang] ?></h2>
                            <p><?= $rows['mota_' . $lang] ?></p>
                        </div>
                        <div class="col-lg-12">
                        <?php
                        $bv_con = LAY_baiviet_chitiet($rows['id'], "`catasort` ASC, `id` ASC");
                        foreach ($bv_con as $r) {
                            ?>
                            <div class="col-lg-3">
                                <img src="<?= full_src($r,"") ?>" alt="<?= $r['tenbaiviet_' . $lang] ?>">
                                <p><?= $r['tenbaiviet_' . $lang] ?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="clr"></div>
                    </div>
                </section>
            <?php } else if ($rows['p2'] == 3) { ?>
                <section class="dv-about-2">
                    <div class="pagewrap">
                        <div class="col-lg-12 flex">
                            <div class="col-lg-6">
                                <img <?=full_src_lazy($rows)?> class="lazy">
                            </div>
                            <div class="col-lg-6">
                                <div class="title title-gioithieu">
                                    <h2><span><?=$rows['mota_'.$lang]?></span><br>
                                        <?= $rows['tenbaiviet_' . $lang] ?></h2>
                                    <div class="showText">
                                        <?= SHOW_text($rows['noidung_' . $lang]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 flex">
                                    <?php
                                    $bv_con = LAY_baiviet_chitiet($rows['id'], "`catasort` ASC, `id` ASC");
                                    foreach ($bv_con as $r) {
                                        ?>
                                    <div class="col-lg-6">
                                        <div class="icon-box">
                                            <aside class="icon-box__img">
                                                <figure><img <?=full_src_lazy($r)?> class="lazy"></figure>
                                            </aside>
                                            <div class="icon-box__content">
                                                <p><?= $r['tenbaiviet_' . $lang] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </section>
            <?php } ?>
        <?php }
    } ?>
</div>