<?php

$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);
    $showhi = isset($_POST['showhi']) ? 1 : 0;

    $gia_min = str_replace(",", "", @$gia_min);
    $gia_min = str_replace(".", "", @$gia_min);
    $gia_max = str_replace(",", "", @$gia_max);
    $gia_max = str_replace(".", "", @$gia_max);
}


if (!empty($_POST)) {

    $data = array();
    $data['tenbaiviet_vi'] = $tenbaiviet_vi;
    $data['tenbaiviet_en'] = $tenbaiviet_en;
    $data['catasort'] = $catasort;
    $data['showhi'] = $showhi;
    $data['gia_min'] = $gia_min;
    $data['gia_max'] = $gia_max;

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm liên kết nhanh thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật liên kết nhanh thành công!";
    }
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);

    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }
    $gia_min = number_format($gia_min, 0, ',', '.');
    $gia_max = number_format($gia_max, 0, ',', '.');
} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>

<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a
                class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE] </a> <?php } ?>Thiết lập tìm
        kiếm theo %</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Thiết lập tìm kiếm theo %</li>
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
                            <i class="fa fa-pencil-square-o"></i><?= $id > 0 ? 'Sửa' : 'Thêm' ?> dữ liệu
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
                        foreach ($arr_lang as $rows){
                        if($rows['code_lang'] == "zh-CN"){
                            $rows['code_lang'] = "cn";
                        }
                        ?>

                        <div class="tab-pane <?=$count_lang == 1 ? "active" : ""?>" id="tab_<?=$count_lang?>">
                            <div class="form-group">
                                <label>Tiêu đề (<?=$lang?>)</label>
                                <input type="text" class="form-control"
                                       value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                       name="tenbaiviet_<?=$rows['code_lang']?>"
                                       id="tenbaiviet_<?=$rows['code_lang']?>">
                            </div>
                        </div>
                        <?php $count_lang++;} ?>
                    </div>
                </div>
                <div class="box p10">
                    <div class="form-group">
                        <label>Từ </label>
                        <input type="text" class="form-control" value="<?= !empty($gia_min) ? $gia_min : 0 ?>"
                               name="gia_min" onkeyup="SetCurrency(this)">
                    </div>
                    <div class="form-group">
                        <label>Đến </label>
                        <input type="text" class="form-control" value="<?= !empty($gia_max) ? $gia_max : 0 ?>"
                               name="gia_max" onkeyup="SetCurrency(this)">
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
            alert("Hãy nhập tên liên kết nhanh!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        return true;
    }
</script>