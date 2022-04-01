<div class="header">
  <div class="pagewrap">
    <div class="logo"><a href="<?=$full_url ?>"><?=$glo_lang['slugan_1'] ?></a></div>
    <div class="right_header">
      <div class="timkiem_top no_box">
          <div class="search">
              <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
              <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
          </div>
      </div>
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
      <div class="giohang_top"> <a href="<?=$full_url."/gio-hang/" ?>"><i class="fa fa-cart-plus"></i>
        <h3><?=$glo_lang['gio_hang'] ?><span class="is_num_cart"><?=!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span></h3>
        </a> </div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="box_header_id">
  <div class="pagewrap">
    <?php include _source.'menu-child.php'; ?>
    <?php include _source."menu_top.php"; ?>
    <?php include _source."lang.php"; ?>
    <div class="clr"></div>
  </div>
</div>