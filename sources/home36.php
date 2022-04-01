<div class="pagewrap">
  <?php include _source."banner_top.php";?>
  <?php
    $banner_top = LAY_banner_new("`id_parent` = 26");
    if(count($banner_top)){
  ?>
  <div class="services_home flex">
    <?php
      foreach ($banner_top as $rows) {
    ?>
    <ul>
      <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
      <li><a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a></li>
      <p><?=SHOW_text($rows['mota_'.$lang]) ?><span><a <?=full_href($rows) ?>><?=$glo_lang['xem_chi_tiet'] ?></a></span></p>
    </ul>
    <?php } ?>

    <div class="clr"></div>
  </div>
  <?php } ?>
  <?php
    $sp_baiviet    = LAY_baiviet(2, 50,"`opt` = 1 ");
    if(count($sp_baiviet)) {
  ?>
  <div class="box_pro">
    <div class="titile_home"><?=$glo_lang['san_pham_moi'] ?></div>
    <div class="pro_id pro_id_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","5") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
        ?>
        <div class="item">
          <ul>
            <a <?=full_href($rows) ?>>
              <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
              <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
              <h4><?=$gia['text_gia'].$gia['text_km'] ?></h4>
              <?php if($rows['p1'] != ""){ ?>
                <p><?=$glo_lang['cart_ma_sp'] ?>: <?=$rows['p1'] ?></p>
              <?php } ?>
            </a>
          </ul>
        </div>
        <?php } ?>

      </div>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
  <?php } ?>
</div>
