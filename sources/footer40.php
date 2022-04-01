<div class="footer_top">
  <div class="pagewrap">
    <div class="flex">
    <ul class="contact_footer">
      <?php
          $noidung    = LAYTEXT_rieng(73);
      ?>
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div class="n-foot">
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
      </div>
    </ul>
    <?php
      $step       = 3;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_baiviet($step, 10, "`opt1` = 1");
    ?>
    <ul>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> >» <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
    <?php
      $step       = 5;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_baiviet($step, 10, "`opt1` = 1");
    ?>
    <ul>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> >» <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
    <ul class="face_bottom">
      <div class="fb-page" data-href="<?=$glo_lang['fanpage'] ?>" data-tabs="timeline" data-width="280" data-height="230" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="<?=$glo_lang['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?=$glo_lang['fanpage'] ?>"><?=$thongtin['tenbaiviet_vi'] ?></a></blockquote>
      </div>
    </ul>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="bottom_id_copyright">
  <div class="pagewrap">
    <div class="right_footer">
      <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Desgin By P.AVietNam</a></p>
      <p><?=$glo_lang['dang_online'] ?>: <?=NUMBER_fomat($online_tv) ?> | <?=$glo_lang['tong_view'] ?>: <?=NUMBER_fomat($thongke_tv) ?><p>
    </div>
    <ul>
      <h3><?=$glo_lang['mang_xa_hoi'] ?></h3>
      <?php
        $mangxahoi = SHOW_mxh();
        foreach ($mangxahoi as $rows) {

      ?>
      <li><a target="_blank" <?=full_href($rows) ?> ><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>" alt=""></a></li>
      <?php } ?>
    </ul>
    <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></div>
<?php include _source."hotline.php"; ?>
<?php include _source."check_yeu_thich_cookie.php"; ?>
<div class="dv-con-list-spct-cten no_box" onclick="$('.dv-con-list-spct-cten, .dv-con-list-spct').hide();$('body').removeClass('body_hide');">
  <div class="dv-con-list-spct" >
    <a onclick="$('.dv-con-list-spct-cten, .dv-con-list-spct').hide();$('body').removeClass('body_hide');" class="close-popnew cur">×</a>
    <div class="js-cont"></div>
  </div>
</div>