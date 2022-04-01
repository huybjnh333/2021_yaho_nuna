<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);
$wh = "  AND `id_parent` = (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
$numview = 12;

$nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", " `step` IN (" . $slug_step . ") $wh ", " `catasort` DESC ", $numview);

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
<!--<link rel="stylesheet" href="css/jquery.fancybox.min.css"/>-->
<!--<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/jquery.fancybox.min.js"></script>-->
<!--<script src="js/TweenMax.min.js"></script>-->
<!--<script type="text/javascript" src="js/slick.min.js"></script>-->
<link href="css/lightgallery.min.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/lightgallery-all.min.js"></script>

<div class="page_conten_page pagewrap">
    <div class="tin_left">
        <div class="title_news">
            <h2><?=$arr_running['tenbaiviet_'.$lang]?></h2>
            <li><i class="fa fa-calendar"></i><?=date("d/m/Y",$arr_running['ngaydang'])?></li>
        </div>
        <div class="showText">
            <p><?=$arr_running['noidung_'.$lang]?></p>
        </div>
        <div id="lightgallery" class="album-zoom-gallery flex no_box">
            <?php
            $danhsach_img = LAY_hinhanhcon($arr_running['id']);
            foreach ($danhsach_img as $rows) {
                ?>
                <div data-src="<?= full_src($rows, "") ?>">
                    <a><img class="lazy" <?=full_src_lazy($rows,"")?>></a>
                </div>
            <?php } ?>
        </div>
        <div class="clr"></div>
        <?php include _source."fb_sharelink.php"; ?>
        <?php include _source."fb_coment.php"; ?>
        <div class="clr"></div>
        <div class="box_page">
            <div class="title_page">
                <ul><h3 class="h_title"><?=$glo_lang['hinh_anh_lien_quan']?></h3>
                </ul>
            </div>
            <?php $data = array("2", "2", "2", "3", "3", "3") ?>
            <div class="dv-home-lh flex owl-auto owl-carousel owl-theme owl-custome" data0="<?= $data[0] ?>"
                 data1="<?= $data[1] ?>" data2="<?= $data[2] ?>" data3="<?= $data[3] ?>"
                 data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
                 is_autoplay="1">
                <?php foreach ($bvlienquan as $rows){ ?>
                <div class="dv-gr-lh slider">
                    <div class="img">
                        <a <?=full_href($rows)?>>
                            <img class="lazy" <?=full_src_lazy($rows)?>></a>
                    </div>
                    <div class="text-left">
                        <a <?=full_href($rows)?>><h3><?=$rows['tenbaiviet_'.$lang]?></h3></a>
                        <div class="clr"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    <?php include _source."tin_right_1.php"; ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#lightgallery').lightGallery();
    });
</script>


