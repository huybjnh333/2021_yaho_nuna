<?php
  $banner_top = LAY_banner_new("`id_parent` = 26");
  if(count($banner_top)){
?>
<div class="banner_footer">
  <ul>
    <?php
      foreach ($banner_top as $r) {
    ?>
    <li><a <?=full_href($r) ?>><?=full_img($r, '') ?></a></li>
    <?php } ?>
    <div class="clr"></div>
  </ul>
</div>
<?php } ?>
<?php
  if(empty($glo_ship)) {
    $glo_ship = DB_fet_rd("`id`, `tenbaiviet_vi`, `tenbaiviet_en`","#_ship_khuvuc"," `id_parent` = 0","`catasort` ASC, `id` ASC");
  }
  if(empty($step_sp)) {
    $step_sp      = LAY_step(2,1);
  }
?>
<div class="footer_top">
  <ul>
    <h3><?=$glo_lang['vat_lieu_theo_tinh_thanh'] ?></h3>
    <div class="list-tinh-footer">
      <?php foreach ($glo_ship as $rows) {?>
        <a href="<?=$full_url."/".$step_sp['seo_name']."/?t=".$rows['id'] ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a>
      <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </ul>
</div>
<div class="bottom_footer">
  <ul class="left_bottom">
    <?php
        $noidung    = LAYTEXT_rieng(73);
    ?>
    <h3 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
    <div class="n-foot">
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
    </div>
  </ul>
  <ul class="center_bottom">
    <?php
      $step = 2;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_danhmuc($step, 20, "`id_parent` = 0");
    ?>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
  </ul>
  <ul class="face_bottom">
    <div class="fb-page" data-href="<?=$glo_lang['fanpage'] ?>" data-tabs="timeline" data-width="350" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
      <blockquote cite="<?=$glo_lang['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?=$glo_lang['fanpage'] ?>"><?=$thongtin['tenbaiviet_vi'] ?></a></blockquote>
    </div>
  </ul>
  <div class="clr"></div>
</div>
<div class="bottom_id_copyright">
  <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank"> P.A Việt Nam</a></p>
  <p><?=$glo_lang['dang_online'] ?>: <?=NUMBER_fomat($online_tv) ?> | <?=$glo_lang['tong_view'] ?>: <?=NUMBER_fomat($thongke_tv) ?></p>
  <div class="sharelink"> <a rel="nofollow" target="_top" class="addthis_button_facebook at300b" title="Facebook" href="#"><img src="images/facebook.png" title="facebook" border="0"></a> <a rel="nofollow" target="_top" class="addthis_button_twitter at300b" title="Twitter" href="#"><img src="images/twitter.png" title="twitter" border="0"></a> <a rel="nofollow" target="_top" class="addthis_button_google at300b" title="Google Bookmark" href="#"><img src="images/google+.png" title="google+" border="0"></a> <a rel="nofollow" target="_top" class="addthis_button_email at300b" title="Email" href="#"><img src="images/email.png" title="email" border="0"></a> <a class="addthis_button_compact at300m" href="#"><img src="images/addthis.png" title="addthis" border="0"></a>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>