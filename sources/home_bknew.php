<?php
include _source . "banner_top.php";
$url_sp = LAY_step(2, 1);
$anh_gioithieu = LAY_banner_new("`id_parent` = 27");
//$data = array("2", "3", "3", "3", "4", "5");
?>
<div class="tabs-home-1 pagewrap top_detail_a wow fadeInDown">
    <div class="tab home-img">
        <div class="tablinks2">
            <div class="home-i home-i-a">
                <a href="index.php?page=sanpham_noibat"><?= $glo_lang['san_pham_noi_bat'] ?></a></div>
        </div>
        <div class="tablinks2" onclick="openCity2(event, 'ga')">
            <div class="home-i">
                <img src="delete/img-home3.png">
                <span>Gà</span></div>
        </div>
        <div class="tablinks2" onclick="openCity2(event, 'vit')">
            <div class="home-i">
                <img src="delete/img-home4.png">
                <span>Vịt</span></div>
        </div>
        <div class="tablinks2" onclick="openCity2(event, 'cut')">
            <div class="home-i">
                <img src="delete/img-home5.png">
                <span>Cút</span></div>
        </div>
        <div class="tablinks2">
            <div class="home-i menu">
                <li><a href="index.php?page=sanpham_noibat"><img src="delete/img-home1.png">
                        <span>Heo</span>
                </li>
                </a>
            </div>
        </div>
        <div class="tablinks2" onclick="openCity2(event, 'bo')">
            <div class="home-i menu">
                <li><img src="delete/img-home2.png">
                    <span>Bò</span>
                    <ul>
                        <li><a href="index.php?page=sanpham_noibat" title="Bò thịt">Bò thịt</a></li>
                        <li><a href="index.php?page=sanpham_noibat" title="Bò sữa">Bò sữa</a></li>
                        <li><a href="index.php?page=sanpham_noibat" title="Bò con">Bò con</a></li>
                    </ul>
                </li>
            </div>
        </div>
        <div class="tablinks2" onclick="openCity2(event, 'tom')">
            <div class="home-i">
                <img src="delete/img-home6.png">
                <span>Tôm</span></div>
        </div>
        <div style="display: none" class="tablinks2" onclick="openCity2(event, 'ca')">
            <div class="home-i">
                <img src="delete/img-home7.png">
                <span>Cá</span></div>
        </div>

    </div>
    <div id="bo" class="tabcontent2">
        <div class="text-left">Dinh dưỡng là yếu tố quan trọng để bò phát triển sinh trưởng tốt và đạt năng suất
            cao.<br>

            Tại Proconco, chúng tôi cung cấp hàng loạt giải pháp dinh dưỡng phù hợp cho từng giai đoạn phát triển của
            bò.
        </div>
        <div class="sp-right-home autoplay2">
            <div class="swiper-slide">
                <div class="title" style="height: 28px;">Bê con</div>
                <div class="img">
                    <img src="delete/be1.png" alt="Bê con" title="Bê con">
                    <p><a class="view-more" href="index.php?page=sanpham_noibat" title="">Xem tất cả »</a></p>
                </div>
                <div class="gr-link">
                    Hỗn hợp C41 - Dùng cho bê từ sơ sinh đến 3...<br>Hỗn hợp S41 - Dùng cho bê từ sơ sinh đến 3...
                </div>

            </div>
            <div class="swiper-slide">
                <div class="title" style="height: 28px;">Bò thịt</div>
                <div class="img">
                    <img src="delete/be2.png" alt="Bò thịt" title="Bò thịt">
                    <p><a class="view-more" href="index.php?page=sanpham_noibat" title="">Xem tất cả »</a></p>
                </div>
                <div class="gr-link">
                    Hỗn hợp C41 - Dùng cho bê từ sơ sinh đến 3...<br>Hỗn hợp S41 - Dùng cho bê từ sơ sinh đến 3...
                </div>

            </div>
            <div class="swiper-slide">
                <div class="title" style="height: 28px;">Bò sữa</div>
                <div class="img">
                    <img src="delete/be3.png" alt="Bò sữa" title="Bò sữa">
                    <p><a class="view-more" href="index.php?page=sanpham_noibat" title="">Xem tất cả »</a></p>
                </div>
                <div class="gr-link">
                    Hỗn hợp C41 - Dùng cho bê từ sơ sinh đến 3...<br>Hỗn hợp S41 - Dùng cho bê từ sơ sinh đến 3...
                </div>

            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div id="ga" class="tabcontent2">
        Đang cập nhập dữ liệu...
    </div>
    <div id="vit" class="tabcontent2">
        Đang cập nhập dữ liệu...
    </div>
    <div id="cut" class="tabcontent2">
        Đang cập nhập dữ liệu...
    </div>
    <div id="tom" class="tabcontent2">
        Đang cập nhập dữ liệu...
    </div>
    <div id="ca" class="tabcontent2" style="display: none">
        Đang cập nhập dữ liệu...
    </div>
