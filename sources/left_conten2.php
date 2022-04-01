<div class="left_conten">
  <div class="box_left">
    <div class="titile_left">
      <h3><?=$glo_lang['danh_muc_san_pham'] ?></h3>
    </div>
    <div class="menu_left">
      <ul>
        <?php
        $danhmuc = LAY_danhmuc(2);
        foreach ($danhmuc as $rows_1) {
          if($rows_1['id_parent'] != 0) continue;
      ?>
      <li class="has_child_left"> <a <?=full_href($rows_1) ?>><?=SHOW_text($rows_1['tenbaiviet_'.$lang]) ?></a>
        <?php
          // $nhom_2 = "";
          // foreach ($danhmuc as $rows_2) {
          //   if($rows_2['id_parent'] != $rows_1['id']) continue;
          //   $nhom_2 .= '<li class="has_child_left"><a '.full_href($rows_2).'>'.SHOW_text($rows_2['tenbaiviet_'.$lang]).'</a></li>';
          // }
          // echo $nhom_2 != "" ? '<ul class="list_child_left">'.$nhom_2.'</ul><i class="fa fa-angle-right view_more_left"></i>' : $nhom_2;
        ?>
      </li>
      <?php } ?>

      </ul>
    </div>
  </div>
  <?php
    $sp_baiviet   = LAY_baiviet(2, 25, "`opt2` = 1");
    $sp_step      = LAY_step(2, 1);
    if(count($sp_baiviet)){
  ?>
  <div class="box_left">
    <div class="titile_left">
      <h3><?=$glo_lang['san_pham_moi'] ?></h3>
    </div>
    <div class="box_l">
    
    <div class="marquee">
      <div class="pro_id pro_id_2">
      <?php
          $view  = "slider";
          foreach ($sp_baiviet as $rows) {
            // $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
            include _source.'home_temp.php';
          }
        ?>
      
      </div>
    </div>
      <script>$('.marquee').marquee({
            duration: 19000,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'up',
            duplicated: true,
            startVisible: true
        });
      </script> 
    </div>
  </div>
<?php } ?>
</div>

