<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 5;
else $numview = $thongtin_step['num_view'];

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = isset($_GET['key']) ? true : false;

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $slug_step = 5;
    $name_titile = $glo_lang['tim_kiem'];
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = $slug_step LIMIT 1");
    $thongtin_step = mysqli_fetch_assoc($thongtin_step);
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}
$wh = "";
if ($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (" . $lay_all_kx . ") ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%')";
}

// //check tieu thuyet
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}
//

include _source . "phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";

// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search != "") {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
}

// full_src($thongtin_step, '')
include _source."box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page dv-hoidap">
    <?php include _source . "menu_right.php"; ?>
    <div class="pagewrap">
        <div class="tin_left">
            <div class="timkiem_hoidap">
                <div class="search">
                    <a onClick="SEARCH_timkiem_khac('<?= $full_url ?>/search/','.input_search_enter_khac','<?= $thongtin_step['step'] ?>'); if($('.input_search_enter_khac').val() == '') $('.timkiem_top').removeClass('acti') "
                       style="cursor:pointer"> <i class="fa fa-search"></i></a>
                    <input class="input_search input_search_enter_khac" type="text" value=""
                           data=".input_search_enter_khac"
                           data-href="<?= $full_url ?>/search/" data-step="<?= $thongtin_step['step'] ?>"
                           placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>"/>
                </div>
            </div>
            <div class="clr"></div>
            <ul class="list-question accordion" id="accordion-1">
                <h3 class="title"><?= $glo_lang['cac_chu_de_duoc_quan_tam'] ?></h3>
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    foreach ($nd_kietxuat as $rows) {
                        ?>
                        <li>
                            <span><i class="fa fa-angle-right"></i> <?= $rows['tenbaiviet_' . $lang] ?></span>
                            <a class="menu_parent menu_parent1" href="#"><i class="fa fa-angle-down"></i><i
                                        class="fa fa-angle-up"></i></a>
                            <ul>
                                <div class="showText"><?= SHOW_text($rows['noidung_' . $lang]) ?></div>
                            </ul>
                            <div class="clr"></div>
                        </li>
                    <?php }
                } ?>
            </ul>
            <div class="clr"></div>
            <div class="nums no_box">
                <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                <div class="clr"></div>
            </div>
        </div>
        <?php $danhmuc = LAY_danhmuc($slug_step, "", "`id_parent` = 0"); ?>
        <div class="tin_right">
            <ul class="listtabs answer">
                <li>
                    <a <?= full_href($thongtin_step) ?> class="<?= $slug_table == "step" ? "selected" : "" ?>">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $glo_lang['tat_ca_cau_hoi'] ?>
                    </a>
                </li>
                <?php foreach ($danhmuc as $r) { ?>
                    <li>
                        <a <?= full_href($r) ?>
                                class="<?= $slug_table == "danhmuc" && $slug_id == $r['id'] ? "selected" : "" ?>">
                            <img style="" src="<?= full_src($r) ?>">
                            <?= $r['tenbaiviet_' . $lang] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<?php include _source . "banner_duoi.php"; ?>

<script type='text/javascript' src='js/jquery.cookie.js'></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcjqaccordion.2.7.min.js'></script>
<script type="text/javascript">
    $(document).ready(function ($) {
        $('#accordion-1').dcAccordion({
            eventType: 'click',
            autoClose: false,
            saveState: false,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            cookie: 'dcjq-accordion-1',
            classExpand: 'dcjq-current-parent'
        });
    });
</script>