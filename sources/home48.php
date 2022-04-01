<?php
	$danhmuc 	  = LAY_danhmuc(1, 0, "", "", "id");
  	$sp_baiviet   = LAY_baiviet(1, $thongtin['tin_hot'], "`opt` = 1");
  // if(count($sp_baiviet)){
?>
<div class="home-f-a">
	<div class="home-ad-css">
		<div class="itemRow wow fadeInDown">
			<?php $i = 0; foreach ($sp_baiviet as $rows) { $i++; if($i > 2) continue; ?>
			<div class="itemContainer itemContainer_home_1">
				<div class="catItemImageBlock">
					<a <?=full_href($rows) ?>><img src="<?=full_src($rows, "thumbnew_") ?>" alt=""></a>
				</div>
				<h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h4>
				<div class="catItemCategory">
					<a <?=full_href($danhmuc[$rows['id_parent']]) ?>><?=SHOW_text($danhmuc[$rows['id_parent']]['tenbaiviet_'.$lang]) ?></a>
				</div>
				<div class="catItemDateCreated"> - <?=date("d/m/Y",$rows['ngaydang']) ?></div>
				<div class="clear"></div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="itemRow1 wow fadeInDown">
			<?php $i = 0; foreach ($sp_baiviet as $rows) { $i++; if($i < 3 || $i > 5) continue; ?>
			<div class="itemContainer itemContainer_home_2">
				<div class="catItemImageBlock"><a <?=full_href($rows) ?>><?=full_img($rows, "thumbnew_") ?></a></div>
				<h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h4>
				<div class="catItemCategory">
					<a <?=full_href($danhmuc[$rows['id_parent']]) ?>><?=SHOW_text($danhmuc[$rows['id_parent']]['tenbaiviet_'.$lang]) ?></a>
				</div>
				<div class="catItemDateCreated"> - <?=date("d/m/Y",$rows['ngaydang']) ?></div>
				<div class="clear"></div>
				
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<div class="home-img-qc">
			<div class="ja-workshome" id="Mod403">
				<div class="workshome-content">
					<div class="dv-quang-cao-gg dv-quang-cao-gg-2">
			            <?=@$glo_get_qc[2]['ma_quang_cao'] ?>
			        </div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="home-tintuc-left wow fadeInLeft">
			<?php $i = 0; foreach ($sp_baiviet as $rows) { $i++; if($i < 6) continue; ?>
			<div>
				<div class="img-left"><a <?=full_href($rows) ?>><?=full_img($rows, "thumbnew_") ?></a></div>
				<div class="thongtin-right">
					<h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h4>
					<div class="catItemCategory">
						<a <?=full_href($danhmuc[$rows['id_parent']]) ?>><?=SHOW_text($danhmuc[$rows['id_parent']]['tenbaiviet_'.$lang]) ?></a>
					</div>
					<div class="catItemDateCreated"> - <?=date("d/m/Y",$rows['ngaydang']) ?></div>
					<p><span class="lm_3"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
				</div>
				<div class="clr"></div>
			</div>
			<?php } ?>
			
			<div class="clr"></div>
		</div>
		<div class="home-img-qc">
			<div class="ja-workshome" id="Mod405">
				<div class="workshome-content">
					<div class="dv-quang-cao-gg dv-quang-cao-gg-3">
			            <?=@$glo_get_qc[3]['ma_quang_cao'] ?>
			        </div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
		<?php 
			$ivitri = 0;
			foreach ($danhmuc as $dm) {
				$lay_all_kx = LAYDANHSACH_idkietxuat($dm['id'], $dm['step']);
				$baiviet_con= LAY_baiviet($dm['step'],$thongtin['tin_moi'],"`id_parent` IN ($lay_all_kx) AND `opt1` = 1");
				if(!count($baiviet_con)) continue;
				$ivitri++;
		?>
		<div class="new_top_id wow fadeInDown">
			<div class="workshome-title">
				<a <?=full_href($dm) ?>><h2 class="getlink"><span><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?></span></h2></a>
			</div>
			<?php $i = 0; foreach ($baiviet_con as $rows) { $i++; if($i > 1) continue; ?>
			<div class="one_new_home">
				<li><a <?=full_href($rows) ?>><?=full_img($rows, "thumbnew_") ?></a></li>
				<ul>
					<h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
				</ul>
				<div class="clr"></div>
			</div>
			<?php } ?>
			<div class="one_new_home_right">
				<?php $i = 0; foreach ($baiviet_con as $rows) { $i++; if($i == 1) continue; ?>
				<ul>
					<li><a <?=full_href($rows) ?>><?=full_img($rows, "thumbnew_") ?></a></li>
					<h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
					<div class="clr"></div>
				</ul>
				<?php } ?>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<!-- //qc -->
		<?php if($ivitri % 2 == 0){ ?>
			<div class="home-img-qc">
				<div class="ja-workshome" id="Mod407">
					<div class="workshome-content">
						<?php if($ivitri == 2){ ?>
							<div class="dv-quang-cao-gg dv-quang-cao-gg-4">
					            <?=@$glo_get_qc[4]['ma_quang_cao'] ?>
					        </div>
						<?php } ?>
						<?php if($ivitri == 4){ ?>
							<div class="dv-quang-cao-gg dv-quang-cao-gg-5">
					            <?=@$glo_get_qc[5]['ma_quang_cao'] ?>
					        </div>
						<?php } ?>
						<?php if($ivitri == 6){ ?>
							<div class="dv-quang-cao-gg dv-quang-cao-gg-6">
					            <?=@$glo_get_qc[6]['ma_quang_cao'] ?>
					        </div>
						<?php } ?>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		<?php } ?>
		<!-- end qc -->
		<?php } ?>
		<div class="clr"></div>
	</div>
	<?php include _source."right_conten.php"; ?>
	<div class="clr"></div>
</div>