<?php 
    $numview  = 30;
    if($motty == "lich-su-mua-hang"){
      $pzer                 = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    }
    else {
      $pzer                 = isset($_POST['page']) && is_numeric($_POST['page']) ? $_POST['page'] : 1;
    }

    $vi_tri                 = PHANTRANG_start($pzer, $numview);
    if ($pzer               == 1 || $pzer == NULL) 
        $pzz                = 0;
    else $pzz               = $pzer * $numview;

    if(empty($wh)) $wh = "";


    $nd_kietxuat = DB_que("SELECT * FROM `#_order` WHERE 1 = 1 $wh  ORDER BY `id` DESC LIMIT $vi_tri,$numview");
    $nd_total    = DB_que("SELECT * FROM `#_order` WHERE 1 = 1 $wh ");

    $nd_total        = @mysqli_num_rows($nd_total);
    $numshow        = ceil($nd_total / $numview);
    $sotrang        = PHANTRANG_findPages($nd_total, $numview);

    if(!mysqli_num_rows($nd_kietxuat)) echo "<div class='dv-notfull-cart'>".$glo_lang['khong_tim_thay_don_hang_nao']."</div>";
    else{
      echo '<div class="dv-donhhang dv-dangnhap ">
            <div id="cart_list" style="margin: 0; line-height: 1.7">
              <div class="dv-table-reposive tb_rps">
                <table width="100%" border="0" cellspacing="1" cellpadding="5" class="tb-bg-fff">
                  <tbody><tr>
                    <th width="10px">'.$glo_lang['stt'].'</th>
                    <th>'.$glo_lang['ma_dh'].'</th>
                    <th width="20%">'.$glo_lang['ngay_dat'].'</th>
                    <th width="20%" class="text-center">'.$glo_lang['cart_thanhtien'].'</th>
                  </tr>';
                  
                    $stt = 0;
                    while ($rows = mysqli_fetch_assoc($nd_kietxuat)) {
                      $stt++;
                      $soluong  = explode(",", $rows['soluong']);
                      $dongia   = explode(",", $rows['dongia']);
                      $is_key     = explode('|', $rows['is_key']);

                      $thanhtien = 0;
                      $soluong_num = count($soluong);
                      for ($i=0; $i < $soluong_num; $i++) { 
                        $thanhtien += $soluong[$i] * $dongia[$i];
                      }
 
                  echo '<tr>
                      <td class="text-center" title="'.$glo_lang['stt'].'">
                        '.($stt + ($pzer - 1) * $numview ).'
                      </td>
                      <td title="'.$glo_lang['ma_dh'].'">
                        <p><span style="color: red; float: left; margin-right: 5px;"><a class="cur is_red" onclick="LOAD_popup_new(\''.$full_url.'/pa-size-child/load-dh/?id='.$rows['id'].'\', \'1200px\')">'.$rows['madh'].'</a></span>
                        '.TRANGTHAI_donhang($rows['trangthai'], $glo_lang).'</p>
                        <p class="thanhtoan">'.($rows['thanh_toan'] == 0 ? $glo_lang['don_hang_chua_duoc_thanh_toan'] : $glo_lang['don_hang_da_thanh_toan']).'</p>
                        <p class="p_xemchitiet"><a class="cur" onclick="LOAD_popup_new(\''.$full_url.'/pa-size-child/load-dh/?id='.$rows['id'].'\', \'1200px\')"><i class="fa fa-angle-double-right" ></i>'.$glo_lang['chi_tiet_don_hang'].'</a></p>
                      </td>
                      <td title="'.$glo_lang['ngay_dat'].'">'.date('d-m-Y H:i', $rows['ngaydat']).'</td>
                      <td title="'.$glo_lang['cart_thanhtien'].'" class="text-center">'.NUMBER_format($thanhtien).' '.$glo_lang['dvt'].'</td>
                    </tr>';
                   } 
                  echo '</tbody>
                </table> 
              </div>
              <div class="clr"></div> 
            </div>
            </div>';
          }
?>
<div class="clr"></div>
<?php if($motty == "lich-su-mua-hang"){ ?>
<div class="nums no_box">
    <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
  <div class="clr"></div>
</div>
<?php }else { ?>
<div class="nums no_box">
  <ul>
    <?=PHANTRANG_ajax($pzer, $sotrang, @$list) ?>
  </ul>
  <div class="clr"></div>
</div>
<?php } ?>