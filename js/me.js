var topH = $(".header").height();
$(window).scroll(function () {
    if ($(this).scrollTop() > topH) {
        $('.dv-header-center').addClass("fixed");
    } else {
        $('.dv-header-center').removeClass("fixed");
    }
});

function SHOWHI_cls(obj, cls_a, cls_b, cls_all) {
    $(cls_a).removeClass("active");
    $(obj).addClass("active");
    $(cls_all).hide();
    $(cls_b).show();
}

function plus_minus(obj) {
    var t = $(obj).closest(".quantity").find(".qty"), n = parseFloat(t.val()), r = parseFloat(t.attr("max")),
        i = parseFloat(t.attr("min")), s = t.attr("step");
    if (!n || n == "" || n == "NaN") n = 0;
    if (r == "" || r == "NaN") r = "";
    if (i == "" || i == "NaN") i = 0;
    if (s == "any" || s == "" || s == undefined || parseFloat(s) == "NaN") s = 1;
    $(obj).is(".plus") ? r && (r == n || n > r) ? t.val(r) : t.val(n + parseFloat(s)) : i && (i == n || n < i) ? t.val(i) : n > 0 && t.val(n - parseFloat(s));
    t.trigger("change");
}

$(".plus").click(function () {
    plus_minus(this);
});
$(".minus").click(function () {
    plus_minus(this);
});

// end
// $("img.isload").lazyload({
//     load: function () {
//         this.style.opacity = 1;
//     },
//     threshold: 100
// });

function LOAD_addthis(id) {
    var js, fjs = document.getElementsByTagName('script')[0];
    if (document.getElementById(id)) return;
    js = document.createElement('script');
    js.id = id;
    js.src = '//s7.addthis.com/js/300/addthis_widget.js#pub=AddThis';
    fjs.parentNode.insertBefore(js, fjs);
}

function LOAD_isfb(d, s, id, appid) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    if (appid == '') {
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12';
    } else {
        js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=" + appid;
    }
    fjs.parentNode.insertBefore(js, fjs);
}

function CHECK_divtop(cls) {
    var scrollTop = $(window).scrollTop();
    var elementOffset = $(cls).offset().top;
    var distance = (elementOffset - scrollTop);
    return distance;
}

var send_d_dangnhap = 0;

function check_dangnhap_v2(text_false) {
    var check = 0;
    $(".cls_data_check_form_check_dangky").each(function () {
        var val = $(this).val().trim();
        var id = $(this).attr('id');
        var rong = $(this).attr('data-rong');
        var email = $(this).attr('data-email');
        var place = $(this).attr('placeholder');

        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (rong == 1 && (val == "" || val == place)) {
            alert($(this).attr('data-msso'));
            $(this).focus();
            $(".ajax_img_loading").hide();
            check = 1;
            send_d_dangnhap = 0;
            return false;
        } else if (email == 1 && !regex.test(val) && val != "") {
            alert($(this).attr('data-msso1'));
            $(this).focus();
            $(".ajax_img_loading").hide();
            check = 1;
            send_d_dangnhap = 0;
            return false;
        }
    });

    if (check == 0) {
        if (send_d_dangnhap == 0) {
            send_d_dangnhap = 1;
            $(".img_load_from_dktv").show();
            var dataString = $('#dangnhap').serializeArray();
            $.ajax({
                type: "POST",
                url: full_url + "/check-dang-nhap/",
                data: dataString,
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.error > 0) {
                        alert(text_false);
                    } else {
                        window.location.reload();
                    }
                    $(".img_load_from_dktv").hide();
                    send_d_dangnhap = 0;
                }
            });
        }
    }
}

var send_ajax = 0;

function ADD_sao(idsp, id) {
    if ($(".ad_sao_" + idsp).length > 0) {
        $(".ad_sao_" + idsp).removeClass('checked');
        for (var i = 1; i <= id; i++) {
            $(".ad_sao_" + idsp + "_" + i).addClass('checked');
        }
    }
};

$(function () {
    if ($(".ad_sao").length > 0) {
        $(".ad_sao").each(function () {
            var idsp = $(this).attr('data');
            var sao = $(this).attr('data-sao');
            ADD_sao(idsp, sao);
        });
    }
    ;

    if ($(".iframe_load").length > 0) {
        $(".iframe_load").each(function () {
            $(this).attr('src', $(this).attr('iframe-src'));
        });
    };
    if ($("#capcha_hd").length > 0) {
        $.ajax({
            type: "POST",
            url: full_url + "/captcha/",
            data: {"action_ajax": "captcha"},
            success: function (data) {
                $('#capcha_hd').val(data);
            }
        });
    }
    LOAD_addthis('addthis');

});