</div>

<div class="search-product">
    <div class="pagewrap">
        <div class="title-pg"><?= $glo_lang['tim_san_pham'] ?></div>
        <div class="tt"><?= $glo_lang['mota_tim_san_pham'] ?></div>
        <div class="home-search">
            <div class="custom-select">
                <h4>Thương hiệu</h4>
                <select name="tn_thuonghieu">
                    <option value="">Chọn thương hiệu</option>
                    <?php
                    $thuonghieu = LAY_step("2,3,4");
                    foreach ($thuonghieu as $rows) {
                        ?>
                        <option value="<?= $rows['id'] ?>"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="custom-select">
                <h4>Vật nuôi</h4>
                <select name="" class="s_chude">
                    <option value="">Chọn vật nuôi</option>
                </select>
            </div>
            <div class="custom-select">
                <h4>Giai đoạn</h4>
                <select>
                    <option value="0">Sơ sinh</option>
                    <option value="1">Sau cai sữa</option>
                    <option value="2">Hậu bị</option>
                    <option value="3">Xuất chuồng</option>
                </select>
            </div>
            <div class="custom-select">
                <h4>Chủng loại sản phẩm</h4>
                <select>
                    <option value="0">Dinh dưỡng</option>
                    <option value="1">Premix</option>
                </select>
            </div>
            <div class="custom-select custom-select-lastchild">
                <h4></h4>
                <a class="cur" onclick="timkiem_sp_step()">Tìm kiếm</a>
            </div>
            <input class="js_search_text siteSearchInput ui-autocomplete-input" type="hidden" name="text" value=""
                   maxlength="100" placeholder="Nhập từ khóa tìm kiếm...">
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            if (typeof (selElmnt) != "undefined") {
                ll = selElmnt.length;
            } else ll = 0;

            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");

            if (typeof (selElmnt) != "undefined") {
                a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            } else continue;
            // else a.innerHTML = "";

            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            // b.setAttribute("class", "select-items select-hide");
            if (i == 0) {
                b.setAttribute("class", "select-items select-hide step");
                b.setAttribute("onclick", "getCD(this);");
            } else if (i == 1) {
                b.setAttribute("class", "select-items select-hide danhmuc");
            } else {
                b.setAttribute("class", "select-items select-hide tinhnang");
            }
            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.setAttribute("id", selElmnt.options[j].value);
                // b.setAttribute("onchange", "getVN("+selElmnt.options[j].value+")");
                c.addEventListener("click", function (e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function (e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        document.addEventListener("click", closeAllSelect);
    </script>
    <script>
        function getCD(obj) {
            // var child = this.children();
            var idElement = $(obj).find(".same-as-selected").attr("id");
            // var value = obj.value;
            $.ajax({
                type: "POST",
                url: "<?=$full_url . "/change-chu-de"?>",
                data: {id: idElement},
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.type == 1) {
                        $(".select-items.danhmuc").html(data.data);
                        $(".s_chude").append(data.dataoption);
                        // $(".select-items.danhmuc").removeClass("select-hide");
                        console.log(data.data);
                    }
                }
            });
        }

        function getDonGia(obj, idsp) {
            var value = obj.value;
            $.ajax({
                type: "POST",
                url: "<?=$full_url . "/change-price"?>",
                data: {
                    idsp: idsp,
                    idtn: value
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.type == 1) {
                        $("#dongia_" + idsp).text(numberWithCommas(data.price));
                        caltotal(idsp);
                    }

                }
            });
        }

        function caltotal(id) {
            var qty = Number($("#qty_" + id).val());
            var dongia = Number($("#dongia_" + id).text().replace('.', '').replace('.', ''));
            var total = qty * dongia;
            $("#total_" + id).text(numberWithCommas(total));
        }

        function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1.$2");
            return x;
        }
    </script>
</div>

