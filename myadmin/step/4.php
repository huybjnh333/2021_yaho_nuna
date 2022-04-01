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

                <!--<div class="form-group">
                    <label>Ghi chú (<?= $lang ?>)</label>
                    <input type="text" class="form-control" name="tags_<?= $lang ?>"
                           value="<?= !empty(${"tags_" . $lang}) ? Show_text(${"tags_" . $lang}) : "" ?>">
                </div>-->

                <?php if (!in_array($step, $st_bv_mota)) { ?>
                    <div class="form-group">
                        <label>Mô tả (<?= $lang ?>)</label>
                        <!--<input type="text" class="form-control " name="mota_<?= $lang ?>"
                               id="mota_<?= $lang ?>"
                               value="<?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?>">-->
                        <textarea id="mota_<?= $lang ?>" name="mota_<?= $lang ?>" rows="10" class="paEditor"
                                  cols="80"><?= !empty(${"mota_" . $lang}) ? SHOW_text(${"mota_" . $lang}) : '' ?></textarea>
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
<div class="box p10">
    <!-- <div class="form-group" >
    <label>Liên kết ngoài</label>
    <input type="text" class="form-control" name="link_video" value="<?= !empty($link_video) ? Show_text($link_video) : "" ?>">
  </div> -->
    <!-- //tinh nang -->
    <?php
    if ($id > 0) {
        $tinhnang_list = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id'");
        $tinhnang_list = DB_arr($tinhnang_list);
        $list_arr = array();
        foreach ($tinhnang_list as $rs) {
            array_push($list_arr, $rs['id_tinhnang'] . "_" . $rs['id_val']);
        }
    }
    $tinhnang_arr = LAY_bv_tinhnang($step);
    foreach ($tinhnang_arr as $value) {
        if ($value['id_parent'] != 0) continue;
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

    <!-- <div class="form-group">
    <label>Kiểu hiển thị </label>
    <div>
      <?php for ($i = 1; $i <= 9; $i++) { ?>
      <span style="background: #dadada; padding: 0px 7px; display: inline-block; border-radius: 100px; margin: 0 3px 3px 0; font-size: 10px">Kiểu hiển thị <?= $i ?> <a data-tooltip='<img src="img/kieu_<?= $i ?>.png" style="width: 100%">'> </a></span>
      <?php } ?>
    </div>
    <select name="p2" class="form-control">
      <?php for ($i = 1; $i <= 9; $i++) { ?>
      <option value="<?= $i ?>" <?= @LAY_selected($i, $p2) ?>>Kiểu hiển thị <?= $i ?></option>
      <?php } ?>
    </select>
  </div> -->
    <!-- <div class="form-group">
    <label>Tỉnh/thành phố </label>
    <select name="num_3" class="form-control" onchange="LOAD_tinhthanh(this, '.cls_num_2', 'Quận/Huyện')">
      <option value="0">Tỉnh/thành phố</option>
      <?php

    $diadiem = DB_que("SELECT *  FROM `#_ship_khuvuc` WHERE `showhi` = 1 AND `id_parent`= 0 ORDER BY `catasort` ASC, `id` DESC");
    $diadiem = DB_arr($diadiem);
    foreach ($diadiem as $rows) {
        // if($rows['id_parent'] != 0) continue;
        ?>
      <option value="<?= $rows['id'] ?>" <?= LAY_selected($rows['id'], @$num_3) ?>><?= $rows['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label>Quận/Huyện</label>
    <select name="num_4" class="form-control cls_num_2" onchange="LOAD_tinhthanh(this, '.cls_num_3', 'Quận/Huyện')">
      <option value="0">Quận/Huyện</option>
      <?php
    if (@$num_3 != 0) {
        $diadiem = DB_que("SELECT *  FROM `#_ship_khuvuc` WHERE `showhi` = 1 AND `id_parent`= '$num_3'  ORDER BY `catasort` ASC, `id` DESC");
        $diadiem = DB_arr($diadiem);
        foreach ($diadiem as $rows) {
            // if($rows['id_parent'] != $num_1) continue;
            ?>
      <option value="<?= $rows['id'] ?>" <?= LAY_selected($rows['id'], @$num_4) ?>><?= $rows['tenbaiviet_vi'] ?></option>
      <?php }
    } ?>
    </select>
  </div> -->
    <!--  -->
    <!-- <div class="form-group" >
    <label>Hotline</label>
    <input type="text" class="form-control" name="thuoc_tinh_2_vi" value="<?= !empty($thuoc_tinh_2_vi) ? $thuoc_tinh_2_vi : "" ?>">
  </div>
  <div class="form-group" >
    <label>Email</label>
    <input type="text" class="form-control" name="thuoc_tinh_2_en" value="<?= !empty($thuoc_tinh_2_en) ? $thuoc_tinh_2_en : "" ?>">
  </div>
  <div class="form-group" >
    <label>Website</label>
    <input type="text" class="form-control" name="thuoc_tinh_3_vi" value="<?= !empty($thuoc_tinh_3_vi) ? $thuoc_tinh_3_vi : "" ?>">
  </div>
  <div class="form-group" >
    <label>Link facebook</label>
    <input type="text" class="form-control" name="thuoc_tinh_3_en" value="<?= !empty($thuoc_tinh_3_en) ? $thuoc_tinh_3_en : "" ?>">
  </div>
  <div class="form-group" >
    <label>Link youtube</label>
    <input type="text" class="form-control" name="thuoc_tinh_1_vi" value="<?= !empty($thuoc_tinh_1_vi) ? $thuoc_tinh_1_vi : "" ?>">
  </div> -->
    <!--  -->


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