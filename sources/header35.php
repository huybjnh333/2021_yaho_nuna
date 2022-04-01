<?php
	$hinhanh        = LAY_banner_new("`id_parent` = 25", 1);
	$hinhanh_cd     = LAY_banner_new("`id_parent` = 26", 1);
?>
<div class="header" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
	<div class="logo_top">
		<h3><a href="<?=$full_url ?>" jslink="1" datalink=""><?=$glo_lang['trieu_xuan'] ?></a></h3>
	</div>
    <div class="hinh_header"><a href="<?=$full_url ?>" jslink="1" datalink=""><?=full_img($hinhanh_cd, '') ?></a></div>
	<div class="right_header">
	  
	    <div class="clr"></div>
	    <div class="hotline_top">
	    	<?php include _source."lang.php"; ?>
	    	<div class="clr"></div>
	      	<h3><i class="fa fa-envelope-o" ></i><?=$glo_lang['email'] ?>: <?php 
	            $email_vi = explode("|", $thongtin['email_vi']);
	            $i = 0;
	            foreach ($email_vi as $val) {
	              $i++;
	              if($i > 1) echo ' - ';
	              echo '<a href="mailto:'.$val.'">'.$val.'</a>';
	            }
	          ?></h3>
	      	<h3 class="hl"><i class="fa fa-volume-control-phone" ></i><?=$glo_lang['hotline'] ?>: <?php 
	                    $hotline_vi = explode("|", $thongtin['hotline_vi']);
	                $i = 0;
	                foreach ($hotline_vi as $val) {
	                  $i++;
	                  if($i > 1) echo ' - ';
	                  echo '<a href="tel:'.$val.'">'.$val.'</a>';
	                }
	              ?></h3>
	    </div>
	    <div class="clr"></div>
	  </div>
	<div class="clr"></div>
</div>
<div class="dv-mobile">
	<a href="<?=$full_url ?>" class="home"><i class="fa fa-home"></i></a>
	<a class="a_js_mobile" onclick="$('.dv-menu-childd').toggle()">
		<span>&nbsp;</span>
		<span>&nbsp;</span>
		<span>&nbsp;</span>
	</a>
	<div class="dv-menu-childd">
		<div class="menu_left">
	      <ul>
	        <?=GET_menu_new($full_url, $lang, '', '', '') ?>
	      </ul>
	    </div>
	</div>
</div>