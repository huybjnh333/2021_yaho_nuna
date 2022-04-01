<?php
if (!isset($_GET['edit']) && !isset($_SESSION['admin'])) LOCATION_js("index.php");
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
$table = '#_step';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);

    $seo_title_vi = @LAY_uutien($seo_title_vi, $tenbaiviet_vi);
    $seo_title_en = @LAY_uutien($seo_title_en, $tenbaiviet_en);
    $seo_title_cn = @LAY_uutien($seo_title_cn, $tenbaiviet_cn);
    $seo_title_jp = @LAY_uutien($seo_title_cn, $tenbaiviet_jp);
    $seo_description_vi = @LAY_uutien($seo_description_vi, $tenbaiviet_vi);
    $seo_description_en = @LAY_uutien($seo_description_en, $tenbaiviet_en);
    $seo_description_cn = @LAY_uutien($seo_description_cn, $tenbaiviet_cn);
    $seo_description_jp = @LAY_uutien($seo_description_cn, $tenbaiviet_jp);
    $seo_keywords_vi = @LAY_uutien($seo_keywords_vi, $tenbaiviet_vi);
    $seo_keywords_en = @LAY_uutien($seo_keywords_en, $tenbaiviet_en);
    $seo_keywords_cn = @LAY_uutien($seo_keywords_cn, $tenbaiviet_cn);
    $seo_keywords_jp = @LAY_uutien($seo_keywords_cn, $tenbaiviet_jp);

    // $num_view           = str_replace(".", "", $num_view);
    $step = isset($_POST['step']) ? $_POST['step'] : "";
}

