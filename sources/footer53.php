<?php
$noidung = LAYTEXT_rieng(82);
?>
<div class="footer_top">
    <div class="pagewrap">
        <ul class="contact_footer">
            <h3><?= full_img($noidung, '') ?></h3>
        </ul>
        <div class="dv-foot-cent">
            <ul id="menu-footer-menu" class="menu">
                <?= GET_menu_new($full_url, $lang, '', '', '', 9) ?>
            </ul>
            <div class="clr"></div>
            <div class="footer_a_d">
                <!-- <h3><?= SHOW_text($noidung['tenbaiviet_' . $lang]) ?></h3> -->
                <div class="n-foot">
                    <?= SHOW_text($noidung['noidung_' . $lang]) ?>
                </div>
                <div class="clr"></div>
            </div>
            <div class="dt-sc-newsletter-section type2 no_box">
                <h4><?= $glo_lang['dang_ky_nhan_ban_tin'] ?></h4>
                <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin"
                      enctype="multipart/form-data">
                    <div class="col-md row-frm">
                        <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="text-a-hoten"
                               placeholder="<?= $glo_lang['ho_va_ten'] ?>">
                    </div>
                    <div class="col-md row-frm" style="display:none">
                        <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control"
                               placeholder="<?= $glo_lang['so_dien_thoai'] ?>">
                    </div>
                    <div class="col-md row-frm">
                        <input type="text" name="ip_sentmail" id="ip_sentmail" class="text-a-hoten"
                               placeholder="<?= $glo_lang['email'] ?> *">
                    </div>
                    <a onclick="DANGKY_email('<?= $full_url ?>')" class="cur"><?= $glo_lang['gui'] ?> <img
                                src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a>
                    <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
                    <div class="clr"></div>
                </form>
                <div class="dt_ajax_subscribe_msg"></div>

            </div>
        </div>
        <div class="footer-r-a">
            <h3><?= $glo_lang['mang_xa_hoi'] ?></h3>
            <iframe src="https://www.facebook.com/plugins/page.php?href=<?= $glo_lang['fanpage'] ?>&tabs=timeline&width=250&height=220&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                    width="250" height="220" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div class="bottom_id_copyright">
    <div class="pagewrap">
        <p><?= $glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết
                kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
        <div class="column dt-sc-one-half ">
            <ul class="dt-sc-sociable"><?php include _source . "mang_xa_hoi.php" ?></ul>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>

