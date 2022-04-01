<?php

$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);
    $showhi = isset($_POST['showhi']) ? 1 : 0;

}


if (!empty($_POST)) {
    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());

    $data = array();
    $data['tenbaiviet_vi'] = $tenbaiviet_vi;
    $data['tenbaiviet_en'] = $tenbaiviet_en;
    $data['noidung_vi'] = $noidung_vi;
    $data['noidung_en'] = $noidung_en;
    $data['catasort'] = $catasort;
    $data['showhi'] = $showhi;
    $data['id_parent'] = $id_parent;
    $data['seo_name'] = $seo_name;
    $data['seo_name_1'] = $seo_name_1;
    $data['blank'] = $blank;
    $data['blank_1'] = $blank_1;
    $data['duongdantin'] = $duongdantin;
    $data['ma_quang_cao'] = $ma_quang_cao;
    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 100, 100);
        if ($id > 0) {
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            $sql_thongtin = DB_arr($sql_thongtin, 1);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
            //end
        }
    }

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm dữ liệu thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
    }
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);

    foreach ($sql_se as $key => $value) {
        if ($key == "ma_quang_cao") {
            $ma_quang_cao = $sql_se['ma_quang_cao'];
        } else {
            ${$key} = SHOW_text($value);
        }

    }
    if ($icon != '') {
        $full_icon = $fullpath . "/" . $duongdantin . "/" . $icon;
    }
} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>

<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a
                class="js_okkk" style="cursor: pointer;"
                onclick="OKKK_by_lh()">[UPDATE] </a> <?php } ?><?= $full_name ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active"><?= $full_name ?></li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i><?= $id > 0 ? 'Sửa' : 'Thêm mới' ?>
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Thêm mới</a>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="nav-tabs-custom" style="margin-bottom: 0;">
                    <?php include _source . "lang.php" ?>
                    <div class="tab-content">
                        <?php
                        $count_lang = 1;
                        foreach ($arr_lang as $rows) {
                            $lang = $rows['code_lang'];
                            if ($lang == "zh-CN") {
                                $lang = "cn";
                            }
                            ?>
                            <div class="tab-pane <?= $count_lang == 1 ? "active" : "" ?>" id="tab_<?= $count_lang ?>">
                                <div class="form-group">
                                    <label>Tiêu đề (<?= $lang ?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                           name="tenbaiviet_<?= $lang ?>" id="tenbaiviet_<?= $lang ?>">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả (<?= $lang ?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>"
                                           id="noidung_<?= $lang ?>" name="noidung_<?= $lang ?>">
                                </div>
                            </div>
                        <?php $count_lang++;} ?>
                    </div>
                </div>
                <div class="box p10">
                    <div class="form-group" style="display:none">
                        <label for="exampleInputFile2">Hình ảnh</label>
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
                    <div class="form-group" style="display: none">
                        <label>Mã quảng cáo </label>
                        <textarea name="ma_quang_cao" class="form-control"
                                  style="height: 400px"><?= !empty($ma_quang_cao) ? $ma_quang_cao : "" ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link (có) <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
                        <input type="text" class="form-control" name="seo_name" id="seo_name"
                               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
                    </div>
                    <div class="form-group">
                        <label>Target (có)</label>
                        <select name="blank" id="blank" class="form-control">
                            <option value="" <?= LAY_selected(@$blank, "") ?>>Mặc định</option>
                            <option value="_blank" <?= LAY_selected(@$blank, "_blank") ?>>Cửa sổ mới</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Link (không) <a
                                    data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
                        <input type="text" class="form-control" name="seo_name_1" id="seo_name_1"
                               value="<?= !empty($seo_name_1) ? Show_text($seo_name_1) : "" ?>">
                    </div>
                    <div class="form-group">
                        <label>Target (không)</label>
                        <select name="blank_1" id="blank_1" class="form-control">
                            <option value="" <?= LAY_selected(@$blank_1, "") ?>>Mặc định</option>
                            <option value="_blank" <?= LAY_selected(@$blank_1, "_blank") ?>>Cửa sổ mới</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none">
                        <label>Option thuộc</label>
                        <select name="id_parent" id="id_parent" class="form-control">
                            <?php if ((isset($id_parent) && $id_parent == 0) || isset($_SESSION['admin'])) { ?>
                                <option value="0">Chọn chủ đề con</option>
                            <?php } ?>
                            <?php
                            $list_array = DB_fet("*", "#_thuoctinhchung", "", "`catasort` ASC", "", "arr");
                            foreach ($list_array as $val) {
                                if ($val['id_parent'] != 0) continue;
                                echo '<option value="' . $val['id'] . '" ' . (($id_parent == $val['id']) ? 'selected="selected"' : '') . ' ' . (($id == $val['id']) ? 'disabled="disabled"' : '') . '>' . $val['tenbaiviet_vi'] . '</option>';
                                foreach ($list_array as $val_2) {
                                    if ($val_2['id_parent'] != $val['id']) continue;
                                    echo '<option disabled="disabled" value="' . $val_2['id'] . '">==> ' . $val_2['tenbaiviet_vi'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Số thứ tự</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="showhi"
                                   class="minimal" <?= isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>>
                            Hiển thị
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
            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>
<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val() == '') {
            $("#tenbaiviet_vi").focus();
            return false;
        }
        return true;
    }
</script>