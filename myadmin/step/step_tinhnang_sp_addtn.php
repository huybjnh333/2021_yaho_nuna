<!-- //tinh nang -->
<link rel="stylesheet" href="dist/bootstrap-tagsinput.css">
<script src="dist/bootstrap-tagsinput.min.js"></script>
<style>
    .dv-ground-tinhnang .form-group {
        width: calc(20% - 10px);
        float: left;
        padding: 6px;
        border: 1px solid #e0e0e09e;
        margin-right: 10px;
        line-height: 1;
        border-radius: 4px;
        transition: all .5s;
        margin-bottom: 10px;
    }

    .dv-ground-tinhnang .form-group p {
        width: 100%;
        display: block;
        float: left;
        margin: 0px 0 10px 0;
        font-weight: 500;
        color: #adadad;
    }

    .dv-ground-tinhnang .form-group label {
        float: left;
        width: 100%;
        line-height: 20px;
        margin: 0 0 0px !important;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        font-weight: 500
    }

    .dv-ground-tinhnang .form-group input[type="text"] {
        height: 28px;
        padding: 0 7px;
        border-radius: 3px;
    }

    .dv-ground-tinhnang .form-group:hover {
        border-color: #e0e0e0;
        border-radius: 7px;
    }

    .dv-pro-thuoctinh.form-group .addtt {
        display: inline-block;
        padding: 5px 10px;
        background: #3c8dbc;
        border-radius: 4px;
        margin: 7px 0px 0 10px;
        color: #fff;
    }

    .dv-pro-thuoctinh .th_1 {
        width: 250px;
    }

    .bootstrap-tagsinput {
        width: 100%;
        padding: 0 6px !important;
        border-radius: 0 !important;
    }

    .bootstrap-tagsinput input {
        display: inline-block !important;
        height: 30px;
    }

    .dv-pro-thuoctinh .th_3 {
        width: 50px;
    }

    .dv-yags-en {
        margin-top: 5px;
        display: none
    }

    .dv-pbh1 {
        width: 50px;
        float: left;
    }

    .dv-pbh2 {
        width: 250px;
        float: left;
    }

    .dv-pbh3 {
        width: calc(100% - 300px);
        float: left;
    }

    .clr {
        clear: both;
        height: 0
    }

    .dv-js-jjthuoctinh .gr {
        border-top: 1px solid #e8e8e8;
        padding: 10px 0;
    }

    .dv-cacphienban > h3 {
        font-size: 13px;
    }

    .dv-cont-pb .hd {
        background: #ecf0f5;
        padding: 7px 0;
        font-weight: 600;
        color: #3c8dbc;
    }
