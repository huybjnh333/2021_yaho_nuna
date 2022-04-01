<?php
$table = '#_marketing';
$tit_glo = "Thông báo tự động";
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-thong-bao-tu-dong-add.php";
} else {
    if (isset($_POST['is_coppy_sl']) && $_POST['is_coppy_sl'] != 0 && isset($_POST['is_coppy_sl_id']) && $_POST['is_coppy_sl_id'] != 0) {

        for ($i = 0; $i < $_POST['is_coppy_sl']; $i++) {
            COPPY_row($table, $_POST['is_coppy_sl_id'], $step);
        }
    }
    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {

        for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];

            if (isset($_POST["xoa_gr_arr_$i"])) {

                $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                if (DB_num($sql_se) > 0) {
                    $sql_se = DB_arr($sql_se, 1);
                    $icon = $sql_se['icon'];
                    $duongdantin = $sql_se['duongdantin'];
                    $del_name = $sql_se['tenbaiviet_vi'];
                    $id = $sql_se['id'];

                    @unlink("../" . $duongdantin . "/" . $icon);
                    DB_que("DELETE from $table WHERE `id` ='" . $idofme . "' LIMIT 1");

                    $_SESSION['show_message_on'] = 'Xóa dữ liệu [<strong>' . $del_name . '</strong>] thành công';
                }
            }
        }
        //update anh voi row = null
        if (isset($_FILES['is_muti_file'])) {
            //

            foreach ($_FILES['is_muti_file']['name'] as $name => $value) {
                if ($_FILES['is_muti_file']['name'][$name] == "") continue;
                $uploaddir = "../$duongdantin/";
                $img_real_name = time() . "_" . CONVERT_vn($_FILES['is_muti_file']['name'][$name]);

                // check _sp co anh null
                $sql = DB_que("SELECT * FROM `$table` WHERE `icon` = '' LIMIT 1");

                if (DB_num($sql)) {
                    if (move_uploaded_file($_FILES['is_muti_file']['tmp_name'][$name], $uploaddir . $img_real_name)) {
                        TAO_anhthumb($uploaddir . $img_real_name, $uploaddir . "thumb_" . $img_real_name, 200, 200);
                    }
                } else {
                    break;
                }
                $sql = DB_arr($sql, 1);
                $id_x = $sql["id"];

                DB_que("UPDATE  `$table` SET `icon` = '$img_real_name' WHERE `id` = '" . $id_x . "' LIMIT 1", $table);

            }
        }

        //
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }


    $sql = DB_que("SELECT * FROM `$table` ORDER BY `catasort` DESC ");
    $sql_array = DB_arr($sql);

    ?>
    <section class="content-header">
        <h1><?php if (isset($_SESSION['admin'])) { ?><a onclick="LOAD_sort()"
                                                        class="cur load_okkk">[SORT]</a> <?php } ?><?= $tit_glo ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active"><?= $tit_glo ?></li>
        </ol>
    </section>
    <script>
        function LOAD_sort() {
            var n_sort = $(".table-danhsach tr").length;
            $(".table-danhsach tr").each(function (index) {
                $('td:nth-child(1) input[type="text"]', this).val(n_sort - index);
                $('td:nth-child(1) input[type="text"]', this).trigger('change');
            });
            $(".load_okkk").html("[OK]");
        }
    </script>
    <form action="" method="post" enctype='multipart/form-data'>
        <?php
        if (isset($_SESSION['admin'])) {
            ?>
            <div style=" padding: 0 20px;">
                <input type="text" name="is_coppy_sl_id" value="0" placeholder="ID coppy">
                <input type="text" name="is_coppy_sl" value="0" placeholder="Số lượng coppy">
                <input type="file" name="is_muti_file[]" multiple="multiple">
            </div>
        <?php } ?>
        <input type="hidden" name="token" value="<?= GET_token() ?>">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <?php include _source . "mesages.php"; ?>
                    <div class="box">
                        <div class="box-header">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> <?= $tit_glo ?>
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <div class="dv-caidat-mtk">
                            <style type="text/css">
                                .dv-caidat-cont {
                                    display: none
                                }

                                .dv-caidat-cont.acti {
                                    display: block
                                }

                                .dv-caidat-mtk {
                                    padding: 0 10px;
                                }

                                .dv-caidat-mtk i {
                                    margin-right: 5px;
                                }

                                .dv-nhom-cd span {
                                    display: inline-block;
                                    width: 200px;
                                }

                                .dv-nhom-cd select, .dv-nhom-cd input {
                                    width: calc(100% - 220px);
                                    border: 1px solid #dcdcdc;
                                    padding: 0 6px;
                                    height: 28px;
                                    margin-top: 5px;
                                    outline: none
                                }
                            </style>
                            <a class="cur" onclick="show_setting()"><i class="fa fa-cog"></i>Cài đặt</a>
                            <script type="text/javascript">
                                function show_setting() {
                                    if ($(".dv-caidat-cont").hasClass("acti")) $(".dv-caidat-cont").removeClass("acti");
                                    else $(".dv-caidat-cont").addClass("acti");
                                }
                            </script>
                            <?php
                            $db_que = DB_que("SELECT * FROM `#_marketing_setting` WHERE `id` = 1 LIMIT 1");
                            $db_que = DB_arr($db_que, 1);
                            ?>
                            <div class="dv-caidat-cont">
                                <div class="dv-nhom-cd">
                                    <span>Vị trí hiển thị</span>
                                    <select onchange="UPDATE_colum(this, 1, 'is_vitri','#_marketing_setting')">
                                        <option value="0" <?= $db_que['is_vitri'] == 0 ? "selected='selected'" : "" ?>>
                                            Bên trái dưới
                                        </option>
                                        <option value="1" <?= $db_que['is_vitri'] == 1 ? "selected='selected'" : "" ?>>
                                            Bên trái trên
                                        </option>
                                        <option value="2" <?= $db_que['is_vitri'] == 2 ? "selected='selected'" : "" ?>>
                                            Bên phải trên
                                        </option>
                                        <option value="3" <?= $db_que['is_vitri'] == 3 ? "selected='selected'" : "" ?>>
                                            Bên phải dưới
                                        </option>
                                    </select>
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Thời gian chờ load lần đầu (s)</span>
                                    <input type="text" value="<?= $db_que['time_load_lan'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'time_load_lan','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Thời gian hiển thị (s)</span>
                                    <input type="text" value="<?= $db_que['time_hien_thi'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'time_hien_thi','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Thời gian chờ (s)</span>
                                    <input type="text" value="<?= $db_que['time_cho'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'time_cho','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Màu nền</span>
                                    <input type="text" value="<?= $db_que['mau_nen'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'mau_nen','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Màu chữ</span>
                                    <input type="text" value="<?= $db_que['mau_chu'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'mau_chu','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <div class="dv-nhom-cd">
                                    <span>Màu tên</span>
                                    <input type="text" value="<?= $db_que['mau_ten'] ?>"
                                           onchange="UPDATE_colum(this, '1', 'mau_ten','#_marketing_setting')">
                                    <div class="clr"></div>
                                </div>
                                <!-- <div class="dv-nhom-cd">
                          <span>Màu tim</span>
                          <input type="text" value="<?= $db_que['mau_tim'] ?>" onchange="UPDATE_colum(this, '1', 'mau_tim','#_marketing_setting')">
                          <div class="clr"></div>
                        </div> -->
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding table-danhsach-cont">
                            <table class="table table-hover table-danhsach">
                                <tbody>
                                <tr>
                                    <th class="w80 text-center">STT</th>
                                    <th>Tiêu đề</th>
                                    <th class="w100 text-center">Hình ảnh</th>
                                    <th class="w100 text-center">Hiển thị</th>
                                    <th class="w50 text-center">
                                        <label>
                                            <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                        </label>
                                    </th>
                                </tr>
                                <?php
                                $cl = 0;
                                foreach ($sql_array as $rows) {
                                    $cl++;

                                    $ida = SHOW_text($rows['id']);
                                    foreach ($rows as $key => $value) {
                                        ${$key} = SHOW_text($value);
                                    }
                                    $catasort = number_format($catasort, 0, ',', '.');

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <input type="text" class="text-center" value="<?= $catasort ?>"
                                                   onchange="UPDATE_colum(this, '<?= $ida ?>', 'catasort','<?= $table ?> ')">
                                        </td>
                                        <td>
                                            <div class="name">
                                                <a href="<?= $url_page ?>&edit=<?= $ida ?>"
                                                   title="Cập nhật"><?= $tenbaiviet_vi ?></a>
                                            </div>
                                            <p style="color: #FF5722; padding: 0; margin: 0; font-size: 12px;"><?= $mota_vi ?></p>
                                            <p style="color: #4caf50; padding: 0; margin: 0; font-size: 12px;"><?= $noidung_vi ?></p>
                                        </td>
                                        <td class="text-center">
                                            <img class='img_show_ds'
                                                 src='<?= $fullpath . "/" . $rows['duongdantin'] . "/thumb_" . $icon ?>'>
                                        </td>
                                        <td class="text-center">
                                            <div id="cus" class="cus_menu">
                                                <label><input showhi type='checkbox' class='minimal minimal_click'
                                                              colum="showhi" idcol="<?= $ida ?>" table="<?= $table ?>"
                                                              value='1' <?= LAY_checked($showhi, 1) ?>></label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                   class='minimal cls_showxoa'>
                                        </td>
                                    </tr>
                                    <!--  -->
                                <?php } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <!--  -->
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>