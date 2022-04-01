<?php if(empty($_COOKIE['delete_popup_child'])){ ?>
<div class="fix_header no_box dv-bannder-top-header">
  <div class="pageerap">
    <ul>
      <?php
      $banner_top = LAY_banner_new("`id_parent` = 28");
      foreach ($banner_top as $rows) {
    ?>
    <h3>
      <?php if($rows['seo_name'] != "") echo '<a '.full_href($rows).'>'; ?>
      <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
      <?php if($rows['seo_name'] != "") echo '</a>'; ?>
    </h3>
    <?php } ?>
      <li><a class="cur" onclick="XOA_popup_child()">X</a></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<?php } ?>
<div class="dv-header_top">
  <div class="header_top">
    <div class="pagewrap">
      <div class="logo_header"><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></div>
      <div class="timkiem_top no_box">
          <div class="search">
              <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
              <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
          </div>
      </div>
      
      <div class="right_header">
        <ul>
          <li>
            <a class="cur"><i class="fa fa-user-o"></i></a>
            <ul class="list-usser">
              <?php if(!isset($_SESSION['id']) || $_SESSION['id'] == NULL){ ?>
              <li>
                <a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/dang-nhap/" ?>', '400px')" class='cur'>
                  <?=$glo_lang['dang_nhap'] ?></a>
              </li>
              <li>
                <a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/dang-ky/" ?>', '400px')" class='cur'>
                  <?=$glo_lang['dang_ky'] ?></a>
              </li>
              <?php }else{ ?>
              <li><a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/tai-khoan/" ?>', '400px')" class='cur'><?=$glo_lang['tai_khoan'] ?></a></li>
              <li><a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/doi-mat-khau/" ?>', '400px')" class='cur'><?=$glo_lang['thay_doi_mat_khau'] ?></a></li>
              <li><a href="<?=$full_url."/lich-su-mua-hang" ?>"><?=$glo_lang['lich_su_mua_hang'] ?></a></li>
              <!-- <li><a href="<?=$full_url."/yeu-thich/" ?>"><?=$glo_lang['yeu_thich'] ?></a></li> -->

              <li><a href="<?=$full_url."/thoat" ?>" class='cur'><?=$glo_lang['thoat'] ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <li>
            <a href="<?=$full_url.'/yeu-thich' ?>"><i class="fa fa-heart-o"></i></a>
          </li>
          <li><a href="<?=$full_url."/gio-hang" ?>"><i class="fa fa-shopping-bag"></i><span class="is_num_cart"><?=!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span></a></li>
          <?php include _source."lang.php"; ?>
          <div class="clr"></div>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="box_menu">
    <div class="pagewrap">
      <div class="menuMain">
        <?php include _source."menu_top.php"; ?>
      </div>
      <div class="clr"></div>
    </div>
  </div>
</div>
<div class="dv-popup-new no_box">
  <div class="dv-popup-new-child">
    <a class="popup-close"></a>
    <div class="dv-nd-popup"></div>
  </div>
</div>