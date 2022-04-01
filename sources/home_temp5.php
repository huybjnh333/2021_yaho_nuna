
<ul>
	<?=$gia['pt'] != 0 ? '<div class="discount-tag">-'.$gia['pt']."%</div>" : "" ?>
	<li><a <?=full_href($rows) ?>><?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).' title="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?></a></li>
	<h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
	<p><?=SHOW_text($rows['thuoc_tinh_1_'.$lang]) ?></p>
	<h4><?=$glo_lang['gia'] ?>: <?=$gia['text_gia'].$gia['text_km'] ?></h4>
</ul>