<?php
$duongdantin = "images/flag";
$table = '#_module_ngonngu';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key}           = $value;
    }
//    $sort = @$_REQUEST['sort'];
//    $icon = @$_REQUEST['icon'];
    $sort   = str_replace(".", "", @$sort);
    $showhi = isset($_POST['showhi']) ? 1 : 0;

}

if (!empty($_POST)) {
    $data = array();
    $data['tenbaiviet']         = @$tenbaiviet;
//    $data['tenbaiviet_en']         = @$tenbaiviet_en;
//    $data['tenbaiviet_cn']         = @$tenbaiviet_cn;

    $data['code_lang']         = @$code_lang;

    $data['sort'] = $sort;
    $data['showhi'] = $showhi;
//    $data['icon'] = $icon;
    $data['duongdantin'] = $duongdantin;

    $hinhanh                        = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }
    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
        }
    }

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);

        $_SESSION['show_message_on'] = "Thêm chủ đề thành công!";
        LOCATION_js($url_page);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật chủ đề thành công!";
    }
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    if ($icon != '') {
        $full_icon  = $fullpath."/".$duongdantin."/".$icon;
    }

    $sort = number_format($sort, 0, ',', '.');
} else {
    $sort = DB_que("SELECT * FROM `$table`");
    $sort = number_format((DB_num($sort) + 1), 0, ',', '.');
}

?>
<input type="hidden" name="anh_sp" value="">
<section class="content-header">
    <h1>Tính năng hệ thống</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Tính năng hệ thống</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i><?= $id > 0 ? 'Sửa' : 'Thêm' ?> tính năng hệ thống
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Thêm mới</a>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="form-group">
                                    <label>Tên ngôn ngữ </label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty($tenbaiviet) ? SHOW_text($tenbaiviet) : '' ?>" name="tenbaiviet">
                                </div>

                                <div class="form-group">
                                    <label>Mã ngôn ngữ</label>
                                    <input type="text" class="form-control" name="code_lang"
                                           value="<?= !empty($code_lang) ? Show_text($code_lang) : "" ?>">
                                </div>
                                <!--<div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" class="form-control" name="icon"
                                           value="<?= !empty($icon) ? Show_text($icon) : "" ?>">
                                </div>-->
                                <input type="hidden" name="id_edit" class="id_edit" value="<?= !empty($id) ? $id : 0 ?>">
                                <div class="form-group">
                                    <label for="exampleInputFile2">Ảnh đại diện</label>
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

                                <div class="form-group">
                                    <label>Số thứ tự</label>
                                    <input type="text" class="form-control" name="sort"
                                           value="<?= !empty($sort) ? $sort : 1 ?>">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input name='showhi' type='checkbox'
                                               class='minimal' <?= (!empty($showhi) && $showhi) == 1 || empty($showhi) ? "checked='checked'" : "" ?>>
                                        Hiển thị
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>