<div class="home-1">
    <div class="pagewrap">
        <div class="left-img-home wow fadeInRight"><img src="delete/img-home8.png"></div>
        <div class="wine-home-1 wow fadeInLeft">
            <h2>Về chúng tôi !</h2>
            <p>Công ty Cổ phần Công nghệ sinh học R.E.P được thành lập từ năm 2004, dưới sự điều hành của ông Ngô Quốc
                Cường – Tổng Giám Đốc công ty, có trụ sở văn phòng chính tại thành phố Hồ Chí Minh.</p>
            <p>Với số lượng nhân viên khoảng 100 người, gồm những kỹ sư công nghệ sinh học, kỹ sư chăn nuôi, đội ngũ
                nhân viên chuyên môn và sản xuất có nhiều kinh nghiệm.</p>
            <p>Công ty Cổ phần Công nghệ sinh học R.E.P kinh doanh trên nền tảng tri thức, nghiên cứu cho ra đời những
                sản phẩm đạt chất lượng tối ưu, đáp ứng nhu cầu khách hàng trong chăn nuôi.</p>
            <p class="view_more"><a href="index.php?page=gioithieu">Khám phá ngay »</p></a>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div class="w3-container box_home">
    <div class="pagewrap">
        <div class="titile_page wow fadeInDown">
            <ul>
                <h4>SẢN PHẨM CHƯƠNG TRÌNH KHUYẾN MÃI</h4>
                <h3>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for
                    previewing layouts and visual mockups.</h3>
                <div class="clr"></div>
            </ul>
        </div>

        <div class="w3-bar w3-black">
            <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'home-sp1')">R.E.P TRADE
            </button>
            <button class="w3-bar-item w3-button tablink">R.E.P AQUA</button>
            <button class="w3-bar-item w3-button tablink">NUTRI PLUS</button>
        </div>

        <div id="home-sp1" class="w3-container w3-border city pro_home_id pro_home_id_3 autoplay">
            <ul>
                <div class="discount-tag-a">20%</div>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp1.jpg"></li>
                    <h3>Chế phẩm vitamin và thảo dược ngừa bệnh và tăng trọng</h3>
                    <h4><span>700.000 Đ</span>483.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <div class="discount-tag">New</div>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp2.jpg"></li>
                    <h3>Chế phẩm chuyên vỗ béo và mọc lông cho gia cầm thịt</h3>
                    <h4>294.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <div class="discount-tag">New</div>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp3.jpg"></li>
                    <h3>Chế phẩm sinh học đậm đặc dùng phòng bệnh</h3>
                    <h4>154.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp4.jpg"></li>
                    <h3>Chế phẩm tăng lực cấp thời cho gia súc, gia cầm</h3>
                    <h4>357.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp5.jpg"></li>
                    <h3>Hợp chất kháng khuẩn sinh học</h3>
                    <h4>238.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp1.jpg"></li>
                    <h3>Chế phẩm vitamin và thảo dược ngừa bệnh và tăng trọng</h3>
                    <h4><span>700.000 Đ</span>483.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp2.jpg"></li>
                    <h3>Chế phẩm chuyên vỗ béo và mọc lông cho gia cầm thịt</h3>
                    <h4>294.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp3.jpg"></li>
                    <h3>Chế phẩm sinh học đậm đặc dùng phòng bệnh</h3>
                    <h4>154.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp4.jpg"></li>
                    <h3>Chế phẩm tăng lực cấp thời cho gia súc, gia cầm</h3>
                    <h4>357.000 Đ</h4>
                </a>
            </ul>
            <ul>
                <a href="index.php?page=sanpham_view">
                    <li><img src="delete/sp/home-sp5.jpg"></li>
                    <h3>Hợp chất kháng khuẩn sinh học</h3>
                    <h4>238.000 Đ</h4>
                </a>
            </ul>
        </div>
    </div>
</div>

