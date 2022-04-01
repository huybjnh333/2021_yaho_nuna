<div class="footer">
  <div class="pagewrap">
    <div class="flex no_box">
      <ul class="left_footer">
        <?php
          $noidung    = LAYTEXT_rieng(78);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
      <?php
        $step       = 1;
        $sp_step    = LAY_step($step);
        $sp_baiviet = LAY_baiviet($step, 10);
      ?>
      <ul>
        <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-double-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul>
      <?php
        $step       = 2;
        $sp_step    = LAY_step($step);
        $sp_baiviet = LAY_danhmuc($step, 10, "`id_parent` = 0");
      ?>
      <ul>
        <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-double-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul>
      <?php
        $step       = 5;
        $sp_step    = LAY_step($step);
        $sp_baiviet = LAY_danhmuc($step, 10, "`id_parent` = 0");
      ?>
      <ul>
        <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-double-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="bottom_ft">
  <div class="pagewrap">
    <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
    <div class="dv-right">
      <?php
        $noidung    = LAYTEXT_rieng(79);
        echo SHOW_text($noidung['noidung_'.$lang]);
      ?>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>
<?php include _source."mang_xa_hoi.php"; ?>