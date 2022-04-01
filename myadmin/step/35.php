<input type="hidden" name="step" value="<?= $step ?>">
<input type="hidden" name="id_edit" class="id_edit" value="<?= !empty($id) ? $id : 0 ?>">
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

                <?php
                if ($id > 0) {
                    $tinhnang_list = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id' AND `showhi` = 1");
                    $tinhnang_list = DB_arr($tinhnang_list);
                    $list_arr = array();
                    $list_arr_nd = array();
                    foreach ($tinhnang_list as $rs) {
                        array_push($list_arr, $rs['id_tinhnang'] . "_" . $rs['id_val']);
                        $list_arr_nd[$rs['id_tinhnang'] . "_vi"] = $rs['mota_vi'];
                        $list_arr_nd[$rs['id_tinhnang'] . "_en"] = $rs['mota_en'];
                    }
                }
                $tinhnang_arr = LAY_bv_tinhnang($step);
                foreach ($tinhnang_arr as $value) {
                    // ko chon option na
                    continue;
                    //
                    if ($value['id_parent'] != 0) continue;
                    if ($value['loai_hienthi'] != 0) continue;

                    ?>
                    <div class="form-group" style="background: #efefef; padding: 10px;">
                        <label style="width: 100%; float: left;"><?= $value['tenbaiviet_vi'] ?></label>
                        <div class="dv-lbtinhnang flex">
                            <?php
                            foreach ($tinhnang_arr as $val2) {
                                if ($val2['id_parent'] != $value['id']) continue;
                                ?>
                                <p style="margin: 10px 0 3px; padding: 0; font-size: 12px; font-weight: 600;"><?= $val2['tenbaiviet_vi'] ?></p>
                                <input type="text" name="tinhnang_arr_input[]"
                                       value="<?= !empty($list_arr_nd[$val2['id'] . '_vi']) ? SHOW_text($list_arr_nd[$val2['id'] . '_vi']) : "" ?>">
                                <input type="hidden" name="tinhnang_key_arr[]" value="<?= $val2['id'] ?>">
                            <?php } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                <?php } ?>

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

                <!-- <div class="form-group">
        <label>Thông số kỹ thuật</label>
        <textarea id="thongso_vi" name="thongso_vi" class="paEditor"><?= !empty($thongso_vi) ? SHOW_text($thongso_vi) : '' ?></textarea>
      </div> -->

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
    <!-- //tinh nang -->
    <?php
    foreach ($tinhnang_arr as $value) {
        if ($value['id_parent'] != 0) continue;
        if ($value['loai_hienthi'] != 1) continue;
        // ko chon option na

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
</div>

<div class="box p10">

    <div class="form-group">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name" value="<?= @$seo_name ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>
    <div class="form-group">
        <label>Kiểu hiển thị </label>
        <div>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <span style="background: #dadada; padding: 0px 7px; display: inline-block; border-radius: 100px; margin: 0 3px 3px 0; font-size: 10px">Kiểu hiển thị <?= $i ?> <a
                            data-tooltip='<img src="img/kieu_<?= $i ?>.png" style="width: 100%">'> </a></span>
            <?php } ?>
        </div>
        <select name="p2" class="form-control">
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <option value="<?= $i ?>" <?= @LAY_selected($i, $p2) ?>>Kiểu hiển thị <?= $i ?></option>
            <?php } ?>
        </select>
    </div>
    <?php include "step_hinhanh.php"; ?>
    <!-- <div class="form-group">
    <label>Ngày Ban Hành</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="capnhat" type="text" class="form-control pull-right datepicker" value='<?= $capnhat ?>'>
    </div>
  </div> -->
    <div class="form-group">
        <label>Ngày đăng</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydang" type="text" class="form-control pull-right datepicker" value='<?= $ngaydang ?>'>
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
