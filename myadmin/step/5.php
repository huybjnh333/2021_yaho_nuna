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
                    <label>Tên <?= $thongtin_step['tenbaiviet_' . $lang] ?> (<?= $lang ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty(${"tenbaiviet_" . $lang}) ? SHOW_text(${"tenbaiviet_" . $lang}) : "" ?>"
                           name="tenbaiviet_<?= $lang ?>"
                           id="tenbaiviet_<?= $lang ?>">
                </div>

                <?php if (!in_array($step, $st_bv_mota)) { ?>
                    <div class="form-group">
                        <label>Mô tả (<?= $lang ?>)</label>
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
<div class="box p10">
    <!--<?= admin_input_setting(72) ?>
    <?php if (in_array($step, $array_tn_option_p1)) { ?>
        <div class="form-group">
            <label>Icon</label>
            <input type="text" class="form-control icon_add" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>">
            <div class="dv-cont-showicon">
                <label>
                    <a onclick="$('.dv-show-icon').toggle()"><i class="fa fa-plus "></i> Chọn icon</a>
                    <i class="<?= !empty($p1) ? SHOW_text($p1) : '' ?>" id="show_icon_fa"></i>
                </label>
                <div class="dv-show-icon">
                    <?php $id_add = ".icon_add";
                    include _source . "fa_assom.php"; ?>
                </div>
            </div>
        </div>
    <?php } ?>-->
    <div class="form-group" style="display: none">
        <input type="text" class="form-control" name="seo_name"
               value="<?= !empty($seo_name) ? Show_text($seo_name) : md5(time()) ?>">
    </div>

    <?php include "step_hinhanh.php"; ?>

    <div class="form-group" style="display: none">
        <label>Ngày đăng</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydang" type="text" class="form-control pull-right datepicker" id="datepicker"
                   value='<?= $ngaydang ?>'>
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