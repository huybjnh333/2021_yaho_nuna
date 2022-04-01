<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 30", 1);
?>
<div class="footer" style="background: url(<?=full_src($hinhanh, '') ?>) center top no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
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
    <div class="right_footer">
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
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul> 
      <?php
        $step       = 2;
        $sp_step    = LAY_step($step);
        $sp_baiviet = LAY_danhmuc($step, 10);
      ?>
      <ul>
        <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul> 
      <?php
        $step       = 3;
        $sp_step    = LAY_step($step);
        $sp_baiviet = LAY_danhmuc($step, 10);
      ?>
      <ul>
        <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?> ><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul> 
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="bottom_ft">
      <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank"> P.A Việt Nam</a></p>
      <?php include _source."mang_xa_hoi.php" ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<div id="back-top"><a href="#top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></div>


<div class="fix-left-icon">
  <a href="tel:<?=$thongtin['hotline_vi'] ?>"><img src="images/ic-left-1.png"></a>
  <a href="http://zalo.me/<?=$thongtin['sodienthoai_vi'] ?>" target="_blank"><img src="images/ic-left-2.png"></a>
  <a href="mailto:<?=$thongtin['email_vi'] ?>"><img src="images/ic-left-3.png"></a>
  <a href="<?=$glo_lang['link_google_map'] ?>" target="_blank"><img src="images/ic-left-4.png"></a>

<div class="clr"></div>
</div>