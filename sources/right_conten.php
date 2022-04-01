<?php
    $name_title = $glo_lang['san_pham'];
    $id_parent = 0;
    $danhmuc = LAY_danhmuc(2,"","`id_parent` = '$id_parent'");
    if(!empty($slug_step) && $slug_step == 2){
      if(!empty($slug_table) && $slug_table != "baiviet" ){

        $name_title = $arr_running['tenbaiviet_'.$lang];
        $id_parent = $arr_running['id'];
        $danhmuc = LAY_danhmuc($slug_step,"","`id_parent` = '$id_parent'");
        if(!count(@$danhmuc)) {
          $name_title = $glo_lang['san_pham'];
          $id_parent = 0;
          $danhmuc   = LAY_danhmuc($slug_step,"","`id_parent` = '$id_parent'");
        }
      }
    }
  ?>
<div class="left-danhmuc">
  <div class="bh-right-ad">
      <div class="box_right_pro_view">
      <div class="title_right_pro_view"><?=$name_title ?></div>
      <ul>
        <?php foreach ($danhmuc as $rows) { ?>
        <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
  <div class="multiple-items">
    <?php
      $banner_top = LAY_banner_new("`id_parent` = 26");
      foreach ($banner_top as $rows) {
        // $oclick = "";
        // if($rows['seo_name'] != "") {
        //   $oclick = " onclick='window.location.href=\".".GET_link($full_url, $rows['seo_name']).".\"'";
        // }
    ?>
    <div class="img-qc"><a <?=full_href($rows) ?>><img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>" alr="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></div>
    <?php } ?>
  </div>
  <div class="bh-right-ad">
      <div class="box_right_pro_view pro_view_sp">
      <div class="title_right_pro_view"><?=$glo_lang['tin_nong'] ?></div>
  <div class="new_right">
    <?php
      $baiviet = LAY_baiviet(4, 8);
      $step = LAY_step(4, 1);
      foreach ($baiviet as $rows) {
    ?>
<ul>
  <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></li>
  <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
  <div class="clr"></div>
</ul>
<?php } ?>
<div class="clr"></div>
</div>
      <div class="clear"></div>
      <p><a <?=full_href($step) ?>><?=$glo_lang['xem_tat_ca'] ?> »</a></p>
    </div>
    <div class="clear"></div>
  </div>
</div>