<?php
  $kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
  if(empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
  }
  else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
  }

  $lay_all_kx   = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

  $wh           = "  AND `id_parent` = (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
  $numview      = $thongtin['tin_lienquan'];

  $nd_kietxuat  = DB_fet_rd(" * "," `#_baiviet` "," `step` IN (".$slug_step.") $wh "," `catasort` DESC ", $numview);

  // $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  // $nd_total = mysqli_num_rows($nd_total);
  // $retuen_arr = array();
  // while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
  //   $retuen_arr[] = $r; 
  // }
  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
  // $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);
 
  // if($arr_running['icon_hover'] != "") {
  //   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
  // }
  // full_src($thongtin_step, '')

?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="link_title">
  <div class="pagewrap">
    <ul>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="c-tin-ad">
  <div class="home-ad-css">
    <div class="padding_pagewrap">
      <div class="title_news">
        <h2><?=SHOW_text($arr_running['tenbaiviet_'.$lang]); ?></h2>
        <h4><i class="fa fa-calendar"></i><?=date("d/m/Y", $arr_running['ngaydang']) ?></h4>
      </div>
      <div class="showText">
        <div class="itemFullText"><?=SHOW_text($arr_running['noidung_'.$lang], $glo_get_qc); ?><div class="clr"></div></div>
      </div>
    </div>
    <div id="sharelink">
      <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
        <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a> 
        <a class="addthis_button_tweet"></a> 
        <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
        <a class="addthis_counter addthis_pill_style"></a> </div>
    </div>
    <div class="dv-fb_coment">
      <?php include _source."fb_coment.php"; ?>
    </div>
    <div class="tintuc_home_box_2 wow fadeInDown">
      <div class="pagewrap">
        <div class="workshome-title"><h2 class="getlink"><span><?=$glo_lang['bai_viet_lien_quan'] ?></span></h2></div>
        <div class="tintuc_home_id flex">
          <?php
            foreach ($nd_kietxuat as $rows) {
          ?>
          <ul>
            <li><a <?=full_href($rows) ?>><?=full_img($rows, 'thumbnew_') ?></a></li>
            
            <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
          </ul>
          <?php   } ?>

        </div>
      </div>
    </div>
    <div class="clr"></div>
    <!--  -->
    <div class="dv-quang-cao-gg dv-quang-cao-gg-14">
        <?=@$glo_get_qc[14]['ma_quang_cao'] ?>
    </div>
    <!--  -->
    <div class="clr"></div>
  </div>

  <?php include _source."right_conten.php"; ?>
  <div class="clr"></div>
</div>
