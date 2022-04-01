<input type="hidden" name="id_edit" class="id_edit" value="<?= !empty($id) ? $id : 0 ?>">
<?php if (in_array($step, $check_img_step)) { ?>
    <div class="form-group">
        <label for="exampleInputFile2">Ảnh đại
            diện <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
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
<?php if (in_array($step, $check_sp_hove)) { ?>
    <div class="form-group">
        <label for="exampleInputFile2">Ảnh thay
            đổi <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
        <div class="dv-anh-chitiet-img-cont">
            <div class="dv-anh-chitiet-img">
                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                <input type="file" name="icon_hover" id="input_icon_hover" class="cls_hinhanh" accept="image/*"
                       onchange="pa_previewImg(event, '#img_icon_hover','input_icon_hover');">
                <img src="<?= @$full_icon_hover ?>" alt="" class="img_chile_dangtin"
                     style="<?php if (!empty($full_icon_hover) && $full_icon_hover != "") echo "display: block"; else echo "display: none" ?>"
                     id="img_icon_hover">
            </div>
        </div>
    </div>
<?php } ?>
<?php if (in_array($step, $danhmuc_slider)) { ?>
    <div class="form-group">
        <label for="exampleInputFile2">Ảnh chi tiết <?php
            if (!empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '') {
                $size_img = explode("x", $thongtin_step['size_img']);
                echo "(" . $size_img[0] * 1.5 . 'px x ' . $size_img[1] * 1.5 . "px)";
            }
            ?></label>
        <div class="img-child">
            <div class=" no_box">
                <div class="js-conanh-step sortable dv-anh-js-load">
                    <?php
                    $list_hinhcon = DB_fet("  * ", " `#_baiviet_img` ", " `id_parent` = '" . $id . "' AND `the_loai` = 0 ", " `sort` ASC, `id` ASC", "", "arr");
                    foreach ($list_hinhcon as $r_img) {
                        ?>
                        <div class="dv_hinhanh_con dv-anh-chl dv_hinhanh_con_<?= $r_img['id'] ?>">
                            <a class="cur jaax_sort_data" sort="<?= $r_img['sort'] ?>" dataid="<?= $r_img['id'] ?>"
                               onclick="remove_images_js(this, <?= $r_img['id'] ?>)"><img src="images/x_icon.svg"
                                                                                          alt=""></a>
                            <img src="<?= checkImage($fullpath, $r_img['icon'], $r_img['duongdantin']) ?>">
                        </div>
                    <?php } ?>
                </div>

                <div class="dv-dvjs-ajanh "></div>
                <div class="dv-anh-js-load-err"></div>
                <div class="dv-add-anh">
                    <input type="file" id="upload_mutile_tindang" multiple="multiple" style="padding: 0; height: auto"
                           accept="image/*">
                    +
                </div>
            </div>
            <div class="clr"></div>
            <!--  -->
        </div>
    </div>
<?php } ?>
<?php if (in_array($step, $st_dowload_fl)) { ?>
    <div class="form-group">
        <label for="exampleInputFile">Link Dowload <a
                    data-tooltip="Link dowload ngoài website, ưu tiên lấy link nếu chèn link"> </a></label>
        <input type="text" class="form-control" name="dowload_text"
               value="<?= !empty($dowload_text) ? Show_text($dowload_text) : "" ?>">

    </div>
    <div class="form-group">
        <label for="exampleInputFile">File Dowload: <span>Chỉ upload 1 file [*.pdf] [*.docx] [*.rar] [*.zip] [*.xlsx] dung lượng file tối đa 10MB.</span></label>
        <input name="dowload" type="file" class="form-control" id="exampleInputFile">
        <p style="padding: 0"><?= !empty($dowload) ? '<a href="../datafiles/files/' . $dowload . '" download>' . $dowload . '</a>' : '' ?></p>
    </div>
<?php } ?>
<?php if (in_array($step, $array_only_bv)) { ?>
    <div class="form-group">
        <label>Thuộc chủ đề</label>
        <?= LAY_chude($id_parent, $step, 'id_parent', 'form-control SlectBox', 0, $id_step, 0, 'true', 1) ?>
    </div>
<?php } ?>