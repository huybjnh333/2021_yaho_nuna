<div class="footer">
    <div class="w-full relative block">
        <img class="wave-svg" src="images/footer.svg" alt="">
    </div>
    <div class="pagewrap">
        <div class="center-footer">
            <ul class="menu-footer">
                <h3><?=$glo_lang['ho_tro_khach_hang']?></h3>
                <?= GET_menu_new($full_url, $lang, 'hidden', '', '', "1") ?>
                <div class="clr"></div>
            </ul>
            <?php $lienhe_footer = LAYTEXT_rieng(93); ?>
            <ul>
                <h3><?=$lienhe_footer['tenbaiviet_'.$lang]?></h3>
                <div class="showText"><?=SHOW_text($lienhe_footer['noidung_'.$lang])?></div>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="top_contact">
            <ul class="social">
                <?php include _source."mang_xa_hoi.php";?>
            </ul>
            <p><img src="<?=full_src($thongtin,"","icon_hover")?>"></p>
            <p><?= $glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">
                    <?=$glo_lang['thiet_ke_va_phat_trien']?>
                </a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="back-top" style="display: block;"><a href="#top"><i class="fa fa-angle-double-up"></i></a></div>
