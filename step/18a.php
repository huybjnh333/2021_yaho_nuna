<?php
LOCATION_js($full_url."/");
exit();
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "  AND `id_parent` = (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
//$numview = 8;
//$nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", " `step` IN (" . $slug_step . ") $wh ", " `catasort` DESC ", $numview);

// $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
// $nd_total = mysqli_num_rows($nd_total);
// $retuen_arr = array();
// while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
//   $retuen_arr[] = $r;
// }
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
// $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

// if($arr_running['icon_hover'] != "") {
//   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
// }
// full_src($thongtin_step, '')
include _source . "box-header.php";
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "9", 1);
$bv_chitiet = DB_fet("*", "#_baiviet_chitiet", "`showhi` = 1 and id_parent =" . $arr_running['id'] . "", "", "", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap dv-kinhdoanh-detail">
    <div class="title_news" id="go_title">
        <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
    </div>
    <div class="clr"></div>
    <div class="showText">
        <div class="dv-kd1">
            <div class="c-list-btn2">
                <div style="display: table-row">
                <?php foreach ($bv_chitiet as $r){ ?>
                <a href="#pd<?=$r['id']?>" class="c-btn2 c-scroll-js"><?=$r['tenbaiviet_'.$lang]?></a>
                <?php } ?>
                </div>
            </div>
            <?=$arr_running['noidung_'.$lang]?>
        </div>
        <?php foreach ($bv_chitiet as $r){ ?>
        <div class="c-list2__card1 card1-js" id="pd<?=$r['id']?>">
            <div class="c-list2__box1 col-md-6">
                <div class="c-list2__info1">
                    <h2 class="c-list2__title1 title1-js"><?=$r['tenbaiviet_'.$lang]?><span
                                class="c-showSP icon icon-down2 icon1-js"></span></h2>
                    <div class="text1 text1-js">
                        <?=$r['noidung_'.$lang]?>
                    </div>
                </div>
            </div>
            <div class="c-list2__img1 tRes_67 img1-js col-md-6">
                <img class="lazy" <?=full_src_lazy($r,"")?> alt="<?=$r['tenbaiviet_'.$lang]?>">
            </div>
            <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
    </div>
    <?php
    include _source . "fb_sharelink.php"; ?>
    <div class="dv-fb_coment">
        <?php include _source . "fb_coment.php"; ?>
    </div>

    <div class="box_page">
        <div class="title_page">
            <ul><h3 class="h_title"><?=$glo_lang['bai_viet_lien_quan']?></h3>
            </ul>
        </div>
        <div class="tt_page_top tt_tintuc flex">
            <?php foreach ($bvlienquan as $rows) { ?>
            <div class="new_id_bs">
                <li><a <?=full_href($rows)?>><img class="lazy" <?=full_src_lazy($rows)?>
                                                  alt="<?=$rows['tenbaiviet_'.$lang]?>"></a></li>
                <ul>
                    <h3><a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a></h3>
                    <p><?=strip_tags($rows['mota_'.$lang])?></p>
                </ul>
                <div class="clr"></div>
            </div>
            <?php } ?>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<script>
    jQuery(document).ready(function ($) {
        // $('html,body').animate({scrollTop: $("#go_title").offset().top - 40},0);

        $(".c-scroll-js").click(function (event) {
            var hei_box_menu = $(".dv-header").height() + 42;
            if($(".dv-header.fixed").height() != null){
                console.log(123);
                hei_box_menu = $(".dv-header.fixed").height() - 40;
            }
            event.preventDefault();
            // console.log($(this.hash).offset().top)
            $('html,body').animate({scrollTop: $(this.hash).offset().top - hei_box_menu - 40},0);
        });
    });
</script>
