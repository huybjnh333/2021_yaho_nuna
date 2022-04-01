<div class="header">
  <div class="pagewrap">
    <div class="logo"><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt=""></a></div>
    <div class="right_header">
      <div class="timkiem_top no_box">
          <div class="search">
              <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
              <input class="input_search input_search_enter input_keyword" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
          </div>
      </div>
      <?php include _source."lang.php"; ?>
      <div class="giohang_top"> <a href="<?=$full_url."/gio-hang/" ?>"><i class="fa fa-cart-plus" ></i>
        <h3><b><?=$glo_lang['gio_hang'] ?></b><span class="is_num_cart"><?=!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span></h3>
        </a> 
      </div>
      
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="box_header_id">
  <div class="pagewrap">
    <?php include _source.'menu-child.php'; ?>
    <?php include _source."menu_top.php"; ?>
    <div class="clr"></div>
  </div>
</div>
