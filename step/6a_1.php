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
  $numview      = 12;

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
<link href="css/lightgallery.min.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/lightgallery-all.min.js"></script>
<div class="conten_page">
  
  <div class="right_conten">
  
    <div class="box_page_id">
      <div class="title_page_home">
        <h3><?=$kietxuat_name ?></h3>
        <div class="clr"></div>
      </div>
      <div class="title_news">
      <h2><?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
    </div>
    <!--  -->
    <div  id="lightgallery" class="album-zoom-gallery flex no_box" >
    <?php
      $danhsach_img = LAY_hinhanhcon($arr_running['id']);
      foreach ($danhsach_img as $rows) {
    ?>
      <div data-src="<?=full_src($rows, '') ?>">
        <a ><img src="<?=full_src($rows, "thumbnew_") ?>" alt=""></a>
      </div>
      <?php } ?>
    </div>
    <!--  -->
    <div class="clr"></div>
    </div>
    <div class="box_page_id">
      <div class="title_page_home">
        <h3><?=$glo_lang['thu_vien_anh_khac'] ?></h3>
        <div class="clr"></div>
      </div>
      <div class="thuvienanh_id flex">
        <?php
            foreach ($nd_kietxuat as $rows) {
          ?>
          <ul>
            <a  <?=full_href($rows) ?>>
            <li><?=full_img($rows) ?></li>
            <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
            </a>
          </ul>
          <?php } ?>
        
        <div class="clr"></div>
      </div>
      
    </div>
  </div>
  <div class="left_conten">
    <?php include _source."left_conten.php";?>
  </div>
  <div class="clr"></div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
      $('#lightgallery').lightGallery();
  });
</script>