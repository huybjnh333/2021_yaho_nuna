<?php
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-quan-ly-ngon-ngu-add.php";
} else {
    $table = '#_clanguage';

    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 0; $i < $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];
            $tenbv_vi = $_POST["ncata_vi$i"];
            $nhom = $_POST["nhom_$i"];

            if (isset($_POST["xoa_gr_arr_$i"])) {
                DB_que("DELETE FROM $table WHERE id='" . $idofme . "' LIMIT 1", $table);
            } else {
                $where = '';
                if (isset($_SESSION['admin'])) {
                    $showhi = isset($_POST["showhi_$i"]) ? 1 : 0;
                    $where .= " , `showhi` = '$showhi' ";
                    $where .= " , `nhom`   = '$nhom' ";
                }

                foreach ($arr_lang as $rlang) {
                    if($rlang['khong_xoa'] == 1) continue;
                    $lang = $rlang['code_lang'];
                    if ($lang == "zh-CN") {
                        $lang = "cn";
                    }
                    ${"tenbv_".$lang} = $_POST["ncata_".$lang.$i];
                    $where .= ", `lang_$lang`='".${"tenbv_".$lang}."'";
                }
                DB_que("UPDATE `$table` SET `lang_vi` = '$tenbv_vi' $where WHERE `id`='$idofme' LIMIT 1", $table);
                // echo "UPDATE `$table` SET `lang_vi`='$tenbv_vi' $where WHERE `id`='$idofme' LIMIT 1 <br/>";
            }
        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }

    $arrayngonngu = array(
        // "auto" => "Phát hiện ngôn ngữ",
        "en" => "Tiếng Anh",
        "fr" => "Tiếng Pháp",
        "zh-CN" => "Tiếng Trung (Giản Thể)",
        "zh-TW" => "Tiếng Trung (Phồn thể)",
        "ko" => "Tiếng Hàn",
        "ja" => "Tiếng Nhật",
        "ar" => "Tiếng Ả Rập",
        "af" => "Tiếng Afrikaans",
        "sq" => "Tiếng Albania",
        "am" => "Tiếng Amharic",
        "hy" => "Tiếng Armenia",
        "az" => "Tiếng Azerbaijan",
        "pl" => "Tiếng Ba Lan",
        "fa" => "Tiếng Ba Tư",
        "bn" => "Tiếng Bangla",
        "eu" => "Tiếng Basque",
        "be" => "Tiếng Belarus",
        "bs" => "Tiếng Bosnia",
        "pt" => "Tiếng Bồ Đào Nha",
        "bg" => "Tiếng Bulgaria",
        "ca" => "Tiếng Catalan",
        "ceb" => "Tiếng Cebuano",
        "co" => "Tiếng Corsica",
        "hr" => "Tiếng Croatia",
        "iw" => "Tiếng Do Thái",
        "da" => "Tiếng Đan Mạch",
        "de" => "Tiếng Đức",
        "et" => "Tiếng Estonia",
        "tl" => "Tiếng Filipino",
        "fy" => "Tiếng Frisia",
        "gd" => "Tiếng Gael Scotland",
        "gl" => "Tiếng Galician",
        "ka" => "Tiếng Georgia",
        "gu" => "Tiếng Gujarati",
        "nl" => "Tiếng Hà Lan",
        "ht" => "Tiếng Haiti",

        "ha" => "Tiếng Hausa",
        "haw" => "Tiếng Hawaii",
        "hi" => "Tiếng Hindi",
        "hmn" => "Tiếng Hmong",
        "hu" => "Tiếng Hungary",
        "el" => "Tiếng Hy Lạp",
        "is" => "Tiếng Iceland",
        "ig" => "Tiếng Igbo",
        "id" => "Tiếng Indonesia",
        "ga" => "Tiếng Ireland",
        "it" => "Tiếng Italy",
        "jv" => "Tiếng Java",
        "kn" => "Tiếng Kannada",
        "kk" => "Tiếng Kazakh",
        "km" => "Tiếng Khmer",
        "ku" => "Tiếng Kurd",
        "ky" => "Tiếng Kyrgyz",
        "la" => "Tiếng La-tinh",
        "lo" => "Tiếng Lào",
        "lv" => "Tiếng Latvia",
        "lt" => "Tiếng Litva",
        "lb" => "Tiếng Luxembourg",
        "ms" => "Tiếng Mã Lai",
        "mk" => "Tiếng Macedonia",
        "mg" => "Tiếng Malagasy",
        "ml" => "Tiếng Malayalam",
        "mt" => "Tiếng Malta",
        "mi" => "Tiếng Maori",
        "mr" => "Tiếng Marathi",
        "my" => "Tiếng Miến Điện",
        "mn" => "Tiếng Mông Cổ",
        "no" => "Tiếng Na Uy",
        "ne" => "Tiếng Nepal",
        "ru" => "Tiếng Nga",

        "ny" => "Tiếng Nyanja",
        "ps" => "Tiếng Pashto",

        "fi" => "Tiếng Phần Lan",
        "pa" => "Tiếng Punjab",
        "eo" => "Tiếng Quốc Tế Ngữ",
        "ro" => "Tiếng Romania",
        "sm" => "Tiếng Samoa",
        "cs" => "Tiếng Séc",
        "sr" => "Tiếng Serbia",
        "sn" => "Tiếng Shona",
        "sd" => "Tiếng Sindhi",
        "si" => "Tiếng Sinhala",
        "sk" => "Tiếng Slovak",
        "sl" => "Tiếng Slovenia",
        "so" => "Tiếng Somali",
        "st" => "Tiếng Sotho Miền Nam",
        "su" => "Tiếng Sunda",
        "sw" => "Tiếng Swahili",
        "tg" => "Tiếng Tajik",
        "ta" => "Tiếng Tamil",
        "es" => "Tiếng Tây Ban Nha",
        "te" => "Tiếng Telugu",
        "th" => "Tiếng Thái",
        "tr" => "Tiếng Thổ Nhĩ Kỳ",
        "sv" => "Tiếng Thụy Điển",

        "uk" => "Tiếng Ucraina",
        "ur" => "Tiếng Urdu",
        "uz" => "Tiếng Uzbek",
        "vi" => "Tiếng Việt",
        "cy" => "Tiếng Wales",
        "xh" => "Tiếng Xhosa",
        "yi" => "Tiếng Yiddish",
        "yo" => "Tiếng Yoruba",
        "zu" => "Tiếng Zulu"
    );
    ?>
    <section class="content-header">
        <h1>Danh sách ngôn ngữ</h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Quản lý ngôn ngữ</li>
        </ol>
    </section>

    <?php if (isset($_SESSION['admin'])) { ?>
        <script>
            function ADD_ngonngu_lang(js_key, ngon_ngu_add, tenbv_vi, key, rong) {
                console.log(tenbv_vi);
                $.ajax({
                    type: "POST", url: "index.php", data: {'ajax_action': 'get_language', 'tenbaiviet_vi': tenbv_vi},
                    success: function (data) {
                        console.log(data)
                        try {
                            data = JSON.parse(data);
                            var check = $('input[name="ncata_' + js_key + key + '"]').val();
                            if ($('input[name="ncata_' + js_key + key + '"]').length > 0) {
                                if (rong == 1 || (rong == 0 && check == "")) {
                                    <?php
                                    foreach ($array_dich as $key => $val) {
                                        echo 'if(\'' . $key . '\' == js_key) {
                                                $(\'input[name="ncata_\'+js_key+key+\'"]\').val(data.' . $key . ');
                                          }';
                                    }
                                    ?>
                                }
                            }
                        } catch (e) {
                            console.log(data);
                        }
                    }
                });
            }
        </script>
    <?php } ?>
    <?php
    if (isset($_POST['add_language'])) {
        $js_key = $_POST['js_key'];
        $ngon_ngu_add = $_POST['ngon_ngu_add'];
        $n_lang_rong = $_POST['n_lang_rong'];
        $time_doi = 3000; //1s

        if ($ngon_ngu_add != "") {
            for ($i = 0; $i < $_REQUEST['maxvalu']; $i++) {

                $tenbv_vi = $_POST["ncata_vi$i"];
                $tenbv_noew = $_POST["ncata_" . $js_key . $i];
                if ($n_lang_rong == 1 || ($n_lang_rong == 0 && $tenbv_noew == '')) {
                    $time_doi = $time_doi + $i * 50;
                    echo '<script>setTimeout(function(){ ADD_ngonngu_lang("' . $js_key . '","' . $ngon_ngu_add . '","' . $tenbv_vi . '", ' . $i . ', ' . $n_lang_rong . ') }, ' . $time_doi . ') </script>';
                }

            }
        }
    }
    ?>
    <form action="" method="post">
        <!-- //ngon ngu -->
        <?php if (isset($_SESSION['admin'])) { ?>
            <div style="margin: 20px 20px 0;">
                <input type="text" name="js_key" placeholder="Key Add"
                       style="width: 250px; border: 1px solid #e0dddd; padding: 0 6px; height: 30px;">
                <select name="ngon_ngu_add"
                        style="width: 250px; border: 1px solid #e0dddd; padding: 0 6px; height: 30px;">
                    <option value="">Chọn ngôn ngữ</option>
                    <?php foreach ($arrayngonngu as $key => $value) {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    } ?>
                </select>
                <select name="n_lang_rong" id=""
                        style="width: 250px; border: 1px solid #e0dddd; padding: 0 6px; height: 30px;">
                    <option value="0">Chỉ rổng</option>
                    <option value="1">Tất cả</option>
                </select>
                <input class="btn btn-primary" type="submit" value="Add lang" name="add_language">
            </div>
        <?php } ?>
        <!-- end -->
        <input type="hidden" name="token" value="<?= GET_token() ?>">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> Danh sách
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Thêm mới</a>
                                    <?php
                                }
                                ?>
                            </h3>
                        </div>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <div style="margin: 10px 10px 0;">
                                <label style="margin-right: 10px">
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="0"> Mặc định [0]
                                </label>
                                <label style="margin-right: 10px">
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="1"> Thành viên [1]
                                </label>
                                <label style="margin-right: 10px">
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="2"> Giỏ hàng [2]
                                </label>
                                <label>
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="3"> Sản phẩm [3]
                                </label>
                                <label>
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="4"> Đăng ký nhận mail
                                    [4]
                                </label>
                                <label>
                                    <input class="minimal check_js_ngonngu" type="checkbox" data="5"> Khác [5]
                                </label>
                                <script>
                                    $(document).on("click", ".check_js_ngonngu", function () {
                                        var num = $(this).attr('data');
                                        $('.is_check_' + num).prop('checked', $(this).prop("checked"));
                                    });
                                </script>
                            </div>
                        <?php } ?>
                        <div class="box-body table-responsive no-padding table-danhsach-cont">
                            <table class="table table-hover table-danhsach">
                                <tbody>
                                <tr>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th class="w50 text-center">
                                            <label>
                                                <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                            </label>
                                        </th>
                                    <?php } ?>
                                    <th class="w80 text-center">STT</th>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th>Mã ngôn ngữ</th>
                                    <?php } ?>

                                    <?php
                                    foreach ($arr_lang as $rows) {
                                        $lang = $rows['code_lang'];
                                        if ($lang == "zh-CN") {
                                            $lang = "cn";
                                        }
                                        ?>
                                        <th>Ngôn ngữ (<?= $lang ?>)</th>
                                    <?php } ?>

                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th class="w90 text-center">Hiển thị</th>
                                        <th class="w90 text-center">Nhóm</th>
                                    <?php } ?>
                                    <th class="w100 text-center">Tác vụ</th>
                                </tr>
                                <?php
                                $where = ' WHERE `showhi` = 1';
                                if (isset($_SESSION['admin'])) {
                                    $where = "";
                                }
                                $sql = DB_que("SELECT * FROM `$table` $where ORDER BY `showhi` DESC,`nhom` ASC, `id` ASC");
                                $cl = 0;
                                $sql = DB_arr($sql);
                                foreach ($sql as $rows) {
                                    $ida = $rows['id'];
                                    $code_lang = SHOW_text($rows['code_lang']);
                                    foreach ($arr_lang as $rlang) {
                                        $lang = $rlang['code_lang'];
                                        if ($lang == "zh-CN") {
                                            $lang = "cn";
                                        }
                                        ${"text_lang_" . $lang} = SHOW_text($rows['lang_' . $lang]);
                                    }

                                    $showhi = SHOW_text($rows['showhi']);
                                    $nhom = SHOW_text($rows['nhom']);
                                    ?>
                                    <tr>
                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td class="text-center">
                                                <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                       class='minimal cls_showxoa'>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <?= $cl + 1 ?>
                                        </td>
                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td><?= $code_lang ?></td>
                                        <?php } ?>

                                        <?php
                                        foreach ($arr_lang as $rlang) {
                                            $lang = $rlang['code_lang'];
                                            if ($lang == "zh-CN") {
                                                $lang = "cn";
                                            }
                                            ?>
                                            <td>
                                                <div class="name">
                                                    <input type="text" name="ncata_<?= $lang.$cl ?>"
                                                           value="<?= ${"text_lang_" . $lang} ?>"
                                                           onchange="UPDATE_colum(this, '<?= $ida ?>', 'lang_<?= $lang ?>','<?= $table ?>')">
                                                </div>
                                            </td>
                                        <?php } ?>

                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td class="text-center">
                                                <div id="cus" class="cus_menu">
                                                    <label>
                                                        <input type="checkbox"
                                                               class='minimal is_check_<?= !empty($nhom) ? $nhom : 0 ?>'
                                                               name="showhi_<?= $cl ?>"
                                                               value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="nhom_<?= $cl ?>"
                                                       value="<?= !empty($nhom) ? $nhom : 0 ?>">
                                            </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="<?= $url_page ?>&edit=<?= $ida ?>"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            <?php if (isset($_SESSION['admin'])) { ?>
                                                <a href="<?= $url_page ?>&del=ok&catalogid=<?= $ida ?>&token=<?= GET_token() ?>"
                                                   class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                            class="fa fa-times"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $cl++;
                                } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Thêm mới</a>
                                <?php } ?>
                            </h3>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>