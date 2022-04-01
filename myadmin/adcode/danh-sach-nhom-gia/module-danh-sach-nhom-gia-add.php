<?php

    $id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $key => $value) {
            ${$key}           = $value;
        }
        $catasort       = @str_replace(".", "", $catasort);
 
    }

    if (!empty($_POST)) {
        // $hinhanh                        = UPLOAD_image("icon", "../".$duongdantin."/", time());
        $data                  = array();
        $data['tenbaiviet_vi'] = $tenbaiviet_vi;
        $data['tenbaiviet_en'] = $tenbaiviet_en;
        $data['step']          = @is_numeric($step) ? $step : 0;
        $data['catasort']      = @is_numeric($catasort) ? $catasort : 0;
        $data['showhi']        = @isset($_POST['showhi']) ? 1 : 0;
        $data['id_parent']     = 0;



        if ($id == 0) {
            $id = ACTION_db($data, $table, 'add', NULL, NULL);
            $_SESSION['show_message_on'] = "Thêm dữ liệu thành công!";
            LOCATION_js($url_page . "&step=" .  @$step . "&id_step=" . @$id_step . "&edit=" . $id);
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
            ${$key} = SHOW_text($value);
        }


        $catasort = number_format($catasort, 0, ',', '.');
        // if ($icon != '') {
        //     $full_icon  = $fullpath."/".$duongdantin."/".$icon;
        // }

    } else {
        $catasort = layCatasort($table, "`step` = '$step'");
        $catasort = number_format($catasort, 0, ',', '.');
    }
?>

<section class="content-header">
    <h1><?php if(isset($_SESSION['admin'])){ ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <?php } ?>Danh sách tính năng</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý tính năng</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i><?=GETNAME_step($step); ?>
                            > <?= $id > 0 ? 'Sửa' : 'Thêm' ?> tính năng
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
                               class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
                               class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source."lang.php" ?>
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
                                    <label>Tiêu đề (<?=$lang?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                           name="tenbaiviet_<?= $lang ?>" id="tenbaiviet_<?= $lang ?>">
                                </div>
                            </div>
                            <?php $count_lang++;} ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10">
                    <div class="form-group">
                        <label>Số thứ tự</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>

                    <div class="form-group">
                        <label class="mr-20 checkbox-mini">
                          <input type="checkbox" name="showhi" class="minimal" <?=isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
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
            <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
               class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>" class="btn btn-primary"><i
                        class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>

<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val() == '') {
            alert("Hãy nhập tiêu đề!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        return true;
    }
</script>