</style>
<div class="box p10">
    <div class="form-group">
        <label>Thuộc tính </label>
    </div>
    <div class="dv-pro-thuoctinh form-group">
        <table style="width: 100%">
            <tr>
                <th class="th_1">Tên thuộc tính</th>
                <th class="th_2">Giá trị <a data-tooltip="Mỗi giá trị cách nhau bởi dấu ,"> </a></th>
                <th class="th_3"></th>
            </tr>
            <tr class="tr_thuoctinh_1">
                <td>
                    <input name="thuoc_tinh_1_vi" type="text"
                           value="<?= !empty($thuoc_tinh_1_vi) ? $thuoc_tinh_1_vi : "" ?>"
                           class="lang_vii form-control thuoc_tinh_1_vi">
                    <input name="thuoc_tinh_1_en" type="text"
                           value="<?= !empty($thuoc_tinh_1_en) ? $thuoc_tinh_1_en : "" ?>"
                           class="lang_enn form-control thuoc_tinh_1_en" style="display: none">
                </td>
                <td>
                    <div class="dv-yags-vi acti">
                        <input name="gia_tri_1_vi" type="text" value="<?= !empty($gia_tri_1_vi) ? $gia_tri_1_vi : "" ?>"
                               class="form-control gia_tri_1_vi js_taginput tagsinput_1" data-role="tagsinput">
                    </div>
                    <div class="dv-yags-en">
                        <input name="gia_tri_1_en" type="text" value="<?= !empty($gia_tri_1_en) ? $gia_tri_1_en : "" ?>"
                               class="form-control gia_tri_1_en"
                               placeholder="Nhập tiếng anh cho cột giá trị, mỗi giá trị cách nhau bởi dấu , tương đương như Tiếng Việt">
                    </div>
                </td>
                <td></td>
            </tr>
            <tr class="tr_thuoctinh_2 <?= !empty($thuoc_tinh_2_vi) && $thuoc_tinh_2_vi != '' ? "" : "hide" ?> ">
                <td>
                    <input name="thuoc_tinh_2_vi" type="text"
                           value="<?= !empty($thuoc_tinh_2_vi) ? $thuoc_tinh_2_vi : "" ?>"
                           class="lang_vii form-control thuoc_tinh_2_vi">
                    <input name="thuoc_tinh_2_en" type="text"
                           value="<?= !empty($thuoc_tinh_2_en) ? $thuoc_tinh_2_en : "" ?>"
                           class="lang_enn form-control thuoc_tinh_2_en" style="display: none">
                </td>
                <td>
                    <div class="dv-yags-vi acti">
                        <input name="gia_tri_2_vi" type="text" value="<?= !empty($gia_tri_2_vi) ? $gia_tri_2_vi : "" ?>"
                               class="form-control gia_tri_2_vi js_taginput tagsinput_2" data-role="tagsinput">
                    </div>
                    <div class="dv-yags-en">
                        <input name="gia_tri_2_en" type="text" value="<?= !empty($gia_tri_2_en) ? $gia_tri_2_en : "" ?>"
                               class="form-control gia_tri_2_en"
                               placeholder="Nhập tiếng anh cho cột giá trị, mỗi giá trị cách nhau bởi dấu , tương đương như Tiếng Việt">
                    </div>
                </td>
                <td>
                    <a class="cur" onclick="hide_thuoc_tinh(2)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
            <tr class="tr_thuoctinh_3 <?= !empty($thuoc_tinh_3_vi) && $thuoc_tinh_3_vi != '' ? "" : "hide" ?>">
                <td>
                    <input name="thuoc_tinh_3_vi" type="text"
                           value="<?= !empty($thuoc_tinh_3_vi) ? $thuoc_tinh_3_vi : "" ?>"
                           class="lang_vii form-control thuoc_tinh_3_vi">
                    <input name="thuoc_tinh_3_en" type="text"
                           value="<?= !empty($thuoc_tinh_3_en) ? $thuoc_tinh_3_en : "" ?>"
                           class="lang_enn form-control thuoc_tinh_3_en" style="display: none">
                </td>
                <td>
                    <div class="dv-yags-vi acti">
                        <input name="gia_tri_3_vi" type="text" value="<?= !empty($gia_tri_3_vi) ? $gia_tri_3_vi : "" ?>"
                               class="form-control js_taginput tagsinput_3 gia_tri_3_vi" data-role="tagsinput">
                    </div>
                    <div class="dv-yags-en">
                        <input name="gia_tri_3_en" type="text" value="<?= !empty($gia_tri_3_en) ? $gia_tri_3_en : "" ?>"
                               class="form-control gia_tri_3_en"
                               placeholder="Nhập tiếng anh cho cột giá trị, mỗi giá trị cách nhau bởi dấu , tương đương như Tiếng Việt">
                    </div>
                </td>
                <td>
                    <a class="cur" onclick="hide_thuoc_tinh(3)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>

        </table>
        <a class="cur addtt"
           onclick="them_thuoc_tinh()" <?= @$thuoc_tinh_2_vi != "" && $thuoc_tinh_3_vi != "" ? 'style="display: none;"' : '' ?> >Thêm
            thuộc tính khác</a>
        <div class="dv-cacphienban hidden">
            <h3>Chỉnh sửa các phiên bản dưới đây để tạo:</h3>
            <div class="dv-cont-pb">
                <div class="gr">
                    <div class="dv-pbh1 hd">&nbsp;</div>
                    <div class="dv-pbh2 hd">Phiên bản</div>
                    <div class="dv-pbh3 hd">Giá</div>
                    <div class="clr"></div>
                </div>
                <div class="dv-js-jjthuoctinh"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="js_vitri" class="js_vitri" value="">
