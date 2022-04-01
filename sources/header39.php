<div class="header">
  <div class="pagewrap">
    <div class="right_header">
      <div class="lang_top">
        <ul>
          <?php
            $step = LAY_step("4,5,6,7,8");
            foreach ($step as $rows) {
          ?>
          <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
          <?php } ?>
        </ul>
        <div class="clr"></div>
      </div>
      <div class="timkiem_top no_box">
          <div class="search">
              <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
              <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
          </div>
      </div>
      <div class="clr"></div>
    </div>
    <div class="logo_top"><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></div>
    <div class="left_header">
      <?php include _source."lang.php"; ?>
      <div class="hotline_header">
        <ul>
          <li><i class="fa fa-volume-control-phone"></i></li>
          <h3><?=$glo_lang['hotline'] ?>: <?php 
                      $hotline_vi = explode("|", $thongtin['hotline_vi']);
                  $i = 0;
                  foreach ($hotline_vi as $val) {
                    $i++;
                    if($i > 1) echo ' - ';
                    echo '<a href="tel:'.$val.'">'.$val.'</a>';
                  }
                ?><span><?=$glo_lang['hotline_247'] ?></span></h3>
          <div class="clr"></div>
        </ul>
        <div class="clr"></div>
      </div>
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
