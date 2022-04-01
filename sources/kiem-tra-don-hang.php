<?php 
    $bre = isset($_GET['view']) ? @$glo_lang['chi_tiet_don_hang'] :  @$glo_lang['kiem_tra_don_hang'];
    if(empty($thongtin_step)){
      $thongtin_step['id'] = 1;
    }
    $thongtin_step   = LAY_anhstep_now($thongtin_step['id']);
    if($motty == 'lich-su-mua-hang') {
      $bre  = $glo_lang['lich_su_mua_hang'];
    }

    // if($motty == "lich-su-mua-hang" && empty($_SESSION['id'])) {
    //   LOCATION_js($fullpath.'/signin/');
    //   exit();
    // }
?>
<!-- <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><span>/</span><a href="<?=$full_url."/gio-hang" ?>"><?=$bre ?></a></li> -->
<div class="link_title">
  <div class="pagewrap">
    <ul>
      <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><span>/</span><a href="<?=$full_url."/gio-hang" ?>"><?=$bre ?></a></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="titile_page">
  <div class="pagewrap">
    <!-- <div class="title_page_home">
      <h3><?=$bre ?></h3>
     
      <div class="clr"></div>
    </div> -->
    <!-- <div class="title_page_id"><?=$bre ?></div> -->
    <!--  -->
    <div class="kiemtra_donhang no_box">
      <ul>
        <?php if($motty != "lich-su-mua-hang"){ ?>
        <div class="dv_kiemtra_donhang_cont">
          <li>
            <span><i class="fa fa-chain-broken" aria-hidden="true"></i><?=@$glo_lang['nhap_ma_don_hang'] ?>:</span>
            <input type="text" name="cont_cmnd" class="cls_madh_s form-control" placeholder="VD: DH123456 *">
          </li>
          <li>
            <span><i class="fa fa-envelope" aria-hidden="true"></i><?=@$glo_lang['hoac_so_dien_thoai_va_mail_dat_hang'] ?>:</span>
            <input type="text" name="cont_cmnd" class="cls_email_sdt form-control" placeholder="VD: abc...@gmail.com *">
          </li>
          <div class="clr"></div>
          <h4><a onclick="load_check_dh()" class="cur"><?=$glo_lang['kiem_tra'] ?></a></h4>
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
        <div class="dv-load-hd-js dv-load-hd-js-top">
          <?php 
            if($motty == "lich-su-mua-hang"){ 
              $wh = " AND  `iduser` = '".$_SESSION['id']."'";
              include _source."kiem-tra-don-hang-list.php";
          ?>
          <?php } ?>
        </div>
        <div class="dv-load-hd-js-new dv-load-hd-js"></div>
        <script>
          function load_check_dh(){
            var madh  = $(".cls_madh_s").val();
            var email = $(".cls_email_sdt").val();
            var list = madh+"|"+email;
            LOAD_sp_ajax(1, list);
          }
          function LOAD_sp_ajax(page, list){
            $(".dv-load-hd-js-new").html('<img src="images/loadernew.gif" alt="" style="height: 30px; padding: 0 5px;">');
            $.ajax({
              type: "POST",
              url: full_url + "/check_donhang/",
              data: {"list": list, "page": page},
              success: function(response)
              { 
                $(".dv-load-hd-js-new").html(response);
              }
            });
          };
        </script>
      </ul>
    </div>
    <!--  -->
  </div>
</div>