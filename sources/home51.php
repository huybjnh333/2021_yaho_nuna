<?php include"banner_top.php";?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 27");
  if(count($banner_top)) {
?>
<div class="box_top_home">
	<div class="pagewrap">
    <div class="top_home">
      <!--  -->
      <?php $data = array("1","2","2","3","4","4") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          foreach ($banner_top as $rows) { 
        ?>
        <div class="item">
          <ul>
            <li><img src="<?=full_src($rows, '') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
            <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
            <p><?=SHOW_text($rows['mota_'.$lang]) ?></p>
          </ul>
        </div>
        <?php } ?>

      </div>
      <!--  -->

    	<div class="clr"></div>
		</div>
  </div>
</div>
<?php } ?>
<?php
  $noidung= LAYTEXT_rieng(78);
  if(is_array($noidung)){
?>
<div class="box_auout_home">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
         <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      </ul>
    </div>
    <div class="auout_home">
      <li><?=full_img($noidung, '') ?></li>
      <ul>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        <h3><a <?=full_href($noidung) ?>><?=$glo_lang['xem_chi_tiet'] ?> <i class="fa fa-angle-double-right"></i></a></h3>
      </ul>
      <div class="clr"></div>
    </div>
    
  </div>
</div>
<?php } ?>
<?php
  $danhmuc = LAY_danhmuc(2,0,"`opt` = 1");
  foreach ($danhmuc as $dm) {
    $lay_all_kx  = LAYDANHSACH_idkietxuat($dm['id'], $dm['step']);
    $sp_baiviet  = LAY_baiviet($dm['step'], 18, "`id_parent` IN (".$lay_all_kx.")", "`opt` DESC, `catasort` DESC");
    if(!count($sp_baiviet)) continue;
?>
<div class="box_project_home">
  <div class="pagewrap">
    <div class="title_page_id_2">
      <ul>
        <h3><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?></h3>
      </ul>
    </div>
    <div class="project_id project_id_slider no_box">
      <!--  -->
      <?php $data = array("1","2","2","3","3","3") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
          <?php
            foreach ($sp_baiviet as $rows) {
          ?>
            <div class="item">
              <ul>
                <a <?=full_href($rows) ?>>
                  <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
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
  </div>
</div>
<?php } ?>
