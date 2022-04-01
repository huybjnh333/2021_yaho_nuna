<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 30", 1);
?>
<div class="footer" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <div class="left_footer">
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(82);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
    </div>
    <div class="map_footer"><iframe class="iframe_load" iframe-src="<?=$noidung['seo_name'] ?>" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
    <div class="face_footer">
      <div class="fb-page" data-href="<?=$glo_lang['fanpage'] ?>" data-tabs="timeline" data-width="290" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="<?=$glo_lang['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?=$glo_lang['fanpage'] ?>"><?=$thongtin['tenbaiviet_vi'] ?></a></blockquote>
      </div></div>
    <div class="clr"></div>
    <div class="bottom_ft">
      <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank"> P.A Việt Nam</a></p>
      <?php include _source."mang_xa_hoi.php" ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php" ?>