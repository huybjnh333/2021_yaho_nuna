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

                <!-- <div class="form-group">
        <label>Địa chỉ</label>
        <input type="text" class="form-control" value="<?= !empty($thuoc_tinh_1_vi) ? SHOW_text($thuoc_tinh_1_vi) : '' ?>" name="thuoc_tinh_1_vi">
      </div> -->

                <?php if (!in_array($step, $st_bv_mota)) { ?>
                    <div class="form-group">
                        <label>Mô tả (<?= $lang ?>)</label>
                        <!--<input type="text" class="form-control " name="mota_<?= $lang ?>"
                               id="mota_<?= $lang ?>"
                               value="<?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?>">-->
                        <textarea id="mota_<?= $lang ?>" name="mota_<?= $lang ?>"
                                  class="paEditor"><?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?></textarea>
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

    <!-- <div class="form-group" >
    <label>Số điện thoại </label>
    <input type="text" class="form-control" name="gia_tri_1_vi" value="<?= !empty($gia_tri_1_vi) ? Show_text($gia_tri_1_vi) : "" ?>">
  </div>
  <div class="form-group" >
    <label>Toạ độ Google   <a data-tooltip="Link Tọa độ google lấy từ https://www.google.com/maps/, ví dụ: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.563789108241!2d108.04175821436091!3d12.676581324714002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31721d8109810281%3A0x772909506302207!2zNTMsIDUgTMOqIER14bqpbiwgVGjDoG5oIHBo4buRIEJ1w7RuIE1hIFRodeG7mXQsIMSQ4bqvayBM4bqvaywgVmlldG5hbQ!5e0!3m2!1sen!2sus!4v1578033688716!5m2!1sen!2sus"> </a></label>
    <input type="text" class="form-control" name="gg_map" value="<?= !empty($gg_map) ? Show_text($gg_map) : "" ?>">
  </div> -->
    <div class="form-group">
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