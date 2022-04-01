<?php
//
if (isset($_POST['btn_dangbinhluan'])) {
    // if(isset($_POST['btn_dangbinhluan']) && isset($_SESSION['id'])) {
    if ($_SESSION['capmd5'] == $_POST['checkcapbl'] || $_SESSION['capmd6'] == $_POST['checkcapbl_new']) {
        $noidung_bl = isset($_POST['noidung_bl']) ? $_POST['noidung_bl'] : "";
        $tenbinhluan_bl = isset($_POST['tenbinhluan_bl']) ? $_POST['tenbinhluan_bl'] : "";
        $sodienthoai_bl = isset($_POST['sodienthoai_bl']) ? $_POST['sodienthoai_bl'] : "";
        $loai_binhluan = isset($_POST['loai_binhluan']) ? $_POST['loai_binhluan'] : 0;
        if ($noidung_bl != "") {
            $data = array();
            $data['id_sp'] = $arr_running['id'];
            $data['ip_gui'] = GET_ip();
            $data['uid'] = @!empty($_SESSION['id']) ? $_SESSION['id'] : 0;
            $data['tenbaiviet_vi'] = LOC_char($tenbinhluan_bl);
            $data['sodienthoai'] = LOC_char($sodienthoai_bl);
            $data['noidung_vi'] = LOC_char($noidung_bl);
            $data['loai_binhluan'] = LOC_char($loai_binhluan);
            $data['showhi'] = 0;
            $data['ngay_dang'] = time();
            $data['id_parent'] = isset($_POST['id_parent']) ? $_POST['id_parent'] : 0;


            ACTION_db($data, "#_binhluan", "add", NULL);
            ALERT_js($glo_lang['binh_luan_da_duoc_gui']);
            LOCATION_js($full_url . "/" . $motty . "/");
            exit();
        }
    }
}

//
$numview = 10;
$pzer = 1;
$vi_tri = PHANTRANG_start($pzer, $numview);
$pzz = 0;

$nd_kietxuat_bl = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0   AND `loai_binhluan` = 0 ORDER BY `id` DESC LIMIT $vi_tri,$numview");
$nd_total = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0  AND `loai_binhluan` = 0 ");

$numlist = @mysqli_num_rows($nd_total);
$numshow = ceil($numlist / $numview);
$sotrang = PHANTRANG_findPages($numlist, $numview);

