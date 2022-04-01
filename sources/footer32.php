<footer id="footer" >
           <div class="footer_top wow fadeIn">
             <div class="container ">
                <ul class="no_style col_list_footer flex">
                    <li class="ft_col ft_contact">
                        <?php
                            $noidung    = LAYTEXT_rieng(61);
                        ?>
                        <h2 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
                        <div class="n-foot">
                            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                        </div>
                    </li>
                    <li class="ft_col ft_quicklink">
                        <?php
                            $noidung    = LAYTEXT_rieng(62);
                        ?>
                        <h2 class="title_footer"><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
                        <div class="n-foot">
                            <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                        </div>
                    </li>
                    <li class="ft_col ft_register">
                        <h2 class="title_footer "><?=$glo_lang['registration'] ?></h2>
                        <div class="box_subscribe">
                            <form action="" class="form_subscribe no_box" method="post" accept-charset="UTF-8" name="formnamecontact2_footer" id="formnamecontact2_footer">
                                <input type="hidden" name="send_lienhe">
                                <input type="hidden" class="lang_ok" value="<?=$glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                                <input type="hidden" class="lang_false" value="<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                                <input type="hidden" name="tieude_lienhe" value="<?=!empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['thongtin_lienhe']) ?>">
                                <div class="group_input">
                                    <label><?=$glo_lang['ho_va_ten'] ?></label>
                                    <input type="hidden" name="s_fullname_s" value="<?=base64_encode($glo_lang['ho_va_ten']) ?>">
                                    <input class="cls_data_check_form_foot input_text" data-rong="1" name="s_fullname" id="s_fullname" type="text" placeholder="<?=$glo_lang['ho_va_ten'] ?> (*)" value="" data-name="<?=$glo_lang['ho_va_ten'] ?> (*)" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>"/>
                                </div>
                                <div class="group_input flex_wap">
                                    <div class="group_left">
                                        <label><?=$glo_lang['so_dien_thoai'] ?></label>
                                        <input type="hidden" name="s_dienthoai_s" value="<?=base64_encode($glo_lang['so_dien_thoai']) ?>">
                                        <input class="cls_data_check_form_foot input_text" data-rong="1"  name="s_dienthoai" id="s_dienthoai" type="text" placeholder="<?=$glo_lang['so_dien_thoai'] ?> (*)" value=""  data-name="<?=$glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                                    </div>
                                    <div class="group_right">
                                        <label><?=$glo_lang['email'] ?></label>
                                        <input type="hidden" name="s_email_s" value="<?=base64_encode($glo_lang['email']) ?>">
                                        <input class="cls_data_check_form_foot" data-rong="1" data-email="1" name="s_email" id="s_email" type="text" placeholder="<?=$glo_lang['email'] ?> (*)" value=""  data-msso="<?=$glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                                    </div>
                                </div>
                                <div class="group_input">
                                    <label><?=$glo_lang['noi_dung_lien_he'] ?></label>
                                    <input type="hidden" name="s_message_s" value="<?=base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                                    <textarea class="cls_data_check_form_foot" data-rong="1" name="s_message" id="s_message" cols="" rows="" placeholder="<?=$glo_lang['noi_dung_lien_he'] ?>  (*)" data-msso="<?=$glo_lang['nhap_noi_dung'] ?>"></textarea>
                                </div>
                                <input type="hidden" name="id_token" class="id_token" value="<?=$_SESSION['token'] ?>">
                                <button  type="button" onclick="return CHECK_send_lienhe('<?=$full_url ?>/','#formnamecontact2_footer', '.cls_data_check_form_foot')" style="cursor:pointer" class="sent_subscribe"><?=$glo_lang['gui']  ?> <img src="images/loading2.gif" class="ajax_img_loading"></button>
                            </form>
                        </div>
                    </li>
                    <div class="clr"></div>
                </ul>
            </div>
         </div>
        <div class="bottom_id_copyright">
            <div class="container">
                <p class="text_center">
                    <a target="_blank" href="https://web30s.vn/" title="<?=$glo_lang['ban_quyen_name'] ?>"><?=$glo_lang['ban_quyen_name'] ?></a>
                </p>
            </div>
        </div>
    </div>
</footer>
<div id="back-top"><a href="#top">TOP</a></div>

<script>
$(document).ready(function(){
  $("#back-top").hide();
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn();
      } else {
        $('#back-top').fadeOut();
      }
    });
    $('#back-top a').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 0);
      return false;
    });
  });

});
</script>