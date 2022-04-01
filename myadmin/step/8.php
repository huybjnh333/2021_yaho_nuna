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
                        <!--<textarea id="mota_<?= $lang ?>" name="mota_<?= $lang ?>"
                                  class="paEditor"><?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?></textarea>-->
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
    <!-- <div class="form-group">
    <label>URL Youtube</label>
    <input type="text" class="form-control" value="<?= !empty($p1) ? SHOW_text($p1) : '' ?>" name="p1" id="p1">
    <p style="font-size: 12px; padding: 5px 0 0; margin: 0;">Nhập Url Youtube dạng chuẩn <span style="color: red">https://www.youtube.com/watch?v=eKzG6QoXFdU</span></p>
  </div> -->
    <div class="form-group">
        <label>Link Video <a
                    data-tooltip="Chèn link youtube dạng https://www.youtube.com/watch?v=34S6DPgKiDY"> </a></label>
        <input type="text" class="form-control" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>">

        <!--<label>Link Video <a
                    data-tooltip="Double click vào input để chọn file đã upload."> </a></label>
         <input type="text" class="form-control" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>" ondblclick="popupBrowseImage(this)">-->
         <!--<label style="margin-top: 10px">
      <input type="radio" name="opt_km" value="0" <?= empty($opt_km) || $opt_km == 0 ? 'checked="checked"' : "" ?>> Chọn Link Video
    </label>-->
    </div>
    <!-- <div class="form-group">
    <label for="exampleInputFile">Video mp4 </label>
    <input name="dowload" type="file" class="form-control" id="exampleInputFile">
    <p style="padding: 0"><?= !empty($dowload) ? '<a href="../datafiles/files/' . $dowload . '" download>' . $dowload . '</a>' : '' ?></p>
    <label style="margin-top: 10px">
      <input type="radio" name="opt_km" value="1" <?= !empty($opt_km) && $opt_km == 1 ? 'checked="checked"' : "" ?>> Video mp4
    </label>
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
        <label class="mr-20">
            <input type="radio" name="showhi" class="minimal"
                   value="1" <?= $id > 0 ? LAY_checked($showhi, 1) : 'checked' ?>> Hiện thị
        </label>
        <label>
            <input type="radio" name="showhi" class="minimal" value="2" <?= $id > 0 ? LAY_checked($showhi, 2) : '' ?>>
            Ẩn
        </label>
    </div>
</div>
<script type="text/javascript" src="bower_components/ckfinder/ckfinder.js" charset="utf-8"></script>
<script>
    function popupBrowseImage(obj) {
        CKFinder.modal({
            chooseFiles: true,
            width: 1100,
            height: 550,
            skin: 'jquery-mobile',
            language: 'vi',
            onInit: function (finder) {
                finder.on('files:choose', function (e) {
                    //
                    //
                    var path = e.data.files.first().getUrl();
                    $(obj).val(path);
                    console.log(e.data.files.first().getUrl())
                });
            }
        });
    }
</script>