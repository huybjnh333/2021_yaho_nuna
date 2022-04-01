<?php 
	if($motty 	== "404"){
		$nd_404 		 = DB_fet_rd("*","`#_seo_name` "," `id` = 1 ","",1);
  	$arr_running = reset($nd_404);
  		// $bre 				= SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]);
	}

  $bre  = SHOW_text($arr_running['tenbaiviet_'.$lang]);
	if(empty($thongtin_step)){
		$thongtin_step['id'] = 1;
  }
  else {
    $bre =  '<a href="'.GET_link($full_url, SHOW_text($thongtin_step['seo_name'])).'">'.$thongtin_step['tenbaiviet_'.$lang].'</a>';
  }
	$thongtin_step   = LAY_anhstep_now($thongtin_step['id']);

  // $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

  // if($arr_running['icon_hover'] != "") {
  //   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
  // }
// full_src($thongtin_step, '')
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><span><i class="fa fa-angle-right"></i></span><a <?=full_href($arr_running) ?>><?=$arr_running['tenbaiviet_'.$lang] ?></a></li> -->
<div class="banner-detail" style="background: url(<?=full_src($thongtin_step, '') ?>)">
  <h3><?= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h3>
</div>
<div class="about-us-1">
  <div class="pagewrap">
    <div class="quote wpb_column vc_column_container vc_col-sm-3"></div>
    <div class="quote wpb_column vc_column_container vc_col-sm-6">
      <div class="panel-section-title">
        <div class="stripe long">
          <h1>"</h1>
        </div>
      </div>
      <div class="showText"><?= SHOW_text($arr_running['mota_'.$lang]) ?></div>
      <div class="panel-section-title">
        <div class="stripe long">
          <h1>"</h1>
        </div>
      </div>

    </div>
    <div class="quote wpb_column vc_column_container vc_col-sm-3"></div>
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>
<div class="about-us-2">
<div class="pagewrap">
<div class="about-2-l">
  <div class="showText"><?= SHOW_text($arr_running['noidung_'.$lang]) ?></div>
</div>
<div class="about-2-l">
  <?=full_img($arr_running) ?>
</div>
<div class="clr"></div>
</div>
<div class="clr"></div>
</div>
<?php if($arr_running['link_video'] != ""){ ?>
<div class="about-us-3">
  <div class="pagewrap">
  <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?=GET_ID_youtube($arr_running['link_video']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>
<?php } ?>
<?php
   $list_hinhcon = LAY_hinhanhcon($arr_running['id']);
   if(count($list_hinhcon)){
?>
<link href="css/lightgallery.min.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/lightgallery-all.min.js"></script>
<div class="about-us-4">
  <div class="pagewrap">
  <h1><?=$glo_lang['theo_doi_cau_chuyen_cua_chung_toi'] ?></h1>
  <div class="about-4-f">
    <div  id="lightgallery">
    <?php foreach ($list_hinhcon as $rows){ ?>
    <div class="about-4-l" data-src="<?=full_src($rows, '') ?>"><a ><img src="<?=full_src($rows, "thumbnew_") ?>" alt=""></a></div>
    <?php } ?>
  </div>
  <div class="clr"></div>

    <div class="ad-b-img">
      <a class="cur button-tatca" onclick="show_anh('+')"><?=$glo_lang['xem_them'] ?><i class="fa fa-angle-down"></i></a>
      <a href="<?=$glo_lang['link_instagram'] ?>" target="_blank"><i class="fa fa-instagram"></i><?=$glo_lang['theo_doi_chung_toi_tren_in'] ?></a>
    </div>
    <div class="show-dulieu" style="display: none">
      <a class="cur button-thugon" onclick="show_anh('-')"><?=$glo_lang['thu_gon'] ?><i class="fa fa-angle-up"></i></a>
    </div>
  </div>
  <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
      $('#lightgallery').lightGallery();
  });
  function show_anh(loai){
    if(loai == "+") {
      $(".ad-b-img").hide();
      $(".show-dulieu").show();
      $(".about-4-l").addClass("acti");
    }
    else{
      $(".ad-b-img").show();
      $(".show-dulieu").hide();
      $(".about-4-l").removeClass("acti");
    }
  }
</script>
<?php } ?>