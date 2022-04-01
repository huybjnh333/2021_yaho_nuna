<?php
  $banner_top = LAY_banner_new("`id_parent` = 29");
  if(count($banner_top)) {
?>
<div class="box_doitac_home">
  <div class="pagewrap">
    <div class="title_id"><?=$glo_lang['doi_tac_khach_hang'] ?></div>
    <div class="logo_doitac">
      <!--  -->
      <?php $data = array("2","3","4","5","6","6") ?>
        <div class="owl-auto-foot owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
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
<script type="text/javascript">
  $(document).ready(function() {
    $(".owl-auto-foot").each(function(){
      var is_slidespeed = $(this).attr("is_slidespeed");
      var is_navigation = $(this).attr("is_navigation") == 1 ? true : false;
      var is_dots       = $(this).attr("is_dots") == 1 ? true : false;
      var is_autoplay   = $(this).attr("is_autoplay") == 1 ? true : false;
      var is_items_0    = $(this).attr("data0");
      var is_items_1    = $(this).attr("data1");
      var is_items_2    = $(this).attr("data2");
      var is_items_3    = $(this).attr("data3");
      var is_items_4    = $(this).attr("data4");
      var is_items_5    = $(this).attr("data5");
      $(this).owlCarousel({
        slideSpeed : is_slidespeed,
        navigation : is_navigation,
        itemsCustom : [
          [0, is_items_0],
          [319, is_items_1],
          [479, is_items_2],
          [767, is_items_3],
          [991, is_items_4],
          [1199, is_items_5]
          ],
        dots: is_dots,
        autoPlay: is_autoplay,
        navigationText : ["‹","›"]
      });
    });
});
</script>
<?php } ?>
<div class="footer_top">
  <div class="pagewrap">
    <div class="flex">
    <ul class="contact_footer">
      <?php
        $noidung    = LAYTEXT_rieng(78);
      ?>
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div class="n-foot">
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
      </div>
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
    <ul class="face_bottom">
      <div class="fb-page" data-href="<?=$glo_lang['fanpage'] ?>" data-tabs="timeline" data-width="240" data-height="270" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="<?=$glo_lang['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?=$glo_lang['fanpage'] ?>"><?=$thongtin['tenbaiviet_vi'] ?></a></blockquote>
      </div>
      <div class="link_share">
        <?php
          $mangxahoi = SHOW_mxh();
          foreach ($mangxahoi as $rows) {

        ?>
        <span class="clor_1" style="<?=$rows['background'] != '' ?  'background: '.$rows['background'] : '' ?>"><a target="_blank" <?=full_href($rows) ?>><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>" alt=""></a></span>
        <?php } ?>
      </div>
    </ul>
    <div class="clr"></div>
    </div>
  </div>
</div>
<div class="bottom_id_copyright">
  <div class="pagewrap">
    <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
    <p><?=$glo_lang['dang_online'] ?>: <?=NUMBER_fomat($online_tv) ?> | <?=$glo_lang['tong_view'] ?>: <?=NUMBER_fomat($thongke_tv) ?></p>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<?php include _source."hotline.php"; ?>
<?php include _source."check_view.php"; ?>
<?php include _source."check_yeu_thich.php"; ?>
<?php include _source."check_sosanh.php"; ?>