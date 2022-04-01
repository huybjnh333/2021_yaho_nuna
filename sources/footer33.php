<?php
    if($motty == "" || (!empty($slug_step) && $slug_step == 4)){
  $banner_top = LAY_banner_new("`id_parent` = 27", 4);
  if(count($banner_top)){
?>
<div class="dv-danhmuc-anhhome">
  <div class="pagewrap">
    <div class="dv-danhmuc-anhhome-cont">
      <h3 class="tit"><?=$glo_lang['slugan_1'] ?></h3>
      <p><?=$glo_lang['slugan_2'] ?></p>
      <div class="right_header">
        <!--  -->
        <?php
          $i = 0;
          foreach ($banner_top as $r) {
            $i++;
        ?>
        <li class="li_<?=$i ?>">
          <img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt="<?=SHOW_text($r['tenbaiviet_'.$lang]) ?>">
          <div class="rra">
            <p><?=SHOW_text($r['tenbaiviet_'.$lang]) ?></p>
            <a <?=full_href($r) ?>><?=SHOW_text($r['mota_'.$lang]) ?></a>
          </div>
        </li>
        <?php } ?>
        <div class="clr"></div>
        <!--  -->
      </div>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php }} ?>

<div class="dv-footer">
	<div class="pagewrap">
		<div class="dv-footer-cont flex">
			<ul class="ul-1">
				<?php
                    $noidung    = LAYTEXT_rieng(73);
                ?>
                <h2 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
                <div class="n-foot">
                    <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                </div>
			</ul>
			<ul class="ul-2">
				<?php
                    $noidung    = LAYTEXT_rieng(74);
                ?>
                <h2 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
                <div class="n-foot">
                    <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                </div>
			</ul>
			<ul class="ul-3">
				<?php
                    $noidung    = LAYTEXT_rieng(75);
                ?>
                <h2 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
                <div class="n-foot">
                    <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                </div>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
</div>
<div class="bottom_id_copyright">
  <div class="pagewrap">
  	<div class="ll">
	    <p><?=$glo_lang['ban_quyen_name'] ?></p>
	    <p><a href="https://web30s.vn/" title="thiết kế website" target="_blank" class="tkw">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
    </div>
    <p class="r"><?=$glo_lang['dang_online'] ?>: <span><?=NUMBER_fomat($online_tv) ?></span> | <?=$glo_lang['tong_view'] ?>: <span><?=NUMBER_fomat($thongke_tv) ?></span></p>
    <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>