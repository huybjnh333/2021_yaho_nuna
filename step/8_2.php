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
$wh2 = "";
if ($lay_all_kx != "") {
    $wh2 = " AND `id_parent` in (" . $lay_all_kx . ") ";
}
$nd_tieubieu = LAY_baiviet($slug_step, 1, "`opt` = 1 $wh2");
if (!empty($nd_tieubieu)) {
    $nd_tieubieu = reset($nd_tieubieu);
    $wh .= " AND `id` NOT IN (" . $nd_tieubieu['id'] . ") ";
}

include _source . "phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";

// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search != "") {
    $link_p = '<span>/</span><a>' . $glo_lang['tim_kiem'] . "</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p = GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
}

// full_src($thongtin_step, '')
$tenvideo = "";
$id_video = "";
foreach ($nd_kietxuat as $rows) {
    $tenvideo = $rows['tenbaiviet_' . $lang];
    $id_video = $rows['p1'];
    break;
}
include _source . "box-header.php";
?>


<div class="page_conten_page">
    <div class="pagewrap">
        <div class="tin_left">
            <?php
            if (!empty($nd_tieubieu)) {
                ?>
                <div class="new_top_id new_top_id_video">
                    <div class="one_new_home">
<!--                        <iframe width="100%" height="300"-->
<!--                                src="https://www.youtube.com/embed/--><?//= @GET_ID_youtube($nd_tieubieu['p1']) ?><!--"-->
<!--                                frameborder="0"-->
<!--                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"-->
<!--                                allowfullscreen></iframe>-->
                        <video width="100%" height="300" controls   >
                            <source src="<?=$nd_tieubieu['p1'] ?>" type="video/mp4">
                            <source src="<?=$nd_tieubieu['p1'] ?>" type="video/webm">
                        </video>
                        <div class="clr"></div>
                    </div>
                    <div class="one_new_home_right">
                        <div class="title_news">
                            <h2><?= SHOW_text($nd_tieubieu["tenbaiviet_" . $lang]) ?></h2>
                            <li><?= fullDate($nd_tieubieu['ngaydang'], $glo_lang) ?></li>
                            <div class="clr"></div>
                        </div>
                        <p><?= strip_tags($nd_tieubieu['mota_' . $lang]) ?></p>
                    </div>
                    <div class="clr"></div>
                </div>
            <?php } ?>
            <div class="tt_page tt_page_video flex">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    $i = 0;
                    foreach ($nd_kietxuat as $rows) {
                        $i++;
                        // if($i == 1) continue;
                        ?>
                        <div class="new_id_bs">
                            <li><a class="cur" onclick="LOAD_video_youtube('<?= $rows['p1'] ?>',)">
                                    <?= full_img($rows) ?></a></li>
                            <ul>
                                <h3><a class="cur limit-row-3"
                                       onclick="LOAD_video_youtube('<?=$rows['p1'] ?>')">
                                        <?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                            </ul>
                            <div class="clr"></div>
                        </div>
                    <?php }
                } ?>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="nums no_box">
                <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                <div class="clr"></div>
            </div>
        </div>
        <?php include _source . "tin_right.php"; ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

<div class="dv-idvideo-youtube-cont" onclick="close_video_tb()">
    <div class="dv-idvideo-youtube">
<!--        <iframe id="player" allow="autoplay; encrypted-media" frameborder="0" allowfullscreen=""-->
<!--                data-gtm-yt-inspected-1070012_61="true" data-gtm-yt-inspected-1070012_79="true"></iframe>-->
        <a class="close_vdeo" onclick="close_video_tb()"></a></div>
</div>
<script>
    function close_video_tb() {
        // $(".dv-idvideo-youtube iframe").attr("src", "");
        $(".dv-idvideo-youtube video").remove("");
        $(".dv-idvideo-youtube").hide();
        $(".dv-idvideo-youtube-cont").removeClass('actii');
        // $(".dv-idvideo-youtube iframe").attr("src", "");
        $(".dv-idvideo-youtube video").remove("");
    }

    function LOAD_video_youtube(id) {
        if (id == "") {
            // alert(text);
            $(".dv-idvideo-youtube").hide();
            $(".dv-idvideo-youtube-cont").removeClass('actii');
        } else {
            // $(".dv-idvideo-youtube iframe").attr("src", "https://www.youtube.com/embed/" + id + "?autoplay=1&amp;enablejsapi=1&amp;rel=0&amp;ytp-pause-overlay=0&amp;v=" + id);
            $(".dv-idvideo-youtube").append("<video id='my-video' class='video-js' controls" +
                " preload='none' width='100%' height='auto' data-setup='{}' playsinline autoplay >" +
                "<source src='" + id + "' type='video/mp4' /><source src='" + id + "' type='video/webm' /></video>");
            $(".dv-idvideo-youtube").show();
            $(".dv-idvideo-youtube-cont").addClass('actii');
        }
    }
</script>