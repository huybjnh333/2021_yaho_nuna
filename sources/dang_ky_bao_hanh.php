<div class="banner_detail"><img src="delete/banner_baohanh.jpg">
    <div class="pagewrap"><h3><?=$glo_lang['dangky_baohanh']?></h3></div>
</div>
<div class="link_title">
    <div class="pagewrap">
        <ul>
            <li><a href="<?=$full_url?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu']?></a> /
                <a href="<?=$full_url."/dang-ky-bao-hanh/"?>" class="active"><?=$glo_lang['dangky_baohanh']?></a>
            </li>
            <div class="clr"></div>
        </ul>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <div class="col-12">
        <div class="form_register">
            <div class="form_content">
                <div class="col-xs-12 col-sm-8 offset-md-2">
                    <form enctype="multipart/form-data" class="formBox" method="post"
                          accept-charset="UTF-8" name="formdangkybaohanh"
                          id="formdangkybaohanh">
                        <input type="hidden" name="send_baohanh">
                        <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                        <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                        <input type="hidden" name="tieude_lienhe"
                               value="<?= !empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['dangky_baohanh']) ?>">
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['cart_ma_sp'] ?>:</label>
                            <input type="hidden" name="s_masp_s" value="<?= base64_encode($glo_lang['cart_ma_sp']) ?>">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <select class="form-control cls_data_check_form_dangkybaohanh" id="s_masp"
                                            name="s_masp">
                                        <option value="1">FPC02474LK</option>
                                        <option value="2">FPC02475LK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a class="info preview fancybox.ajax" href="baohanh-popup.php" data-toggle="modal"
                                   data-target="#myModal"><?= $glo_lang['cach_tim_masp'] ?></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['so_seri'] ?>:</label>
                            <input type="hidden" name="s_seri_s" value="<?= base64_encode($glo_lang['so_seri']) ?>">
                            <div class="col-sm-5">
                                <input type="text" class="form-control cls_data_check_form_dangkybaohanh" id="s_seri"
                                       name="s_seri" data-rong="1"
                                       data-msso="<?= $glo_lang['vui_long_nhap_so_seri'] ?>">
                            </div>
                            <div class="col-sm-4">
                                <a class="info preview fancybox.ajax" href="baohanh-popup.php" data-toggle="modal"
                                   data-target="#myModal"><?= $glo_lang['cach_tim_so_seri'] ?></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['ngay_mua'] ?></label>
                            <input type="hidden" name="s_purchasedate_s"
                                   value="<?= base64_encode($glo_lang['ngay_mua']) ?>">
                            <div class="col-sm-5">
                                <input type="date" id="s_purchasedate" name="s_purchasedate"
                                       class="cls_data_check_form_dangkybaohanh"
                                       data-rong="1" data-msso="<?= $glo_lang['vui_long_chon_nhay_mua'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['hoa_don_mua_hang'] ?>:</label>
                            <input type="hidden" name="s_hoadon_s"
                                   value="<?= base64_encode($glo_lang['hoa_don_mua_hang']) ?>">
                            <div class="col-sm-5">
                                <div class="">
                                    <input type="file" name="s_hoadon" id="exampleInputFile" class="form-control">
