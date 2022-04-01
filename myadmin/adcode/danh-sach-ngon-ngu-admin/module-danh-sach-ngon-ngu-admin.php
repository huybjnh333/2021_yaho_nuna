<?php
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-ngon-ngu-admin-add.php";
} else {
    $table = '#_module_ngonngu';

    if (isset($_GET['del'])) {
        $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");

        if (DB_num($sql_se) > 0) {
            $sql_se = DB_arr($sql_se, 1);
            if ($sql_se['khong_xoa'] == 1) {
                $_SESSION['show_message_off'] = "Bạn không có quyền XÓA ngôn ngữ!";
                LOCATION_js($url_page);
                exit();
            } else {
                DB_que("DELETE FROM $table WHERE `id` ='" . $_GET['catalogid'] . "' LIMIT 1");
                $_SESSION['show_message_on'] = 'Đã xóa thành công';
            }
        } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
        LOCATION_js($url_page);
        exit();
    }

    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];

            $sort = str_replace(".", "", $_POST["sort$i"]);
//            $tenbaiviet = $_POST["tenbaiviet$i"];
            $code_lang = $_POST["code_lang$i"];
//            $icon = $_POST["icon$i"];
            $showhi = isset($_POST["showhi$i"]) ? "1" : "0";

            DB_que("UPDATE `$table` SET `showhi`='$showhi' ,`sort`='$sort',`code_lang`='$code_lang' WHERE `id`='$idofme' LIMIT 1");

        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }


    $sql = DB_que("SELECT * FROM `$table` ORDER BY `sort` ASC ");
    $sql_array = DB_arr($sql);

    ?>
    <section class="content-header">
        <h1> Tính năng hệ thống</h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Tính năng hệ thống</li>
        </ol>
    </section>

    <form action="" method="post">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> Tính năng hệ thống
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"><i
                                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                                <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <div class="box-body table-responsive no-padding table-danhsach-cont">
                            <table class="table table-hover table-danhsach">
                                <tbody>
                                <tr>
                                    <th class="w80 text-center">STT</th>
                                    <th>Tiêu đề</th>
                                    <th class="w60 text-center">Mã ngôn ngữ</th>
                                    <th class="w70 text-center">Quốc kỳ</th>
                                    <th class="w70 text-center">Hiển thị</th>
                                    <th class="w70 text-center">Xóa</th>
                                </tr>
                                <?php
                                $cl = 0;
                                foreach ($sql_array as $rows) {
                                    $cl++;
                                    $ida = $rows['id'];
                                    $code_lang = SHOW_text($rows['code_lang']);
                                    $tenbaiviet = SHOW_text($rows['tenbaiviet']);
                                    $showhi = SHOW_text($rows['showhi']);
                                    $sort = SHOW_text($rows['sort']);
                                    $ida = SHOW_text($rows['id']);
                                    $khong_xoa = $rows['khong_xoa'];
                                    $duongdantin = $rows['duongdantin'];
//                                    $icon = SHOW_text($rows['icon']);

                                    $langcode = $rows['code_lang'];
                                    if ($langcode == 'zh-CN') {
                                        $langcode = 'cn';
                                    }
//                                    $linkicon = $fullpath . '/images/flag/' . $langcode . '.png';
                                    $linkicon = $fullpath . '/' . $duongdantin . '/' . $rows['icon'];
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <input type="text" class="text-center" name="sort<?= $cl ?>"
                                                   value="<?= $sort ?>">
                                        </td>

                                        <td>
                                            <div class="name">
                                                <a href="<?= $url_page ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&edit=<?= $id ?>"><?= $tenbaiviet ?></a>
                                            </div>

                                            <!--<?php if (isset($_SESSION['admin'])) { ?>
                                                <label>
                                                    <input name='coppy_row<?= $cl ?>' type='checkbox'
                                                           class='minimal'> [Coppy]
                                                </label>
                                            <?php } ?>-->
                                        </td>

                                        <td>
                                            <input type="text" name="code_lang<?= $cl ?>" value="<?= $code_lang ?>"
                                                   placeholder="code_lang">
                                        </td>

                                        <td class="text-center"><img style="height: 20px;" src="<?= $linkicon ?>"
                                                                     class="img-flag"></td>

                                        <td class="text-center">
                                            <div id="cus" class="cus_menu">
                                                <label><input type="checkbox" class='minimal' name="showhi<?= $cl ?>"
                                                              value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= $url_page ?>&edit=<?= $ida ?>" title="Cập nhật"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            <?php if ($khong_xoa == 0) { ?>
                                                <a href="<?= $url_page . '&del=ok&catalogid=' . $ida ?>&token=<?= GET_token() ?>"
                                                   class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                            class="fa fa-times"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>