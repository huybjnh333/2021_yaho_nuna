<?php
error_reporting(0);
include("config/sql.php");
if (!isset($_SESSION['onlyone_time'])) $_SESSION['onlyone_time'] = time();
define("luu_lai", "Lưu lại");
define("_source", "adcode/");
define("_lang_nb1", "Việt Nam");
define("_lang_nb1_key", "vi");

define("_lang_nb2", "English");
define("_lang_nb2_key", "en");
// define("_lang_nb3", "Chinese");
// define("_lang_nb3_key", "cn");
// define("_lang_nb4", "Japan");
// define("_lang_nb4_key", "jp");

$arr_lang = DB_fet_rd("*","#_module_ngonngu","","`sort` ASC, `id` ASC");
$translate_lang = array();
$lang_kx = array_pop(array_reverse($arr_lang));
$lang_kx = $lang_kx['code_lang'];
foreach ($arr_lang as $rlang) {
    $lang = $rlang['code_lang'];
    if ($lang == 'zh-CN') {
        $lang = 'cn';
    }
    if ($lang_kx == $lang) continue;
    array_push($translate_lang, $lang);
}

//làm thêm lang hiên tại để thay thongtin_step ở step (important)

$array_dich = array("en" => "en", "cn" => "zh-CN");

// @include _source."editor.php";
$module = isset($_GET['module']) ? $_GET['module'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$step = isset($_GET['step']) ? $_GET['step'] : '';
$id_step = isset($_GET['id_step']) ? $_GET['id_step'] : '';

$url_page = "?module=$module&action=$action";

$danhsach_define = DB_fet("*", "`#_clanguage_admin`", "", "", "", "arr");
$glo_admin = array();
foreach ($danhsach_define as $rows) {
    $glo_admin[$rows['code_lang']] = $rows['lang_' . $_SESSION['admin_lang']];
}

$module_setting = DB_que("SELECT * FROM `#_module_setting`");
$module_setting = DB_arr($module_setting);
foreach ($module_setting as $rows) {
    if ($rows['id'] == 38) $array_only_bv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 39) $array_tn = explode(",", $rows['ten_key']);
    if ($rows['id'] == 43) $danhmuc_slider = explode(",", $rows['ten_key']);
    if ($rows['id'] == 46) $st_dowload_fl = explode(",", $rows['ten_key']);
    if ($rows['id'] == 47) $st_danhmuc_mt = explode(",", $rows['ten_key']);
    if ($rows['id'] == 48) $st_danhmuc_nd = explode(",", $rows['ten_key']);
    if ($rows['id'] == 49) $st_nhom_opt = explode(",", $rows['ten_key']);
    if ($rows['id'] == 50) $st_nhom_opt1 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 51) $st_nhom_opt2 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 69) $st_nhom_opt3 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 70) $st_nhom_opt4 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 71) $st_nhom_opt5 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 52) $st_bv_mota = explode(",", $rows['ten_key']);
    if ($rows['id'] == 53) $st_bv_noidung = explode(",", $rows['ten_key']);
    if ($rows['id'] == 55) $st_an_nhom_bv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 11) $check_sp_hove = explode(",", $rows['ten_key']);
    if ($rows['id'] == 59) $check_img_step = explode(",", $rows['ten_key']);
    if ($rows['id'] == 57) $check_video = explode(",", $rows['ten_key']);
    if ($rows['id'] == 54) $st_anhmenu = $rows['ten_key'];
    if ($rows['id'] == 60) $check_anh_dm = explode(",", $rows['ten_key']);
    if ($rows['id'] == 61) $check_anh_dm_hv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 63) $sl_quanlybaiviet = explode(",", $rows['ten_key']);
    if ($rows['id'] == 62) $name_list_opti = $rows['ten_key'];
    if ($rows['id'] == 64) $name_list_opti_tn = $rows['ten_key'];
    if ($rows['id'] == 65) $st_nhom_opt_tn_1 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 66) $st_nhom_opt_tn_2 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 67) $st_nhom_opt_tn_3 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 68) $array_tn_nhomgia = explode(",", $rows['ten_key']);
    if ($rows['id'] == 72) $array_tn_option_p1 = explode(",", $rows['ten_key']);

}

