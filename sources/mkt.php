<?php
  $danhsach_mkt = DB_que("SELECT * FROM `#_marketing` WHERE `showhi` = 1 ORDER BY RAND() LIMIT 50");
  if(DB_num($danhsach_mkt)) {
    $ndmkt = "";
    $danhsach_mkt = DB_arr($danhsach_mkt);
    foreach ($danhsach_mkt as $rows) {
      $nd__m  = $rows['noidung_'.$lang];
      $nd__m  = str_replace("[hoten]", '<span>'.$rows['mota_'.$lang].'</span>', $nd__m);

      $ndmkt .= '["'.$rows['tenbaiviet_'.$lang].'","'.$nd__m.'", "'.$fullpath."/".$rows['duongdantin']."/thumb_".$rows['icon'].'"],';
    }
    $ndmkt = trim($ndmkt, ",");
    $db_que = DB_que("SELECT * FROM `#_marketing_setting` WHERE `id` = 1 LIMIT 1");
    $db_que = DB_arr($db_que, 1);
?>
<style>
  .dv-main-mkt { position: fixed; z-index: 999; bottom: 30px; left: 30px; text-align: left; height: 0;}
  .dv-main-mkt .dv-marketing-online { opacity: 0; -webkit-transition: all 0.2s ease; -moz-transition: all 0.2s ease; -o-transition: all 0.2s ease; -ms-transition: all 0.2s ease; transition: all 0.2s ease; left: -20px; }
  .dv-main-mkt.acti_on .dv-marketing-online { left: 0; opacity: 1; }
  .mkt-nd-ct span { color: <?=$db_que['mau_ten'] != "" ? $db_que['mau_ten'] : '#ff0' ; ?>; }
  .dv-main-mkt.acti_off .dv-marketing-online,
  .dv-main-mkt.acti_on.acti_off .dv-marketing-online { -moz-transition: all 0.5s ease; -o-transition: all 0.5s ease; -ms-transition: all 0.5s ease; transition: all 0.5s ease; left: -70px; opacity: 0; }
  .dv-marketing-online, .dv-marketing-online * { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: "Arial"; margin: 0; padding: 0}
  .dv-marketing-online { background: <?=$db_que['mau_nen'] != "" ? $db_que['mau_nen'] : 'rgb(44, 62, 80)' ; ?> ; width: 400px; border-radius: 10px; display: flex; background-size: cover; background-position: 100%;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1); min-height: 90px; background-repeat: no-repeat; right: 0 !important; position: relative; padding: 10px; max-width: 100%; overflow: hidden;}
  .mkt-img img {display: flex; border-radius: 10px; margin: 5px; font-size: 40px; width: 60px; height: 60px; object-fit: cover; margin-right: 0; }
  .mkt-img { width: 70px; float: left; display: inline-block; }
  .mkt-tieude { padding-bottom: 0; font-size: 13px; font-weight: 700; line-height: 20px; width: 245px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; text-align: left; margin: 0;}
  .mkt-nd { width: calc(100% - 70px); font-size: 12px; line-height: 16px; font-weight: 400; text-align: left; color: <?=$db_que['mau_chu'] != "" ? $db_que['mau_chu'] : '#fff' ; ?>; padding-left: 5px; float: left; display: inline-block; }
  .dv-mkttim {display: none}
  .dv-mkttim .fa { margin-right: 4px; color: <?=$db_que['mau_tim'] != "" ? $db_que['mau_tim'] : '#f93b2f' ; ?>; font-size: 10px; line-height: 10px; }
  .mkt-clear {clear: both}
  .dvmkt-cont { display: flex; align-items: center; font-weight: 700; text-align: center; width: 100%}
  .mkt-nd-ct { margin-bottom: 5px; }

  <?php if($db_que['is_vitri'] == 1){ ?>
    .dv-main-mkt { bottom: auto; top: 170px; }
  <?php } else if($db_que['is_vitri'] == 2){ ?>
    .dv-main-mkt { bottom: auto; top: 170px; left: auto; right: 20px; }
  <?php } else if($db_que['is_vitri'] == 3){ ?>
    .dv-main-mkt { left: auto; right: 20px; }
  <?php } ?>
  @media only screen and (max-width: 479px) {
    .dv-main-mkt { bottom: 15px; left: 15px; }
    .mkt-img img { margin: 0; width: 50px; height: 50px; }
    .mkt-img { width: 57px; }
    .dv-marketing-online { max-width: calc(100% - 20px); min-height: 0; }
  }
</style>
<script>
  var data = [<?=$ndmkt ?>];
  var mkt_numdata       = data.length;
  var time_change       = <?=is_numeric($db_que['time_hien_thi']) ? $db_que['time_hien_thi'] : 60 ?>;
  var time_cho          = <?=is_numeric($db_que['time_cho']) ? $db_que['time_cho'] : 10 ?>;
  var time_run          = 0;
  var mkt_num_data_run  = 0;
  var myrun_time;
  var time_run_lan_dau  = <?=is_numeric($db_que['time_load_lan']) ? $db_que['time_load_lan'] : 5 ?>;

  function mkt_html(mkt_img, mkt_title, mkt_conten){
    return '<div class="dv-marketing-online"><div class="dvmkt-cont"><div class="mkt-img"><img src="'+mkt_img+'" alt=""></div><div class="mkt-nd"><div class="mkt-tieude">'+mkt_title+'</div><div class="mkt-nd-ct">'+mkt_conten+'</div><div class="dv-mkttim"><i class="fa fa-heart"></i><i class="fa fa-heart"></i><i class="fa fa-heart"></i></div></div><div class="mkt-clear"></div></div></div>';
  }
  function run_mktime(){
    myrun_time = setInterval(function(){
      if(time_run_lan_dau > 0) {
        time_run_lan_dau--;
        return false;
      }

      if(mkt_num_data_run >= mkt_numdata) mkt_num_data_run = 0;
      if(time_run == 0) {
        var mkt_img     = data[mkt_num_data_run][2];
        var mkt_title   = data[mkt_num_data_run][0];
        var mkt_conten  = data[mkt_num_data_run][1];

        $(".dv-main-mkt").html(mkt_html(mkt_img, mkt_title, mkt_conten));
        mkt_num_data_run++;
      }

      time_run++;
      if(time_run == 2) {
        $(".dv-main-mkt").addClass("acti_on");
      }
      if(time_run == time_cho) {
        $(".dv-main-mkt").addClass("acti_off");
      }
      if(time_run > time_cho){
        $(".dv-main-mkt").removeClass("acti_on");
        $(".dv-main-mkt").removeClass("acti_off");
        $(".dv-main-mkt").html("");
      }
      if(time_run > time_change) {
        time_run = 0;
      }
    }, 1000);
  }
  run_mktime();
</script>
<div class="dv-main-mkt"></div>
<?php } ?>