<header>
    <div class="header_top" >
        <div class="container">
            <div class="box_header_top ">
              <div class="left_header_top">
                <?=$glo_lang['hotline'] ?>: <?php 
                    $hotline_vi = explode("|", $thongtin['hotline_vi']);
                $i = 0;
                foreach ($hotline_vi as $val) {
                  $i++;
                  if($i > 1) echo ' - ';
                  echo '<a href="tel:'.$val.'">'.$val.'</a>';
                }
              ?>
              </div>
               <div class="right_header_top">
                  <ul class="no_style">
                    <?php
                        $thuoctinh = LAY_thuoctinhchung();
                        foreach ($thuoctinh as $rows) {
                            echo '<li><a '.full_href($rows).'>'.SHOW_text($rows['tenbaiviet_'.$lang]).'</a></li>';
                        }
                    ?>
                  </ul>
                  <?php include _source."lang.php"; ?>
              </div>
              <div class="clr"></div>
            </div>
        </div>
    </div>

    <div class="header_bottom" >
        <div class="container">
            <div class="box_header_bottom  item_center ">
                <div class="logo_website">
                    <a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt=""></a>
                </div>
                <div class="right_header_bottom">
                    <div class="register_serarch  text_center">
                        <div class="btn_register">
                            <a href="#" data-fancybox="" data-src="#quick_registration"><?=$glo_lang['registration'] ?></a>
                        </div>
                        <div class="icon_search">
                           <a class="">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="box_form_search">
                            <div class="timkiem_top no_box">
                                <div class="search">
                                    <a onClick="SEARCH_timkiem('<?=$full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer">   <i class="fa fa-search" ></i></a>
                                    <input class="input_search input_search_enter input_keyword" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url ?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu_pc text_right">
                        <?php include _source."menu_top.php"; ?>
                    </div>
                    <div class="clr"></div>
                </div>  
                <div class="clr"></div>
            </div>
        </div>
     </div>
</header>

<div class="row  box_quick_view" id="quick_registration" style="width: 550px;position: relative;overflow: hidden;display: none; transition: 0.5s ease-in-out all">
<h2 class="title_footer "><?=$glo_lang['registration'] ?></h2>
    <div class="box_subscribe">
        <form action="" class="form_subscribe no_box" method="post" accept-charset="UTF-8" name="formnamecontact2_header" id="formnamecontact2_header">
            <input type="hidden" name="send_lienhe">
            <input type="hidden" class="lang_ok" value="<?=$glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
            <input type="hidden" class="lang_false" value="<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
            <input type="hidden" name="tieude_lienhe" value="<?=!empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['thongtin_lienhe']) ?>">
            <div class="group_input">
                <label><?=$glo_lang['ho_va_ten'] ?></label>
                <input type="hidden" name="s_fullname_s" value="<?=base64_encode($glo_lang['ho_va_ten']) ?>">
                <input class="cls_data_check_form_header input_text" data-rong="1" name="s_fullname" id="s_fullname" type="text" placeholder="<?=$glo_lang['ho_va_ten'] ?> (*)" value="" data-name="<?=$glo_lang['ho_va_ten'] ?> (*)" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>"/>
            </div>
            <div class="group_input flex_wap">
                <div class="group_left">
                    <label><?=$glo_lang['so_dien_thoai'] ?></label>
                    <input type="hidden" name="s_dienthoai_s" value="<?=base64_encode($glo_lang['so_dien_thoai']) ?>">
                    <input class="cls_data_check_form_header input_text" data-rong="1"  name="s_dienthoai" id="s_dienthoai" type="text" placeholder="<?=$glo_lang['so_dien_thoai'] ?> (*)" value=""  data-name="<?=$glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                </div>
                <div class="group_right">
                    <label><?=$glo_lang['email'] ?></label>
                    <input type="hidden" name="s_email_s" value="<?=base64_encode($glo_lang['email']) ?>">
                    <input class="cls_data_check_form_header" data-rong="1" data-email="1" name="s_email" id="s_email" type="text" placeholder="<?=$glo_lang['email'] ?> (*)" value=""  data-msso="<?=$glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                </div>
            </div>
            <div class="group_input">
                <label><?=$glo_lang['noi_dung_lien_he'] ?></label>
                <input type="hidden" name="s_message_s" value="<?=base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                <textarea class="cls_data_check_form_header" data-rong="1" name="s_message" id="s_message" cols="" rows="" placeholder="<?=$glo_lang['noi_dung_lien_he'] ?>  (*)" data-msso="<?=$glo_lang['nhap_noi_dung'] ?>"></textarea>
            </div>
            <input type="hidden" name="id_token" class="id_token" value="<?=$_SESSION['token'] ?>">
            <button  type="button" onclick="return CHECK_send_lienhe('<?=$full_url ?>/','#formnamecontact2_header', '.cls_data_check_form_header')" style="cursor:pointer" class="sent_subscribe"><?=$glo_lang['gui']  ?> <img src="images/loading2.gif" class="ajax_img_loading"></button>
        </form>
    </div>
</div>
