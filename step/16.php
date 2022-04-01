<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 7;
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
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap">
    <div class="tin_left">
        <div class="showText">
            <div class="right_au wow fadeInUp">
                <ul class="accordion" id="accordion-1">
                    <?php
                        $danhmuc = LAY_danhmuc($slug_step);
                        $i = 0;
                        foreach ($danhmuc as $rows){
                            if($rows['id_parent'] != 0)  continue;
                            $i++;
                    ?>
                    <li>
                        <a class="title_bv" href="#"><span><?=$rows['tenbaiviet_'.$lang]?></span></a>
                        <a class="menu_parent menu_parent<?=$i?>" href="#"><i class="fa fa-angle-down"></i><i
                                    class="fa fa-angle-up"></i></a>
                        <ul>
                            <?php $baiviet = LAY_baiviet($slug_step,"","`id_parent` = ".$rows['id']);
                                foreach ($baiviet as $val){
                            ?>
                            <p><a <?=full_href($val)?> target="_blank" rel="noopener">- <?=$val['tenbaiviet_'.$lang]?></a></p>
                            <?php } ?>
                            <?php foreach ($danhmuc as $rows_2){
                                    if($rows_2['id_parent'] != $rows['id']) continue;
                                    $baiviet = LAY_baiviet($slug_step,"","`id_parent` = ".$rows_2['id']);
                                ?>
                                <p>- <?=$rows_2['tenbaiviet_'.$lang]?>
                                    <?php foreach ($baiviet as $val_2){ ?>
                                    <span><a <?=full_href($val_2)?> target="_blank" rel="noopener">+ <?=$val_2['tenbaiviet_'.$lang]?></a></span>
                                    <?php } ?>
                                </p>
                            <?php } ?>
                        </ul>
                        <div class="clr"></div>
                    </li>
                    <?php } ?>
                    <?php
                        $tragop = LAYTEXT_rieng(92);
                    ?>
                    <li>
                        <span><?=$tragop['tenbaiviet_'.$lang]?></span>
                        <a class="menu_parent" href="#"><i class="fa fa-angle-down"></i><i
                                    class="fa fa-angle-up"></i></a>
                        <ul>
                            <?=$tragop['noidung_'.$lang]?>
                            <div class="clr"></div>
                        </ul>
                        <div class="clr"></div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <?php include _source."tin_right_1.php"; ?>
    <div class="clr"></div>
</div>

<script type='text/javascript' src='js/jquery.cookie.js'></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcjqaccordion.2.7.min.js'></script>
<script type="text/javascript">
    $(document).ready(function ($) {
        $('#accordion-1').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: true,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            cookie: 'dcjq-accordion-1',
            classExpand: 'dcjq-current-parent'
        });
    });
</script>
<script>
    // $(document).ready(function () {
    //     $(".menu_parent1").click(function () {
    //         $(".menu_parent1 .fa-angle-up").toggle();
    //         $(".menu_parent1 .fa-angle-down").toggle();
    //     });
    //
    // });
</script>