<?php
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = 11 LIMIT 1");
    $thongtin_step = mysqli_fetch_assoc($thongtin_step);
?>
<div class="filter-container babynamegenerator">
    <div class="col-xs-12">
        <div class="gray-block">
            <div class="no-checkedselector">
                <div class="toggle-container">
                    <span><strong><?=$glo_lang['gioi_tinh']?>:</strong></span>
                    <input id="nam" name="gioitinh"
                           type="radio" value="0"
                        <?= (isset($gioitinh) && $gioitinh == 0) || !isset($gioitinh) ? 'checked="checked"' : '' ?>>
                    <label for="toggle-on" class="btn"><?=$glo_lang['be_trai']?></label>
                    <input id="nu" name="gioitinh"
                           type="radio" value="1"
                        <?= (isset($gioitinh) && $gioitinh == 1) ? 'checked="checked"' : '' ?>>
                    <label for="toggle-off" class="btn"><?=$glo_lang['be_gai']?></label>
                    <input id="trungtinh" name="gioitinh"
                           type="radio" value="2"
                        <?= (isset($gioitinh) && $gioitinh == 2) ? 'checked="checked"' : '' ?>>
                    <label for="toggle-off" class="btn"><?=$glo_lang['trung_tinh']?></label>
                </div>
            </div>
            <div class="alphabet" <?=$motty == "" ? "style='display: none';" : ""?>>
                <a <?=full_href($thongtin_step,"?alphabet=A&hide=1")?> class="alp">A</a>
                <a <?=full_href($thongtin_step,"?alphabet=B&hide=1")?> class="alp">B</a>
                <a <?=full_href($thongtin_step,"?alphabet=C&hide=1")?> class="alp">C</a>
                <a <?=full_href($thongtin_step,"?alphabet=D&hide=1")?> class="alp">D</a>
                <a <?=full_href($thongtin_step,"?alphabet=E&hide=1")?> class="alp">E</a>
                <a <?=full_href($thongtin_step,"?alphabet=F&hide=1")?> class="alp">F</a>
                <a <?=full_href($thongtin_step,"?alphabet=G&hide=1")?> class="alp">G</a>
                <a <?=full_href($thongtin_step,"?alphabet=H&hide=1")?> class="alp">H</a>
                <a <?=full_href($thongtin_step,"?alphabet=I&hide=1")?> class="alp">I</a>
                <a <?=full_href($thongtin_step,"?alphabet=K&hide=1")?> class="alp">K</a>
                <a <?=full_href($thongtin_step,"?alphabet=L&hide=1")?> class="alp">L</a>
                <a <?=full_href($thongtin_step,"?alphabet=M&hide=1")?> class="alp">M</a>
                <a <?=full_href($thongtin_step,"?alphabet=N&hide=1")?> class="alp">N</a>
                <a <?=full_href($thongtin_step,"?alphabet=O&hide=1")?> class="alp">O</a>
                <a <?=full_href($thongtin_step,"?alphabet=P&hide=1")?> class="alp">P</a>
                <a <?=full_href($thongtin_step,"?alphabet=Q&hide=1")?> class="alp">Q</a>
                <a <?=full_href($thongtin_step,"?alphabet=R&hide=1")?> class="alp">R</a>
                <a <?=full_href($thongtin_step,"?alphabet=S&hide=1")?> class="alp">S</a>
                <a <?=full_href($thongtin_step,"?alphabet=T&hide=1")?> class="alp">T</a>
                <a <?=full_href($thongtin_step,"?alphabet=U&hide=1")?> class="alp">U</a>
                <a <?=full_href($thongtin_step,"?alphabet=V&hide=1")?> class="alp">V</a>
                <a <?=full_href($thongtin_step,"?alphabet=X&hide=1")?> class="alp">X</a>
                <a <?=full_href($thongtin_step,"?alphabet=Y&hide=1")?> class="alp">Y</a>
            </div>
            <input type="text" id="searchtxt" placeholder="<?=$glo_lang['dat_ten_cho_be']?>"
                   value="<?= @$ten ?>">
            <div class="row flex">
                <p class="read-more"><a
                        onclick="timKiemTen('<?= $full_url . '/' . $thongtin_step['seo_name'] ?>','#searchtxt',1)"
                        class="color_vang cur"><?=$glo_lang['tim_theo_ten']?></a></p>
                <!--<p class="read-more"><a
                        onclick="timKiemTen('<?= $full_url . '/' . $thongtin_step['seo_name'] ?>','#searchtxt',2)"
                        class="color_vang cur"><?=$glo_lang['tim_theo_y_nghia']?></a></p>-->
            </div>
            <!--<div class="col-xs-12 text-center danhsach_ten" <?=$motty != "" ? "style='display: none';" : ""?>>
                <a onclick="$('.alphabet').show();" class="findlink cur"><?=$glo_lang['danh_sach_ten_theo_alphabet']?></a>
            </div>-->
            <div class="col-xs-12 text-center danhsach_ten">
                <a onclick="timPhoBien('<?= $full_url . '/' . $thongtin_step['seo_name'] ?>')" class="findlink cur"><?=$glo_lang['danh_sach_pho_bien_theo_nam']?></a>
            </div>
        </div>
        <div class="clr"></div>
        <script type="text/javascript">
            function timKiemTen(url, cls, loai) {
                if ($(cls).val() == "") {
                    $(cls).focus();
                }else{
                    var wh = "";
                    var gioitinh = $('input[name="gioitinh"]:checked').val();
                    if(loai == 1) wh += "?ten=" + $(cls).val().trim().replace(/ /g, "+");
                    else wh += "?ynghia=" + $(cls).val().trim().replace(/ /g, "+");
                    if (!isEmpty(gioitinh)) {
                        if (gioitinh == 2) wh += "&gioitinh=2";
                        else if (gioitinh == 1) wh += "&gioitinh=1";
                        else wh += "&gioitinh=0";
                    }
                    window.location.href = url + wh;
                }
            }
            function timPhoBien(url) {
                var wh = "?phobien&hide=1";
                window.location.href = url + wh;
            }
        </script>
    </div>
</div>