<div class="new_top_id">
    <div class="pagewrap">
        <div class="titile_page wow fadeInLeft">
            <ul>
                <h4>Tin tức mới nhất</h4>
                <div class="clr"></div>
            </ul>
        </div>
        <div class="one_new_home wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <li><a href="index.php?page=tintuc_view"><img src="delete/img-tintuc5.jpg"></a></li>
            <ul>
                <h3><a href="index.php?page=tintuc_view">Định hướng phát triển chăn nuôi</a></h3>
                <p>Trước diễn biến phức tạp của ASF diễn ra trên thế giới và các nước trong khu vực, Bộ NN&PTNT đã chủ
                    động diễn tập và đưa ra những kịch bản phòng chống từ cuối năm 2018</p>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="one_new_home_right wow fadeInRight animated"
             style="visibility: visible; animation-name: fadeInRight;">
            <ul>
                <li><a href="index.php?page=tintuc_view"><img src="delete/img-tintuc1.jpg"></a></li>
                <h3><a href="index.php?page=tintuc_view">Xây dựng sàn giao dịch heo hướng đến xuất khẩu</a></h3>
                <div class="clr"></div>
            </ul>
            <ul>
                <li><a href="index.php?page=tintuc_view"><img src="delete/img-tintuc2.jpg"></a></li>
                <h3><a href="index.php?page=tintuc_view">Lâm Đồng: Phát triển khoảng 549.000 gia súc</a></h3>
                <div class="clr"></div>
            </ul>
            <ul>
                <li><a href="index.php?page=tintuc_view"><img src="delete/img-tintuc3.jpg"></a></li>
                <h3><a href="index.php?page=tintuc_view">Nuôi lợn sinh sản áp dụng công nghệ thụ tinh nhân tạo</a></h3>
                <div class="clr"></div>
            </ul>
            <ul>
                <li><a href="index.php?page=tintuc_view"><img src="delete/img-tintuc4.jpg"></a></li>
                <h3><a href="index.php?page=tintuc_view">Hà Nội: Tổng đàn gia súc, gia cầm đứng tốp đầu cả nước</a></h3>
                <div class="clr"></div>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>
<div class="newsletter_home">
    <div class="pagewrap home-0">
        <ul id="scroller">
            <li><img src="delete/doitac/brand1.png"></li>
            <li><img src="delete/doitac/brand2.png"></li>
            <li><img src="delete/doitac/brand3.png"></li>
            <li><img src="delete/doitac/brand4.png"></li>
            <li><img src="delete/doitac/brand5.png"></li>
            <li><img src="delete/doitac/brand6.png"></li>
        </ul>
    </div>
</div>


<div class="list-group-horizontal-lg widget__group list-group pagewrap wow fadeInDown ">
    <?php foreach ($anh_gioithieu as $rows) { ?>
        <div class="widget__group-item list-group-item"><img alt="<?= $rows['tenbaiviet_' . $lang] ?>"
                                                             src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>">
            <span><?= $rows['tenbaiviet_' . $lang] ?></span>
        </div>
    <?php } ?>
    <div class="clr"></div>
</div>

