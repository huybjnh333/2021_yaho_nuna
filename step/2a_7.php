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
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="bg_link_page" style="background-image:url(<?= full_src($thongtin_step, '') ?>);">
    <div class="pagewrap">
        <ul>
            <h3><?= $kietxuat_name ?></h3>
        </ul>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <div class="right_sp">
        <div class="container">
            <!-- Full-width images with number text -->
            <div class="mySlides"><img
                        src="<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>"
                        style="width:100%"></div>
            <?php
            foreach ($list_hinhcon as $rows) {
                ?>
                <div class="mySlides"><img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>"
                                           style="width:100%"></div>
            <?php } ?>
            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a> <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <!-- Image text -->
            <div class="caption-container">
                <p id="caption"></p>
            </div>
            <?php if (count($list_hinhcon)) { ?>
                <div class="row">
                    <div class="column"><img class="demo cursor"
                                             src="<?= checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>"
                                             style="width:100%" onclick="currentSlide(1)"></div>
                    <?php
                    $i = 1;
                    foreach ($list_hinhcon as $rows) {
                        $i++;
                        ?>
                        <div class="column"><img class="demo cursor"
                                                 src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>"
                                                 style="width:100%" onclick="currentSlide(<?= $i ?>)"></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                // dots[slideIndex-1].className += " active";
            }
        </script>
    </div>
    <div class="left_sp">
        <ul>
            <h3><?= SHOW_text($arr_running['tenbaiviet_' . $lang]) ?></h3>
            <div>
                <?= SHOW_text($arr_running['mota_' . $lang]) ?>
            </div>
            <h4><a href="tel:<?= $thongtin['hotline_vi'] ?>"><i
                            class="fa fa-volume-control-phone"></i><?= $glo_lang['tu_van'] ?>
                    <span><?= $thongtin['hotline_vi'] ?></span></a></h4>
        </ul>
    </div>
    <div class="clr"></div>
    <div class="chitiet_sp ">
        <div class="chitiet_left">
            <div class="showText">
                <?= SHOW_text($arr_running['noidung_' . $lang]) ?>
                <div class="clr"></div>
            </div>
            <?php
            $baiviet_ct = LAY_baiviet_chitiet($arr_running['id']);
            if (count($baiviet_ct)) {
                ?>
                <div class="tl" id="tl">
                    <h3 class="tit-de1"><?= $glo_lang['tai_lieu'] ?></h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?= $glo_lang['ten_file'] ?></th>
                            <th><?= $glo_lang['tai_ve'] ?></th>
                            <th><?= $glo_lang['loai_file'] ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($baiviet_ct as $rows) {
                            $link = "";
                            $target = "";

                            if ($rows['dowload_text'] != "") {
                                $link = $rows['dowload_text'];
                                $target = "target='_blank'";
                                $ex = explode(".", $rows['dowload_text']);
                                $ex = end($ex);
                            } else if ($rows['dowload'] != "") {
                                $link = $fullpath . "/datafiles/files/" . $rows['dowload'];
                                $target = "download";
                                $ex = explode(".", $rows['dowload']);
                                $ex = end($ex);
                            }
                            ?>
                            <tr class="success">
                                <td><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></td>
                                <td><a href="<?= $link ?>" <?= $target ?>>
                                        <img src="images/dl.png"></a>
                                </td>
                                <td><?= $ex ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <div class="box_page">
                <div class="pagewrap">
                    <div class="title_page_id_2">
                        <ul>
                            <h3><?= $glo_lang['san_pham_lien_quan'] ?></h3>
                        </ul>
                    </div>
                    <div class="project_id pro_id_slider no_box ">
                        <!--  -->
                        <?php $data = array("1", "2", "2", "3", "3", "3") ?>
                        <div class="owl-auto-sp owl-carousel owl-theme flex" data0="<?= $data[0] ?>"
                             data1="<?= $data[1] ?>" data2="<?= $data[2] ?>" data3="<?= $data[3] ?>"
                             data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
                             is_dots="1" is_autoplay="0">
                            <?php
                            $view = "slider";
                            foreach ($nd_kietxuat as $rows) {
                                // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
                                // $dvt = $rows['p3'] != "" ? $rows['p3'] : $rows['dvt'];
                                // $gia = GET_gia($rows['giatien'], $rows['giakm'], $dvt, $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
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
        </div>
        <div class="chitiet_right chitiet_right_2">
            <div class="col-sm-3 col-xs-12 right-main">
                <div id="search-r">
                    <input class="text input_search_enter_new" type="text" data=".input_search_enter_new"
                           data-href="<?= $full_url ?>/search/?key="
                           placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>">
                    <span id="searchSubmit"
                          onClick="SEARCH_timkiem('<?= $full_url ?>/search/?key=','.input_search_enter_new'); "
                          style="cursor:pointer">
            <i class="fa fa-search"></i>
          </span>
                </div>
                <div id="sidebar-sticky-wrapper" class="sticky-wrapper">
                    <div id="sidebar">
                        <section id="con-reg">
                            <h4>
                                <a onclick="LOAD_popup_new('<?= $full_url . "/pa-size-child/yeu-cau-bao-gia/" ?>', '480px')"
                                   class='cur'><?= $glo_lang['yeu_cau_bao_gia'] ?><i
                                            class="fa fa-paper-plane-o"></i></a></h4>
                        </section>
                        <div class="clearfix"></div>
                        <?php
                        $banner_top = LAY_banner_new("`id_parent` = 31");
                        if (count($banner_top)) {
                            ?>
                            <section id="gp-r">
                                <h3 class="title-r"><?= $glo_lang['san_pham_ung_dung'] ?></h3>
                                <div class="row wrap-gp-nlmt">
                                    <ul class="gp-r-list flex no_box">
                                        <?php
                                        foreach ($banner_top as $rows) {
                                            ?>
                                            <li class="item-gr-r">
                                                <a <?= full_href($rows) ?>>
                                                    <?= full_img($rows, '') ?>
                                                    <p><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></p>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <div class="clr"></div>
                                    </ul>
                                </div>
                            </section>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="clr"></div>
    </div>
</div>