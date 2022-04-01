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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "", "10", 1);
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page">
    <?php include _source."menu_right.php"; ?>
    <div class="pagewrap">
        <div class="tin_left">
            <div class="title_news">
                <h2><?=$arr_running['tenbaiviet_'.$lang]?></h2>
                <li><i class="fa fa-calendar"></i> <?=date("d/m/Y",$arr_running['ngaydang'])?></li>
            </div>
            <div class="showText">
                <?=SHOW_text($arr_running['noidung_'.$lang])?>
            </div>
            <?php include _source . "fb_sharelink.php"; ?>
<!--            <div class="dv-fb_coment">-->
<!--                --><?php //include _source . "fb_comment.php"; ?>
<!--            </div>-->
            <div class="box_page">
                <div class="title_page">
                    <ul><h3 class="h_title"><?=$glo_lang['bai_viet_lien_quan']?></h3>
                    </ul>
                </div>
                <?php $data = array("2", "2", "2", "2", "2", "2") ?>
                <div class="tt_page_top owl-carousel owl-theme owl-custome owl-auto" id="dichvu_slide"
                     data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                     data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                     is_slidespeed="1000" is_navigation="1" is_dots="0" is_autoplay="0">
                    <?php
                    foreach ($bvlienquan as $rows) {
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item">
                                <div class="img-box">
                                    <a <?= full_href($rows) ?> class="open-post">
                                        <img class="img-fluid" src="<?= full_src($rows) ?>" alt="<?= $rows['tenbaiviet_' . $lang] ?>">
                                    </a>
                                    <span class="blog-date"><i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?=date("d/m/Y",$rows['ngaydang'])?></span>
                                </div>
                                <div class="text-box">
                                    <a <?= full_href($rows) ?> class="title-blog">
                                        <h5 class="lm_2"><?= $rows['tenbaiviet_' . $lang] ?></h5>
                                    </a>
                                    <p class="lm_4"><?= strip_tags($rows['mota_' . $lang]) ?></p>
                                    <p class="read-more"><a <?=full_href($rows)?>><?=$glo_lang['xem_them']?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php include _source."tin_right.php"; ?>
    </div>
    <div class="clr"></div>
</div>