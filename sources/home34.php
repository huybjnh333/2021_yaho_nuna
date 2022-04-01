<?php include"banner_top.php";?>
<?php
    $noidung    = LAYTEXT_rieng(71);
    $hinhanh    = LAY_banner_new("`id_parent` = 26", 1);
    if(is_array($noidung)){
?>
<div class="dv-home-about" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <div class="dv-home-about-cont flex">
      <div class="dleft">
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div>
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </div>
      <div class="dright">
        <?=full_img($noidung, '') ?>
      </div>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $baiviet_nd   = LAY_baiviet("2", 0, "`opt1` = 1");
  $c_baiviet_nd = count($baiviet_nd);
  if($c_baiviet_nd){
?>
<div class="dv-dicvu-home">
  <div class="pagewrap">
    <div class="dv-dicvu-home-cont flex">
      <div class="dv-dv-home">
        <h2><?=$glo_lang['dich_vu'] ?></h2>
        <p><?=$glo_lang['dich_vu_mo_ta'] ?></p>
      </div>
      <?php foreach ($baiviet_nd as $rows) {?>
      <div class="dv-dv-home">
        <a <?=full_href($rows) ?>>
          <?=full_img($rows, 'thumbnew_') ?>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        </a>
      </div>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>

<?php
  $banner_top = LAY_banner_new("`id_parent` = 32", 4);
  if(count($banner_top)){
?>
<div class="dv-business-home">
  <div class="pagewrap">
    <div class="dv-business-home-cont">
      <?php
        foreach ($banner_top as $r) {
      ?>
      <li>
        <?php if($r['seo_name'] != ""){ ?><a <?=full_href($r) ?>><?php } ?>
          <img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt="">
        <?php if($r['seo_name'] != ""){ ?></a><?php } ?>
      </li>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet    = LAY_baiviet(3, 18,"`opt1` = 1 ");
  // $sp_step       = LAY_step(3, 1);
  if(count($sp_baiviet)) {
?>
<div class="dv-tintuc-home">
  <div class="pagewrap">
    <div class="dv-tintuc-home-cont">
      <h3 class="title">
        <?=$glo_lang['tin_tuc_su_kien'] ?>
      </h3>
      <div class="dv-tintuc-home-cont-slider">
      <!--  -->
      <?php $data = array("1","2","2","3","4","4") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
        ?>
        <div class="item">
          <div class="dv-new-home">
            <ul>
              <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows, "thumbnew_") ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></li>
              <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
              <p><span class="lm_3"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
              <h5><a <?=full_href($rows) ?>><?=$glo_lang['xem_them'] ?></a></h5>
              <div class="clr"></div>
            </ul>
          </div>
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
