<?php
  $noidung    = LAYTEXT_rieng(78);
?>
<div class="footer">
  <div class="pagewrap">
    <div class="left_logo_footer">
      <ul>
        <li><?=full_img($noidung, '') ?></li>
      </ul>
    </div>
    <div class="left_footer">
      <ul>
        
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
    </div>
    <div class="right_footer">
      <iframe class="iframe_load" iframe-src="<?=$noidung['seo_name'] ?>" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="bottom_ft">
  <div class="pagewrap">
    <p><span><?=SHOW_text($noidung['p1_'.$lang]) ?></span><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a> </p>
    <ul>
      
      <?php
        $banner_top        = LAY_banner_new("`id_parent` = 26");

        foreach ($banner_top as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> ><?=full_img($rows, '') ?></a></li>
      <?php } ?>
      <div class="clr"></div>
    </ul>
    <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>
<?php include _source."mang_xa_hoi.php"; ?>