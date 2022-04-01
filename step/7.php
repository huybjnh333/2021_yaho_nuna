<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 12;
else $numview = $thongtin_step['num_view'];

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = isset($_GET['key']) ? true : false;

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $slug_step = "1,3,4";
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
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%')";
}

// //check tieu thuyet
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}
//

include _source . "phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";

// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search != "") {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
}
include _source."box-header.php";

// full_src($thongtin_step, '')
?>

<div class="pagewrap page_conten_page">
    <div class="showText">
        <table class="tbl_down table-responsive" cellpadding="0" cellspacing="0">
            <tbody>
            <tr class="title">
                <th width="15%"><?= $glo_lang['stt'] ?></th>
                <th><?= $glo_lang['ten_file'] ?></th>
                <th class="text-center"><?= $glo_lang['tai_ve'] ?></th>
                <th><?=$glo_lang['ngay_thang_nam']?></th>
                <th><?=$glo_lang['mota']?></th>
            </tr>
            <?php
            if ($nd_total == 0) {
                echo "<tr><td colspan='3'><div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div></td></tr>";
            } else {
            $i = 0;
            foreach ($nd_kietxuat as $rows) {
            $i++;
            // $icon = '<i class="fa fa-file-excel-o"></i>';
            // $link = "";
            // if($rows['dowload'] != ""){
            //   $link = $fullpath."/datafiles/files/".$rows['dowload'];
            //   $ex = explode(".",$rows['dowload']);
            //   $ex = end($ex);
            //   if($ex == "pdf") $icon = '<i class="fa fa-file-pdf-o"></i>';
            //   else if($ex == "doc" || $ex == "docx") $icon = '<i class="fa fa-file-word-o"></i>';
            // }

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
            <tr>
                <td data-title="<?=$glo_lang['stt']?>" class="text-center"><?= ($pzer - 1) * $numview + $i ?></td>
                <td data-title="<?= $glo_lang['ten_file'] ?>"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></td>
                <td data-title="<?= $glo_lang['tai_ve'] ?>" class="text-center"><a target="_blank"
                            href="<?= $link ?>" <?= $target ?>><?= $glo_lang['tai_ve'] ?></a></td>
                <td data-title="<?= $glo_lang['ngay_thang_nam'] ?>"><?=date("d/m/Y",$rows['ngaydang'])?></td>
                <td data-title="<?= $glo_lang['mota'] ?>"><?=strip_tags($rows['mota_'.$lang])?></td>
            </tr>
            <?php }
            } ?>
            </tbody>
        </table>
        <div class="nums no_box">
            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
            <div class="clr"></div>
        </div>
    </div>
    <?php include _source . "fb_sharelink.php"; ?>
</div>
