<?php
  if(isset($_POST['xoa_sp']))
  {
      if(isset($_SESSION['cart'][$_POST['id_die']])) unset($_SESSION['cart'][$_POST['id_die']]);
      if(count($_SESSION['cart']) == 0) unset($_SESSION['cart']);
  } 

  if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
    $_SESSION['cart'][$_GET['id']] = 1;
    LOCATION_js($full_url."/gio-hang/");
  }

  if(isset($_POST['id'])){
    $id = isset($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : 0;
    if($id == 0) {
      LOCATION_js($full_url."/gio-hang/");
      exit();
    } 
    $tinhnang = "";
    for ($i=1; $i <= 100; $i++) {
      if(isset($_POST['tinhnang_'.$i])) {
        $tinhnang .= $tinhnang == "" ? trim($_POST['tinhnang_'.$i]) : ','.trim($_POST['tinhnang_'.$i]);
      }

    }
    $_SESSION['tinhnang'][$id."_".md5($tinhnang)] = $tinhnang;

    if(isset($_POST['qty_cart']) && is_numeric($_POST['qty_cart']) && $_POST['qty_cart'] > 0){
      $_SESSION['cart'][$id."_".md5($tinhnang)] = $_POST['qty_cart'];
    }
    else{
      $_SESSION['cart'][$id."_".md5($tinhnang)] = 1;
    }

    if(isset($_POST['js_muangay']) && $_POST['js_muangay'] == 1){
      LOCATION_js($full_url."/dat-hang");
      exit();
    }
    LOCATION_js($full_url."/gio-hang");
    exit();
  }

  // print_r($_SESSION['cart']);
  // unset($_SESSION['cart']);

  $thongtin_step   = LAY_anhstep_now(LAY_id_step(1));
?>
<!-- <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><span>/</span><a href="<?=$full_url."/gio-hang" ?>"><?=$glo_lang['gio_hang'] ?></a></li> -->


<div class="page_conten page_conten_cart">
  <div class="pagewrap">
    <div class="title_page_home">
      <h3><?=$glo_lang['gio_hang'] ?></h3>
     
      <div class="clr"></div>
    </div>
    <div class="pagewrap page_conten_page page_conten_page_dh" style="padding-top: 0">
      <!--  -->
        <div class="dv-gio-hang">
        <!--  -->
          <?php 
            $link_cart = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
            if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
            {
          ?>
              <div class="cart-empty"><?=$glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang'] ?></div>
              <div class="continue-shopping"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="<?=$link_cart ?>"><?=$glo_lang['tiep_tuc_mua_hang']  ?></a></div>
          <?php
            }
            else
            { 
          ?>
          <div id="cart_list" class="tb_rps">
              <div class="dv-table-reposive dv-table-reposive-cart">
                <table width="100%" border="0" cellspacing="1" cellpadding="5">
                  <tr>
                    <!-- <th class="cls_cart_mb" width="5%">STT</th> -->
                    <th><?=$glo_lang['cart_ten_sp'] ?></th>
                    <th width="10%" class="text-center"><?=$glo_lang['cart_qty'] ?></th>
                    <th width="15%" style="text-align:right"><?=$glo_lang['cart_dongia'] ?></th>
                    <th width="15%" style="text-align:right"><?=$glo_lang['cart_thanhtien'] ?></th>
                    <th width="10%" class="text-center"><?=$glo_lang['cart_thaotac'] ?></th>
                  </tr>
                  <?php 
                    $tongtien      = 0;
                    $stt           = 0;
                    $tinhnang_arr  = LAY_bv_tinhnang(2);
                    foreach ($_SESSION['cart'] as $key => $value)  {
                      $id_sp     = explode("_", $key);
                      $id_sp     = $id_sp[0];
                      $stt       ++;
                      $sanpham   = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '".$id_sp."' LIMIT 1");
                      if(mysqli_num_rows($sanpham) > 0) {
                        $sanpham    = mysqli_fetch_assoc($sanpham);
                        $dongia     = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);

                        $thanhtien  = $dongia * $value;
                        $tongtien  += $thanhtien;

                        // lay hinh
                        $anhsp = checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin'], 'thumb_');
                        $check_sl_tinhnang  = DB_fet_rd("* "," `#_baiviet_select_tinhnang` ","`id_baiviet` = '".$id_sp."'","","","id_val");

                        $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                        if(is_array($isthuoctinh)) {
                          foreach ($isthuoctinh as $ittinh) { 
                            if(@$check_sl_tinhnang[$ittinh]['icon'] == "") continue;
                            $anhsp = checkImage($fullpath, $check_sl_tinhnang[$ittinh]['icon'], $check_sl_tinhnang[$ittinh]['duongdantin']);
                            break;
                          }
                        }
                        // 
                  ?>
                   <tr>
                      <!-- <td class="cls_cart_mb" ><?=$stt ?></td> -->
                      <td style="text-align:left" title="<?=$glo_lang['cart_ten_sp'] ?>" class="dv-anh-cart-sp">
                        <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><img src="<?=$anhsp ?>" alt="<?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?>"/></a>
                        <div class="dv-anh">

                          <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?></a>
                          <p><?=SHOW_text($sanpham['p1']) ?></p>
                          <p class="p_mota_cart">
                            <?php
                            // foreach ($tinhnang_arr as $tnr) {
                            //    echo '<span>'.$tnr['tenbaiviet_'.$lang].'</span>';
                            // }
                            ?>
                            <?php
                              $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                              if(is_array($isthuoctinh)) {
                                foreach ($isthuoctinh as $ittinh) { 
                                  if(@$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang] == "") continue;
                                  echo '<span>'.$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang].'</span>';
                                }
                              }
                            ?>
                          </p>
                        </div>
                      </td>
                      <td  title="<?=$glo_lang['cart_qty'] ?>">
                        <div class="mobileqty no_box">
                          <!-- <input type='button' value='-' class='qtyminus' onclick="add_num_sp('#product-quantity-<?=$id_sp ?>',-1); updateQty_notthis('<?=$full_url."/update-qty/" ?>', '<?=$id_sp ?>');" /> -->
                          <input type='text' min="1" max="9999" name='quantity' value='<?=$value ?>' class='qty qty_is_soluong' id="product-quantity-<?=$id_sp ?>" onchange='updateQty("<?=$full_url."/update-qty/" ?>","<?=$key ?>", this)' style="width: 50px" />
                          <!-- <input type='button' value='+' class='qtyplus' onclick="add_num_sp('#product-quantity-<?=$id_sp ?>',+1); updateQty_notthis('<?=$full_url."/update-qty/" ?>', '<?=$id_sp ?>');" /> -->
                      </div>

                      </td>
                      <td style="text-align:right" title="<?=$glo_lang['cart_dongia'] ?>"><b><?=($dongia == 0) ? 0 : NUMBER_fomat($dongia)." ".$glo_lang['dvt'] ?></b></td>
                      <td style="text-align:right" title="<?=$glo_lang['cart_thanhtien'] ?>"><b><span class="td_thanhtien_<?=$key ?>"><?=($thanhtien== 0)  ? 0 : NUMBER_fomat($thanhtien) ?></span> <?=$glo_lang['dvt'] ?></b></td>
                      <td title="<?=$glo_lang['cart_thaotac'] ?>">
                        <form action="" method="post">
                          <input type="hidden" name="id_die" value="<?=$key ?>" a>
                          <button type="submit" class="pro_del" name="xoa_sp" onclick="return confirm('<?=$glo_lang['ban_that_su_muon_xoa'] ?>')"><?=$glo_lang['cart_xoa'] ?></button>
                        </form>
                      </td>
                    </tr>
                  <?php  } } ?>
                </table>
              </div>
              <div class="clr"></div>
              <div class="dv-tongtien no_box">
                <input type="hidden" class="cls_datafalse" value="<?=$glo_lang['alert_dat_hang'] ?>">
                <span id="pro_sum"><?=$glo_lang['cart_tong_tien'] ?>:
                <label class='tb_tongtien'><?=($tongtien == 0) ? "0": NUMBER_fomat($tongtien)." ".$glo_lang['dvt'] ?></label>
                </span>
              </div>
              <div class="clr"></div>
              <div class="dv-btn-cart no_box formBox">
                <a href="<?=$link_cart ?>" class="pro_del button mar"><?=$glo_lang['tiep_tuc_mua_hang'] ?></a> 
                <a onclick="cap_nhat_so_luong()" class="cur button pro_del mar"><?=$glo_lang['cap_nhat_so_luong'] ?><img src="images/loading2.gif" class="ajax_img_loading"></a> 
                <a href="<?=$full_url?>/dat-hang/" class="pro_del button mar"><?=$glo_lang['gui_don_hang'] ?></a>
              </div>
            <div class="clr"></div>
          </div>
          <?php } ?>
          <!--  -->
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $(".dangky_giohang ul h3 a, .is_num_cart").html("<?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo "0"; ?>");
  })
</script>