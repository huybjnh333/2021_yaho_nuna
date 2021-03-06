<?php
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }

    $catasort = str_replace(".", "", $catasort);
    $showhi = isset($_POST['showhi']) ? 1 : 0;
    $gioitinh_nam = isset($_POST['gioitinh_nam']) ? $_POST['gioitinh_nam'] : 0;
    $gioitinh_nu = isset($_POST['gioitinh_nu']) ? $_POST['gioitinh_nu'] : 0;
    $seo_title_vi = LAY_uutien(@$seo_title_vi, @$tenbaiviet_vi);
    $seo_title_en = LAY_uutien(@$seo_title_en, @$tenbaiviet_en);
    $seo_title_cn = LAY_uutien(@$seo_title_cn, @$tenbaiviet_cn);
    $seo_description_vi = LAY_uutien(@$seo_description_vi, @$tenbaiviet_vi);
    $seo_description_en = LAY_uutien(@$seo_description_en, @$tenbaiviet_en);
    $seo_description_cn = LAY_uutien(@$seo_description_cn, @$tenbaiviet_cn);
    $seo_keywords_vi = LAY_uutien(@$seo_keywords_vi, @$tenbaiviet_vi);
    $seo_keywords_en = LAY_uutien(@$seo_keywords_en, @$tenbaiviet_en);
    $seo_keywords_cn = LAY_uutien(@$seo_keywords_cn, @$tenbaiviet_cn);

}
if (!empty($_POST)) {
    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $dowload = UPLOAD_file("dowload", "../datafiles/files/", time());

    if ($seo_name == "") $seo_name = $tenbaiviet_vi != "" ? CONVERT_vn($tenbaiviet_vi) : time();
    $data = array();
    $data['tenbaiviet_vi'] = @$tenbaiviet_vi;
    $data['tenbaiviet_en'] = @$tenbaiviet_en;
    $data['mota_vi'] = @$mota_vi;
    $data['mota_en'] = @$mota_en;
    $data['noidung_vi'] = @$noidung_vi;
    $data['noidung_en'] = @$noidung_en;

    $data['id_parent'] = @$id_parent;
    $data['seo_name'] = @$seo_name;
    $data['catasort'] = @$catasort;
    $data['showhi'] = @$showhi;

    $data['seo_title_vi'] = @$seo_title_vi;
    $data['seo_title_en'] = @$seo_title_en;
    $data['seo_description_vi'] = @$seo_description_vi;
    $data['seo_description_en'] = @$seo_description_en;
    $data['seo_keywords_vi'] = @$seo_keywords_vi;
    $data['seo_keywords_en'] = @$seo_keywords_en;

    $data['duongdantin'] = @$duongdantin;
    $data['dowload_text'] = @$dowload_text;
    $data['gioitinh_nam'] = @$gioitinh_nam;
    $data['gioitinh_nu'] = @$gioitinh_nu;
    $data['step'] = @$step;



    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['edit'] . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }
    if ($hinhanh != false) {
        $data['icon'] = $hinhanh;
        if ($_REQUEST['anh_sp'] != '') {
            $anh_sp = explode("x", $_REQUEST['anh_sp']);
            $wid = $anh_sp[0];
            $hig = $anh_sp[1];
            TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
        } else {
            TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 100, 100);
        }
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumbnew_" . $hinhanh, 300, 300);
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
            @unlink("../" . $sql_thongtin["duongdantin"] . "/thumbnew_" . $sql_thongtin["icon"]);
        }
    }
    if ($dowload != false && $id > 0) {
        $data['dowload'] = $dowload;
        if ($id > 0 && is_array($sql_thongtin)) {
            @unlink("../datafiles/files/" . $sql_thongtin["dowload"]);
        }
    }

    if ($id == 0) {

        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Th??m d??? li???u th??nh c??ng!";
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = '" . $id . "'");
        $_SESSION['show_message_on'] = "C???p nh???t d??? li???u th??nh c??ng!";
    }
    LOCATION_js($url_page . "&id-parent=" . $id_parent . "&step=" . $step_id . "&edit=" . $id);
    exit();
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' AND `id_parent` = '$id_parent' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);

    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }
    if ($icon != '') {
        $full_icon = $fullpath . "/" . $duongdantin . "/" . $icon;
    }
    $catasort = number_format($catasort, 0, ',', '.');
} else {
    $catasort = layCatasort($table, " `id_parent` = '$id_parent'");
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}


?>

