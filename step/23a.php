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
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` != ".$arr_running['id']." and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "`tenbaiviet_$lang` ASC", "", 1);
$icon_gt = '<img src="delete/tienich/icon1.png">';$class_gt = "nam";
if ($arr_running['gioitinh'] == 1){ $icon_gt = '<img src="delete/tienich/icon2.png">';$class_gt = "";}
else if ($arr_running['gioitinh'] == 2){ $icon_gt = '<img src="delete/tienich/icon3.png">';$class_gt = "trungtinh";}
else if ($arr_running['gioitinh'] == 3){ $icon_gt = '<img src="delete/tienich/icon1.png"><img src="delete/tienich/icon2.png">';$class_gt = "nam";}
?>
<!-- <li><i class="fa fa-home"></i><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a><?= GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="page_conten_page">
    <?php include _source."menu_right.php"; ?>
    <div class="pagewrap">
        <div class="tin_left">
            <div class="showText showText_add">
                <div class="resultInfo babynameFav">
                    <div class="col-eq flex">
                        <div class="lftblk">
                            <img src="delete/tienich/hi.svg" class="hi">
                            <label><?=$glo_lang['ten_toi_la']?>:</label> <span><?=$arr_running['tenbaiviet_'.$lang]?></span>
                            <div class="clearfix"></div>
                            <label><?=$glo_lang['gioi_tinh']?>:</label>
                            <?=$icon_gt?>
                            <div class="clearfix"></div>
                        </div>
                        <p class="rgtblk"><?=strip_tags($arr_running['mota_'.$lang])?></p>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <?php include _source . "fb_sharelink.php"; ?>
            <div class="resultTable babynameFav">
                <h3><?= $glo_lang['cac_ten_gan_giong'] ?></h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="20%"><?= $glo_lang['ten'] ?></th>
                        <th width="20%"><?= $glo_lang['gioi_tinh'] ?></th>
                        <th width="60%"><?= $glo_lang['y_nghia'] ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bvlienquan as $rows) {
                        $icon_gt = '<img src="delete/tienich/icon1.png">';$class_gt = "nam";
                        if ($rows['gioitinh'] == 1){ $icon_gt = '<img src="delete/tienich/icon2.png">';$class_gt = "";}
                        else if ($rows['gioitinh'] == 2){ $icon_gt = '<img src="delete/tienich/icon3.png">';$class_gt = "trungtinh";}
                        else if ($rows['gioitinh'] == 3){ $icon_gt = '<img src="delete/tienich/icon1.png"><img src="delete/tienich/icon2.png">';$class_gt = "nam";}
                        ?>
                        <tr>
                            <td class="<?= $class_gt ?>"><?= $rows['tenbaiviet_' . $lang] ?></td>
                            <td><?= $icon_gt ?></td>
                            <td><?= strip_tags($rows['mota_' . $lang]) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="clr"></div>
<!--                <div class="nums no_box">-->
<!--                    --><?//= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
<!--                    <div class="clr"></div>-->
<!--                </div>-->
<!--                <div class="clr"></div>-->
            </div>
        </div>
        <?php include _source."tin_right.php"; ?>
    </div>
    <div class="clr"></div>
</div>