function ADD_sao_num(idsp, sao) {
    if (send_ajax == 1) return false;
    if ($(".ad_sao_" + idsp).length > 0) {
        $(".ad_sao_" + idsp).parent().append('<img src="images/load1.gif" alt="" class="img_load_js_sao">');
        send_ajax = 1;
        $.ajax({
            type: "POST",
            url: full_url + "/add-sao/",
            data: {"idsp": idsp, "sao": sao},
            success: function (data) {
                send_ajax = 0;
                $(".ad_sao_" + idsp).parent().find('img').remove();
                $(".ad_sao_" + idsp).removeClass("ad_sao_" + idsp);
                alert(data);
            }
        });
    }
    ;
};

function SEARCH_product() {
    if ($(".dv-timkiem-active").length == 0) $(".dv-timkiem").addClass("dv-timkiem-active");
    else $(".dv-timkiem").removeClass("dv-timkiem-active");
    event.stopPropagation();
}

function TIMKIEM_tinrao(url) {
    var key_timkiem = $(".key_timkiem").val().trim().replace(/ /g, "+");
    var key_linhvuc = $(".key_linhvuc").val();
    var key_sanpham = $(".key_sanpham").val();
    var key_khuvuc = $(".key_khuvuc").val();
    window.location.href = url + "/?key=" + key_timkiem + "&lv=" + key_linhvuc + "&sp=" + key_sanpham + "&kv=" + key_khuvuc;
}

function SEARCH_timkiem(url, cls) {
    if ($(cls).val() == '')
        $(cls).focus();
    else
        window.location.href = url+"?key=" + $(cls).val().trim().replace(/ /g, "+");
}

function SEARCH_timkiem_khac(url, cls,step) {
    if ($(cls).val() == '')
        $(cls).focus();
    else
        window.location.href = url+"?key=" + $(cls).val().trim().replace(/ /g, "+")+"&step="+ step.trim().replace(/ /g, "+");
}

$('.input_search_enter').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        var cls = $(this).attr('data');
        var href = $(this).attr('data-href');
        SEARCH_timkiem(href, cls);
    }
});
$('.input_search_enter_khac').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        var cls = $(this).attr('data');
        var href = $(this).attr('data-href');
        var step = $(this).attr('data-step');
        SEARCH_timkiem_khac(href, cls,step);
    }
});
var is_key_check = '';


function DONG_popup() {
    $(".dv-popup-cont").hide();
    $(".dv-popup-cont-child").hide();
}

function GUI_noidung_popup() {
    $(".load_popup").show();
    if ($(".noidung_popup").val() == '') {
        $(".noidung_popup").focus();
        $(".load_popup").hide();
    } else {
        $.ajax({
            type: "POST",
            url: "",
            data: {
                "id_send": $(".id_send").val(),
                "key_send": $(".key_send").val(),
                "nd_guimail": $(".nd_guimail").val(),
                "noidung_popup": $(".noidung_popup").val(),
                "cap_popup": $('#cap_popup').val(),
                "action_ajax": "send_popup"
            },
            success: function (data) {
                alert(data);
                $(".load_popup").hide();
                DONG_popup();
            }
        });
    }
}

var m_send_d = 0;

function DANGKY_email(url) {
    if (m_send_d == 0) {
        m_send_d = 1;
        $(".ajax_img_loading_mail").show();
        var formData = new FormData($('form#dk_email_nhantin')[0]);
        // formData.append('inputfile', $('#inputfile')[0].files[0]);
        $.ajax({
            type: "POST",
            url: url + "/dang-ky-mail/",
            data: formData,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                try {
                    data = JSON.parse(response);
                    $("#capcha_hd").val(data.new_cap);
                    alert(data.message);
                    $("#ip_sentmail").val('');
                    $("#ip_sentmail_name").val('');
                    $("#ip_sentmail_phone").val('');

                } catch (e) {
                    alert("ERR!");
                    console.log(response);
                }
                $("#ip_sentmail").focus()
                $(".ajax_img_loading_mail").hide();
                m_send_d = 0;
            }
        });
    }
}