<!--                                    <span class="file-mark">Chọn tệp</span>-->
                                </div>
                                <small ><?=$glo_lang['khong_vuot_qua']?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label"><?= $glo_lang['ho_va_ten'] ?></label>
                            <input type="hidden" name="s_hoten_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-6 pr-0">
                                        <input type="text" class="form-control cls_data_check_form_dangkybaohanh"
                                               name="s_ho"
                                               placeholder="<?= $glo_lang['ho'] ?>" data-rong="1"
                                               data-msso="<?= $glo_lang['vui_long_nhap_ho'] ?>">
                                    </div>
                                    <div class="col-6 pl-0">
                                        <input type="text" class="form-control cls_data_check_form_dangkybaohanh"
                                               name="s_ten"
                                               placeholder="<?= $glo_lang['ten'] ?>" data-rong="1"
                                               data-msso="<?= $glo_lang['vui_long_nhap_ten'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['email'] ?>:</label>
                            <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                            <div class="col-sm-5">
                                <input type="text" class="form-control cls_data_check_form_dangkybaohanh" name="s_email"
                                       data-rong="1"
                                       data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                                       data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?= $glo_lang['so_dien_thoai'] ?>:</label>
                            <input type="hidden" name="s_dienthoai_s"
                                   value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                            <div class="col-sm-5">
                                <input name="s_dienthoai" type="text"
                                       class="form-control cls_data_check_form_dangkybaohanh"
                                       data-rong="1" data-phone="1" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                                       data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>">
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-sm-3"></label>
                            <div class="col-sm-5">
                            <div class="col-md-4 row-frm row-frm-mbv" style="width: 100%;">
                            <span class="span_mbv">
                              <img src="<?= $full_url . "/load-capcha/" ?>" alt="CAPTCHA code"
                                   onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')"
                                   id="img_contact_cap"><i
                                        class="fa fa-refresh"
                                        onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i>
                            </span>
                                <input class="form-control cls_data_check_form_dangkybaohanh" data-rong="1"
                                       name="mabaove"
                                       id="mabaove"
                                       type="text" placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                                       data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                            </div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="cls_data_check_form_dangkybaohanh" type="checkbox" id="gridCheck1"
                                           data-check="1"
                                           data-msso="<?= $glo_lang['ban_chua_dong_y_thoa_thuan'] ?>">
                                    <label class="form-check-label" for="gridCheck1">
                                        <?= $glo_lang['chap_nhan_dieu_khoan'] ?>
                                        <a href="../PDF/FCCL-SG UH-X Warranty T&amp;C.pdf"
                                           target="_blank"><?= $glo_lang['chap_nhan_dieu_khoan_2'] ?></a>

                                    </label>

                                </div>
                                <small id="error-terms" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-9 formBox">
                                <a onclick="RefreshFormMailContact(formdangkybaohanh)" style="cursor:pointer"
                                   class="button"><?= $glo_lang['lam_lai'] ?></a>
                                <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#formdangkybaohanh', '.cls_data_check_form_dangkybaohanh')"
                                   style="cursor:pointer" class="button"><?= $glo_lang['gui'] ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function CHECK_send_baohanh(url, id_form, cls) {
        if (icheck_lienhe == 0) {
            icheck_lienhe = 1;
            $(".ajax_img_loading").show();
            var check = 0;
            $(cls).each(function () {
                var val = $(this).val().trim();
                var id = $(this).attr('id');
                var rong = $(this).attr('data-rong');
                var phone = $(this).attr('data-phone');
                var email = $(this).attr('data-email');
                var d_check = $(this).attr('data-check');
                var place = $(this).attr('placeholder');
                var data_ms = $(this).attr('data-msso');
                var data_m1 = $(this).attr('data-msso1');

                var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (rong == 1 && (val == "" || val == place)) {
                    if (data_ms != "") alert(data_ms);
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_lienhe = 0;
                    return false;
                } else if (email == 1 && !regex.test(val) && val != "") {
                    if (data_m1 != "") alert(data_m1);
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_lienhe = 0;
                    return false;
                }
                else if(phone == 1 && !CHECK_phone(this) && val != ""){
                    alert($(this).attr('data-msso1'));
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_lienhe = 0;
                    return false;
                }
                else if (d_check == 1 && !$(this).is(":checked")) {
                    if (data_ms != "") alert(data_ms);
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_lienhe = 0;
                    return false;
                }
            });

            if (check == 0) {
                var formData = new FormData($(id_form)[0]);
                if ($('#inputfile').length > 0) {
                    formData.append('inputfile', $('#inputfile')[0].files[0]);
                }
                if ($('#inputfile_1').length > 0) {
                    formData.append('inputfile_1', $('#inputfile_1')[0].files[0]);
                }
                $.ajax({
                    type: "POST",
                    url: url + "send_form/",
                    data: formData,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        icheck_lienhe = 0;
                        $(".ajax_img_loading").hide();
                        if ($(".id_token").length == 0) {
                            // console.log(0);
                            if (data == 1) {
                                $(id_form)[0].reset();
                                alert($(".lang_ok").val());
                                window.location.reload();

                            } else {
                                $("#mabaove").focus();
                                alert($(".lang_false").val());
                                // console.log(data);
                            }
                            $("#img_contact_cap").attr("src", url + "load-capcha/");
                        } else {
                        }
                        console.log(data);

                    }
                });
            }
        }
        return false;
    }
</script>