<?php include _source."banner_top.php";?>
<?php
  $noidung    = LAYTEXT_rieng(80);
  if(is_array($noidung)){
?>
<div class="homeabout">
  <div class="pagewrap">
    <ul>
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?><span><?=SHOW_text($noidung['p1_'.$lang]) ?></span></h3>
      <div>
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      <h4><a <?=full_href($noidung) ?>><?=$glo_lang['xem_chi_tiet'] ?></a></h4>
      <div class="clr"></div>
    </ul>
    <li><?=full_img($noidung, 'thumb_') ?></li>
    <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(2, 24, "`opt` = 1");
  $sp_step      = LAY_step(2, 1);
  if(count($sp_baiviet)){
?>
<div class="box_sp_3">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=$glo_lang['san_pham_noi_bat'] ?></h3>
      </ul>
    </div>
    <div class="pro_id pro_id_home pro_id_home_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","4","5") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          $view  = "slider";
          foreach ($sp_baiviet as $rows) {
            // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
          ?>
          <div class="item"><?php include _source.'home_temp.php'; ?></div>
          <?php } ?>

        </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>

<div class="tt_id_bs">
  <div class="pagewrap">
  <div class="titile_page titile_page_2">
      <h3><?=$glo_lang['tin_tuc_su_kien'] ?></h3>
      <div class="clr"></div>
    </div>
    <div class="tt_home_bs no_box flex">
      <?php
          $sp_step   = LAY_step(3, 1);
          $sp_danhmuc   = LAY_danhmuc(3, 0, "`opt` = 1");
          foreach ($sp_danhmuc as $dm) {
            $sp_baiviet = LAY_baiviet(3, 3, "`opt` = 1 AND `id_parent` = '".$dm['id']."'");
            foreach ($sp_baiviet as $rows) {
              $motn = date("m", $rows['ngaydang']);
              $year = date("Y", $rows['ngaydang']);
        ?>
        <ul>
          <p><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?> <span><?=$motn."/".substr($year, 2); ?></span></p>
          <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
          <div class="clr"></div>
        </ul>
        <?php }} ?>
    </div>
    <div class="clr"></div>
    <div class="xemthem_home"><a <?=full_href($sp_step) ?>><?=$glo_lang['xem_them'] ?><i class="fa fa-long-arrow-right" ></i></a></div>
    <div class="clr"></div>
  </div>
</div>
<?php
  $sp_baiviet   = LAY_baiviet(4, 24, "`opt` = 1");
  // $sp_step      = LAY_step(2, 1);
  if(count($sp_baiviet)){
?>
<div class="box_doitac_home">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=$glo_lang['doi_tac_khach_hang'] ?></h3>
      </ul>
    </div>
    <div class="logo_doitac">
      <!--  -->
      <?php $data = array("2","3","4","5","6","6") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          // $i = 0;
          foreach ($sp_baiviet as $rows) { 
            // $i++;
            // if($i == 1) echo '<div class="item">';
        ?>
        <div class="item">
          <ul>
            <a <?=full_href($rows) ?>>
              <li class="logo_thuonghieu"><img src="<?=full_src($rows, '') ?>"></li>
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