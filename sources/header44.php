<div class="header_top">
  <div class="pagewrap">
    <div class="company_time">
      <ul>
        <li><i class="fa fa-phone-square"></i><b><?=$glo_lang['hotline'] ?>: </b><span><?php
                      $hotline_vi = explode("|", $thongtin['hotline_vi']);
                  $i = 0;
                  foreach ($hotline_vi as $val) {
                    $i++;
                    if($i > 1) echo ' - ';
                    echo '<a href="tel:'.$val.'">'.$val.'</a>';
                  }
                ?></span></li>
        <li class="li_em">
          <i class="fa fa-envelope-o"></i>
          <?php 
              $email_vi = explode("|", $thongtin['email_vi']);
              $i = 0;
              foreach ($email_vi as $val) {
                $i++;
                if($i > 1) echo ' - ';
                echo '<a href="mailto:'.$val.'">'.$val.'</a>';
              }
            ?>
        </li>

        <li class="l_rr l_rr_1"><a href="<?=$full_url."/danh-sach-so-sanh" ?>"><i class="fa fa-retweet" ></i><?=$glo_lang['danh_sach_so_sanh'] ?></a></li>
        <?php if(!isset($_SESSION['id']) || $_SESSION['id'] == NULL){ ?>
        <li class="l_rr">
          <a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/dang-ky/" ?>', '400px')" class='cur'>
            <i class="fa fa-user-circle-o"></i><?=$glo_lang['dang_ky'] ?></a>
        </li>
        <li class="l_rr">
          <a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/dang-nhap/" ?>', '400px')" class='cur'>
            <i class="fa fa-user-plus"></i><?=$glo_lang['dang_nhap'] ?></a>
        </li>
        <?php }else{ ?>
        <li class="l_rr"><a href="<?=$full_url."/thoat" ?>" class='cur'><i class="fa fa-sign-out"></i><?=$glo_lang['thoat'] ?></a></li>
        <li class="l_rr"><a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/tai-khoan/" ?>', '400px')" class='cur'><i class="fa fa-user-circle-o"></i><?=$glo_lang['tai_khoan'] ?></a></li>
        <?php } ?>
        <li class="l_rr l_rr_1"><a href="<?=$full_url."/kiem-tra-don-hang" ?>"><i class="fa fa-history"></i><?=$glo_lang['kiem_tra_don_hang'] ?></a></li>
        <div class="clr"></div>
      </ul>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="header">
  <div class="pagewrap">
    <div class="logo_top">
      <ul>
        <li><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></li>
      </ul>
    </div>
    <div class="right_top_id">
      <ul>
        <h3><a href="<?=$full_url."/khuyen-mai" ?>"><i class="fa fa-sign-language" ></i><?=$glo_lang['khuyen_mai'] ?></a></h3>
        <h3><a href="<?=$full_url."/gio-hang" ?>"><i class="fa fa-shopping-basket"></i><?=$glo_lang['gio_hang'] ?>: <span class="is_num_cart"><?=!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span><?=$glo_lang['sp'] ?></a></h3>
      </ul>
    </div>
    <div class="timkiem_top no_box">
        <div class="search">
            <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
            <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
        </div>
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="box_menu">
  <div class="pagewrap">
    <?php include _source."menu_top.php"; ?>
    <?php include _source."lang.php"; ?>
    
    <div class="clr"></div>
  </div>
</div>
<div class="dv-popup-new no_box">
  <div class="dv-popup-new-child">
    <a class="popup-close"></a>
    <div class="dv-nd-popup"></div>
  </div>
</div>