function addCart(urlpath, alert_dat_hang, idsp, qty) {
    if (idsp == '' || idsp <= 0 || isNaN(idsp) || qty == '' || qty <= 0 || isNaN(qty)) {
        alert(alert_dat_hang);
    } else {
        $.ajax({
            type: "POST",
            url: urlpath + "/add-cart/",
            data: {"idsp": idsp, "qty": qty},
            success: function (data) {
                window.location.href = urlpath + "/gio-hang/";
            }
        });
    }
}

function GOTO_sport(cls) {
    var target = $(cls);
    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 700);
    }
}

//load binh luan

var is_busy = false;
var page = 1;
var stopped = false;

function LOAD_ajax_binhluan(url, total, numview, id_run, id_par, loai) {
    if (is_busy == true) {
        return false;
    }
    if (stopped == true) {
        return false;
    }
    is_busy = true;
    page++;
    $(".ajax_img_loading").show();
    $.ajax(
        {
            type: 'post',
            dataType: 'text',
            url: url,
            data: {
                "page": page,
                "numview": numview,
                "total": total,
                "id_par": id_par,
                "loai": loai,
                "id_run": id_run
            },
            success: function (result) {
                $(".dv-js-binhluan-" + loai).append(result);
            }
        })
        .always(function () {
            $(".ajax_img_loading").hide();

            setTimeout(function () {
                GOTO_sport(".ajax_scron_" + loai + "_" + page);
            }, 700);
            is_busy = false;
        });
    return false;
}

//
var is_busy = false;
var page = 1;
var stopped = false;

function LOAD_ajax_product(url, step, total, numview, whe) {
    if (is_busy == true) {
        return false;
    }
    if (stopped == true) {
        return false;
    }
    is_busy = true;
    page++;
    $(".ajax_img_loading").show();
    $.ajax(
        {
            type: 'post',
            dataType: 'text',
            url: url,
            data: {
                "page": page,
                "step": step,
                "numview": numview,
                "total": total,
                "whe": whe
            },
            success: function (result) {
                $(".dv-danhsachpto").append(result);
            }
        })
        .always(function () {
            $(".ajax_img_loading").hide();

            // setTimeout(function () {
            //     GOTO_sport(".ajax_scron_" + page);
            // }, 700);
            is_busy = false;
        });
    return false;
}

function RefreshFormMailContact(FormNameContact) {
    FormNameContact.reset();
}

var icheck_lienhe = 0;

function CHECK_send_lienhe(url, id_form, cls) {

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
                // if (data_ms != "") alert(data_ms);
                cusNotify({mess: data_ms, type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (email == 1 && !regex.test(val) && val != "") {
                // if (data_m1 != "") alert(data_m1);
                cusNotify({mess: data_m1, type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (d_check == 1 && !$(this).is(":checked")) {
                // if (data_ms != "") alert(data_ms);
                cusNotify({mess: data_ms, type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (phone == 1 && !CHECK_phone(this) && val != "") {
                cusNotify({mess: data_m1, type: 'error', postion: 1});
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
                        // console.log(1);
                        try {
                            data = JSON.parse(data);
                            if (data.err == 1) {

                                // thanh toan paypal
                                if ($("#type0").length > 0 && $("#type0").is(":checked")) {
                                    $(".dv-paypal").show();
                                    $(".dv-paypal-cont").show();
                                    TIEN_paypal(data.thanhtien, data.id);
                                    $(".paypal_form_new").click();
                                }
                                //
                                else {
                                    $(id_form)[0].reset();
                                    alert($(".lang_ok").val());
                                    window.location.reload();
                                }
                            } else {
                                alert($(".lang_false").val());
                                window.location.reload();
                                // console.log(data);
                            }
                            $(".id_token").val(data.token);
                        } catch (e) {
                            alert("ERR#3");
                        }
                    }
                    console.log(data);

                }
            });
        }
    }
    return false;
}

function updateQty_notthis(url, id, keytn, key) {
    var qty = $("#product-quantity-" + key).val();
    if (qty == '' || qty <= 0 || isNaN(qty) || !Number.isSafeInteger(parseFloat(qty))) {
        alert($(".cls_datafalse").val());
        window.location.reload();
    } else {
        $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, "qty": qty, "post": "update-qty", "keytn": keytn},
            success: function (data) {
                if (data != '') {
                    if (data == "reload") {
                        window.location.reload();
                    } else {
                        try {
                            var js_de = JSON.parse(data);
                            $(".td_thanhtien_" + key).html(js_de.thanhtien);
                            $(".tb_tongtien").html(js_de.tongtien);
                        } catch (e) {
                            console.log(data);
                        }

                    }
                }
            }
        });
    }
}

