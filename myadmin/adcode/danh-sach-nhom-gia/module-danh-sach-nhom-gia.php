<?php

$table = '#_baiviet_nhomgia';
$name_tit = "Danh sách nhóm giá";

if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-nhom-gia-add.php";
} else {


    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];
            $up_sort = "";
            if (isset($_POST["sortby$i"])) {
                $sort = str_replace(".", "", $_POST["sortby$i"]);
                $up_sort = ", `catasort`='$sort'";
            }

            if (isset($_POST["xoa_gr_arr_$i"])) {
                //xoa
                $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                if (DB_num($sql_se) > 0) {
                    $sql_se = DB_arr($sql_se, 1);
                    $del_name = $sql_se['tenbaiviet_vi'];
                    $id = $sql_se['id'];

                    $sql = DB_que("DELETE from $table WHERE `id` ='" . $idofme . "' LIMIT 1");
                    //xoa pr child
                    $sql_se_c1 = DB_que("SELECT * FROM `$table` WHERE `id_parent`='" . $idofme . "'");
                    $sql_se_c1 = DB_arr($sql_se_c1);
                    foreach ($sql_se_c1 as $row_1) {
                        DB_que("DELETE from $table WHERE `id`  = '" . $row_1['id'] . "' LIMIT 1");
                        DB_que("DELETE from $table WHERE `id_parent` ='" . $row_1['id'] . "'");
                    }
                }
                //
            }
        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }


    $sql = DB_que("SELECT * FROM `$table` WHERE `step` = '" . $step . "' ORDER BY `catasort` ASC");
    $sql_array = DB_arr($sql);
    ?>
    <section class="content-header">
        <h1><?php if (isset($_SESSION['admin'])) { ?><a onclick="LOAD_sort()"
                                                        class="cur load_okkk">[SORT]</a> <?php } ?> Danh sách tính năng
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Danh sách tính năng</li>
        </ol>
    </section>
    <script>
        function LOAD_sort() {
            var n_sort = $("input[name^='sortby']").length;
            $("input[name^='sortby']").each(function (index) {
                $(this).val(index + 1);
            });
            $(".load_okkk").html("[OK]");
        }
    </script>
    <style>
        .cls_tieubieu {
            display: none
        }

        .cls_noibat {
            display: none
        }
    </style>
    <form action="" method="post">
        <input type="hidden" name="token" value="<?= GET_token() ?>">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> <?= GETNAME_step($step) ?>
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <?php
                        $name_list_opti_tn = json_decode($name_list_opti_tn, true);
                        ?>
                        <div class="box-body table-responsive no-padding table-danhsach-cont">
                            <table class="table table-hover table-danhsach">
                                <tbody>
                                <tr>

                                    <th class="w80 text-center">STT</th>

                                    <th>Tiêu đề</th>
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
                                    if ($rows['id_parent'] != 0) continue;
                                    $cl++;
                                    $ida = SHOW_text($rows['id']);
                                    foreach ($rows as $key => $value) {
                                        ${$key} = $value;
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
                                                <a href="<?= $url_page ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&edit=<?= $ida ?>"
                                                   title="<?= luu_lai ?>"><?= $tenbaiviet_vi ?></a>
                                                <p class="p_lang_en"><?= $tenbaiviet_en ?></p>
                                            </div>
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
                                <?php } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <div class="dv-show-setting">
                            <?= admin_input_setting(64) ?>
                            <?= admin_input_setting(65) ?>
                            <?= admin_input_setting(66) ?>
                            <?= admin_input_setting(67) ?>
                            <div class="clr"></div>
                        </div>
                        <!--  -->
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>
