<?php
  $glo_get_qc = DB_fet("*","#_thuoctinhchung","","", "","arr", 1);
?>
<div class="box_menu_f">
  <div class="box-menu-1">
    <div class="l-header">
      <div>
        <div class="logo_top"><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></div>
        <div class="right_header">
          <div class="dv-quang-cao-gg dv-quang-cao-gg-1">
            <?=@$glo_get_qc[1]['ma_quang_cao'] ?>
          </div>
        	<div class="clr"></div>
        </div>
      <div class="clr"></div>
      </div>
    </div>
    <div class="box_menu">
      <div>
        <?php include _source."menu_top.php"; ?>
        <?php include _source."lang.php"; ?>
      <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="clr"></div>
</div>
