<?php include _source."banner_top.php";?>
<?php
    $noidung= LAYTEXT_rieng(78);
    if(is_array($noidung)){
      $gioithieu = LAY_step(1, 1);
  ?>
<div class="box_auout_home">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      </ul>
    </div>
    <div class="auout_home">
      <li>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=GET_ID_youtube($noidung['seo_name']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </li>
      <ul>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        <h3><a <?=full_href($gioithieu) ?>><?=$glo_lang['xem_chi_tiet'] ?> <i class="fa fa-angle-double-right"></i></a></h3>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 27");
  if(is_array($banner_top)){
?>
<div class="gt_them">
  <div class="pagewrap">
    <div class="dv_gt_them">
        <!--  -->
        <?php $data = array("1","2","2","3","4","4") ?>
          <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
          <?php 
            foreach ($banner_top as $rows) { 
          ?>
          <div class="item">
    	       <ul>
                <li><img src="<?=full_src($rows, '') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
                <p><?=SHOW_text($rows['mota_'.$lang]) ?></p>
                <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
              </ul>
          </div>
          <?php } ?>

        </div>
        <!--  -->
  	   <div class="clr"></div>
  	</div>
    <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet = LAY_baiviet(2, 8, "`opt` = 1");
  $sp_step    = LAY_step(2, 1);
  $tinhnang   = LAY_bv_tinhnang(2);
  if(count($sp_baiviet)){
?>
<div class="box_project_home">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=$glo_lang['san_pham_noi_bac'] ?></h3>
        <p><?=$glo_lang['san_pham_noi_bac_mo_ta'] ?></p>
      </ul>
    </div>
    <div class="project_id flex">
      <?php
        foreach ($sp_baiviet as $rows) {
          // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
          include _source.'home_temp.php';
        }
      ?>
      
      <div class="clr"></div>
    </div>
    <div class="xemthem_id">
      <h3><a <?=full_href($sp_step) ?>><?=$glo_lang['xem_them_san_pham'] ?><i class="fa fa-long-arrow-right"></i></a></h3>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(4, 18, "`opt` = 1");
  if(count($sp_baiviet)){
?>
<div class="box_page">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=$glo_lang['tin_tuc_su_kien'] ?></h3>
      </ul>
    </div>
    <div class="pro_id pro_id_slider no_box">
      <!--  -->
      <?php $data = array("1","2","3","3","4","4") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <div class="item">
          <ul>
            <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/></a></li>
            <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
            <p><span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
            <h4><a <?=full_href($rows) ?>><?=$glo_lang['xem_chi_tiet'] ?><i class="fa fa-long-arrow-right"></i></a></h4>
          </ul>
        </div>
        <?php } ?>

      </div>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 29");
  if(count($banner_top)) {
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
          foreach ($banner_top as $rows) { 
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