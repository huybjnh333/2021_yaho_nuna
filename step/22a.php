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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != " . $arr_running['id'] . " and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "", "10", 1);
?>

<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page">
    <?php include _source . "menu_right.php"; ?>
    <?php if (isset($arr_running['p2'])) { ?>
        <div class="pagewrap">
            <div class="tin_left">
                <div class="title_news">
                    <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
                </div>
                <?php if ($arr_running['p2'] == 1) { ?>
                    <div class="showText">
                        <div class="static-page-content ">
                            <?= SHOW_text($arr_running['noidung_' . $lang]) ?>
                            <?php include _source."tinh_ngay_du_sinh.php";?>
                            <div class="clr"></div>
                            <?= SHOW_text($arr_running['thongtin_' . $lang]) ?>
                            <div class="clr"></div>
                        </div>
                    </div>
                <?php } else if ($arr_running['p2'] == 2) { ?>
                    <div class="due-date-calc-section">
                        <div class="calc-header">
                            <div class="topIconImage">
                                <img src="delete/tienich/du-sinh.svg" alt="Công cụ tính ngày sinh"></div>
                            <h2 class="due-calc-heading"><?=$glo_lang['cong_cu_xem_tuoi_cua_be']?></h2>
                        </div>
                        <div class="calc-body">
                            <div class="date-picker-section">
                                <div class="last-period-wrapper">
                                    <p class="due-first-day-para"><?=$glo_lang['nhap_ngay_sinh_cua_be']?></p>
                                    <div class="day-block">
                                        <select class="due-date-dd" id="duedate_day">
                                            <?php
                                            $days = cal_days_in_month(0, 2, 2022);
                                            $day = array();
                                            for ($i = 1; $i <= $days; $i++) {
                                                $day[$i] = $i;
                                            }
                                            foreach ($day as $key => $val) {
                                                ?>
                                                <option <?= date("d", time()) == $key ? "selected" : "" ?>
                                                        value="<?= $key ?>"><?= $val ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="month-block">
                                        <select class="due-date-mm mrgin-left20"
                                                id="duedate_month" onchange="changeDay()">
                                            <?php
                                            $month = array();
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month[$i] = $glo_lang["thang_" . $i];
                                            }
                                            foreach ($month as $key => $val) {
                                                ?>
                                                <option <?= date("m", time()) == $key ? "selected" : "" ?>
                                                        value="<?= $key ?>"><?= $val ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="year-block">
                                        <select class="due-date-yyyy mrgin-left20" id="duedate_year">
                                            <option value="<?= date("Y", strtotime("-1 year")) ?>"><?= date("Y", strtotime("-1 year")) ?></option>
                                            <option selected value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                                            <option value="<?= date("Y", strtotime("+1 year")) ?>"><?= date("Y", strtotime("+1 year")) ?></option>
                                        </select>
                                    </div>
                                </div>
                                <p class="read-more"><a onclick="tinhNgaySinh()" class="cur"><?=$glo_lang['xem_ket_qua']?></a></p>
                            </div>
                            <div class="date-result">
                                <p class="due-congratulations-text"><?= $glo_lang['chuc_mung_be_cua_ban_da'] ?></p>
                                <p class="date-caculated"></p>
                                <p class="read-more"><a onclick="$('.date-picker-section').show();$('.calc-body-para').show();
                                $('.date-result').hide()" class="color_cam cur"><?= $glo_lang['tinh_lai'] ?></a></p>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function tinhNgaySinh() {
                            $.ajax({
                                type: "POST",
                                url: "<?=$full_url . "/tinh-ngay-sinh"?>",
                                data: {
                                    "ngay": $("#duedate_day").find(":selected").val(),
                                    "thang": $("#duedate_month").find(":selected").val(),
                                    "nam": $("#duedate_year").find(":selected").val()
                                },
                                success: function (data) {
                                    data = JSON.parse(data);
                                    $(".date-caculated").html(data.data);
                                    $(".date-result").show();
                                    $('.date-picker-section').hide();
                                    $('.calc-body-para').hide();
                                    if(data.type == 1){
                                        $('.due-congratulations-text').show();
                                    }else{
                                        $('.due-congratulations-text').hide();
                                    }
                                }
                            });
                        }
                    </script>

                <?php } ?>
                <div class="clr"></div>
                <?php
                include _source . "fb_sharelink.php";
                ?>
                <!--            --><?php //include "comment_face.php";
                ?>
            </div>
            <?php include _source . "tin_right.php"; ?>
        </div>
        <div class="clr"></div>
        <script type="text/javascript">
            function changeDay() {
                $.ajax({
                    type: "POST",
                    url: "<?=$full_url . "/lay-ngay"?>",
                    data: {
                        "thang": $("#duedate_month").find(":selected").val(),
                        "nam": $("#duedate_year").find(":selected").val()
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        $("#duedate_day").html(data.data);
                    }
                });
            }
        </script>
    <?php } ?>
</div>
