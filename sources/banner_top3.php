<div class="bannerMain">
  <a href="#box_home_top" class="scroll">
  <div id="downButton"></div>
  </a>
  <div class="banner">
  	<?php
      $banner_top = LAY_banner_new("`id_parent` = 16");
      foreach ($banner_top as $rows) {
        $oclick = "";
        if($rows['seo_name'] != "") {
          $oclick = " onclick='window.location.href=\".".GET_link($full_url, $rows['seo_name']).".\"'";
        }
        if($rows['check_video'] == 1 && $rows['video'] != ''){
    ?>
    <li>
		<video width="100%" height="500" controls autoplay loop muted>
			<source src="<?=$fullpath."/".$rows['duongdantin']."/files/".$rows['video'] ?>" type="video/mp4">
		</video>
	</li>
    <?php } else { ?>
    <li style='background-image:url(<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>);' <?=$oclick ?>>
		<div class="box_title_banner">
		<ul>
			<h2 class="wow zoomIn" data-wow-duration="1s" data-wow-delay="1s"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
			<h3 class="wow zoomIn" data-wow-duration="2s" data-wow-delay="2s"><?=SHOW_text($rows['mota_'.$lang]) ?></h3>
		</ul>
		</div>
	</li>
	<?php }} ?>

  </div>
  <ul class="pagiBanner">
  </ul>
<a href="#" class="placeNav prev1"><i class="fa fa-angle-left"></i></a><a href="#" class="placeNav next1"><i class="fa fa-angle-right"></i></a> 
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
				prev  : ".placeNav.prev1",
        	next  : ".placeNav.next1",
				swipe: {onMouse: true,onTouch: true},
				items: {height: "variable",visible: {min: 1,max: 1}}
			});
        });
    </script>
  <div class="clr"></div>
</div>