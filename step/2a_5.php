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

?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="bg_link_page">
    <div class="pagewrap">
        <ul>
            <h3><?= $kietxuat_name ?></h3>
            <li><i class="fa fa-home"></i><a
                        href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?>
            </li>

        </ul>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <div class="right_conten">
        <div class="titile_page">
            <h3><?= $kietxuat_name ?></h3>
            <div class="clr"></div>
        </div>

        <div class="viewLeft no_box">
            <div id="pro_img_main">
                <div id="bridal_images"><a
                            href='<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>'
                            class='cloud-zoom' id='zoom1'
                            rel="position: 'inside' , showTitle: false, adjustX:0, adjustY:0"><img
                                src="<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>"></a>
                </div>
                <?php //if(count($list_hinhcon)){ ?>
                <div class="dv-slider-nang no_box">
                    <?php $data = array("2", "3", "3", "3", "4", "4") ?>
                    <div class="<?= !empty($load_ajax_all) ? "owl-auto-sp" : "owl-auto-sp-new" ?>  owl-carousel owl-theme flex"
                         data0="<?= $data[0] ?>" data1="<?= $data[1] ?>" data2="<?= $data[2] ?>" data3="<?= $data[3] ?>"
                         data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
                         is_dots="1" is_autoplay="1">
                        <?php if (count($list_hinhcon)) { ?>
                            <div class="item">
                                <li>
                                    <a href='<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>'
                                       class='cloud-zoom-gallery'
                                       rel="useZoom: 'zoom1', smallImage: '<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>'"><img
                                                src="<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>"></a>
                                </li>
                            </div>
                        <?php } ?>
                        <?php
                        $i = 1;
                        foreach ($list_hinhcon as $rows) {
                            $i++;
                            ?>
                            <div class="item">
                                <li><a href='<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>'
                                       class='cloud-zoom-gallery'
                                       rel="useZoom: 'zoom1', smallImage: '<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>'"><img
                                                src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin'], "thumbnew_") ?>"></a>
                                </li>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php //} ?>
                <?php if (!empty($load_ajax_all)) { ?>
                    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
                    <script type="text/javascript">
                        jQuery.browser = {};
                        (function () {
                            jQuery.browser.msie = false;
                            jQuery.browser.version = 0;
                            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                                jQuery.browser.msie = true;
                                jQuery.browser.version = RegExp.$1;
                            }
                        })();

                    </script>
                    <script type="text/javascript" src="js/jquery.lazyload.min.js"></script>
                    <script type="text/javascript" language="javascript" src="js/me.js?v=<?= time() ?>"></script>
                <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
                    <script type="text/javascript" src="js/owl.carousel.js"></script>

                <?php }else{ ?>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".owl-auto-sp-new").each(function () {
                                var is_slidespeed = $(this).attr("is_slidespeed");
                                var is_navigation = $(this).attr("is_navigation") == 1 ? true : false;
                                var is_dots = $(this).attr("is_dots") == 1 ? true : false;
                                var is_autoplay = $(this).attr("is_autoplay") == 1 ? true : false;
                                var is_items_0 = $(this).attr("data0");
                                var is_items_1 = $(this).attr("data1");
                                var is_items_2 = $(this).attr("data2");
                                var is_items_3 = $(this).attr("data3");
                                var is_items_4 = $(this).attr("data4");
                                var is_items_5 = $(this).attr("data5");
                                $(this).owlCarousel({
                                    slideSpeed: is_slidespeed,
                                    navigation: is_navigation,
                                    itemsCustom: [
                                        [0, is_items_0],
                                        [319, is_items_1],
                                        [479, is_items_2],
                                        [767, is_items_3],
                                        [991, is_items_4],
                                        [1199, is_items_5]
                                    ],
                                    dots: is_dots,
                                    autoPlay: is_autoplay,
                                    navigationText: ["‹", "›"]
                                });
                            });
                        });
                    </script>
                <?php } ?>
                <script type="text/javascript" src="js/cloud-zoom.1.0.2.min.js"></script>
            </div>
        </div>
        <div class="viewRight">
            <div class="viewRight_more">
                <div class="titleView"><?= SHOW_text($arr_running['tenbaiviet_' . $lang]) ?></div>
                <?php
                $gia = GET_gia($arr_running['giatien'], $arr_running['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '');
                ?>
                <h5 class="h5_giact_sp"><?= $glo_lang['gia'] ?>: <?= $gia['text_gia'] ?> <?= $gia['text_km'] ?></h5>
                <ul class="desc">
                    <?= $arr_running['p1'] != "" ? "<b>" . $glo_lang['cart_ma_sp'] . ': ' . $arr_running['p1'] . "</b>" : "" ?>
                    <!-- <p><?= GET_sao_sp($arr_running['num_1'], $arr_running['num_2'], $arr_running['id']) ?></p> -->
                    <div class="dv-mota-sp"><?= SHOW_text($arr_running['mota_' . $lang]) ?>
                        <div class="clr"></div>
                    </div>
                </ul>
                <div class="clr"></div>
                <div id="sharelink">
                    <div class="addthis_toolbox addthis_default_style "><a class="addthis_button_facebook_like"
                                                                           fb:like:layout="button_count"></a> <a
                                class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone"
                                                                     g:plusone:size="medium"></a> <a
                                class="addthis_counter addthis_pill_style"></a></div>
                </div>
                <div class="ct_add">
                    <ul>
                        <?php
                        $splienhe = LAY_step(6, 1);
                        ?>
                        <h3><a <?= full_href($splienhe) ?> class="clor_01"><?= $glo_lang['dat_hang'] ?></a></h3>
                        <h3><a <?= full_href($thongtin_step) ?>
                                    class="clor_03"><?= $glo_lang['xem_tiep_san_pham'] ?></a></h3>
                        <div class="clr"></div>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="clr" style="margin-bottom:30px;"></div>
        <div class="titile_page">
            <h3><?= $glo_lang['chi_tiet_san_pham'] ?></h3>
            <div class="clr"></div>
        </div>
        <div class="showText">
            <?= SHOW_text($arr_running['noidung_' . $lang]) ?>
            <div class="clr"></div>
        </div>
        <div class="dv-fb_coment">
            <?php include _source . "fb_coment.php"; ?>
        </div>

    </div>
    <?php include _source . "left_conten.php"; ?>
    <div class="clr"></div>
</div>
<div class="box_home_tt_2">
    <div class="pagewrap">
        <div class="title_page_id_2">
            <ul>
                <h3><?= $glo_lang['san_pham_lien_quan'] ?></h3>
            </ul>
        </div>
        <div class="pro_id pro_id_home pro_id_home_slider pro_id_home_slider_ct no_box">
            <!--  -->
            <?php $data = array("1", "2", "3", "4", "4", "5") ?>
            <div class="owl-auto-sp owl-carousel owl-theme flex" data0="<?= $data[0] ?>" data1="<?= $data[1] ?>"
                 data2="<?= $data[2] ?>" data3="<?= $data[3] ?>" data4="<?= $data[4] ?>" data5="<?= $data[5] ?>"
                 is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="0">
                <?php
                $view = "slider";
                foreach ($nd_kietxuat as $rows) {
                    // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
                    ?>
                    <div class="item">
                        <?php include _source . "home_temp.php"; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="clr"></div>
            <!--  -->

        </div>
    </div>
</div>