<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 12;
  else $numview         = $thongtin_step['num_view'];


  $key       = isset($_GET['search']) ? str_replace("+", " ", strip_tags($_GET['search'])) : '';
  $is_search = isset($_GET['search']) ? true : false;

  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($slug_table != 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }
  $wh = "";
  if($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }

  if($is_search) {
    if(strlen($key) == 1){
      $wh .= " AND (`tenbaiviet_".$lang."` LIKE '".$key."%' )";
    }
    else {
      $wh .= " AND (`tenbaiviet_".$lang."` LIKE '%".$key."%' )";
    }
  }


  //

  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);


  // p3_vi
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="banner-detail" style="background: url(<?=full_src($thongtin_step, '') ?>)">
  <h3><?=$name_titile ?></h3>
</div>
<div class="about-us-1">
<div class="pagewrap">
<div class="quote wpb_column vc_column_container vc_col-sm-3"></div>
<div class="quote wpb_column vc_column_container vc_col-sm-6">
  <div class="panel-section-title">
    <div class="stripe long">
      <h1>"</h1>
    </div>
  </div>
  <div class="showText">
    <?=SHOW_text($arr_running["p3_".$lang]) ?>
  </div>
  <div class="panel-section-title">
    <div class="stripe long">
      <h1>"</h1>
    </div>
  </div>

</div>
<div class="quote wpb_column vc_column_container vc_col-sm-3"></div>
<div class="clr"></div>
</div>
<div class="clr"></div>
</div>
<div class="nhacungcap-f event-detail-2">
  <div class="pagewrap">
    <div class="panel-section-title">
    <div class="stripe">
      <h2><?=$glo_lang['tim_kiem_ncc'] ?></h2>
    </div>
    <div id="producerSearch" class="search-field-form">
            <input id="searchbox" class="inputHeight bbrSiteSearchInput left search-input-field ui-autocomplete-input" type="text" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>">
            <a class="btn-primary-action" onclick="go_search()"><?=$glo_lang['tim_kiem'] ?></a>
            <input type="hidden" class="js_url" value="<?=$full_url."/".$thongtin_step["seo_name"]."/" ?>">
            <script type="text/javascript">
              function go_search(){
                var url = $(".js_url").val();
                var key = $(".search-input-field").val().trim().replace(/ /g, "+");
                window.location.href = url + "?search=" + key;
              };
              $('.input_search_enter').keypress(function (event) {
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  if (keycode == '13') {
                      vgo_search();
                  }
              });
            </script>
            </div>
            <ol id="A-Z_sorter" class="search-list-bar">
              <?php
                $arr_list = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
                foreach ($arr_list as $key) {
              ?>
            <li class="search-list-bar-item">
                <a href="<?=$full_url."/".$thongtin_step["seo_name"]."/?search=".$key ?>" class="<?=@$_GET['search']== $key ? "active" : "" ?>"><?=$key ?></a> 
            </li>
            <?php } ?>
            </ol>
            <div id="producersA-Z_Table" class="search-list-wrapper">
              <?php
                if($is_search){
                  if($nd_total == 0){
                    echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
                  }
                  else{
              ?>
              <ul id="a-z_Producers" class="search-list-col">
                  <?php foreach ($nd_kietxuat as $rows) { ?>
                  <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
                  <?php } ?>
                  <div class="clr"></div>
              </ul>
              <div class="clr"></div>
              <div class="nums no_box">
                <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
                <div class="clr"></div>
              </div>
              <?php
                }}
                else {
                $arr_list = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
                foreach ($arr_list as $key) {
                  $baiviet = LAY_baiviet($slug_step,0,"`tenbaiviet_".$lang."` LIKE '$key%'");
                  if(!count($baiviet)) continue;
              ?>
              <a id="_letterA" class="search-list-key"><?=$key ?></a>
                <ul id="a-z_Producers" class="search-list-col">
                  <?php foreach ($baiviet as $rows) { ?>
                  <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
                <?php } ?>
                <div class="clr"></div>
              </ul>
              <?php }} ?>
        </div>
      </div> 
    </div>
  <div class="clr"></div>
</div>


