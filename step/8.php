<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 12;
else $numview = $thongtin_step['num_view'];

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = isset($_GET['key']) ? true : false;

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $slug_step = "1,3,4";
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
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%')";
}

// //check tieu thuyet
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}
//
$wh2 = "";
if ($lay_all_kx != "") {
    $wh2 = " AND `id_parent` in (" . $lay_all_kx . ") ";
}
$nd_tieubieu = LAY_baiviet($slug_step, 1, "`opt` = 1 $wh2");
if (!empty($nd_tieubieu)) {
    $nd_tieubieu = reset($nd_tieubieu);
    $wh .= " AND `id` NOT IN (" . $nd_tieubieu['id'] . ") ";
}

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
$tenvideo = "";
$id_video = "";
foreach ($nd_kietxuat as $rows) {
    $tenvideo = $rows['tenbaiviet_' . $lang];
    $id_video = $rows['p1'];
    break;
}
include _source . "box-header.php";
?>
<div class="page_conten_page pagewrap">
    <div class="tt_page_top tt_video flex">
        <?php
        if ($nd_total == 0) {
            echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
        } else {
            foreach ($nd_kietxuat as $rows) {
                if (!empty($rows['p1'])) {
                    ?>
                    <div class="new_id_bs">
                        <li><a class="cur" onclick="LOAD_popup_new('<?=$full_url ?>/pa-size-child/video-popup/?step=<?=$rows['step']?>&id=<?=$rows['id']?>', '800px')">
                                <img src="<?=full_src($rows)?>" alt="<?=$rows['tenbaiviet_'.$lang]?>">
                                <i class="fa fa-play" aria-hidden="true"></i></a></li>
                        <ul>
                            <h6>Video</h6>
                            <h3><a class="lm_3 cur"
                                   onclick="LOAD_popup_new('<?=$full_url ?>/pa-size-child/video-popup/?step=<?=$rows['step']?>&<?=$rows['id']?>', '800px')">
                                    <?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php } else { ?>
                    <div class="new_id_bs">
                        <li>
                            <a <?=full_href($rows)?>><img src="<?=full_src($rows)?>" alt="<?=$rows['tenbaiviet_'.$lang]?>">
                            </a>
                        </li>
                        <ul>
                            <h6><?=$glo_lang['bai_viet']?></h6>
                            <h3><a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a>
                            </h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php } ?>
            <?php }
        } ?>
    </div>
    <div class="clr"></div>
    <div class="nums no_box">
        <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>