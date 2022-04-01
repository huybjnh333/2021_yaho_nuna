<?php
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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "8", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page pagewrap">
    <div class="title_news">
        <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
    </div>
    <div class="showText">
        <?= SHOW_text($arr_running['noidung_' . $lang]) ?>
    </div>
    <?php include _source . "fb_sharelink.php"; ?>
    <?php include _source . "fb_comment.php"; ?>
    <?php if(!empty($bvlienquan)){ ?>
    <div class="box_page">
        <div class="title_page">
            <ul><h3 class="h_title"><?= $glo_lang['bai_viet_lien_quan'] ?></h3>
            </ul>
        </div>
        <?php $data = array("2", "2", "2", "3", "3", "3") ?>
        <div class="tt_page_top owl-auto owl-carousel owl-theme owl-custome flex" id="dichvu_slide"
             data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
             data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
             is_slidespeed="1000" is_navigation="1" is_dots="0" is_autoplay="0">
            <?php
            foreach ($bvlienquan as $rows) {
                if (!empty($rows['p1'])) {
                    ?>
                    <div class="new_id_bs">
                        <li><a class="cur"
                               onclick="LOAD_popup_new('<?= $full_url ?>/pa-size-child/video-popup/?step=<?= $rows['step'] ?>&id=<?= $rows['id'] ?>', '800px')">
                                <img src="<?= full_src($rows) ?>" alt="<?= $rows['tenbaiviet_' . $lang] ?>">
                                <i class="fa fa-play" aria-hidden="true"></i></a></li>
                        <ul>
                            <h6>Video</h6>
                            <h3><a class="lm_3 cur"
                                   onclick="LOAD_popup_new('<?= $full_url ?>/pa-size-child/video-popup/?step=<?= $rows['step'] ?>&<?= $rows['id'] ?>', '800px')">
                                    <?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php } else { ?>
                    <div class="new_id_bs">
                        <li>
                            <a <?= full_href($rows) ?>><img src="<?= full_src($rows) ?>"
                                                            alt="<?= $rows['tenbaiviet_' . $lang] ?>">
                            </a>
                        </li>
                        <ul>
                            <h6><?= $glo_lang['bai_viet'] ?></h6>
                            <h3><a <?= full_href($rows) ?>><?= $rows['tenbaiviet_' . $lang] ?></a>
                            </h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php } ?>
            <?php }
            ?>
        </div>
    </div>
    <?php } ?>
    <div class="clr"></div>
</div>