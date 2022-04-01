<?php include _source."banner_top.php";?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 26");
  if(count($banner_top)) {
?>
<div class="banner_add_home">
  <ul class="flex">
    <?php 
      foreach ($banner_top as $rows) { 
    ?>
    <li><a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a></li>
    <?php } ?>
    <div class="clr"></div>
  </ul>
</div>
<?php } ?>
<div class="pagewrap">
  <?php
    $banner_top = LAY_banner_new("`id_parent` = 32");
    if(count($banner_top)) {
  ?>
  <div class="box_pro_1">
    <div class="banner_home flex">
      <?php 
        foreach ($banner_top as $rows) { 
      ?>
      <ul>
        <li><a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a></li>
        <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        <p><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></p>
        <h4><a <?=full_href($rows) ?>><?=$glo_lang['shop_now'] ?></a></h4>
      </ul>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
  <?php } ?>
  <?php
    $sp_baiviet   = LAY_baiviet(2, 30, "`opt2` = 1");
    $sp_step      = LAY_step(2, 1);
    if(count($sp_baiviet)){
  ?>
  <div class="box_pro_1">
    <div class="titile_page">
      <h3><?=$glo_lang['san_pham_moi'] ?></h3>
    </div>
    <div class="pro_home_id pro_home_id_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","5") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
        ?>
        <div class="item">
          <?php include _source."home_temp.php"; ?>
        </div>
        <?php } ?>
        </div>
      <div class="clr"></div>
      <!--  -->
    </div>
    <div class="view_more"><a href="<?=$full_url."/".$sp_step['seo_name']."/?p=1"  ?>"><?=$glo_lang['xem_tat_ca'] ?></a></div>
  </div>
  <?php } ?>
  <?php
    $rows = LAY_banner_new("`id_parent` = 31", 1);
    if(is_array($rows)) {
  ?>
  <div class="gt_sp_home">
    <div class="gt_sp_home_colum1"> <?=full_img($rows, '') ?></div>
    <div class="right_with">
      <div class="gt_sp_home_colum2">
        <ul>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
          <p><?=SHOW_text($rows['mota_'.$lang]) ?></p>
          <h4><a <?=full_href($rows) ?>><?=$glo_lang['shop_now'] ?></a></h4>
          <div class="clr"></div>
        </ul>
      </div>
      <div class="pro_home_id flex no_box">
      <?php
        $sp_baiviet   = LAY_baiviet(2, 3, "", "RAND()");
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
            include _source."home_temp.php";
          }
      ?>
        <div class="clr"></div>
      </div>
    </div>
    <div class="clr"></div>
  </div>
  <?php } ?>
  <?php
    $sp_baiviet   = LAY_baiviet(2, 30, "`opt1` = 1");
    $sp_step      = LAY_step(2, 1);
    if(count($sp_baiviet)){
  ?>
  <div class="box_pro_1">
    <div class="titile_page">
      <h3><?=$glo_lang['san_pham_ban_chay'] ?></h3>
    </div>
    <div class="pro_home_id pro_home_id_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","5") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
        ?>
        <div class="item">
          <?php include _source."home_temp.php"; ?>
        </div>
        <?php } ?>
        </div>
      <div class="clr"></div>
      <!--  -->
    </div>
    <div class="view_more"><a href="<?=$full_url."/".$sp_step['seo_name']."/?p=2"  ?>"><?=$glo_lang['xem_tat_ca'] ?></a></div>
  </div>
  <?php } ?>
  <?php
    $sp_baiviet   = LAY_baiviet(2, 30, "`opt` = 1");
    $sp_step      = LAY_step(2, 1);
    if(count($sp_baiviet)){
  ?>
  <div class="box_pro_1">
    <div class="titile_page">
      <h3><?=$glo_lang['san_pham_khuyen_mai'] ?></h3>
    </div>
    <div class="pro_home_id pro_home_id_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","5") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
        ?>
        <div class="item">
          <?php include _source."home_temp.php"; ?>
        </div>
        <?php } ?>
        </div>
      <div class="clr"></div>
      <!--  -->
    </div>
    <div class="view_more"><a href="<?=$full_url."/".$sp_step['seo_name']."/?p=3"  ?>"><?=$glo_lang['xem_tat_ca'] ?></a></div>
  </div>
  <?php } ?>
</div>
<?php 
  // $step = LAY_step(4, 1);
  $sp_baiviet = LAY_baiviet(3, 12, "`opt` = 1");
  if(count($sp_baiviet)){
?>
<div class="tintuc_box_home">
  <div class="pagewrap">
    <div class="titile_page">
      <h3><?=$glo_lang['tin_tuc_su_kien'] ?></h3>
    </div>
    <!--  -->
    <div class="tintuc_box_home_child  no_box">
      <?php
        $i              = 0;
        $nd_right       = "";
        $nd_left        = "";
        foreach ($sp_baiviet as $rows) {
          $i++;
          if($i < 3){
            $nd_left   .= '<ul>
                            <li><a '.full_href($rows).'>'.full_img($rows).'</a></li>
                            <h3><a '.full_href($rows).'>'.SHOW_text($rows['tenbaiviet_'.$lang]).'</a></h3>
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i>'.date("d/m/Y", $rows['ngaydang']).'</h4>
                            <p><span class="lm_4">'.SHOW_text(strip_tags($rows['mota_'.$lang])).'</span></p>
                          </ul>';
        }
        else{
            $nd_right .= '<ul>
            <li><a '.full_href($rows).'><img src="'.full_src($rows).'" alt=""></a></li>
            <h3><a '.full_href($rows).'>'.SHOW_text($rows['tenbaiviet_'.$lang]).'</a> <span><i class="fa fa-calendar" aria-hidden="true"></i>'.date("d/m/Y", $rows['ngaydang']).'</span> </h3>
            <div class="clr"></div>
          </ul>
                        ';

          }
        }
        echo '<div class="left_tt_home flex">'.$nd_left.'</div>';
        echo '<div class="right_tt_home"><div class="marquee">'.$nd_right.'</div></div>';
      ?>

      <div class="clr"></div>
    </div>
    <script>
      $(window).on('load', function() {
        $(".marquee").height($(".left_tt_home").height() - 30 );
      });
      $(window).scroll(function(){
        $(".marquee").height($(".left_tt_home").height() - 30 );
      });
      $('.marquee').marquee({
          duration: 35000,
          gap: 100,
          delayBeforeStart: 0,
          direction: 'up',
          duplicated: true,
          pauseOnHover:true,
          startVisible: true
      });
    </script>
    <div class="clr"></div>
    <!--  -->
  </div>
  <div class="clr"></div>
</div>
<?php } ?>