include _source . 'post.php';
//check login IP
if (!empty($_SESSION['luluwebproadmin'])) {
    $check_iplogin = DB_que("SELECT * FROM `#_members` WHERE `id`='" . $_SESSION['luluwebproadmin'] . "' AND `ip_login` = '" . GET_ip() . "' LIMIT 1");
    // if(!DB_num($check_iplogin)) {
    //   unset($_SESSION['luluwebproadmin']);
    //   ALERT_js("Tài khoản được đăng nhập từ nơi khác!");
    //   LOCATION_js($fullpath."/myadmin/");
    // }
    $check_iplogin = DB_arr($check_iplogin, 1);
}
//
//check quyen
include _source . 'phan_quyen.php';
//xoa cache
if (isset($_GET['clear']) && $_GET['clear'] == "cache") {
    XOA_all_file('../datafiles/cache');
    $_SESSION['show_message_on'] = "Đã xóa cache thành công!";
    LOCATION_js("index.php");
    exit();
}
//
//lay danh sach menu
$list_tn = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi`= 1 ORDER BY `sort` ASC");
$md_tinhnang = array();
$list_tn = DB_arr($list_tn);

foreach ($list_tn as $r) {
    $md_tinhnang[$r['m_action']] = $r;
}
//
$lang_nb2 = CHECK_key_setting("ngon-ngu-tieng-anh");
$lang_nb3 = CHECK_key_setting("them-ngon-ngu-thu-3");
$lang_nb4 = CHECK_key_setting("them-ngon-ngu-thu-4");
if (isset($_POST['pass_tool_check']) && $_POST['pass_tool_check'] == "b5a7e60d31d536e73f6c43fc084b1f3f") {
    $_SESSION['admin'] = "true";

}

if (isset($_GET['adminpa']) && empty($_SESSION['admin'])) {
    ?>
    <form method="post" action="">
        <label>
            <input type="password" name="pass_tool_check" id="pass_tool_check" placeholder="Nhập mật khẩu ...">
            <button type="submit" onclick="return CHECK_adminpa()">Update</button>
        </label>
    </form>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="js/md5.js"></script>
    <script type="text/javascript">function CHECK_adminpa() {
            $("#pass_tool_check").val(MD5($("#pass_tool_check").val()));
            return true;
        }
    </script>
    <?php exit();
} ?>

<!DOCTYPE html>
<html>
<head>
    <?php include _source . "head.php"; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini" style="margin: 0">
<div class="wrapper">
    <header class="main-header">
        <?php include _source . "header.php"; ?>
    </header>
    <aside class="main-sidebar">
        <?php include _source . "main_sidebar.php"; ?>
    </aside>
    <div class="content-wrapper">
        <?php
        if ($module != '') {
            if (is_file(_source . $action . "/module-" . $action . ".php"))
                include _source . $action . "/module-" . $action . ".php";
            else {
                include _source . "home.php";
            }
        } else {
            include _source . "home.php";
        }

        ?>
    </div>
    <footer class="main-footer">
        Thiết kế và phát triển bởi P.A VietNam Ltd.
    </footer>
</div>
<?php include _source . "js_files.php"; ?>
<?php include _source . "mesages.php"; ?>
<script>
    function AUTO_dich(obj) {
        if ($('input[name="tencongty_<?=$lang_kx?>"]').length > 0) {
            var tenbaiviet_vi = $('input[name="tencongty_<?=$lang_kx?>"]').val();
        } else if ($('input[name="tenbaiviet_<?=$lang_kx?>"]').length > 0) {
            var tenbaiviet_vi = $('input[name="tenbaiviet_<?=$lang_kx?>"]').val();
        } else {
            console.log("rong");
            return;
        }
        $.ajax({
            type: "POST", url: "index.php", data: {'ajax_action': 'get_language', 'tenbaiviet_vi': tenbaiviet_vi},
            success: function (data) {
                try {
                    data = JSON.parse(data);
                    <?php
                    foreach ($translate_lang as $val) {
                        echo 'if($(\'input[name="tencongty_' . $lang_kx . '"]\').length > 0) {
                           $(\'input[name="tencongty_' . $val . '"]\').val(data.' . $val . ');
                        }';
                        echo 'if($(\'input[name="tenbaiviet_' . $lang_kx . '"]\').length > 0) {
                           $(\'input[name="tenbaiviet_' . $val . '"]\').val(data.' . $val . ');
                        }';
                    }
                    ?>
                    $(obj).html("[OK]");
                } catch (e) {
                }
                console.log(data)
            }
        });

        //dia chi
        if ($('input[name="diachi_<?=$lang_kx?>"]').length > 0) {
            var tenbaiviet_<?=$lang_kx?> = $('input[name="diachi_<?=$lang_kx?>"]').val();
            $.ajax({
                type: "POST", url: "index.php", data: {'ajax_action': 'get_language', 'tenbaiviet_vi': tenbaiviet_<?=$lang_kx?>},
                success: function (data) {
                    try {
                        data = JSON.parse(data);
                        <?php
                        foreach ($translate_lang as $val) {
                            echo '$(\'input[name="diachi_' . $val . '"]\').val(data.' . $val . ');';
                        }
                        ?>
                        $(obj).html("[OK]");
                    } catch (e) {
                        console.log(data)
                    }
                }
            });
        }

        //
    };

    function OKKK_by_lh() {
        if ($('input[name="tenbaiviet_<?=$lang_kx?>"]').length > 0)
            var tenbaiviet_<?=$lang_kx?> = $('input[name="tenbaiviet_<?=$lang_kx?>"]').val();
        else
            var tenbaiviet_<?=$lang_kx?> = $('input[name="tencongty_<?=$lang_kx?>"]').val();

        $('input[name="seo_title_<?=$lang_kx?>"]').val(tenbaiviet_<?=$lang_kx?>);
        $('input[name="seo_description_<?=$lang_kx?>"]').val(tenbaiviet_<?=$lang_kx?>);
        $('input[name="seo_keywords_<?=$lang_kx?>"]').val(tenbaiviet_<?=$lang_kx?>);
        <?php
            foreach ($arr_lang as $rlang){
                if($rlang['khong_xoa'] == 1) continue;
                $lang = $rlang['code_lang'];
                if ($lang == "zh-CN") {
                    $lang = "cn";
                }
        ?>
        if ($('input[name="tenbaiviet_<?=$lang_kx?>"]').length > 0)
            var tenbaiviet_<?=$lang?> = $('input[name="tenbaiviet_<?=$lang?>"]').val();
        else
            var tenbaiviet_<?=$lang?> = $('input[name="tencongty_<?=$lang?>"]').val();
        $('input[name="seo_title_<?=$lang?>"]').val(tenbaiviet_<?=$lang?>);
        $('input[name="seo_description_<?=$lang?>"]').val(tenbaiviet_<?=$lang?>);
        $('input[name="seo_keywords_<?=$lang?>"]').val(tenbaiviet_<?=$lang?>);
        <?php } ?>
        var str = convertVietnamese2(tenbaiviet_<?=$lang_kx?>);
        $("#seo_name").val(str);
        $(".js_okkk").html("[OK]");
    }
</script>

</body>
</html>
