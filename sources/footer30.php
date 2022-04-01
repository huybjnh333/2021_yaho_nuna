<div class="footer_top">
  <div class="pagewrap">
    <ul class="gt_footer">
      <?php
        $noidung    = LAYTEXT_rieng(62);
      ?>
      <h2><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
      <div>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
      </div>
    </ul>
    <ul>
      <?php
        $noidung    = LAYTEXT_rieng(63);
      ?>
      <h2><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
      <div>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
      </div>
    </ul>
    <ul class="bos_ss flex">
      <h2><?=$glo_lang['navigation'] ?></h2>
      <div class="bs_ff">
        <?php
          $lienket = LAY_thuoctinhchung();
          foreach ($lienket as $rows) {
        ?>
        <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </div>
      <div class="clr"></div>
    </ul>
    <div class="clr"></div>
  </div>
</div>
<div class="bottom_id_copyright">
  <div class="pagewrap">
    <p><?=$glo_lang['ban_quyen_name'] ?> <a href="https://web30s.vn/" title="thiết kế website" target="_blank">developed P.A Vietnam, </a> All rights reserved</p>
    <p>
    <div class="sharelink"> <a rel="nofollow" target="_top" class="addthis_button_facebook"><img src="images/facebook.png" title="facebook" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_twitter"><img src="images/twitter.png" title="twitter" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_google"><img src="images/google+.png" title="google+" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_email"><img src="images/email.png" title="email" border="0"/></a> <a class="addthis_button_compact"><img src="images/addthis.png" title="addthis" border="0"/></a>
    </div>
    </p>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
