<?php
  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-ma-giam-gia-add.php";
  }
  else{
    $table      = '#_magiamgia';
    $table_slug = str_replace("#_", "", $table);
    if(isset($_GET['del']))
    {
      $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1"); 

      if(DB_num($sql_se) > 0)
      {
        $sql_se   = DB_arr($sql_se);
        $del_name = $sql_se['tenbaiviet_vi'];
        DB_que("DELETE FROM $table WHERE `id` ='".$_GET['catalogid']."' LIMIT 1");
        //xoa pr child
        $sql_se_c1    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$_GET['catalogid']."'");
        $sql_se_c1    = DB_arr($sql_se_c1);
        foreach ($sql_se_c1 as $row_1) {
            DB_que("DELETE from $table WHERE `id`  = '".$row_1['id']."' LIMIT 1");
          }
        //
        $_SESSION['show_message_on'] = 'Xóa mã giảm giá [<strong>'.$del_name.'</strong>] thành công';
      } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
      LOCATION_js($url_page);
      exit();
    }


    $numview  = 15;
    $pz  = 0;
    $pzz = 0;

    if(isset($_GET['pz'])){
      $pz       = $_GET['pz'];
      if($pz    == "" || $pz == 0)  $pzz = 0;
      else $pzz = $pz * $numview;
    }

    $sql     = DB_que("SELECT * FROM `$table` ORDER BY `id` DESC LIMIT $pzz,$numview");
    $sql_num = DB_que("SELECT * FROM `$table` ");

    $numlist = @DB_num($sql_num);
    $numshow = ceil($numlist/$numview);
 

?>
<section class="content-header">
    <h1> Danh sách mã giảm giá</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách mã giảm giá</li>
    </ol>
</section>

<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                      <h2 class="h2_title">
                          <i class="fa fa-pencil-square-o"></i> Danh sách mã giảm giá
                      </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w80 text-center">STT</th>
                            <th>Chiến dịch giảm giá</th>
                            <th style="width: 20%" class="text-center">Tổng số mã đã tạo</th>
                            <th style="width: 20%" class="text-left">Bắt đầu/ Kết thúc</th>
                          </tr>
                          <?php
                            $cl                 = 0;
                            $token              = GET_token();
                            $sql = DB_arr($sql);
                            foreach ($sql as $rows) {
                              $cl++;

                              $ida                = SHOW_text($rows['id']);
                              $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                              $catasort           = SHOW_text($rows['catasort']);
                              $catasort           = SHOW_text($rows['catasort']);
                              $bat_dau            = SHOW_text($rows['bat_dau']);
                              $ket_thuc           = SHOW_text($rows['ket_thuc']);
                              $loai_km            = SHOW_text($rows['loai_km']);
                              $gia_tri_giam       = SHOW_text($rows['gia_tri_giam']);
                              $ap_dung_cho        = SHOW_text($rows['ap_dung_cho']);
                              $gia_tri_ap_dung    = SHOW_text($rows['gia_tri_ap_dung']);
                              $ap_dung_khuyen_mail_tren_don_hang    = SHOW_text($rows['ap_dung_khuyen_mail_tren_don_hang']);
                              $soma_giamgia       = DB_que("SELECT `id` FROM `#_magiamgia_chitiet` WHERE `id_parent` = '$ida'");
                          ?>
                          <tr>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <?=$cl ?>
                            </td>
                            
                            <td>
                              <div class="name">
                                <a href="?module=quan-ly-thanh-toan&action=danh-sach-ma-giam-gia&edit=<?=$ida ?>"><?=$tenbaiviet_vi?></a>
                              </div>
                              <p style="color: #8a8a8a; margin-top: 2px;">
                                <?=DB_num($soma_giamgia) ?> mã giảm giá 
                                <?php 
                                  if($loai_km == 2){
                                    echo " miễn phí vận chuyển với đơn hàng lớn hơn hoặc bằng ".NUMBER_fomat($gia_tri_giam).' đ';
                                  }
                                  else if($loai_km == 0 || $loai_km == 1){
                                    echo " giảm ".NUMBER_fomat($gia_tri_giam).($loai_km == 0 ? ' đ' : " %");                                 
  
                                  }
                                ?>
                              </p>
                            </td>
                            <td class="text-center"><?=DB_num($soma_giamgia) ?></td>
                            <td class="text-left">
                              <span style="color: #8a8a8a; font-size: 12px; width: 52px; display: inline-block;">Bắt đầu:</span> <?=date("d-m-Y", $bat_dau) ?></br>
                              <span style="color: #8a8a8a; font-size: 12px; width: 52px; display: inline-block;">Kết thúc:</span> <?=date("d-m-Y", $ket_thuc) ?>
                            </td>
                          </tr>
                          
                        <?php  } ?> 
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <div class="paging_simple_numbers">
                        <ul class="pagination">
                          <?php
                            PHANTRANG_admin($numshow, $url_page, $pz);
                          ?>
                        </ul>
                      </div>
                      <h3 class="box-title box-title-td pull-right">
                          <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>