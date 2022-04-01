<?php include _source."banner_top.php";?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 26", 3);
  if(count($banner_top)){
?>
<div class="box_home_2">
  <div class="pagewrap">
  <div class="video_l_home">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=GET_ID_youtube($banner_top[0]['seo_name']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="banner_r_home">
    <ul>
      <?php
        $i = 0;
        foreach ($banner_top as $rows) {
          $i++;
          if($i == 1) continue;
      ?>
      <li><a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="clr"></div>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(2, 30, "`opt` = 1");
  $sp_step      = LAY_step(2, 1);
  if(count($sp_baiviet)){
?>
<div class="box_home_2">
  <div class="pagewrap">
    <div class="menu_home_id">
      <h3><?=$glo_lang['san_pham_khuyen_mai'] ?></h3>
      <ul>
        <li><a <?=full_href($sp_step) ?>><i class="fa fa-angle-double-right"></i><?=$glo_lang['xem_tat_ca'] ?></a></li>
        <div class="clr"></div>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pro_home_id pro_home_id_slider no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","5") ?>
        <div class="owl-auto-2 owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
        ?>
        <div class="item">
          <?php include _source."home_temp.php"; ?>
        </div>
        <?php } ?>
        </div>
      </div>
      <div class="clr"></div>
      <!--  -->
      <script type="text/javascript">
        $(document).ready(function() {
          $(".owl-auto-2").each(function(){
            var is_slidespeed = $(this).attr("is_slidespeed");
            var is_navigation = $(this).attr("is_navigation") == 1 ? true : false;
            var is_dots       = $(this).attr("is_dots") == 1 ? true : false;
            var is_autoplay   = $(this).attr("is_autoplay") == 1 ? true : false;
            var is_items_0    = $(this).attr("data0");
            var is_items_1    = $(this).attr("data1");
            var is_items_2    = $(this).attr("data2");
            var is_items_3    = $(this).attr("data3");
            var is_items_4    = $(this).attr("data4");
            var is_items_5    = $(this).attr("data5");
            $(this).owlCarousel({
              slideSpeed : is_slidespeed,
              navigation : is_navigation,
              itemsCustom : [
                [0, is_items_0],
                [319, is_items_1],
                [479, is_items_2],
                [767, is_items_3],
                [991, is_items_4],
                [1199, is_items_5]
                ],
              dots: is_dots,
              autoPlay: is_autoplay,
              navigationText : ["‹","›"]
            });
          });
      });
      </script>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $step = 2;
  $danhmuc = LAY_danhmuc($step, 0, "`opt` = 1  ");
  foreach ($danhmuc as $dm) {
    if($dm['id_parent'] != 0) continue;
    // $sp_dm_ch    = LAY_danhmuc($step, 0, "`id_parent` = '".$dm['id']."' AND `opt` = 1");
    $lay_all_kx  = LAYDANHSACH_idkietxuat($dm['id'], $dm['step']);
    $sp_baiviet  = LAY_baiviet($step, 8, "`id_parent` IN (".$lay_all_kx.")", "`opt1` DESC, `catasort` DESC");
?>
<div class="box_home_2">
  <div class="pagewrap">
    <div class="menu_home_id">
      <h3><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?></h3>
      <ul>
        <?php
          // if(count($sp_dm_ch)){
            foreach ($danhmuc as $dmc) {
              if($dmc['id_parent'] != $dm['id']) continue;
        ?>
        <li><a <?=full_href($dmc) ?> ><?=SHOW_text($dmc['tenbaiviet_'.$lang]) ?></a></li>
        <?php }//} ?>
        <div class="clr"></div>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pro_home_id flex">
      <div class="banner_home_id">
        <a <?=full_href($dm) ?>><?=full_img($dm,'') ?></a>
      </div>
      <?php
        foreach ($sp_baiviet as $rows) {
          $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
          include _source."home_temp.php";
        }
      ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 32", 1);
?>
<div class="newsletter_home " style="background: url(<?=full_src($hinhanh, '') ?>) center no-repeat fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
  <div class="pagewrap">
    <h3><?=$glo_lang['dang_ky_nhan_ban_tin'] ?></h3>
    <p><?=$glo_lang['test_dang_ky_nhan_ban_tin'] ?></p>
    <ul class="no_box">
      <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" enctype="multipart/form-data">
        <div class="col-md-7 row-frm">
          <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control" placeholder="<?=$glo_lang['ho_va_ten'] ?>">
        </div>
        <div class="col-md-7 row-frm" >
          <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control" placeholder="<?=$glo_lang['so_dien_thoai'] ?>">
        </div>
        <div class="col-md-7 row-frm">
          <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control" placeholder="<?=$glo_lang['email'] ?> *">
        </div>
        <h2><a onclick="DANGKY_email('<?=$full_url ?>')" class="cur"><?=$glo_lang['dang_ky'] ?> <img src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a></h2>
        <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
        <div class="clr"></div>
      </form>
    </ul>
  </div>
</div>
<?php 
  // $step = LAY_step(4, 1);
  $sp_baiviet = LAY_baiviet(4, 12, "`opt1` = 1");
  if(count($sp_baiviet)){
?>
<div class="tintuc_box_home">
  <div class="pagewrap">
    <div class="titBox left">
      <div class="tit"><?=$glo_lang['tin_tuc_su_kien'] ?></div>
      <div class="sub_2"><?=$glo_lang['tin_tuc_su_kien_mo_ta'] ?></div>
    </div>
    <!--  -->
    <div class="tintuc_box_home_child  no_box">
      <?php
        $i              = 0;
        $nd_right       = "";
        $nd_left        = "";
        foreach ($sp_baiviet as $rows) {
          $i++;
          if($i < 3){
            $nd_left   .= '<ul>
                            <li><a '.full_href($rows).'>'.full_img($rows).'</a></li>
                            <h3><a '.full_href($rows).'>'.SHOW_text($rows['tenbaiviet_'.$lang]).'</a></h3>
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i>'.date("d/m/Y", $rows['ngaydang']).'</h4>
                            <p><span class="lm_4">'.SHOW_text(strip_tags($rows['mota_'.$lang])).'</span></p>
                          </ul>';
        }
        else{
            $nd_right .= '<ul>
            <li><a '.full_href($rows).'><img src="'.full_src($rows).'" alt=""></a></li>
            <h3><a '.full_href($rows).'>'.SHOW_text($rows['tenbaiviet_'.$lang]).'</a> <span><i class="fa fa-calendar" aria-hidden="true"></i>'.date("d/m/Y", $rows['ngaydang']).'</span> </h3>
            <div class="clr"></div>
          </ul>
                        ';

          }
        }
        echo '<div class="left_tt_home flex">'.$nd_left.'</div>';
        echo '<div class="right_tt_home"><div class="marquee">'.$nd_right.'</div></div>';
      ?>

      <div class="clr"></div>
    </div>
    <script>
      $(window).on('load', function() {
        $(".marquee").height($(".left_tt_home").height() - 30 );
      });
      $(window).scroll(function(){
        $(".marquee").height($(".left_tt_home").height() - 30 );
      });
      $('.marquee').marquee({
          duration: 19000,
          gap: 100,
          delayBeforeStart: 0,
          direction: 'up',
          duplicated: true,
          pauseOnHover:true,
          startVisible: true
      });
    </script>
    <div class="clr"></div>
    <!--  -->
  </div>
  <div class="clr"></div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 29");
  if(count($banner_top)) {
?>
<div class="doitac_home">
  <div class="pagewrap">
    <div class="title_id"><?=$glo_lang['doi_tac_khach_hang'] ?></div>
    <div class="logo_doitac logo_doitac_slider no_box">
      <!--  -->
      <?php $data = array("2","3","4","5","6","7") ?>
        <div class="owl-auto-2 owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          // $i = 0;
          foreach ($banner_top as $rows) { 
            // $i++;
            // if($i == 1) echo '<div class="item">';
        ?>
        <div class="item">
          <ul>
            <a <?=full_href($rows) ?>>
              <li class="logo_thuonghieu"><img src="<?=full_src($rows, '') ?>"></li>
            </a>
          </ul>
        </div>
        <?php } // if($i == 2) { echo '</div>'; $i = 0;} } if($i == 1)  echo '</div>'; ?>

      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>