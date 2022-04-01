<input type="hidden" name="anh_sp"
       value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
<input type="hidden" name="anh_sp_hv" value="620x380">
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
    <div class="form-group">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name"
               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>

    <?php
        include "step_hinhanh.php";
        include "step_tag.php";
    ?>

<!--    <div class="form-group ">-->
<!--        <label>Hiển thị</label>-->
<!--        --><?//= LAY_chude_muti(@$id_parent_muti, $step, 'id_parent_muti[]', ' form-control SlectBoxNew', 0, 0, 'false', "multiple='multiple'") ?>
<!--    </div>-->


    <?php if ($step == 1) { ?>
        <!-- <div class="form-group">
    <label>Tác giả</label>
    <div class="dv-nhom-ajax-admin">
      <i class="fa fa-caret-down"></i>
      <?php
        $data_step = 2;
        $check = DB_que("SELECT `tenbaiviet_vi` FROM `#_baiviet` WHERE `step` = '$data_step' AND `id` = '" . @$p2 . "' LIMIT 1");
        $check = DB_arr($check, 1);
        ?>
      <input type="hidden" class="form-control js_val_timkiem" name="p2" value="<?= !empty($p2) ? $p2 : 0 ?>">
      <input type="text" class="js_name_timkiem" class="form-control" value="<?= $check['tenbaiviet_vi'] ?>" readonly="readonly" onclick="check_show_timkiem('.dv-nhom-ajax-admin', '.js_key_timkiem')">
      <div class="dv-ndtimkiem">
        <input type="text" class="js_key_timkiem" placeholder="Nhập tên tác giả cần tìm..." onkeyup="check_timkiem_ajax('.js_key_timkiem')" data_step="<?= $data_step ?>">
        <ul class="sj_load_timkiem"></ul>
      </div>
    </div>
  </div> -->
    <?php } ?>

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
