<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $is_key_tenmien_phu = @explode("\n", $is_key_tenmien_phu);
    $list_id_tm = "";
    foreach ($is_key_tenmien_phu as $tm) {
        $tm = trim($tm);
        $tm = str_replace("http://", "", $tm);
        $tm = str_replace("https://", "", $tm);
        $tm = str_replace("www", "", $tm);
        $tm = str_replace("/", "", $tm);
        $tm = strtoupper($tm);


        $check_tm = DB_que("SELECT `id` FROM `#_subdomain` WHERE `tenbaiviet_vi` = '$tm' LIMIT 1");
        if (!DB_num($check_tm)) {
            $data_tm = array();
            $data_tm['tenbaiviet_vi'] = $tm;
            $idtm = ACTION_db($data_tm, '#_subdomain', 'add', NULL, NULL);
            $list_id_tm .= $list_id_tm == "" ? $idtm : "," . $idtm;
        } else {
            $check_tm = DB_arr($check_tm, 1);
            $list_id_tm .= $list_id_tm == "" ? $check_tm['id'] : "," . $check_tm['id'];
        }
    }
    DB_que("DELETE FROM `#_subdomain` WHERE `id` NOT IN (" . $list_id_tm . ")");
}

if (!empty($_POST) && isset($_POST['tenbaiviet_vi'])) {
    $data = array();
    $data['seo_title_vi'] = $seo_title_vi;
    $data['seo_description_vi'] = $seo_description_vi;
    $data['seo_keywords_vi'] = $seo_keywords_vi;
    $data['tenbaiviet_vi'] = $tenbaiviet_vi;
    $data['diachi_vi'] = $diachi_vi;
    $data['sodienthoai_vi'] = $sodienthoai_vi;
    $data['hotline_vi'] = $hotline_vi;
    $data['email_vi'] = $email_vi;

    $data['tenbaiviet_en'] = @$tenbaiviet_en;
    $data['diachi_en'] = @$diachi_en;
    $data['seo_title_en'] = @$seo_title_en;
    $data['seo_description_en'] = @$seo_description_en;
    $data['seo_keywords_en'] = @$seo_keywords_en;

    $data['tenbaiviet_cn'] = @$tenbaiviet_cn;
    $data['diachi_cn'] = @$diachi_cn;
    $data['seo_title_cn'] = @$seo_title_cn;
    $data['seo_description_cn'] = @$seo_description_cn;
    $data['seo_keywords_cn'] = @$seo_keywords_cn;


    $data['robots'] = $robots;
    $data['duongdantin'] = $duongdantin;

    $data['fb_app'] = $fb_app;
    $data['fb_id'] = $fb_id;

    $data['em_ip'] = $em_ip;
    $data['em_taikhoan'] = $em_taikhoan;
    $data['em_pass'] = $em_pass;
    $data['js_google_anilatic'] = $js_google_anilatic;
    $data['js_google_anilatic_body'] = $js_google_anilatic_body;
    $data['is_https'] = isset($_POST['is_https']) ? 1 : 0;
    $data['is_comment'] = isset($_POST['is_comment']) ? 1 : 0;
    $data['is_lang'] = isset($_POST['is_lang']) ? 1 : 0;
    $data['is_saochep'] = isset($_POST['is_saochep']) ? 1 : 0;
    $data['is_tiengviet'] = isset($_POST['is_tiengviet']) ? 1 : 0;
    $data['fb_app_id'] = @$fb_app_id;
    $data['fb_app_secret'] = @$fb_app_secret;
    $data['fb_url'] = @$fb_url;
    $data['gg_client_id'] = @$gg_client_id;
    $data['gg_client_secret'] = @$gg_client_secret;
    $data['gg_url'] = @$gg_url;
    $data['lic_name'] = @$lic_name;
    $data['lic_key'] = @$lic_key;

    $icon = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $favico = UPLOAD_image("favico", "../" . $duongdantin . "/", time());
    $icon_hover = UPLOAD_image("icon_hover", "../" . $duongdantin . "/", time());

    $sql_thongtin = DB_que("SELECT * FROM `#_seo` LIMIT 1");
    $sql_thongtin = DB_arr($sql_thongtin, 1);

    if ($icon != '') {
        $data['icon'] = $icon;
        @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
    }

    if ($favico != '') {
        $data['favico'] = $favico;
        @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["favico"]);
    }

    if ($icon_hover != '') {
        $data['icon_hover'] = $icon_hover;
        @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon_hover"]);
    }

    ACTION_db($data, '#_seo', 'update', NULL, "1 = 1");
    $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
}

$sql_se = DB_que("SELECT * FROM `#_seo` LIMIT 1");
$sql_se = DB_arr($sql_se, 1);
foreach ($sql_se as $key => $value) {
    ${$key} = Show_text($value);
    if ($key = 'js_google_anilatic') {
        $js_google_anilatic = $sql_se['js_google_anilatic'];
    }
    if ($key = 'js_google_anilatic_body') {
        $js_google_anilatic_body = $sql_se['js_google_anilatic_body'];
    }
}

