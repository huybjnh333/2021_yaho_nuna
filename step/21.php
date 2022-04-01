<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 99;
else $numview = $thongtin_step['num_view'];

if ($slug_table == "danhmuc"){
    $numview = 6;
}

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = $motty == 'search' ? true : false;
$wh = "";
$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $slug_step = 4;
    $name_titile = $glo_lang['tim_kiem'];
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = $slug_step LIMIT 1");
    $thongtin_step = mysqli_fetch_assoc($thongtin_step);
    $motty_phantrang = $motty;
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
} else {
    $motty_phantrang = $thongtin_step['seo_name'];
}
if ($lay_all_kx != "") {
    $wh .= "  AND (FIND_IN_SET('" . $arr_running['id'] . "', `id_parent_muti`) OR (`id_parent` in (" . $lay_all_kx . "))) ";
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
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
}
include _source . "box-header.php";
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->

<div class="page_conten_page">
    <?php include _source . "menu_right.php"; ?>
    <?php
    if ($slug_table == "step") {
        include _source . "phantrang_danhmuc.php";
        ?>
        <div class="pagewrap" id="pagewrap">
            <?php
            $idpr_cha = LAY_danhmuc($slug_step, "", "`id_parent` = 0");
            if (empty($idpr_cha)) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                $i = 1;
                foreach ($idpr_cha as $rows) {
                    $i++;
                    ?>
                    <section class="dv-home-sanpham dv-pd">
                        <div class="pagewrap">
                            <div class="col-lg-12 flex">
                                <div class="col-lg-6">
                                    <div class="title_home align_left wow flipInX">
                                        <h2 class="tiltle"><?= $rows['tenbaiviet_' . $lang] ?></h2>
                                    </div>
                                    <div class="showText"><?= SHOW_text($rows['noidung_' . $lang]) ?></div>
                                    <p class="read-more">
                                        <a <?= full_href($rows) ?>><?= $glo_lang['xem_them'] ?></a>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <img <?= full_src_lazy($rows) ?> class="lazy">
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </section>
                <?php }
            } ?>
        </div>
    <?php } else if ($slug_table == "danhmuc") { ?>
        <div class="pagewrap" id="pagewrap">
            <div id="pro_tabs">
                <ul class="listtabs">
                    <?php
                    $idpr_con = LAY_danhmuc($slug_step, "", "`id_parent` = $slug_id");
                    if($arr_running['id_parent'] != 0){
                        $idpr_con = LAY_danhmuc($slug_step, "", "`id_parent` = ".$arr_running['id_parent']);
                    }
                    $idpr_cha = DB_fet("`seo_name`","`#_danhmuc`","`showhi` = 1 and `id` = $slug_id","",1,"arr");
                    if($arr_running['id_parent'] != 0){
                        $idpr_cha = DB_fet("`seo_name`","`#_danhmuc`","`showhi` = 1 and `id` = ".$arr_running['id_parent'],"",1,"arr");
                    }
                    $idpr_cha = reset($idpr_cha);
                    ?>
                    <li>
                        <a <?=full_href($idpr_cha,"#pagewrap")?> class="<?= $arr_running['id_parent'] == 0 ? "selected" : ""?>">
                            <?=$glo_lang['tat_ca']?>
                        </a>
                    </li>
                    <?php
                    if (!empty($idpr_con)) {
                        foreach ($idpr_con as $val) {
                            ?>
                            <li>
                                <a <?=full_href($val,"#pagewrap")?> class="<?=$slug_id == $val['id'] ? "selected" : ""?>">
                                    <?= $val['tenbaiviet_' . $lang] ?>
                                </a>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
            <div class="tt_page_top tt_video">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                foreach ($nd_kietxuat as $rows) {
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
                            <p class="read-more"><a <?=full_href($rows)?>><?=$glo_lang['doc_bai_viet']?></a></p>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <div class="clr"></div>
            <div class="nums no_box">
                <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                <div class="clr"></div>
            </div>
        </div>
        <div class="clr"></div>
    <?php } ?>
    <div class="clr"></div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pagewrap').on('load', function(e){
            e.preventDefault();
            $('html, body').animate({
                scrollTop : $(this.hash).offset().top
            }, 500);
        });
    });
</script>