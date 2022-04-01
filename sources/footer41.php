<div class="footer">
  <div class="pagewrap">
    <div class="flex">
    <?php
      $step       = 9;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_baiviet($step, 10);
    ?>
    <ul>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> ><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
    <?php
      $step       = 7;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_baiviet($step, 10);
    ?>
    <ul>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> ><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
    <?php
      $step       = 8;
      $sp_step    = LAY_step($step);
      $sp_baiviet = LAY_baiviet($step, 10);
    ?>
    <ul>
      <h3><?=$sp_step[0]['tenbaiviet_'.$lang] ?></h3>
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <li><a <?=full_href($rows) ?> ><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
    <ul class="what_next">
      <h3><?=$glo_lang['dang_ky_nhan_ban_tin'] ?></h3>
      <p><?=$glo_lang['test_dang_ky_nhan_ban_tin'] ?></p>
      <div class="email_ffoter">
        <!-- <ul class="no_box"> -->
          <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" enctype="multipart/form-data">
            <div class="col-md-7 row-frm" style="display: none">
              <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control" placeholder="<?=$glo_lang['ho_va_ten'] ?>">
            </div>
            <div class="col-md-7 row-frm" style="display: none" >
              <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control" placeholder="<?=$glo_lang['so_dien_thoai'] ?>">
            </div>
            <div class="col-md-6 row-frm" >
              <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control" placeholder="<?=$glo_lang['nhap_dia_chi_email'] ?> *">
            </div>
            <h4><a onclick="DANGKY_email('<?=$full_url ?>')" class="cur"><?=$glo_lang['gui'] ?> <img src="images/loading2.gif" class=" ajax_img_loading_mail"></a></h4>
            <input name="capcha_hd" type="hidden" id="capcha_hd" class="capcha_hd" value="<?=$_SESSION['cap'] = RAND(11111,99999) ?>">
            <div class="clr"></div>
          </form>
        <!-- </ul> -->
        <div class="clr"></div>
      </div>
      <p><?=$glo_lang['subscribe_policies'] ?></p>
    </ul>
    <div class="clr"></div>
    </div>
  </div>
</div>
<div class="footer_bottom">
  <div class="pagewrap">
    <?php
      $rows = LAY_banner_new("`id_parent` = 27", 1);
      if(is_array($rows)) {
    ?>
    <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows, '') ?>" alt="<?=$rows['tenbaiviet_'.$lang] ?>" /></a></li>
    <?php } ?>
    <ul>
      <p><?=$glo_lang['ban_quyen_name'] ?></p>
      <p><a href="https://web30s.vn/" title="thiết kế website" target="_blank">Designed and developed by P.A Vietnam</a></p>
    </ul>
    <div class="clr"></div>
  </div>
</div><div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>
<?php include _source."check_yeu_thich.php"; ?>
<div class="dv-con-list-spct-cten no_box" onclick="$('.dv-con-list-spct-cten, .dv-con-list-spct').hide();$('body').removeClass('body_hide');">
  <div class="dv-con-list-spct" >
    <a onclick="$('.dv-con-list-spct-cten, .dv-con-list-spct').hide();$('body').removeClass('body_hide');" class="close-popnew cur">×</a>
    <div class="js-cont"></div>
  </div>
</div>