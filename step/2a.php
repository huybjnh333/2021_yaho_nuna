<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '" . $slug_step . "' AND `id` = '" . $arr_running['id_parent'] . "'", "`id` DESC", 1, "id");


if (empty($kietxuat_name))
    $kietxuat_name = $thongtin_step['tenbaiviet_' . $lang];
else
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_' . $lang];

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = "AND `id_parent` in (" . $lay_all_kx . ") AND `id` <>  '" . $arr_running['id'] . "'";
$numview = 12;
// $nd_kietxuat  = DB_fet(" * "," `#_baiviet` "," `showhi` =  1 AND `step` IN (".$slug_step.") $wh "," `catasort` DESC "," $numview","arr");
$nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", "  `step` IN (" . $slug_step . ") $wh ", " `catasort` DESC, `id` DESC ", $numview);
if (!count($nd_kietxuat)) {
    $nd_kietxuat = DB_fet_rd(" * ", " `#_baiviet` ", "  `step` IN (" . $slug_step . ")", " RAND() ", $numview);
}
$nd_kietxuat_goiy = DB_fet(" * ", " `#_baiviet` ", "  `step` IN (" . $slug_step . ") $wh ", " RAND()", $numview, "arr");

// $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
// $nd_total = mysqli_num_rows($nd_total);
$list_hinhcon = LAY_hinhanhcon($arr_running['id'], 50);
// $tinhnang_arr = DB_fet("*","`#_baiviet_tinhnang`","`showhi` = 1 AND `step` = '".$slug_step."' ","`catasort` ASC, `id` DESC","","arr", 1);
// full_src($thongtin_step, '')
$tinhnang = LAY_bv_tinhnang(2);
$baiviet_ct = LAY_baiviet_chitiet($arr_running['id']);
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "12", 1);
include _source . "box-header.php";
//$gia = GET_gia($arr_running['giatien'], $arr_running['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '', $thongtin['is_giamuti'], $arr_running['id']);

?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<link rel="stylesheet" href="css/jquery.fancybox.min.css"/>
<!--<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/jquery.fancybox.min.js"></script>-->
<!--<script src="js/TweenMax.min.js"></script>-->
<!--<script type="text/javascript" src="js/slick.min.js"></script>-->

<div class="page_conten_page">
    <?php include _source . "menu_right.php"; ?>
    <div class="pagewrap">
        <!--end viewLeft-->
        <div class="viewRight">
            <div class="viewRight_more">
                <div class="titleView"><?= $arr_running['tenbaiviet_' . $lang] ?></div>
            </div>
            <div id="pro_tabs">
                <ul class="listtabs">
                    <li>
                        <a href="#tab1" class="selected">
                            <?=$glo_lang['gioi_thieu']?>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2">
                            <?=$glo_lang['dac_diem_noi_bat']?>
                        </a>
                    </li>
                    <li>
                        <a href="#tab3">
                            <?=$glo_lang['faq']?>
                        </a>
                    </li>
                    <li>
                        <a href="#tab4">
                            <?=$glo_lang['tin_khuyen_mai']?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="mota-sp">
                <div id="tab1">
                    <h2 class="borderedTitle text-center">
                        <span><?=$glo_lang['gioi_thieu']?></span>
                    </h2>
                    <div class="col-lg-12 flex">
                        <div class="col-lg-6 wow fadeInLeft">
                            <img <?= full_src_lazy($arr_running) ?> class="lazy">
                        </div>
                        <div class="col-lg-6  wow fadeInRight">
                            <div class="showText"><?= $arr_running['noidung_' . $lang] ?></div>
                            <div class="ct_add">
                                <ul>
                                    <h3><a class="clor_01"><i class="fa fa-cart-plus" aria-hidden="true"></i> Mua hàng
                                            ngay</a></h3>
                                    <div class="clr"></div>
                                </ul>
                            </div>
                            <div class="dv-mota-sanpham">
                                <?php foreach ($baiviet_ct as $rows){ ?>
                                <p style="text-align:center"><a <?=full_href($rows)?>
                                                                target="_blank"><img class="lazy" <?=full_src_lazy($rows,"")?>></a>
                                </p>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div id="tab2">
                    <h2 class="borderedTitle text-center">
                        <span><?=$glo_lang['dac_diem_noi_bat']?></span>
                    </h2>
                    <?php
                        $dacdiem = LAY_baiviet_chitiet($arr_running['id'],1);
                        foreach ($dacdiem as $r){
                    ?>
                    <div class="col-lg-12 flex">
                        <div class="col-lg-6  wow fadeInLeft">
                            <?=SHOW_text($r['noidung_'.$lang])?>
                        </div>
                        <div class="col-lg-6 wow fadeInRight">
                            <img class="lazy" <?=full_src_lazy($r,"","icon")?>>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <?php } ?>
                </div>
                <div id="tab3">
                    <h2 class="borderedTitle text-center">
                        <span><?=$glo_lang['faq']?></span>
                    </h2>
                    <ul class="list-question accordion" id="accordion-1">
                        <?php
                            $faq = LAY_baiviet(5,4);
                            foreach ($faq as $rows){
                        ?>
                        <li>
                            <span><i class="fa fa-angle-right"></i> <?=$rows['tenbaiviet_'.$lang]?></span>
                            <a class="menu_parent" href="#"><i class="fa fa-angle-down"></i><i
                                        class="fa fa-angle-up"></i></a>
                            <ul><?=SHOW_text($rows['noidung_'.$lang])?></ul>
                            <div class="clr"></div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div id="tab4">
                    <h2 class="borderedTitle text-center">
                        <span><?=$glo_lang['tin_khuyen_mai']?></span>
                    </h2>
                    <div class="col-lg-12 flex">
                        <?php $tin_km = LAY_baiviet(6,3);
                            foreach ($tin_km as $rows){
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item">
                                <div class="img-box">
                                    <a <?=full_href($rows)?> class="open-post">
                                        <img class="img-fluid lazy" <?=full_src_lazy($rows)?>>
                                    </a>
                                    <span class="blog-date"><i class="fa fa-calendar" aria-hidden="true"></i> <?=date("d/m/Y",$rows['ngaydang'])?></span>
                                </div>
                                <div class="text-box">
                                    <a <?=full_href($rows)?> class="title-blog">
                                        <h5 class="lm_2"><?=$rows['tenbaiviet_'.$lang]?></h5>
                                    </a>
                                    <p class="lm_4"><?=strip_tags($rows['mota_'.$lang])?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <div class="box_page" style="margin-top: 30px;">
                <div class="title_page">
                    <ul><h3 class="h_title"><?=$glo_lang['san_pham_lien_quan']?></h3>
                    </ul>
                </div>
                <?php $data = array("2", "2", "2", "3", "3", "3") ?>
                <div class="pro_home_id pro_id owl-carousel owl-theme owl-custome owl-auto" id="pro_slide"
                     data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                     data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                     is_slidespeed="1000" is_navigation="1" is_dots="0" is_autoplay="0">
                    <?php foreach ($bvlienquan as $rows){ ?>
                    <ul>
                        <li><a <?=full_href($rows)?>><img class="lazy" <?=full_src_lazy($rows)?>/></a></li>
                        <h3><a <?=full_href($rows)?>><?=$rows['tenbaiviet_'.$lang]?></a></h3>
                    </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </div>
</div>
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
