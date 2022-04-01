<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 8;
else $numview = $thongtin_step['num_view'];


$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = $motty == 'search' ? true : false;

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
$wh = "";
if ($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (" . $lay_all_kx . ") ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_" . $lang . "` LIKE '%" . $key . "%' )";
}


//

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
<div class="pagewrap page_conten_page">
    <div class="tin_left tin_left_1column">
        <div class="title_news">
            <h2><?= $nametitle ?></h2>
        </div>
        <div class="flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                foreach ($nd_kietxuat as $rows) {
                    ?>
                    <div class="new_id_bs">
                        <li><a <?= full_href($rows) ?>><?= full_img($rows) ?></a></li>
                        <ul>
                            <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a><span><i
                                            class="fa fa-calendar"></i><?= fullDate($rows['ngaydang'], $glo_lang) ?></span>
                            </h3>
                            <p class="limit-row-3"><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php }
            } ?>
        </div>
        <div class="clr"></div>
        <div class="nums no_box">
            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
</div>