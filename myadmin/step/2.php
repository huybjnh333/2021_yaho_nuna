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
                    <label>Tên <?= $thongtin_step['tenbaiviet_vi'] ?> (<?= $lang ?>)</label>
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
                                <p style="margin: 10px 0 3px; padding: 0; font-size: 12px; font-weight: 600;"><?= $val2['tenbaiviet_' . $lang] ?></p>
                                <input type="text" name="tinhnang_arr_input[]"
                                       value="<?= !empty($list_arr_nd[$val2['id'] . '_' . $lang]) ? SHOW_text($list_arr_nd[$val2['id'] . '_' . $lang]) : "" ?>">
                                <input type="hidden" name="tinhnang_key_arr[]" value="<?= $val2['id'] ?>">
                            <?php } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!in_array($step, $st_bv_mota)) { ?>
                <div class="form-group">
                    <label>Mô tả (<?= $lang ?>)</label>
                    <!--<textarea id="mota_<?= $lang ?>" name="mota_<?= $lang ?>" class="form-control paEditor">
            <?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?></textarea>-->
                    <input type="text" class="form-control " name="mota_<?= $lang ?>"
                           id="mota_<?= $lang ?>"
                           value="<?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?>">
                </div>
                <?php } ?>

                <?php if (!in_array($step, $st_bv_noidung)) { ?>
                <div class="form-group">
<!--                    <label>Nội dung (--><?//= $lang ?><!--)</label>-->
                    <label>Nội dung giới thiệu (<?= $lang ?>)</label>
                    <textarea id="noidung_<?= $lang ?>" name="noidung_<?= $lang ?>"
                              class="form-control paEditor">
                        <?= !empty(${"noidung_" . $lang}) ? SHOW_text(${"noidung_" . $lang}) : '' ?>
                    </textarea>
                </div>
                <?php } ?>

                <!--<div class="form-group">
                                        <label>Thông số kỹ thuật (--><?//= $lang ?><!--)</label>
                    <label>Đặc điểm nổi bật (<?= $lang ?>)</label>
                    <textarea id="thongso_<?= $lang ?>" name="thongso_<?= $lang ?>" class="form-control paEditor">
            <?= !empty(${"thongso_" . $lang}) ? SHOW_text(${"thongso_" . $lang}) : '' ?></textarea>
                </div>-->

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

                <!--<div class="form-group">
                    <label>Tags (<?= $lang ?>)</label>
                    <input type="text" class="form-control" name="tags_<?= $lang ?>"
                           value="<?= !empty(${"tags_" . $lang}) ? Show_text(${"tags_" . $lang}) : "" ?>">
                </div>-->
            </div>
            <?php $count_lang++;
        } ?>
    </div>
</div>
<!--<div class="box p10">
    <?php if (CHECK_key_setting("ma-san-pham")) { ?>
        <div class="form-group">
            <label>Mã sản phẩm</label>
            <input type="text" class="form-control" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>">
        </div>
    <?php } ?>
    <?php
    if ($thongtin['is_giamuti'] == 0) {
        ?>
        <div class="form-group" >
            <label>Giá bán</label>
            <input type="text" class="form-control cls_giatien_f" name="giatien"
                   value="<?= !empty($giatien) ? $giatien : "0" ?>" onkeyup="SetCurrency(this)">
        </div>
        <div class="form-group" >
            <label>Giá so sánh: </label>
            <input type="text" class="form-control cls_giatien_khuyenmai_f" name="giakm"
                   value="<?= !empty($giakm) ? $giakm : "0" ?>" onkeyup="SetCurrency(this)">
        </div>
    <?php } else include "step_giamuti.php"; ?>
</div>-->
<?php
$kieu_tn_muti = false;
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
<?php //include "step_tinhnang_sp_addtn.php"; ?>

<div class="box p10">
    <!-- <div class="form-group">
    <label>Nhà cung cấp</label>
    <select name="p2" class="form-control ">
      <option value="0"> Chọn nhà cung cấp</option>
      <?php
    $danhmuc = LAY_baiviet(12);
    foreach ($danhmuc as $rows) {
        ?>
      <option value="<?= $rows['id'] ?>" <?= $rows['id'] == @$p2 ? 'selected="selected"' : "" ?>><?= $rows['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div> -->

    <!-- end -->
    <?php if (in_array($step, $check_video)) { ?>
        <div class="form-group">
            <label>Link Video <a
                        data-tooltip="Nhập link Video Youtube. Ví dụ: https://www.youtube.com/watch?v=SQ-KWxC7Eoo&feature=emb_logo"> </a></label>
            <input type="text" class="form-control" name="link_video"
                   value="<?= !empty($link_video) ? Show_text($link_video) : "" ?>">
        </div>

    <?php } ?>
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

    <!--<div class="form-group ">
        <label>Hiển thị</label>
        <?= LAY_chude_muti(@$id_parent_muti, $step, 'id_parent_muti[]', ' form-control SlectBoxNew', 0, 0, 'false', "multiple='multiple'") ?>
    </div>-->

    <div class="form-group">
        <label>Ngày đăng</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydang" type="text" class="form-control pull-right" id="datepicker" value='<?= $ngaydang ?>'>
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
