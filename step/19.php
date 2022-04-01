<?php

if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 99;
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
//if($slug_table == "step"){
//     include _source."phantrang_danhmuc.php";
//}else{
include _source . "phantrang_kietxuat.php";
//}
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search) {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
}
include _source . "box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<?php
$diembansp = LAY_step(9, 1);
?>
<div class="page_conten_page pagewrap">
    <?php include _source."menu_right.php"; ?>
    <section class="dv-diemban">
        <div class="title_home align_center wow flipInX">
            <h2 class="tiltle"><?= $diembansp['tenbaiviet_' . $lang] ?></h2>
        </div>
        <div class="diadiem_more">
            <div class="flex" style="margin: 0 -10px;">
                <?php
                $danhmuc_diembansp = LAY_danhmuc(9);
                foreach ($danhmuc_diembansp as $r) {
                    $baiviet = LAY_baiviet(9, "", "`id_parent` = " . $r['id']);
                    ?>
                    <ul class="diemban">
                        <li>
                            <div class="dv-mota-show">
                                <div>
                                    <?php if (!empty($baiviet)) {
                                        foreach ($baiviet as $rows) {
                                            ?>
                                            <p style="text-align:center">
                                                <a <?= full_href($rows) ?>>
                                                    <img alt="<?= $rows['tenbaiviet_' . $lang] ?>"
                                                         src="<?= full_src($rows, "") ?>">
                                                </a>
                                            </p>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </li>
                        <h3><?= $r['tenbaiviet_' . $lang] ?><span><?= strip_tags($r['mota_' . $lang]) ?></span></h3>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </section>
    <div class="clr"></div>
    <?php
    $anh_diemban = LAY_banner_new("`id_parent` = 25");
    if (!empty($anh_diemban)) {
        ?>
        <div class="dv-home-doitac dv-home-diemban" style="padding: 40px 0 0px;">
            <div class="pagewrap">
                <div class="logo_doitac logo_doitac flex">
                    <?php foreach ($anh_diemban as $rows) { ?>
                        <ul>
                            <li><a <?= full_href($rows) ?> target="<?= $rows['blank'] ?>">
                                    <img alt="<?= $rows['tenbaiviet_' . $lang] ?>" src="<?= full_src($rows, "") ?>">
                                </a></li>
                        </ul>
                    <?php } ?>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    <?php } ?>
    <section class="dv-diemban1">
        <div class="title_home align_center wow flipInX">
            <h2 class="tiltle"><?= $thongtin_step['tenbaiviet_' . $lang] ?></h2>
        </div>
        <?php
        ?>
        <div class="list_danhsach">
            <ul>
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    foreach ($nd_kietxuat as $rows) {
                        $bv_con = count(LAY_baiviet_chitiet($rows['id']));
                        ?>
                        <li><a <?= full_href($rows) ?>><?= $rows['tenbaiviet_' . $lang] ?> (<?= $bv_con ?>)</a></li>
                    <?php }
                } ?>
            </ul>
        </div>
        <div class="clr"></div>
    </section>
    <div class="clr"></div>
</div>
<script>
    $(document).ready(function () {
        $('.diemban').each(function () {
            $(this).click(function () {
                $(this).find(".dv-mota-show").toggle();
            });
        });
    });
    $(document).mouseup(function(e)
    {
        var container = $(".dv-mota-show");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.hide();
        }
    });

</script>