function updateQty(url, idsp, key, obj, keytn) {
    var qty = $(obj).val();
    if (qty == '' || qty <= 0 || isNaN(qty) || !Number.isSafeInteger(parseFloat(qty))) {
        alert($(".cls_datafalse").val());
        window.location.reload();
    } else {
        $.ajax({
            type: "POST",
            url: url,
            data: {'id': idsp, "qty": qty, "post": "update-qty", "keytn": keytn},
            success: function (data) {
                if (data != '') {
                    if (data == "reload") {
                        window.location.reload();
                    } else {
                        try {
                            var js_de = JSON.parse(data);
                            $(".td_thanhtien_" + key).html(js_de.thanhtien);
                            $(".tb_tongtien").html(js_de.tongtien);
                        } catch (e) {
                            console.log(data);
                        }

                    }
                }
            }
        });
    }
}

function CHECK_phone(cls) {
    var flag = false;
    var phone = $(cls).val().trim();
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '01' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
}

$("body").click(function () {
    $(".dv-timkiem").removeClass("dv-timkiem-active");
});
$(".body-nohide").click(function (event) {
    event.stopPropagation();
});

function PLAY_video(id, name) {
    $(".js_name_video").html(name);
    $(".video_view_top iframe").attr("src", "https://www.youtube.com/./embed/" + id + "?rel=0&autoplay=1&gesture=media&mute=1");
    setTimeout(function () {
        GOTO_sport(".id_hide_video");
    }, 200);
};
$(".menu-active a").each(function () {
    var href = $(this).attr("href");
    href = href.replace(fullpath, "");
    href = href.replace(/\//g, "");
    href = href.toLowerCase();
    var url = window.location.href;
    url = url.replace(fullpath, "");
    url = url.replace(/\//g, "");
    url = url.toLowerCase();
    if (href == url) {
        $(this).parents('.menu-active > li').eq(0).addClass("active");
        return;
    }
});

function CHECK_room(id, url) {
    var from = $(".ngayden" + id).val();
    var to = $(".ngaydi" + id).val();
    var adu = $(".nguoilon" + id).val();
    var chil = $(".tremem" + id).val();
    var pro = $(".makhuyemai" + id).val();
    var room = '';
    if (id == 1) {
        room = $(".loaiphong" + id).val();
    }
    window.location.href = url + "/check-room/?from=" + from + "&to=" + to + "&adu=" + adu + "&chil=" + chil + "&pro=" + pro + "&room=" + room;
}

function GET_diadiem(obj, cls, text, url) {
    $.ajax({
        type: "POST",
        url: url,
        data: {'action_s': 'get_diadiem', "id": $(obj).val(), "text": text},
        success: function (data) {
            $(cls).html(data);
            // console.log(data)
        }
    });
}

function SHOW_timkiem_bds(url) {
    var uri = "?tin=" + $("#id_loaitin").val();
    if ($("#id_quan").val() != "") uri += "&t=" + $("#id_quan").val();
    if ($("#id_huyen").val() != "") uri += "&q=" + $("#id_huyen").val();
    if ($("#id_phuong").val() != "") uri += "&p=" + $("#id_phuong").val();
    var list_id = "";
    $(".id_tinhnang").each(function () {
        if ($(this).val() != "" && $(this).val() != 0) {
            if (list_id != "")
                list_id += "-";
            list_id += $(this).val();
        }
    });
    if (list_id != "") uri += "&tn=" + list_id;
    if ($(".cls_nangcao").val() != '') uri += "&nc=true";
    window.location.href = url + uri;
}

function SHOW_timkiemnc() {
    if ($(".hide_search.activex").length > 0) {
        $(".hide_search.activex").removeClass("activex");
        $('.hide_search select option[value=""]').attr('selected', 'selected');
        $(".cls_nangcao").val('');
    } else {
        $(".hide_search").addClass("activex");
        $(".cls_nangcao").val('true');
    }
}

var popup_active = 0;

function LOAD_popup_new(url, wid) {
    $(".dv-popup-new-child").removeAttr("style");
    if (wid != '') $(".dv-popup-new-child").width(wid);
    $("body").append('<div class="dv-loadding-pop"><img src="images/loadernew.gif" alt=""></div>');
    $(".dv-nd-popup").load(url, function () {
        $(".dv-loadding-pop").remove();
        $("body").addClass("body_hide");
        resize_popup_new();
    });
}

function resize_popup_new() {
    popup_active = 1;
    $(".dv-popup-new").addClass("acti");
    if (($(".dv-popup-new-child").height() + 20) > $(window).height()) {
        $(".dv-popup-new-child").addClass("actiok");
    } else {
        $(".dv-popup-new-child").removeClass("actiok");
    }
}

// $(window).load(function() {
$(function () {
    if (popup_active == 1) {
        resize_popup_new();
    }
})
// });
$(window).resize(function () {
    if (popup_active == 1) {
        resize_popup_new();
    }
});
// $(".popup-close, .dv-popup-new").click(function(){
$(".popup-close").click(function () {
    $(".dv-nd-popup").html("");
    popup_active = 0;
    $("body").removeClass("body_hide");
    $(".dv-popup-new").removeClass("acti");
});
$(".dv-nd-popup").click(function (event) {
    event.stopPropagation();
});

function LOAD_height(cls) {
    var maxHeight = 0;
    $(cls).each(function () {
        if ($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });
    if (maxHeight != 0) $(cls).height(maxHeight);
}

function LOAD_tinhthanh(obj, cls, name) {
    $.ajax({
        type: "POST",
        url: full_url + "/load-tinh-thanh/",
        data: {'id': $(obj).val().trim(), 'name': name},
        success: function (data) {
            $(cls).html(data);
        }
    });
}

function add_num_sp(id, loai) {
    var num = $(id).val();
    if (!isNaN(num)) {
        if (loai == "-1") {
            if (num > 0) num--;
        } else {
            num++;
        }
        $(id).val(num);
    }

}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function ADD_yeuthich(obj, id) {
    var loai = $(obj).attr('data');
    var cook_yt = getCookie('sp_yeuthich');
    if (cook_yt == null) cook_yt = id;
    else {
        list_new = cook_yt.split(",");
        var cook_yt = "";
        if (loai == 0) {
            cook_yt = id;
            $(obj).attr('data', '1');
            $(obj).addClass('acti');
        } else {
            $(obj).attr('data', '0');
            $(obj).removeClass('acti');
        }
        list_new.forEach(function (key) {
            if (key != id) {
                if (cook_yt == "") {
                    cook_yt += key;
                } else {
                    cook_yt += "," + key;
                }
            }
        });
    }
    setCookie('sp_yeuthich', cook_yt, 365);
    AJAX_post(full_url + "/clear_cache/", {"id": "0"}, function (r) {
    });
}

function yeu_thich(obj, idbv) {
    if ($(".check_yt").length == 0) $(obj).addClass('check_yt');
    else $(obj).removeClass('check_yt');
    $.ajax({
        type: "POST",
        url: full_url + "/yeu_thich/",
        data: {"idbv": idbv},
        success: function (response) {
            console.log(response)
            if (response == 1) {
                $(obj).addClass('acti');
            } else if (response == 0) {
                $(obj).removeClass('acti');
            } else if (response == 2) {
                // alert(response);
                LOAD_popup_new(full_url + '/pa-size-child/dang-nhap/', '400px')
            }

        }
    });
}

function popupwindow(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}

$(".is_class_click").click(function () {
    var dt = $(this).attr('data');
    var idbv = $(this).attr('idbv');

    $(".is_class_click").removeClass('acti');
    $(this).addClass('acti');
    $.ajax({
        type: "POST",
        url: full_url + "/load_mausac/",
        data: {"dt": dt, 'idbv': idbv},
        success: function (response) {
            // if(response != "") {
            $(".dv-js-mausac").html(response);
            // }
        }
    });
});

function cap_nhat_so_luong() {
    $(".qty_is_soluong").trigger("change");
    $(".ajax_img_loading").show();
    setTimeout(function () {
        window.location.href = full_url + "/gio-hang/";
    }, 2000);
}

function js_checkOrder(text) {
    $(".ajax_img_loading").show();
    var maxhd = $("#madh").val();
    maxhd = maxhd.replace('#', '');
    $(".dv-errr-dh").html("");
    $.ajax({
        type: "POST",
        url: full_url + "/check_donhang/",
        data: {"maxhd": maxhd},
        success: function (response) {
            console.log(response)
            $(".ajax_img_loading").hide();
            // if(response == 0) {
            //   $(".dv-errr-dh").html(text);
            // }
            // else {
            //   window.location.href = full_url+"/lich-su-mua-hang/?view="+maxhd;
            // }
        }
    });
};
// $(document).ready(function () {
//     var owl_run = $(".owl-auto");
//     if ($(".owl-auto").length > 0) {
//         owl_run = $(".owl-auto");
//     }
//     if ($(".owl-auto-sp").length > 0) {
//         owl_run = $(".owl-auto-sp");
//     }
//
//     owl_run.each(function () {
//         var is_slidespeed = $(this).attr("is_slidespeed");
//         var is_navigation = $(this).attr("is_navigation") == 1 ? true : false;
//         var is_dots = $(this).attr("is_dots") == 1 ? true : false;
//         var is_autoplay = $(this).attr("is_autoplay") == 1 ? true : false;
//         var is_mousedrag = (isEmpty($(this).attr("is_mousedrag"))) ? true : false;
//         var is_loop = (isEmpty($(this).attr("is_loop"))) ? true : false;
//         var is_items_0 = $(this).attr("data0");
//         var is_items_1 = $(this).attr("data1");
//         var is_items_2 = $(this).attr("data2");
//         var is_items_3 = $(this).attr("data3");
//         var is_items_4 = $(this).attr("data4");
//         var is_items_5 = $(this).attr("data5");
//         $(this).owlCarousel({
//             slideSpeed: is_slidespeed,
//             navigation: is_navigation,
//             itemsCustom: [
//                 [0, is_items_0],
//                 [319, is_items_1],
//                 [479, is_items_2],
//                 [767, is_items_3],
//                 [991, is_items_4],
//                 [1199, is_items_5]
//             ],
//             dots: is_dots,
//             autoPlay: is_autoplay,
//             navigationText: ["‹", "›"],
//             mouseDrag: is_mousedrag,
//             loop: is_loop,
//         });
//     });
// });

function XOA_popup_child() {
    $(".dv-bannder-top-header").remove();
    $.ajax({
        type: "POST",
        url: full_url + "/xoa_popup_child/",
        data: {'action_ajax': "xoa_popup_child"},
        success: function (response) {
        }
    });
};
// get gia bv
$(".js_tinhnang_getval").click(function () {
    var list_tn = "";
    var js_idbv = $(".js_idbv").val();

    $(".js_tinhnang_getval").each(function () {
        if ($(this).is(":checked")) {
            if (list_tn == "") list_tn = $(this).val();
            else list_tn += "," + $(this).val();
        }
    });
    $.ajax({
        type: "POST",
        url: full_url + "/get_gia_sptinhang/",
        data: {"list_tn": list_tn, "js_idbv": js_idbv},
        success: function (response) {
            console.log(response)
            $(".h5_giact_sp").html(response);
        }
    });
});

function AJAX_post(u, d, r) {
    $.ajax({
        type: "POST",
        url: u,
        data: d,
        cache: !1,
        success: function (response) {
            r(response)
        }
    });
}

$(".dv-con-list-spct").click(function (e) {
    e.stopPropagation();
})

function load_view_sp(id, obj) {
    $('.dv-con-list-spct-cten, .dv-con-list-spct').hide();
    $("body").removeClass("body_hide");
    $(obj).append('<span class="load_popup"></span>')
    AJAX_post(full_url + "/load_view_sp/", {"id": id}, function (r) {
        $(".load_popup").remove();
        if (r != "") {
            $("body").addClass("body_hide");
            $('.dv-con-list-spct .js-cont').html(r)
            $('.dv-con-list-spct-cten, .dv-con-list-spct').show();
        }
    });
}

function mua_ngay_sp(id) {
    $(".span_is_load_cart").removeClass("acti");
    $(".is_car_fis").removeClass("acti");
    $(".span_is_load_cart").addClass("acti");
    $.ajax({
        type: "POST", url: full_url + "/mua_ngay_sp/", data: {"id": id, "sl": 1},
        success: function (response) {
            $(".span_is_load_cart").removeClass("acti");
            $(".is_car_fis").addClass("acti");
            $(".is_num_cart").html(response);
        }
    });
}

$(".showText a").click(function () {
    var f_char = $(this).attr("href");
    f_char = f_char.substr(0, 1);
    if (f_char == "#") {
        GOTO_sport($(this).attr("href"));
        return false;
    }
    return true;
});

function timkiem_sp() {
    var key_timkiem = $(".js_search_text").val().trim().replace(/ /g, "+");
    var js_tinhnang = "";
    $(".select-items .same-as-selected").each(function () {
        if ($(this).attr("id") != "") {
            if (js_tinhnang == "") js_tinhnang += $(this).attr("id");
            else js_tinhnang += "-" + $(this).attr("id");
        }
    });
    window.location.href = full_url + "/search/?key=" + key_timkiem + "&tn=" + js_tinhnang;
}

function timkiem_sp_step() {
    var js_step = "";
    var js_danhmuc = "";
    var js_tinhnang = "";
    $(".select-items.step .same-as-selected").each(function () {
        console.log(this);
        if ($(this).attr("id") != "") {
            if (js_step == "") js_step += $(this).attr("id");
            else js_step += "-" + $(this).attr("id");
        }
    });
    $(".select-items.danhmuc .same-as-selected").each(function () {
        if ($(this).attr("id") != "") {
            if (js_danhmuc == "") js_danhmuc += $(this).attr("id");
            else js_danhmuc += "-" + $(this).attr("id");
        }
    });
    $(".select-items.tinhnang .same-as-selected").each(function () {
        if ($(this).attr("id") != "") {
            if (js_tinhnang == "") js_tinhnang += $(this).attr("id");
            else js_tinhnang += "-" + $(this).attr("id");
        }
    });
    window.location.href = full_url + "/search/?step=" + js_step + "&dm=" + js_danhmuc + "&tn=" + js_tinhnang;
}

$('.js_search_text').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        timkiem_sp();
    }
});
function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}
$(document).ready(function () {
    var owl_run = $(".owl-auto");
    if ($(".owl-auto").length > 0) {
        owl_run = $(".owl-auto");
    }
    if ($(".owl-auto-sp").length > 0) {
        owl_run = $(".owl-auto-sp");
    }

    owl_run.each(function () {
        // var is_slidespeed = $(this).attr("is_slidespeed");
        var is_nav = $(this).attr("is_navigation") == 1 ? true : false;
        var is_dots = $(this).attr("is_dots") == 1 ? true : false;
        var is_autoplay = $(this).attr("is_autoplay") == 1 ? true : false;
        var is_mousedrag = (isEmpty($(this).attr("is_mousedrag"))) ? true : false;
        var is_loop = (isEmpty($(this).attr("is_loop"))) ? true : false;
        var is_items_0 = $(this).attr("data0");
        var is_items_1 = $(this).attr("data1");
        var is_items_2 = $(this).attr("data2");
        var is_items_3 = $(this).attr("data3");
        var is_items_4 = $(this).attr("data4");
        var is_items_5 = $(this).attr("data5");
        jQuery(this).owlCarousel({
            lazyLoad: true,
            loop: is_loop,
            nav: is_nav,
            dots: is_dots,
            mouseDrag: is_mousedrag,
            autoplay: is_autoplay,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: is_items_0
                }, 319: {
                    items: is_items_1
                }, 479: {
                    items: is_items_2
                }, 600: {
                    items: is_items_2
                }, 767: {
                    items: is_items_3
                }, 991: {
                    items: is_items_4
                }, 1199: {
                    items: is_items_5
                }
            }
        });
    });
});

function changeFormatDate(obj){
    return obj.split("/").reverse().join("-");
}
function cusNotify(data) {
    var n = new Noty({
        type: data.type,
        layout: 'bottomRight',
        text: data.mess
    }).show();
    n.setTimeout(4000);
}
function comfirmNoty(data) {
    var n = new Noty({
        text: data.mess,
        type: data.type,
        layout: 'center',
        buttons: [
            Noty.button('YES', 'btn btn-success', function () {
                window.location.href = data.submit;
            }, {id: 'button1', 'data-status': 'ok'}),

            Noty.button('NO', 'btn btn-error', function () {
                n.close();
            })
        ]
    });
    n.show();
    n.setTimeout(4000);
}