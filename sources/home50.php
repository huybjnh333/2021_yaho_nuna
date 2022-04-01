<?php include _source."banner_top.php";?>
<?php
      $rows = LAY_banner_new("`id_parent` = 28", 1);
      if(is_array($rows)){
    ?>
<div class="home-1-ad">
  <div class="triangle--left-top"></div>
  <img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/>
  <div class="triangle--right-top"></div>
  <div class="clr"></div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 27", 3);
  if(is_array($banner_top)){
?>
<section class="awe-section-2">	
	<section id="ve-chung-toi" class="section section_about clearfix">
  	<div class="container">
  		<div class="title_module_main clearfix">
  			<h2 class="h2">
  				<?=$glo_lang['ve_chung_toi'] ?>
  			</h2>
  		</div>
  		<div class="row">
  			<?php
            foreach ($banner_top as $rows) {
          ?>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 col-about">
            <div class="content-about wow bounceInLeft clearfix">
              <div class="about-top clearfix">
                <?=full_img($rows, '') ?>
              </div>
              <div class="about-bottom clearfix">
                <h3 class="title-about">
                  <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
                </h3>
                <div class="about-sumary clearfix">
                  <?=SHOW_text(strip_tags($rows['noidung_'.$lang])) ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
  		</div>
  	</div>
  </section>
</section>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 33", 8);
  if(is_array($banner_top)){
?>
<div class="box_sp_2">
  <div class="pagewrap">
  <div class="title_page">
      <ul>
        <h3><?=$glo_lang['danh_muc_san_pham'] ?></h3>
        <p><?=$glo_lang['danh_muc_san_pham_mo_ta'] ?></p>
      </ul>
    </div>
    <div class="pro_id tintuc_home_id_slider no_box">
      <!--  -->
      <?php $data = array("1","2","2","3","4","4") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($banner_top as $rows) {
        ?>
        <div class="item">
          <ul>
            <a <?=full_href($rows) ?>>
            <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>" />
            <span class="overlay overlay-bottom"></span>
            </li>
            <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
            </a>
          </ul>
        </div>
        <?php } ?>

        </div>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<?php } ?>
<div class="box_home_2">
  <div class="pagewrap">
    <ul class="no_box">
      <h3><?=$glo_lang['dang_ky_nhan_ban_tin'] ?></h3>
      <p><?=$glo_lang['test_dang_ky_nhan_ban_tin'] ?></p>

      <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" enctype="multipart/form-data">
        <div class="col-md row-frm">
          <input type="text" name="ip_sentmail_name" id="ip_sentmail_name" class="form-control" placeholder="<?=$glo_lang['ho_va_ten'] ?>">
        </div>
        <div class="col-md row-frm" >
          <input type="text" name="ip_sentmail_phone" id="ip_sentmail_phone" class="form-control" placeholder="<?=$glo_lang['so_dien_thoai'] ?>">
        </div>
        <div class="col-md row-frm">
          <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control" placeholder="<?=$glo_lang['email'] ?> *">
        </div>
        <h4><a onclick="DANGKY_email('<?=$full_url ?>')" class="cur"><?=$glo_lang['dang_ky_ngay'] ?> <img src="images/loading2.gif" class="ajax_img_loading ajax_img_loading_mail"></a></h4>
        <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
        <div class="clr"></div>
      </form>
    </ul>
  </div>
</div>
<?php
  $noidung= LAYTEXT_rieng(78);
  if(is_array($noidung)){
?>
<div class="box_auout_home">
  <div class="pagewrap">
    <div class="title_page">
      <ul>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
            <p><?=SHOW_text($noidung['p1_'.$lang]) ?></p>
      </ul>
    </div>
    <div class="auout_home">
      <li><?=full_img($noidung, '') ?></li>
      <ul>
        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        <h3><a <?=full_href($noidung) ?>><?=$glo_lang['xem_chi_tiet'] ?> <i class="fa fa-angle-double-right"></i></a></h3>
      </ul>
      <div class="clr"></div>
    </div>
    
  </div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 29");
  if(count($banner_top)) {
?>
<div class="box_doitac_home">
  <div class="pagewrap">
  <div class="title_page">
      <ul>
        <h3><?=$glo_lang['doi_tac_khach_hang'] ?></h3>
      </ul>
    </div>
    <div class="logo_doitac no_box">
      <!--  -->
      <?php $data = array("2","2","3","4","5","6") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
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
<?php
  $sp_baiviet   = LAY_baiviet(3, 18, "`opt` = 1");
  // $sp_step      = LAY_step(3, 1);
  if(count($sp_baiviet)){
?>
<div class="tintuc_box_home">
  <div class="pagewrap">
    <div class="title_page">
      <ul>
        <h3><?=$glo_lang['tin_tuc_su_kien'] ?></h3>
        <p><?=$glo_lang['tin_tuc_su_kien_mo_ta'] ?></p>
      </ul>
    </div>
    <div class="tintuc_home_id">
      <div class="left_tt_home tintuc_home_id_slider no_box">
        <!--  -->
      <?php $data = array("1","1","2","2","3","3") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          foreach ($sp_baiviet as $rows) {
          ?>
          <div class="item">
            <ul>
              <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/></a></li>
              <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
              <h4><i class="fa fa-calendar"></i><?=CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>, <?=date("d/m/Y", $rows['ngaydang']) ?></h4>
              <p><span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
            </ul>
              
          </div>
          <?php } ?>

        </div>
      <div class="clr"></div>
      <!--  -->
        <div class="clr"></div>
      </div>
     
      <div class="clr"></div>
    </div>
  </div>
  <div class="clr"></div>
</div>
<?php } ?>