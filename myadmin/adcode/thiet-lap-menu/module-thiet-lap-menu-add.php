<?php
$table = '#_menu';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);
    $showhi = isset($_POST['showhi']) ? 1 : 0;
    $cua_so_moi = isset($_POST['cua_so_moi']) ? 1 : 0;

}
if (!empty($_POST)) {
    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $icon_hover = UPLOAD_image("icon_hover", "../" . $duongdantin . "/", time());
    $data = array();
    $data['catasort'] = is_numeric(@$catasort) ? @$catasort : 0;
    $data['showhi'] = is_numeric(@$showhi) ? @$showhi : 0;
    $data['cua_so_moi'] = is_numeric(@$cua_so_moi) ? @$cua_so_moi : 0;;
    $data['id_parent'] = is_numeric(@$id_parent) ? @$id_parent : 0;
    $data['tenbaiviet_vi'] = @$tenbaiviet_vi;
    $data['tenbaiviet_en'] = @$tenbaiviet_en;
    $data['tenbaiviet_cn'] = @$tenbaiviet_cn;
    $data['tenbaiviet_jp'] = @$tenbaiviet_jp;
    $data['seo_name'] = @$seo_name;
    $data['step'] = is_numeric(@$step) ? @$step : 0;
    $data['danhmuc'] = is_numeric(@$danhmuc) ? @$danhmuc : 0;
    $data['kieu_hien_thi'] = is_numeric(@$kieu_hien_thi) ? @$kieu_hien_thi : 0;
    $data['kieu_chon'] = is_numeric(@$kieu_chon) ? @$kieu_chon : 0;
    $data['duongdantin'] = @$duongdantin;

    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['edit'] . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }
    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 200, 200);
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
            //end
        }
    }

    if ($icon_hover != false) {
        $data['icon_hover'] = $icon_hover;
        TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumb_" . $icon_hover, 200, 200);
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon_hover"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon_hover"]);
        }
    }

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Th??m menu th??nh c??ng!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = '" . $id . "'");
        $_SESSION['show_message_on'] = "C???p nh???t menu th??nh c??ng!";
    }
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }
    $catasort = number_format($catasort, 0, ',', '.');
    if ($icon != '') {
        $full_icon = $fullpath . "/" . $duongdantin . "/" . $icon;
    }
    if ($icon_hover != '') {
        $full_icon_hover = $fullpath . "/" . $duongdantin . "/" . $icon_hover;
    }
} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>
<style>
    .nhom_module_menu_hide {
        display: none !important
    }
