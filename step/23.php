<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 10;
else $numview = $thongtin_step['num_view'];


$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$ten = isset($_GET['ten']) ? str_replace("+", " ", strip_tags($_GET['ten'])) : '';
$ynghia = isset($_GET['ynghia']) ? str_replace("+", " ", strip_tags($_GET['ynghia'])) : '';
$hide = isset($_GET['hide']) ? addslashes($_GET['hide']) : '';

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

if (isset($ten) || isset($ynghia)) {
    if(!empty($ten)) $check = 1;
    else $check = 2;

    $wh1 = "(`tenbaiviet_" . $lang . "` = '" . $ten . "' )";
    if (!empty($ynghia)) {
        $wh1 = "(`mota_" . $lang . "` LIKE '%" . $ynghia . "%' )";
    }

    $gioitinh = isset($_GET['gioitinh']) ? addslashes($_GET['gioitinh']) : 0;
    $wh2 = "";
    if ($gioitinh == 2) {
        $wh2 .= " AND `gioitinh` = 2";
        $class_gt = "trungtinh";
        $icon_gt = "3";
    } else if ($gioitinh == 1) {
        $wh2 .= " AND `gioitinh` = 1";
        $class_gt = "";
        $icon_gt = "2";
    } else {
        $wh2 .= " AND `gioitinh` = 0";
        $class_gt = "nam";
        $icon_gt = "1";
    }
    $check_dm = LAY_danhmuc($slug_step, 1, "$wh1 $wh2");
}
if(!empty($hide)){
    if(isset($_GET['phobien'])){
        $wh .= " AND `opt1` = 1";
        $title_khac = $glo_lang['danh_sach_pho_bien_theo_nam'];
    }
    $alphabet = isset($_GET['alphabet']) ? addslashes($_GET['alphabet']) : '';
    if(!empty($alphabet)){
        $wh .= " AND `tenbaiviet_" . $lang . "` LIKE '" . strtolower($alphabet) . "%'";
        $title_khac = $glo_lang['danh_sach_ten_theo_alphabet']." : ".$alphabet;
        $catasort = "`tenbaiviet_$lang` ASC";
    }
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
        <?php if(empty($hide)){ ?>
        <div class="tin_left">
            <div class="title_news">
                <h2><?= $glo_lang['cong_cu_dat_ten_cho_be'] ?></h2>
            </div>
            <div class="showText">
                <div class="static-page-content ">
                    <?= SHOW_text($thongtin_step['noidung_' . $lang]) ?>
                </div>
                <div class="sp-pre" style="position: relative; width: 100%;">
                    <div class="sp-pre1" style="width: 100%;">
                        <div class="due-date-calc-section">
                            <?php include _source."dat_ten_cho_be.php";?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <?php
            if ($check != 2) {
                if (!empty($check_dm)) {
                    $check_dm = reset($check_dm);
                    ?>
                    <div class="showText showText_add">
                        <div class="resultInfo babynameFav">
                            <div class="col-eq flex">
                                <div class="lftblk">
                                    <img src="delete/tienich/hi.svg" class="hi">
                                    <label><?=$glo_lang['ten_toi_la']?>:</label> <span
                                            class="<?= $class_gt ?>"><?= $check_dm['tenbaiviet_' . $lang] ?></span>
                                    <div class="clearfix"></div>
                                    <label><?= $glo_lang['gioi_tinh'] ?>:</label>
                                    <img src="delete/tienich/icon<?= $icon_gt ?>.png">
                                    <div class="clearfix"></div>
                                </div>
                                <p class="rgtblk"><?= strip_tags($check_dm['mota_' . $lang]) ?></p>
                            </div>
                        </div>
                    </div>
                <?php } else {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } ?>
            <?php } ?>
            <div class="clr"></div>
            <?php include _source . "fb_sharelink.php"; ?>
            <?php
            if (!empty($check_dm)) {
                $numview = 99;
                $pzer = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
                $vi_tri = PHANTRANG_start($pzer, $numview);
                if ($pzer == 1 || $pzer == NULL)
                    $pzz = 0;
                else $pzz = $pzer * $numview;

                if ($check == 1) $wh .= " AND `id_parent` = " . $check_dm['id'] . " ";
                else $wh .= " AND (`mota_" . $lang . "` LIKE '%" . $ynghia . "%' ) ";
                $limit_new = str_replace(",", ".", "$vi_tri,$numview");
                $nd_kietxuat = DB_fet_rd("*", "`#_baiviet`", " `step` IN (" . $slug_step . ") $wh $wh2", " $catasort  ", $limit_new, "id");
                $nd_total = DB_num_rd("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $slug_step . ") $wh $wh2", "#_baiviet");
                $numshow = ceil($nd_total / $numview);
                $sotrang = PHANTRANG_findPages($nd_total, $numview);
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    ?>
                    <div class="resultTable babynameFav">
                        <h3><?= $glo_lang['cac_ten_gan_giong'] ?></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="20%"><?= $glo_lang['ten'] ?></th>
                                <th width="20%"><?= $glo_lang['gioi_tinh'] ?></th>
                                <th width="60%"><?= $glo_lang['y_nghia'] ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($nd_kietxuat as $rows) { ?>
                                <tr>
                                    <td class="<?= $class_gt ?>"><?= $rows['tenbaiviet_' . $lang] ?></td>
                                    <td><img src="delete/tienich/icon<?= $icon_gt ?>.png"></td>
                                    <td><?= strip_tags($rows['mota_' . $lang]) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="clr"></div>
                        <div class="nums no_box">
                            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="graypod_cont">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contlist">
                            <h3><?=$glo_lang['ten_theo_tinh_cach_duoc_yeu_thich']?></h3>
                            <?php
                            $tenyeuthich = LAY_baiviet($slug_step,6,"`opt2` = 1");
                            foreach ($tenyeuthich as $rows){
                                $icon_gt = '<img src="delete/tienich/icon1.png">';$class_gt = "nam";
                                if ($rows['gioitinh'] == 1){ $icon_gt = '<img src="delete/tienich/icon2.png">';$class_gt = "";}
                                else if ($rows['gioitinh'] == 2){ $icon_gt = '<img src="delete/tienich/icon3.png">';$class_gt = "trungtinh";}
                                else if ($rows['gioitinh'] == 3){ $icon_gt = '<img src="delete/tienich/icon1.png"><img src="delete/tienich/icon2.png">';$class_gt = "nam";}
                            ?>
                            <ul>
                                <li class="<?=$class_gt?> flex">
                                    <div class="icon_gt">
                                    <?=$icon_gt?>
                                    </div>
                                    <a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a>
                                </li>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contlist">
                            <h3><?=$glo_lang['ten_be_trai_duoc_yeu_thich']?></h3>
                            <?php
                                $tenbetrai = LAY_baiviet($slug_step,6,"`opt2` = 1 AND `gioitinh` = 0 || `gioitinh` = 3");
                            foreach ($tenbetrai as $rows){
                                ?>
                            <ul>
                                <li class="nam">
                                    <span class="ball-icon1"></span>
                                    <a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a>
                                </li>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contlist">
                            <h3><?=$glo_lang['ten_be_gai_duoc_yeu_thich']?></h3>
                            <?php
                            $tenbegai = LAY_baiviet($slug_step,6,"`opt2` = 1 AND `gioitinh` = 1 || `gioitinh` = 3");
                            foreach ($tenbegai as $rows){
                            ?>
                            <ul>
                                <li class="nu">
                                    <span class="ball-icon2"></span>
                                    <a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a>
                                </li>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php }else{ include _source . "timkhac.php"; } ?>
        <?php include _source . "tin_right.php"; ?>
    </div>
    <div class="clr"></div>
</div>
