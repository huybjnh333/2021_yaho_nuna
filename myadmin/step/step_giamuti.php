<?php
$nhomgia_list_arr = array();
if ($id > 0) {
    $nhomgia_list = DB_que("SELECT * FROM `#_baiviet_select_nhomgia` WHERE `id_baiviet` = '$id' AND `showhi` = 1");
    $nhomgia_list = DB_arr($nhomgia_list);

    foreach ($nhomgia_list as $rs) {
        $gia = str_replace(".", "", $rs['id_val']);
        $gia = str_replace(",", "", $gia);
        $nhomgia_list_arr[$rs['id_nhomgia']] = is_numeric($gia) ? $gia : 0;
    }
}

$nhomgia_arr = LAY_bv_gia($step);
foreach ($nhomgia_arr as $value) {
    ?>
    <div class="form-group">
        <label>Giá <?= $value['tenbaiviet_vi'] ?></label>
        <div class="dv-lbtinhnang flex">
            <input type="hidden" name="nhomgia_arr_id[]" value="<?= $value['id'] ?>">
            <input type="text" name="nhomgia_arr[]" value="<?= @NUMBER_fomat($nhomgia_list_arr[$value['id']]) ?>"
                   onkeyup="SetCurrency(this)">
            <div class="clear"></div>
        </div>
    </div>
<?php } ?>