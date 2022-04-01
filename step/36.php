<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 10;
else $numview = $thongtin_step['num_view'];

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$key_sohieu = isset($_GET['sh']) ? strip_tags($_GET['sh']) : '';
$key_dm = isset($_GET['dm']) ? strip_tags($_GET['dm']) : '';
$key_tn = isset($_GET['tn']) ? strip_tags($_GET['tn']) : '';
$is_search = $haity == 'search' ? true : false;
$key_banhanh1 = isset($_GET['ngaybh1']) ? strip_tags($_GET['ngaybh1']) : '';
$key_banhanh2 = isset($_GET['ngaybh2']) ? strip_tags($_GET['ngaybh2']) : '';
$key_capnhat1 = isset($_GET['ngaycn1']) ? strip_tags($_GET['ngaycn1']) : '';
$key_capnhat2 = isset($_GET['ngaycn2']) ? strip_tags($_GET['ngaycn2']) : '';
$key_den1 = isset($_GET['ngayden1']) ? strip_tags($_GET['ngayden1']) : '';
$key_den2 = isset($_GET['ngayden2']) ? strip_tags($_GET['ngayden2']) : '';
$key_di1 = isset($_GET['ngaydi1']) ? strip_tags($_GET['ngaydi1']) : '';
$key_di2 = isset($_GET['ngaydi2']) ? strip_tags($_GET['ngaydi2']) : '';

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";
if ($is_search) {
    $name_titile = $glo_lang['tim_kiem'];
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}
$wh = "";
if ($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (" . $lay_all_kx . ") ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_" . $lang . "` LIKE '%" . $key . "%' )";
    if (!empty($key_sohieu)) {
        $wh .= " AND (`mota_" . $lang . "` LIKE '%" . $key_sohieu . "%' )";
    }
    if (!empty($key_dm)) {
        $wh .= " AND (`id_parent` = '$key_dm' )";
    }
}
$wh_is_tinhnang = $wh;
if ($key_tn != "") {
    $list_check = str_replace("-", ",", $_GET['tn']);
    $list_check = trim($list_check, ",");
    $list_check_arr = explode(",", $list_check);
    $tinhnang_rm = DB_fet("*", "`#_baiviet_tinhnang`", "", "`id` DESC", "", "arr");
    foreach ($tinhnang_rm as $rows) {
        if ($rows['id_parent'] != 0) continue;
        ${"wh_end" . $rows['id']} = "";

        foreach ($tinhnang_rm as $rows_2) {
            if ($rows_2['id_parent'] != $rows['id']) continue;
            if (!in_array($rows_2['id'], $list_check_arr)) continue;

            if (${"wh_end" . $rows['id']} != "") {
                ${"wh_end" . $rows['id']} .= " OR ";
            }
            ${"wh_end" . $rows['id']} .= " `id_val` = '" . $rows_2['id'] . "' ";
        }

        if (${"wh_end" . $rows['id']} != "") {
            //query now
            $list_id_tn_sp = DB_que("SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang`  WHERE `showhi` = 1 AND (" . ${"wh_end" . $rows['id']} . ")");
            ${"wh_end" . $rows['id']} = "0";

            $list_id_tn_sp = DB_arr($list_id_tn_sp);
            foreach ($list_id_tn_sp as $rows_bvv) {
                ${"wh_end" . $rows['id']} .= "," . $rows_bvv['id_baiviet'];
            }

            $wh .= " AND `id` IN (" . ${"wh_end" . $rows['id']} . ")";
            $wh_is_tinhnang .= " AND `id` IN (" . ${"wh_end" . $rows['id']} . ")";

        }
    }
}
if (!empty($key_banhanh1) && !empty($key_banhanh2)) {
    $wh .= " AND (`ngaydang` >= '$key_banhanh1' && `ngaydang` <= '$key_banhanh2')";
} else if (!empty($key_banhanh1) && empty($key_banhanh2)) {
    $wh .= " AND (`ngaydang` >= '$key_banhanh1')";
} else if (empty($key_banhanh1) && !empty($key_banhanh2)) {
    $wh .= " AND (`ngaydang` <= '$key_banhanh2')";
}
if (!empty($key_capnhat1) && !empty($key_capnhat2)) {
    $wh .= " AND (`capnhat` >= '$key_capnhat1' && `capnhat` <= '$key_capnhat2')";
} else if (!empty($key_capnhat1) && empty($key_capnhat2)) {
    $wh .= " AND (`capnhat` >= '$key_capnhat1')";
} else if (empty($key_capnhat1) && !empty($key_capnhat2)) {
    $wh .= " AND (`capnhat` <= '$key_capnhat2')";
}
if (!empty($key_den1) && !empty($key_den2)) {
    $wh .= " AND (`ngayden` >= '$key_den1' && `ngayden` <= '$key_den2')";
} else if (!empty($key_den1) && empty($key_den2)) {
    $wh .= " AND (`ngayden` >= '$key_den1')";
} else if (empty($key_den1) && !empty($key_den2)) {
    $wh .= " AND (`ngayden` <= '$key_den2')";
}
if (!empty($key_di1) && !empty($key_di2)) {
    $wh .= " AND (`ngaydi` >= '$key_di1' && `ngaydi` <= '$key_di2')";
} else if (!empty($key_di1) && empty($key_di2)) {
    $wh .= " AND (`ngaydi` >= '$key_di1')";
} else if (empty($key_di1) && !empty($key_di2)) {
    $wh .= " AND (`ngaydi` <= '$key_di2')";
}


