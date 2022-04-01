<?php

$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }

    $catasort = str_replace(".", "", $catasort);
    $showhi = isset($_POST['showhi']) ? 1 : 0;
}

if (!empty($_POST)) {
    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $data = array();
    $data['duongdantin'] = $duongdantin;
    $data['catasort'] = $catasort;
    $data['showhi'] = $showhi;
    $data['tenbaiviet_vi'] = $tenbaiviet_vi;
    $data['tenbaiviet_en'] = $tenbaiviet_en != "" ? $tenbaiviet_en : $tenbaiviet_vi;
    $data['mota_vi'] = $mota_vi;
    $data['mota_en'] = $mota_en != "" ? $mota_en : $mota_vi;
    $data['noidung_vi'] = $noidung_vi;
    $data['noidung_en'] = $noidung_en != "" ? $noidung_en : $noidung_vi;


    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 200, 200);
        if ($id > 0) {
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            $sql_thongtin = DB_arr($sql_thongtin, 1);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
        }
    }

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm dữ liệu thành công!";
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
    }
    LOCATION_js($url_page . "&edit=" . $id);
    exit();
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);
    foreach ($sql_se as $key => $value) {
        ${$key} = $value;
    }
    $catasort = number_format($catasort, 0, ',', '.');

    if ($icon != '') {
        $icon = "<img src='../$duongdantin/thumb_$icon' width='250px' style='display:block'>";
    }
} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>

<section class="content-header">
    <h1><?= $tit_glo ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active"><?= $tit_glo ?></li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
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
                                    <label>Tên chủ đề (<?= $lang ?>) <?php if ($count_lang == 1) { ?>
                                            <a onclick="$('#tenbaiviet_<?= $lang ?>').val('Mới mua hàng')">[Mẫu]</a>
                                        <?php } ?>
                                    </label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                           name="tenbaiviet_<?= $lang ?>" id="tenbaiviet_<?= $lang ?>">
                                </div>
                                <div class="form-group">
                                    <label>Họ tên (<?= $lang ?>)</label>
                                    <input type="text" class="form-control " name="mota_<?= $lang ?>"
                                           id="mota_<?= $lang ?>"
                                           value="<?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung (<?= $lang ?>)
                                        <?php if ($count_lang == 1) { ?>
                                            <a onclick="$('#nd_mau').val('Khách hàng [hoten] vừa mới mua hàng thành công!')">[Mẫu]</a>
                                        <?php } ?>
                                    </label>
                                    <input type="text" id="<?= $count_lang == 1 ? "nd_mau" : "" ?>" class="form-control"
                                           value="<?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>"
                                           name="noidung_<?= $lang ?>">
                                </div>
                            </div>
                            <?php $count_lang++;
                        } ?>
                    </div>
                </div>
                <div class="box p10">
                    <div class="form-group">
                        <label for="exampleInputFile">Hình ảnh (200px x 200px)</label>
                        <?= !empty($icon) > 0 ? $icon : '' ?>
                        <input name="icon" type="file" class="form-control" id="exampleInputFile">
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