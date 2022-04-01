<div class="box_banner_home">
  <div class="multiple-items">
    <?php
      $banner_top = LAY_banner_new("`id_parent` = 16");
      foreach ($banner_top as $rows) {
        // $oclick = "";
        // if($rows['seo_name'] != "") {
        //   $oclick = " onclick='window.location.href=\".".GET_link($full_url, $rows['seo_name']).".\"'";
        // }
    ?>
    <div>
      <img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>" alr="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>">
        <div class="ab-slogan-h wow pulse"><h2><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
        <h4><?=SHOW_text($rows['mota_'.$lang]) ?></h4>
        <p><a <?=full_href($rows) ?>><?=$glo_lang['xem_chi_tiet'] ?> »</a></p>
        </div>
    </div>
    <?php } ?>

  </div>
</div>