//include _source . "phantrang_kietxuat.php";

$numview = $numview == 0 ? 10000 : $numview;
$pzer = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$vi_tri = PHANTRANG_start($pzer, $numview);
if ($pzer == 1 || $pzer == NULL)
    $pzz = 0;
else $pzz = $pzer * $numview;

if (empty($wh)) {
    $wh = '';
}
if (empty($catasort)) {
    $catasort = '`catasort` DESC, `id` DESC';
}
$limit_new = "$vi_tri,$numview";
$nd_kietxuat = DB_fet("*", "#_baiviet", "`step` IN (" . $slug_step . ") $wh  ", $catasort, $limit_new, 1);
$nd_total = count(DB_fet("*", "#_baiviet", "`step` IN (" . $slug_step . ") $wh  ", "", "", 1));
$numshow = ceil($nd_total / $numview);
$sotrang = PHANTRANG_findPages($nd_total, $numview);

include _source . "box-header.php";
$nd_tinhnang = LAY_bv_tinhnang($slug_step, "", "`opt2` = 1");
$nd_danhmuc = LAY_danhmuc($slug_step, "", "`id_parent` = 0");
?>

<div class="page_conten_page">
    <div class="pagewrap">
        <div class="tin_left">
            <div class="ExContent">
                <table style="height: auto; width: 100%;" id="tablefind" name="tablefind">
                    <tbody>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['ten_van_ban'] ?>:</td>
                        <td><input name="" type="text" id="" class="key_timkiem" value="<?= $key ?>"
                                   data-href="<?= $full_url . "/" . $thongtin_step['seo_name'] ?>"></td>
                    </tr>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['so_hieu_van_ban'] ?>:</td>
                        <td><input name="" type="text" id="" class="key_sohieu" value="<?= $key_sohieu ?>"></td>
                    </tr>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['co_quan_ban_hanh'] ?>:</td>
                        <td>
                            <select name="key_dm" id="key_dm">
                                <option value=""><?= $glo_lang['toan_bo'] ?></option>
                                <?php
                                foreach ($nd_danhmuc as $rows) {
                                    ?>
                                    <option <?= $key_dm == $rows['id'] ? "selected" : "" ?>
                                            value="<?= $rows['id'] ?>"><?= $rows['tenbaiviet_' . $lang] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($nd_tinhnang as $rows) {
                        if ($rows['id_parent'] != 0) continue;
                        if ($i > 3) continue;
                        ?>
                        <tr>
                            <td class="auto-style1"><?= $rows['tenbaiviet_' . $lang] ?>:</td>
                            <td>
                                <select name="keytn<?= $i ?>" id="keytn<?= $i ?>">
                                    <option value="<?= $rows['id'] ?>"><?= $glo_lang['toan_bo'] ?></option>
                                    <?php
                                    foreach ($nd_tinhnang as $rows_2) {
                                        if ($rows_2['id_parent'] != $rows['id']) continue;
                                        ?>
                                        <option <?= @$list_check_arr[$i - 1] == $rows_2['id'] ? "selected" : "" ?>
                                                value="<?= $rows_2['id'] ?>"><?= $rows_2['tenbaiviet_' . $lang] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <?php $i++;
                    } ?>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['ngay_ban_hanh'] ?>:</td>
                        <td>
                            <input class="datepicker" type="text" id="key_banhanh_1" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_banhanh1) ? date("d/m/Y", $key_banhanh1) : "" ?>">
                            <span><?= $glo_lang['den'] ?></span>
                            <input class="datepicker" type="text" id="key_banhanh_2" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_banhanh2) ? date("d/m/Y", $key_banhanh2) : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['ngay_cap_nhat'] ?>:</td>
                        <td>
                            <input class="datepicker" type="text" id="key_capnhat_1" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_capnhat1) ? date("d/m/Y", $key_capnhat1) : "" ?>">
                            <span><?= $glo_lang['den'] ?></span>
                            <input class="datepicker" type="text" id="key_capnhat_2" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_capnhat2) ? date("d/m/Y", $key_capnhat2) : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['ngay_cong_van_den'] ?>:</td>
                        <td>
                            <input class="datepicker" type="text" id="key_den_1" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_den1) ? date("d/m/Y", $key_den1) : "" ?>">
                            <span><?= $glo_lang['den'] ?></span>
                            <input class="datepicker" type="text" id="key_den_2" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_den2) ? date("d/m/Y", $key_den2) : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="auto-style1"><?= $glo_lang['ngay_cong_van_di'] ?>:</td>
                        <td>
                            <input class="datepicker" type="text" id="key_di_1" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_di1) ? date("d/m/Y", $key_di1) : "" ?>">
                            <span><?= $glo_lang['den'] ?></span>
                            <input class="datepicker" type="text" id="key_di_2" placeholder="dd/mm/YYYY"
                                   value="<?= !empty($key_di2) ? date("d/m/Y", $key_di2) : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <div style="text-align: left;">
                                <a onclick="Refresh(tablefind)" style="cursor:pointer"
                                   class="button"><?= $glo_lang['lam_lai'] ?></a>
                                <a onclick="SEARCH_timkiem_vanban('<?= $full_url . "/" . $thongtin_step['seo_name'] ?>')"
                                   style="cursor:pointer" class="button"><?= $glo_lang['tim_kiem'] ?></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="clr"></div>
            </div>
            <div class="List">
                <div class="Title">
                    <span id="ctrl_143205_89_lbTong"><?= $glo_lang['tong_so'] ?>: <?= $nd_total ?></span>
                </div>
                <div class="Title_1">
                    <?= $glo_lang['van_ban_luu_hanh'] ?>
                </div>
                <div>
                    <table cellspacing="0" rules="all" border="1" id="ctrl_143205_89_gvDanhSach"
                           style="width:100%;border-collapse:collapse;">
                        <tbody>
                        <tr>
                            <th width="10%" scope="col"><?= $glo_lang['stt'] ?></th>
                            <th width="20%" scope="col"><?= $glo_lang['so_hieu_van_ban'] ?></th>
                            <th width="20%" scope="col"><?= $glo_lang['ngay_ban_hanh'] ?></th>
                            <th width="20%" scope="col"><?= $glo_lang['co_quan_ban_hanh'] ?></th>
                            <th scope="col"><?= $glo_lang['ten_van_ban'] ?></th>
                        </tr>
                        <?php
                        if ($nd_total == 0) {
                            echo "<td colspan='5' class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</td>";
                        } else {
                            $i = 0;
                            $danhmuc_list = LAY_danhmuc($slug_step);
                            $list_danhmuc_nd = array();
                            foreach ($danhmuc_list as $rs) {
                                $list_danhmuc_nd[$rs['id'] . "_" . $lang] = $rs['tenbaiviet_' . $lang];
                            }
                            foreach ($nd_kietxuat as $rows) {
                                $i++;

                                $link = "";
                                $target = "";
                                if ($rows['dowload_text'] != "") {
                                    $link = $rows['dowload_text'];
                                    $target = "target='_blank'";
                                    $ex = explode(".", $rows['dowload_text']);
                                    $ex = end($ex);
                                } else if ($rows['dowload'] != "") {
                                    $link = $fullpath . "/datafiles/files/" . $rows['dowload'];
                                    $target = "download";
                                    $ex = explode(".", $rows['dowload']);
                                    $ex = end($ex);
                                }
                                ?>
                                <tr>
                                    <td>
                                        <span><?= ($pzer - 1) * $numview + $i ?></span>
                                    </td>
                                    <td>
                                        <span><?= $rows['mota_' . $lang] ?></span>
                                    </td>
                                    <td>
                                        <span><?= date("d/m/Y", $rows['ngaydang']) ?></span>
                                    </td>
                                    <td>
                                        <span><?= $list_danhmuc_nd[$rows['id_parent'] . "_" . $lang] ?></span>
                                    </td>
                                    <td>
                                        <span><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></span>
                                        <div class="view-count"><a class="cur"
                                                    onclick="viewCount('<?= $link ?>',<?= $rows['id'] ?>)" <?= $target ?>>
                                                <i class="fa fa-download"></i><?= $glo_lang['tai_ve'] ?>
                                                (<span class="luot_tai<?= $rows['id'] ?>"><?= $rows['soluotxem'] ?></span>)</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                    <div class="nums no_box">
                        <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                        <div class="clr"></div>
                    </div>
                </div>

            </div>

        </div>
        <?php include _source . "tin_right.php"; ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>
<script src="js/jquery-ui.js?v=2"></script>
<link rel="stylesheet" href="css/jquery-ui.css?v=2">
<script type="text/javascript">
    $('.datepicker').attr('autocomplete', 'off');
    $(".datepicker").each(function () {
        $(this).datepicker({
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            format: 'dd/mm/yyyy'
        });
    });
    $("#datepicker").datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        format: 'dd/mm/yyyy'
    });