if ($icon != '') {
    $full_icon = "../$duongdantin/$icon";
}
if ($favico != '') {
    $full_icon_hover = "../$duongdantin/$favico";
}
if ($icon_hover != '') {
    $full_icon_hover2 = "../$duongdantin/$icon_hover";
}
?>

<section class="content-header">
    <h1><?php if (isset($_SESSION['admin'])) { ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a
                class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE]</a> <?php } ?>Thiết lập website
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Thiết lập website</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="token" value="<?= GET_token() ?>">
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Cập nhật
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" name="capnhat" class="btn btn-primary">
                                <i class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source . "lang.php" ?>
                        <div class="tab-content">
                            <?php
                                $count_lang = 1;
                                foreach ($arr_lang as $rows){
                                    if($rows['code_lang'] == "zh-CN"){
                                        $rows['code_lang'] = "cn";
                                    }
                            ?>
                            <div class="tab-pane <?=$count_lang == 1 ? "active" : ""?>" id="tab_<?=$count_lang?>">
                                <div class="form-group">
                                    <label>Tên công ty (<?=$rows['code_lang']?>) </label>
                                    <input type="text" class="form-control" name="tenbaiviet_<?=$rows['code_lang']?>"
                                           value="<?= ${"tenbaiviet_".$rows['code_lang']} ?>">
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ (<?=$rows['code_lang']?>)</label>
                                    <input type="text" class="form-control" name="diachi_<?=$rows['code_lang']?>"
                                           value="<?= ${"diachi_".$rows['code_lang']} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Seo Title (<?=$rows['code_lang']?>)</label>
                                    <input type="text" class="form-control" name="seo_title_<?=$rows['code_lang']?>"
                                           value="<?= ${"seo_title_".$rows['code_lang']} ?>">
                                </div>

                                <div class="form-group">
                                    <label>Seo Description (<?=$rows['code_lang']?>)</label>
                                    <input type="text" class="form-control" name="seo_description_<?=$rows['code_lang']?>"
                                           value="<?= ${"seo_description_".$rows['code_lang']} ?>">
                                </div>

                                <div class="form-group">
                                    <label>Seo keywords (<?=$rows['code_lang']?>)</label>
                                    <input type="text" class="form-control" name="seo_keywords_<?=$rows['code_lang']?>"
                                           value="<?= ${"seo_keywords_".$rows['code_lang']} ?>">
                                </div>
                            </div>
                            <?php $count_lang++;} ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10">
                    <div class="form-group">
                        <label for="exampleInputFile2">Logo</label>
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
                    <div class="form-group">
                        <label for="exampleInputFile2">Logo Footer</label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <input type="file" name="icon_hover" id="input_icon_hover2" class="cls_hinhanh"
                                       accept="image/*"
                                       onchange="pa_previewImg(event, '#img_icon_hover2','input_icon_hover2');">
                                <img src="<?= @$full_icon_hover2 ?>" alt="" class="img_chile_dangtin"
                                     style="<?php if (!empty($full_icon_hover) && $full_icon_hover != "") echo "display: block"; else echo "display: none" ?>"
                                     id="img_icon_hover2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile2">Favico</label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <input type="file" name="favico" id="input_icon_hover" class="cls_hinhanh"
                                       accept="image/*"
                                       onchange="pa_previewImg(event, '#img_icon_hover','input_icon_hover');">
                                <img src="<?= @$full_icon_hover ?>" alt="" class="img_chile_dangtin"
                                     style="<?php if (!empty($full_icon_hover) && $full_icon_hover != "") echo "display: block"; else echo "display: none" ?>"
                                     id="img_icon_hover">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="sodienthoai_vi" value="<?= $sodienthoai_vi ?>">
                    </div>
                    <div class="form-group">
                        <label>Hotine</label>
                        <input type="text" class="form-control" name="hotline_vi" value="<?= $hotline_vi ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email_vi" value="<?= $email_vi ?>">
                    </div>
                </div>
                <div class="box p10">
                    <div class="form-group">
                        <!-- <label class="mr-20 checkbox-mini">
              <input type="checkbox" name="is_intro" class="minimal minimal_click" <?= isset($is_intro) && $is_intro == 1 ? 'checked="checked"' : '' ?> colum="is_intro" idcol="<?= $id ?>" table="#_seo" value="1"> Trang Intro
            </label> -->
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_https"
                                   class="minimal minimal_click" <?= isset($is_https) && $is_https == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_https" idcol="<?= $id ?>" table="#_seo" value="1"> Bật Https
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_comment"
                                   class="minimal minimal_click" <?= isset($is_comment) && $is_comment == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_comment" idcol="<?= $id ?>" table="#_seo" value="1"> Bật Comment Facebook
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_lang"
                                   class="minimal minimal_click" <?= isset($is_lang) && $is_lang == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_lang" idcol="<?= $id ?>" table="#_seo" value="1"> Bật ngôn ngữ
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_saochep"
                                   class="minimal minimal_click" <?= isset($is_saochep) && $is_saochep == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_saochep" idcol="<?= $id ?>" table="#_seo" value="1"> Chống sao chép
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_tiengviet"
                                   class="minimal minimal_click" <?= isset($is_tiengviet) && $is_tiengviet == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_tiengviet" table="#_seo" idcol="1"> Tiếng Việt (Mặc định)
                        </label>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Facebook App</label>
                        <input type="text" class="form-control" name="fb_app" value="<?= $fb_app ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Facebook ID</label>
                        <input type="text" class="form-control" name="fb_id" value="<?= $fb_id ?>">
                    </div>
                    <?php if (!empty($_SESSION['admin'])) { ?>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_login_fb"
                                   class="minimal minimal_click" <?= isset($is_login_fb) && $is_login_fb == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_login_fb" idcol="<?= $id ?>" table="#_seo" value="1"> Login FB
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_login_gg"
                                   class="minimal minimal_click" <?= isset($is_login_gg) && $is_login_gg == 1 ? 'checked="checked"' : '' ?>
                                   colum="is_login_gg" idcol="<?= $id ?>" table="#_seo" value="1"> Login GG
                        </label>
                    <?php } ?>

                    <?php if ($is_login_fb == 1) { ?>
                        <div class="form-group">
                            <label for="exampleInputFile">Facebook App Id</label>
                            <input type="text" class="form-control" name="fb_app_id" value="<?= $fb_app_id ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Facebook App Secret</label>
                            <input type="text" class="form-control" name="fb_app_secret" value="<?= $fb_app_secret ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Facebook GetLoginUrl</label>
                            <input type="text" class="form-control" name="fb_url" value="<?= $fb_url ?>">
                        </div>
                    <?php }
                    if ($is_login_gg == 1) { ?>
                        <div class="form-group">
                            <label for="exampleInputFile">Google CLIENT ID</label>
                            <input type="text" class="form-control" name="gg_client_id" value="<?= $gg_client_id ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Google CLIENT SECRET</label>
                            <input type="text" class="form-control" name="gg_client_secret"
                                   value="<?= $gg_client_secret ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Google CLIENT REDIRECT URL</label>
                            <input type="text" class="form-control" name="gg_url" value="<?= $gg_url ?>">
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group">
                        <label for="exampleInputFile">Mã kích hoạt</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">ID</label>
                        <input type="text" class="form-control" name="lic_name" value="<?= $lic_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Key</label>
                        <input type="text" class="form-control" name="lic_key" value="<?= $lic_key ?>">
                    </div>
                    <div style="font-size: 11px; line-height: 10px; color: #00a65a; margin-top: -5px;">
                        <?php
                        $check_lic_pa = lic_web_pa_check_lic($lic_name, $lic_key);
                        $check_lic_pa = @json_decode($check_lic_pa, true);
                        $check_lic_pa_0 = @$check_lic_pa[0];
                        $check_lic_pa_1 = @$check_lic_pa[1];
                        ?>
                        <p style="<?= $check_lic_pa_0 == 0 ? "color: red;" : "" ?>"><?= $check_lic_pa_0 == 0 ? "ID Key không hợp lệ" : "ID Key hợp lệ. " ?><?= $check_lic_pa_1 == 0 ? "" : "Hạn sử dụng đến " . date("d-m-Y", $check_lic_pa_1) ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tên miền phụ <a data-tooltip="Mỗi tên miền 1 dòng !"> </a></label>
                        <textarea class="form-control" name="is_key_tenmien_phu" style="min-height: 200px"><?php
                            $check_tm = DB_que("SELECT * FROM `#_subdomain` ");
                            $check_tm = DB_arr($check_tm);
                            foreach ($check_tm as $rtm) {
                                echo $rtm['tenbaiviet_vi'] . "\n";
                            }

                            ?></textarea>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group">
                        <label for="exampleInputFile">Email gửi tin</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">IP/Server</label>
                        <input type="text" class="form-control" name="em_ip" value="<?= $em_ip ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Email</label>
                        <input type="text" class="form-control" name="em_taikhoan" value="<?= $em_taikhoan ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Mật khẩu</label>
                        <input type="text" class="form-control" name="em_pass" value="<?= $em_pass ?>">
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group" stylw=" margin-bottom: 5px;">
                        <label for="exampleInputFile">Code Header</label>
                    </div>
                    <div class="form-group">
                        <label>Chèn trong header</label>
                        <textarea class="form-control" name="js_google_anilatic"
                                  style="min-height: 200px"><?= $js_google_anilatic ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Chèn trong body</label>
                        <textarea class="form-control" name="js_google_anilatic_body"
                                  style="min-height: 200px"><?= $js_google_anilatic_body ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Robots</label>
                    <textarea name="robots" id="robots" class="form-control" rows="10" cols="80"
                              style="height: 200px"><?= $robots ?></textarea>
                </div>
            </section>
        </div>
    </section>
    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
            </button>
        </h3>
    </div>
</form>