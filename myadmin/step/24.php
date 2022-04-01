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
                           name="tenbaiviet_<?= $lang ?>" id="tenbaiviet_<?= $lang ?>">
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

                <div class="form-group" style="display: none;">
                    <label>Seo Title (<?= $lang ?>)</label>
                    <input type="text" class="form-control" name="seo_title_<?= $lang ?>"
                           value="<?= !empty(${"seo_title_" . $lang}) ? Show_text(${"seo_title_" . $lang}) : "" ?>">
                </div>
                <div class="form-group" style="display: none;">
                    <label>Seo Description (<?= $lang ?>)</label>
                    <input type="text" class="form-control" name="seo_description_<?= $lang ?>"
                           value="<?= !empty(${"seo_description_" . $lang}) ? Show_text(${"seo_description_" . $lang}) : "" ?>">
                </div>

                <div class="form-group" style="display: none;">
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
    <div class="form-group">
        <label>Cân nặng (kg) : </label>
        <input type="text" class="form-control form-phu"
               value="<?= !empty($thuoc_tinh_1_vi) ? SHOW_text($thuoc_tinh_1_vi) : '' ?>" name="thuoc_tinh_1_vi"
               id="thuoc_tinh_1_vi">
        <label>đến</label>
        <input type="text" class="form-control form-phu"
               value="<?= !empty($thuoc_tinh_1_en) ? SHOW_text($thuoc_tinh_1_en) : '' ?>" name="thuoc_tinh_1_en"
               id="thuoc_tinh_1_en">
    </div>
    <style>
        .form-phu {
            display: inline-block!important;
            width: unset!important;
            height: 32px!important;
        }
    </style>
    <div class="form-group">
        <label>Chiều cao (cm) : </label>
        <input type="text" class="form-control form-phu"
               value="<?= !empty($thuoc_tinh_2_vi) ? SHOW_text($thuoc_tinh_2_vi) : '' ?>" name="thuoc_tinh_2_vi"
               id="thuoc_tinh_2_vi">
        <label>đến</label>
        <input type="text" class="form-control form-phu"
               value="<?= !empty($thuoc_tinh_2_en) ? SHOW_text($thuoc_tinh_2_en) : '' ?>" name="thuoc_tinh_2_en"
               id="thuoc_tinh_2_en">
    </div>

    <div class="form-group" style="display: none;">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name"
               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>
    <div class="form-group">
        <!--        <label>Kiểu hiển thị </label>-->
        <!--<div>
            <?php for ($i = 1; $i <= 9; $i++) { ?>
                <span style="background: #dadada; padding: 0px 7px; display: inline-block; border-radius: 100px; margin: 0 3px 3px 0; font-size: 10px">Kiểu hiển thị <?= $i ?> <a
                            data-tooltip='<img src="img/kieu_<?= $i ?>.png" style="width: 100%">'> </a></span>
            <?php } ?>
        </div>-->
    </div>
    <?php if (in_array($step, $check_video)) { ?>
        <div class="form-group">
            <label>Link Video <a
                        data-tooltip="Nhập link của Iframe Video. Ví dụ: https://www.youtube.com/embed/nBADFUDapmk, https://fast.wistia.net/embed/iframe/ahh2wpcw8i"> </a></label>
            <input type="text" class="form-control" name="link_video"
                   value="<?= !empty($link_video) ? Show_text($link_video) : "" ?>">
        </div>
    <?php } ?>
    <?php
//    include "step_hinhanh.php";
//    include "step_tag.php";
    ?>

    <div class="form-group">
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