$numlist_list = DB_que("SELECT `id` FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "'");
$numlist_list = mysqli_num_rows($numlist_list);
?>
<div class="box_page_id box_view_more" id="danhgia_nhatxer">
    <div class="title_page_home">
        <h3><?= $glo_lang['danh_gia_nhan_xet'] ?></h3>
        <div class="clr"></div>
    </div>
    <div class="page_more">
        <div class="danhgia_tringbinh">
<!--            <span class="heading">--><?//= $glo_lang['danh_gia_trung_binh'] ?><!--</span>-->
            <p>
                <?php
//                $dtb = str_replace("[diem]", $arr_running['num_1'], $glo_lang['trung_binh_diem_danh_gia']);
                $sao = 0;
                if($arr_running['num_2'] != 0) $sao = round((float)($arr_running['num_1']/$arr_running['num_2']));
                $dtb = str_replace("[diem]", $sao, $glo_lang['trung_binh_diem_danh_gia']);
                $dtb = str_replace("[luot]", $arr_running['num_2'], $dtb);
                echo $dtb. " : ";

                for ($i=1; $i <= 5; $i++) {
                    echo '<span style="margin: 0 3px;" data-sao="'.($arr_running['num_2'] == 0 ? 0 : round((float)($arr_running['num_1']/$arr_running['num_2']))).'" class="fa fa-star ad_sao '.($sao >= $i ? "checked" : "").' "></span>';
                }

                $nam_sao = 0;
                $nam_sao_sao = 0;

                $bon_sao = 0;
                $bon_sao_sao = 0;

                $ba_sao = 0;
                $ba_sao_sao = 0;

                $hai_sao = 0;
                $hai_sao_sao = 0;

                $mot_sao = 0;
                $mot_sao_sao = 0;
                $chitiet_sao = DB_que("SELECT * FROM `#_baiviet_sao` WHERE `id_baiviet` = '" . $arr_running['id'] . "' LIMIT 1");
                if (mysqli_num_rows($chitiet_sao)) {
                    $chitiet_sao = mysqli_fetch_assoc($chitiet_sao);
                    $nam_sao = number_format($chitiet_sao['sao_5']);
                    $nam_sao_sao = $chitiet_sao['sao_5'] / $arr_running['num_2'] * 100;

                    $bon_sao = number_format($chitiet_sao['sao_4']);
                    $bon_sao_sao = $chitiet_sao['sao_4'] / $arr_running['num_2'] * 100;

                    $ba_sao = number_format($chitiet_sao['sao_3']);
                    $ba_sao_sao = $chitiet_sao['sao_3'] / $arr_running['num_2'] * 100;

                    $hai_sao = number_format($chitiet_sao['sao_2']);
                    $hai_sao_sao = $chitiet_sao['sao_2'] / $arr_running['num_2'] * 100;

                    $mot_sao = number_format($chitiet_sao['sao_1']);
                    $mot_sao_sao = $chitiet_sao['sao_1'] / $arr_running['num_2'] * 100;
                }
                ?>
            </p>
        </div>
        <!--<div class="row danhgia_tringbinh_sao">
            <div class="side">
                <div>5 <?= $glo_lang['sao'] ?></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-5" style="width: <?= $nam_sao_sao ?>%"></div>
                </div>
            </div>
            <div class="side right">
                <div><?= $nam_sao ?></div>
            </div>
            <div class="side">
                <div>4 <?= $glo_lang['sao'] ?></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-4" style="width: <?= $bon_sao_sao ?>%"></div>
                </div>
            </div>
            <div class="side right">
                <div><?= $bon_sao ?></div>
            </div>
            <div class="side">
                <div>3 <?= $glo_lang['sao'] ?></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-3" style="width: <?= $ba_sao_sao ?>%"></div>
                </div>
            </div>
            <div class="side right">
                <div><?= $ba_sao ?></div>
            </div>
            <div class="side">
                <div>2 <?= $glo_lang['sao'] ?></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-2" style="width: <?= $hai_sao_sao ?>%"></div>
                </div>
            </div>
            <div class="side right">
                <div><?= $hai_sao ?></div>
            </div>
            <div class="side">
                <div>1 <?= $glo_lang['sao'] ?></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-1" style="width: <?= $mot_sao_sao ?>%"></div>
                </div>
            </div>
            <div class="side right">
                <div><?= $mot_sao ?></div>
            </div>
        </div>-->
        <div class="comment_pro">
            <!--            <h2>--><? //= $glo_lang['khach_hang_nhan_xet'] ?><!--</h2>-->
            <div class="dv-js-binhluan dv-js-binhluan-0">
                <?php
                function shhow_color($key)
                {
                    $key = strtolower($key);
                    if ($key == "a") return "aquamarine";
                    if ($key == "b") return "burlyWood";
                    if ($key == "c") return "cadetBlue";
                    if ($key == "d") return "darkCyan";
                    if ($key == "f") return "fuchsia";
                    if ($key == "g") return "goldenRod";
                    if ($key == "h") return "hotPink";
                    if ($key == "i") return "indianRed";
                    if ($key == "k") return "khaki";
                    if ($key == "l") return "lightBlue";
                    if ($key == "m") return "mediumOrchid";
                    if ($key == "n") return "navy";
                    if ($key == "o") return "orangeRed";
                    if ($key == "p") return "peru";
                    if ($key == "r") return "rosyBrown";
                    if ($key == "s") return "salmon";
                    if ($key == "t") return "teal";
                    if ($key == "v") return "violet";
                    if ($key == "y") return "yellowGreen";
                    return "#FF9800";
                }

                while ($rows = mysqli_fetch_assoc($nd_kietxuat_bl)) {
                    ?>
                    <ul>
                        <li style="background: <?= shhow_color(substr(strip_tags($rows['tenbaiviet_vi']), 0, 1)) ?>;">
                            <a><?= substr(strip_tags($rows['tenbaiviet_vi']), 0, 1) ?></a></li>
                        <h3><a><?= SHOW_text($rows['tenbaiviet_vi']) ?></a></h3>
                        <h4 class="ngaydang"><?= CHECK_phut($rows['ngay_dang'], $glo_lang) ?></h4>
                        <div class="clr"></div>
                        <p><?= SHOW_text(strip_tags($rows['noidung_vi'])) ?></p>
                        <?php if (!empty($_SESSION['luluwebproadmin'])) { ?>
                            <h4><a class="cur"
                                   onclick="$('.js_id_parent').val('<?= $rows['id'] ?>'); GOTO_sport2('.js_replyall')"><?= $glo_lang['tra_loi'] ?></a>
                            </h4>
                        <?php } ?>
                        <div class="clr"></div>
                        <script type="text/javascript">
                            function GOTO_sport2(cls) {
                                var target = $(cls);
                                if (target.length) {
                                    $('html, body').animate({
                                        scrollTop: target.offset().top - 90
                                    }, 700);
                                }
                            }
                        </script>
                        <?php
                        $nd_kietxuat_bl_child = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = '" . $rows['id'] . "'   AND `loai_binhluan` = 0 ORDER BY `id` ASC");
                        while ($rows_2 = mysqli_fetch_assoc($nd_kietxuat_bl_child)) {
                            ?>
                            <div class="box_child">
                                <ul>
                                    <li style="background: <?= shhow_color(substr(strip_tags($rows['tenbaiviet_vi']), 0, 1)) ?>;">
                                        <a><?= substr(strip_tags($rows_2['tenbaiviet_vi']), 0, 1) ?></a></li>
                                    <h3><a><?= SHOW_text($rows_2['tenbaiviet_vi']) ?></a></h3>
                                    <h4 class="ngaydang"><?= CHECK_phut($rows_2['ngay_dang'], $glo_lang) ?></h4>
                                    <div class="clr"></div>
                                    <p><?= SHOW_text(strip_tags($rows_2['noidung_vi'])) ?></p>
                                </ul>
                            </div>
                        <?php } ?>
                    </ul>

                <?php } ?>
            </div>

        </div>
        <div class="clr"></div>
        <?php if ($numlist > $numview) { ?>
            <div class="button_readmore">
                <a class='cur'
                   onclick="LOAD_ajax_binhluan('<?= $full_url ?>/load-binhluan/','<?= $numlist ?>','<?= $numview ?>', 0, '<?= $arr_running['id'] ?>', 0)"><?= $glo_lang['doc_them_binh_luan'] ?>
                    <img src="images/loading2.gif" class="ajax_img_loading"></a>
            </div>
        <?php } ?>
        <div class="boxComment_danhgia js_replyall">
            <form action="" method="post">
                <input type="hidden" name="id_parent" class="js_id_parent" value="0">
                <h3 class="heading"><?= $glo_lang['gui_nhan_xet_cua_ban'] ?></h3>
                <li><?= $glo_lang['danh_gia_sp_nay'] ?>: <p
                            style="display: inline-block;"><?= GET_sao_sp($arr_running['num_1'], $arr_running['num_2'], $arr_running['id']) ?></p>
                </li>
                <!--                <li>--><? //= $glo_lang['tieu_de_cua_nhan_xet'] ?><!-- (*):</li>-->
                <div class="col-md-1 row-frm">
                    <input type="text" name="tenbinhluan_bl" class="js_check_null_1 form-control"
                           placeholder="<?= $glo_lang['ho_va_ten'] ?>">
                </div>
                <div class="col-md-1 row-frm">
                    <input type="text" name="sodienthoai_bl" class="js_sodienthoai_bl form-control js_check_null_5"
                           placeholder="<?= $glo_lang['so_dien_thoai'] ?>">
                </div>
                <!--                <li>--><? //= $glo_lang['viet_nhan_xet'] ?><!-- (*):</li>-->
                <div class="col-md-1 row-frm">
                    <textarea name="noidung_bl" class="form-control js_check_null_2"
                              style="height:80px; padding-top:15px;"
                              placeholder="<?= $glo_lang['viet_danh_gia'] ?>"></textarea>
                    <h4>
                        <input type="hidden" name="loai_binhluan" value="0">
                        <input type="hidden" name="checkcapbl" value="<?= $_SESSION['capmd5'] = md5(time()) ?>">
                        <button type="submit" class="dangbt_btn" name="btn_dangbinhluan"
                                onclick="return check_nhanxet('.js_check_null_1', '.js_check_null_2')"><?= $glo_lang['dang_binh_luan'] ?></button>
                    </h4>
                    <div class="clr"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if (0) { ?>
    <div class="box_view_more" id="hoi_dap">
        <div class="titile_page_id">
            <ul>
                <h3><?= $glo_lang['hoi_dap'] ?></h3>
                <div class="clr"></div>
            </ul>
        </div>
        <div class="page_more js_replyall">
            <div class="boxComment_danhgia">
                <h3><?= $glo_lang['gui_cau_hoi_cua_ban'] ?></h3>
                <div class="col-md row-frm ">
                    <form action="" method="post">
                        <input type="text" name="tenbinhluan_bl" class="js_tenbinhluan_bl form-control js_check_null_4"
                               placeholder="<?= $glo_lang['ho_va_ten'] ?>" style="margin-bottom: 10px">
                        <textarea class="form-control js_check_null_3" name="noidung_bl"
                                  style="height:80px; padding-top:15px;"
                                  placeholder="<?= $glo_lang['viet_binh_luan_cua_ban'] ?>"></textarea>
                        <input type="hidden" name="loai_binhluan" value="1">
                        <input type="hidden" name="id_parent" class="js_id_parent" value="0">
                        <input type="hidden" name="checkcapbl_new" value="<?= $_SESSION['capmd6'] = md5(time()) ?>">
                        <h4>
                            <button type="submit" class="dangbt_btn" name="btn_dangbinhluan"
                                    onclick="return check_nhanxet('.js_check_null_4', '.js_check_null_3')"><?= $glo_lang['gui_cau_hoi'] ?></button>
                        </h4>
                    </form>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="dv-js-binhluan-1">
                <?php
                $nd_kietxuat_bl = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0   AND `loai_binhluan` = 1 ORDER BY `id` DESC LIMIT $vi_tri,$numview");
                $nd_total = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0  AND `loai_binhluan` = 1 ");

                $numlist = @mysqli_num_rows($nd_total);
                $numshow = ceil($numlist / $numview);
                $sotrang = PHANTRANG_findPages($numlist, $numview);

                while ($rows = mysqli_fetch_assoc($nd_kietxuat_bl)) {
                    ?>
                    <div class="box_dg_ch">
                        <div class="name_coment">
                            <li><?= substr(strip_tags($rows['tenbaiviet_vi']), 0, 1) ?></li>
                            <ul>
                                <h3><?= SHOW_text(strip_tags($rows['tenbaiviet_vi'])) ?>
                                    <span><?= CHECK_phut($rows['ngay_dang'], $glo_lang) ?></span></h3>
                                <p><?= SHOW_text(strip_tags($rows['noidung_vi'])) ?></p>
                                <?php if (!empty($_SESSION['luluwebproadmin'])) { ?>
                                    <h4><a class="cur"
                                           onclick="$('.js_id_parent').val('<?= $rows['id'] ?>');$('.js_tenbinhluan_bl').val('Admin'); GOTO_sport('.js_replyall')"><?= $glo_lang['tra_loi'] ?></a>
                                    </h4>
                                <?php } ?>
                            </ul>
                            <div class="clr"></div>
                        </div>
                        <?php
                        $nd_kietxuat_bl_child = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = '" . $rows['id'] . "'   AND `loai_binhluan` = 1 ORDER BY `id` ASC");
                        while ($rows_2 = mysqli_fetch_assoc($nd_kietxuat_bl_child)) {
                            ?>
                            <div class="box_admin_cm">
                                <div class="name_coment name_coment_2">
                                    <li class="admin_images"><?= substr(strip_tags($rows_2['tenbaiviet_vi']), 0, 1) ?></li>
                                    <ul>
                                        <h3><?= SHOW_text(strip_tags($rows_2['tenbaiviet_vi'])) ?>
                                            <span><?= CHECK_phut($rows_2['ngay_dang'], $glo_lang) ?></span></h3>
                                        <p><?= SHOW_text(strip_tags($rows_2['noidung_vi'])) ?></p>
                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if ($numlist > $numview) { ?>
                    <div class="button_readmore">
                        <a class='cur'
                           onclick="LOAD_ajax_binhluan('<?= $full_url ?>/load-binhluan/','<?= $numlist ?>','<?= $numview ?>', 0, '<?= $arr_running['id'] ?>', 1)"><?= $glo_lang['doc_them_binh_luan'] ?>
                            <img src="images/loading2.gif" class="ajax_img_loading"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function check_nhanxet(cls1, cls2, cls3) {
        if ($(cls1).val() == '') {
            $(cls1).focus();
            return false;
        }
        if ($(cls2).val() == '') {
            $(cls2).focus();
            return false;
        }
        if ($(cls3).val() == '') {
            $(cls3).focus();
            return false;
        }
        return true;
    }
</script>

<style>
    .col-md-1.row-frm {
        margin-bottom: 10px;
    }

    .title_page_home h3 {
        text-align: center;
        margin-right: 20px;
        font-size: 24px;
        color: #333;
        line-height: 62px;
        font-weight: 600;
        padding-left: 0;
        text-transform: Uppercase;
        font-family: 'Open Sans Condensed', Arial, Helvetica, Tahoma, sans-serif;
    }

    .heading {
        font-size: 18px;
        font-weight: 500;
        text-transform: uppercase;
        color: #8dc63f;
    }

    .danhgia_tringbinh p {
        font-size: 17px;
        padding-bottom: 15px;
        padding-top: 0;
        color: #666;
    }

    .row {
        margin-bottom: 20px;
    }

    .side {
        float: left;
        width: 8%;
        margin-top: 10px;
        font-size: 15px;
    }

    .middle {
        float: left;
        width: 84%;
        margin-top: 10px;
        background: #f1f1f1;
    }

    .right {
        text-align: right;
    }

    .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
    }

    /* Individual bars */
    .bar-5 {
        width: 60%;
        height: 18px;
        background-color: #ffa500;
        float: left;
        max-width: 100% !important;
    }

    .bar-4 {
        width: 30%;
        height: 18px;
        background-color: #2196F3;
        float: left;
        max-width: 100% !important;
    }

    .bar-3 {
        width: 10%;
        height: 18px;
        background-color: #00bcd4;
        float: left;
        max-width: 100% !important;
    }

    .bar-2 {
        width: 4%;
        height: 18px;
        background-color: #369a00;
        float: left;
        max-width: 100% !important;
    }

    .bar-1 {
        width: 15%;
        height: 18px;
        background-color: #f44336;
        float: left;
        max-width: 100% !important;
    }

    .comment_pro {
        text-align: center;
        float: left;
        width: 100%;
    }

    .comment_pro h2 {
        display: inline-table;
        font-size: 23px;
        color: #333;
        margin-bottom: 15px;
        line-height: 35px;
        font-weight: 600;
        text-transform: uppercase;
        font-family: 'Open Sans Condensed', Arial, Helvetica, Tahoma, sans-serif;
    }

    }
    .boxComment_danhgia h3 {
        border-bottom: solid #ccc 1px;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 18px;
        text-transform: uppercase;
        line-height: 30px;
        color: #8dc63f;
        font-weight: 500;
    }

    .boxComment_danhgia li {
        padding-bottom: 10px;
        font-size: 17px;
        color: #333;
        list-style: none;
        font-weight: 500;
    }

    .col-md-3 {
        width: 100%;
        margin-bottom: 15px;
    }

    .form-control_3 {
        display: block;
        width: 100%;
        height: 45px;
        padding: 5px 15px;
        font-size: 17px;
        line-height: 1.42857143;
        color: #999;
        background-image: none;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        border: 1px solid #ccc;
        font-family: 'Roboto Condensed', Arial, Helvetica, Tahoma, sans-serif;
        resize: vertical;
        box-sizing: border-box;
    }

    .boxComment_danhgia h4 a, .boxComment_danhgia h4 button {
        float: right;
        display: block;
        font-size: 18px;
        font-weight: normal;
        text-transform: uppercase;
        line-height: 35px;
        padding: 5px 40px;
        margin-top: 20px;
        color: #fff;
        cursor: pointer;
        background: #8dc63f;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        -o-border-radius: 50px;
        -ms-border-radius: 50px;
        border: double #ffffff 4px;
        transition: color .33s cubic-bezier(.33, 0, .2, 1) 0s, fill .33s cubic-bezier(.33, 0, .2, 1) 0s, background .33s cubic-bezier(.33, 0, .2, 1) 0s;
        -moz-transition: color .33s cubic-bezier(.33, 0, .2, 1) 0s, fill .33s cubic-bezier(.33, 0, .2, 1) 0s, background .33s cubic-bezier(.33, 0, .2, 1) 0s;
    }

    .comment_pro ul li {
        float: left;
        list-style: none;
        width: 25px;
    }

    .comment_pro ul h3 {
        float: left;
        padding-left: 10px;
        font-size: 19px;
        font-weight: 500;
        text-transform: capitalize;
        color: #323232;
        line-height: 24px;
    }

    .comment_pro ul p {
        padding-top: 5px;
        font-size: 15px;
        font-weight: normal;
        color: #6e6e6e;
        text-align: left;
        line-height: 25px;
    }

    .comment_pro ul h4 {
        float: right!important;
        padding-top: 0px;
        font-size: 15px!important;
        font-weight: normal;
        text-transform: capitalize;
        color: #6e6e6e;
        width: 100% !important;
        text-align: right;
    }

    .comment_pro ul .ngaydang {
        width: unset!important;
    }

    .dv-js-binhluan > ul {
        border-top: solid #CCC 1px;
        margin-top: 15px;
        padding-top: 15px;
    }

    .box_child {
        display: block;
        position: relative;
        margin: 5px 0 0 0;
        padding: 10px 15px 10px 12px;
        clear: both;
        font-size: 14px;
        color: #333;
        line-height: 24px;
        background: #f8f8f8;
        border: 1px solid #dfdfdf;
    }
    .box_child ul:after, .box_child ul:before {
        top: -22px;
        left: 18px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    .box_child ul:before {
        border-color: rgba(238,238,238,0);
        border-bottom-color: #e4e1e1;
        border-width: 11px;
        margin-left: -11px;
        z-index: 1;
    }
    .boxComment_danhgia{margin-top: 10px;}
    .checked {
        color: orange;
    }
</style>