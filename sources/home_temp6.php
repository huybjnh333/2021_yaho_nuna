<ul>
    <a <?=full_href($rows) ?>>
	    <li><?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).' title="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?></li>
	    <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
	    <?php
			$kj       = 0;
			$bvtn_arr = LAY_bvtn($rows['id']);
	    	foreach ($tinhnang as $tn) {
	    		if($tn['id_parent'] != 0) continue;
	    		if(empty($bvtn_arr[$tn['id']])) continue;
	    		$kj++;

	    	if($kj == 1){
	    ?>
		<h4><?=$tn['tenbaiviet_'.$lang] ?>: <?=$tinhnang[$bvtn_arr[$tn['id']]]['tenbaiviet_'.$lang] ?></h4>
		<?php }else{ ?>
	    <p><?=$tn['tenbaiviet_'.$lang] ?>: <?=$tinhnang[$bvtn_arr[$tn['id']]]['tenbaiviet_'.$lang] ?></p>
	    <?php }} ?>
    </a>
</ul>  