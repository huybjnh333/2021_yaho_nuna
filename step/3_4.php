<?php
  // if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
  //     $numview          = 12;
  // else $numview         = $thongtin_step['num_view'];

  $numview         = $thongtin['tin_danhsach'];

  $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $is_search = $motty == 'search' ? true : false;

  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($is_search){
    $slug_step      = "2,3,4,6,7";
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
    $wh .= " AND (`tenbaiviet_".$lang."` LIKE '%".$key."%' )";
  }


  //

  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

  if($is_search){
    $link_p = '<span>/</span><a>'.$glo_lang['tim_kiem']."</a>";
    $thongtin_step   = LAY_anhstep_now(3);
  }
 
  else {
    $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '|');
  }

  // full_src($thongtin_step, '')
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="link_title">
  <div class="pagewrap">
    <ul>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="c-tin-ad">
  <div class="home-ad-css">
    
      <?php 
        $danhmuc    = LAY_danhmuc(1, 0, "", "", "id");
        if($nd_total == 0){
          echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
        }else{
          if($pzer == 1 && !$is_search){
      ?>
      <div class="itemRow wow fadeInDown">
        <?php 
          $i = 0;
          foreach ($nd_kietxuat as $rows) {
           $i++; 
           if($i != 1) continue;
        ?>
        <div class="cn-c-l">
          <div class="itemContainer">
            <div class="catItemImageBlock">
              <a <?=full_href($rows) ?>><?=full_img($rows, 'thumbnew_') ?></a>
            </div>
            <h4><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h4>
            <div class="dv-mota-tin3">
              <p><span class="lm_3"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
            </div>
            <div class="catItemCategory">
              <a <?=full_href($danhmuc[$rows['id_parent']]) ?>><?=SHOW_text($danhmuc[$rows['id_parent']]['tenbaiviet_'.$lang]) ?></a>
            </div>
            <div class="catItemDateCreated"> - <?=date("d/m/Y",$rows['ngaydang']) ?></div>
            <div class="clear"></div>
          </div>
        </div>
        <?php   } ?>
        <div class="cn-c-r">
          <?php 
            $i = 0;
            foreach ($nd_kietxuat as $rows) {
             $i++; 
             if($i < 2 || $i > 3) continue;
          ?>
          <div class="itemContainer">
            <div class="catItemImageBlock"><a <?=full_href($rows) ?>><?=full_img($rows, 'thumbnew_') ?></a></div>
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
      </div>
      <div class="clear"></div>
    <?php } ?>
      <div class="home-tintuc-left wow fadeInLeft">
        <?php 
          $j = 0; 
          foreach ($nd_kietxuat as $rows) {
            $j++;
            if($pzer == 1 && $j <= 3 && !$is_search) continue;

        ?>
        <div>
          <div class="img-left"><a <?=full_href($rows) ?>><?=full_img($rows, 'thumbnew_') ?></a></div>
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
      <?php } ?>
      <div class="home-img-qc">
        <!--  -->
        <div class="dv-quang-cao-gg dv-quang-cao-gg-12">
            <?=@$glo_get_qc[12]['ma_quang_cao'] ?>
        </div>
        <!--  -->
        <div class="clr"></div>
      </div>
      
      <div class="clr"></div>
      <div class="nums no_box">
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
        <div class="clr"></div>
      </div>
    </div>
    <?php include _source."right_conten.php"; ?>
    <div class="clr"></div>
  </div>