<div class="w3-container box_home">
    <div class="pagewrap">
        <div class="dv-menu-left no_box">
            <div class="dv-nut-menu"><i class="fa fa-bars"></i>
                <div class="mn-mobile-new">
                    <div class="menu-bar hidden-md hidden-lg">
                        <a href="#nav-mobile-new">
                            <img alt="menu"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAAQlBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////8IX9KGAAAAFXRSTlMAAQUREh4gJS0uMTNKVFaVmrS16/1h/XngAAAAU0lEQVQ4y+2Ttw3AMBDEKOcsp9t/VY+gKwQYhsWa1T0f3mO6lOaOAceT1ON5GrOLA6cnNlTLlmbt+CnePC0c3uC1f8L89djhztYr7KFEUaL4ZBQPR3w/3X/Sz4cAAAAASUVORK5CYII=">
                        </a>
                    </div>
                    <div id="nav-mobile-new" style="display: none">
                        <ul>
                            <?= GET_menu_new($full_url, $lang, '', '', '', 14) ?>
                        </ul>
                    </div>
                    <div class="clr"></div>
                </div>
                <span><?= $glo_lang['danh_muc_san_pham'] ?></span>
            </div>

            <div class="dv-ul-menu ">
                <?php
                $danhmuc = LAY_danhmuc(2, "", "`id_parent` = 0");
                foreach ($danhmuc as $rows) {
                    $danhmuc_con = LAY_danhmuc(2, "", "`id_parent` = " . $rows['id']);
                    ?>
                    <ul class="sub-1">
                        <li class="vertical-menu-item">
                            <a <?= full_href($rows) ?>><i class="fa fa-th-large"></i>
                                <h2><?= $rows['tenbaiviet_' . $lang] ?></h2>
                                <?= !empty($danhmuc_con) ? '<i class="fa fa-angle-right"></i>' : '' ?>
                            </a>
                            <?php if (!empty($danhmuc_con)) { ?>
                                <ul class="vertical-menu-sub sub-2">
                                    <?php
                                    foreach ($danhmuc_con as $rows_2) {
                                        ?>
                                        <li><a <?= full_href($rows_2) ?>><h2><?= $rows_2['tenbaiviet_' . $lang] ?></h2>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <div class="right-sp-home">
            <div class="titile_page wow fadeInDown">
                <ul>
                    <h1><span><?= $glo_lang['san_pham_khuyen_mai'] ?></span></h1>
                    <div class="clr"></div>
                </ul>
            </div>
            <div class="w3-bar w3-black wow fadeInRight">
                <button class="w3-bar-item w3-button tablink w3-red"><a <?= full_href($url_sp, "?p=2") ?>>
                        <?= $glo_lang['xem_tat_ca'] ?> »</a>
                </button>
            </div>
            <?php $data = array("2", "2", "3", "3", "4", "4"); ?>
            <div id="home-sp1"
                 class="w3-container w3-border city pro_home_id pro_home_id_3 owl-carousel owl-theme owl-custome owl-auto-sp"
                 data0="<?= $data[0] ?>" data1="<?= $data[1] ?>" data2="<?= $data[2] ?>"
                 data3="<?= $data[3] ?>"
                 data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
                 is_dots="1" is_autoplay="1">
                <?php
                $sp_km = LAY_baiviet(2, "10", "`opt1` = 1");
                foreach ($sp_km as $rows) {
                    ?>
                    <ul>
                        <?= $rows['opt1'] == 1 ? '<div class="discount-tag">Sales</div>' : '' ?>
                        <a <?= full_href($rows) ?>>
                            <li><img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>"></li>
                            <h3 class="limit-row-3"><?= $rows['tenbaiviet_' . $lang] ?></h3>
                            <h4><?= $glo_lang['cart_ma_sp'] ?>: <?= $rows['p1'] ?></h4>
                        </a>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</div>

<div class="w3-container box_home box_home_1">
    <div class="pagewrap">
        <div class="right-sp-home right-sp-home-1">
            <div class="titile_page wow fadeInDown">
                <ul>
                    <h3><span><?= $glo_lang['san_pham_ban_chay'] ?></span></h3>
                    <div class="clr"></div>
                </ul>
            </div>
            <div class="tab home-img wow fadeInRight">
                <?php
                $dm_tieubieu = LAY_danhmuc(2, "", "opt = 1");
                $i = 1;
                foreach ($dm_tieubieu as $val) {
                    ?>
                    <button class="tablinks2 <?= $i == 1 ? "active" : "" ?>"
                            onclick="openCity2(event, 'sp<?= $i ?>')" id="<?= $i == 1 ? "defaultOpen" : "" ?>">
                        <?= $val['tenbaiviet_' . $lang] ?>
                    </button>
                    <?php $i++;
                } ?>
            </div>
            <?php
            $i = 1;
            foreach ($dm_tieubieu as $val) {
                $idkx = LAYDANHSACH_idkietxuat($val['id'], 2);
                $sp = LAY_baiviet(2, "10", "`id_parent` IN ($idkx) AND `opt2` = 1");
                ?>
                <div id="sp<?= $i ?>" class="tabcontent2 city pro_home_id pro_home_id_3"
                     style="<?= $i == 1 ? "display:block" : "" ?>">
                    <?php if (!empty($sp)) {
                        foreach ($sp as $rows) {
                            ?>
                            <ul>
                                <?= $rows['opt1'] == 1 ? '<div class="discount-tag">Sales</div>' : '' ?>
                                <a <?= full_href($rows) ?>>
                                    <li><?= full_img($rows) ?></li>
                                    <h3 class="limit-row-3"><?= $rows['tenbaiviet_' . $lang] ?></h3>
                                    <h4><?= $glo_lang['cart_ma_sp'] ?>: <?= $rows['p1'] ?></h4>
                                </a>
                            </ul>
                        <?php } ?>
                        <div class="clr"></div>
                    <?php } else { ?>
                        <div class="no_dulieu">Updating data ...</div>
                    <?php } ?>
                </div>
                <?php $i++;
            } ?>
        </div>
        <div class="clr"></div>
    </div>
</div>
<?php
$dm_home = LAY_danhmuc(2, "", "`opt1` = 1");
$data = array("2", "2", "3", "3", "4", "5");
foreach ($dm_home as $val) {
    ?>
    <div class="w3-container box_home box_home_1 box_home_2">
        <div class="pagewrap">
            <div class="right-sp-home right-sp-home-1">
                <div class="titile_page wow fadeInDown">
                    <ul>
                        <h4><span><?= SHOW_text($val['tenbaiviet_' . $lang]) ?></span></h4>
                        <div class="clr"></div>
                    </ul>
                </div>
                <div class="tab home-img1 wow fadeInRight">
                    <button class="tablinks2 active"><a <?= full_href($val) ?>><?= $glo_lang['xem_tat_ca'] ?> »</a>
                    </button>
                </div>
                <div class="city pro_home_id pro_home_id_3 owl-carousel owl-theme owl-custome owl-auto-sp"
                     data0="<?= $data[0] ?>" data1="<?= $data[1] ?>" data2="<?= $data[2] ?>"
                     data3="<?= $data[3] ?>"
                     data4="<?= $data[4] ?>" data5="<?= $data[5] ?>" is_slidespeed="1000" is_navigation="1"
                     is_dots="1" is_autoplay="1"
                     style="display: block">
                    <?php
                    $sp_home = LAY_baiviet(2, "10", "`id_parent` = " . $val['id']);
                    foreach ($sp_home as $rows) {
                        ?>
                        <ul>
                            <?= $rows['opt1'] == 1 ? '<div class="discount-tag">Sales</div>' : '' ?>
                            <a <?= full_href($rows) ?>>
                                <li><img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>"></li>
                                <h3 class="limit-row-3"><?= $rows['tenbaiviet_' . $lang] ?></h3>
                                <h4><?= $glo_lang['cart_ma_sp'] ?>: <?= $rows['p1'] ?></h4>
                            </a>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </div>
<?php } ?>

<?php
$tin_moi = LAY_baiviet(3, 3, "`opt1` = 1");
if (!empty($tin_moi)) {
    ?>
    <div class="new_top_id">
        <div class="pagewrap">
            <div class="titile_page wow fadeInDown">
                <ul>
                    <h1><span><?= $glo_lang['tin_moi_nhat'] ?></span></h1>
                    <?php $step_news = LAY_step(3);
                    $step_news = reset($step_news); ?>
                    <p><a <?= full_href($step_news) ?>><?= $glo_lang['xem_tat_ca'] ?> »</a></p>
                    <div class="clr"></div>
                </ul>
            </div>
            <?php
            $i = 0;
            $arr_news = array();
            foreach ($tin_moi as $rows) {
                if ($i == 1) continue;
                array_push($arr_news, $rows['id']);
                ?>
                <div class="one_new_home wow fadeInLeft">
                    <li><a <?= full_href($rows) ?>><?= full_img($rows) ?></a></li>
                    <ul>
                        <h3><a <?= full_href($rows) ?>><?= $rows['tenbaiviet_' . $lang] ?></a></h3>
                        <p><?= strip_tags($rows['mota_' . $lang]) ?></p>
                    </ul>
                    <div class="clr"></div>
                </div>
                <?php $i++;
            } ?>
            <div class="one_new_home_right wow fadeInRight">
                <?php foreach ($tin_moi as $rows) {
                    if (in_array($rows['id'], $arr_news)) continue;
                    ?>
                    <ul>
                        <li><a <?= full_href($rows) ?>><?= full_img($rows) ?></a></li>
                        <h3><a <?= full_href($rows) ?>><?= $rows['tenbaiviet_' . $lang] ?></a></h3>
                        <p><?= strip_tags($rows['mota_' . $lang]) ?></p>
                        <div class="clr"></div>
                    </ul>
                <?php } ?>
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
<?php } ?>

<div class="newsletter_home">
    <div class="pagewrap wow fadeInDown home-0">
        <div class="titile_page wow fadeInDown">
            <ul>
                <h1><span><?= $glo_lang['doi_tac_cua_chung_toi'] ?></span></h1>
                <p><?= $glo_lang['mota_doi_tac'] ?></p>
                <div class="clr"></div>
            </ul>
        </div>
        <ul id="scroller">
            <?php $doitac = LAY_banner_new("`id_parent` = 29");
            foreach ($doitac as $rows) {
                ?>
                <li><a <?= full_href($rows) ?> <?= $rows['blank'] ?>>
                        <img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>"
                             alt="<?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>"></a></li>
            <?php } ?>
        </ul>
    </div>
</div>