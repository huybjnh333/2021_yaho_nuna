<div class="footer">
  <div class="pagewrap">
    <div class="left_footer">
      <ul>
        <?php
          $noidung    = LAYTEXT_rieng(82);
        ?>
        <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
        <div class="n-foot">
            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
      </ul>
    </div>
    
    <div class="face_footer">
  	  <ul class="ul-footer">
  		  <?=GET_menu_new($full_url, $lang, '', '', '') ?>
  	 </ul>
  		<div class="clr"></div>
	  </div>
    <div class="clr"></div>
    <div class="bottom_ft">
      <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Designed and developed by</a> <a href="https://web30s.vn/" target="_blank"> P.A Viet Nam</a></p>
      
      <div class="clr"></div>
    </div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
 