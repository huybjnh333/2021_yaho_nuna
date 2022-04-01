<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['danh_muc_san_pham'] ?></h3>
    <div class="clr"></div>
  </div>
  <div id="menu_left">
    <ul>
      <?php
        $danhmuc = LAY_danhmuc(2);
        foreach ($danhmuc as $rows_1) {
          if($rows_1['id_parent'] != 0) continue;
      ?>
      <li class="has_child_left"> <a <?=full_href($rows_1) ?>><?=SHOW_text($rows_1['tenbaiviet_'.$lang]) ?></a>
        <?php
          $nhom_2 = "";
          foreach ($danhmuc as $rows_2) {
            if($rows_2['id_parent'] != $rows_1['id']) continue;
            $nhom_2 .= '<li class="has_child_left"><a '.full_href($rows_2).'>'.SHOW_text($rows_2['tenbaiviet_'.$lang]).'</a></li>';
          }
          echo $nhom_2 != "" ? '<ul class="list_child_left">'.$nhom_2.'</ul><i class="fa fa-angle-right view_more_left"></i>' : $nhom_2;
        ?>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php
  $sp_baiviet   = LAY_baiviet(2, 25, "`opt1` = 1");
  $sp_step      = LAY_step(2, 1);
  if(count($sp_baiviet)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['san_pham_hot'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="box_km">
    <div class="marquee">
      <div class="pro_home_id pro_home_left">
        <?php
          $view  = "slider";
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
            include _source.'home_temp.php';
          }
        ?>
        <div class="clr"></div>
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
<?php
  if(empty($wh_is_tinhnang)) $wh_is_tinhnang = '';
  if(empty($wh_timkiem)) $wh_timkiem = '';

  $tkgia    = LAY_tkgia();
  $pri_arr  = isset($_GET['pri']) ? explode("-", $_GET['pri']) : array();
  if(count($tkgia)){
    $i = 0;
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['gia_tien'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="check_id check_id_id_gia">
    <ul>
      <?php
          foreach ($tkgia as $rows) {
          $wc     = "AND  (`giatien` >= '".$rows['gia_min']."'";
            if($rows['gia_max'] > 0) {
              $wc  .= " AND `giatien` <= '".$rows['gia_max']."'";
            }
          $wc    .= ") ";

            // $check_num = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` = 1 AND `step` = 2 $wc $wh_is_tinhnang");
            // $check_num = DB_num($check_num);

            // if($check_num == 0) continue;
            $i++;
        ?>
        <label class="container"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
          <input type="checkbox" class="tnn_pri" value="<?=$rows['id'] ?>" <?=in_array($rows['id'], $pri_arr) ? 'checked="checked"' : "" ?>>
          <span class="checkmark"></span>
          <!-- <span class="num_sp_xx">(<?=number_format($check_num) ?>)</span> -->
        </label>
        <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<!--  -->
<?php
  if(!empty($arr_running['id_parent_muti_show']) && $arr_running['id_parent_muti_show'] != "") {
    $id_parent_muti_show = explode(",", $arr_running['id_parent_muti_show']);
  }
  $list_tinhnawng = DB_fet_rd("*","`#_baiviet_tinhnang`","`showhi` = 1 ","`catasort` ASC, `id` DESC");


  $tnn_arr  = isset($_GET['tnn']) ? explode("-", $_GET['tnn']) : array();
  foreach ($list_tinhnawng as $rows) {
    $i = 0;
    if($rows['id_parent'] != 0) continue;
    // if(!empty($id_parent_muti_show) && !in_array($rows['id'], $id_parent_muti_show)) continue;
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$rows['tenbaiviet_'.$lang] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="check_id">
    <ul>
      <?php
        foreach ($list_tinhnawng as $rows_2) {
          if($rows_2['id_parent'] != $rows['id']) continue;
          // if(!empty($id_parent_muti_show) && !in_array($rows_2['id'], $id_parent_muti_show)) continue;
          //
          // $check_num = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` = 1 AND `step` = 2  $wh_is_tinhnang $wh_timkiem AND `id` IN (SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang`  WHERE `showhi` = 1 AND `id_val` = '".$rows_2['id']."') ");
          // $check_num = DB_num($check_num);
          // if($check_num == 0) continue;
          $i++;
      ?>
        <label class="container"><?=$rows_2['tenbaiviet_'.$lang] ?>
        <input type="checkbox" class="tnn_2" value="<?=$rows_2['id'] ?>" <?=in_array($rows_2['id'], $tnn_arr) ? 'checked="checked"' : "" ?>>
        <span class="checkmark"></span>
        <!-- <span class="num_sp_xx">(<?=number_format($check_num) ?>)</span> -->
      </label>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<!--  -->


<?php
  $sp_baiviet   = LAY_baiviet(3, 5, "`opt` = 1");
  $sp_step      = LAY_step(3, 1);
  if(count($sp_baiviet)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['tin_nong'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="tin_left">
     <?php
      foreach ($sp_baiviet as $rows) {
    ?>
    <ul>
      <a <?=full_href($rows) ?>>
      <li><img src="<?=full_src($rows, '') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
      <h4><span class="lm_3"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></span></h4>
      </a>
      <div class="clr"></div>
    </ul>
    <?php } ?>

  </div>
</div>
<?php } ?>
<script>
  var myVar;
  $(".check_id input").click(function(){
    clearTimeout(myVar);
    myVar = setTimeout(function(){
      LOAD_sp_ajax();
    }, 1500);
  });
  function LOAD_sp_ajax(){
    var list_check = "";
    $(".check_id input.tnn_2").each(function(){
      if($(this).is(":checked")) {
        list_check += list_check == "" ? $(this).val() : "-" + $(this).val();
      }
    });

    var list_check_pri = "";
    $(".check_id input.tnn_pri").each(function(){
      if($(this).is(":checked")) {
        list_check_pri += list_check_pri == "" ? $(this).val() : "-" + $(this).val();
      }
    });
    if(list_check_pri != "") list_check_pri = "&pri="+list_check_pri;
    if(list_check != "") list_check = "&tnn="+list_check;
    window.location.href = "<?=$full_url."/search/?key=" ?>"+list_check_pri+list_check;
  }
</script>