
<main class="content_page"> 
	<?php  include _source."banner_top.php" ?>
	<?php
	    $step          = 2;
	    $sp_step       = LAY_step($step, 1);
	    $sp_baiviet    = LAY_baiviet($step, 6,"`opt1` = 1 ");
	    if(count($sp_baiviet)) {
	?>
	<section class="section_main section_product">
		<div class="container">
			<div class="header_section text_center">
				<h2 class="title_main"><?=$glo_lang['mizuno_golf_center'] ?></h2>
			</div>
			<ul class="list_product no_style flex text_center">
				<?php
			          foreach ($sp_baiviet as $rows) {
			    ?>
			    <li class="wow fadeInUp" data-wow-delay=".25s">
					<div class="item_product">
						<div class="img_product">
							<a <?=full_href($rows) ?>>
								<?=full_img($rows) ?>
							</a>
						</div>
						<div class="intro_product flex text_center">
							<div class="box_intro color-green">
								<h3 class="title_product">
									<a <?=full_href($rows) ?>>
										<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
									</a>
								</h3>
								<p class="short_product">
									<span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span>
								</p>
								
							</div>
							<svg>
					        	<rect x="0" y="0" fill="none" width="100%" height="100%"></rect>
					      	</svg>
						</div>
					</div>
				</li>
			    <?php } ?>
			    <div class="clr"></div>
			</ul>
		</div>
	</section>
	<?php } ?>
	<?php
      $noidung        = LAYTEXT_rieng(60);
      if(count($noidung)){
    ?>
	<section class="section_main section_about">
		<div class="container">
			<div class="box_about_main flex">
				<div class="left_about wow fadeInLeft" data-wow-delay=".25s">
					<a <?=full_href($noidung) ?>>
						<?=full_img($noidung, '') ?>
					</a>
				</div>
				<div class="right_about wow fadeInRight" data-wow-delay=".25s">
					<h2 class="title_main text_left"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
					<!-- <p class="short_about_main"> -->
						<div class="short_about_main">
					        <?=SHOW_text($noidung['noidung_'.$lang]) ?> 
					     </div>

					<!-- </p> -->
					<a <?=full_href($noidung) ?> class="more_info"><?=$glo_lang['xem_chi_tiet'] ?></a>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</section>
	<?php } ?>
	<?php
	    $step          = 3;
	    $sp_step       = LAY_step($step, 1);
	    $sp_baiviet    = LAY_baiviet($step, 6,"`opt1` = 1 ");
	    if(count($sp_baiviet)) {
	?>
	<section class="section_main section_golf_Coach">
		<div class="container">
			<div class="header_section text_center">
				<h2 class="title_main"><?=$glo_lang['golf_coachs'] ?></h2>
			</div>
			<ul class="list_golf_Coach no_style flex">
				<?php
					$i = 0;
			        foreach ($sp_baiviet as $rows) {
			        	$i++;
			        	$class = $i % 2 == 0 ? "fadeInRight" : "fadeInLeft";
			        	$times = ".25s";
			        	if($i > 4) $times = "0.75s";
			        	else if($i > 2) $times = ".50s";
			    ?>
				<li class="wow <?=$class ?>" data-wow-delay="<?=$times ?>">
					<div class="item_golf_Coach  ">
						<div class="img_golf_Coach">
							<?=full_img($rows) ?>
						</div>
						<div class="intro_golf_Coach">
							<div class="box_intro_golf_coach">
								<h3 class="name_golf_Coach">
									<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
								</h3>
								<div class="short_golf_Coach">
									<ul class="no_style">
										<li class="national_gold_coache"><?=SHOW_text($rows['tags_'.$lang]) ?></li>
										<?php if($rows['gia_tri_2_vi'] != ""){ ?>
										<li class="phone_gold_coache"><a href="tel:<?=$rows['gia_tri_2_vi'] ?>"><?=$rows['gia_tri_2_vi'] ?></a></li>
										<?php } if($rows['gia_tri_1_vi'] != ""){ ?>
										<li class="email_gold_coache"><a href="mailto:<?=$rows['gia_tri_1_vi'] ?>"><?=$rows['gia_tri_1_vi'] ?></a></li>
										<?php } ?>
										
									</ul>
								</div>
							</div>
						</div>
						<div class="clr"></div>
					</div>
				</li>
			    <?php } ?>
			    
				<div class="clr"></div>
			</ul>
			 <div class="text_center wow fadeInUp" data-wow-delay="1s">
			 	<a <?=full_href($sp_step) ?> class="more_info"><?=$glo_lang['xem_them'] ?></a>
			 </div>
		</div>
	</section>
	<?php } ?>
	<?php
	    $step          = 7;
	    $sp_step       = LAY_step($step, 1);
	    $sp_baiviet    = LAY_baiviet($step, 5,"`opt1` = 1 ");
	    if(count($sp_baiviet)) {
	?>
	<section class="section_main section_video">
		<div class="container">
			<div class="video_first wow fadeInUp" data-wow-delay=".25s">
				<iframe width="100%" height="470" src="https://www.youtube.com/embed/<?=GET_ID_youtube($sp_baiviet[0]['p1']) ?>" frameborder="0" allowfullscreen id="f_video_home"></iframe>
			</div>
			<ul class="list_video_small no_style flex">
				<?php
			        $i = 0;
			        foreach ($sp_baiviet as $rows) {
			        	$i++;
			        	if($i == 1) continue;
			        	$times = ".25s";
			        	if($i == 3) $times = ".55s";
			        	if($i == 4) $times = ".85s";
			        	if($i == 5) $times = "1.15s";
			    ?>
			    <li class="wow fadeInUp" data-wow-delay=".25s">
					<a class="cur" onclick="Play_video('<?=GET_ID_youtube($rows['p1']) ?>')"><?=full_img($rows) ?><i class="fa fa-youtube-play"></i></a>
				</li>
			    <?php } ?>
			    <div class="clr"></div>
			</ul>
			<script>function Play_video(id){$('#f_video_home').attr('src', 'https://www.youtube.com/embed/'+id+"?autoplay=1&rel=0"); }</script>
		</div>
	</section>
	<?php } ?>
	<?php
	    $step          = 5;
	    $sp_step       = LAY_step($step, 1);
	    $sp_baiviet    = LAY_baiviet($step, 6,"`opt1` = 1 ");
	    if(count($sp_baiviet)) {
	?>
	<section class="section_main section_golf_Coach">
		<div class="container">
			<div class="header_section text_center">
				<h2 class="title_main"><?=$glo_lang['tin_tuc_su_kien'] ?></h2>
			</div>
			<ul class="list_news no_style flex text_center">
				<?php
					$i = 0;
			        foreach ($sp_baiviet as $rows) {
			        $times = ($i * 0.30 + 0.25)."s";
			        $i++;
			    ?>
				<li class="wow fadeInUp" data-wow-delay="<?=$times ?>">
					<div class="item_news">
						<div class="box_item_new">
							<div class="img_news">
								<a <?=full_href($rows) ?>>
									<?=full_img($rows) ?>
								</a>
							</div>
							<div class="intro_news">
								<div class="box_news">
									<div class="text_center po_related">
										<span class="icon_golf"><img src="images/icon_golf.png"></span>
										<h3 class="title_news title_product">
											<a <?=full_href($rows) ?>>
												<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
											</a>
										</h3>
										<p class="time_post">
											<?=CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>, <?=date("d/m/Y", $rows['ngaydang']) ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			    <?php } ?>
			    <div class="clr"></div>
			</ul>
			 <div class="text_center wow fadeInUp" data-wow-delay="1s">
			 	<a <?=full_href($sp_step) ?> class="more_info"><?=$glo_lang['xem_them'] ?></a>
			 </div>
		</div>
	</section>
	<?php } ?>
</main> 

