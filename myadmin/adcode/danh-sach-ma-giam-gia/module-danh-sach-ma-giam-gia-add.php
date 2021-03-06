<?php
  $table = '#_magiamgia';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD']=='POST')
    {
      foreach ($_POST as $key => $value) {
        ${$key}           = str_replace(".", "", $value);
      }

      $bat_dau            = @explode("/", $bat_dau);
      $ket_thuc           = @explode("/", $ket_thuc);
      $ngay_tao           = @explode("/", $ngay_tao);

      $bat_dau            = @strtotime($bat_dau[2] . "-" . $bat_dau[1] . "-" . $bat_dau[0] . " " . date("00:00:1"));
      $ket_thuc           = @strtotime($ket_thuc[2] . "-" . $ket_thuc[1] . "-" . $ket_thuc[0] . " " . $gio);
      $ngay_tao           = @strtotime($ngay_tao[2] . "-" . $ngay_tao[1] . "-" . $ngay_tao[0] . " " . date("23:59:59"));

      if(isset($_POST['xoa_gr_arr'])){
        foreach ($_POST['xoa_gr_arr'] as $keid) {
          DB_que("DELETE FROM `#_magiamgia_chitiet` WHERE `id` ='".$keid."' LIMIT 1");
        }
      }
    }

  if(!empty($_POST))
    {
      $khong_gioi_han               = isset($_POST['khong_gioi_han']) ? 1 : 0;

      $data                         = array();
      $data['tenbaiviet_vi']        = @$tenbaiviet_vi;
      $data['so_lan_su_dung']       = @$so_lan_su_dung;
      $data['khong_gioi_han']       = @$khong_gioi_han;
      $data['loai_km']              = @$loai_km;
      $data['gia_tri_giam']         = @$gia_tri_giam;
      $data['ap_dung_cho']          = @$ap_dung_cho;
      // $data['gia_tri_ap_dung']      = !empty(${"gia_tri_ap_dung_".$ap_dung_cho}) ? ${"gia_tri_ap_dung_".$ap_dung_cho} : 0;

      $data['ap_dung_khuyen_mail_tren_don_hang'] = @$ap_dung_khuyen_mail_tren_don_hang;

      $data['bat_dau']              = $bat_dau;
      $data['ket_thuc']             = $ket_thuc;
      $data['ngay_tao']             = $ngay_tao;
      $data['catasort']             = $catasort;
      $mgg_soluong  = is_numeric($mgg_soluong) ? $mgg_soluong : 0;



      if($id == 0){
        $id                           = ACTION_db($data, $table , 'add', NULL, NULL);
        $_SESSION['show_message_on']  = "Th??m m?? gi???m gi?? th??nh c??ng!";
      }else{
        ACTION_db($data, $table , 'update', NULL, "`id` = '$id'");
        $_SESSION['show_message_on']  = "C???p nh???t m?? gi???m gi?? th??nh c??ng!";
      }

      if($mgg_soluong > 0){
        //them mgg
        if($loai_tao_km == 1){
          if($mgg_soluong > 0){
            for ($i=0; $i < $mgg_soluong; $i++) {
              $data_1                       = array();
              $data_1["id_parent"]          = $id;
              $data_1["ma_giam_gia"]        = $mgg_tiento.RANDOM_chuoi(8);
              $data_1["so_lan_su_dung"]     = 0;
              $data_1["tong_su_dung"]       = $khong_gioi_han == 1 ? 0 : $so_lan_su_dung;
              ACTION_db($data_1, "#_magiamgia_chitiet" , 'add', NULL, NULL);
            }
          }
        }
        else if($loai_tao_km == 2){
          $mm_magiamgia_ds = explode("\n", $mm_magiamgia_ds);
          foreach ($mm_magiamgia_ds as $val) {
            $data_1                       = array();
            $data_1["id_parent"]          = $id;
            $data_1["ma_giam_gia"]        = $val;
            $data_1["so_lan_su_dung"]     = 0;
            $data_1["tong_su_dung"]       = $khong_gioi_han == 1 ? 0 : $so_lan_su_dung;
            ACTION_db($data_1, "#_magiamgia_chitiet" , 'add', NULL, NULL);
          }
        }
      }
      LOCATION_js($url_page."?module=main-module&action=danh-sach-ma-giam-gia&edit=".$id);
      exit();
      // $_SESSION['show_message_off'] = 'L???i t???o m?? gi???m gi??!';

    }


  if($id > 0)
    {
      $sql_se             = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se             = DB_arr($sql_se, 1);
      foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
      }
      $catasort           = number_format($catasort,0,',','.');
    }
    else
    {
      $catasort   = layCatasort($table);
      $catasort   = number_format(SHOW_text($catasort),0,',','.');
      $id_parent  = 0;
      $edit       = 0;
    }
