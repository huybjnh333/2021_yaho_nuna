<div class="header no_box">
  <div class="logo_top">
    <ul>
      <li><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></li>
      <h3><?=$glo_lang['slugan_1'] ?><span><?=$glo_lang['slugan_2'] ?></span></h3>
      <div class="clr"></div>
    </ul>
  </div>
  <!--  -->
  <?php
    $r = LAY_banner_new("`id_parent` = 32", 1);
    if(is_array($r)){
  ?>
  <div class="right_header"> <a  <?=full_href($r) ?>><img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt="<?=SHOW_text($r['tenbaiviet_'.$lang]) ?>"></a> </div>
  <?php } ?>
  <div class="clr"></div>
  <!--  -->
  <div class="clr"></div>
</div>
<div class="box_menu">
  <?php include _source."menu_top.php"; ?>
  <?php include _source."lang.php"; ?>
  <div class="clr"></div>
</div>
