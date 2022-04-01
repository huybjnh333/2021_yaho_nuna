<?php include"banner_top.php";?>
<div class="aboutus_4" id="conten_page">
  <div class="pagewrap">
    <?php
      $noidung        = LAYTEXT_rieng(60);
      if(count($noidung)){
    ?>
    <div class="left_aboutus_4">
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div class="nd">
        <?=SHOW_text($noidung['noidung_'.$lang]) ?> 
      </div>
    </div>
    <?php } ?>
    <div class="right_aboutus_4">
      <ul>
        <h3><?=$glo_lang['explore_our_services'] ?></h3>
        <?php
            $step          = 2;
            $sp_baiviet    = LAY_baiviet($step, 4,"`opt1` = 1 ");
            if(count($sp_baiviet)) {
              foreach ($sp_baiviet as $rows) {
        ?>
        <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?><span><i class="fa fa-angle-right"></i></span></a></li>
        <?php }} ?>
      </ul>
    </div>
    <div class="clr"></div>
  </div>
</div>
<?php
    $step          = 4;
    $sp_step       = LAY_step($step, 1);
    $sp_baiviet    = LAY_baiviet($step, 4,"`opt1` = 1 ");
    if(count($sp_baiviet)) {
?>
<div class="box_library_4">
  <div class="pagewrap">
    <div class="title_4"><?=$glo_lang['library'] ?></div>
    <div class="library_4">
      <?php
              foreach ($sp_baiviet as $rows) {
      ?>
        <ul>
          <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
          <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
          <h4><span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></h4>
          <div class="clr"></div>
        </ul>
      <?php } ?>
      <h2><a <?=full_href($sp_step) ?>><?=$glo_lang['view_more_doc'] ?><i class="fa fa-angle-right"></i></a></h2>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 25", 1);
?>
<div class="box_demo401" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <ul>
      <div class="left_o1"></div>
      <h3><?=SHOW_text($hinhanh['tenbaiviet_'.$lang]) ?></h3>
      <p>“<?=SHOW_text(strip_tags($hinhanh['noidung_'.$lang])) ?>”</p>
      <div class="right_o1"></div>
    </ul>
  </div>
</div>
<div class="box_outservices_4">
  <div class="pagewrap">
    <div class="left_outservices_4">
      <ul>
        <?php
          $noidung        = LAYTEXT_rieng(65);
          if(count($noidung)){
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div>
          <?=SHOW_text($noidung['noidung_'.$lang]) ?> 
        </div>
        <?php } ?>
      </ul>
    </div>
    <div class="right_outservices_4">
      
      <?php
          $step          = 2;
          $sp_baiviet    = LAY_baiviet($step, 3,"`opt` = 1 ");
          if(count($sp_baiviet)) {
            foreach ($sp_baiviet as $rows) {
      ?>
      <ul>
        <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
        <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a><span class="lm_5"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></h3>
        <div class="clr"></div>
      </ul>
      <?php }} ?>
      
    </div>
    <div class="clr"></div>
  </div>
</div>
<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 26", 1);
?>
<div class="box_home_2" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <ul>
      <h3><?=SHOW_text($hinhanh['tenbaiviet_'.$lang]) ?></h3>
      <p><?=SHOW_text(strip_tags($hinhanh['noidung_'.$lang])) ?></p>
      <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" enctype="multipart/form-data">
        <div class="col-md-7 row-frm">
          <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control" placeholder="<?=$glo_lang['ho_va_ten'] ?>">
        </div>
        <div class="col-md-7 row-frm" >
          <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control" placeholder="<?=$glo_lang['so_dien_thoai'] ?>">
        </div>
        <div class="col-md-7 row-frm">
          <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control" placeholder="<?=$glo_lang['email'] ?> *">
        </div>
        <h4><a onclick="DANGKY_email('<?=$full_url ?>')" class="cur"><?=$glo_lang['dang_ky_ngay'] ?> <img src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a></h4>
        <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
        <div class="clr"></div>
      </form>
    </ul>
  </div>
</div>
<?php 
  $banner_top = LAY_banner_new("`id_parent` = 29");
  if(count($banner_top)) {
?>
<div class="box_doitac_home">
  <div class="pagewrap">
    <h3><?=$glo_lang['doi_tac_khach_hang'] ?></h3>
    <div class="logo_doitac no_box">
      <!--  -->
      <?php $data = array("2","3","4","5","6","7") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          // $i = 0;
          foreach ($banner_top as $rows) { 
            // $i++;
            // if($i == 1) echo '<div class="item">';
        ?>
        <div class="item">
        <ul>
          <a <?=full_href($rows) ?>>
          <li><?=full_img($rows, '') ?></li>
          </a>
        </ul>
        </div>
        <?php } // if($i == 2) { echo '</div>'; $i = 0;} } if($i == 1)  echo '</div>'; ?>

      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>
<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 32", 1);
?>
<div class="box_demo401 box_demo402" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <ul>
      <div class="left_o1"></div>
      <h3><?=SHOW_text($hinhanh['tenbaiviet_'.$lang]) ?></h3>
      <p>“<?=SHOW_text(strip_tags($hinhanh['noidung_'.$lang])) ?>”</p>
      <div class="right_o1"></div>
    </ul>
  </div>
</div>
<?php 
  $banner_top = LAY_banner_new("`id_parent` = 27");
  if(count($banner_top)) {
?>
<div class="best_business">
  <div class="pagewrap">
    <div class="topbest_business">
      <?php
        $noidung        = LAYTEXT_rieng(64);
        if(count($noidung)){
      ?>
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?> 
      </div>
      <?php } ?>
    </div>
    <div class="flex no_box">
      <?php
        foreach ($banner_top as $rows) { 
      ?>
      <ul>
        <a <?=full_href($rows) ?>>
        <li><?=full_img($rows, '') ?></li>
        <h4><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h4>
        <p><span class="lm_4"><?=SHOW_text(strip_tags($rows['noidung_'.$lang])) ?></span></p>
        </a>
      </ul>
      <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php
  $noidung        = LAYTEXT_rieng(61);
  if(count($noidung)){
?>
<div class="our_job_workflow">
  <div class="pagewrap">
    <h2><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
    <div class="left_our_job_workflow"><?=full_img($noidung, '') ?></div>
    <div class="right_our_job_workflow">
      <?=SHOW_text($noidung['noidung_'.$lang]) ?> 
    </div>
    <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php 
    $step          = 3;
    $sp_step       = LAY_step($step, 1);
    $sp_baiviet    = LAY_baiviet($step, 3,"`opt1` = 1 ");
    if(count($sp_baiviet)) {
?>
<div class="news_and_events">
  <div class="pagewrap">
    <div class="left_news_and_events">
      <h3><?=$glo_lang['tin_tuc_noi_bat'] ?></h3>
      <?php 
        foreach ($sp_baiviet as $rows) {
      ?>
      <ul>
        <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
        <h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a>
          <span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span>
        </h4>
        <div class="clr"></div>
      </ul>
     <?php } ?>
      <h2><a <?=full_href($rows) ?>><?=$glo_lang['xem_them_tin_tuc'] ?><i class="fa fa-angle-right"></i></a></h2>
    </div>
    <div class="right_news_and_events">
      <h3><?=$glo_lang['su_kien_sap_toi'] ?></h3>
      <ul>
        <?php 
          $sp_baiviet    = LAY_baiviet($step, 4,"`opt` = 1 ");
          foreach ($sp_baiviet as $rows) {
        ?>
        <h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h4>
        <p><i class="fa fa-calendar"></i><?=CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>, <?=$glo_lang['date'] ?> <?=date("d/m/Y", $rows['ngaydang']) ?></p>
       <?php } ?>
      </ul>
    </div>
    <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php 
  $sp_baiviet    = LAY_baiviet(7, 6,"`opt1` = 1 ");
  $sp_step       = LAY_step(7, 1);
  if(count($sp_baiviet)) {
?>
<div class="box_our_experts">
  <div class="pagewrap">
    <h2><?=SHOW_text($sp_step['tenbaiviet_'.$lang]) ?></h2>
    <div class="dv-chuyengia">
      <!--  -->
      <?php $data = array("1","1","2","2","2","2") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          foreach ($sp_baiviet as $rows) { 
        ?>
        <div class="item">
          <div class="our_experts">
            <ul>
              <div class="add_con">
                <?=SHOW_text($rows['mota_'.$lang]) ?>
              </div>
              <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></li>
              <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a><span><?=SHOW_text(strip_tags($rows['thuoc_tinh_1_'.$lang])) ?></span></h3>

              <div class="clr"></div>
            </ul>
          </div>
        </div>
        <?php } ?>

      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>