</script>
<script type="text/javascript">
    function SEARCH_timkiem_vanban(url) {
        var key_timkiem = $(".key_timkiem").val().trim().replace(/ /g, "+");
        var key_sohieu = $(".key_sohieu").val();
        var key_dm = $("#key_dm option:selected").val();
        var key_tn1 = $("#keytn1 option:selected").val();
        var key_tn2 = $("#keytn2 option:selected").val();
        var key_tn3 = $("#keytn3 option:selected").val();
        var key_banhanh_1 = !isEmpty($("#key_banhanh_1").val()) ? Date.parse(changeFormatDate($("#key_banhanh_1").val()) + ' 00:00:00') / 1000 : "";
        var key_banhanh_2 = !isEmpty($("#key_banhanh_2").val()) ? Date.parse(changeFormatDate($("#key_banhanh_2").val()) + ' 23:59:59') / 1000 : "";
        var key_capnhat_1 = !isEmpty($("#key_capnhat_1").val()) ? Date.parse(changeFormatDate($("#key_capnhat_1").val()) + ' 00:00:00') / 1000 : "";
        var key_capnhat_2 = !isEmpty($("#key_capnhat_2").val()) ? Date.parse(changeFormatDate($("#key_capnhat_2").val()) + ' 23:59:59') / 1000 : "";
        var key_den_1 = !isEmpty($("#key_den_1").val()) ? Date.parse(changeFormatDate($("#key_den_1").val()) + ' 00:00:00') / 1000 : "";
        var key_den_2 = !isEmpty($("#key_den_2").val()) ? Date.parse(changeFormatDate($("#key_den_2").val()) + ' 23:59:59') / 1000 : "";
        var key_di_1 = !isEmpty($("#key_di_1").val()) ? Date.parse(changeFormatDate($("#key_di_1").val()) + ' 00:00:00') / 1000 : "";
        var key_di_2 = !isEmpty($("#key_di_2").val()) ? Date.parse(changeFormatDate($("#key_di_2").val()) + ' 23:59:59') / 1000 : "";

        var tn = key_tn1 + "-" + key_tn2 + "-" + key_tn3;
        if (!isEmpty(key_banhanh_1)) {
            key_banhanh_1 = "&ngaybh1=" + key_banhanh_1;
        }
        if (!isEmpty(key_banhanh_2)) {
            key_banhanh_2 = "&ngaybh2=" + key_banhanh_2;
        }
        if (!isEmpty(key_capnhat_1)) {
            key_capnhat_1 = "&ngaycn1=" + key_capnhat_1;
        }
        if (!isEmpty(key_capnhat_2)) {
            key_capnhat_2 = "&ngaycn2=" + key_capnhat_2;
        }
        if (!isEmpty(key_den_1)) {
            key_den_1 = "&ngayden1=" + key_den_1;
        }
        if (!isEmpty(key_den_2)) {
            key_den_2 = "&ngayden2=" + key_den_2;
        }
        if (!isEmpty(key_di_1)) {
            key_di_1 = "&ngaydi1=" + key_di_1;
        }
        if (!isEmpty(key_di_2)) {
            key_di_2 = "&ngaydi2=" + key_di_2;
        }

        window.location.href = url + "/search/?key=" + key_timkiem + "&sh=" + key_sohieu + "&dm=" + key_dm + "&tn=" + tn
            + key_banhanh_1 + key_banhanh_2 + key_capnhat_1 + key_capnhat_2 + key_den_1 + key_den_2 +
            key_di_1 + key_di_2;

    }

    $('.key_timkiem').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var href = $(this).attr('data-href');
            SEARCH_timkiem_vanban(href);
        }
    });

    function Refresh() {
        $("#tablefind input").val("");
        $('#tablefind select option').removeAttr("selected");
    }

    function viewCount(link, id) {
        if (!isEmpty(link)) {
            window.location.href = link;
            $.ajax({
                type: "POST",
                url: "<?=$full_url . "/update-luot-tai/"?>",
                data: {
                    "id": id,
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.type == 1) {
                        $(".luot_tai" + id).html(data.data);
                    }
                }
            });
        }else{
            alert("<?=$glo_lang['alert_du_lieu']?>");
        }
    }
</script>