?>

<section class="content-header">
  <h1>Danh s??ch m?? gi???m gi??</h1>
  <ol class="breadcrumb">
      <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang ch???</a></li>
      <li class="active">Qu???n l?? m?? gi???m gi??</li>
  </ol>
</section>
<style>
  label {margin-bottom: 10px !important}
  .dv-ds-mmb-tao table { margin: 0 !important; font-size: 13px !important; }
  .form_create .box table { font-size: 13px !important; }
  .dv-gr-lb { display: inline-block; border: 1px solid #ccc; background: #f5f5f5; }
  .dv-gr-lb > input { width: 180px; float: left; border: none; border-right: 1px solid #ccc; }
  .dv-gr-lb > label { float: left; padding: 7px; margin: 0 !important; font-weight: 500; }
  .mauxam { background: #f5f5f5 !important; }
  .dv-grp-left{}
  .dv-grp-left select{float: left;}
  .dv-grp-left span { padding: 7px 10px; display: inline-block; float: left; }
  .dv-grp-left input{}
  .dv-grp-left .dv-gr-lb { float: left; }
  .js_ap_dung_cho{display: none; margin-left: 10px; float: left;}
  .dv-full-task { width: 100%; float: left; margin-top: 10px; display: none}
  .dv-full-task span { padding-left: 0; min-width: 162px; display: inline-block; }
  .dv-grp-left select { float: left; width: auto; }
  .input-group-date label{ margin-right: 10px; font-weight: 500 }
  .dv-magiamgia-nhom { display: none; border: 1px dashed #ccc; padding: 10px; border-radius: 7px; margin-top: 10px; }
  .p_chuthich { color: #a0a0a0; }
  p.p_chuthich { margin-bottom: 0; margin-top: 3px; }
  .ul_list_sp_timkiem { list-style: none; background: #fff; padding: 0; border: 1px solid #ccc; margin-top: 2px; position: absolute; z-index: 99; height: 200px; overflow-y: auto; width: 235px; display: none}
  .ul_list_sp_timkiem li { margin: 7px; border-bottom: 1px dashed #dedede; }
  .ul_list_sp_timkiem li img { width: 40px; height: auto; float: left; }
  .ul_list_sp_timkiem li h3 { margin: 0; padding: 0; font-size: 13px; width: calc(100% - 50px); float: left; margin-left: 10px; font-weight: 500; line-height: 1.5; height: 40px; overflow: hidden; }
  .ul_list_sp_timkiem li p { width: calc(100% - 50px); float: left; margin: 0; margin-left: 10px; color: #757575; font-size: 12px; margin-top: 3px; }
</style>
<form id="form_submit" name="form_submit" action="" method="post"  enctype='multipart/form-data'>
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="h2_title">
                <i class="fa fa-pencil-square-o"></i>Danh s??ch m?? gi???m gi?? > <?=$id > 0 ? 'S???a' : 'Th??m' ?> m?? gi???m gi??
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Th??m m???i</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tho??t</a>
            </h3>
          </div>
          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                  <label>T??n chi???n d???ch khuy???n m??i</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
                </div>
                <div class="form-group">
                  <label>Nh???p s??? l???n s??? d???ng c???a m?? khuy???n m??i?</label>
                  <div class="dv-grup-lable">
                    <div class="dv-gr-lb">
                      <input type="number" name="so_lan_su_dung" id="so_lan_su_dung" value="<?=!empty($so_lan_su_dung) ? $so_lan_su_dung : 1 ?>" <?=@!empty($khong_gioi_han) && $khong_gioi_han == 1 ? 'disabled class="mauxam"' : "" ?>>
                      <label>
                        <input type="checkbox" name="khong_gioi_han" onclick="CHECK_disable(this, '#so_lan_su_dung')" <?=@!empty($khong_gioi_han) && $khong_gioi_han == 1 ? 'checked="checked"' : "" ?>> Kh??ng gi???i h???n
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box p10">
              <div class="form-group">
                <label>Lo???i khuy???n m??i</label>
                <div class="dv-grp-left">
                  <select name="loai_km" class="form-control" style="width: auto" onchange="SET_giatrigiam(this)">
                      <option value="0" <?=isset($loai_km) && $loai_km == 0 ? 'selected="selected"' : "" ?>>VND</option>
                      <option value="1" <?=isset($loai_km) && $loai_km == 1 ? 'selected="selected"' : "" ?>>% Gi???m</option>
                      <!-- <option value="2">Mi???n ph?? v???n chuy???n</option> -->
                  </select>
                  <span class="sp_js_gtri_giam">Gi???m</span>
                  <div class="dv-gr-lb">
                    <input type="text" name="gia_tri_giam" style="width:150px" onkeyup="SetCurrency(this)" value="<?=!empty($gia_tri_giam) ? NUMBER_fomat($gia_tri_giam) : 0 ?>">
                    <label class="lb_js_gtri_giam"><?=isset($loai_km) && $loai_km == 1 ? '%' : "??" ?></label>
                  </div>
                  <!-- <div class="dv-apdungcho">
                    <span>??p d???ng cho</span>
                    <select name="ap_dung_cho" class="form-control" style="width: auto" onclick="LOAD_apdungcho(this)">
                        <option value="0">T???t c??? ????n h??ng</option>
                        <option value="1">Tr??? gi?? ????n h??ng t???</option>
                        <option value="3">S???n ph???m</option>
                    </select>
                    <div class="div_js_ap_dung_cho">
                      <div class="js_ap_dung_cho js_ap_dung_cho_1">
                        <div class="dv-gr-lb">
                          <input type="text" name="gia_tri_ap_dung_1" style="width:150px" onkeyup="SetCurrency(this)">
                          <label>??</label>
                        </div>
                      </div>
                      <div class="js_ap_dung_cho js_ap_dung_cho_3">
                        <input type="text" name="gia_tri_ap_dung_3" id="gia_tri_ap_dung_3" style="width: 150px; display: none" placeholder="Nh???p ID s???n ph???m">
                        <input type="text" id="id_text_search" placeholder="Nh???p t??n ho???c m?? s???n ph???m" style="width: 220px;" onkeyup="TIMKIEM_ajax(this)" onclick="TIMKIEM_ajax(this)">
                        <ul class="ul_list_sp_timkiem"></ul>
                        <script>
                          function TIMKIEM_ajax(obj){
                            $(".ul_list_sp_timkiem").hide();
                            $.ajax({
                                type: "POST",
                                url: "index.php",
                                data: {
                                    'id': $(obj).val().trim(),
                                    "ajax_action": "check_sanpham"
                                },
                                success: function(data) {
                                  if(data != ""){
                                    $(".ul_list_sp_timkiem").html(data);
                                    $(".ul_list_sp_timkiem").show();
                                  }
                                }
                            });
                          }
                          function ADD_idig(id, obj){
                            $(".ul_list_sp_timkiem").hide();
                            $("#gia_tri_ap_dung_3").val(id);
                            $("#id_text_search").val($("h3", obj).text());
                          }

                        </script>
                      </div>
                    </div>
                    <div class="dv-full-task">
                      <span>??p d???ng m?? khuy???n m??i</span>
                      <select name="ap_dung_khuyen_mail_tren_don_hang" class="form-control" >
                          <option value="0">1 s???n ph???m tr??n 1 ????n h??ng</option>
                          <option value="1">Cho t???ng s???n ph???m trong gi??? h??ng</option>
                      </select>
                    </div>
                    <div class="clear"></div>
                  </div> -->
                  <div class="clear"></div>
                </div>
              </div>
            </div>
            <div class="box p10">
              <div class="form-group">
                <label>B???t ?????u khuy???n m??i</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="bat_dau" type="text" class="form-control pull-right datepicker" id="datepicker2" value='<?=!empty($bat_dau) ? date("d/m/Y", $bat_dau) : date("d/m/Y", time()) ?>'>
                </div>
              </div>
              <div class="form-group">
                <label>H???t h???n khuy???n m??i</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="ket_thuc" type="text" class="form-control pull-right datepicker" id="datepicker3" value='<?=!empty($ket_thuc) ? date("d/m/Y", $ket_thuc) : date("d/m/Y", time()+5*24*60*60) ?>'>
                </div>
              </div>
            </div>
            <div class="box p10">
              <div class="form-group">
                <label>T???o m?? t??? ?????ng ho???c nh???p th??? c??ng?</label>
                <div class="input-group-date">
                  <label>
                    <input type="radio" name="loai_tao_km" value="1" checked onclick="CHON_nhomgiamgia(this)"> T???o m?? gi???m gi?? s??? d???ng m???t ti???n t???
                  </label>
                  <label>
                    <input type="radio" name="loai_tao_km" value="2" onclick="CHON_nhomgiamgia(this)"> Nh???p m?? gi???m gi?? th??? c??ng
                  </label>
                </div>
                <div class="dv-magiamgia-nhom dv-magiamgia-nhom-1" style="display: block">
                  <div class="form-group">
                    <label>Ti???n t??? m?? gi???m gi??</label>
                    <input type="text" class="form-control" name="mgg_tiento">
                    <p class="p_chuthich" style="margin-top: 10px">V?? d??? m?? d???a tr??n ti???n t??? c???a b???n:</p>
                    <p class="p_chuthich">PO8I77OEDS0CA136</p>
                  </div>
                  <div class="form-group">
                    <label>S??? l?????ng m?? b???n mu???n t???o ra</label>
                    <input type="number" class="form-control"  name="mgg_soluong" value="0">
                  </div>
                </div>
                <div class="dv-magiamgia-nhom dv-magiamgia-nhom-2">
                  <div class="form-group">
                    <label>Nh???p m?? th??? c??ng theo ?? b???n <span class="p_chuthich">(cho t???t c??? c??c d??ng gi???m gi?? s??? ???????c t???o ra)</span></label>
                    <textarea class="form-control" style="height:120px" name="mm_magiamgia_ds" placeholder="Enter xu???ng d??ng ????? t???o th??m m?? gi???m gi??"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <?php if($id > 0){ ?>
            <div class="box p10">
              <div class="form-group">
                <label>Danh s??ch m?? gi???m gi?? ???? t???o</label>
                <div class="dv-ds-mmb-tao">
                  <table class="table table-hover table-danhsach">
                    <tbody>
                      <tr>
                        <th class="w80 text-center">STT</th>
                        <th>M?? gi???m gi?? </th>
                        <th style="width: 20%" class="text-center">S??? d???ng</th>
                        <th class="w100 text-center">
                          <label>
                            <input type='checkbox' class='minimal cls_showxoa_all'> X??a
                            <input type="hidden" name="token" value="<?=GET_token() ?>">
                          </label>
                        </th>
                      </tr>
                      <?php
                        $cl         = 0;
                        $sql     = DB_que("SELECT * FROM `#_magiamgia_chitiet` WHERE `id_parent` = '".$id."' ORDER BY `id` ASC");
                        $sql     = DB_arr($sql);
                        foreach ($sql as $rows) {
                          $cl++;
                      ?>
                      <tr>

                        <td class="text-center">
                          <?=$cl ?>
                        </td>
                        <td>
                          <div class="name">
                            <?=$rows['ma_giam_gia'] ?>
                          </div>
                        </td>
                        <td class="text-center">
                          <?=$rows['so_lan_su_dung']."/".$rows['tong_su_dung'] ?>
                        </td>
                        <td class="text-center">
                          <input name='xoa_gr_arr[]' value="<?=$rows['id'] ?>" type='checkbox' class='minimal cls_showxoa' style="float: none;">
                        </td>
                      </tr>
                    <?php  } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <section class="col-lg-12">
        <div class="box p10">
          <div class="form-group">
            <label>Ng??y t???o</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="ngay_tao" type="text" class="form-control pull-right datepicker" id="datepicker" value='<?=!empty($ngay_tao) ? date("d/m/Y", $ngay_tao) : date("d/m/Y", time()) ?>'>
            </div>
          </div>
          <div class="form-group">
            <label>S??? th??? t???</label>
            <input type="text" class="form-control" name="catasort" id="catasort" value="<?=SHOW_text($catasort)?>" onkeyup="SetCurrency(this)">
          </div>
        </div>
      </section>
    </div>
  </section>

  <div class="box-header mb-60">
  <h3 class="box-title box-title-td pull-right">
    <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
    <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Th??m m???i</a>
    <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tho??t</a>
  </h3>
</div>
</form>
<script>
  function checkSubmit(){
    if($("#tenbaiviet_vi").val().trim() == '')
    {
      alert("H??y nh???p t??n m?? gi???m gi??!");
      $("#tenbaiviet_vi").focus();
      return false;
    }
    return true;
  };
  function CHECK_disable(obj, id){
    if($(obj).is(":checked")){
      $(id).prop('disabled', true);
      $(id).addClass("mauxam");
    }
    else{
      $(id).prop('disabled', false);
      $(id).removeClass("mauxam");
    }
  };
  function LOAD_apdungcho(obj){
    $(".js_ap_dung_cho").hide();
    $(".js_ap_dung_cho_"+$(obj).val()).show();
    if($(obj).val() == 2 || $(obj).val() == 3){
      $(".dv-full-task").show();
    }else{
      $(".dv-full-task").hide();
    }
  };

  function CHON_nhomgiamgia (obj){
    $(".dv-magiamgia-nhom").hide();
    $(".dv-magiamgia-nhom-"+$(obj).val()).show();
  };
  function SET_giatrigiam(obj){
    $(".dv-apdungcho").show();
    var val = $(obj).val();
    $(".sp_js_gtri_giam").html("Gi???m");
    $(".lb_js_gtri_giam").html("??");
    if(val  == 1) {
      $(".lb_js_gtri_giam").html("%");
    }
    if(val  == 2) {
      $(".sp_js_gtri_giam").html("V???i ????n h??ng l???n h??n ho???c b???ng");
      $(".dv-apdungcho").hide();
    }
  };
</script>