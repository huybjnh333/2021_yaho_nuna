<div class="footer">
  <div class="pagewrap">
    <div class="footer_id">
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(78);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(80);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(81);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(82);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
<div class="footer_bottom">
  <div class="pagewrap">
    <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank"> P.A Việt Nam</a></p>
    <?php include _source."mang_xa_hoi.php"; ?>
    <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>
