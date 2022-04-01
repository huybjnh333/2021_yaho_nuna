<?php include"banner_top.php";?>
<div class="pagewrap">
  <?php
    $step          = 2;
    $sp_danhmuc    = LAY_danhmuc($step);

    foreach ($sp_danhmuc as $dm) {
      if($dm['opt'] != 1) continue;
      $lay_all_kx  = LAYDANHSACH_idkietxuat($dm['id'], $dm['step']);
      $sp_baiviet  = LAY_baiviet($step, 10, "`opt1` = 1 AND `id_parent` IN ($lay_all_kx)");

      if(!count($sp_baiviet)) continue;
  ?>
  <div class="box_home">
    <div class="titile_page titile_page_2">
      <ul>
        <h3><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?></h3>
        <li>
        <?php foreach ($sp_danhmuc as $dmc) { if($dmc['id_parent'] != $dm['id']) continue; ?>
        <a <?=full_href($dmc) ?> ><?=SHOW_text($dmc['tenbaiviet_'.$lang]) ?></a>
        <?php } ?>
        <div class="clr"></div>
        </li>
        <div class="clr"></div>
      </ul>
    </div>
    <div class="pro_home_id_2 pro_home_id flex">
      <?php
        foreach ($sp_baiviet as $rows) {
          $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
      ?>
      <ul>
        <!-- <?=$gia['pt'] != 0 ? '<div class="discount-tag">-'.$gia['pt']."%</div>" : "" ?> -->
        <a <?=full_href($rows) ?>>
          <li><?=full_img($rows) ?></li>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
          <h4><?=$gia['text_gia'].$gia['text_km'] ?></h4>
        </a>
        <div class="view_more_pro">
          <div class="clolum_id"><a class="cur p_yeuthich p_yeuthich_<?=$rows['id'] ?>" onclick="ADD_yeuthich(this, <?=$rows['id'] ?>)" data="0"><i class="fa fa-heart-o" ></i></a></div>
          <div class="clolum_id"><a <?=full_href($rows) ?>><i class="fa fa-eye" ></i></a></div>
          <div class="clolum_id"><a href="<?=$full_url."/gio-hang/?id=".$rows['id'] ?>" ><i class="fa fa-cart-plus" ></i></a></div>
          <div class="clr"></div>
        </div>
      </ul>
      <?php } ?>
      
      <div class="clr"></div>
    </div>
  </div>
  <?php } ?>
  
</div>
