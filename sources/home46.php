<?php include _source."banner_top.php";?>

<div class="padding_pagewrap">
  <?php
    $noidung= LAYTEXT_rieng(78);
    if(is_array($noidung)){
  ?>
    <div class="title_page_id_2">
          <ul>
            <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
            <p><?=SHOW_text($noidung['p1_'.$lang]) ?></p>
          </ul>
        </div>
      <div class="auout_home">
      <li><?=full_img($noidung, '') ?></li>
      <ul>
        <div>
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
        <h3><a <?=full_href($noidung) ?>><?=$glo_lang['xem_chi_tiet'] ?> <i class="fa fa-angle-double-right"></i></a></h3>
      </ul>
      <div class="clr"></div>
    </div>
    <?php } ?>
    <?php
      $sp_baiviet   = LAY_baiviet(2, 24, "`opt1` = 1");
      // $sp_step      = LAY_step(2, 1);
      if(count($sp_baiviet)){
    ?>
    <div class="pro_id pro_id_slider no_box">
      <!--  -->
      <?php $data = array("1","2","2","3","4","4") ?>
      <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <div class="item">
        <ul>
          <a <?=full_href($rows) ?>>
          <li><img src="<?=full_src($rows, '') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
          <p><span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
          </a>
        </ul>
      </div>
      <?php } ?>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  <?php } ?>
</div>
