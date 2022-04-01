<?php
$table = '#_mangxahoi';
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
    $data['duongdantin'] = @$duongdantin;
    $data['fontawesome'] = @$fontawesome;
    $data['background'] = @$background;
    $data['seo_name'] = @$seo_name;
    $data['catasort'] = is_numeric($catasort) ? $catasort : 0;
    $data['showhi'] = is_numeric($showhi) ? $showhi : 0;
    $data['tenbaiviet_vi'] = @$tenbaiviet_vi;
    $data['tenbaiviet_en'] = @$tenbaiviet_en;

    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }

    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
        }
    }


    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm mạng xã hội thành công!";
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật mạng xã hội thành công!";
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
        $full_icon = $fullpath . "/" . $duongdantin . "/" . $icon;
    }
} else {
    $catasort = layCatasort($table);
    $catasort = number_format($catasort, 0, ',', '.');
}
?>

<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN
            NGỮ]</a><?php } ?>Danh sách mạng xã hội</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Mạng xã hội</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i><?= $id > 0 ? 'Sửa' : 'Thêm' ?> mạng xã hội
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
                            if ($rows['code_lang'] == "zh-CN") {
                                $rows['code_lang'] = "cn";
                            }
                            ?>
                            <div class="tab-pane <?= $count_lang == 1 ? "active" : "" ?>" id="tab_<?= $count_lang ?>">
                                <div class="form-group">
                                    <label>Tên chủ đề (<?= $rows['code_lang'] ?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty(${"tenbaiviet_" . $rows['code_lang']}) ? ${"tenbaiviet_" . $rows['code_lang']} : "" ?>"
                                           name="tenbaiviet_<?= $rows['code_lang'] ?>"
                                           id="tenbaiviet_<?= $rows['code_lang'] ?>">
                                </div>
                            </div>
                            <?php $count_lang++;
                        } ?>
                    </div>
                </div>

                <div class="box p10">
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <label><input type='checkbox' class='minimal minimal_click' colum="mxh_is_anh" idcol="1"
                                      table="#_seo" value='1' <?= LAY_checked($thongtin['mxh_is_anh'], 1) ?>> Check ảnh</label>
                    <?php } ?>
                    <?php if ($thongtin['mxh_is_anh']) { ?>
                        <div class="form-group">
                            <label for="exampleInputFile2">Ảnh đại diện </label>
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
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <label><input type='checkbox' class='minimal minimal_click' colum="mxh_is_css" idcol="1"
                                      table="#_seo" value='1' <?= LAY_checked($thongtin['mxh_is_css'], 1) ?>> Check css</label>
                    <?php } ?>
                    <?php if ($thongtin['mxh_is_css']) { ?>
                        <div class="form-group">
                            <label>Fontawesome</label>
                            <input type="text" class="form-control icon_add" name="fontawesome"
                                   value="<?= !empty($fontawesome) ? Show_text($fontawesome) : "" ?>">
                            <div class="dv-cont-showicon">
                                <label>
                                    <a onclick="$('.dv-show-icon').toggle()"><i class="fa fa-plus "></i> Chọn icon</a>
                                    <i class="<?= !empty($fontawesome) ? SHOW_text($fontawesome) : '' ?>"
                                       id="show_icon_fa"></i>
                                </label>
                                <div class="dv-show-icon">
                                    <?php $id_add = ".icon_add";
                                    include _source . "fa_assom.php"; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <label><input type='checkbox' class='minimal minimal_click' colum="mxh_is_bg" idcol="1"
                                      table="#_seo" value='1' <?= LAY_checked($thongtin['mxh_is_bg'], 1) ?>> Check
                            BG</label>
                    <?php } ?>
                    <?php if ($thongtin['mxh_is_bg']) { ?>
                        <div class="form-group">
                            <label>Background</label>
                            <input type="text" class="form-control" name="background" id="background"
                                   value="<?= !empty($background) ? Show_text($background) : "" ?>">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Liên kết</label>
                        <input type="text" class="form-control" name="seo_name" id="seo_name"
                               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
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