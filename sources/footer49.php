<div class="footer_top">
  <div class="pagewrap">
    <ul class="contact_footer">
      <?php
        $noidung    = LAYTEXT_rieng(78);
      ?>
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div class="n-foot">
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
      </div>
    </ul>
    <ul>
        <div class="tructuyen">
          <?php
            $noidung    = LAYTEXT_rieng(83);
          ?>
          <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
          <div class="n-foot">
              <?=SHOW_text($noidung['noidung_'.$lang]) ?>
          </div>
        </div>
    </ul>
    
    <ul class="face_bottom">
      <div class="fb-page" data-href="<?=$glo_lang['fanpage'] ?>" data-tabs="timeline" data-width="300" data-height="260" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="<?=$glo_lang['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?=$glo_lang['fanpage'] ?>"><?=$thongtin['tenbaiviet_vi'] ?></a></blockquote>
      </div>
    </ul>
    <ul>
    </ul>
    <div class="clr"></div>
  </div>
</div>
<div class="bottom_id_copyright">
  <div class="pagewrap">
	  <ul>
    <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
    <p><?=$glo_lang['dang_online'] ?>: <?=NUMBER_fomat($online_tv) ?> | <?=$glo_lang['tong_view'] ?>: <?=NUMBER_fomat($thongke_tv) ?><p>
		  </ul>
    <li>
    <div class="sharelink"> <a rel="nofollow" target="_top" class="addthis_button_facebook"><img src="images/facebook.png" title="facebook" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_twitter"><img src="images/twitter.png" title="twitter" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_google"><img src="images/google+.png" title="google+" border="0"/></a> <a rel="nofollow" target="_top" class="addthis_button_email"><img src="images/email.png" title="email" border="0"/></a> <a class="addthis_button_compact"><img src="images/addthis.png" title="addthis" border="0"/></a> 
    </div>
    </li>
	  <div class="clr"></div>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
