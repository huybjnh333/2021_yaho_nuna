<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 12;
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

include _source . "phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";

// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search) {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
}

//
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="link_title">
    <div class="pagewrap">
        <ul>
            <li><i class="fa fa-home"></i><a
                        href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?>
            </li>
            <div class="clr"></div>
        </ul>
    </div>
</div>
<div class="titile_page titile_page_maps">
    <ul>
        <h3><?= $glo_lang['cua_hang_cua_chung_toi'] ?></h3>
        <div class="w3-container">
            <div class="w3-bar w3-black">
                <?php
                $danhmuc = LAY_danhmuc($slug_step);
                $k = 0;
                foreach ($danhmuc as $rows) {
                    $k++;
                    ?>
                    <button class="w3-bar-item w3-button tablink <?= $k == 1 ? 'w3-red' : "" ?> "
                            onclick="show_nut(this,'<?= $rows['id'] ?>')"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></button>
                <?php } ?>
                <script type="text/javascript">
                    function show_nut(obj, id) {
                        $(".tablink").removeClass("w3-red");
                        $(".class_cuahang").removeClass("actii");
                        $(".class_cuahang_" + id).addClass("actii");
                        $(obj).addClass("w3-red");
                    }
                </script>
            </div>
            <?php
            $k = 0;
            foreach ($danhmuc as $dm) {
                $k++;
                $baiviet = LAY_baiviet($slug_step, 0, "`id_parent` = '" . $dm['id'] . "' ");
                ?>
                <div class="w3-container w3-border city class_cuahang class_cuahang_<?= $dm['id'] ?> <?= $k == 1 ? 'actii' : "" ?>">
                    <?php
                    if (count($baiviet) == 0) {
                        echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                    } else {
                        ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <?php $i = 0;
                                $link_map = "";
                                foreach ($baiviet as $rows) {
                                    $i++;
                                    if ($i == 1) $link_map = strip_tags($rows['mota_' . $lang]); ?>
                                    <div class="row boutique-item active">
                                        <div class="col">
                                            <h3 class="h3-cuahang"><a class="cur"
                                                                      onclick="$('.js_map_<?= $dm['id'] ?>').attr('src' ,'<?= strip_tags($rows['mota_' . $lang]) ?>')"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a>
                                            </h3>
                                            <div class="showText showText_lienhe"><?= SHOW_text($rows['noidung_' . $lang]) ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="locationMap">
                                    <iframe class="js_map_<?= $dm['id'] ?>" src="<?= $link_map ?>" width="100%"
                                            height="415" frameborder="0" style="border:0;" allowfullscreen=""
                                            aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="clr"></div>
    </ul>
</div>