if (!empty($_POST)) {
    $seo_name = LAY_uutien($seo_name, $tenbaiviet_vi);

    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $hinhanh_hover = UPLOAD_image("icon_hover", "../" . $duongdantin . "/", time());
    $_POST['ngaydang'] = time();
    $_POST['duongdantin'] = $duongdantin;
    $_POST['seo_title_vi'] = $seo_title_vi;
    $_POST['seo_title_en'] = $seo_title_en;
    $_POST['seo_title_cn'] = $seo_title_cn;
    $_POST['seo_title_jp'] = $seo_title_jp;
    $_POST['seo_description_vi'] = $seo_description_vi;
    $_POST['seo_description_en'] = $seo_description_en;
    $_POST['seo_description_cn'] = $seo_description_cn;
    $_POST['seo_description_jp'] = $seo_description_jp;
    $_POST['seo_keywords_vi'] = $seo_keywords_vi;
    $_POST['seo_keywords_en'] = $seo_keywords_en;
    $_POST['seo_keywords_cn'] = $seo_keywords_cn;
    $_POST['seo_keywords_jp'] = $seo_keywords_jp;

    $_POST['catasort'] = is_numeric($catasort) ? $catasort : 0;
    // $_POST['num_view']             = is_numeric($num_view) ? $num_view : 0;

    if ($step != null) {
        $_POST['step'] = $step;
    }

    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }

    if ($hinhanh != false) {
        $_POST['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
        if ($id > 0 AND is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
        }
    }
    if ($hinhanh_hover != false) {
        $_POST['icon_hover'] = $hinhanh_hover;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh_hover, "../" . $duongdantin . "/thumb_" . $hinhanh_hover, 500, 500);
        if ($id > 0 AND is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon_hover"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon_hover"]);
        }
    }
    if ($id == 0) {
        $id = ACTION_db($_POST, $table, 'add', array("themmoi"), NULL);
        $_SESSION['show_message_on'] = "Thêm module thành công!";
        THEM_seoname($id, $seo_name, $table, $id, "0");
    } else {
        ACTION_db($_POST, $table, 'update', array("themmoi"), "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật module thành công!";
        THEM_seoname($id, $seo_name, $table, $id, "1");

    }
    LOCATION_js($url_page . "&edit=" . $id);
    exit();

}
if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    $catasort = number_format($catasort, 0, ',', '.');
    // $num_view           = number_format($num_view,0,',','.');
    if ($icon != '') {
        $full_icon = $fullpath . "/" . $duongdantin . "/" . $icon;
    }
    if ($icon_hover != '') {
        $full_icon_hover = $fullpath . "/" . $duongdantin . "/" . $icon_hover;
    }

} else {
    $step = 1;
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>
<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a
                class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE]</a> <?php } ?>Main module</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý main module</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> <?= !empty($tenbaiviet_vi) ? 'Sửa' : 'Thêm' ?> main
                            module
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return CHECK_sb()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <?php
                            if (isset($_SESSION['admin'])) echo '<a href="?module=' . $module . '&action=' . $action . '&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
                            ?>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
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
                                        <label>Tên module (<?= $lang ?>)</label>
                                        <input type="text" class="form-control cls_ms"
                                               message="Bạn chưa nhập tên module!"
                                               value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                               name="tenbaiviet_<?= $lang ?>" id="tenbaiviet_<?= $lang ?>">
                                    </div>

                                    <!-- <div class="form-group">
                  <label>Tên hiển thị</label>
                  <input type="text" class="form-control" value="<?= !empty($p1_vi) ? SHOW_text($p1_vi) : '' ?>" name="p1_vi" id="p1_vi">
                </div> -->

                                    <?php if (CHECK_key_setting("main-menu-mo-ta")) { ?>
                                        <div class="form-group">
                                            <label>Mô tả (<?= $lang ?>)</label>
                                            <textarea id="p3_<?= $lang ?>" name="p3_<?= $lang ?>" class="paEditor">
                                            <?= !empty(${"p3_" . $lang}) ? SHOW_text(${"p3_" . $lang}) : "" ?>
                                        </textarea>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group">
                                            <label>Nội dung (<?= $lang ?>)</label>
                                            <textarea id="noidung_<?= $lang ?>" name="noidung_<?= $lang ?>" class="paEditor">
                                                <?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>
                                            </textarea>
                                        </div>

                                    <div class="form-group">
                                        <label>Seo Title (<?= $lang ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_<?= $lang ?>"
                                               value="<?= !empty(${"seo_title_" . $lang}) ? Show_text(${"seo_title_" . $lang}) : "" ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Description (<?= $lang ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_<?= $lang ?>"
                                               value="<?= !empty(${"seo_description_" . $lang}) ? Show_text(${"seo_description_" . $lang}) : "" ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Keywords (<?= $lang ?>)</label>
                                        <input type="text" class="form-control" name="seo_keywords_<?= $lang ?>"
                                               value="<?= !empty(${"seo_keywords_" . $lang}) ? Show_text(${"seo_keywords_" . $lang}) : "" ?>">
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
                        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
                        <input type="text" class="form-control" name="seo_name" id="seo_name"
                               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
                        <label class="noweight noweight-top checkbox-mini">
                            <input class="minimal auto_get_link"
                                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường
                            dẫn tự động
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile2">Ảnh đại
                            diện <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
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

                    <?php if($id == 10 || $id == 11 || $id == 12){ ?>
                    <div class="form-group">
                        <label for="exampleInputFile2">Ảnh trang chủ <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <input type="file" name="icon_hover" id="input_icon_hover" class="cls_hinhanh" accept="image/*"
                                       onchange="pa_previewImg(event, '#img_icon_hover','input_icon_hover');">
                                <img src="<?= @$full_icon_hover ?>" alt="" class="img_chile_dangtin"
                                     style="<?php if (!empty($full_icon_hover) && $full_icon_hover != "") echo "display: block"; else echo "display: none" ?>"
                                     id="img_icon_hover">
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                    if ($step == 5) {
                        ?>
                        <div class="form-group">
                            <label>Google map</label>
                            <input type="text" class="form-control" name="map_google" id="map_google"
                                   value="<?= !empty($map_google) ? SHOW_text($map_google) : '' ?>">
                        </div>
                        <?php
                    }
                    ?>

                    <?php if (isset($_SESSION['admin'])) { ?>
                        <div class="form-group">
                            <label>Kiểu hiển thị</label>
                            <?= DANHSACH_page(@$step, 'step', 'form-control', 0) ?>
                        </div>
                    <?php } ?>

                    <!-- <div class="form-group">
            <label>Số lượng bài viết hiển thị trên 1 trang</label>
            <input type="text" class="form-control" name="num_view" value="<?= !empty($num_view) ? SHOW_text($num_view) : "0" ?>" onkeyup="SetCurrency(this)">
          </div> -->

                    <div class="form-group">
                        <label>Số thứ tự</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= !empty($catasort) ? SHOW_text($catasort) : "0" ?>"
                               onkeyup="SetCurrency(this)">
                    </div>

                    <div class="form-group">
                        <label class="mr-20">
                            <input type="radio" name="showhi"
                                   value="1" <?= !empty($showhi) ? LAY_checked($showhi, 1) : 'checked' ?>> Hiện thị
                        </label>
                        <label>
                            <input type="radio" name="showhi"
                                   value="2" <?= !empty($showhi) ? LAY_checked($showhi, 2) : '' ?>> Ẩn
                        </label>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button onclick="return CHECK_sb()" type="submit" class="btn btn-primary"><i
                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
            <?php
            if (isset($_SESSION['admin'])) echo '<a href="?module=' . $module . '&action=' . $action . '&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
            ?>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>