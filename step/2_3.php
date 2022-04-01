<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 20;
  else $numview         = $thongtin_step['num_view'];


  $key            = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $tn             = isset($_GET['tn']) ? $_GET['tn'] : '';
  $sort           = isset($_GET['sort']) ? $_GET['sort'] : '';
  $pri            = isset($_GET['pri']) ? $_GET['pri'] : 0;
  $is_search      = $motty == 'search' ? true : false;
  $tnn             = isset($_GET['tnn']) ? $_GET['tnn'] : '';

  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  $wh               = "";
  $nd_title         = "";
  
  $slug_step        = 2;


  if(isset($_GET['p']) && ($_GET['p'] == 1 || $_GET['p'] == 2 || $_GET['p'] == 3)) {
    // $thongtin_step  = LAY_step($slug_step, 1);

    if($_GET['p'] == 1) {
      $name_titile    = $glo_lang['san_pham_moi']; 
      $wh .= " AND `opt2` = 1  ";
    }
    else if($_GET['p'] == 2) {
      $name_titile    = $glo_lang['san_pham_ban_chay']; 
      $wh .= " AND `opt1` = 1  ";
    }
    else {
      $name_titile    = $glo_lang['san_pham_khuyen_mai']; 
      $wh .= " AND `opt` = 1  ";
    }

  }
  
  else if($motty == "khuyen-mai"){
    
    $thongtin_step  = LAY_step($slug_step, 1);
    $name_titile    = $glo_lang['khuyen_mai']; 
 
    $wh            .= " AND `step` IN (".$slug_step.") AND `giakm` <> 0 ";

  }
  else if($motty == "yeu-thich"){
    
    $thongtin_step  = LAY_step($slug_step, 1);
    $name_titile    = $glo_lang['danh_sach_yeu_thich']; 
 
    $wh            .= " AND `step` IN (".$slug_step.")  ";

    //cehck yt
    // $check = DB_que("SELECT `id_baiviet` FROM `#_yeuthich` WHERE `id_member` = '".@$_SESSION['id']."' AND `showhi` = 1 LIMIT 1");
    // $id_baiviet  = "";
    // while ($rows = mysqli_fetch_assoc($check)) {
    //   $id_baiviet  = $id_baiviet  == "" ? $rows['id_baiviet'] : ",".$rows['id_baiviet'];
    // }
    // if($id_baiviet != "") {
      $wh .= " AND `id` IN (SELECT `id_baiviet` FROM `#_yeuthich` WHERE `id_member` = '".@$_SESSION['id']."' AND `showhi` = 1) ";
    // }
    //
  }
  else if($is_search){


    $thongtin_step  = LAY_step($slug_step, 1);
    $name_titile    = $glo_lang['tim_kiem']; 
 

    if($key != ""){
      $wh .= " AND (`tenbaiviet_".$lang."` LIKE '%".$key."%' OR `p1` LIKE '%".$key."%')";
    }  
  }
  else if($slug_table  == 'step'){
      // $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
      $tenhienthi = SHOW_text($thongtin_step['tenbaiviet_'.$lang]);
      $nd_title   = SHOW_text($thongtin_step['noidung_'.$lang]);

      // $danhmuc_list = LAY_danhmuc($slug_step, 0 , "`id_parent`  = 0");
  }
  else{
      $tenhienthi     = SHOW_text($arr_running['tenbaiviet_'.$lang]);
      $lay_all_kx     = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
 
      $wh .= "  AND (FIND_IN_SET('".$arr_running['id']."', `id_parent_muti`) OR (`id_parent` in (".$lay_all_kx."))) "; 
      $nd_title       = SHOW_text($arr_running['noidung_'.$lang]);


      // $danhmuc_list   = LAY_danhmuc($slug_step, 0, "`id_parent` = '".GET_danhmuc_pr($arr_running['id'], 2)."' ");
  
  }

  if(is_numeric($pri) && $pri > 0) {
    $que_ryy = DB_que("SELECT * FROM `#_lien_ket_nhanh` WHERE `id` = '".$pri."' AND `showhi` = 1 LIMIT 1");
    if(mysqli_num_rows($que_ryy)) {
      $que_ryy = mysqli_fetch_assoc($que_ryy);
      $gia_min = $que_ryy['gia_min'];
      $gia_max = $que_ryy['gia_max'];
      if($gia_min > 0) $wh .= " AND `giatien` >= '".$gia_min."' ";
      if($gia_max > 0) $wh .= " AND `giatien` <= '".$gia_max."' ";
    }
  }

  if($tn != "") {
    // $tn   = str_replace(".", ",", $tn);
    // $tn_c = explode(",", $tn);
    // $tn_c = count($tn_c);
    // $wh .= " AND `id` IN (SELECT `id_baiviet`  
    //       FROM `#_baiviet_select_tinhnang` 
    //       WHERE `id_tinhnang` IN ($tn) 
    //       GROUP BY `id_baiviet`
    //       HAVING COUNT(*) = $tn_c) ";
    // $wh .= " AND `id` IN (SELECT `id_baiviet`  
    //       FROM `#_baiviet_select_tinhnang` 
    //       WHERE `id_val` = '$tn' ) ";
  }
  // if($sort == 1) {
  //   $catasort = '`giatien` ASC, `catasort` DESC, `id` DESC';
  // }
  // else if($sort == 2) {
  //   $catasort = '`giatien` DESC, `catasort` DESC, `id` DESC';
  // }
  // else if($sort == 3) {
  //   $catasort = '`id` DESC, `catasort` DESC';
  // }
  // else if($sort == 4) {
  //   $catasort = '`id` ASC, `catasort` DESC';
  // }
  // if(isset($_GET['th'])) {
  //   $wh .= " AND `id` IN (SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang` WHERE `id_val` = '".$_GET['th']."' AND `showhi` = 1) ";
  //   $name_titile = DB_que("SELECT * FROM `#_baiviet_tinhnang` WHERE `id` = '".$_GET['th']."' LIMIT 1");
  //   $name_titile = mysqli_result_me($name_titile, 0, "tenbaiviet_".$lang);
  // }
  //phan thuong hieu
  // if($slug_step == 11) {
  //   if($slug_table  == 'step'){
  //     $slug_step = 2;
  //   }
  //   else {
  //     $slug_step = 2;
  //     $wh = " AND `num_3` = '".$arr_running['id']."' ";
  //   }
  // }
  //

  $wh_is_tinhnang = $wh;
  //tim kiem
  $wh_timkiem     = "";
  if($pri != "") {
    $pri_list = str_replace("-",",",$pri);
    $list_nhomgia     = DB_fet("*","#_lien_ket_nhanh","`id` IN ($pri_list)","`catasort` ASC","", "arr");
    $wh_or            = "";
    foreach ($list_nhomgia as $rows) {
      $wc     = " (`giatien` >= '".$rows['gia_min']."'";
      if($rows['gia_max'] > 0) {
        $wc  .= " AND `giatien` <= '".$rows['gia_max']."'";
      }
      $wc    .= ") ";
      $wh_or .= $wh_or == "" ? $wc  : " OR ". $wc ;
    }
    $wh      .= $wh_or != "" ? " AND ($wh_or) " : "";
    $wh_timkiem      .= $wh_or != "" ? " AND ($wh_or) " : "";

  }
  if($tnn != "") {
    $list_check     = str_replace("-", ",", $tnn);
    $list_check     = trim($list_check,",");
    $list_check_arr = explode(",", $list_check);
    $tinhnang_rm    = DB_fet("*","`#_baiviet_tinhnang`","","`id` DESC","","arr");
    foreach ($tinhnang_rm as $rows) {
      if($rows['id_parent'] != 0) continue;
      ${"wh_end".$rows['id']} = "";

      foreach ($tinhnang_rm as $rows_2) {
        if($rows_2['id_parent'] != $rows['id']) continue;
        if(!in_array($rows_2['id'], $list_check_arr)) continue;

          if(${"wh_end".$rows['id']} != "") {
            ${"wh_end".$rows['id']} .= " OR ";
          }
          ${"wh_end".$rows['id']} .= " `id_val` = '".$rows_2['id']."' ";
      }

      if(${"wh_end".$rows['id']} != "") {
        //query now
        $list_id_tn_sp          = DB_que("SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang`  WHERE `showhi` = 1 AND (".${"wh_end".$rows['id']}.")");
        ${"wh_end".$rows['id']}   = "0";

        $list_id_tn_sp = DB_arr($list_id_tn_sp);
        foreach ($list_id_tn_sp as $rows_bvv) {
          ${"wh_end".$rows['id']} .=  ",".$rows_bvv['id_baiviet'];
        }

        $wh .= " AND `id` IN (".${"wh_end".$rows['id']}.")";
        $wh_is_tinhnang .= " AND `id` IN (".${"wh_end".$rows['id']}.")";

      }
    }
  }
  //
  include _source."phantrang_kietxuat.php";

  if(isset($_GET['p']) && $_GET['p'] == 1){
    $link_p = '<span>/</span><a>'.$glo_lang['san_pham_moi']."</a>";
  }
  else if(isset($_GET['p']) && $_GET['p'] == 2){
    $link_p = '<span>/</span><a>'.$glo_lang['san_pham_ban_chay']."</a>";
  }
  else if(isset($_GET['p']) && $_GET['p'] == 3){
    $link_p = '<span>/</span><a>'.$glo_lang['san_pham_khuyen_mai']."</a>";
  }
  else if($motty == "yeu-thich") {
    $link_p = '<span>/</span><a>'.$glo_lang['danh_sach_yeu_thich']."</a>";
  }
  else if($motty == "khuyen-mai") {
    $link_p = '<span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a>'.$glo_lang['khuyen_mai']."</a>";
  }
  else   if($is_search != "") {
    $link_p = '<span>/</span><a>'.$glo_lang['tim_kiem']."</a>";
  }
  else {
    $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
  }
  // full_src($thongtin_step, '')

?>
<!-- <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><?=$link_p ?> </li> -->
<div class="bg_link_page">
  <div class="pagewrap">
    <ul>
      <h3><?=$name_titile ?></h3>
      <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><?=$link_p ?> </li>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="right_conten">
    <div class="titile_page">
      <h3><?=$name_titile ?></h3>
      <div class="clr"></div>
    </div>
    <div class="pro_id flex">
      <?php
          if($nd_total == 0){
            echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
          }
          else{
            foreach ($nd_kietxuat as $rows) {
              // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
              include _source."home_temp.php";
        }}
      ?>
      
      <div class="clr"></div>
    </div>
    <div class="nums no_box">
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
        <div class="clr"></div>
      </div>
  </div>
  <?php include _source."left_conten.php";?>
  <div class="clr"></div>
</div>
