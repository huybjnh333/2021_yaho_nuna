<?php include"banner_top.php";?>
<?php
    $step          = 2;
    $sp_step       = LAY_step($step, 1);
    $sp_baiviet    = LAY_baiviet($step, 6,"`opt1` = 1 ");
    if(count($sp_baiviet)) {
?>
<div class="box_duan">
  <div class="pagewrap">
  <div class="title_id"><?=$glo_lang['cac_cong_trinh_noi_bat'] ?></div>
  
  <div class="flex no_box">
    <?php
          foreach ($sp_baiviet as $rows) {
    ?>
    <div class="list-nospacing">
      <li class='onePro'> <a <?=full_href($rows) ?> class='thumb'><?=full_img($rows) ?></a>
        <ul>
          <li> <a <?=full_href($rows) ?> class='tit'><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a> <span class='kind'> </span> </li>
        </ul>
      </li>
    </div>
    <?php } ?>
  </div>

  <div class="clr"></div>
  <div class="bottom_more">
    <h3><a <?=full_href($sp_step) ?>><?=$glo_lang['xem_them'] ?> ›</a></h3>
  </div>
  </div>
</div>
<?php } ?>
<?php 
    $step          = 6;
    $sp_step       = LAY_step($step, 1);
    $sp_baiviet    = LAY_baiviet($step, 12,"`opt1` = 1 ");
    if(count($sp_baiviet)) {
?>
<div class="tintuc_home_box">
  <div class="pagewrap">
    <div class="title_id"><?=$glo_lang['tin_tuc_su_kien'] ?></div>
    <div class="tintuc_home_id tintuc_home_id_slider no_box">
      <!--  -->
      <?php $data = array("1","1","2","2","3","3") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php 
          foreach ($sp_baiviet as $rows) { 
        ?>
        <div class="item">
          <ul>
            <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></li>
            <h4><i class="fa fa-calendar"></i><?=CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>, <?=$glo_lang['date'] ?> <?=date("d/m/Y", $rows['ngaydang']) ?></h4>
            <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
            <p><span class="lm_4"><?=SHOW_text($rows['mota_'.$lang]) ?></span></p>
          </ul>
        </div>
        <?php } ?>

      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>
<script>
  // .bannerMain
  $(function(){
    var wid  = $(document).width();
    if(wid < 992) {
      var wis_new = 0;
      if(wid < 479)  wis_new = 66;
      else if(wid < 767)  wis_new = 95;
      else if(wid < 991)  wis_new = 70;
      
      var hei_con = $(".box_menu").height() + $(".box_doitac_home").height() + $(".bottom_id_copyright").height() + wis_new;
      $(".bannerMain, .banner li").attr("style", "min-height: 200px; height: calc(100vh - "+hei_con+"px) !important");
      $(".banner li img").attr("style", " width: auto !important");
    }
  })
</script>