<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NG??N NG???]</a> <a
                class="js_okkk" style="cursor: pointer;"
                onclick="OKKK_by_lh()">[UPDATE]</a> <?php } ?><?= $thongtin_step['tenbaiviet_vi'] ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang ch???</a></li>
        <li class="active">Qu???n l?? ?????t t??n</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> <?= $tenbv['tenbaiviet_vi'] ?>
                            > <?= $id > 0 ? 'S???a' : 'Th??m' ?> b??i vi???t
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&id-parent=<?= $id_parent . "&step=" . $step_id ?>&them-moi=true"
                               class="btn btn-primary"><i class="fa fa-plus"></i> Th??m m???i</a>
                            <a href="<?= $url_page ?>&id-parent=<?= $id_parent . "&step=" . $step_id ?>"
                               class="btn btn-primary"><i class="fa fa-sign-out"></i> Tho??t</a>

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
                                <div class="tab-pane <?= $count_lang == 1 ? "active" : "" ?>"
                                     id="tab_<?= $count_lang ?>">
                                    <div class="form-group">
                                        <label>T??n b??i vi???t (<?= $lang ?>)</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                                               name="tenbaiviet_<?= $lang ?>"
                                               id="tenbaiviet_<?= $lang ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>?? ngh??a (<?= $lang ?>)</label>
                                        <textarea id="mota_<?= $lang ?>" name="mota_<?= $lang ?>" class="form-control" spellcheck="false"><?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?></textarea>
                                    </div>

                                    <?php if ($thongtin['bvct_noidung'] == 1 || !empty($_SESSION['admin'])) { ?>
                                        <?php if ($count_lang == 1) {
                                            if (!empty($_SESSION['admin'])) { ?>
                                                <input type='checkbox' class='minimal minimal_click'
                                                       colum="bvct_noidung"
                                                       idcol="<?= $thongtin['id'] ?>" table="#_seo"
                                                       value='1' <?= $thongtin['bvct_noidung'] == 1 ? 'checked="checked"' : "" ?>>
                                            <?php }
                                        } ?>
                                        <div class="form-group">
                                            <label>N???i dung (<?= $lang ?>)</label>
                                            <textarea id="noidung_<?= $lang ?>" name="noidung_<?= $lang ?>"
                                                      class="form-control paEditor">
                                            <?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>
                                        </textarea>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group" style="display: none">
                                        <label>Seo Title (<?= $lang ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_<?= $lang ?>"
                                               value="<?= !empty(${"seo_title_" . $lang}) ? Show_text(${"seo_title_" . $lang}) : "" ?>">
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label>Seo Description (<?= $lang ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_<?= $lang ?>"
                                               value="<?= !empty(${"seo_description_" . $lang}) ? Show_text(${"seo_description_" . $lang}) : "" ?>">
                                    </div>

                                    <div class="form-group" style="display: none">
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
                    <?php if ($_GET['step'] == 2) { ?>
                        <div class="form-group">
                            <label>Seo name <a
                                        data-tooltip="???????ng d???n chu???n bao g???m c??c k?? t??? [a-zA-Z0-9-]."> </a></label>
                            <input type="text" class="form-control" name="seo_name" id="seo_name"
                                   value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
                            <label class="noweight noweight-top checkbox-mini">
                                <input class="minimal auto_get_link"
                                       type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> L???y
                                ???????ng
                                d???n t??? ?????ng
                            </label>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="mr-10">Gi???i t??nh</label>
                        <label class="mr-10 checkbox-mini">
                            <input type="checkbox" name="gioitinh_nam" id="nam" value="1"
                                <?= isset($gioitinh_nam) && $gioitinh_nam == 1 ? 'checked="checked"' : '' ?>>
                            Nam
                        </label>
                        <label class="mr-10 checkbox-mini">
                            <input type="checkbox" name="gioitinh_nu" id="nu" value="1"
                                <?= isset($gioitinh_nu) && $gioitinh_nu == 1 ? 'checked="checked"' : "" ?>>
                            N???
                        </label>
                    </div>

                    <?php if ($thongtin['bvct_hinhanh'] == 1 || !empty($_SESSION['admin'])) { ?>
                        <?php if (!empty($_SESSION['admin'])) { ?>
                            <input type='checkbox' class='minimal minimal_click' colum="bvct_hinhanh"
                                   idcol="<?= $thongtin['id'] ?>" table="#_seo"
                                   value='1' <?= $thongtin['bvct_hinhanh'] == 1 ? 'checked="checked"' : "" ?>>
                        <?php } ?>
                        <div class="form-group">
                            <input type="hidden" name="anh_sp"
                                   value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
                            <label for="exampleInputFile2">???nh ?????i
                                di???n <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
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
                    <?php if ($thongtin['bvct_file'] == 1 || !empty($_SESSION['admin'])) { ?>
                        <?php if (!empty($_SESSION['admin'])) { ?>
                            <input type='checkbox' class='minimal minimal_click' colum="bvct_file"
                                   idcol="<?= $thongtin['id'] ?>" table="#_seo"
                                   value='1' <?= $thongtin['bvct_file'] == 1 ? 'checked="checked"' : "" ?>>
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleInputFile">Link Dowload <a
                                        data-tooltip="Link dowload ngo??i website, ??u ti??n l???y link n???u ch??n link"> </a></label>
                            <input type="text" class="form-control" name="dowload_text"
                                   value="<?= !empty($dowload_text) ? Show_text($dowload_text) : "" ?>">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File Dowload <a
                                        data-tooltip="Ch??? upload 1 file [*.pdf] [*.docx] [*.rar] [*.zip] [*.xlsx] dung l?????ng file t???i ??a 10MB"> </a></label>
                            <input name="dowload" type="file" class="form-control" id="exampleInputFile">
                            <p style="padding: 0"><?= !empty($dowload) ? '<a href="../datafiles/files/' . $dowload . '" download>' . $dowload . '</a>' : '' ?></p>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>S??? th??? t???</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini">
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
            <a href="<?= $url_page ?>&id-parent=<?= $id_parent . "&step=" . $step_id ?>&them-moi=true"
               class="btn btn-primary"><i class="fa fa-plus"></i> Th??m m???i</a>
            <a href="<?= $url_page ?>&id-parent=<?= $id_parent . "&step=" . $step_id ?>" class="btn btn-primary"><i
                        class="fa fa-sign-out"></i> Tho??t</a>
        </h3>
    </div>
</form>

<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val() == '') {
            alert("H??y nh???p T??n b??i vi???t!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        return true;
    }
</script>