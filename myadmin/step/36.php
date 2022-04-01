<input type="hidden" name="anh_sp"
       value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
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
                    <label>Tên <?= $thongtin_step['tenbaiviet_vi'] ?> (<?= $lang ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                           name="tenbaiviet_<?= $lang ?>"
                           id="tenbaiviet_<?= $lang ?>">
                </div>

                <?php if (!in_array($step, $st_bv_mota)) { ?>
                    <div class="form-group">
<!--                        <label>Mô tả (--><?//= $lang ?><!--)</label>-->
                        <label>Số hiệu văn bản (<?= $lang ?>)</label>
                        <input type="text" class="form-control " name="mota_<?= $lang ?>"
                               id="mota_<?= $lang ?>"
                               value="<?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?>">
                    </div>
                <?php } ?>

                <?php if (!in_array($step, $st_bv_noidung)) { ?>
                    <div class="form-group">
                        <label>Nội dung (<?= $lang ?>)</label>
                        <textarea id="noidung_<?= $lang ?>" name="noidung_<?= $lang ?>"
                                  class="form-control paEditor">
                        <?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>
                    </textarea>
                    </div>
                <?php } ?>

                <!--<div class="form-group">
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
                </div>-->
            </div>
            <?php $count_lang++;
        } ?>
    </div>
</div>
<?php
$tinhnang_arr = LAY_bv_tinhnang($step);
if ($id > 0) {
    $tinhnang_list = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id' AND `showhi` = 1");
    $tinhnang_list = DB_arr($tinhnang_list);
    $list_arr = array();
    foreach ($tinhnang_list as $rs) {
        array_push($list_arr, $rs['id_tinhnang'] . "_" . $rs['id_val']);
    }
}
$kieu_tn_muti = true;
if ($kieu_tn_muti) {
    ?>
    <div class="box p10">
        <!-- //tinh nang -->
        <?php
        foreach ($tinhnang_arr as $value) {
            if ($value['id_parent'] != 0) continue;
            if ($value['loai_hienthi'] != 1) continue;
            // ko chon option na
            // continue;
            //
            ?>
            <div class="form-group">
                <label><?= $value['tenbaiviet_vi'] ?></label>
                <div class="dv-lbtinhnang flex dv-nd-tinhnang">
                    <?php
                    foreach ($tinhnang_arr as $val2) {
                        if ($val2['id_parent'] != $value['id']) continue;
                        ?>
                        <label>
                            <input type="checkbox" name="tinhnang_arr[]"
                                   value="<?= $value['id'] . '_' . $val2['id'] ?>" <?= !empty($list_arr) && in_array($value['id'] . '_' . $val2['id'], @$list_arr) ? 'checked="checked"' : "" ?>>
                            <span><?= $val2['tenbaiviet_vi'] ?></span>
                        </label>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
        <?php } ?>
        <!-- tinh nang get price -->
        <!-- tinh nang get price end -->
    </div>
<?php } else { ?>
    <div class="box p10">
        <!-- //tinh nang -->
        <?php
        foreach ($tinhnang_arr as $value) {
            if ($value['id_parent'] != 0) continue;
            if ($value['loai_hienthi'] != 1) continue;
            // ko chon option na
            // continue;
            //
            ?>
            <div class="form-group">
                <label><?= $value['tenbaiviet_vi'] ?></label>
                <div class="dv-lbtinhnang flex">
                    <select name="tinhnang_arr[]" id="id_parent" class="form-control">
                        <option value="">Chọn <?= $value['tenbaiviet_vi'] ?></option>
                        <?php
                        foreach ($tinhnang_arr as $val2) {
                            if ($val2['id_parent'] != $value['id']) continue;
                            ?>
                            <option value="<?= $value['id'] . '_' . $val2['id'] ?>" <?= !empty($list_arr) && in_array($value['id'] . '_' . $val2['id'], @$list_arr) ? 'selected="selected"' : "" ?>><?= $val2['tenbaiviet_vi'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="clear"></div>
                </div>
            </div>
        <?php } ?>
        <!-- tinh nang get price -->
        <!-- tinh nang get price end -->
    </div>
<?php } ?>
<div class="box p10">
    <div class="form-group" style="display: none;">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name"
               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>
    <?php if (in_array($step, $check_video)) { ?>
        <div class="form-group">
            <label>Link Video <a
                        data-tooltip="Nhập link của Iframe Video. Ví dụ: https://www.youtube.com/embed/nBADFUDapmk, https://fast.wistia.net/embed/iframe/ahh2wpcw8i"> </a></label>
            <input type="text" class="form-control" name="link_video"
                   value="<?= !empty($link_video) ? Show_text($link_video) : "" ?>">
        </div>
    <?php } ?>
    <?php include "step_hinhanh.php"; ?>

    <div class="form-group">
        <label>Ngày ban hành</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydang" type="text" class="form-control pull-right datepicker" id="datepicker"
                   value='<?= $ngaydang ?>'>
        </div>
    </div>
    <div class="form-group">
        <label>Ngày cập nhật</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="capnhat" type="text" class="form-control pull-right datepicker" id="datepicker2"
                   value='<?= $capnhat ?>'>
        </div>
    </div>
    <div class="form-group">
        <label>Ngày công văn đến</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngayden" type="text" class="form-control pull-right datepicker" id="datepicker3"
                   value='<?= $ngayden ?>'>
        </div>
    </div>
    <div class="form-group">
        <label>Ngày công văn đi</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydi" type="text" class="form-control pull-right datepicker" id="datepicker4"
                   value='<?= $ngaydi ?>'>
        </div>
    </div>

    <div class="form-group">
        <label>Số thứ tự</label>
        <input type="text" class="form-control" name="catasort" id="catasort" value="<?= SHOW_text($catasort) ?>"
               onkeyup="SetCurrency(this)">
    </div>

    <div class="form-group">
        <label class="mr-20 checkbox-mini">
            <input type="checkbox" name="showhi"
                   class="minimal" <?= isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
        </label>
    </div>
</div>