</style>
<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NG??N
            NG???]</a><?php } ?>Thi???t l???p menu</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang ch???</a></li>
        <li class="active">Thi???t l???p menu</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> <?= $id > 0 ? 'S???a' : 'Th??m' ?> menu
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Th??m m???i</a>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tho??t</a>

                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source . "lang.php" ?>
                        <div class="tab-content">
                            <?php
                            $count_lang = 1;
                            foreach ($arr_lang as $rows) {
                                if ($rows['code_lang'] == "zh-CN") {
                                    $rows['code_lang'] = "cn";
                                }
                                ?>
                                <div class="tab-pane <?= $count_lang == 1 ? "active" : "" ?>" id="tab_<?= $count_lang ?>">
                                    <div class="form-group">
                                        <label>T??n menu (<?= $rows['code_lang'] ?>)</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty(${"tenbaiviet_" . $rows['code_lang']}) ? ${"tenbaiviet_" . $rows['code_lang']} : ""  ?>"
                                               name="tenbaiviet_<?= $rows['code_lang'] ?>"
                                               id="tenbaiviet_<?= $rows['code_lang'] ?>">
                                    </div>
                                </div>
                                <?php $count_lang++;
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10">
                    <div class="form-group">
                        <label>Lo???i menu</label>
                        <?= LAY_menu(@$id_parent, 'id_parent', 'form-control', 0, $id_step, $id, 'true') ?>
                    </div>
                    <div class="form-group">
                        <label>S??? th??? t???</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini noweight">
                            <input class="minimal auto_menu_lienket" type="radio" name="kieu_chon"
                                   value="0" <?= !isset($kieu_chon) || $kieu_chon == 0 ? 'checked="checked"' : '' ?>>
                            Nh???p li??n k???t
                        </label>
                        <label class="mr-20 checkbox-mini noweight">
                            <input class="minimal auto_menu_module" type="radio" name="kieu_chon"
                                   value="1" <?= isset($kieu_chon) && $kieu_chon == 1 ? 'checked="checked"' : '' ?>>
                            Ch???n module
                        </label>
                    </div>

                    <div class="form-group form-group-none nhom_lienket">
                        <label>Li??n k???t <a data-tooltip="N???u Link ?????n URL c???a Web kh??c th?? ph???i c?? http:// ??? ?????u."> </a></label>
                        <input type="text" class="form-control" name="seo_name" id="seo_name"
                               value="<?= !empty($seo_name) ? SHOW_text($seo_name) : '' ?>">
                    </div>
                    <div class="form-group form-group-none nhom_module_menu">
                        <label>Module <a data-tooltip="L???y li??n k???t theo module ch???n."> </a></label>
                        <select name="step" class="form-control" onchange="LOAD_danhmuc_mn(this)">
                            <option value="0">Ch???n module</option>
                            <?php
                            $loaibanner = DB_que('SELECT * FROM `#_step` WHERE `showhi` = 1 ORDER BY `catasort` ASC');
                            $loaibanner = DB_arr($loaibanner);
                            foreach ($loaibanner as $r) {
                                echo '<option value="' . $r['id'] . '" ' . LAY_selected($r['id'], $step) . '>' . $r['tenbaiviet_vi'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- danh muc -->
                    <?php if (admin_check(@$thongtin['menu_danhmuc'])) { ?>
                        <div class="form-group form-group-none nhom_module_menu">
                            <?= admin_input("menu_danhmuc", @$thongtin['menu_danhmuc'], "#_seo", 1) ?>

                            <label>Danh m???c <a data-tooltip="L???y li??n k???t theo danh m???c ch???n."> </a></label>
                            <select name="danhmuc" class="form-control form-control-dm-menu">
                                <option value="0">Ch???n danh m???c</option>
                                <?php
                                if (!empty($step) && $step != 0) {
                                    $chude_arr = DB_fet("*", "#_danhmuc", "`showhi` = '1' AND `step` = " . $step . "", "`catasort` ASC", "", "arr");
                                    foreach ($chude_arr as $row_1) {
                                        if ($row_1['id_parent'] != 0) continue;
                                        echo '<option value="' . $row_1['id'] . '" ' . LAY_selected($row_1['id'], @$danhmuc) . '>' . $row_1['tenbaiviet_vi'] . '</option> ';
                                        foreach ($chude_arr as $row_2) {
                                            if ($row_2['id_parent'] != $row_1['id']) continue;
                                            echo '<option value="' . $row_2['id'] . '" ' . LAY_selected($row_2['id'], @$danhmuc) . '>?????????' . $row_2['tenbaiviet_vi'] . '</option> ';
                                            foreach ($chude_arr as $row_3) {
                                                if ($row_3['id_parent'] != $row_2['id']) continue;
                                                echo '<option value="' . $row_3['id'] . '" ' . LAY_selected($row_3['id'], @$danhmuc) . '> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????????' . $row_3['tenbaiviet_vi'] . '</option> ';
                                                foreach ($chude_arr as $row_4) {
                                                    if ($row_4['id_parent'] != $row_3['id']) continue;
                                                    echo '<option value="' . $row_4['id'] . '" ' . LAY_selected($row_4['id'], @$danhmuc) . '> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????????' . $row_4['tenbaiviet_vi'] . '</option> ';

                                                }
                                            }
                                        }
                                    }
                                } else if (!empty($step) && $step != -1) {
                                    $baiviet_arr = DB_fet("*", "#_baiviet", "`showhi` = '1' AND `step` = 0", "`catasort` DESC", "", "arr");
                                    foreach ($baiviet_arr as $row_1) {
                                        echo '<option value="' . $row_1['id'] . '" ' . LAY_selected($row_1['id'], @$danhmuc) . '>' . $row_1['tenbaiviet_vi'] . '</option> ';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    <?php } ?>
                    <!-- end  -->
                    <!-- kieu hien thi -->
                    <?php if (admin_check(@$thongtin['menu_kieuhienthi'])) { ?>
                        <div class="form-group form-group-none nhom_module_menu">
                            <?= admin_input("menu_kieuhienthi", @$thongtin['menu_kieuhienthi'], "#_seo", 1) ?>

                            <label>Ki???u hi???n th??? <a
                                        data-tooltip="T?? ?????ng hi???n th??? c??c c???p con c???a danh m???c ho???c danh s??ch b??i vi???t c???a danh m???c."> </a></label>
                            <select name="kieu_hien_thi" class="form-control">
                                <option value="0" <?= LAY_selected(0, @$kieu_hien_thi) ?>>Ch???n ki???u hi???n th???</option>
                                <option value="1" <?= LAY_selected(1, @$kieu_hien_thi) ?>>T??? ?????ng theo danh m???c</option>
                                <!-- <option value="3" <?= LAY_selected(3, @$kieu_hien_thi) ?>>T??? ?????ng theo danh m???c ngang</option> -->
                                <option value="2" <?= LAY_selected(2, @$kieu_hien_thi) ?>>T??? ?????ng theo b??i vi???t</option>
                            </select>
                        </div>
                    <?php } ?>
                    <!-- hinh anh -->
                    <?php if (admin_check(@$thongtin['menu_hinhanh'])) { ?>
                        <div class="form-group">
                            <?= admin_input("menu_hinhanh", @$thongtin['menu_hinhanh'], "#_seo", 1) ?>
                            <?= admin_input_text("menu_hinhanh_size", @$thongtin['menu_hinhanh_size'], "#_seo", 1) ?>
                            <label for="exampleInputFile">
                                H??nh ?????i di???n <?= $thongtin['menu_hinhanh_size'] ?>
                            </label>
                            <div class="dv-anh-chitiet-img-cont">
                                <div class="dv-anh-chitiet-img">
                                    <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                    <input type="file" name="icon" id="input_icon" class="cls_hinhanh" accept="image/*"
                                           onchange="pa_previewImg(event, '#img_icon','input_icon');">
                                    <img src="<?= @$full_icon ?>" alt="" class="img_chile_dangtin"
                                         style="<?php if (!empty($full_icon) && $full_icon != "") echo "display: block"; else echo "display: none" ?>"
                                         id="img_icon">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- end -->
                    <!-- hinh anh hv-->
                    <?php if (admin_check(@$thongtin['menu_hinhanh_hv'])) { ?>
                        <div class="form-group">
                            <?= admin_input("menu_hinhanh_hv", @$thongtin['menu_hinhanh_hv'], "#_seo", 1) ?>
                            <label for="exampleInputFile">
                                H??nh thay ?????i <?= $thongtin['menu_hinhanh_size'] ?>
                            </label>
                            <div class="dv-anh-chitiet-img-cont">
                                <div class="dv-anh-chitiet-img">
                                    <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                    <input type="file" name="icon_hover" id="input_icon_icon_hover" class="cls_hinhanh"
                                           accept="image/*"
                                           onchange="pa_previewImg(event, '#icon_hover','input_icon_icon_hover');">
                                    <img src="<?= @$full_icon_hover ?>" alt="" class="img_chile_dangtin"
                                         style="<?php if (!empty($full_icon_hover) && $full_icon_hover != "") echo "display: block"; else echo "display: none" ?>"
                                         id="icon_hover">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- end -->
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini noweight" style="display: block; margin-bottom: 10px">
                            <input type="checkbox" name="cua_so_moi"
                                   class="minimal" <?= isset($cua_so_moi) && $cua_so_moi == 1 ? 'checked="checked"' : '' ?>>
                            Hi???n th??? c???a s??? m???i
                        </label>
                        <label class="mr-20 checkbox-mini noweight">
                            <input type="checkbox" name="showhi"
                                   class="minimal" <?= isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>>
                            Hi???n th???
                        </label>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Th??m m???i</a>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tho??t</a>
        </h3>
    </div>
</form>

<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val() == '') {
            alert("H??y nh???p t??n menu!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        return true;
    }
</script>