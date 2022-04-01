<div class="conten_page">
  
  <div class="right_conten">
    <?php include _source."banner_top.php";?>
    <?php
      $sp_baiviet   = LAY_baiviet(2, 12, "`opt2` = 1");
      $sp_step      = LAY_step(2, 1);
      if(count($sp_baiviet)){
    ?>
    <div class="box_page_id">
      <div class="title_page_home">
        <h3><?=$glo_lang['san_pham_moi'] ?></h3>
        <ul>
          <li><a <?=full_href($sp_step) ?>><i class="fa fa-angle-double-right" ></i><?=$glo_lang['xem_tat_ca'] ?></a></li>
          <div class="clr"></div>
        </ul>
        <div class="clr"></div>
      </div>
      <div class="pro_home_id flex">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
            include _source.'home_temp.php';
          }
        ?>
        <div class="clr"></div>
      </div>
    </div>
    <?php } ?>
    <?php
      $sp_baiviet   = LAY_baiviet(2, 12, "`opt` = 1");
      $sp_step      = LAY_step(2, 1);
      if(count($sp_baiviet)){
    ?>
    <div class="box_page_id">
      <div class="title_page_home">
        <h3><?=$glo_lang['san_pham_khuyen_mai'] ?></h3>
        <ul>
          <li><a <?=full_href($sp_step) ?>><i class="fa fa-angle-double-right" ></i><?=$glo_lang['xem_tat_ca'] ?></a></li>
          <div class="clr"></div>
        </ul>
        <div class="clr"></div>
      </div>
      <div class="pro_home_id flex">
        <?php
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
            include _source.'home_temp.php';
          }
        ?>
        <div class="clr"></div>
      </div>
    </div>
    <?php } ?>
    
  </div>
  <div class="left_conten">
    <?php include _source."left_conten.php";?>
  </div>
  <div class="clr"></div>
</div>
