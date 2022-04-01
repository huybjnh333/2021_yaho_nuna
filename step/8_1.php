<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 12;
  else $numview         = $thongtin_step['num_view'];

  $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $is_search = isset($_GET['key']) ? true : false;

  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($is_search){
    $slug_step      = "1,3,4";
    $name_titile    = $glo_lang['tim_kiem']; 
    // $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '6' LIMIT 1");
    // $thongtin_step = mysqli_fetch_assoc($thongtin_step);
  }
  else if($slug_table != 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }
  $wh = "";
  if($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }
  
  if($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";
  }

  // //check tieu thuyet
  if($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
  }
  //

  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

  if($is_search != "") {
    $link_p = '<span>/</span><a>'.$glo_lang['tim_kiem']."</a>";
    $thongtin_step   = LAY_anhstep_now(3);
  }
 
  else {
    $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
  }

  // full_src($thongtin_step, '')
  $tenvideo = "";
  $id_video = "";
  foreach ($nd_kietxuat as $rows) {
    $tenvideo      =  $rows['tenbaiviet_'.$lang];
    $id_video      =  $rows['p1'];
    break;
  }
?>
<div class="link_title">
  <div class="pagewrap">
    <ul>
      <li><a href="#"><i class="fa fa-home"></i>trang chủ</a> / <a href="#" class="cl_active">Video</a></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="box_left_bv bg-blue-ad right-new">
  <div class="thuvienanh_id id_video_a">
    <?php
        $i = 0;
        foreach ($nd_kietxuat as $rows) {
          $i++;
          if($i == 1) continue;
      ?>
      <ul>
        <a onclick="PLAY_video('<?=GET_ID_youtube($rows['p1']) ?>', '<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>')" class="cur ">
        <li><?=full_img($rows) ?><i class="fa fa-youtube-play" aria-hidden="true"></i></li>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        </a>
      </ul>
      <?php } ?>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service02.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service03.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service04.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service02.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service03.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service04.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service02.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service03.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service04.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service02.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service03.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service04.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service02.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service03.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    <ul>
      <a href="video-popup.php" class="preview fancybox.ajax">
      <li><img src="delete/hinhanh/service04.jpg"/></li>
      <h4><i class="fa fa-calendar"></i>07/08/2020</h4>
        <h3><i class="fa fa-play-circle"></i>Lorem Ipsum is simply dummy text of the printing</h3>
      </a>
    </ul>
    
    
    <div class="clr"></div>
  </div>
  <div class="nums no_box">
      <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
      <div class="clr"></div>
    </div>
  <div class="clr"></div>
</div>

<?php include "menu-right.php";?>
  <div class="clr"></div>
</div>