<?php
$gia_luu = DB_fet("*", "`#_baiviet_thuoctinh`", "`id_sp` = '$id'", "", "", "arr", "catasort");
?>
<script>
    var vitri = 0;

    function LOAD_html_thuoctinh(thuoctinh) {
        if (thuoctinh != "") {
            $(".dv-js-jjthuoctinh").append('<div class="gr"><input type="hidden" name="thuoctinh_sort_' + vitri + '" value="' + vitri + '"><input type="hidden" name="thuoctinh_name_' + vitri + '" value="' + thuoctinh + '"><div class="dv-pbh1"><input type="checkbox" name="thuoctinh_showhi_' + vitri + '" class="thuoctinh_showhi_' + vitri + '"  checked="checked"></div><div class="dv-pbh2">' + thuoctinh + '</div><div class="dv-pbh3"><input type="text" class="price_thuoc_tinh_' + vitri + '" name="thuoctinh_pri_' + vitri + '" onkeyup="SetCurrency(this)" value=""></div><div class="clr"></div></div>');
            $(".js_vitri").val(vitri);
            vitri++;
        }
        <?php
        foreach ($gia_luu as $key => $value) {
        if($value['showhi'] == 0){
        ?>
        $(".thuoctinh_showhi_<?=$key ?>").attr('checked', false);
        <?php } ?>
        $(".price_thuoc_tinh_<?=$key ?>").val("<?=NUMBER_fomat($value['gia']) ?>");
        <?php } ?>
    }

    function LOAD_thuoctinh_pri() {
        vitri = 0;
        $(".js_vitri").val("");
        $(".dv-js-jjthuoctinh").html("");
        var arr_1 = "";
        var arr_2 = "";
        var arr_3 = "";
        $('.js_taginput').each(function () {
            if (arr_1 == "") arr_1 = $(this).val();
            else if (arr_2 == "") arr_2 = $(this).val();
            else if (arr_3 == "") arr_3 = $(this).val();
        });
        arr_1 = arr_1.split(",");
        arr_2 = arr_2.split(",");
        arr_3 = arr_3.split(",");
        if (arr_1 != "") {
            arr_1.forEach(function (a1) {
                var list_key = "";
                if (a1 != "") {
                    list_key += a1;
                    // a2
                    if (arr_2 != "") {
                        arr_2.forEach(function (a2) {
                            if (a2 != "") {
                                // arr_3
                                if (arr_3 != "") {
                                    arr_3.forEach(function (a3) {
                                        if (a3 != "") {
                                            LOAD_html_thuoctinh(list_key + "," + a2 + "," + a3);
                                        }
                                    });
                                } else {
                                    LOAD_html_thuoctinh(list_key + "," + a2);
                                }
                                //
                            }
                        });
                    } else if (arr_3 != "") {
                        arr_3.forEach(function (a3) {
                            if (a3 != "") {
                                LOAD_html_thuoctinh(list_key + "," + a3);
                            }
                        });
                    } else {
                        LOAD_html_thuoctinh(list_key);
                    }
                    //
                }
            });
        }
    }

    $('.js_taginput').on('change', function (event) {
        LOAD_thuoctinh_pri();
    });
    $(".js_tab_vi").click(function () {
        $(".lang_vii").show();
        $(".lang_enn").hide();
        $(".dv-yags-en").hide();
    });
    $(".js_tab_en").click(function () {
        $(".lang_vii").hide();
        $(".lang_enn").show();
        $(".dv-yags-en").show();
    });

    function hide_thuoc_tinh(id) {
        $(".tr_thuoctinh_" + id).addClass("hide");
        $(".tagsinput_" + id).tagsinput('removeAll');
        $(".thuoc_tinh_" + id + "_vi").val("");
        $(".thuoc_tinh_" + id + "_en").val("");
        $(".gia_tri_" + id + "_vi").val("");
        $(".gia_tri_" + id + "_en").val("");
        $(".addtt").show();

        LOAD_thuoctinh_pri();
    };

    function them_thuoc_tinh() {
        if ($(".tr_thuoctinh_2.hide").length > 0) $(".tr_thuoctinh_2").removeClass("hide");
        else if ($(".tr_thuoctinh_3.hide").length > 0) $(".tr_thuoctinh_3").removeClass("hide");
        if ($(".tr_thuoctinh_2.hide").length == 0 && $(".tr_thuoctinh_3.hide").length == 0) $(".addtt").hide();
    };

</script>
<!-- end -->