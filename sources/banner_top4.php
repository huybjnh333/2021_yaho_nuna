<div class="bannerMain">
	<?php
      $rows = LAY_banner_new("`id_parent` = 26", 1);
      if(is_array($rows)){
    ?>
  <div class="pagewrap">
    <div class="box_title_banner">
      <ul>
		<li><img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/></li>
        <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        <p><?=SHOW_text($rows['mota_'.$lang]) ?></p>
      </ul>
    </div>
  </div>
<?php } ?>
  <div class="banner">
    <?php
      $banner_top = LAY_banner_new("`id_parent` = 16");
      foreach ($banner_top as $rows) {
        $oclick = "";
        if($rows['seo_name'] != "") {
          $oclick = " onclick='window.location.href=\".".GET_link($full_url, $rows['seo_name']).".\"'";
        }
        // if($rows['check_video'] == 1 && $rows['video'] != ''){
    ?>
    <li style='background-image:url(<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>);' <?=$oclick ?>></li>
	<?php } ?>
  </div>

  <script type="text/javascript">
        jQuery(document).ready(function(){
			$(".banner").carouFredSel({
				circular: true,
				infinite: true,
				responsive: true,
				pagination: '.pagiBanner',
				auto : {pauseDuration : 2000,pauseOnHover  : true,duration: 1200,fx 		: "crossfade",},
				scroll	: {
					fx : "slide",items	: 1,
					onBefore: function( data ) {
						$('.banner li').not(data.items.visible[0]).find('.caption').animate({opacity: 0,visibility: 'hidden',bottom: -50});
						$(data.items.visible[0]).find('.caption').animate({opacity: 1,visibility: 'visible',bottom: 0},{queue:false,duration:1000});
					},
				},
				prev 		: false,
				next 		: false,
				swipe: {onMouse: true,onTouch: true},
				items: {height: "variable",visible: {min: 1,max: 1}}
			});
        });
    </script>
  <div class="clr"></div>
</div>
