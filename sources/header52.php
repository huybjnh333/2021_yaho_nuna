<div class="header_top">
  <div class="pagewrap">
    <div class="logo_top">
      <li><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></li>
    </div>
	  <div class="right_header">
      <div class="flex no_box">
      <?php
        $banner_top = LAY_banner_new("`id_parent` = 26",3);
        if(count($banner_top)) {
          foreach ($banner_top as $rows) { 
      ?>
  	  <ul>
        <li><a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a></li>
  		  <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['mota_'.$lang]) ?></a><span><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></span></h3>
  		  <div class="clr"></div>
  		</ul>
      <?php }} ?>
      </div>
		  <h4> <a onclick="LOAD_popup_new('<?=$full_url."/pa-size-child/yeu-cau-bao-gia/" ?>', '480px')" class='cur'><?=$glo_lang['yeu_cau_bao_gia'] ?><i class="fa fa-paper-plane-o" ></i></a></h4>
		  
		  <div class="clr"></div>
	  </div>
    <div class="clr"></div>
  </div>
	</div><div class="box_menu">
	
	<div class="menu_top">
		<div class="pagewrap">
      <?php include _source."menu_top.php"; ?>
      <div class="right_menu">
        <ul>
          <li>
            <a class="cur" onclick="if(!$('.timkiem_top').hasClass('acti')) $('.timkiem_top').addClass('acti'); else $('.timkiem_top').removeClass('acti')"><i class="fa fa-search"></i><u><?=$glo_lang['tim_kiem'] ?></u></a>
            <div class="timkiem_top no_box">
              <div class="search">
                  <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
                  <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
              </div>
            </div>
          </li>
          <?php include _source."lang.php"; ?>
          
          <div class="clr"></div>
        </ul>
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