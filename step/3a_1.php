
<div class="bg_load_page" style="background-image:url(<?=full_src($thongtin_step, '') ?>);"> </div>
<div class="page_conten">
  <div class="pagewrap">
    <div class="left_conten">
      <div class="titile_page">
        <ul>
         <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|') ?></li>
          <div class="clr"></div>
        </ul>
        <h3><?=$kietxuat_name ?></h3>
      </div>
      
      <div class="title_news">
    <h3><?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h3>
        <li><?=CONVER_thu(date("l", $arr_running['ngaydang']), $glo_lang) ?>, <?=$glo_lang['date'] ?> <?=date("d/m/Y", $arr_running['ngaydang']) ?></li>
  </div>
    <div class="showText">
      <?=SHOW_text($arr_running['noidung_'.$lang]); ?><div class="clr"></div>
    </div>
    <div id="sharelink">
            <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
          </div>
          <div class="dv-fb_coment">
            <?php include _source."fb_coment.php"; ?>
          </div>
    
      
    </div>
    <?php include _source."right_conten.php";?>
    <div class="clr"></div>
  </div>
</div>
