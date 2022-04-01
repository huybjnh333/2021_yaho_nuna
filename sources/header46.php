<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 26", 1);
?>
<div class="header" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
<div class="logo_top">
<li><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></li>
<ul>
<h1 class="tlt"><?=$glo_lang['slugan_1'] ?></h1>
<h2 class="tlt2"><?=$glo_lang['slugan_2'] ?>
</h2>
</ul>
<div class="clr"></div>
</div>
<div class="clr"></div>

</div>
<div class="box_menu">
  <?php include _source."menu_top.php"; ?>
  <div class="right_header">
  <div class="timkiem_top no_box">
      <div class="search">
          <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
          <input class="input_search input_search_enter fla_ff" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
      </div>
  </div>
  <?php include _source."lang.php"; ?>
  <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>