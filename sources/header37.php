<div class="dv-cont-header">
  <div class="top_header">
    <div class="pagewrap">
      <div class="dv-welcome"><?=$glo_lang['welcome'] ?></div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="dv-banner">
    <div class="pagewrap">
      <div class="logo_top"><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></div>
      <div class="right_header">
        <!--  -->
        <?php
          $banner_top = LAY_banner_new("`id_parent` = 28", 3);
          $i = 0;
          foreach ($banner_top as $r) {
            $i++;
        ?>
        <li class="li_<?=$i ?>">
          <img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt="<?=SHOW_text($r['tenbaiviet_'.$lang]) ?>">
          <div class="rra">
            <p><?=SHOW_text($r['tenbaiviet_'.$lang]) ?></p>
            <a <?=full_href($r) ?>><?=SHOW_text($r['mota_'.$lang]) ?></a>
          </div>
        </li>
        <?php } ?>
        <div class="clr"></div>
        <!--  -->
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="box_menu">
    <div class="pagewrap">
      <?php include _source."menu_top.php"; ?>
      <div class="clr"></div>
    </div>
  </div>
  <div class="clr"></div>
</div>